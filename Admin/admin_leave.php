
<?php
session_start();
if (isset($_SESSION['email'])) {
    include "./admin_navbar.html";
    $current_file = basename(__FILE__);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industrial Leave Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --industrial-primary: #2c3e50;
            --industrial-secondary: #34495e;
            --industrial-accent: #e74c3c;
            --industrial-light: #ecf0f1;
            --industrial-dark: #1a252f;
            --industrial-success: #27ae60;
            --industrial-warning: #f39c12;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: var(--industrial-dark);
        }
        
        #main-content {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-left: 220px;
            flex-grow: 1;
        }
        
        .table-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            overflow: hidden;
            border-top: 4px solid var(--industrial-primary);
        }
        
        .table-header {
            background-color: var(--industrial-primary);
            color: white;
            padding: 1rem;
        }
        
        .table-header h2 {
            margin: 0;
            font-weight: 600;
        }
        
        .leave-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .leave-table thead {
            background-color: var(--industrial-secondary);
            color: white;
        }
        
        .leave-table th {
            padding: 15px;
            text-align: center;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        .leave-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .leave-table tr:nth-child(even) {
            background-color: rgba(44, 62, 80, 0.03);
        }
        
        .leave-table tr:hover {
            background-color: rgba(44, 62, 80, 0.05);
        }
        
        .btn-approve {
            background-color: var(--industrial-success);
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            color: white;
            font-weight: 500;
            transition: all 0.3s;
            margin-right: 5px;
        }
        
        .btn-approve:hover {
            background-color: #219653;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .btn-reject {
            background-color: var(--industrial-accent);
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            color: white;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-reject:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .no-requests-container {
            padding: 3rem;
            text-align: center;
            background-color: rgba(236, 240, 241, 0.5);
            border-radius: 8px;
            margin: 2rem 0;
            border: 2px dashed var(--industrial-secondary);
        }
        
        .no-requests-icon {
            font-size: 4rem;
            color: var(--industrial-secondary);
            margin-bottom: 1.5rem;
            opacity: 0.7;
        }
        
        .no-requests-text {
            color: var(--industrial-secondary);
            font-size: 1.5rem;
            font-weight: 500;
            margin-top: 1rem;
        }
        
        .no-requests-subtext {
            color: var(--industrial-secondary);
            opacity: 0.8;
            margin-top: 0.5rem;
        }
        
        .status-pending {
            display: inline-block;
            padding: 5px 10px;
            background-color: rgba(243, 156, 18, 0.2);
            color: var(--industrial-warning);
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1100;
        }
        
        .toast {
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .toast-success {
            background-color: var(--industrial-success);
            color: white;
        }
        
        .toast-error {
            background-color: var(--industrial-accent);
            color: white;
        }
        
        .confirmation-modal .modal-header {
            background-color: var(--industrial-primary);
            color: white;
        }
        
        .confirmation-modal .modal-footer .btn-confirm {
            background-color: var(--industrial-success);
            color: white;
        }
        
        .confirmation-modal .modal-footer .btn-cancel {
            background-color: var(--industrial-accent);
            color: white;
        }
        
        .fa-icon {
            margin-right: 8px;
        }
        
        @media (max-width: 768px) {
            #main-content {
                margin-left: 0;
                padding: 1rem;
            }
            
            .leave-table {
                display: block;
                overflow-x: auto;
            }
            
            .toast-container {
                width: 90%;
                left: 5%;
                right: 5%;
                top: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="toast-container"></div>
    <div class="modal fade confirmation-modal" id="confirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Confirm Action</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">Are you sure you want to perform this action?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-confirm" id="confirmAction">Confirm</button>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex">
        <?php include "./admin_sidebar.php" ?>
        <div id="main-content" class="container-fluid">
            <div class="table-container">
                <div class="table-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2><i class="fas fa-clipboard-list fa-icon"></i>Pending Leave Requests</h2>
                        <span class="ms-5"><a href="all_leave.php" class="btn text-white fs-4">History</a></span>
                    </div>
                </div>
                <?php 
                require_once "../Database/admin_db_functions.php";
                $res = displayAllPendingLeave();
                if ($res && $res->num_rows > 0) { 
                ?>
                    <div class="table-responsive">
                        <table class="leave-table">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-id-card fa-icon"></i>SIC</th>
                                    <th><i class="fas fa-calendar-alt fa-icon"></i>Apply Date</th>
                                    <th><i class="fas fa-moon fa-icon"></i>Leave Days</th>
                                    <th><i class="fas fa-comment-dots fa-icon"></i>Reason</th>
                                    <th><i class="fas fa-hourglass-half fa-icon"></i>Status</th>
                                    <th><i class="fas fa-tasks fa-icon"></i>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data = $res->fetch_assoc()) { ?>
                                    <tr>
                                        <td class="sic"><?php echo htmlspecialchars($data['sic']) ?></td>
                                        <td class="apply-date"><?php echo htmlspecialchars($data['apply_date']) ?></td>
                                        <td><?php echo htmlspecialchars($data['leave_days']) ?></td>
                                        <td><?php echo htmlspecialchars($data['reason']) ?></td>
                                        <td><span class="status-pending">Pending</span></td>
                                        <td >
                                            <div class="d-flex align-items-center justify-content-center" >
                                                <button class="btn-approve approve" 
                                                    data-sic="<?php echo htmlspecialchars($data['sic']) ?>"
                                                    data-apply-date="<?php echo htmlspecialchars($data['apply_date']) ?>">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                            <button class="btn-reject reject" 
                                                    data-sic="<?php echo htmlspecialchars($data['sic']) ?>"
                                                    data-apply-date="<?php echo htmlspecialchars($data['apply_date']) ?>">
                                                <i class="fas fa-times"></i> Reject
                                            </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="no-requests-container">
                        <i class="fas fa-clipboard-list no-requests-icon"></i>
                        <div class="no-requests-text">No Pending Leave Requests</div>
                        <div class="no-requests-subtext">All requests have been processed</div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script src="../Jquery/jquery-3.7.1.js"></script>
    <script>
    // Function to show toast notification
    function showToast(message, type = 'success') {
        const toastContainer = $('.toast-container');
        const toastId = 'toast-' + Date.now();
        
        const toast = $(`
            <div class="toast align-items-center toast-${type} border-0 show" role="alert" aria-live="assertive" aria-atomic="true" id="${toastId}">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} me-2"></i>
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `);
        
        toastContainer.append(toast);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            $('#' + toastId).remove();
        }, 5000);
    }

    $(document).on("click", ".approve", function () {
        console.log("approve click");
        let apply_date = $(this).data("apply-date");
        let sic = $(this).data("sic");
        console.log(sic,"apply date");
        let row = $(this).closest("tr");
        
        $.ajax({
            url: "admin_leave_approval.php",
            method: "POST",
            data: {
                "sic": sic,
                "apply_date": apply_date,
                "status": "Approved"
            },
            success: function (data) {
                console.log(data,"data");
                showToast("Leave request approved successfully");
                row.fadeOut(300, function() {
                    $(this).remove();
                    // Check if table is empty now
                    if ($('tbody tr').length === 0) {
                        $('tbody').html(`
                            <tr><td colspan="6" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x mb-3" style="color: var(--industrial-secondary);"></i>
                                <h4>No Pending Leave Requests</h4>
                                <p class="text-muted">All requests have been processed</p>
                            </td></tr>
                        `);
                    }
                });
                setTimeout(() => {
                    window.location.reload(true); // Force refresh to update student side
                }, 1000);
            },
            error: function() {
                showToast("Error approving leave request", "error");
            }
        });
    });
    
    $(document).on("click", ".reject", function () {
        let apply_date = $(this).data("apply-date");
        let sic = $(this).data("sic");
        let row = $(this).closest("tr");
        
        $.ajax({
            url: "admin_leave_approval.php",
            method: "POST",
            data: {
                "sic": sic,
                "apply_date": apply_date,
                "status": "Rejected"
            },
            success: function (data) {
                showToast("Leave request rejected successfully");
                row.fadeOut(300, function() {
                    $(this).remove();
                    // Check if table is empty now
                    if ($('tbody tr').length === 0) {
                        $('tbody').html(`
                            <tr><td colspan="6" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x mb-3" style="color: var(--industrial-secondary);"></i>
                                <h4>No Pending Leave Requests</h4>
                                <p class="text-muted">All requests have been processed</p>
                            </td></tr>
                        `);
                    }
                });
                setTimeout(() => {
                    window.location.reload(true); // Force refresh to update student side
                }, 1000);
            },
            error: function() {
                showToast("Error rejecting leave request", "error");
            }
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
