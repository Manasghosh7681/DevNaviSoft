<?php
session_start();
if ($_SESSION['sic']) {
    include "student_navbar.html";
    $current_file = basename(__FILE__);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industrial Student Profile</title>
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
        }
        
        .profile-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            border-top: 4px solid var(--industrial-warning);
        }
        
        .profile-header {
            background-color: var(--industrial-primary);
            color: white;
            padding: 1.5rem;
            border-bottom: 2px solid var(--industrial-warning);
        }
        
        .profile-header h3 {
            font-weight: 700;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .profile-header p {
            color: var(--industrial-light);
            margin-bottom: 0;
            opacity: 0.9;
        }
        
        .profile-divider {
            border-top: 2px solid var(--industrial-warning);
            margin: 1.5rem 0;
            opacity: 0.5;
        }
        
        .info-card {
            background-color: var(--industrial-light);
            border-radius: 6px;
            border-left: 4px solid var(--industrial-warning);
            padding: 1.25rem;
            height: 100%;
            transition: all 0.3s;
        }
        
        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .info-label {
            color: var(--industrial-secondary);
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }
        
        .info-value {
            color: var(--industrial-dark);
            font-weight: 500;
            font-size: 1rem;
            margin-bottom: 0;
        }
        
        .section-title {
            color: var(--industrial-primary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 3px;
            background-color: var(--industrial-warning);
        }
        
        @media (max-width: 768px) {
            #main-content {
                padding: 1rem;
            }
            
            .profile-header {
                padding: 1rem;
            }
            
            .info-card {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <?php include "student_sidebar.php"; ?>
        <div id="main-content" class="container">
            <?php
            require_once "../Database/student_db_function.php";
            $data = viewProfile($_SESSION['sic']);
            if ($data) {
            ?>
            <div class="profile-container">
                <div class="profile-header">
                    <h3><i class="fas fa-user-shield me-2"></i><?php echo htmlspecialchars($data['name']); ?></h3>
                    <p><i class="fas fa-id-card me-2"></i>SIC: <?php echo htmlspecialchars($data['sic']); ?></p>
                </div>
                
                <div class="p-4">
                    <h4 class="section-title"><i class="fas fa-user-cog me-2"></i>Personal Information</h4>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="info-card">
                                <div class="info-label"><i class="fas fa-code-branch me-2"></i>Branch</div>
                                <div class="info-value"><?php echo htmlspecialchars($data['branch']); ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card">
                                <div class="info-label"><i class="fas fa-venus-mars me-2"></i>Gender</div>
                                <div class="info-value"><?php echo htmlspecialchars($data['gender']); ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card">
                                <div class="info-label"><i class="fas fa-calendar-alt me-2"></i>Year</div>
                                <div class="info-value"><?php echo htmlspecialchars($data['year']); ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card">
                                <div class="info-label"><i class="fas fa-mobile-alt me-2"></i>Contact No</div>
                                <div class="info-value"><?php echo htmlspecialchars($data['contact_no']); ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card">
                                <div class="info-label"><i class="fas fa-envelope me-2"></i>Email</div>
                                <div class="info-value"><?php echo htmlspecialchars($data['email']); ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card">
                                <div class="info-label"><i class="fas fa-map-marker-alt me-2"></i>Address</div>
                                <div class="info-value"><?php echo htmlspecialchars($data['address']); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>
<?php
} else {
    header("location:student_login.php");
}
?>