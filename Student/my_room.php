<style>
    .room-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .card-header {
        background: #6f42c1;
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .roommates li {
        padding-left: 10px;
    }

    .room-image {
        width: 100%;
        object-fit: cover;
        border-radius: 10px;
    }
</style>
<?php
session_start();
if (isset($_SESSION['sic'])) {
    $current_file = basename(__FILE__);
    include "student_navbar.html";
}
?>
<div class="d-flex">
    <?php
    include_once "student_sidebar.php";
    ?>
    <div id="main-content">
    <?php
        require_once "../Database/student_db_function.php";
        $data = roomInfo($_SESSION['sic']);
        ?>
        <div class="container py-5">
            <h2 class="mb-4 text-center">🛏️ My Room Details</h2>
            <!-- Room Card Start -->
            <div class="card room-card mb-4">
                <div class="card-header">
                    Room No: <?php echo "$data[room_no] ($data[room_type] Room)" ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <p><strong>Hostel Name:</strong> <?php echo $data['hostel_name'] ?> </p>
                            <p><strong>Room No:</strong> <?php echo $data['room_no'] ?></p>
                            <p><strong>Room
                                    Type:</strong><?php ($data['room_type'] == 'AC') ? print ('  3 beds AC') : print ('  4 beds NON-AC') ?>
                            </p>
                            <p><strong>Allocated On:</strong> 12-Feb-2025</p>
                            <strong class="mt-3">Roommates:</strong>
                            <ul class="roommates">
                                <?php
                                for ($i = 0; $i < count($data['names']); $i++) {
                                    ?>
                                    <li><?php echo $data['names'][$i] ?></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <img src="../images/room1.jpg" alt="Room Image" class="room-image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>