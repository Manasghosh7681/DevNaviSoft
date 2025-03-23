<?php
session_start();
if (isset($_SESSION['sic'])) {
    include "student_navbar.html";
    $current_file = basename(__FILE__);
    ?>
    <div class="d-flex">
        <?php include_once "student_sidebar.php"; ?>
        <div id="main-content">
            <h4 class="shadow p-2">Register Complaints</h4>
            <div class="shadow mt-4 rounded-2">
                <div class="border-bottom p-2">
                    <a href="#" class="text-decoration-none text-dark p-2 border-end" id="application">Applications</a>
                    <a href="#" class="text-decoration-none p-2" id="history">History</a>
                </div>
                <div id="application-content">
                    <div id="pending-list" class="mt-2"></div>
                    <div class="mpdal-body p-2">
                        <form action="" id="complaint-form" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-3 my-1">
                                    <label class="form-label">Complaint Type: </label>
                                </div>
                                <div class="col-md-6 my-1">
                                    <select name="complaint_type" id="complaint-type" class="form-control" required>
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
                            <div class="row">
                                <div class="col-md-3 my-1">
                                    <label class="form-label">Complaint Description: </label>
                                </div>
                                <div class="col-md-6 my-1">
                                    <textarea name="complaint_description" id="complaint-description" cols="30"
                                        class="text-decoration-none form-control" required></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3 my-1">
                                    <label class="form-label">File(if any): </label>
                                </div>
                                <div class="col-md-6 my-1">
                                    <input type="file" id="file" name="file" class="form-control">
                                </div>
                            </div>
                            <input type="submit" name="submit_complaint" class=" btn btn-primary d-flex mx-auto my-2"
                                value="Register">
                            <p id="msg" class="text-center fw-bold"></p>
                        </form>
                    </div>
                </div>
                <div id="history-content">
                </div>
            </div>
        </div>
    </div>

    <script src="../Jquery/jquery-3.7.1.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            let application = document.querySelector("#application");
            let history = document.querySelector("#history");
            let applicationContent = document.querySelector("#application-content")
            let historyContent = document.querySelector("#history-content")

            application.style.borderBottom = "2px solid blue";

            application.addEventListener("click", function () {
                application.style.borderBottom = "2px solid blue";
                history.style.borderBottom = "none";
                history.style.color = "blue"

                $("#application-content").show()
                $("#history-content").hide()
            });

            history.addEventListener("click", function () {
                history.style.borderBottom = "2px solid blue";
                application.style.borderBottom = "none";
                history.style.color = "black"
                $("#application-content").hide()
                $("#history-content").show()
                complaintHistory()
            });
        });


        $(document).ready(() => {
            $.ajax({
                url: "pending_complaint.php",
                method: "GET",
                success: function (data) {
                    if (data !== "False") {
                        data = JSON.parse(data)
                        let table = `<div class='table-responsive'>
                                    <table class='table table-bordered table-hover text-center'>
                                        <tr class="table-dark">
                                            <th>Complaint Type</th>
                                            <th>Complaint Description</th>
                                            <th>Status</th>
                                        </tr>`
                        for (let i = 0; i < data.length; i++) {
                            table += `
                            <tr>
                                <td>${data[i].complaint_type}</td>
                                <td>${data[i].complaint_description}</td>
                                <td class='text-info'>${data[i].status}</td>
                            </tr>
                        `
                        }
                        table += `</table>
                    </div>`
                        $("#pending-list").html(table)
                    }
                }
            })
        })

        function complaintHistory() {
        $.ajax({
            url: "complaint_history.php",
            method: "POST",
            success: function(data) {
                if (data !== "False") {
                    data = JSON.parse(data)
                    let table = `<div class='table-responsive'>
                                    <table class='table table-bordered table-hover text-center mt-4'>
                                        <thead class='table-dark'>
                                            <tr>
                                                <th><i class="fas fa-hashtag"></i> Sno</th>
                                                <th><i class="fas fa-exclamation-circle"></i> Complaint Type</th>
                                                <th><i class="fas fa-file-alt"></i> Complaint Description</th>
                                                <th><i class="fas fa-calendar-alt"></i> Apply Date</th>
                                                <th><i class="fas fa-paperclip"></i> File</th>
                                                <th><i class="fas fa-hourglass-half"></i> Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>`
                    for (let i = 0; i < data.length; i++) {
                        table += `<tr>
                                    <td>${i+1}</td>
                                    <td>${data[i].complaint_type}</td>
                                    <td>${data[i].complaint_description}</td>
                                    <td>${data[i].apply_date}</td>
                                    <td>
                                        ${
                                            (data[i].file === 'empty')? "No File" : `<a href="../Complaint files/${data[i].file}"><i class="fas fa-download"></i> Download</a>`
                                        }
                                    </td>
                                    <td class= '${
                                    (data[i].status === 'Pending')? "text-info": (data[i].status === 'Rejected')? "text-danger":"text-success"
                                    }'> ${data[i].status}
                                    </td>
                                </tr>`
                    }
                    table += `</tbody>
                            </table>
                        </div>`
                    $("#history-content").html(table)
                }
            }
        })
    }
    </script>
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
            $res = addComplaint($sic, $complaint_type, $complaint_description, $file['name'],$status,$apply_date);
            if ($res) {
                ?>
                <script>
                    document.querySelector('#msg').innerHTML = "Complaint Registered"
                    document.querySelector('#msg').style.color = "green"
                </script>
                <?php
            } else {
                ?>
                <script>
                    document.querySelector('#msg').innerHTML = "Try Again !"
                    document.querySelector('#msg').style.color = "red"
                </script>
                <?php
            }
        } else {
            require_once '../Database/student_db_function.php';
            $file = 'empty';
            $res = addComplaint($sic, $complaint_type, $complaint_description,$file,$status,$apply_date);
            if ($res) {
                ?>
                <script>
                    document.querySelector('#msg').innerHTML = "Complaint  Registered"
                    document.querySelector('#msg').style.color = 'green'
                </script>
                <?php
            } else {
                ?>
                <script>
                    document.querySelector('#msg').innerHTML = "Try Again !"
                    document.querySelector('#msg').style.color = "red"
                </script>
                <?php
            }
        }
    }
} else {
    header("location:student_login.php");
}
?>