<?php
session_start();
if (isset($_SESSION['sic'])) {
    include "student_navbar.html";
    $current_file = basename(__FILE__);
?>
    <div class="d-flex">
        <?php include_once "student_sidebar.php"; ?>
        <div id="main-content">
            <h4 class="text-center">Register Complaints</h4>
            <div class="p-3 m-3">
                <form action="">
                    <div class="row">
                        <div class="col-md-3 my-1">
                            <label class="form-label">Complaint Type: </label>
                        </div>
                        <div class="col-md-6 my-1">
                            <select name="complaint_type" class="form-control" required>
                                <option value="" disabled selected>Select Complaint Type</option>
                                <option value="room">Room Related</option>
                                <option value="cleanliness">Cleanliness</option>
                                <option value="plumbing">Plumbing Issues</option>
                                <option value="electrical">Electrical Problems</option>
                                <option value="discipline">Discipline Issues</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 my-1">
                            <label class="form-label">Complaint Description: </label>
                        </div>
                        <div class="col-md-6 my-1">
                            <textarea name="" id="" cols="30" class="text-decoration-none form-control" required></textarea>
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