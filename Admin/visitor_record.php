<?php
session_start();
if (isset($_SESSION['email'])) {
    $current_file = basename(__FILE__);
    include "admin_navbar.html";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industrial Visitor Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --industrial-primary: #2c3e50;
            --industrial-secondary: #34495e;
            --industrial-accent: #e74c3c;
            --industrial-light: #ecf0f1;
            --industrial-dark: #1a252f;
            --industrial-warning: #f39c12;
            --industrial-success: #27ae60;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: var(--industrial-dark);
        }
        
        #main-content {
            background-color: white;
            padding: 2rem;
            margin-left: 220px;
            flex-grow: 1;
            min-height: 100vh;
        }
        
        .table-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow: hidden;
            border-top: 4px solid var(--industrial-warning);
        }
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: var(--industrial-primary);
            color: white;
        }
        
        .table-header h2 {
            margin: 0;
            font-weight: 600;
            color: var(--industrial-warning);
        }
        
        .search-box {
            /* position: relative; */
            width: 300px;
        }
        
        .search-box i {
            /* position: absolute; */
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--industrial-secondary);
        }
        
        .search-box input {
            padding-left: 35px;
            border-radius: 20px;
            border: 1px solid var(--industrial-secondary);
        }
        
        .visitor-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .visitor-table thead {
            background-color: var(--industrial-secondary);
            color: white;
        }
        
        .visitor-table th {
            padding: 15px;
            text-align: center;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        .visitor-table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .visitor-table tr:nth-child(even) {
            background-color: rgba(44, 62, 80, 0.03);
        }
        
        .visitor-table tr:hover {
            background-color: rgba(44, 62, 80, 0.05);
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--industrial-warning);
            border-color: var(--industrial-warning);
            color: white;
        }
        
        .pagination .page-link {
            color: var(--industrial-secondary);
        }
        
        .pagination .page-link:hover {
            color: var(--industrial-warning);
        }
        
        .no-records {
            padding: 3rem;
            text-align: center;
            background-color: rgba(236, 240, 241, 0.5);
            border-radius: 8px;
            margin: 2rem 0;
            border: 2px dashed var(--industrial-secondary);
        }
        
        .no-records i {
            font-size: 4rem;
            color: var(--industrial-secondary);
            margin-bottom: 1.5rem;
            opacity: 0.7;
        }
        
        .no-records h4 {
            color: var(--industrial-secondary);
            font-weight: 500;
        }
        
        .no-records p {
            color: var(--industrial-secondary);
            opacity: 0.8;
        }
        
        @media (max-width: 992px) {
            #main-content {
                margin-left: 0;
                padding: 1rem;
            }
            
            .table-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .search-box {
                width: 100%;
                display:flex;
                
            }
            
            .visitor-table {
                display: block;
                overflow-x: auto;
            }
        }
        
        @media (max-width: 768px) {
            .visitor-table th, 
            .visitor-table td {
                padding: 10px 8px;
                font-size: 0.85rem;
            }
            
            .no-records {
                padding: 2rem 1rem;
            }
            
            .no-records i {
                font-size: 3rem;
            }
        }
        
        @media (max-width: 576px) {
            .visitor-table td:nth-child(4),
            .visitor-table th:nth-child(4),
            .visitor-table td:nth-child(5),
            .visitor-table th:nth-child(5) {
                display: none;
            }
            
            .no-records {
                padding: 1.5rem 0.5rem;
                margin: 1rem 0;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <?php include "admin_sidebar.php"; ?>
        <div id="main-content">
            <div class="table-container">
                <div class="table-header">
                    <h2><i class="fas fa-clipboard-list me-2"></i>Visitor Records</h2>
                    <div class="search-box">
                        <!-- <i class="fas fa-search"></i> -->
                        <input type="text" id="searchInput" class="form-control" placeholder="Search visitors...">
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="visitor-table">
                        <thead>
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
                            try {
                                $qry = "SELECT * FROM visitors ORDER BY arrival_date DESC";
                                $result = $conn->query($qry);

                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $limit = 8;
                                $offset = ($page - 1) * $limit;

                                $total_rows_result = $conn->query("SELECT COUNT(*) AS total FROM visitors");
                                $total_rows = $total_rows_result->fetch_assoc()['total'];
                                $total_pages = ceil($total_rows / $limit);

                                if ($result && $result->num_rows > 0) {
                                    $sr_no = $offset + 1;
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $sr_no++ . "</td>";
                                        echo "<td>" . htmlspecialchars($row['sic']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['visitor_name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['relation']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['arrival_date']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['mobile']) . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='py-4'>
                                        <div class='no-records'>
                                            <i class='fas fa-clipboard-list'></i>
                                            <h4>No Visitor Records Found</h4>
                                            <p>There are currently no visitor records in the system</p>
                                        </div>
                                    </td></tr>";
                                }
                            } catch (Exception $e) {
                                echo "<tr><td colspan='7' class='text-danger py-4'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                            } finally {
                                $conn->close();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <?php if ($total_pages > 1) : ?>
                <div class="d-flex justify-content-center p-3">
                    <nav>
                        <ul class="pagination">
                            <?php
                            $prevClass = ($page <= 1) ? 'disabled' : '';
                            $prevPage = ($page > 1) ? $page - 1 : 1;
                            echo "<li class='page-item $prevClass'>
                                    <a class='page-link' href='?page=$prevPage'>&laquo; Prev</a>
                                </li>";

                            $startPage = max(1, $page - 2);
                            $endPage = min($total_pages, $page + 2);
                            
                            if ($startPage > 1) {
                                echo "<li class='page-item'><a class='page-link' href='?page=1'>1</a></li>";
                                if ($startPage > 2) echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                            }
                            
                            for ($i = $startPage; $i <= $endPage; $i++) {
                                $active = ($i == $page) ? 'active' : '';
                                echo "<li class='page-item $active'>
                                        <a class='page-link' href='?page=$i'>$i</a>
                                    </li>";
                            }
                            
                            if ($endPage < $total_pages) {
                                if ($endPage < $total_pages - 1) echo "<li class='page-item disabled'><span class='page-link'>...</span></li>";
                                echo "<li class='page-item'><a class='page-link' href='?page=$total_pages'>$total_pages</a></li>";
                            }

                            $nextClass = ($page >= $total_pages) ? 'disabled' : '';
                            $nextPage = ($page < $total_pages) ? $page + 1 : $total_pages;
                            echo "<li class='page-item $nextClass'>
                                    <a class='page-link' href='?page=$nextPage'>Next &raquo;</a>
                                </li>";
                            ?>
                        </ul>
                    </nav>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <script>
        $(document).ready(function() {
            // Search functionality
            $('#searchInput').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $('#visitorData tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
            
            // Highlight table row on hover
            $('.visitor-table tbody tr').hover(
                function() {
                    $(this).css('transform', 'translateY(-1px)');
                    $(this).css('box-shadow', '0 2px 5px rgba(0,0,0,0.1)');
                },
                function() {
                    $(this).css('transform', '');
                    $(this).css('box-shadow', '');
                }
            );
        });
    </script>
</body>
</html>
<?php
} else {
    header("Location: login.php");
    exit();
}
?>