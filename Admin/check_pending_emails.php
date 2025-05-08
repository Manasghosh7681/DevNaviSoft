<?php
require_once __DIR__ . '/../Database/admin_db_functions.php';

header('Content-Type: application/json');

try {
    // Fetch pending emails using your getPendingEmails() function
    $pendingEmails = getPendingEmails(); // Defaults to 62 if not defined
    $count = count($pendingEmails);

    // Return JSON response
    echo json_encode([
        'count'   => (int) $count,
        'success' => true
    ]);
} catch (Exception $e) {
    // Error response
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
