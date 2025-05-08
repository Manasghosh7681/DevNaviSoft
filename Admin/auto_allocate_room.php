<?php
session_start();
require_once "../Database/admin_db_functions.php";
require_once "../Database/student_db_function.php";

// Increase execution time and memory limit
set_time_limit(300); // 5 minutes
ini_set('memory_limit', '512M');

if (!isset($_SESSION['email'])) {
    header("Location: ../Authentication/login.html");
    exit();
}

// Handle email sending request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_emails'])) {
    $output = shell_exec('php ' . __DIR__ . '/process_email_queue.php');
    $_SESSION['email_result'] = $output ?: "Emails processed successfully";
    header("Location: students_record.php");
    exit();
}

function generateRandomPassword() {
    $text = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    return substr(str_shuffle($text), 0, 8);
}

function queueAllocationEmail($student, $password) {
    global $conn;
    
    $headers = "From: Hostel Management <manasghosh7681@gmail.com>\r\n";
    $headers .= "Reply-To: no-reply@yourhosteldomain.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    $subject = "Hostel Room Allocation Confirmation";
    $body = "Dear ".$student['name'].",\n\n";
    $body .= "We are delighted to inform you that your room at ".$student['hostel']." has been successfully allocated.\n";
    $body .= "You have been assigned to Room ".$student['room'].", a ".$student['preference_type']." room.\n\n";
    $body .= "Your login credentials:\n";
    $body .= "SIC: ".$student['sic']."\n";
    $body .= "Password: ".$password."\n\n";
    $body .= "Please bring your student ID for verification.\n\n";
    $body .= "Warm regards,\nHostel Management Team";
    
    $query = "INSERT INTO email_queue (receiver_email, subject, body, headers, status, created_at) 
              VALUES (?, ?, ?, ?, 'pending', NOW())";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $student['email'], $subject, $body, $headers);
    return $stmt->execute();
}

function autoAllocateRooms() {
    $unallocatedStudents = fetchUnallocatedStudents();
    $totalStudents = count($unallocatedStudents);
    
    if (!$unallocatedStudents) {
        return ["success" => false, "message" => "No unallocated students found"];
    }
    
    $maleStudents = [];
    $femaleStudents = [];
    
    foreach ($unallocatedStudents as $student) {
        if ($student['gender'] == 'Male') {
            $maleStudents[] = $student;
        } else {
            $femaleStudents[] = $student;
        }
    }
    
    $allocatedCount = 0;
    $failedAllocations = [];
    
    if (!empty($maleStudents)) {
        $result = allocateByBranch($maleStudents, ['Boys Hostel 1', 'Boys Hostel 2', 'Boys Hostel 3']);
        if ($result['success']) {
            $allocatedCount += $result['allocated'];
            $failedAllocations = array_merge($failedAllocations, $result['failed']);
        }
    }
    
    if (!empty($femaleStudents)) {
        $result = allocateByBranch($femaleStudents, ['Girls Hostel']);
        if ($result['success']) {
            $allocatedCount += $result['allocated'];
            $failedAllocations = array_merge($failedAllocations, $result['failed']);
        }
    }
    
    if ($allocatedCount > 0) {
        $message = "Successfully allocated $allocatedCount out of $totalStudents students!";
        
        if (!empty($failedAllocations)) {
            $message .= " Could not allocate: " . implode(", ", $failedAllocations);
        }
        
        return [
            "success" => true,
            "message" => $message,
            "allocated" => $allocatedCount
        ];
    } else {
        return ["success" => false, "message" => "No rooms available for allocation"];
    }
}

function allocateByBranch($students, $hostels) {
    global $conn;

    $branches = [];
    foreach ($students as $student) {
        $branches[$student['branch']][] = $student;
    }

    $allocatedCount = 0;
    $failedAllocations = [];
    $studentsToEmail = [];

    $conn->autocommit(false);
    $allSuccess = true;

    foreach ($branches as $branch => $branchStudents) {
        $preferenceGroups = [];
        foreach ($branchStudents as $student) {
            $preferenceGroups[$student['preference_type']][] = $student;
        }

        foreach ($preferenceGroups as $preferenceType => $groupStudents) {
            $bedCapacity = ($preferenceType == 'AC') ? 3 : 4;
            $numStudents = count($groupStudents);

            $rooms = findAvailableRooms($hostels, $preferenceType, $numStudents);

            $studentIndex = 0;
            foreach ($rooms as $room) {
                $beds = getAvailableBeds($room['room_id']);

                foreach ($beds as $bed) {
                    if ($studentIndex >= $numStudents) break;

                    $student = $groupStudents[$studentIndex];
                    $result = allocateStudentToBed($student['sic'], $room['room_id'], $bed['bed_id']);

                    if ($result) {
                        $allocatedCount++;

                        $password = generateRandomPassword();
                        $updated = updateStudentPassword($student['sic'], $password);
                        if (!$updated) $allSuccess = false;

                        $studentData = [
                            'sic' => $student['sic'],
                            'name' => $student['name'],
                            'email' => $student['email'],
                            'hostel' => $room['hostel_name'],
                            'room' => $room['room_no'],
                            'preference_type' => $student['preference_type']
                        ];

                        // Queue email instead of sending immediately
                        queueAllocationEmail($studentData, $password);
                    } else {
                        $failedAllocations[] = $student['sic'];
                        $allSuccess = false;
                    }
                    $studentIndex++;
                }
            }
        }
    }

    if ($allSuccess) {
        $conn->commit();
    } else {
        $conn->rollback();
    }

    $conn->autocommit(true);

    return [
        "success" => $allocatedCount > 0,
        "allocated" => $allocatedCount,
        "failed" => $failedAllocations,
        "message" => $allocatedCount > 0 ? "" : "No rooms available for allocation"
    ];
}

// Execute the allocation
$result = autoAllocateRooms();
$allocatedCount = $result['allocated'] ?? 0;
$totalStudents = count(fetchUnallocatedStudents()) + $allocatedCount;

// Store results in session
if ($result['success']) {
    $_SESSION['message'] = "Successfully allocated $allocatedCount out of $totalStudents students!";
    
    if (!empty($result['failed'])) {
        $failedCount = count($result['failed']);
        $_SESSION['warning'] = "$failedCount students couldn't be allocated due to room availability.";
    }
    
    // Store allocation status in session to show email button
    $_SESSION['show_email_button'] = true;
} else {
    $_SESSION['error'] = $result['message'];
    $_SESSION['show_email_button'] = false;
}

// End output early to speed up response
ob_end_clean();
if (function_exists('fastcgi_finish_request')) {
    fastcgi_finish_request();
}

header("Location: students_record.php");
exit();
?>