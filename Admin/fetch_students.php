<?php
require_once "../Database/connection.php";

$search = isset($_POST['search']) ? $_POST['search'] : "";
$page = isset($_POST['page']) ? (int) $_POST['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$searchParam = "%$search%";

// Total record count query (unallocated + search filter)
$total_sql = "
    SELECT COUNT(*) AS total 
    FROM students 
    WHERE sic NOT IN (SELECT sic FROM room_allocation)
    AND (sic LIKE ? OR gender LIKE ? OR branch LIKE ? OR year LIKE ?)
";
$stmt1 = $conn->prepare($total_sql);
$stmt1->bind_param("ssss", $searchParam, $searchParam, $searchParam, $searchParam);
$stmt1->execute();
$result = $stmt1->get_result();
$total_records = $result->fetch_assoc()['total'];
$total_pages = ceil($total_records / $limit);

// Data fetch query
$data_sql = "
    SELECT * FROM students 
    WHERE sic NOT IN (SELECT sic FROM room_allocation)
    AND (sic LIKE ? OR gender LIKE ? OR branch LIKE ? OR year LIKE ?)
    LIMIT ?, ?
";
$stmt2 = $conn->prepare($data_sql);
$stmt2->bind_param("ssssii", $searchParam, $searchParam, $searchParam, $searchParam, $offset, $limit);
$stmt2->execute();
$result = $stmt2->get_result();

// Build table rows
$tableData = "";
while ($std = $result->fetch_assoc()) {
    $tableData .= "
        <tr>
            <td>{$std['sic']}</td>
            <td>{$std['name']}</td>
            <td>{$std['branch']}</td>
            <td>{$std['year']}</td>
            <td>{$std['gender']}</td>
            <td>{$std['preference_type']}</td>
            <td>
                <a href='room_allocation_form.php?sic={$std['sic']}' class='btn btn-success btn-outline-dark text-white'>
                    Allocate Room
                </a>
            </td>
        </tr>";
}

// Build pagination
$pagination = "";
if ($total_pages > 1) {
    $prevClass = ($page <= 1) ? 'disabled' : '';
    $pagination .= "<li class='page-item $prevClass'>
                        <a class='page-link' href='#' data-page='" . ($page - 1) . "'>&laquo; Prev</a>
                    </li>";

    for ($i = 1; $i <= $total_pages; $i++) {
        $active = ($i == $page) ? 'active' : '';
        $pagination .= "<li class='page-item $active'>
                            <a class='page-link' href='#' data-page='$i'>$i</a>
                        </li>";
    }

    $nextClass = ($page >= $total_pages) ? 'disabled' : '';
    $pagination .= "<li class='page-item $nextClass'>
                        <a class='page-link' href='#' data-page='" . ($page + 1) . "'>Next &raquo;</a>
                    </li>";
}

// Return JSON
echo json_encode([
    "tableData" => $tableData,
    "pagination" => $pagination
]);
?>
