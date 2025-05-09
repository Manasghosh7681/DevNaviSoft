<?php
session_start();
if (isset($_SESSION['sic'])) {
    include "student_navbar.html";
    $current_file = basename(__FILE__);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industrial Leave Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --industrial-primary: #2c3e50;
            --industrial-secondary: #34495e;
            --industrial-accent: #e74c3c;
            --industrial-warning: #f39c12;
            --industrial-success: #27ae60;
            --industrial-light: #ecf0f1;
            --industrial-dark: #1a252f;
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
        
        .leave-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow: hidden;
            border-top: 4px solid var(--industrial-warning);
        }
        
        .nav-tabs {
            background-color: var(--industrial-primary);
            padding: 0;
            border-bottom: none;
        }
        
        .nav-tabs .nav-link {
            color: var(--industrial-light);
            border: none;
            border-radius: 0;
            padding: 1rem 1.5rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .nav-tabs .nav-link:hover {
            color: var(--industrial-warning);
            background-color: rgba(243, 156, 18, 0.1);
        }
        
        .nav-tabs .nav-link.active {
            color: var(--industrial-warning);
            background-color: var(--industrial-primary);
            border-bottom: 3px solid var(--industrial-warning);
        }
        
        .form-section {
            padding: 1.5rem;
            background-color: white;
        }
        
        .form-header {
            color: var(--industrial-primary);
            font-weight: 600;
            text-align: center;
            margin-bottom: 1.5rem;
            /* position: relative; */
        }
        
        .form-header:after {
            content: '';
            /* position: absolute; */
            left: 50%;
            bottom: -8px;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background-color: var(--industrial-warning);
        }
        
        .form-label {
            font-weight: 600;
            color: var(--industrial-secondary);
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border: 1px solid var(--industrial-secondary);
            border-radius: 4px;
            padding: 0.75rem 1rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--industrial-warning);
            box-shadow: 0 0 0 0.25rem rgba(243, 156, 18, 0.25);
        }
        
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }
        
        .btn-submit {
            background-color: var(--industrial-primary);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-submit:hover {
            background-color: var(--industrial-secondary);
            transform: translateY(-2px);
        }
        
        /* Table Styles */
        .table-card {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
        }
        
        .table-header-card {
            background-color: var(--industrial-primary);
            color: white;
            padding: 1rem;
            border-bottom: 2px solid var(--industrial-warning);
        }
        
        .table-header-card h4 {
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .table-responsive {
            border-radius: 0 0 8px 8px;
            overflow: hidden;
        }
        
        .table {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .table thead {
            background-color: var(--industrial-secondary);
            color: white;
            /* position: sticky; */
            top: 0;
        }
        
        .table th {
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem;
            text-align: center;
            border: none;
        }
        
        .table td {
            padding: 1rem;
            vertical-align: middle;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        
        .table tr:nth-child(even) {
            background-color: rgba(44, 62, 80, 0.03);
        }
        
        .table tr:last-child td {
            border-bottom: none;
        }
        
        /* Status Styles */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 0.8rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
        }
        
        .status-pending {
            background-color: rgba(243, 156, 18, 0.1);
            color: var(--industrial-warning);
        }
        
        .status-approved {
            background-color: rgba(39, 174, 96, 0.1);
            color: var(--industrial-success);
        }
        
        .status-rejected {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--industrial-accent);
        }
        
        .status-icon {
            margin-right: 6px;
            font-size: 0.9rem;
        }
        
        .btn-withdraw {
            background-color: var(--industrial-warning);
            border: none;
            padding: 0.5rem 1rem;
            font-size: 0.85rem;
            border-radius: 4px;
            color: white;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-withdraw:hover {
            background-color: #e67e22;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .btn-withdraw i {
            margin-right: 5px;
        }
        
        .mandatory-note {
            color: var(--industrial-accent);
            font-weight: 500;
            text-align: center;
            margin: 1rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .mandatory-note i {
            margin-right: 8px;
        }
        
        /* History Card Styles */
        .history-card {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05);
            margin-bottom: 1.5rem;
            background: white;
        }
        
        .history-card-header {
            background-color: var(--industrial-primary);
            color: white;
            padding: 1rem;
            border-bottom: 2px solid var(--industrial-warning);
        }
        
        .history-card-header h4 {
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .history-item {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            transition: all 0.3s;
        }
        
        .history-item:hover {
            background-color: rgba(44, 62, 80, 0.03);
        }
        
        .history-item:last-child {
            border-bottom: none;
        }
        
        .history-date {
            font-weight: 600;
            color: var(--industrial-secondary);
            margin-bottom: 0.5rem;
        }
        
        .history-period {
            color: var(--industrial-dark);
            margin-bottom: 0.5rem;
        }
        
        .history-destination {
            color: var(--industrial-secondary);
            margin-bottom: 0.5rem;
        }
        
        .history-reason {
            color: var(--industrial-dark);
            margin-bottom: 1rem;
            line-height: 1.5;
        }
        
        @media (max-width: 992px) {
            #main-content {
                margin-left: 0;
                padding: 1rem;
            }
            
            .nav-tabs .nav-link {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }
            
            .table th, 
            .table td {
                padding: 0.75rem;
            }
        }
        
        @media (max-width: 768px) {
            .form-section {
                padding: 1rem;
            }
            
            .table th, 
            .table td {
                padding: 0.75rem 0.5rem;
                font-size: 0.85rem;
            }
            
            .history-item {
                padding: 1rem;
            }
        }
        
        @media (max-width: 576px) {
            .nav-tabs {
                flex-direction: column;
            }
            
            .nav-tabs .nav-link {
                border-radius: 0;
                text-align: center;
            }
            
            .form-header {
                font-size: 1.1rem;
            }
            
            .status-badge {
                padding: 0.4rem 0.6rem;
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <?php include "student_sidebar.php"; ?>
        <div id="main-content" class="container">
            <h3 class="mb-4" style="color: var(--industrial-warning);">
                <i class="fas fa-calendar-alt me-2"></i>Leave Workways
            </h3>
            
            <div class="leave-container">
                <ul class="nav nav-tabs" id="leaveTabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="application-tab" data-bs-toggle="tab" href="#application">
                            <i class="fas fa-file-alt me-2"></i>Applications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="history-tab" data-bs-toggle="tab" href="#history">
                            <i class="fas fa-history me-2"></i>History
                        </a>
                    </li>
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="application">
                        <div id="pending-list" class="p-3"></div>
                        
                        <div class="form-section">
                            <form class="form" action="" method="post" id="leave-form">
                                <h5 class="form-header">Leave Application Form</h5>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">From Date:</label>
                                        <input type="date" id="from-date" class="form-control" name="from_date" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">From Time:</label>
                                        <input type="time" id="from-time" class="form-control" name="from_time" required>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">To Date:</label>
                                        <input type="date" id="to-date" class="form-control" name="to_date" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">To Time:</label>
                                        <input type="time" id="to-time" class="form-control" name="to_time" required>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Destination:</label>
                                        <input type="text" class="form-control" name="destination" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Contact Number:</label>
                                        <input type="tel" id="contact_no" class="form-control" name="contact_no" required>
                                        <div class="text-danger small mt-1" id="contact-error"></div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Reason:</label>
                                    <textarea class="form-control" id="reason" name="reason" required></textarea>
                                    <div class="text-danger small mt-1" id="reason-error"></div>
                                </div>
                                
                                <p class="mandatory-note">
                                    <i class="fas fa-exclamation-circle"></i>All fields are mandatory
                                </p>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-submit text-white" name="apply">
                                        <i class="fas fa-paper-plane me-2"></i>Submit Application
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="history">
                        <div id="history-content" class="p-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../Jquery/jquery-3.7.1.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <script>
        $(document).ready(function() {
            // Load pending leave applications
            loadPendingLeaves();
            
            // Set minimum date for from date
            $("#from-date").attr('min', new Date().toLocaleDateString('en-CA'));
            
            // Set minimum to date based on from date
            $("#from-date").on('change', function() {
                $("#to-date").attr('min', $(this).val());
            });
            
            // Form validation
            $("#leave-form").submit(function(e) {
                let contact_no = $("#contact_no").val();
                let reason = $("#reason").val();
                let error = false;
                
                if (!contact_no.match(/^[6-9]{1}[0-9]{9}$/) || contact_no.length !== 10) {
                    error = true;
                    $("#contact-error").text("Please enter a valid 10-digit mobile number");
                } else {
                    $("#contact-error").text("");
                }
                
                if (reason.length < 16) {
                    error = true;
                    $("#reason-error").text("Reason must contain at least 16 characters");
                } else {
                    $("#reason-error").text("");
                }
                
                if (error) {
                    e.preventDefault();
                }
            });
            
            // Withdraw button click handler
            $(document).on("click", ".withdraw-btn", function() {
                let apply_date = $(this).data("apply-date");
                if (confirm("Are you sure you want to withdraw this leave application?")) {
                    withdrawLeave(apply_date);
                }
            });
        });
        
        function loadPendingLeaves() {
            $.ajax({
                url: "pending_leave.php",
                method: "GET",
                success: function(data) {
                    if (data !== "False") {
                        data = JSON.parse(data);
                        let table = `
                            <div class="table-card">
                                <div class="table-header-card">
                                    <h4><i class="fas fa-clock me-2"></i>Pending Applications</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><i class="fas fa-calendar-plus me-2"></i>Apply Date</th>
                                                <th><i class="fas fa-calendar-alt me-2"></i>Leave Period</th>
                                                <th><i class="fas fa-hourglass-half me-2"></i>Status</th>
                                                <th><i class="fas fa-tasks me-2"></i>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>`;
                        
                        for (let i = 0; i < data.length; i++) {
                            let statusClass = '';
                            let statusIcon = '';
                            
                            if (data[i].status === 'Pending') {
                                statusClass = 'status-pending';
                                statusIcon = 'fa-hourglass-half';
                            } else if (data[i].status === 'Approved') {
                                statusClass = 'status-approved';
                                statusIcon = 'fa-check-circle';
                            } else {
                                statusClass = 'status-rejected';
                                statusIcon = 'fa-times-circle';
                            }
                            
                            table += `
                                <tr>
                                    <td>${data[i].apply_date}</td>
                                    <td>${data[i].leave_days}</td>
                                    <td>
                                        <span class="status-badge ${statusClass}">
                                            <i class="fas ${statusIcon} status-icon"></i>${data[i].status}
                                        </span>
                                    </td>
                                    <td>`;
                            
                            if (data[i].status !== 'Rejected') {
                                table += `
                                    <button class="btn btn-withdraw withdraw-btn" 
                                            data-apply-date="${data[i].apply_date}">
                                        <i class="fas fa-undo"></i> Withdraw
                                    </button>`;
                            } else {
                                table += `<span class="text-muted">No action</span>`;
                            }
                            
                            table += `</td></tr>`;
                        }
                        
                        table += `</tbody></table></div></div>`;
                        $("#pending-list").html(table);
                    } 
                }
            });
        }
        
        function loadLeaveHistory() {
            $.ajax({
                url: "leave_history.php",
                method: "POST",
                success: function(data) {
                    if (data !== "False") {
                        data = JSON.parse(data);
                        let historyHTML = `
                            <div class="history-card">
                                <div class="history-card-header">
                                    <h4><i class="fas fa-history me-2"></i>Leave History</h4>
                                </div>`;
                        
                        for (let i = 0; i < data.length; i++) {
                            let statusClass = '';
                            let statusIcon = '';
                            
                            if (data[i].status === 'Pending') {
                                statusClass = 'status-pending';
                                statusIcon = 'fa-hourglass-half';
                            } else if (data[i].status === 'Approved') {
                                statusClass = 'status-approved';
                                statusIcon = 'fa-check-circle';
                            } else {
                                statusClass = 'status-rejected';
                                statusIcon = 'fa-times-circle';
                            }
                            
                            historyHTML += `
                                <div class="history-item">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="history-date">
                                            <i class="fas fa-calendar-day me-2"></i>${data[i].apply_date}
                                        </div>
                                        <span class="status-badge ${statusClass}">
                                            <i class="fas ${statusIcon} status-icon"></i>${data[i].status}
                                        </span>
                                    </div>
                                    <div class="history-period">
                                        <i class="fas fa-calendar-week me-2"></i>${data[i].leave_days}
                                    </div>
                                    <div class="history-destination">
                                        <i class="fas fa-map-marker-alt me-2"></i>${data[i].destination}
                                    </div>
                                    <div class="history-reason">
                                        <i class="fas fa-comment me-2"></i>${data[i].reason}
                                    </div>
                                </div>`;
                        }
                        
                        historyHTML += `</div>`;
                        $("#history-content").html(historyHTML);
                    } else {
                        $("#history-content").html(`
                            <div class="alert alert-info text-center">
                                <i class="fas fa-info-circle me-2"></i>No leave history found
                            </div>
                        `);
                    }
                }
            });
        }
        
        function withdrawLeave(apply_date) {
            $.ajax({
                url: "leave_withdraw.php",
                method: "POST",
                data: { "apply_date": apply_date },
                success: function(data) {
                    loadPendingLeaves();
                    // Show success toast/alert
                    showAlert('Leave application withdrawn successfully', 'success');
                },
                error: function() {
                    // Show error toast/alert
                    showAlert('Error withdrawing application', 'danger');
                }
            });
        }
        
        function showAlert(message, type) {
            let alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            let alertHTML = `
                <div class="alert ${alertClass} alert-dismissible fade show  bottom-0 end-0 m-3" role="alert" style="z-index: 1000;">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            
            $('body').append(alertHTML);
            
            // Auto dismiss after 3 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 3000);
        }
        
        // Tab change event
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            if (e.target.id === 'history-tab') {
                loadLeaveHistory();
            }
        });
    </script>
</body>
</html>
<?php
if (isset($_POST['apply'])) {
    require_once "../Database/student_db_function.php";
    $sic = $_SESSION['sic'];
    date_default_timezone_set('Asia/Kolkata');
    $apply_date = date('d-m-Y H:i:s A');
    $leave_days = $_POST['from_date'] . " " . $_POST['from_time'] . " " . "TO" . " " . $_POST['to_date'] . " " . $_POST['to_time'];
    $destination = $_POST['destination'];
    $contact_no = $_POST['contact_no'];
    $reason = $_POST['reason'];
    $res = apply_leave($sic, $apply_date, $leave_days, $destination, $contact_no, $reason, "Pending");
    if ($res) {
        echo "<script>loadPendingLeaves(); showAlert('Leave application submitted successfully', 'success');</script>";
    }
}
?>
<?php
} else {
    header("Location: login.php");
    exit();
}
?>