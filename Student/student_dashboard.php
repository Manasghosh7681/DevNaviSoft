<?php
session_start();
// $_SESSION['sic'] = "23mmci85";
if (isset($_SESSION['sic'])) {
    $current_file = basename(__FILE__);
    include "student_navbar.html";
?>
    <div class="d-flex">
        <?php
        include_once "student_sidebar.php";
        ?>
        <div id="main-content">
            <div class="row g-4 m-5">
                <div class="col-md-4 col-12">
                    <div class="info-box rooms">
                        <h4>My Rooms</h4>
                        <i class="fa-solid fs-1 fa-building"></i>
                        <a href="#" class="btn">
                            <i class="fa-solid fa-arrow-right"></i> More info</a>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="info-box notice">
                        <h4>Notice</h4>
                        <i class="fa-solid fs-1 fa-bell"></i>
                        <a href="student_notice_board.php" class="btn">
                            <i class="fa-solid fa-arrow-right"></i> More info</a>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="info-box leave">
                        <h4>Leave</h4>
                        <i class="fa-solid fs-1 fa-plane-departure"></i>
                        <a href="student_leave.php" class="btn">
                            <i class="fa-solid fa-arrow-right"></i> Leave Apply</a>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="info-box complain">
                        <h4>Complain</h4>
                        <i class="fa-solid fs-1 fa-comments"></i>
                        <a href="student_complaint.php" class="btn">
                            <i class="fa-solid fa-arrow-right"></i> Complaint Registration</a>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="info-box profile">
                        <h4>Profile</h4>
                        <i class="fa-solid fs-1 fa-user-graduate"></i>
                        <a href="student_profile.php" class="btn">
                            <i class="fa-solid fa-arrow-right"></i> More info</a>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="info-box feedback">
                        <h4>Feedback</h4>
                        <i class="fas fa-comment-dots"></i>
                        <a href="student_feedback.php" class="btn">
                            <i class="fa-solid fa-arrow-right"></i> More info</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    header("location:admin_login_form.html");
}
?>