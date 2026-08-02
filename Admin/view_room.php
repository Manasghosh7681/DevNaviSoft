<?php
session_start();
if (isset($_SESSION['email'])) {
    $current_file = basename(__FILE__);
    include "admin_navbar.html";
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Room Allocation | Hostel Management System</title>
        <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../Bootstrap/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            :root {
                --primary-color: #3498db;
                --secondary-color: #2c3e50;
                --accent-color: #e74c3c;
                --light-color: #ecf0f1;
                --dark-color: #2c3e50;
                --success-color: #2ecc71;
                --warning-color: #f39c12;
                --info-color: #3498db;
            }

            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f5f7fa;
                color: var(--dark-color);
            }

            #main-content {
                padding: 2rem;
                width: 100%;
                transition: all 0.3s;
            }

            .profile-container {
                background: white;
                border-radius: 10px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                height: 100%;
                display: flex;
                flex-direction: column;
            }

            .profile-container:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            }

            .profile-icon {
                background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
                color: white;
                text-align: center;
                padding: 1.5rem;
                font-size: 3rem;
            }

            .profile-info {
                padding: 1.5rem;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
            }

            .profile-info-content {
                flex-grow: 1;
            }

            .profile-info p {
                margin-bottom: 0.8rem;
                font-size: 0.95rem;
            }

            .profile-info p strong {
                color: var(--secondary-color);
                font-weight: 600;
            }

            .deallocate-btn {
                margin-top: 1rem;
                align-self: flex-end;
                font-weight: 500;
                transition: all 0.3s;
                border-radius: 6px;
                padding: 0.5rem 1.25rem;
            }

            .deallocate-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(231, 76, 60, 0.3);
            }

            .room-header {
                background: linear-gradient(135deg, var(--secondary-color), var(--dark-color));
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 8px;
                margin-bottom: 2rem;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                display: inline-block;
            }

            .room-header h4 {
                margin: 0;
                font-weight: 600;
            }

            .empty-state {
                text-align: center;
                padding: 3rem;
                background: white;
                border-radius: 10px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            }

            .empty-state i {
                color: var(--warning-color);
            }

            .empty-state h4 {
                color: var(--secondary-color);
                font-weight: 600;
            }

            @media (max-width: 768px) {
                #main-content {
                    padding: 1rem;
                }

                .profile-container {
                    margin-bottom: 1.5rem;
                }
            }
        </style>
    </head>

    <body>
        <div class="d-flex">
            <?php include_once "admin_sidebar.php"; ?>
            <div id="main-content">
                <?php
                require_once "../Database/admin_db_functions.php";
                $data = fetchStudentsFromRoom($_GET['room_id']);
                if ($data) {
                    $room = $data[1]->fetch_assoc();
                    ?>
                    <div class="room-header">
                        <h4><i class="fas fa-door-open me-2"></i> Room No: <?php echo "$room[room_no] ($room[hostel_name])" ?>
                        </h4>
                    </div>
                    <div class="row g-4">
                        <?php
                        while ($std = $data[0]->fetch_assoc()) {
                            ?>
                            <div class="col-md-6 col-lg-3">
                                <div class="profile-container">
                                    <div class="profile-icon">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="profile-info">
                                        <div class="profile-info-content">
                                            <p><strong><i class="fas fa-user me-2"></i>Name:</strong> <?php echo $std['name'] ?></p>
                                            <p><strong><i class="fas fa-id-card me-2"></i>SIC:</strong> <?php echo $std['sic'] ?>
                                            </p>
                                            <p><strong><i class="fas fa-code-branch me-2"></i>Branch:</strong>
                                                <?php echo $std['branch'] ?></p>
                                            <p><strong><i class="fas fa-calendar-alt me-2"></i>Year:</strong>
                                                <?php echo $std['year'] ?> Year</p>
                                        </div>
                                        <button class="btn btn-danger deallocate-btn" data-sic="<?php echo $std['sic'] ?>"
                                            data-bedId="<?php echo $std['bed_id'] ?>" data-roomId="<?php echo $std['room_id'] ?>">
                                            <i class="fas fa-user-minus me-1"></i> Deallocate
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="empty-state">
                        <i class="fas fa-door-closed"></i>
                        <h4 class="mb-3">This room is not allocated yet</h4>
                        <p class="text-muted">No students have been assigned to this room.</p>
                        <a href="students_record.php" class="btn btn-primary">
                                <i class="fas fa-arrow-left"> <span style="color: white; padding-left: 5px;">Back to Allocation</span></i>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Confirm Deallocation</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to deallocate this student from the room?</p>
                        <p class="text-muted small">This action will free up the bed for other students.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeallocate">Deallocate</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="../Jquery/jquery-3.7.1.js"></script>
        <script src="../Bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../Bootstrap/js/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function () {
                let currentSic, currentBedId, currentRoomId;

                // Deallocation button click handler
                $('.deallocate-btn').on('click', function () {
                    currentSic = $(this).data('sic');
                    currentBedId = $(this).data('bedid');
                    currentRoomId = $(this).data('roomid');

                    // Show confirmation modal
                    const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                    modal.show();
                });

                // Confirm deallocation
                $('#confirmDeallocate').on('click', function () {
                    deallocate(currentSic, currentBedId, currentRoomId);
                    $('#confirmationModal').modal('hide');
                });

                function deallocate(sic, bedId, roomId) {
                    $.ajax({
                        url: "student_deallocation.php",
                        method: "POST",
                        data: {
                            'sic': sic,
                            'bedId': bedId,
                            'roomId': roomId
                        },
                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deallocated!',
                                text: 'Student has been successfully deallocated.',
                                confirmButtonColor: 'var(--primary-color)',
                                timer: 2000,
                                timerProgressBar: true
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function (xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred while deallocating the student.',
                                confirmButtonColor: 'var(--primary-color)'
                            });
                        }
                    });
                }
            });
        </script>
    </body>

    </html>
    <?php
} else {
    header("Location: ../Authentication/login.html");
    exit();
}
?>