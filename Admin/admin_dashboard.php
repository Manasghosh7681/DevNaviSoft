<?php
session_start();
// $_SESSION['email'] = "admin";
if (isset($_SESSION['email'])) {
    $current_file = basename(__FILE__);
    include "admin_navbar.html"
?>
    <div class="d-flex">
        <?php
        include_once "admin_sidebar.php";
        ?>
        <div id="main-content" class="container">
            <div class="row g-4 m-5">
                <div class="col-md-4 col-12">
                    <div class="info-box students">
                        <h4>Students</h4>
                        <i class="fa-solid fs-1 fa-user-graduate"></i>
                        <a href="students_record.php" class="btn">
                            <i class="fa-solid fa-arrow-right"></i> More info</a>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="info-box notice">
                        <h4>Notice</h4>
                        <i class="fa-solid fs-1 fa-bell"></i>
                        <a href="admin_notice_board.php" class="btn">
                            <i class="fa-solid fa-arrow-right"></i> More info</a>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="info-box leave">
                        <h4>Leave</h4>
                        <i class="fa-solid fs-1 fa-plane-departure"></i>
                        <a href="admin_leave.php" class="btn">
                            <i class="fa-solid fa-arrow-right"></i> More info</a>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="info-box complain">
                        <h4>Complain</h4>
                        <i class="fa-solid fs-1 fa-comments"></i>
                        <a href="admin_complaint.php" class="btn">
                            <i class="fa-solid fa-arrow-right"></i> More info</a>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="info-box rooms">
                        <h4>Rooms</h4>
                        <i class="fa-solid fs-1 fa-door-closed"></i>
                        <a href="rooms_record.php" class="btn">
                            <i class="fa-solid fa-arrow-right"></i> More info</a>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="info-box hostel">
                        <h4>Hostel</h4>
                        <i class="fa-solid fs-1 fa-building"></i>
                        <a href="#" class="btn">
                            <i class="fa-solid fa-arrow-right"></i> More info</a>
                    </div>
                </div>
            </div>
            <div class="row m-5 p-4 student-info text-center">
                <div class="col-md-3">
                    <h4>Boys</h4>
                    <h2 class="text-info"><i class="fa-solid fa-child"></i> 60.61%</h2>
                </div>
                <div class="col-md-3">
                    <h4>Girls</h4>
                    <h2 class="text-warning"><i class="fa-solid fa-child"></i> 39.39%</h2>
                </div>
                <div class="col-md-3">
                    <h4>Within State</h4>
                    <h2 class="text-success"><i class="fa-solid fa-map-marker-alt"></i> 84.14%</h2>
                </div>
                <div class="col-md-3">
                    <h4>Out of State</h4>
                    <h2 class="text-danger"><i class="fa-solid fa-plane"></i> 15.86%</h2>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    header("Location: ../Authentication/login.html");
    exit(); // Always use exit() after header redirection
}
?>