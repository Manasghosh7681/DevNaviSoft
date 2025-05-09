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
        <!-- <title>Industrial Room Management</title> -->
        <style>
            /* Previous CSS styles remain the same */
            :root {
                --industrial-primary: #2c3e50;
                --industrial-secondary: #34495e;
                --industrial-accent: #e74c3c;
                --industrial-light: #ecf0f1;
                --industrial-dark: #1a252f;
                --industrial-warning: #f39c12;
            }
            
            body {
                font-family: 'Roboto', sans-serif;
                background-color: #f5f5f5;
                color: #333;
            }
            
            #main-content {
                background-color: white;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                margin-left: 220px;
                flex-grow: 1;
            }
            
            .table-responsive {
                border: 1px solid #ddd;
                border-radius: 4px;
                overflow: hidden;
            }
            
            .table thead {
    background-color: var(--industrial-dark);
    color: white;
    border: none;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table th,
.table td {
    padding: 12px 16px;
    vertical-align: middle;
    border: none;
    font-size: 0.9rem;
    white-space: nowrap;
}

.table td {
    background-color: #fff;
    border-bottom: 1px solid #eee;
}

.table-hover tbody tr:hover td {
    background-color: #f0f3f5;
    transition: background 0.3s;
}

.table thead th i {
    margin-right: 6px;
    color: var(--industrial-accent);
}


.badge-count {
    background-color: var(--industrial-accent);
    border-radius: 50%;
    font-size: 0.75rem;
    padding: 4px 9px;
    color: white;
    font-weight: 600;
    margin-left: 8px;
    vertical-align: middle;
}

.status-badge {
    border-radius: 999px;
    padding: 4px 10px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-block;
    text-transform: capitalize;
}

.status-available {
    background-color: #e8f8f1;
    color: #2ecc71;
}

.status-full {
    background-color: #fdecea;
    color: #e74c3c;
}

            
            .pagination .page-item.active .page-link {
                background-color: var(--industrial-primary);
                border-color: var(--industrial-primary);
            }
            
            .pagination .page-link {
                color: var(--industrial-primary);
                border: 1px solid #ddd;
                margin: 0 3px;
                min-width: 36px;
                text-align: center;
            }
            
            .pagination .page-link:hover {
                background-color: #f8f9fa;
            }
            
            .btn-view {
                background-color: var(--industrial-primary);
                color: white;
                border: none;
                padding: 5px 12px;
                border-radius: 3px;
                font-size: 0.8rem;
                transition: all 0.3s;
            }
            
            .btn-view:hover {
                background-color: var(--industrial-secondary);
                transform: translateY(-1px);
            }
            
            .search-container {
                /* position: relative; */
                width: 100%;
                max-width: 300px;
            }
            
            .search-container input {
                padding-left: 35px;
                border-radius: 20px;
                border: 1px solid #ddd;
                height: 38px;
            }
            
            .search-container::before {
                content: "\f002";
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                position: absolute;
                left: 12px;
                top: 10px;
                color: #aaa;
                z-index: 10;
            }
            
            .status-badge {
                display: inline-block;
                padding: 3px 8px;
                border-radius: 12px;
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: uppercase;
            }
            
            .status-available {
                background-color: rgba(46, 204, 113, 0.2);
                color: #2ecc71;
            }
            
            .status-full {
                background-color: rgba(231, 76, 60, 0.2);
                color: #e74c3c;
            }
            
            .card-header {
                background-color: var(--industrial-primary);
                color: white;
                font-weight: 600;
                padding: 12px 20px;
                border-bottom: 2px solid var(--industrial-accent);
            }
            
            .section-title {
                color: var(--industrial-primary);
                font-weight: 600;
                border-bottom: 2px solid var(--industrial-accent);
                padding-bottom: 8px;
                margin-bottom: 20px;
                display: inline-block;
            }
            
            .badge-count {
                background-color: var(--industrial-accent);
                color: white;
                border-radius: 50%;
                padding: 3px 8px;
                font-size: 0.8rem;
                margin-left: 5px;
            }
            
            .pagination-info {
                font-size: 0.9rem;
                color: #7f8c8d;
                margin-right: 15px;
            }
            
            .pagination-controls {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-top: 20px;
            }
            
            @media (max-width: 768px) {
                #main-content {
                    margin-left: 0;
                }
                
                .search-container {
                    max-width: 100%;
                }
            }
            .pagination .page-item.disabled .page-link {
                color: #6c757d;
                pointer-events: none;
                background-color: #f8f9fa;
            }
            .pagination .page-item.active .page-link {
                font-weight: bold;
            }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>
    <body>
    <div class="d-flex">
        <?php include_once "admin_sidebar.php"; ?>
        <div id="main-content">
            <!-- Search and Title Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="section-title">
                    <i class="fas fa-door-open mr-2"></i>Room Inventory
                    <span class="badge-count" id="totalRoomsBadge">0</span>
                </h2>
                <div class="search-container">
                            <div class="d-flex algn-items-center border rounded-3">
                                <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
                                <input type="text" id="searchInput" class="form-control border-0" placeholder="Search students...">
                            </div>
                        </div>
            </div>

            <!-- Room Records Table -->
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-table mr-2"></i>Room Records</span>
                    
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="roomTable">
                        <thead>
                            <tr>
                                <th>Room ID</th>
                                <th>Room No</th>
                                <th>Type</th>
                                <th>Hostel</th>
                                <th>Capacity</th>
                                <th>Available</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="roomData">
                            <!-- Room records will be loaded here via AJAX -->
                            
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination Controls -->
            <div class="pagination-controls">
                <div class="pagination-info" id="paginationInfo">
                    Showing 0 of 0 records
                </div>
                <nav>
                    <ul class="pagination mb-0" id="pagination">
                        <!-- Pagination will be updated dynamically -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let currentPage = 1;
        let totalRecords = 0;
        const recordsPerPage = 10; // Number of records per page

        function fetchRooms(query = "", page = 1) {
            $.ajax({
                url: "fetch_rooms.php",
                method: "POST",
                data: { 
                    search: query, 
                    page: page,
                    per_page: recordsPerPage 
                },
                beforeSend: function() {
                    $("#roomData").html(`
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </td>
                        </tr>
                    `);
                },
                success: function (response) {
                    try {
                        let data = JSON.parse(response);
                        $("#roomData").html(data.tableData);
                        
                        // Update pagination info
                        totalRecords = data.totalRecords || 0;
                        const startRecord = ((page - 1) * recordsPerPage) + 1;
                        const endRecord = Math.min(page * recordsPerPage, totalRecords);
                        
                        $("#paginationInfo").html(`
                            Showing <strong>${startRecord}-${endRecord}</strong> of <strong>${totalRecords}</strong> records
                        `);
                        
                        $("#totalRoomsBadge").text(totalRecords);
                        
                        // Update current page
                        currentPage = page;
                        
                        // Generate pagination links
                        generatePagination(totalRecords, page);
                        
                    } catch (e) {
                        $("#roomData").html(`
                            <tr>
                                <td colspan="8" class="text-center text-danger py-4">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    Error loading data. Please try again.
                                </td>
                            </tr>
                        `);
                        console.error("Error parsing response:", e);
                    }
                },
                error: function(xhr, status, error) {
                    $("#roomData").html(`
                        <tr>
                            <td colspan="8" class="text-center text-danger py-4">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Server error: ${error}
                            </td>
                        </tr>
                    `);
                }
            });
        }

        function generatePagination(totalRecords, currentPage) {
            const totalPages = Math.ceil(totalRecords / recordsPerPage);
            const $pagination = $("#pagination");
            $pagination.empty();
            
            if (totalPages <= 1) {
                return; // Don't show pagination if only one page
            }
            
            // Previous button
            const prevDisabled = currentPage <= 1 ? 'disabled' : '';
            $pagination.append(`
                <li class="page-item ${prevDisabled}">
                    <a class="page-link" href="#" data-page="${currentPage - 1}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            `);
            
            // Always show first page
            if (currentPage > 3) {
                $pagination.append(`
                    <li class="page-item">
                        <a class="page-link" href="#" data-page="1">1</a>
                    </li>
                `);
                if (currentPage > 4) {
                    $pagination.append('<li class="page-item disabled"><span class="page-link">...</span></li>');
                }
            }
            
            // Show pages around current page
            const startPage = Math.max(1, currentPage - 2);
            const endPage = Math.min(totalPages, currentPage + 2);
            
            for (let i = startPage; i <= endPage; i++) {
                const active = i === currentPage ? 'active' : '';
                $pagination.append(`
                    <li class="page-item ${active}">
                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                    </li>
                `);
            }
            
            // Always show last page if needed
            if (currentPage < totalPages - 2) {
                if (currentPage < totalPages - 3) {
                    $pagination.append('<li class="page-item disabled"><span class="page-link">...</span></li>');
                }
                $pagination.append(`
                    <li class="page-item">
                        <a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a>
                    </li>
                `);
            }
            
            // Next button
            const nextDisabled = currentPage >= totalPages ? 'disabled' : '';
            $pagination.append(`
                <li class="page-item ${nextDisabled}">
                    <a class="page-link" href="#" data-page="${currentPage + 1}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            `);
        }

        // Initial load
        $(document).ready(function () {
            fetchRooms();

            // Search with debounce
            let searchTimer;
            $("#searchInput").on("keyup", function () {
                clearTimeout(searchTimer);
                const query = $(this).val();
                searchTimer = setTimeout(() => {
                    fetchRooms(query, 1);
                }, 500);
            });

            // Pagination click handler
            $(document).on("click", ".page-link", function (e) {
                e.preventDefault();
                const page = $(this).data("page");
                if (!page || $(this).parent().hasClass('disabled')) return;
                
                const query = $("#searchInput").val();
                fetchRooms(query, page);
                
                // Smooth scroll to top
                $('html, body').animate({
                    scrollTop: $("#roomTable").offset().top - 20
                }, 200);
            });
        });
    </script>
    </body>
    </html>
    <?php
} else {
    header("Location: ../Authentication/login.html");
    exit();
}
?>