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
    <title>Industrial Room Details</title>
    <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Bootstrap/css/all.min.css">
    <style>
        :root {
            --industrial-primary: #2c3e50;
            --industrial-secondary: #34495e;
            --industrial-accent: #e74c3c;
            --industrial-warning: #f39c12;
            --industrial-success: #27ae60;
            --industrial-light: #ecf0f1;
            --industrial-dark: #1a252f;
            --industrial-metal: #2c3e50;;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: var(--industrial-dark);
        }
        
        #main-content {
            padding: 2rem;
        }
        
        .page-header {
            color: var(--industrial-primary);
            font-weight: 700;
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .page-header:after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -10px;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: var(--industrial-warning);
        }
        
        .room-card {
            border-radius: 8px;
            border: none;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: all 0.3s ease;
            border-top: 4px solid var(--industrial-metal);
        }
        
        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }
        
        .card-header {
            background-color: var(--industrial-metal);
            color: white;
            padding: 1.25rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--industrial-warning);
        }
        
        .card-body {
            padding: 2rem;
            background-color: white;
        }
        
        .room-detail {
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 1px dashed #eee;
        }
        
        .room-detail:last-child {
            border-bottom: none;
        }
        
        .room-detail strong {
            color: var(--industrial-secondary);
            font-weight: 600;
            display: inline-block;
            min-width: 120px;
        }
        
        .room-image {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #eee;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .room-image:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .roommates-list {
            list-style-type: none;
            padding-left: 0;
            margin-top: 1rem;
        }
        
        .roommates-list li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
        }
        
        .roommates-list li:before {
            content: '\f007';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            margin-right: 10px;
            color: var(--industrial-metal);
        }
        
        .roommates-list li:last-child {
            border-bottom: none;
        }
        
        .badge-type {
            background-color: var(--industrial-metal);
            color: white;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }
        
        .badge-ac {
            background-color: var(--industrial-success);
        }
        
        .badge-non-ac {
            background-color: var(--industrial-warning);
        }
        
        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem;
            }
            
            .room-detail strong {
                display: block;
                margin-bottom: 0.25rem;
            }
            
            .room-image {
                margin-top: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <?php include_once "student_sidebar.php"; ?>
        <div id="main-content">
            <?php
            require_once "../Database/student_db_function.php";
            $data = roomInfo($_SESSION['sic']);
            ?>
            <div class="container py-4">
                <h2 class="page-header"><i class="fas fa-bed me-2"></i>MY ROOM DETAILS</h2>
                
                <div class="card room-card mb-4">
                    <div class="card-header">
                        <i class="fas fa-door-open me-2"></i>ROOM <?php echo htmlspecialchars($data['room_no']); ?> 
                        <span class="badge-type <?php echo ($data['room_type'] == 'AC') ? 'badge-ac' : 'badge-non-ac'; ?>">
                            <?php echo htmlspecialchars($data['room_type']); ?> ROOM
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="room-detail">
                                    <strong><i class="fas fa-building me-2"></i>HOSTEL:</strong>
                                    <?php echo htmlspecialchars($data['hostel_name']); ?>
                                </div>
                                
                                <div class="room-detail">
                                    <strong><i class="fas fa-hashtag me-2"></i>ROOM NO:</strong>
                                    <?php echo htmlspecialchars($data['room_no']); ?>
                                </div>
                                
                                <div class="room-detail">
                                    <strong><i class="fas fa-info-circle me-2"></i>ROOM TYPE:</strong>
                                    <span class="badge-type <?php echo ($data['room_type'] == 'AC') ? 'badge-ac' : 'badge-non-ac'; ?>">
                                        <?php echo ($data['room_type'] == 'AC') ? '3 BEDS AC' : '4 BEDS NON-AC'; ?>
                                    </span>
                                </div>
                                
                                <div class="room-detail">
                                    <strong><i class="fas fa-calendar-check me-2"></i>ALLOCATED ON:</strong>
                                    12-Feb-2025
                                </div>
                                
                                <div class="room-detail">
                                    <strong><i class="fas fa-users me-2"></i>ROOMMATES:</strong>
                                    <ul class="roommates-list">
                                        <?php foreach ($data['names'] as $name): ?>
                                            <li><?php echo htmlspecialchars($name); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="../images/room1.jpg" alt="Room Image" class="room-image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Add interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const roomCard = document.querySelector('.room-card');
            
            // Initial animation
            roomCard.style.opacity = '0';
            roomCard.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                roomCard.style.transition = 'all 0.5s ease';
                roomCard.style.opacity = '1';
                roomCard.style.transform = 'translateY(0)';
            }, 100);
            
            // Add hover effect for touch devices
            roomCard.addEventListener('touchstart', function() {
                this.style.transform = 'translateY(-3px)';
            });
            
            roomCard.addEventListener('touchend', function() {
                this.style.transform = 'translateY(-5px)';
            });
        });
    </script>
</body>
</html>
<?php
} else {
    header("location:admin_login_form.html");
}
?>