<?php
session_start();
if ($_SESSION['sic']) {
    include "student_navbar.html";
    $current_file = basename(__FILE__);
?>
    <div class="d-flex">
        <?php include "student_sidebar.php"; ?>
        <div id="main-content" class="container">
            <h2 class="text-center my-4">Notice Board</h2>
            <div class="table-responsive">
                <?php
                require_once "../Database/student_db_function.php";
                $res = displayAllNotice();
                if ($res) {
                ?>
                    <table class="table table-bordered table-hover text-center">
                        <thead class="table-dark">
                            <tr>
                                <th><i class="fas fa-calendar-alt"></i> Notice Date</th>
                                <th><i class="fas fa-bullhorn"></i> Notice Title</th>
                                <th><i class="fas fa-file-alt"></i> Notice Description</th>
                                <th><i class="fas fa-paperclip"></i> File</th>
                            </tr>
                        </thead>
                        <tbody class="table-light">
                            <?php while ($data = $res->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $data['notice_date']; ?></td>
                                    <td><?php echo $data['notice_title']; ?></td>
                                    <td><?php echo $data['notice_description']; ?></td>
                                    <td>
                                        <?php if (($data['notice_file'] !== 'empty')) { ?>
                                            <a href="../Notice files/<?php echo $data['notice_file'] ?>" target="_blank">
                                                <i class="fas fa-download"></i> Download
                                            </a>
                                        <?php } else {
                                            echo "No File";
                                        } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "<h4 class='text-center text-danger'>No Notices Available</h4>";
                }
                ?>
            </div>
        </div>
    </div>
<?php
} else {
    header("location:student_login.php");
}

?>