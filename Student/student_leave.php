<?php
session_start();
if (isset($_SESSION['sic'])) {
    include "student_navbar.html";
    $current_file = basename(__FILE__);
?>
    <div class="d-flex">
        <?php include "student_sidebar.php"; ?>
        <div id="main-content" class="container">
            <h3 class="shadow p-2">Leave Workways</h3>
            <div class="shadow mt-4 rounded-2">
                <div class="border-bottom p-2">
                    <a href="#" class="text-decoration-none text-dark p-2 border-end" id="application">Applications</a>
                    <a href="#" class="text-decoration-none p-2" id="history">History</a>
                </div>
                <div id="application-content">
                    <div id="pending-list" class="mt-2"></div>
                    <div class="modal-body p-2">
                        <form class="form" action="" method="post" id="leave-form">
                            <div class="mb-1">
                                <h5 class="text-center">Leave From</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-1">
                                        <label class="form-label">Date :</label>
                                        <input type="date" id="from-date" class="form-control" placeholder="Eg: 14-02-2025" name="from_date" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Time :</label>
                                        <input type="time" id="from-time" class="form-control" placeholder="Eg:12:00" name="from_time" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-1">
                                <h5 class="text-center">Leave To</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-1">
                                        <label class="form-label">Date :</label>
                                        <input type="date" id="to-date" class="form-control" placeholder="Eg: 14-02-2025" name="to_date" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Time :</label>
                                        <input type="time" id="to-date" class="form-control" placeholder="Eg:12:00" name="to_time" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">Destination:</label>
                                    <input type="text" class="form-control border border-1" name="destination" required>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="form-label">Contact no:</label>
                                    <input type="tel" id="contact_no" class="form-control" name="contact_no" required>
                                    <p class="text-danger" id="contact-error"></p>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label">Reason:</label>
                                <textarea class="form-control" id="reason" name="reason" required></textarea>
                                <p class="text-danger" id="reason-error"></p>
                            </div>
                            <p class="text-danger text-center">* All Fields are Mandatory</p>
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary" value="Apply" name="apply">
                            </div>
                        </form>
                    </div>
                </div>
                <div id="history-content">
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<script src="../Jquery/jquery-3.7.1.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        let application = document.querySelector("#application");
        let history = document.querySelector("#history");
        let applicationContent = document.querySelector("#application-content")
        let historyContent = document.querySelector("#history-content")

        application.style.borderBottom = "2px solid blue";

        application.addEventListener("click", function() {
            application.style.borderBottom = "2px solid blue";
            history.style.borderBottom = "none";
            history.style.color = "blue"

            $("#application-content").show()
            $("#history-content").hide()
        });

        history.addEventListener("click", function() {
            history.style.borderBottom = "2px solid blue";
            application.style.borderBottom = "none";
            history.style.color = "black"
            $("#application-content").hide()
            $("#history-content").show()
            leaveHistory()
        });
    });

    $(document).ready(() => {
        $.ajax({
            url: "pending_leave.php",
            method: "GET",
            success: function(data) {
                if (data !== "False") {
                    data = JSON.parse(data)
                    let table = `<div class='table-responsive'>
                                    <table class='table table-bordered table-hover text-center'>
                                        <tr class="table-dark">
                                            <th>Apply Date</th>
                                            <th>Leaving Days</th>
                                            <th>Status</th>
                                        </tr>`
                    for (let i = 0; i < data.length; i++) {
                        table += `<tr>
                                    <td>${data[i].apply_date}</td>
                                    <td>${data[i].leave_days}</td>
                                    <td class="${(data[i].status === 'Rejected')? 'text-danger' : 'text-success' }">
                                        ${data[i].status}
                                        ${
                                            (data[i].status !== 'Rejected')?
                                                `<button class='btn btn-info text-light withdraw-btn' data-apply-date="${data[i].apply_date}">Withdraw</button>`: ''
                                        }
                                        
                                    </td>
                                </tr>`
                    }
                    table += `</table>
                    </div>`
                    $("#pending-list").html(table)
                }
            }
        })
    })
    $(document).on("click", ".withdraw-btn", function() {
        let apply_date = $(this).data("apply-date"); // Retrieves the apply_date value
        if (confirm("Are you sure to withdraw")) {
            withdraw(apply_date); // Calls the withdraw function with the retrieved date
            window.location = "student_leave.php"
        }
    });

    function withdraw(apply_date) {
        $.ajax({
            url: "leave_withdraw.php",
            method: "POST",
            data: {
                "apply_date": apply_date
            },
            success: function(data) {

            }
        })
    }

    function leaveHistory() {
        $.ajax({
            url: "leave_history.php",
            method: "POST",
            success: function(data) {
                if (data !== "False") {
                    data = JSON.parse(data)
                    let table = `<div class='table-responsive'>
                                    <table class='table table-bordered text-center mt-4'>
                                        <thead class='table-dark'>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Apply Date</th>
                                                <th>Leave Date</th>
                                                <th>Destination</th>
                                                <th>Reason</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>`
                                        for (let i = 0; i < data.length; i++) {
                        table += `<tr>
                                    <td>${i+1}</td>
                                    <td>${data[i].apply_date}</td>
                                    <td>${data[i].leave_days}</td>
                                    <td>${data[i].destination}</td>
                                    <td>${data[i].reason}</td>
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
    document.querySelector("#from-date").addEventListener('click', () => {
        document.querySelector("#from-date").setAttribute('min', new Date().toLocaleDateString('en-CA'))
    })
    document.querySelector("#from-date").addEventListener('change', () => {
        let fromDate = document.querySelector("#from-date").value
        document.querySelector("#to-date").setAttribute('min', fromDate)
    })
    $("#leave-form").submit((e) => {
        let contact_no = $("#contact_no").val()
        let reason = $("#reason").val()
        let error = false
        if (!contact_no.match(/^[6-9]{1}[0-9]{9}$/) || contact_no.length !== 10) {
            error = true
            document.querySelector("#contact-error").innerHTML = "Please give valid Mobile No."
        } else if (reason.length < 16) {
            error = true
            document.querySelector("#reason-error").innerHTML = "Reason must be contains atleast 16 letters"
        }
        if (error) {
            e.preventDefault()
        }
    })
</script>
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
        // echo "<h4>Leave Applied</h4>";
    }
}
?>