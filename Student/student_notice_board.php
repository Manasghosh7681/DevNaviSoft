<?php
session_start();
if ($_SESSION['sic']) {
    include "student_navbar.html";
    $current_file = basename(__FILE__);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">


<style>
    .notice-board-wrapper {
        padding: 20px;
        width: 100%;
    }

    .notice-card {
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    border-radius: 40px;
    overflow: hidden;
    background-color: #fff;
}


    .notice-table th {
        background-color: #0d6efd;
        color: white;
        vertical-align: middle;
    }

    .notice-table td {
        vertical-align: middle;
    }

    .notice-table a {
        text-decoration: none;
        font-weight: 500;
        color: #0d6efd;
    }

    .notice-table a:hover {
        text-decoration: underline;
    }

    .no-notice {
        padding: 30px;
        font-size: 1.2rem;
        color: #dc3545;
    }
    body {
        font-family: 'Poppins', sans-serif;
    }

    h2 {
        font-weight: 600;
    }

    .notice-table th,
    .notice-table td {
        font-size: 0.95rem;
    }

    .notice-table a {
        font-weight: 500;
    }
</style>


<div class="d-flex">
    <?php include "student_sidebar.php"; ?>
    <div id="main-content" class="notice-board-wrapper container-fluid">
        <h2 class="text-center my-4 text-primary">📢 Notice Board</h2>
        <div class="notice-card p-3  rounded">
            <div class="table-responsive">
                <?php
                require_once "../Database/student_db_function.php";
                $res = stud_displayAllNotice();
                if ($res) {
                ?>
                    <table class="table table-bordered table-hover text-center notice-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-calendar-alt"></i> Date</th>
                                <th><i class="fas fa-bullhorn"></i> Title</th>
                                <th><i class="fas fa-file-alt"></i> Description</th>
                                <th><i class="fas fa-paperclip"></i> File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($data = $res->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $data['notice_date']; ?></td>
                                    <td><?php echo $data['notice_title']; ?></td>
                                    <td><?php echo $data['notice_description']; ?></td>
                                    <td>
                                        <?php if ($data['notice_file'] !== 'empty') { ?>
                                            <a href="../Notice files/<?php echo $data['notice_file'] ?>" target="_blank">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        <?php } else {
                                            echo "<span class='text-muted'>No File</span>";
                                        } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "<div class='text-center no-notice'>No Notices Available</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>


<?php
} else {
    header("location:student_login.php");
}

?>