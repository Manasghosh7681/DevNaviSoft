<?php
session_start();
if (isset($_SESSION['sic'])) {
    $current_file = basename(__FILE__);
    include "student_navbar.html";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Visitor | Hostel Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }
        
        #main-content {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .visitor-form-container {
            width: 100%;
            max-width: 800px;
        }
        
        .visitor-card {
            background: white;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            padding: 2rem;
            transition: var(--transition);
        }
        
        .visitor-card:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        
        .form-title {
            color: var(--secondary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .form-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--primary-color);
        }
        
        .form-label {
            font-weight: 500;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 0.75rem 1rem;
            transition: var(--transition);
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .btn-submit {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: var(--transition);
            border-radius: 6px;
        }
        
        .btn-submit:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .text-error {
            color: var(--accent-color);
            font-size: 0.85rem;
            margin-top: 0.25rem;
            display: block;
        }
        
        .input-group-text {
            background-color: #e9ecef;
            border: 1px solid #ddd;
        }
        
        .readonly-field {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }
        
        @media (max-width: 768px) {
            #main-content {
                padding: 1rem;
            }
            
            .visitor-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <?php include_once "student_sidebar.php"; ?>
        
        <div id="main-content">
            <div class="visitor-form-container">
                <div class="visitor-card">
                    <h3 class="form-title">Add Visitor Details</h3>
                    
                    <form action="" method="post" id="visitorForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Your SIC</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" class="form-control readonly-field" value="<?php echo $_SESSION['sic']; ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Your Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control readonly-field" value="<?php echo $_SESSION['name']; ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Visitor's Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                                    <input type="text" name="visitor_name" id="visitor-name" class="form-control" placeholder="Enter visitor's full name">
                                </div>
                                <p class="text-error" id="visitor-name-error"></p>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Relation with Visitor</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    <input type="text" name="relation" id="relation" class="form-control" placeholder="E.g. Father, Mother, Friend">
                                </div>
                                <p class="text-error" id="relation-error"></p>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Date of Arrival</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                    <input type="date" name="arrival_date" id="date" class="form-control">
                                </div>
                                <p class="text-error" id="date-error"></p>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Contact Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Visitor's mobile number">
                                </div>
                                <p class="text-error" id="mobile-error"></p>
                            </div>
                            
                            <div class="col-12 text-center mt-4">
                                <button type="submit" name="add" id="submit" class="btn btn-submit">
                                    <i class="fas fa-save me-2"></i>Save Visitor Details
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../Jquery/jquery-3.7.1.js"></script>
    <script>
        $(document).ready(function(){
            $("#visitorForm").submit(function(e){
                let visitorName = $("#visitor-name").val().trim();
                let relation = $("#relation").val().trim();
                let date = $("#date").val();
                let mobile = $("#mobile").val().trim();
                let error = false;

                // Reset errors
                $(".text-error").text("");

                // Validate visitor name
                if(visitorName.length < 3){
                    $("#visitor-name-error").text("Visitor name must be at least 3 characters");
                    error = true;
                }

                // Validate relation
                if(relation.length < 3){
                    $("#relation-error").text("Please specify relation (min 3 chars)");
                    error = true;
                }

                // Validate date
                if(date === ""){
                    $("#date-error").text("Please select arrival date");
                    error = true;
                } else if(date < new Date().toISOString().split("T")[0]){
                    $("#date-error").text("Date cannot be in the past");
                    error = true;
                }

                // Validate mobile
                if(mobile.length != 10){
                    $("#mobile-error").text("Mobile number must be 10 digits");
                    error = true;
                } else if(isNaN(mobile)){
                    $("#mobile-error").text("Mobile must contain only numbers");
                    error = true;
                } else if(!mobile.match(/^[6-9]{1}[0-9]{9}$/)){
                    $("#mobile-error").text("Mobile must start with 6-9");
                    error = true;
                }

                if(error){
                    e.preventDefault();
                    // Add shake animation to error fields
                    $(".text-error:not(:empty)").parent().find("input").addClass("is-invalid");
                    setTimeout(() => {
                        $(".is-invalid").removeClass("is-invalid");
                    }, 1000);
                }
            });

            // Add real-time validation
            $("#visitor-name, #relation, #mobile").on("input", function(){
                $(this).next(".text-error").text("");
            });

            $("#date").on("change", function(){
                $(this).next(".text-error").text("");
            });
        });
    </script>
    <?php
    if(isset($_POST['add'])){
        require_once "../Database/student_db_function.php";
        $sic = $_SESSION['sic'];
        $name = $_SESSION['name'];
        $visitor_name = $_POST['visitor_name'];
        $relation = $_POST['relation'];
        $arrival_date = $_POST['arrival_date'];
        $mobile = $_POST['mobile'];
        $res = insertVisitorData($sic, $name, $visitor_name, $relation, $arrival_date, $mobile);
        
        if($res){
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Visitor added successfully",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    $("#visitorForm")[0].reset();
                });
            </script>';
        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to add visitor",
                    showConfirmButton: true
                });
            </script>';
        }
    }
    ?>
</body>
</html>
<?php
} else {
    header("Location: ../Authentication/login.html");
    exit();
}
?>