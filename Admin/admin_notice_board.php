<!-- <style>
    .container {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
    }  
</style> -->
<script src="../Jquery/jquery-3.7.1.js"></script>
<?php
session_start();
if (isset($_SESSION['email'])) {
    include "admin_navbar.html";
    $current_file = basename(__FILE__);
?>
    <div class="d-flex">
        <?php
        include "admin_sidebar.php";
        ?>
        <div id="main-content" class="container">
            <div class="row">
                <div class="p-2 col-md-6">
                    <h4 class="text-center mb-4"><i class="bi bi-pencil-square"></i> Add Notice</h4>
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
                <div class="p-2 col-md-6" id="notice">
                    <h4 class="text-center">Recent Notice</h4>
                    <script>
                        $("document").ready(function() {
                            $.ajax({
                                url: "display_notice.php",
                                method: "GET",
                                success: function(data) {

                                    if (data !== "false") {
                                        console.log(data)
                                        console.log(typeof(data))
                                        data = JSON.parse(data)
                                        console.log(data)
                                        console.log(typeof(data))
                                        let table = `<div class="table-responsive">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>Declare Date</th>
                                                                <th>File</th>
                                                            </tr>`
                                        for (let i = 0; i < data.length; i++) {
                                            table += `<tr>
                                                            <td>${data[i].notice_title}</td>
                                                            <td>${data[i].notice_date}</td>
                                                            <td>${data[i].notice_file}</td>
                                                        `
                                        }
                                        $("#notice").append(table)
                                    } else {
                                        $("#notice").append("Notice not Available")
                                    }
                                }
                            })
                        })
                    </script>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    header("Location: ../Authentication/login.html");
    exit(); // Always use exit() after header redirection
}
if (isset($_POST['submit'])) {
    $notice_title = $_POST['notice_title'];
    $notice_date = $_POST['notice_date'];
    $notice_description = $_POST['notice_description'];
    $notice_file = $_FILES['notice_file'];
    $upload_path = "../Notice files/" . $notice_file['name'];
    if (move_uploaded_file($notice_file['tmp_name'], $upload_path)) {
        require_once "../Database/admin_db_functions.php";
        $res = addNotice($notice_title, $notice_date, $notice_description, $notice_file['name']);
        if ($res) {
    ?>
            <script>
                document.querySelector("#msg").innerHTML = "Notice uploaded"
                document.querySelector("#msg").style.color = "green"
            </script>
        <?php
        } else {
        ?>
            <script>
                document.querySelector("#msg").innerHTML = "Notice not uploaded"
                document.querySelector("#msg").style.color = "red"
            </script>
        <?php
        }
    } else {
        require_once "../Database/admin_db_functions.php";
        $res = addNotice($notice_title, $notice_date, $notice_description);
        if ($res) {
        ?>
            <script>
                document.querySelector("#msg").innerHTML = "Notice uploaded"
                document.querySelector("#msg").style.color = "green"
            </script>
        <?php
        } else {
        ?>
            <script>
                document.querySelector("#msg").innerHTML = "Notice not uploaded"
                document.querySelector("#msg").style.color = "red"
            </script>
<?php
        }
    }
}
?>