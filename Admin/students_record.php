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
        <title>Admin Dashboard - Silicon Residence</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            :root {
                --primary-color: #2c3e50;
                --secondary-color: #34495e;
                --accent-color: #3498db;
                --light-color: #ecf0f1;
                --dark-color: #2c3e50;
                --error-color: #e74c3c;
                --success-color: #2ecc71;
                --industrial-bg: #e9ecef;
                --metal-dark: #3d4a5d;
                --metal-light: #7a8ba9;
                --bronze: #cd7f32;
            }

            body {
                font-family: 'Roboto', sans-serif;
                background-color: var(--industrial-bg);
                color: var(--dark-color);
            }

            #main-content {
                background-color: white;
                padding: 2rem;
                margin-left: 250px;
                min-height: calc(100vh - 56px);
                transition: all 0.3s;
                background-image: 
                    linear-gradient(rgba(255,255,255,0.95), rgba(255,255,255,0.95)),
                    url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect fill="rgba(0,0,0,0.03)" width="50" height="50" x="0" y="0"></rect><rect fill="rgba(0,0,0,0.03)" width="50" height="50" x="50" y="50"></rect></svg>');
            }

            .sidebar-collapsed #main-content {
                margin-left: 80px;
            }

            h2 {
                font-family: 'Montserrat', sans-serif;
                font-weight: 700;
                color: var(--bronze);
                /* position: relative; */
                display: inline-block;
            }

            h2:after {
                content: '';
                /* position: absolute; */
                bottom: -8px;
                left: 0;
                width: 60px;
                height: 3px;
                background: linear-gradient(90deg, var(--bronze), var(--metal-light));
            }

            .btn-primary {
                background-color: var(--metal-dark);
                border-color: var(--metal-dark);
                font-weight: 600;
                letter-spacing: 0.5px;
                padding: 10px 20px;
                transition: all 0.3s;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }

            .btn-primary:hover {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            }

            .btn-success {
                background-color: var(--success-color);
                border-color: var(--success-color);
                font-weight: 600;
                letter-spacing: 0.5px;
                padding: 10px 20px;
                transition: all 0.3s;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }

            .btn-success:hover {
                background-color: #27ae60;
                border-color: #27ae60;
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            }

            .table {
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 0 20px rgba(0,0,0,0.05);
            }

            .table thead {
                background: linear-gradient(135deg, var(--metal-dark), var(--metal-light));
                color: white;
            }

            .table th {
                font-weight: 600;
                text-transform: uppercase;
                font-size: 0.85rem;
                letter-spacing: 0.5px;
                padding: 15px;
            }

            .table td {
                vertical-align: middle;
                padding: 12px 15px;
                border-color: #f1f1f1;
            }

            .table-hover tbody tr:hover {
                background-color: rgba(52, 152, 219, 0.1);
            }

            .alert {
                border-radius: 8px;
                padding: 15px 20px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
                border-left: 4px solid;
            }

            .alert-success {
                border-left-color: var(--success-color);
            }

            .alert-warning {
                border-left-color: #f39c12;
            }

            .alert-danger {
                border-left-color: var(--error-color);
            }

           .pagination {
    display: flex;
    justify-content: center;
    padding: 0;
    margin: 0;
    list-style: none;
}

.pagination .page-item {
    margin: 0 4px;
}

.pagination .page-link {
    color: var(--metal-dark);
    border: none;
    border-radius: 8px;
    padding: 8px 14px;
    font-weight: 500;
    background-color: #f1f3f5;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.pagination .page-link:hover {
    background-color: var(--metal-light);
    color: white;
    transform: translateY(-1px);
}

.pagination .page-item.active .page-link {
    background-color: var(--metal-dark);
    color: #fff;
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

.pagination .page-link:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.3);
}


            .form-control {
                border-radius: 6px;
                border: 1px solid #ddd;
                padding: 10px 15px;
                transition: all 0.3s;
                box-shadow: none;
            }

            .form-control:focus {
                border-color: var(--accent-color);
                box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
            }

            .action-btn {
                background: none;
                border: none;
                color: var(--metal-dark);
                font-size: 1.1rem;
                transition: all 0.3s;
                padding: 5px;
            }

            .action-btn:hover {
                color: var(--accent-color);
                transform: scale(1.1);
            }

            .control-section {
                background: white;
                padding: 20px;
                border-radius: 8px;
                margin-bottom: 20px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
                border-left: 4px solid var(--metal-dark);
            }

            .status-badge {
                display: inline-block;
                padding: 5px 10px;
                border-radius: 20px;
                font-size: 0.8rem;
                font-weight: 600;
            }

            .status-pending {
                background-color: #f8f9fa;
                color: #6c757d;
                border: 1px solid #dee2e6;
            }

            @media (max-width: 992px) {
                #main-content {
                    margin-left: 0;
                    padding: 1.5rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="d-flex">
            <?php include_once "admin_sidebar.php"; ?>
            <div id="main-content">
                <!-- Flash Messages -->
                <div class="mb-4">
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo '<div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>'.$_SESSION['message'].'</div>';
                        unset($_SESSION['message']);
                    }

                    if (isset($_SESSION['warning'])) {
                        echo '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle me-2"></i>'.$_SESSION['warning'].'</div>';
                        unset($_SESSION['warning']);
                    }

                    if (isset($_SESSION['error'])) {
                        echo '<div class="alert alert-danger"><i class="fas fa-times-circle me-2"></i>'.$_SESSION['error'].'</div>';
                        unset($_SESSION['error']);
                    }
                    ?>
                </div>

                <!-- Control Sections -->
                <div class="control-section">
                    <div class="row">
                        <div class="col-md-12 text-center mb-3 mb-md-0">
                            <form action="auto_allocate_room.php" method="post">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-cogs me-2"></i> Auto Allocate Rooms
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6 text-center" id="email-control-section" style="display: none;">
                            <button id="send-emails-btn" class="btn btn-success">
                                <i class="fas fa-paper-plane me-2"></i> Send Allocation Emails
                            </button>
                            <div id="email-status" class="mt-2 small"></div>
                        </div>
                    </div>
                </div>

                <!-- Student Records -->
                <div class="control-section">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2><i class="fas fa-users-cog me-2"></i>Students Records</h2>
                        <div class="search-container">
                            <div class="d-flex algn-items-center border rounded-3">
                                <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
                                <input type="text" id="searchInput" class="form-control border-0" placeholder="Search students...">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th><i class="fas fa-id-card me-2"></i>SIC</th>
                                    <th><i class="fas fa-user me-2"></i>Name</th>
                                    <th><i class="fas fa-code-branch me-2"></i>Branch</th>
                                    <th><i class="fas fa-calendar-alt me-2"></i>Year</th>
                                    <th><i class="fas fa-venus-mars me-2"></i>Gender</th>
                                    <th><i class="fas fa-star me-2"></i>Preference</th>
                                    <th><i class="fas fa-plus-circle me-2"></i>Add</th>
                                </tr>
                            </thead>
                            <tbody id="studentData"></tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <nav><ul class="pagination" id="pagination"></ul></nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
        <script>
        function fetchStudents(query = "", page = 1) {
            $.ajax({
                url: "fetch_students.php",
                method: "POST",
                data: { search: query, page: page },
                success: function (response) {
                    let data = JSON.parse(response);
                    $("#studentData").html(data.tableData);
                    $("#pagination").html(data.pagination);
                }
            });
        }

        // Initial Load
        $(document).ready(function () {
            fetchStudents();
            checkPendingEmails();

            // Search
            $("#searchInput").on("keyup", function () {
                let query = $(this).val();
                fetchStudents(query);
            });

            // Pagination
            $(document).on("click", ".page-link", function (e) {
                e.preventDefault();
                let page = $(this).data("page");
                let query = $("#searchInput").val();
                fetchStudents(query, page);
            });

            // Send Emails
            $('#send-emails-btn').click(function() {
                var $btn = $(this);
                $btn.prop('disabled', true);
                $('#email-status').html('<div class="text-info"><i class="fas fa-spinner fa-spin me-2"></i> Processing emails...</div>');

                $.ajax({
                    url: 'process_email_queue.php',
                    type: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#email-status').html('<div class="text-success"><i class="fas fa-check me-2"></i> ' + response.message + '</div>');
                            checkPendingEmails();
                        } else {
                            $('#email-status').html('<div class="text-danger"><i class="fas fa-times me-2"></i> ' + response.message + '</div>');
                        }
                        $btn.prop('disabled', false);
                    },
                    error: function() {
                        $('#email-status').html('<div class="text-danger"><i class="fas fa-times me-2"></i> Error connecting to server</div>');
                        $btn.prop('disabled', false);
                    }
                });
            });

            // Check Pending Emails
            function checkPendingEmails() {
                $.get('check_pending_emails.php', function(response) {
                    if (response.count>0) {
                        $('#email-control-section').show();
                        $('#email-status').html('<div class="text-muted"><i class="fas fa-envelope me-2"></i>' + response.count + ' pending emails</div>');
                    } else {
                        $('#email-control-section').hide();
                    }
                }, 'json');
            }
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