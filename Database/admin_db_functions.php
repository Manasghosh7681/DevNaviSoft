<?php
require_once "connection.php";

function fetchAdminData($userId, $password){
    global $conn;
    try {
        $qry = "SELECT * FROM admin WHERE adminId = ? AND password = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ss", $userId, $password);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0){
            return $res->fetch_assoc();
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    // finally{
    //     $conn->close();
    // }
}
function updateAdminPassword($new_password)  {
    global $conn;
    try {
        $qry = "UPDATE admin SET password = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $new_password);
        $stmt->execute();
        if($conn -> affected_rows > 0){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    // finally{
    //     $conn->close();
    // }
}
function addNotice($notice_title,$notice_date,$notice_description,$notice_file="empty"){
    global $conn;
    try{
        $qry = "INSERT INTO notice(notice_title,notice_date,notice_description,notice_file)VALUES(?,?,?,?)";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ssss",$notice_title,$notice_date,$notice_description,$notice_file);
        $res = $stmt->execute();
        return $res;
    }catch(Exception $e){
        echo $e->getMessage();
    }finally{
        // $conn->close();
    }
}
function displayAllNotice(){
    global $conn;
    try{
        $qry = "SELECT * FROM notice";
        $stmt = $conn->prepare($qry);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0)
            return $res;
        else{
            return false;
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }finally{
        // $conn->close();
    }
}
function displayAllPendingLeave(){
    global $conn;
    try{
        $qry = "SELECT * FROM leave_request WHERE status='Pending'";
        $stmt = $conn->prepare($qry);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0)
            return $res;
        else{
            return false;
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }finally{
        $conn->close();
    }
}
function leaveApproved($sic,$apply_date){
    global $conn;
    try {
        $qry = "UPDATE leave_request SET status='Approved' WHERE sic=? AND apply_date=? AND status='Pending'";
        $stmt= $conn->prepare($qry);
        $stmt->bind_param("ss",$sic,$apply_date);
        $stmt->execute();
        $res = $stmt->get_result();
        if($conn->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }finally{
        $conn->close();
    }
}
function leaveRejected($sic,$apply_date){
    global $conn;
    try {
        $qry = "UPDATE leave_request SET status='Rejected' WHERE sic=? AND apply_date=? AND status='Pending'";
        $stmt= $conn->prepare($qry);
        $stmt->bind_param("ss",$sic,$apply_date);
        $stmt->execute();
        $res = $stmt->get_result();
        if($conn->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }finally{
        $conn->close();
    }
}

function displayAllPendingComplaint(){
    global $conn;
    try{
        $qry = "SELECT * FROM complaint WHERE status='Pending' ORDER BY apply_date DESC";
        $stmt = $conn->prepare($qry);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0)
            return $res;
        else{
            return false;
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }finally{
        $conn->close();
    }
}
function complaintApproved($sic,$apply_date){
    global $conn;
    try {
        $qry = "UPDATE complaint SET status='Approved' WHERE sic=? AND apply_date=?";
        $stmt= $conn->prepare($qry);
        $stmt->bind_param("ss",$sic,$apply_date);
        $stmt->execute();
        $res = $stmt->get_result();
        if($conn->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }finally{
        $conn->close();
    }
}
function complaintRejected($sic,$apply_date){
    global $conn;
    try {
        $qry = "UPDATE complaint SET status='Rejected' WHERE sic=? AND apply_date=?";
        $stmt= $conn->prepare($qry);
        $stmt->bind_param("ss",$sic,$apply_date);
        $stmt->execute();
        $res = $stmt->get_result();
        if($conn->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }finally{
        $conn->close();
    }
}

function fetchAllStudents(){
    global $conn;
    try {

        $records_per_page = 10;
        // Get the current page number from URL, default to 1 if not set
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max($page, 1); // Ensure page is at least 1
        // Calculate the offset
        $offset = ($page - 1) * $records_per_page;
        $total_records_query = "SELECT count(*) AS total FROM `students` WHERE sic NOT IN (SELECT sic FROM room_allocation)"; // Change 'students' to your table name
        $stmt1 = $conn->prepare($total_records_query);
        $stmt1->execute();
        $result = $stmt1->get_result();
        $total_records = $result->fetch_assoc()['total'];
        // Calculate total pages
        $total_pages = ceil($total_records / $records_per_page);

        $qry = "SELECT * FROM `students` WHERE sic NOT IN (SELECT sic FROM room_allocation) LIMIT $offset, $records_per_page ";
        $stmt= $conn->prepare($qry);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0){
            return [
                'res' => $res,
                'page' => $page,
                'total_pages' => $total_pages,
            ];
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
    finally{
        $conn->close();
    }
}
function fetchAllRooms(){
    global $conn;
    try {
        $records_per_page = 10;
        // // Get the current page number from URL, default to 1 if not set
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max($page, 1); // Ensure page is at least 1
        // // Calculate the offset
        $offset = ($page - 1) * $records_per_page;
        $total_records_query = "SELECT COUNT(*) AS total FROM rooms"; // Change 'students' to your table name
        $stmt1 = $conn->prepare($total_records_query);
        $stmt1->execute();
        $result = $stmt1->get_result();
        $total_records = $result->fetch_assoc()['total'];
        // Calculate total pages
        $total_pages = ceil($total_records / $records_per_page);


        $qry = "SELECT * FROM rooms LIMIT $offset, $records_per_page";
        $stmt= $conn->prepare($qry);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0){
            return [
                'res' => $res,
                'page' => $page,
                'total_pages' => $total_pages
            ];
        }else{
            return false;
        }
        



    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
    finally{
        $conn->close();
    }
}
function fetchStudentDetails($sic){
  global $conn;
  try {
    $qry = "SELECT * FROM students WHERE sic=?";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("s", $sic);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        return $result;
    }else{
        return false;
    }
  } catch (Exception $e) {
    echo $e->getMessage();
  }
  finally{
    $conn->close();
  }
}
function fetchSelectedRooms($hostel_name, $preference_type){
    global $conn;
    try {
        $qry = "SELECT * FROM rooms WHERE hostel_name = ? AND room_type = ? AND status = 'Available'";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ss", $hostel_name, $preference_type);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0)
            return $result;
        else
            return false;   
    } catch (Exception $e) {
        echo $e->getMessage();
    }finally{
        $conn->close();
    }
}
function fetchBeds($room_id){
    global $conn;
    try {
        $qry = "SELECT * FROM beds WHERE room_id = ? AND status = 'Vacant'";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $room_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0)
            return $result;
        else
            return false;   
    } catch (Exception $e) {
        echo $e->getMessage();
    }finally{
        $conn->close();
    }
}
function insertIntoRoomAllocationTable($sic,$room_id,$bed_id){
    global $conn;
    try {
        $qry = "INSERT INTO room_allocation(sic,room_id,bed_id) VALUES(?,?,?)";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("sss", $sic, $room_id,$bed_id);
        $result = $stmt->execute();
        return $result;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    // finally{
    //     $conn->close();
    // }
}
function updateBedsTable($bed_id,$room_id,$status){
    global $conn;
    try {
        $qry = "UPDATE beds SET status = ? WHERE bed_id = ? AND room_id = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("sss", $status, $bed_id, $room_id);
        $stmt->execute();
        if($conn -> affected_rows > 0){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    // finally{
    //     $conn->close();
    // }
}

function fetchAvailableBedsInRoom($room_id){
    global $conn;
    try {
        $qry = "SELECT availability_beds FROM rooms WHERE room_id = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $room_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    // finally{
    //     $conn->close();
    // }
}
function updateRoomTableByStatus($room_id,$status){
    global $conn;
    try {
        $qry = "UPDATE rooms SET status = ? WHERE room_id = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ss", $status,$room_id);
        $stmt->execute();
        if($conn->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    // finally{
    //     $conn->close();
    // }
}
function updateRoomTableByAvailability($room_id){
    global $conn;
    try {
        $qry = "UPDATE rooms SET availability_beds = availability_beds - 1 WHERE room_id = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $room_id);
        $stmt->execute();
        if($conn->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    // finally{
    //     $conn->close();
    // }
}
function fetchStudentsFromRoom($room_id){
    global $conn;
    try {
        $qry = "SELECT * FROM students JOIN room_allocation ON students.sic= room_allocation.sic WHERE room_allocation.room_id=?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s",$room_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $qry1 = "SELECT room_no, hostel_name FROM rooms WHERE room_id = ?";
        $stmt1 = $conn->prepare($qry1);
        $stmt1->bind_param("s",$room_id);
        $stmt1->execute();
        $res1 = $stmt1->get_result();
        if($res->num_rows > 0 && $res1->num_rows > 0){
            return [$res, $res1];
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }finally{
        $conn->close();
    }
}
function importStudents($sic,$name,$gender,$branch,$year,$contact_no,$email,$address){
    global $conn;
    try {
        $studentQuery = "INSERT INTO std (sic,name,gender,branch,year,contact_no,email,address) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($studentQuery);
        $stmt->bind_param("ssssiiss",$sic,$name,$gender,$branch,$year,$contact_no,$email,$address);
        $result = $stmt->execute();

        if($result){
          return true;
        }else{
           return false;
        }
        
    } catch (Exception $e) {
        die($e->getMessage());
    }
    // finally{
    //     $conn->close();
    // }
}


function removeFromRoomAllocation($sic){
    global $conn;
    try {
        $qry = "DELETE FROM room_allocation WHERE sic=?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s",$sic);
        $stmt->execute();
        if($conn->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function deallocateBed($bed_id){
    global $conn;
    try {
        $qry = "UPDATE beds SET status = 'Vacant' WHERE bed_id=?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s",$bed_id);
        $stmt->execute();
        if($conn->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function deallocateRoomTable($room_id){
    global $conn;
    try {
        $qry = "UPDATE rooms SET status = 'Available', availability_beds =  availability_beds + 1 WHERE room_id=?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s",$room_id);
        $stmt->execute();
        if($conn->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function calculateStudents(){
    global $conn;
    try {
        $qry = "SELECT gender, address FROM students";
        $stmt = $conn->prepare($qry);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0){
            $total_students =  $res->num_rows;
            $boys = 0;
            $girls = 0;
            $withinState = 0;
            $outsideState = 0;
            while($std = $res->fetch_assoc()){
                if($std['gender'] === 'Male'){
                    $boys++;
                }else{
                    $girls++;
                }
                if(strpos($std['address'],'Odisha')){
                    $withinState++;
                }else{
                    $outsideState++;
                }
            }
            return ['boys'=>round($boys/$total_students*100,2), 'girls'=>round($girls/$total_students*100,2), 'withinState'=>round($withinState/$total_students*100,2), 'outsideState'=>round($outsideState/$total_students*100,2)];
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>