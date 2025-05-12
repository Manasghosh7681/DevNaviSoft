
<?php
session_start();
if ($_SESSION['email']) {
    include "./admin_navbar.html";
    $current_file = basename(__FILE__);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industrial Complaint Management</title>
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

        .complaint-table {
            width: 100%;
            border-collapse: collapse;
        }

        .complaint-table thead {
            background-color: var(--industrial-secondary);
            color: white;
        }

        .complaint-table th {
            padding: 15px;
            text-align: center;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .complaint-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .complaint-table tr:nth-child(even) {
            background-color: rgba(44, 62, 80, 0.03);
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
    </style>
</head>
<body>
<div class="d-flex">
    <?php include "./admin_sidebar.php" ?>
    <div id="main-content" class="container-fluid">
        <div class="table-container">
            <div class="table-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h2><i class="fas fa-clipboard-list fa-icon"></i> Pending Complaint Requests</h2>
                        <span class="ms-5"><a href="all_complaint.php" class="btn text-white fs-4">History</a></span>
                    </div>
            </div>
            <?php
            require_once "../Database/admin_db_functions.php";
            $res = displayAllPendingComplaint();
            if ($res && $res->num_rows > 0) {
            ?>
            <div class="table-responsive">
                <table class="complaint-table">
                    <thead>
                    <tr>
                        <th><i class="fas fa-id-card"></i> SIC</th>
                        <th><i class="fas fa-exclamation-circle"></i> Complaint Type</th>
                        <th><i class="fas fa-file-alt"></i> Description</th>
                        <th><i class="fas fa-paperclip"></i> File</th>
                        <th><i class="fas fa-tasks"></i> Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($data = $res->fetch_assoc()) { ?>
                        <tr>
                            <td class="sic"><?php echo htmlspecialchars($data['sic']); ?></td>
                            <td><?php echo htmlspecialchars($data['complaint_type']); ?></td>
                            <td><?php echo htmlspecialchars($data['complaint_description']); ?></td>
                            <td>
                                <?php if ($data['file'] === "empty") {
                                    echo "No File";
                                } else { ?>
                                    <a href="../Complaint files/<?php echo $data['file'] ?>" target="_blank">
                                        <i class="fas fa-download"></i> Download</a>
                                <?php } ?>
                            </td>
                            <td>
                                <button class="btn-approve approve" data-approve="<?php echo $data['apply_date'] ?>">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                                <button class="btn-reject reject" data-reject="<?php echo $data['apply_date'] ?>">
                                    <i class="fas fa-times"></i> Reject
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php } else { ?>
                <div class="text-center p-5">
                    <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No Pending Complaint Requests</h4>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<script src="../Jquery/jquery-3.7.1.js"></script>
<script>
    $(document).on("click", ".approve", function () {
        let apply_date = $(this).data("approve");
        let status = "Approve";
        let row = $(this).closest("tr");
        let sic = row.find(".sic").text();
        $.ajax({
            url: "admin_complaint_approval.php",
            method: "POST",
            data: {
                "sic": sic,
                "apply_date": apply_date,
                "status": status
            },
            success: function () {}
        })
        window.location = "admin_complaint.php";
    });

    $(document).on("click", ".reject", function () {
        let apply_date = $(this).data("reject");
        let status = "Reject";
        let row = $(this).closest("tr");
        let sic = row.find(".sic").text();
        $.ajax({
            url: "admin_complaint_approval.php",
            method: "POST",
            data: {
                "sic": sic,
                "apply_date": apply_date,
                "status": status
            },
            success: function () {}
        })
        window.location = "admin_complaint.php";
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
