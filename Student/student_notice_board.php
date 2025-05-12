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
    <title>Industrial Notice Board</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
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
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            color: var(--industrial-dark);
        }
        
        .notice-board-wrapper {
            padding: 2rem;
            width: 100%;
        }
        
        .notice-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            border-top: 4px solid var(--industrial-warning);
        }
        
        .notice-header {
            background-color: var(--industrial-primary);
            color: white;
            padding: 1.5rem;
            text-align: center;
            border-bottom: 2px solid var(--industrial-warning);
        }
        
        .notice-header h2 {
            font-weight: 700;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .notice-header i {
            margin-right: 10px;
            color: var(--industrial-warning);
        }
        
        .notice-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .notice-table thead {
            background-color: var(--industrial-secondary);
            color: white;
        }
        
        .notice-table th {
            padding: 1rem;
            text-align: center;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            vertical-align: middle;
        }
        
        .notice-table td {
            padding: 1rem;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid #eee;
        }
        
        .notice-table tr:nth-child(even) {
            background-color: rgba(44, 62, 80, 0.03);
        }
        
        .notice-table tr:hover {
            background-color: rgba(44, 62, 80, 0.05);
        }
        
        .download-btn {
            background-color: var(--industrial-primary);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        
        .download-btn:hover {
            background-color: var(--industrial-secondary);
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            color: white;
        }
        
        .download-btn i {
            margin-right: 5px;
        }
        
        .no-notice {
            padding: 3rem;
            text-align: center;
            background-color: rgba(236, 240, 241, 0.5);
            border-radius: 8px;
            margin: 2rem;
            border: 2px dashed var(--industrial-secondary);
        }
        
        .no-notice i {
            font-size: 3rem;
            color: var(--industrial-secondary);
            margin-bottom: 1rem;
            opacity: 0.7;
        }
        
        .no-notice-text {
            color: var(--industrial-secondary);
            font-size: 1.2rem;
            font-weight: 500;
        }
        
        @media (max-width: 768px) {
            .notice-board-wrapper {
                padding: 1rem;
            }
            
            .notice-table th, 
            .notice-table td {
                padding: 0.75rem 0.5rem;
                font-size: 0.85rem;
            }
            
            .download-btn {
                padding: 0.4rem 0.8rem;
                font-size: 0.85rem;
            }
        }
        
        @media (max-width: 576px) {
            .notice-header h2 {
                font-size: 1.3rem;
            }
            
            .no-notice {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <?php include "student_sidebar.php"; ?>
        <div id="main-content" class="notice-board-wrapper container-fluid">
            <div class="notice-container">
                <div class="notice-header">
                    <h2><i class="fas fa-bullhorn"></i>NOTICE BOARD</h2>
                </div>
                <div class="table-responsive">
                    <?php
                    require_once "../Database/student_db_function.php";
                    $res = stud_displayAllNotice();
                    if ($res) {
                    ?>
                        <table class="table notice-table">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-calendar-alt"></i> DATE</th>
                                    <th><i class="fas fa-heading"></i> TITLE</th>
                                    <th><i class="fas fa-align-left"></i> DESCRIPTION</th>
                                    <th><i class="fas fa-paperclip"></i> ATTACHMENT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data = $res->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($data['notice_date']); ?></td>
                                        <td><?php echo htmlspecialchars($data['notice_title']); ?></td>
                                        <td><?php echo htmlspecialchars($data['notice_description']); ?></td>
                                        <td>
                                            <?php if ($data['notice_file'] !== 'empty') { 
                                                $filePath = "../Notice files/" . htmlspecialchars($data['notice_file']);
                                                $fileName = htmlspecialchars($data['notice_file']);
                                            ?>
                                                <a href="download_notice.php?file=<?php echo urlencode($fileName); ?>" 
                                                   class="download-btn"
                                                   download="<?php echo $fileName; ?>">
                                                    <i class="fas fa-download"></i> DOWNLOAD
                                                </a>
                                            <?php } else { ?>
                                                <span class="text-muted">N/A</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php
                    } else {
                        echo '<div class="no-notice">
                                <i class="fas fa-bell-slash"></i>
                                <div class="no-notice-text">No Notices Available</div>
                              </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Create a new file called download_notice.php in the same directory with this content: -->
    <!-- <?php
    // session_start();
    // if (!isset($_SESSION['sic'])) {
    //     header("location:student_login.php");
    //     exit();
    // }
    // 
    // if (isset($_GET['file'])) {
    //     $file = $_GET['file'];
    //     $filepath = '../Notice files/' . $file;
    //     
    //     if (file_exists($filepath)) {
    //         header('Content-Description: File Transfer');
    //         header('Content-Type: application/octet-stream');
    //         header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
    //         header('Expires: 0');
    //         header('Cache-Control: must-revalidate');
    //         header('Pragma: public');
    //         header('Content-Length: ' . filesize($filepath));
    //         flush(); // Flush system output buffer
    //         readfile($filepath);
    //         exit;
    //     } else {
    //         die('File not found');
    //     }
    // }
    ?> -->
</body>
</html>
<?php
} else {
    header("location:student_login.php");
}
?>