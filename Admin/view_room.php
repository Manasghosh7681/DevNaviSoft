<?php
session_start();
if (isset($_SESSION['email'])) {
    $current_file = basename(__FILE__);
    include "admin_navbar.html";
    ?>

    <div class="d-flex">
        <?php include_once "admin_sidebar.php"; ?>
        <div id="main-content">
            <?php
            require_once "../Database/admin_db_functions.php";
            $data = fetchStudentsFromRoom($_GET['room_id']);
            if ($data) {
                $room = $data[1]->fetch_assoc();
                ?>
                <h4 style="color:rgb(152, 136, 13)">Room No: <?php echo "$room[room_no] ($room[hostel_name])" ?></h4>
                <div class="row g-4">
                    <?php
                    while ($std = $data[0]->fetch_assoc()) {
                        ?>
                        <div class="col-md-6">
                            <div class="profile-container">
                                <div class="profile-icon">
                                    <i class="fa-solid fa-circle-user"></i>
                                </div>
                                <div class="profile-info">
                                    <div class="profile-info-content">
                                        <p><strong>Name:</strong> <?php echo $std['name'] ?></p>
                                        <p><strong>SIC:</strong> <?php echo $std['sic'] ?></p>
                                        <p><strong>Branch:</strong> <?php echo $std['branch'] ?></p>
                                        <p><strong>Year:</strong> <?php echo $std['year'] ?> Year</p>
                                    </div>
                                    <button class="btn btn-danger btn-outline-light border-danger deallocate-btn" 
                                            data-sic="<?php echo $std['sic']?>" 
                                            data-bedId="<?php echo $std['bed_id']?>"
                                            data-roomId="<?php echo $std['room_id']?>">
                                            Deallocate
                                    </button>
                                    <!-- <button class="btn btn-outline-warning remove-btn" 
                                            data-sic="<?php echo $std['sic']?>" 
                                            data-bedId="<?php echo $std['bed_id']?>"
                                            data-roomId="<?php echo $std['room_id']?>">
                                            Remove
                                    </button> -->
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>

                </div>
                <?php
            } else {
                echo "<h4>This room not allocated yet.</h4>";
            }
            ?>
        </div>
    </div>
    <?php
} else {
    header("Location: ../Authentication/login.html");
    exit();
}
?>


<script src="../Jquery/jquery-3.7.1.js"></script>
<script>
  document.querySelectorAll('.deallocate-btn').forEach(button => {
    button.addEventListener('click', function () {
        const sic = this.dataset.sic;
        const bedId = this.dataset.bedid;
        const roomId = this.dataset.roomid;
        
        deallocate(sic,bedId,roomId);
    });
});
function deallocate(sic,bedId,roomId){
    $.ajax({
        url: "student_deallocation.php",
        method: "POST",
        data:{'sic': sic, 'bedId': bedId, 'roomId': roomId},
        success: function(data){
            // console.log(data);
            location.reload()
        }
    })
}
</script>