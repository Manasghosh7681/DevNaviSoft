<?php
session_start();
$_SESSION['sic'] = "22vlsi44";
if (isset($_SESSION['sic'])) {
    $current_file = basename(__FILE__);
    include "student_navbar.html";
    include_once "student_sidebar.php";
    ?>
    <div class="d-flex">
        <?php include_once "student_sidebar.php"; ?>
        <div id="main-content">
            <h4 class="text-center">Register Complaints</h4>
            <div class="content p-3 m-3 border">
                <form action="">
                    <div class="row">
                        <div class="col-md-3 my-1">
                            <label class="form-label">Complaint Type: </label>
                        </div>
                        <div class="col-md-6 my-1">
                            <select name="" class="form-control" required>
                                <option value="">Select</option>
                                <option value="">Food Related</option>
                                <option value="">Room Related</option>
                                <option value="">Plumbing</option>
                                <option value="">Electrical</option>
                                <option value="">Other</option>
                                <option value="">Discipline</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 my-1">
                            <label class="form-label">Complaint Description: </label>
                        </div>
                        <div class="col-md-6 my-1">
                            <textarea name="" id="" cols="30"  class="text-decoration-none form-control" required></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 my-1">
                            <label class="form-label">File(if any): </label>
                        </div>
                        <div class="col-md-6 my-1">
                            <input type="file" class="form-control">
                        </div>
                    </div>
                    <input type="submit" name="" class=" btn btn-primary d-flex mx-auto my-2" value="Register">
                </form>
            </div>
        </div>
    </div>
    <?php
} else {
    header("location:student_login.php");
}
?>