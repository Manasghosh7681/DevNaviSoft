<?php
session_start();
if ($_SESSION['sic']) {
    include "student_navbar.html";
    $current_file = basename(__FILE__);
    ?>
    <div class="d-flex">
        <?php include "student_sidebar.php"; ?>
        <div id="main-content" class="container">
            <?php
            require_once "../Database/student_db_function.php";
            $data = viewProfile($_SESSION['sic']);
            if ($data) {
                ?>
                <div class="container mt-4">
                    <div class="card shadow rounded-4 border-0">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <!-- <div class="me-3">
                                    <img src="https://via.placeholder.com/80" alt="Profile" width="80" height="80"
                                        class="rounded-circle shadow">
                                </div> -->
                                <div>
                                    <h3 class="mb-0" style="color: chocolate"><?php echo $data['name']; ?></h3>
                                    <p class="text-muted mb-0">SIC: <?php echo $data['sic']; ?></p>
                                </div>
                            </div>

                            <hr>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="border rounded-3 p-3 bg-light">
                                        <h6 class="text-muted mb-1">Branch</h6>
                                        <p class="mb-0"><?php echo $data['branch']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="border rounded-3 p-3 bg-light">
                                        <h6 class="text-muted mb-1">Gender</h6>
                                        <p class="mb-0"><?php echo $data['gender']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="border rounded-3 p-3 bg-light">
                                        <h6 class="text-muted mb-1">Year</h6>
                                        <p class="mb-0"><?php echo $data['year']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="border rounded-3 p-3 bg-light">
                                        <h6 class="text-muted mb-1">Contact No</h6>
                                        <p class="mb-0"><?php echo $data['contact_no']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="border rounded-3 p-3 bg-light">
                                        <h6 class="text-muted mb-1">Email</h6>
                                        <p class="mb-0"><?php echo $data['email']; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="border rounded-3 p-3 bg-light">
                                        <h6 class="text-muted mb-1">Address</h6>
                                        <p class="mb-0"><?php echo $data['address']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }

            ?>
            <!-- <div class="row">
                <h4 class="bg-info text-white p-2"><i class="fa-solid fa-user"></i> Personal</h4>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th>Name :</th>
                            <td>Abhaya Kumar Das</td>
                        </tr>
                        <tr>
                            <th>Gender :</th>
                            <td>Male</td>
                        </tr>
                        <tr>
                            <th>Caste :</th>
                            <td>OBC</td>
                        </tr>
                        <tr>
                            <th>DOB :</th>
                            <td>24/04/2002</td>
                        </tr>
                        <tr>
                            <th>Religion :</th>
                            <td>Hindu</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table col-md-6">
                        <tr>
                            <th>Blood Group :</th>
                            <td> O+</td>
                        </tr>
                        <tr>
                            <th>Mother Tongue :</th>
                            <td>Odia</td>
                        </tr>
                        <tr>
                            <th>Email Id :</th>
                            <td>abhayakumardas375@gmail.com</td>
                        </tr>
                        <tr>
                            <th>Registered Mobile No. :</th>
                            <td>8093547586</td>
                        </tr>
                        <tr>
                            <th>Alt. Mobile No. :</th>
                            <td>865850xxxx</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <h4 class="bg-info text-white p-2"><i class="fa-solid fa-book"></i> Academics</h4>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th>College Name :</th>
                            <td>SiliconTech is a Unit of Silicon University</td>
                        </tr>
                        <tr>
                            <th>Sic No. :</th>
                            <td>23mmci79</td>
                        </tr>
                        <tr>
                            <th>Course :</th>
                            <td>MCA</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th>Branch :</th>
                            <td>MCA</td>
                        </tr>
                        <tr>
                            <th>Current Semester :</th>
                            <td>4</td>
                        </tr>
                        <tr>
                            <th>Hostel :</th>
                            <td>Yes</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <h4 class="bg-info text-white p-2"><i class="fa-solid fa-phone"></i> Contact Details</h4>
                <div class="col-md-6">
                    <table class="table">
                        <h4 class="text-center text-bold">Father Details</h4>
                        <tr>
                            <th>Name :</th>
                            <td>Raghunath Das</td>
                        </tr>
                        <tr>
                            <th>Occupation :</th>
                            <td>Business</td>
                        </tr>
                        <tr>
                            <th>Email Id :</th>
                            <td>xyz@gmail.com</td>
                        </tr>
                        <tr>
                            <th>Telephone No. :</th>
                            <td>xxxxxxxxxx</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <h4 class="text-center text-bold">Mother Details</h4>
                        <tr>
                            <th>Name :</th>
                            <td>Pratima Das</td>
                        </tr>
                        <tr>
                            <th>Occupation :</th>
                            <td>Housemaker</td>
                        </tr>
                        <tr>
                            <th>Email Id :</th>
                            <td>xyz@gmail.com</td>
                        </tr>
                        <tr>
                            <th>Telephone No. :</th>
                            <td>xxxxxxxxxx</td>
                        </tr>
                    </table>
                </div>
            </div> -->

        </div>
    </div>
    <?php
} else {
    header("location:student_login.php");
}
?>