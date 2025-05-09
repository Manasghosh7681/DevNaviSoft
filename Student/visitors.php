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
    <title>Industrial Visitor Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --industrial-primary: #2c3e50;
            --industrial-secondary: #34495e;
            --industrial-accent: #e74c3c;
            --industrial-warning: #f39c12;
            --industrial-success: #27ae60;
            --industrial-light: #ecf0f1;
            --industrial-dark: #1a252f;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: var(--industrial-dark);
        }
        
        #main-content {
            padding: 2rem;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .visitor-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            border-top: 4px solid var(--industrial-warning);
            width: 100%;
            max-width: 1100px;
        }
        
        .visitor-header {
            background-color: var(--industrial-primary);
            color: white;
            padding: 1.5rem;
            text-align: center;
            border-bottom: 2px solid var(--industrial-warning);
        }
        
        .visitor-header h3 {
            font-weight: 700;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .visitor-header i {
            color: var(--industrial-warning);
            margin-right: 10px;
        }
        
        .visitor-form {
            padding: 2rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--industrial-secondary);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85rem;
        }
        
        .input-group-text {
            background-color: var(--industrial-secondary);
            color: white;
            border: none;
            min-width: 40px;
            justify-content: center;
        }
        
        .form-control {
            border: 1px solid var(--industrial-secondary);
            border-radius: 4px;
            padding: 0.75rem 1rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--industrial-warning);
            box-shadow: 0 0 0 0.25rem rgba(243, 156, 18, 0.25);
        }
        
        .readonly-field {
            background-color: rgba(44, 62, 80, 0.05);
            cursor: not-allowed;
        }
        
        .btn-submit {
            background-color: var(--industrial-primary);
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            color: white;
        }
        
        .btn-submit:hover {
            background-color: var(--industrial-secondary);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .text-error {
            color: var(--industrial-accent);
            font-size: 0.85rem;
            margin-top: 0.25rem;
            display: block;
        }
        
        .is-invalid {
            border-color: var(--industrial-accent) !important;
            animation: shake 0.5s;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-5px); }
            40%, 80% { transform: translateX(5px); }
        }
        
        @media (max-width: 768px) {
            #main-content {
                padding: 1rem;
            }
            
            .visitor-form {
                padding: 1.5rem;
            }
            
            .visitor-header h3 {
                font-size: 1.3rem;
            }
        }
        
        @media (max-width: 576px) {
            .visitor-header {
                padding: 1rem;
            }
            
            .visitor-form {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <?php include_once "student_sidebar.php"; ?>
        
        <div id="main-content">
            <div class="visitor-container">
                <div class="visitor-header">
                    <h3><i class="fas fa-user-shield"></i>VISITOR MANAGEMENT SYSTEM</h3>
                </div>
                
                <div class="visitor-form">
                    <form action="" method="post" id="visitorForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">YOUR SIC</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" class="form-control readonly-field" 
                                           value="<?php echo htmlspecialchars($_SESSION['sic']); ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">YOUR NAME</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control readonly-field" 
                                           value="<?php echo htmlspecialchars($_SESSION['name']); ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">VISITOR'S NAME</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                                    <input type="text" name="visitor_name" id="visitor-name" class="form-control" 
                                           placeholder="Enter visitor's full name">
                                </div>
                                <p class="text-error" id="visitor-name-error"></p>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">RELATION WITH VISITOR</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    <input type="text" name="relation" id="relation" class="form-control" 
                                           placeholder="E.g. Father, Mother, Friend">
                                </div>
                                <p class="text-error" id="relation-error"></p>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">DATE OF ARRIVAL</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                    <input type="date" name="arrival_date" id="date" class="form-control">
                                </div>
                                <p class="text-error" id="date-error"></p>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">CONTACT NUMBER</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                                    <input type="text" name="mobile" id="mobile" class="form-control" 
                                           placeholder="Visitor's mobile number">
                                </div>
                                <p class="text-error" id="mobile-error"></p>
                            </div>
                            
                            <div class="col-12 text-center mt-4">
                                <button type="submit" name="add" id="submit" class="btn btn-submit">
                                    <i class="fas fa-save me-2"></i>SAVE VISITOR DETAILS
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../Jquery/jquery-3.7.1.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){
            // Set minimum date to today
            $("#date").attr('min', new Date().toISOString().split("T")[0]);
            
            $("#visitorForm").submit(function(e){
                let visitorName = $("#visitor-name").val().trim();
                let relation = $("#relation").val().trim();
                let date = $("#date").val();
                let mobile = $("#mobile").val().trim();
                let error = false;

                // Reset errors
                $(".text-error").text("");
                $(".is-invalid").removeClass("is-invalid");

                // Validate visitor name
                if(visitorName.length < 3){
                    $("#visitor-name-error").text("Visitor name must be at least 3 characters");
                    $("#visitor-name").addClass("is-invalid");
                    error = true;
                }

                // Validate relation
                if(relation.length < 3){
                    $("#relation-error").text("Please specify relation (min 3 chars)");
                    $("#relation").addClass("is-invalid");
                    error = true;
                }

                // Validate date
                if(date === ""){
                    $("#date-error").text("Please select arrival date");
                    $("#date").addClass("is-invalid");
                    error = true;
                }

                // Validate mobile
                if(mobile.length != 10){
                    $("#mobile-error").text("Mobile number must be 10 digits");
                    $("#mobile").addClass("is-invalid");
                    error = true;
                } else if(isNaN(mobile)){
                    $("#mobile-error").text("Mobile must contain only numbers");
                    $("#mobile").addClass("is-invalid");
                    error = true;
                } else if(!mobile.match(/^[6-9]{1}[0-9]{9}$/)){
                    $("#mobile-error").text("Mobile must start with 6-9");
                    $("#mobile").addClass("is-invalid");
                    error = true;
                }

                if(error){
                    e.preventDefault();
                }
            });

            // Real-time validation
            $("#visitor-name, #relation, #mobile").on("input", function(){
                $(this).removeClass("is-invalid");
                $(this).next(".text-error").text("");
            });

            $("#date").on("change", function(){
                $(this).removeClass("is-invalid");
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
                    title: "SUCCESS",
                    text: "Visitor added successfully",
                    showConfirmButton: false,
                    timer: 1500,
                    background: "var(--industrial-light)",
                    color: "var(--industrial-dark)"
                }).then(() => {
                    $("#visitorForm")[0].reset();
                });
            </script>';
        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "ERROR",
                    text: "Failed to add visitor",
                    showConfirmButton: true,
                    background: "var(--industrial-light)",
                    color: "var(--industrial-dark)"
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