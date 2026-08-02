<script src="../Jquery/jquery-3.7.1.js"></script>
<link href="../Bootstrap/css/bootstrap-icons.css" rel="stylesheet">
<?php
session_start();
if (isset($_SESSION['email'])) {
    include "admin_navbar.html";
    $current_file = basename(__FILE__);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notice Management</title>
    <style>
        :root {
            --industrial-primary: #2c3e50;
            --industrial-secondary: #34495e;
            --industrial-accent: #e74c3c;
            --industrial-light: #ecf0f1;
            --industrial-dark: #1a252f;
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

        .form-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 2rem;
            border-top: 4px solid var(--industrial-accent);
        }

        .notice-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 2rem;
            border-top: 4px solid var(--industrial-primary);
        }

        .section-title {
            color: var(--industrial-primary);
            font-weight: 600;
            border-bottom: 2px solid var(--industrial-accent);
            padding-bottom: 8px;
            margin-bottom: 1.5rem;
            display: inline-block;
        }

        .form-label {
            font-weight: 500;
            color: var(--industrial-secondary);
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px 15px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--industrial-primary);
            box-shadow: 0 0 0 0.25rem rgba(44, 62, 80, 0.15);
        }

        .btn-primary {
            background-color: var(--industrial-primary);
            border: none;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: var(--industrial-secondary);
            transform: translateY(-2px);
        }

        #msg {
            font-size: 0.9rem;
            padding: 10px;
            border-radius: 4px;
            margin-top: 1rem;
        }

        .notice-table {
            width: 100%;
            border-collapse: collapse;
        }

        .notice-table th {
            background-color: var(--industrial-primary);
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 500;
        }

        .notice-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .notice-table tr:hover {
            background-color: rgba(44, 62, 80, 0.05);
        }

        .file-link {
            color: var(--industrial-primary);
            text-decoration: none;
            font-weight: 500;
        }

        .file-link:hover {
            color: var(--industrial-accent);
            text-decoration: underline;
        }

        .bi {
            margin-right: 8px;
        }

        @media (max-width: 768px) {
            #main-content {
                margin-left: 0;
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <?php include "admin_sidebar.php"; ?>
        <div id="main-content" class="container-fluid">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="form-container">
                        <h4 class="section-title"><i class="bi bi-pencil-square"></i> Add Notice</h4>
                        <form class="form" action="" method="post" enctype="multipart/form-data" id="form">
                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-card-text"></i> Notice Title:</label>
                                <input type="text" class="form-control" name="notice_title" placeholder="Enter Notice Title" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-calendar-event"></i> Notice Date:</label>
                                <input type="date" class="form-control" name="notice_date" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-file-text"></i> Notice Description:</label>
                                <textarea name="notice_description" rows="5" class="form-control" placeholder="Enter description..." required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"><i class="bi bi-upload"></i> Upload File (Optional):</label>
                                <input type="file" class="form-control" name="notice_file">
                            </div>
                            <input type="submit" class="btn btn-primary w-100" name="submit" value="Submit Notice" />
                        </form>
                        <p id="msg" class="text-center my-3 fw-bold"></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="notice-container">
                        <h4 class="section-title"><i class="bi bi-megaphone"></i> Recent Notices</h4>
                        <div id="notice">
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
$("document").ready(function() {
    $.ajax({
        url: "display_notice.php",
        method: "GET",
        success: function(data) {
            if (data !== "false") {
                data = JSON.parse(data);
                let table = `<div class="table-responsive">
                                <table class="notice-table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Declare Date</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>
                                    <tbody>`;
                for (let i = 0; i < data.length; i++) {
                    let fileLink = (data[i].notice_file && data[i].notice_file !== "") ?
                        `<a href="../Notice files/${data[i].notice_file}" class="file-link" download>
                            <i class="bi bi-download"></i> ${data[i].notice_file}
                        </a>` : '<span class="text-muted">No file</span>';
                    table += `<tr>
                                <td>${data[i].notice_title}</td>
                                <td>${data[i].notice_date}</td>
                                <td>${fileLink}</td>
                              </tr>`;
                }
                table += `</tbody></table></div>`;
                $("#notice").html(table);
            } else {
                $("#notice").html('<div class="alert alert-info">No notices available</div>');
            }
        },
        error: function() {
            $("#notice").html('<div class="alert alert-danger">Failed to load notices</div>');
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

if (isset($_POST['submit'])) {
    $notice_title = $_POST['notice_title'];
    $notice_date = $_POST['notice_date'];
    $notice_description = $_POST['notice_description'];
    $notice_file = $_FILES['notice_file'];

    if ($notice_file['size'] > 0) {
        $upload_path = "../Notice files/" . $notice_file['name'];
        if (move_uploaded_file($notice_file['tmp_name'], $upload_path)) {
            require_once "../Database/admin_db_functions.php";
            $res = addNotice($notice_title, $notice_date, $notice_description, $notice_file['name']);
            echo $res ? "<script>document.querySelector('#msg').innerHTML = 'Notice uploaded successfully'; document.querySelector('#msg').style.color = 'green';</script>" :
                        "<script>document.querySelector('#msg').innerHTML = 'Error: Notice not uploaded'; document.querySelector('#msg').style.color = 'red';</script>";
        }
    } else {
        require_once "../Database/admin_db_functions.php";
        $res = addNotice($notice_title, $notice_date, $notice_description);
        echo $res ? "<script>document.querySelector('#msg').innerHTML = 'Notice uploaded without file'; document.querySelector('#msg').style.color = 'green';</script>" :
                    "<script>document.querySelector('#msg').innerHTML = 'Error: Notice not uploaded'; document.querySelector('#msg').style.color = 'red';</script>";
    }
}
?>
