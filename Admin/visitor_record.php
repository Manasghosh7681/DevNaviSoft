<?php
session_start();
if (isset($_SESSION['email'])) {
    $current_file = basename(__FILE__);
    include "admin_navbar.html";
    ?>
    <div class="d-flex">
        <?php
        include_once "admin_sidebar.php";
        ?>
        <div id="main-content">
            <div class="my-3 d-flex justify-content-between">
                <h2 style="color:rgb(152, 136, 13)">Visitor Records</h2>
                <div class="d-flex border ">
                    <form action="" method="get">
                        <input type="text" id="searchInput" class="form-control w-50 w-md-25"
                            placeholder="Search visitors...">
                        <input type="submit" class=" btn btn-sm btn-info ms-2" name="search" id="" value="SEARCH">
                    </form>
                    <!-- <a class='page-link' href='?page=$i&search=" . urlencode($search) . "'>$i</a> -->

                </div>
                <?php
                // Include the connection file
                // include_once "../Database/connection.php";
                // $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                // $whereClause = "";

                // if (!empty($search)) {
                //     // Adjust column names as needed
                //     $whereClause = "WHERE name LIKE '%$search%' OR visitor_name LIKE '%$search%' OR relation LIKE '%$search%' OR sic LIKE '%$search%'";
                // }

                // $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                // $limit = 10;
                // $offset = ($page - 1) * $limit;

                // // Get total rows (for pagination)
                // $countSql = "SELECT COUNT(*) AS total FROM visitors $whereClause";
                // $totalRowsResult = $conn->query($countSql);
                // $totalRows = $totalRowsResult->fetch_assoc()['total'];
                // $total_pages = ceil($totalRows / $limit);

                // // Final paginated query
                // $sql = "SELECT * FROM visitors $whereClause ORDER BY date DESC, time_in DESC LIMIT $offset, $limit";
                // $result = $conn->query($sql);
                
                ?>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Sr No</th>
                            <th>SIC</th>
                            <th>Name</th>
                            <th>Visitor Name</th>
                            <th>Relation</th>
                            <th>Date</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody id="visitorData">
                        <?php
                        include_once "../Database/connection.php";
                        // Fetch visitor records from the database
                        try {


                            $qry = "SELECT * FROM visitors ORDER BY arrival_date DESC";
                            $result = $conn->query($qry);

                            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                            $limit = 8;
                            $offset = ($page - 1) * $limit;

                            $total_rows_result = $conn->query("SELECT COUNT(*) AS total FROM visitors");
                            $total_rows = $total_rows_result->fetch_assoc()['total'];
                            $total_pages = ceil($total_rows / $limit);
                            // echo "<p>Total records: $total_rows</p>";
                            // echo "<p>Total pages: $total_pages</p>"; //for debugging
                    
                            if ($result && $result->num_rows > 0) {
                                echo "$result->num_rows records found";
                                $sr_no = 1;
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $sr_no++ . "</td>";
                                    echo "<td>" . $row['sic'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['visitor_name'] . "</td>";
                                    echo "<td>" . $row['relation'] . "</td>";
                                    echo "<td>" . $row['arrival_date'] . "</td>";
                                    echo "<td>" . $row['mobile'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No records found</td></tr>";
                            }
                        } catch (Exception $e) {
                            echo "<tr><td colspan='6'>Error: " . $e->getMessage() . "</td></tr>";
                        } finally {
                            $conn->close();
                        }



                        ?>
                    </tbody>
                </table>
            </div>



            <div class="d-flex justify-content-center mt-3">
                <nav>
                    <ul class="pagination" id="pagination">
                        <?php
                        $pagination = "";
                        if ($total_pages >= 1) {
                            $prevClass = ($page <= 1) ? 'disabled' : '';
                            $prevPage = ($page > 1) ? $page - 1 : 1;

                            $pagination .= "<li class='page-item $prevClass'>
                                                <a class='page-link' href='?page=$prevPage'>&laquo; Prev</a>
                                            </li>";

                            for ($i = 1; $i <= $total_pages; $i++) {
                                $active = ($i == $page) ? 'active' : '';
                                $pagination .= "<li class='page-item $active'>
                                                    <a class='page-link' href='?page=$i'>$i</a>
                                                </li>";
                            }

                            $nextClass = ($page >= $total_pages) ? 'disabled' : '';
                            $nextPage = ($page < $total_pages) ? $page + 1 : $total_pages;

                            $pagination .= "<li class='page-item $nextClass'>
                                                <a class='page-link' href='?page=$nextPage'>Next &raquo;</a>
                                            </li>";
                        }
                        echo $pagination;

                        ?>

                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <?php
} else {
    header("Location: login.php");
    exit();
}
?>