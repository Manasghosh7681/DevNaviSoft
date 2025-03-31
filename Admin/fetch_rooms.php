<?php
require_once "../Database/connection.php";

$search = isset($_POST['search']) ? $_POST['search'] : "";
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = 10; // Number of records per page
$offset = ($page - 1) * $limit;

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
        </tr>";
}

// Generate pagination
$pagination = "";
if ($totalPages > 1) {
    // Previous button
    $prevClass = ($page <= 1) ? 'disabled' : '';
    $pagination .= "<li class='page-item $prevClass'>
                        <a class='page-link' href='#' data-page='" . ($page - 1) . "'>&laquo; Prev</a>
                    </li>";

    // Page numbers
    for ($i = 1; $i <= $totalPages; $i++) {
        $active = ($i == $page) ? 'active' : '';
        $pagination .= "<li class='page-item $active'>
                            <a class='page-link' href='#' data-page='$i'>$i</a>
                        </li>";
    }

    // Next button
    $nextClass = ($page >= $totalPages) ? 'disabled' : '';
    $pagination .= "<li class='page-item $nextClass'>
                        <a class='page-link' href='#' data-page='" . ($page + 1) . "'>Next &raquo;</a>
                    </li>";
}

// Return JSON response
echo json_encode(["tableData" => $tableData, "pagination" => $pagination]);
?>
