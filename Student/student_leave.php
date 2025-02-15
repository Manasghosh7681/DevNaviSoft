<style>
    #application:active {
        border-bottom: 2px solid blue;
    }
    #history:active {
        border-bottom: 2px solid blue;
    }
</style>
<?php
session_start();
if($_SESSION['sic']){
    include "student_navbar.html";
    $current_file = basename(__FILE__);
    ?>
   <div class="d-flex">
        <?php include "student_sidebar.php"; ?>
        <div class="container">
            <h2 class="shadow p-2">Leave Workways</h2>
            <div class="shadow mt-4 rounded-2 ">
                    <div class="border border-1 p-2">
                        <a href="#" class="text-decoration-none text-dark p-2 border-end" id="application">Applications</a>
                        <a href="#" class="text-decoration-none p-2" id="history">History</a>
                    </div>
                    <button class="btn btn-primary m-2 text-light fw-bold"><i class="fa fa-plus fw-bold"></i> Application</button>
            </div>
        </div>
   </div>
            
    <?php
}
?>