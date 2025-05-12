<?php
session_start();
if (!isset($_SESSION['sic'])) {
    header("location:student_login.php");
    exit();
}

if (isset($_GET['file'])) {
    // Sanitize the file name
    $file = basename($_GET['file']);
    $filepath = '../Notice files/' . $file;
    
    // Check if file exists and is readable
    if (file_exists($filepath) && is_readable($filepath)) {
        // Get the file mime type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $filepath);
        finfo_close($finfo);
        
        // Set headers for download
        header('Content-Description: File Transfer');
        header('Content-Type: ' . $mime);
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        
        // Clear output buffer
        ob_clean();
        flush();
        
        // Read the file and output it
        readfile($filepath);
        exit;
    } else {
        // File not found
        header("HTTP/1.0 404 Not Found");
        die('File not found or access denied');
    }
} else {
    // No file specified
    header("HTTP/1.0 400 Bad Request");
    die('No file specified');
}
?>