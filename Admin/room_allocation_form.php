<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #34495e;
        --accent-color: #3498db;
        --metal-dark: #3d4a5d;
        --metal-light: #7a8ba9;
        --bronze: #cd7f32;
    }

    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f5f7fa;
        padding-top: 60px; /* Navbar height */
    }

    .navbar {
        background-color: var(--primary-color) !important;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    #main-content {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 0 30px rgba(0,0,0,0.05);
        padding: 30px;
        margin-top: 20px;
        border-top: 4px solid var(--bronze);
        background-image: 
            linear-gradient(rgba(255,255,255,0.95), rgba(255,255,255,0.95)),
            url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect fill="rgba(0,0,0,0.03)" width="50" height="50" x="0" y="0"></rect><rect fill="rgba(0,0,0,0.03)" width="50" height="50" x="50" y="50"></rect></svg>');
    }

    h2 {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        color: var(--bronze);
        margin-bottom: 30px;
        text-align: center;
        position: relative;
    }

    h2:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, var(--bronze), var(--metal-light));
    }

    label {
        font-weight: 600;
        color: var(--metal-dark);
        margin-bottom: 8px;
    }

    .form-control, .form-select {
        height: 45px;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 10px 15px;
        transition: all 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
    }

    .form-control[readonly] {
        background-color: #f8f9fa;
        border-color: #e9ecef;
    }

    .btn-outline-danger {
        border-color: var(--metal-dark);
        color: var(--metal-dark);
        font-weight: 600;
        padding: 10px 25px;
        border-width: 2px;
        transition: all 0.3s;
    }

    .btn-outline-danger:hover {
        background-color: var(--metal-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .input-group-text {
        background-color: var(--metal-dark);
        color: white;
        border-color: var(--metal-dark);
    }

    /* Industrial icons */
    .form-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--metal-light);
    }
    .toast {
    border-radius: 12px;
    background-color: #f0fdf4;
    border-left: 6px solid #28a745;
    min-width: 300px;
    max-width: 350px;
    font-family: 'Segoe UI', sans-serif;
}

.toast .toast-body {
    padding: 16px;
}

.toast .text-success {
    color: #28a745 !important;
}

    /* Responsive adjustments */
    @media (max-width: 768px) {
        #main-content {
            padding: 20px;
        }
        
        .row > div {
            margin-bottom: 15px;
        }
    }
</style>

<?php
session_start();
if (isset($_SESSION['email'])) {
    $current_file = "students_record.php";
    include "admin_navbar.html";
    ?>
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
  <div id="roomToast" class="toast fade hide shadow" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body d-flex align-items-center gap-3">
      <i class="fas fa-check-circle text-success fs-4"></i>
      <div>
        <strong class="text-dark">Success</strong>
        <div>Room has been allocated successfully.</div>
      </div>
      <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

    <div class="d-flex">
        <?php include_once "admin_sidebar.php"; ?>
        <div id="main-content" class="container">
            <h2><i class="fas fa-bed me-2"></i>Allocate Room</h2>
            <?php
            if (isset($_GET['sic'])) {
                require_once "../Database/admin_db_functions.php";
                $res = fetchStudentDetails(sic: $_GET['sic']);
                if ($res) {
                    $std = $res->fetch_assoc();
                    ?>
                    <form action="" class="form" id="form">
                        <div class="row">
                            <div class="col-md-4 mb-4 position-relative">
                                <label for="sic" class="form-label"><i class="fas fa-id-card me-2"></i>SIC:</label>
                                <input type="text" id="sic" class="form-control" value="<?php echo $std['sic'] ?>" readonly>
                                <i class="fas fa-user-tag form-icon"></i>
                            </div>
                            <div class="col-md-4 mb-4 position-relative">
                                <label for="name" class="form-label"><i class="fas fa-user me-2"></i>Name:</label>
                                <input type="text" id="name" class="form-control" value="<?php echo $std['name'] ?>" readonly>
                                <i class="fas fa-signature form-icon"></i>
                            </div>
                            <div class="col-md-4 mb-4 position-relative">
                                <label for="branch" class="form-label"><i class="fas fa-code-branch me-2"></i>Branch:</label>
                                <input type="text" class="form-control" value="<?php echo $std['branch'] ?>" readonly>
                                <i class="fas fa-project-diagram form-icon"></i>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 mb-4 position-relative">
                                <label for="year" class="form-label"><i class="fas fa-calendar-alt me-2"></i>Year:</label>
                                <input type="text" class="form-control" value="<?php echo $std['year'] ?>" readonly>
                                <i class="fas fa-clock form-icon"></i>
                            </div>
                            <div class="col-md-4 mb-4 position-relative">
                                <label for="gender" class="form-label"><i class="fas fa-venus-mars me-2"></i>Gender:</label>
                                <input type="text" class="form-control" id="gender" value="<?php echo $std['gender'] ?>" readonly>
                                <i class="fas fa-restroom form-icon"></i>
                            </div>
                            <div class="col-md-4 mb-4 position-relative">
                                <label for="contact-no" class="form-label"><i class="fas fa-phone me-2"></i>Contact No:</label>
                                <input type="text" class="form-control" value="<?php echo $std['contact_no'] ?>" readonly>
                                <i class="fas fa-mobile-alt form-icon"></i>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 mb-4 position-relative">
                                <label for="email" class="form-label"><i class="fas fa-envelope me-2"></i>Email:</label>
                                <input type="text" id="email" class="form-control" value="<?php echo $std['email'] ?>" readonly>
                                <i class="fas fa-at form-icon"></i>
                            </div>
                            <div class="col-md-4 mb-4 position-relative">
                                <label for="address" class="form-label"><i class="fas fa-map-marker-alt me-2"></i>Address:</label>
                                <input type="text" class="form-control" value="<?php echo $std['address'] ?>" readonly>
                                <i class="fas fa-home form-icon"></i>
                            </div>
                            <div class="col-md-4 mb-4 position-relative">
                                <label for="preference" class="form-label"><i class="fas fa-star me-2"></i>Preference Type:</label>
                                <input type="text" class="form-control" id="preference-type" value="<?php echo $std['preference_type'] ?>" readonly>
                                <i class="fas fa-clipboard-list form-icon"></i>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="hostel" class="form-label"><i class="fas fa-building me-2"></i>Hostel:</label>
                                <select name="hostel-name" id="hostel" class="form-select">
                                </select>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="room" class="form-label"><i class="fas fa-door-open me-2"></i>Room:</label>
                                <select name="room" id="room" class="form-select">
                                </select>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="bed" class="form-label"><i class="fas fa-bed me-2"></i>Bed:</label>
                                <select name="bed" id="bed" class="form-select">
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-12 text-center">
                                <button type="submit" name="addToHostel" class="btn btn-outline-danger fw-bold px-5 py-2">
                                    <i class="fas fa-plus-circle me-2"></i>Allocate Room
                                </button>
                            </div>
                        </div>
                    </form>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    

    
    <!-- Include Font Awesome in head -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
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
            let name = $("#name").val()
            let email = $("#email").val()
            let hostel = $("#hostel").val()
            let preferenceType = $("#preference-type").val()
            let room = $("#room").val()
            let bed = $("#bed").val()
            $.ajax({
                url: "allocate_room.php",
                method: "POST",
                data: {'sic': sic, 'room_id': room, 'bed_id': bed},
                success: function(data){
                    console.log(data);
                    if(data.trim() === 'True'){
                        // alert("Room Allocated")
                        const toast = new bootstrap.Toast(document.getElementById('roomToast'));
toast.show();
 setTimeout(() => {
        window.location = "students_record.php";
    }, 2000);
                    //    window.location = "students_record.php"
                        $.ajax({
                            url: "sending_mail.php",
                            method: "POST",
                            data: {'sic': sic, 'name': name, 'email': email, 'hostel': hostel, 'preference_type': preferenceType, 'room': room},
                            success: function(response){
                                // console.log(response);
                            }
                        })
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