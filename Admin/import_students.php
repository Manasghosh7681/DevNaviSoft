<?php
session_start();
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_SESSION['email'])) {
    $current_file = basename(__FILE__);
    include "admin_navbar.html"
        ?>
    <div class="d-flex">
        <?php
        include_once "admin_sidebar.php";
        ?>
        <div id="main-content">
            <div class="container mt-5 pt-5">
                <div class="card shadow-lg p-4 rounded-4">
                    <h2 class="text-center mb-4 fw-bold text-primary">Import Students</h2>
                    <form action="" class="form" method="post" enctype="multipart/form-data" id="form">
                        <div class="mb-3">
                            <label for="studentsFile" class="form-label fw-bold">Students file:</label>
                            <input type="file" name="students_file" id="studentsFile" class="form-control" required>
                            
                        </div>
                        <p id="msg"></p>
                        <div class="d-grid">
                            <input type="submit" name="import_students" value="Import"
                                class="btn btn-info text-white fw-semibold">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php 
} else {
    header("Location: ../Authentication/login.html");
    exit(); // Always use exit() after header redirection
}

if (isset($_POST['import_students'])) {
    $msg = "";
    $fileName = $_FILES['students_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowed_ext = ['xls', 'csv', 'xlsx'];
    if (in_array($file_ext, $allowed_ext)) {
      

        $inputFileNamePath = $_FILES['students_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();
        include_once "../Database/connection.php";
        $count = 0;
        foreach ($data as $row) {

            if ($count > 0) {
                $sic = $row['0'];
                $name = $row['1'];
                $gender = $row['2'];
                $branch = $row['3'];
                $year = $row['4'];
                $contact_no = $row['5'];
                $email = $row['6'];
                $address = $row['7'];
                require_once "../Database/admin_db_functions.php";
                $res = importStudents($sic,$name,$gender,$branch,$year,$contact_no,$email,$address);
                if($res){
                    $msg = "Successfully imported";
                }else{
                    $msg = "Students data already exist";
                }
            } else {
                $count = 1;
            }
        }
        if($msg === "Successfully imported"){
            ?>
            <script>
                console.log("Successfully imported")
                alert("Successfully imported")
                // document.querySelector("#msg").innerHTML = "Successfully imported"
                // document.querySelector("#msg").style.color = "green"
                </script>
            <?php
        }else{
            ?>
            <script>
                console.log("Students data already exist")
                alert("Students data already exist")
                // document.querySelector("#msg").innerHTML = "Students data already exist"
                // document.querySelector("#msg").style.color = "red"
            </script>
            <?php
        }
    }else{
        $msg = "Invalid file type";
        ?>
        <script>
            console.log("Invalid file type")
            alert("Invalid file type")
            // document.querySelector("#msg").innerHTML = "Invalid file type"
            // document.querySelector("#msg").style.color = "red"
        </script>
        <?php
    }
}
?>