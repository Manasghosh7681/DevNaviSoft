<?php
session_start();
if (isset($_SESSION['email'])) {
    $current_file = basename(__FILE__);
    include "admin_navbar.html";
    ?>
    <div class="d-flex">
        <?php include_once "admin_sidebar.php"; ?>
        <div id="main-content">
            <!-- Flash Messages -->
            <?php
            if (isset($_SESSION['message'])) {
                echo '<div class="alert alert-success">'.$_SESSION['message'].'</div>';
                unset($_SESSION['message']);
            }

            if (isset($_SESSION['warning'])) {
                echo '<div class="alert alert-warning">'.$_SESSION['warning'].'</div>';
                unset($_SESSION['warning']);
            }

            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
                unset($_SESSION['error']);
            }
            ?>

            <!-- Auto Allocate Button -->
            <div class="text-center mb-4">
                <form action="auto_allocate_room.php" method="post">
                    <button type="submit" class="btn btn-primary">Auto Allocate Rooms</button>
                </form>
            </div>

            <!-- Send Emails Button -->
            <div class="text-center mb-4" id="email-control-section" style="display: none;">
                <button id="send-emails-btn" class="btn btn-success">
                    <i class="fas fa-paper-plane"></i> Send Allocation Emails
                </button>
                <div id="email-status" class="mt-2 small"></div>
            </div>

            <!-- Student Records -->
            <div class="my-3 d-flex justify-content-between">
                <h2 style="color:rgb(152, 136, 13)">Students Records</h2>
                <input type="text" id="searchInput" class="form-control w-50 w-md-25" placeholder="Search students...">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>SIC</th>
                            <th>Name</th>
                            <th>Branch</th>
                            <th>Year</th>
                            <th>Gender</th>
                            <th>Preference</th>
                            <th>Add</th>
                        </tr>
                    </thead>
                    <tbody id="studentData"></tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <nav><ul class="pagination" id="pagination"></ul></nav>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            $('#email-status').html('<div class="text-info"><i class="fas fa-spinner fa-spin"></i> Processing emails...</div>');

            $.ajax({
                url: 'process_email_queue.php',
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#email-status').html('<div class="text-success"><i class="fas fa-check"></i> ' + response.message + '</div>');
                        checkPendingEmails();
                    } else {
                        $('#email-status').html('<div class="text-danger"><i class="fas fa-times"></i> ' + response.message + '</div>');
                    }
                    $btn.prop('disabled', false);
                },
                error: function() {
                    $('#email-status').html('<div class="text-danger"><i class="fas fa-times"></i> Error connecting to server</div>');
                    $btn.prop('disabled', false);
                }
            });
        });

        // Check Pending Emails
        function checkPendingEmails() {
           
            $.get('check_pending_emails.php', function(response) {
                if (response.count>0) {
                    console.log("pending");
                    $('#email-control-section').show();
                    $('#email-status').html('<div class="text-muted">' + response.count + ' pending emails</div>');
                } else {
                    $('#email-control-section').hide();
                }
            }, 'json');
        }
    });
    </script>

    <!-- FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <?php
} else {
    header("Location: ../Authentication/login.html");
    exit();
}
?>
