<!-- Add this in your PHP file -->

<!-- Bootstrap CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .form-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-top: 40px;
    }

    .form-title {
        margin-bottom: 25px;
        text-align: center;
        font-weight: 600;
        color: #343a40;
        border-bottom: 2px solid blue;
    }

    .form-label {
        font-weight: bold;
    }
</style>

<?php
session_start();
if (isset($_SESSION['email'])) {
    include "admin_navbar.html";
    $current_file = basename(__FILE__);
    ?>
    <div class="d-flex">
        <?php include "admin_sidebar.php"; ?>

        <div id="main-content" class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="form-container">
                        <h2 class="form-title">Add Rooms</h2>
                        <form action="add_hostel.php" id="add-rooms">
                            <div class="mb-3">
                                <label for="hostel_name" class="form-label">Hostel Name</label>

                                <select name="hostel_name" id="hostel_name" class="form-select" required>
                                    <option value="">Select Hostel</option>
                                    <option value="Girls Hostel">Girls Hostel</option>
                                    <option value="Boys Hostel 1">Boys Hostel 1</option>
                                    <option value="Boys Hostel 2">Boys Hostel 2</option>
                                    <option value="Boys Hostel 3">Boys Hostel 3</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="ac_rooms" class="form-label">Number of AC Rooms</label>
                                <input type="text" class="form-control" id="ac_rooms" name="ac_rooms" min="0" required>
                            </div>

                            <div class="mb-3">
                                <label for="non_ac_rooms" class="form-label">Number of Non-AC Rooms</label>
                                <input type="text" class="form-control" id="non_ac_rooms" name="non_ac_rooms" min="0"
                                    required>
                            </div>

                            <input type="submit" class="btn btn-primary w-100 #343a40" value="Add to Hostel" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../Jquery/jquery-3.7.1.js"></script>
    <script>
        $("#add-rooms").submit(function (e) {
            e.preventDefault();
            let hostel_name = $("#hostel_name").val()
            let non_ac_rooms = parseInt($("#non_ac_rooms").val())
            let ac_rooms = parseInt($("#ac_rooms").val())
            $.ajax({
                url: "add_rooms.php",
                method: "POST",
                data: {'hostel_name': hostel_name, 'non_ac_rooms': non_ac_rooms, 'ac_rooms': ac_rooms},
                success: function(data){
                    if(data === "True"){
                        location.reload()
                    }                    
                }
            })
        })
    </script>
    <?php
} else {
    header("Location: ../Authentication/login.html");
    exit();
}
