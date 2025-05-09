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
    <title>Industrial Complaint System</title>
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
            padding: 2rem;
            width: 100%;
            background-color: var(--industrial-light);
        }
        
        .complaint-header {
            background-color: var(--industrial-primary);
            color: white;
            padding: 1rem;
            border-radius: 8px 8px 0 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-bottom: 3px solid var(--industrial-warning);
        }
        
        .complaint-header h4 {
            font-weight: 600;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .complaint-container {
            background-color: white;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
            overflow: hidden;
        }
        
        .complaint-tabs {
            background-color: var(--industrial-secondary);
            padding: 0;
            border-bottom: none;
        }
        
        .complaint-tab {
            color: white;
            border: none;
            border-radius: 0;
            padding: 1rem 1.5rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .complaint-tab:hover {
            color: var(--industrial-warning);
            background-color: rgba(243, 156, 18, 0.1);
        }
        
        .complaint-tab.active {
            color: var(--industrial-warning);
            background-color: var(--industrial-secondary);
            border-bottom: 3px solid var(--industrial-warning);
        }
        
        .complaint-form {
            padding: 1.5rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--industrial-secondary);
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border: 1px solid var(--industrial-secondary);
            border-radius: 4px;
            padding: 0.75rem 1rem;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--industrial-warning);
            box-shadow: 0 0 0 0.25rem rgba(243, 156, 18, 0.25);
        }
        
        textarea.form-control {
            min-height: 120px;
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
            color: white;
        }
        
        .btn-submit:hover {
            background-color: var(--industrial-secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
        
        /* Table Styles */
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
            margin-top: 1rem;
        }
        
        .table {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .table thead {
            background-color: var(--industrial-secondary);
            color: white;
            position: sticky;
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
        
        .download-link {
            color: var(--industrial-primary);
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
        }
        
        .download-link:hover {
            color: var(--industrial-warning);
            text-decoration: none;
        }
        
        .download-link i {
            margin-right: 5px;
        }
        
        /* Message Styles */
        #msg {
            font-weight: 500;
            text-align: center;
            margin: 1rem 0;
            padding: 0.5rem;
            border-radius: 4px;
        }
        
        .msg-success {
            background-color: rgba(39, 174, 96, 0.1);
            color: var(--industrial-success);
        }
        
        .msg-error {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--industrial-accent);
        }
        
        @media (max-width: 768px) {
            #main-content {
                padding: 1rem;
            }
            
            .complaint-tab {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }
            
            .complaint-form {
                padding: 1rem;
            }
            
            .table th, 
            .table td {
                padding: 0.75rem 0.5rem;
                font-size: 0.85rem;
            }
        }
        
        @media (max-width: 576px) {
            .complaint-tabs {
                flex-direction: column;
            }
            
            .complaint-tab {
                border-radius: 0;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <?php include_once "student_sidebar.php"; ?>
        <div id="main-content">
            <div class="complaint-header">
                <h4><i class="fas fa-exclamation-triangle me-2"></i>COMPLAINT MANAGEMENT SYSTEM</h4>
            </div>
            
            <div class="complaint-container">
                <ul class="nav complaint-tabs" id="complaintTabs">
                    <li class="nav-item">
                        <a class="nav-link complaint-tab active" id="application-tab" data-bs-toggle="tab" href="#application">
                            <i class="fas fa-file-alt me-2"></i>NEW COMPLAINT
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link complaint-tab" id="history-tab" data-bs-toggle="tab" href="#history">
                            <i class="fas fa-history me-2"></i>COMPLAINT HISTORY
                        </a>
                    </li>
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="application">
                        <div id="pending-list" class="p-3"></div>
                        
                        <div class="complaint-form">
                            <form action="" id="complaint-form" method="post" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">COMPLAINT TYPE:</label>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <select name="complaint_type" id="complaint-type" class="form-select" required>
                                            <option value="" disabled selected>Select Complaint Type</option>
                                            <option value="room">Room Related</option>
                                            <option value="cleanliness">Cleanliness</option>
                                            <option value="plumbing">Plumbing Issues</option>
                                            <option value="electrical">Electrical Problems</option>
                                            <option value="discipline">Discipline Issues</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">DESCRIPTION:</label>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <textarea name="complaint_description" id="complaint-description" 
                                                  class="form-control" required></textarea>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">ATTACHMENT:</label>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="file" id="file" name="file" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" name="submit_complaint" class="btn btn-submit">
                                        <i class="fas fa-paper-plane me-2"></i>SUBMIT COMPLAINT
                                    </button>
                                </div>
                                
                                <p id="msg" class="text-center"></p>
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
        document.addEventListener("DOMContentLoaded", function() {
            // Load pending complaints
            loadPendingComplaints();
            
            // Tab switching
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                if (e.target.id === 'history-tab') {
                    complaintHistory();
                }
            });
        });

        function loadPendingComplaints() {
            $.ajax({
                url: "pending_complaint.php",
                method: "GET",
                success: function(data) {
                    if (data !== "False") {
                        data = JSON.parse(data);
                        let table = `
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>COMPLAINT TYPE</th>
                                            <th>DESCRIPTION</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>`;
                        
                        for (let i = 0; i < data.length; i++) {
                            table += `
                                <tr>
                                    <td>${data[i].complaint_type}</td>
                                    <td>${data[i].complaint_description}</td>
                                    <td>
                                        <span class="status-badge status-pending">
                                            <i class="fas fa-hourglass-half status-icon"></i>${data[i].status}
                                        </span>
                                    </td>
                                </tr>`;
                        }
                        
                        table += `</tbody></table></div>`;
                        $("#pending-list").html(table);
                    }
                }
            });
        }

        function complaintHistory() {
            $.ajax({
                url: "complaint_history.php",
                method: "POST",
                success: function(data) {
                    if (data !== "False") {
                        data = JSON.parse(data);
                        let table = `
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th><i class="fas fa-hashtag"></i> SNO</th>
                                            <th><i class="fas fa-exclamation-circle"></i> TYPE</th>
                                            <th><i class="fas fa-file-alt"></i> DESCRIPTION</th>
                                            <th><i class="fas fa-calendar-alt"></i> DATE</th>
                                            <th><i class="fas fa-paperclip"></i> FILE</th>
                                            <th><i class="fas fa-hourglass-half"></i> STATUS</th>
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
                                    <td>${i+1}</td>
                                    <td>${data[i].complaint_type}</td>
                                    <td>${data[i].complaint_description}</td>
                                    <td>${data[i].apply_date}</td>
                                    <td>
                                        ${(data[i].file === 'empty') ? 
                                            'No File' : 
                                            `<a href="../Complaint files/${data[i].file}" target="_blank" class="download-link">
                                                <i class="fas fa-download"></i> Download
                                            </a>`
                                        }
                                    </td>
                                    <td>
                                        <span class="status-badge ${statusClass}">
                                            <i class="fas ${statusIcon} status-icon"></i>${data[i].status}
                                        </span>
                                    </td>
                                </tr>`;
                        }
                        
                        table += `</tbody></table></div>`;
                        $("#history-content").html(table);
                    }
                }
            });
        }
    </script>
</body>
</html>
<?php
if (isset($_POST['submit_complaint'])) {
    date_default_timezone_set('Asia/Kolkata');
    $apply_date = date('d-m-Y H:i:s A');
    $sic = $_SESSION['sic'];
    $complaint_type = $_POST['complaint_type'];
    $complaint_description = $_POST['complaint_description'];
    $status = "Pending";
    $file = $_FILES['file'];
    $upload_path = "../Complaint files/" . $file['name'];
    
    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        require_once '../Database/student_db_function.php';
        $res = addComplaint($sic, $complaint_type, $complaint_description, $file['name'], $status, $apply_date);
        if ($res) {
            echo "<script>
                document.querySelector('#msg').innerHTML = 'Complaint Registered Successfully';
                document.querySelector('#msg').className = 'msg-success';
                loadPendingComplaints();
            </script>";
        } else {
            echo "<script>
                document.querySelector('#msg').innerHTML = 'Error: Please Try Again';
                document.querySelector('#msg').className = 'msg-error';
            </script>";
        }
    } else {
        require_once '../Database/student_db_function.php';
        $file = 'empty';
        $res = addComplaint($sic, $complaint_type, $complaint_description, $file, $status, $apply_date);
        if ($res) {
            echo "<script>
                document.querySelector('#msg').innerHTML = 'Complaint Registered Successfully';
                document.querySelector('#msg').className = 'msg-success';
                loadPendingComplaints();
            </script>";
        } else {
            echo "<script>
                document.querySelector('#msg').innerHTML = 'Error: Please Try Again';
                document.querySelector('#msg').className = 'msg-error';
            </script>";
        }
    }
}
} else {
    header("location:student_login.php");
}
?>