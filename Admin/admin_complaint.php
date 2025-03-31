<?php
session_start();
if ($_SESSION['email']) {
    include "./admin_navbar.html";
    $current_file = basename(__FILE__);
    ?>
    <div class="d-flex">
        <?php include "./admin_sidebar.php" ?>
        <div id="main-content" class="container">
            <?php require_once "../Database/admin_db_functions.php";
            $res = displayAllPendingComplaint();
            if ($res) {
                ?>
                <div class="table-responsive">
                    <h4 class="text-center fw-bold">Complaint Request</h4>
                    <table class="table table-bordered table-hover text-center">
                        <thead class="table-dark text-warning">
                            <tr>
                                <th><i class="fas fa-id-card"></i> SIC</th>
                                <th><i class="fas fa-exclamation-circle"></i> Complaint Type</th>
                                <th><i class="fas fa-file-alt"></i> Complaint Description</th>
                                <th><i class="fas fa-paperclip"></i> File</th>
                                <th><i class="fas fa-hourglass-half"></i> Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-light">
                            <?php
                            while ($data = $res->fetch_assoc()) {
                                ?>
                                <>
                                    <td class="sic"><?php echo $data['sic'] ?></td>
                                    <td><?php echo $data['complaint_type'] ?></td>
                                    <td><?php echo $data['complaint_description'] ?></td>
                                    <td>
                                        <?php
                                        if ($data['file'] === "empty") {
                                            echo "No File";
                                        } else {
                                            ?>
                                            <a href="../Complaint files/<?php echo $data['file'] ?>" target="_blank">
                                                <i class="fas fa-download"></i> Download</a>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-success approve"
                                            data-approve="<?php echo $data['apply_date'] ?>">Approve</button>
                                        <button class="btn btn-danger reject"
                                            data-reject="<?php echo $data['apply_date'] ?>">Reject</button>
                                    </td>
                                    </tr>
                                    <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
            } else {
                echo "<h2 class='text-center mt-5'>No Complaint Request</h2>";
            }
            ?>
        </div>
    </div>
    <?php
}else {
    header("Location: ../Authentication/login.html");
    exit(); // Always use exit() after header redirection
}
?>
<script src="../Jquery/jquery-3.7.1.js"></script>
<script>
    $(document).on("click", ".approve", function() {
        let apply_date = $(this).data("approve");
        let status = document.querySelector(".approve").innerHTML
        let row = $(this).closest("tr");
        let sic = row.find(".sic").text();
        $.ajax({
            url: "admin_complaint_approval.php",
            method: "POST",
            data: {
                "sic": sic,
                "apply_date": apply_date,
                "status": status
            },
            success: function(data) {
                
            }
        })
        window.location = "admin_complaint.php";
    })
    $(document).on("click", ".reject", function() {
        let apply_date = $(this).data("reject");
        let status = document.querySelector(".reject").innerHTML
        let row = $(this).closest("tr");
        let sic = row.find(".sic").text();
        $.ajax({
            url: "admin_complaint_approval.php",
            method: "POST",
            data: {
                "sic": sic,
                "apply_date": apply_date,
                "status": status
            },
            success: function(data) {
            }
        })
        window.location = "admin_complaint.php";
    })
</script>