<?php
// process_email_queue.php
set_time_limit(600);

require_once __DIR__ . '/../Database/admin_db_functions.php';

// --- Security check: allow CLI, AJAX, or secret key ---
$allowed = false;

if (php_sapi_name() === 'cli') {
    $allowed = true;
} elseif (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    $allowed = true;
} elseif (isset($_GET['secret_key']) && $_GET['secret_key'] === 'YOUR_SECRET_KEY') {
    $allowed = true;
}

if (!$allowed) {
    die("Access denied");
}

// --- Mail Configuration ---
define('MAIL_FROM_EMAIL', 'manasghosh7681@gmail.com');
define('MAIL_FROM_NAME', 'Hostel Management');

// Optional for some systems
ini_set('SMTP', 'smtp.gmail.com');
ini_set('smtp_port', 587);
ini_set('sendmail_from', MAIL_FROM_EMAIL);

// --- Logging Setup ---
$logDir = __DIR__ . '/email_logs';
$logFile = $logDir . '/email_' . date('Y-m-d') . '.log';

if (!file_exists($logDir)) {
    mkdir($logDir, 0755, true);
}

// --- Process Emails ---
try {
    $emails = getPendingEmails(50); // limit per batch
    $sentCount = 0;

    foreach ($emails as $email) {
        $headers = "From: " . MAIL_FROM_NAME . " <" . MAIL_FROM_EMAIL . ">\r\n";
        $headers .= "Reply-To: support@yourdomain.com\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        $success = mail(
            $email['receiver_email'],
            $email['subject'],
            $email['body'],
            $headers
        );

        $logEntry = "[" . date('Y-m-d H:i:s') . "] ";

        if ($success) {
            markEmailAsSent($email['id']);
            deleteEmailFromQueue($email['id']); // Clean up after sending
            $logEntry .= "Sent and deleted: " . $email['receiver_email'] . "\n";
            $sentCount++;
            usleep(200000); // rate limit: 0.2 seconds
        } else {
            markEmailAsFailed($email['id'], error_get_last()['message'] ?? 'Unknown error');
            $logEntry .= "Failed to send to: " . $email['receiver_email'] . "\n";
        }

        file_put_contents($logFile, $logEntry, FILE_APPEND);
    }

    $response = [
        'success' => true,
        'message' => "Successfully sent $sentCount emails.",
        'count'   => $sentCount
    ];
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => "Error: " . $e->getMessage()
    ];
}

// Output response (for AJAX or CLI feedback)
header('Content-Type: application/json');
echo json_encode($response);
