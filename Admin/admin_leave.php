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
            $res = displayAllPendingLeave();
            if ($res) {
            ?>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="table">
                            <tr>
                                <th>SIC</th>
                                <th>Apply Date</th>
                                <th>Leave Days</th>
                                <th>Reason</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-light">
                            <?php
                            while ($data = $res->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td class="sic"><?php echo $data['sic'] ?></td>
                                    <td><?php echo $data['apply_date'] ?></td>
                                    <td><?php echo $data['leave_days'] ?></td>
                                    <td><?php echo $data['reason'] ?></td>
                                    <td>
                                        <button class="btn btn-success mb-1 approve" data-approve="<?php echo $data['apply_date'] ?>">Approve</button>
                                        <button class="btn btn-info text-white reject" data-reject="<?php echo $data['apply_date'] ?>">Reject</button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }else{
                echo "<h2 class='text-center mt-5'>No leave Request</h2>";
            }
            ?>
        </div>
    </div>
<?php
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
            url: "admin_leave_approval.php",
            method: "POST",
            data: {
                "sic": sic,
                "apply_date": apply_date,
                "status": status
            },
            success: function(data) {

            }
        })
        window.location = "admin_leave.php"
    })
    $(document).on("click", ".reject", function() {
        let apply_date = $(this).data("reject");
        let status = document.querySelector(".reject").innerHTML
        let row = $(this).closest("tr");
        let sic = row.find(".sic").text();
        $.ajax({
            url: "admin_leave_approval.php",
            method: "POST",
            data: {
                "sic": sic,
                "apply_date": apply_date,
                "status": status
            },
            success: function(data) {

            }
        })
        window.location = "admin_leave.php"
    })
</script>