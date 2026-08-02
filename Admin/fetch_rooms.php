<?php
require_once "../Database/connection.php";

$search = isset($_POST['search']) ? $_POST['search'] : "";
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = 8; // Number of records per page
$offset = ($page - 1) * $limit;

// Validate page number
if ($page < 1) $page = 1;

// Search Query
$sql = "SELECT * FROM rooms WHERE
        room_id LIKE '%$search%' OR
        room_no LIKE '%$search%' OR 
        room_type LIKE '%$search%' OR 
        hostel_name LIKE '%$search%' 
        LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Count total records for pagination
$countSql = "SELECT COUNT(*) AS total FROM rooms WHERE 
             room_no LIKE '%$search%' OR 
             room_type LIKE '%$search%' OR 
             hostel_name LIKE '%$search%'";
$totalResult = $conn->query($countSql);
$totalRows = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $limit);

// Generate table data
$tableData = "";
while ($room = $result->fetch_assoc()) {
    $tableData .= "
        <tr>
            <td>{$room['room_id']}</td>
            <td>{$room['room_no']}</td>
            <td>{$room['room_type']}</td>
            <td>{$room['hostel_name']}</td>
            <td>{$room['bed_capacity']} Beds</td>
            <td>{$room['availability_beds']} Beds</td>
            <td><a href='view_room.php?room_id={$room['room_id']}' class='btn btn-warning btn-outline-light'>Check Out</a></td>
        </tr>";
}

// Generate smarter pagination
$pagination = "";
if ($totalPages > 1) {
    // Previous button
    $prevClass = ($page <= 1) ? 'disabled' : '';
    $pagination .= "<li class='page-item $prevClass'>
                        <a class='page-link' href='#' data-page='" . ($page - 1) . "' aria-label='Previous'>
                            <span aria-hidden='true'>&laquo;</span>
                        </a>
                    </li>";

    // Always show first page
    if ($page > 3) {
        $pagination .= "<li class='page-item'>
                            <a class='page-link' href='#' data-page='1'>1</a>
                        </li>";
        if ($page > 4) {
            $pagination .= "<li class='page-item disabled'><span class='page-link'>...</span></li>";
        }
    }

    // Show pages around current page
    $startPage = max(1, $page - 2);
    $endPage = min($totalPages, $page + 2);
    
    for ($i = $startPage; $i <= $endPage; $i++) {
        $active = ($i == $page) ? 'active' : '';
        $pagination .= "<li class='page-item $active'>
                            <a class='page-link' href='#' data-page='$i'>$i</a>
                        </li>";
    }

    // Always show last page if needed
    if ($page < $totalPages - 2) {
        if ($page < $totalPages - 3) {
            $pagination .= "<li class='page-item disabled'><span class='page-link'>...</span></li>";
        }
        $pagination .= "<li class='page-item'>
                            <a class='page-link' href='#' data-page='$totalPages'>$totalPages</a>
                        </li>";
    }

    // Next button
    $nextClass = ($page >= $totalPages) ? 'disabled' : '';
    $pagination .= "<li class='page-item $nextClass'>
                        <a class='page-link' href='#' data-page='" . ($page + 1) . "' aria-label='Next'>
                            <span aria-hidden='true'>&raquo;</span>
                        </a>
                    </li>";
}

// Return JSON response with additional pagination info
echo json_encode([
    "tableData" => $tableData, 
    "pagination" => $pagination,
    "totalRecords" => $totalRows,
    "currentPage" => $page,
    "totalPages" => $totalPages
]);
?>