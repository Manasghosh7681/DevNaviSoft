<?php
session_start();
if ($_SESSION['sic']) {
    include "student_navbar.html";
    $current_file = basename(__FILE__);
?>
    <div class="d-flex">
        <?php include "student_sidebar.php"; ?>
        <div class="container">
            <h2>History</h2>
        </div>
    </div>
    <?php
}
?>