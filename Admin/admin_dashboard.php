<style>
    .info-box {
        border-radius: 10px;
        text-align: center;
        padding: 20px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
        color: white;
    }

    .info-box:hover {
        transform: scale(1.05);
    }

    .info-box>i {
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .info-box a {
        display: block;
        margin-top: 10px;
        padding: 8px 12px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
    }

    .info-box a:hover {
        background-color: rgba(255, 255, 255, 0.4);
    }

    .students {
        background: linear-gradient(135deg, #3498db, #2980b9);
    }

    .notice {
        background: linear-gradient(135deg, #f39c12, #e67e22);
    }

    .leave {
        background: linear-gradient(135deg, #2ecc71, #27ae60);
    }

    .complain {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
    }

    .rooms {
        background: linear-gradient(135deg, #9b59b6, #8e44ad);
    }

    .hostel {
        background: linear-gradient(135deg, #34495e, #2c3e50);
    }

    .student-info {
        background-color: #f8f9fa;
        border-radius: 15px;
        border: 1px solid #dee2e6;
        padding: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .student-info h4 {
        font-weight: bold;
    }

    .student-info h2 {
        font-size: 2rem;
        font-weight: bold;
    }
</style>
<?php
session_start();
$_SESSION['email'] = "admin";
if (isset($_SESSION['email'])) {
    $current_file = basename(__FILE__);
    include "admin_navbar.html"
?>
    <div class="d-flex">
        <?php
        include_once "admin_sidebar.php";
        ?>
        <div class="col-md-10 col-12">
            <div class="row g-4 m-5">
                <div class="col-md-4 col-12">
                    <div class="info-box students">
                        <h4>Students</h4>
                        <i class="fa-solid fs-1 fa-user-graduate"></i>
                        <a href="#" class="btn">
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
                        <a href="#" class="btn">
                            <i class="fa-solid fa-arrow-right"></i> More info</a>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="info-box complain">
                        <h4>Complain</h4>
                        <i class="fa-solid fs-1 fa-comments"></i>
                        <a href="#" class="btn">
                            <i class="fa-solid fa-arrow-right"></i> More info</a>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="info-box rooms">
                        <h4>Rooms</h4>
                        <i class="fa-solid fs-1 fa-door-closed"></i>
                        <a href="#" class="btn">
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
    </div>
<?php
} else {
    header("location:admin_login_form.html");
}
?>