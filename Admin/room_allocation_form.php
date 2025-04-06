<style>
    label {
        font-weight: 600;
    }
</style>
<?php
session_start();
if (isset($_SESSION['email'])) {
    $current_file = "students_record.php";
    include "admin_navbar.html"
        ?>
    <div class="d-flex">
        <?php
        include_once "admin_sidebar.php";
        ?>
        <div id="main-content" class="container">
            <h2 class="text-center">Allocate Room</h2>
            <?php
            if (isset($_GET['sic'])) {
                require_once "../Database/admin_db_functions.php";
                $res = fetchStudentDetails(sic: $_GET['sic']);
                if ($res) {
                    $std = $res->fetch_assoc();
                    ?>
                    <form action="" class="form" id="form">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="sic" class="form-label">SIC:</label>
                                <input type="text" id="sic" class="form-control" value="<?php echo $std['sic'] ?>" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" value="<?php echo $std['name'] ?>" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="branch" class="form-label">Branch:</label>
                                <input type="text" class="form-control" value="<?php echo $std['branch'] ?>" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="year" class="form-label">Year:</label>
                                <input type="text" class="form-control" value="<?php echo $std['year'] ?>" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="gender" class="form-label">Gender:</label>
                                <input type="text" class="form-control" id="gender" value="<?php echo $std['gender'] ?>" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="contact-no" class="form-label">Contact No:</label>
                                <input type="text" class="form-control" value="<?php echo $std['contact_no'] ?>" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="text" class="form-control" value="<?php echo $std['email'] ?>" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="address" class="form-label">Address:</label>
                                <input type="text" class="form-control" value="<?php echo $std['address'] ?>" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="preference" class="form-label">Preference Type:</label>
                                <input type="text" class="form-control" id="preference-type"
                                    value="<?php echo $std['preference_type'] ?>" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="hostel" class="form-label">Which Hostel:</label>
                                <select name="hostel-name" id="hostel" class="form-select">
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="room" class="form-label">Which Room:</label>
                                <select name="room" id="room" class="form-select">
                                    <!-- <option selected>Select Room</option> -->
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="bed" class="form-label">Which Bed:</label>
                                <select name="bed" id="bed" class="form-select">
                                    <!-- <option selected>Select Bed</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input type="submit" name="addToHostel" value="Add To Hostel" class="btn btn-outline-danger fw-bold w-12">
                            </div>
                        </div>
                    </form>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <script src="../Jquery/jquery-3.7.1.js"></script>
    <script>
        $("document").ready(function () {
            let gender = $("#gender").val()
            let hostel = `<option selected>Select Hostel</option>`
            if (gender === 'Male') {
                hostel += `<option value='Boys Hostel 1'>Boys Hostel 1</option>
                            <option value='Boys Hostel 2'>Boys Hostel 2</option>
                            <option value='Boys Hostel 3'>Boys Hostel 3</option>
                        `
            } else {
                hostel += `<option value='Girls Hostel'>Girls Hostel</option>`
            }
            $("#hostel").html(hostel)
        })
        $("#hostel").change(function () {

            let hostelName = $("#hostel").val()
            let preferenceType = $("#preference-type").val()            
            $.ajax({
                url: "select_rooms.php",
                method: "POST",
                data: { 'hostel_name': hostelName, 'preference_type': preferenceType },
                success: function (data) {
                    try {
                        data = JSON.parse(data)
                        let room = `<option selected>Select Room</option>`
                        data.forEach(row => {
                            room += `<option value='${row.room_id}'>${row.room_no}</option>`
                        });
                        $("#room").html(room)
                    } catch (error) {

                    }
                }
            })
        })
        $("#room").change(function () {

            let room_id = $("#room").val()
            $.ajax({
                url: "select_beds.php",
                method: "POST",
                data: { 'room_id': room_id },
                success: function (data) {
                    try {
                        data = JSON.parse(data)
                        let beds = `<option selected>Select Beds</option>`
                        data.forEach(row => {
                            beds += `<option value='${row.bed_id}'>${row.bed_id}</option>`
                        });
                        $("#bed").html(beds)

                    } catch (error) {
                        
                    }
                }
            })
        })
        $("#form").submit(function(e){
            e.preventDefault()
            let sic = $("#sic").val()
            // let hostel = $("#hostel").val()
            let room = $("#room").val()
            let bed = $("#bed").val()
            $.ajax({
                url: "allocate_room.php",
                method: "POST",
                data: {'sic': sic, 'room_id': room, 'bed_id': bed},
                success: function(data){
                    console.log(data);
                    if(data === 'True'){
                        alert("Room Allocated")
                        window.location = "students_record.php"
                    }
                    else{
                        alert("Room Not Allocated")
                    }
                }
            })
        })
    </script>
    <?php
} else {
    header("Location: ../Authentication/login.html");
    exit(); // Always use exit() after header redirection
}
?>