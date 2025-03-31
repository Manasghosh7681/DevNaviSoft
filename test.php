<?php
session_start();
if (isset($_SESSION['email'])) {
    $current_file = basename(__FILE__);
    include "admin_navbar.html";
    ?>
    <div class="d-flex">
        <?php include_once "admin_sidebar.php"; ?>
        <div id="main-content">
            <?php require_once "../Database/admin_db_functions.php";
            $paginatioinData = fetchAllRooms();
            $res = $paginatioinData['res'];
            $page = $paginatioinData['page'];
            $total_pages = $paginatioinData['total_pages'];
            if ($res) {
                ?>
                <h2 style="color:rgb(152, 136, 13)">Room Records</h2>

                <!-- Search Box -->
                <div class="mb-3 d-flex justify-content-between">
                    <input type="text" id="searchInput" class="form-control w-50" placeholder="Search rooms...">
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center" id="roomTable">
                        <thead class="table-dark">
                            <tr>
                                <th>Room ID</th>
                                <th>Room No</th>
                                <th>Room Type</th>
                                <th>Hostel Name</th>
                                <th>Bed Capacity</th>
                                <th>Available Beds</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($room = $res->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $room['room_id'] ?></td>
                                    <td><?php echo $room['room_no'] ?></td>
                                    <td><?php echo $room['room_type'] ?></td>
                                    <td><?php echo $room['hostel_name'] ?></td>
                                    <td><?php echo $room['bed_capacity'] . " Beds" ?></td>
                                    <td><?php echo $room['availability_beds'] . " Beds" ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php
            }
            ?>

            <div class="d-flex justify-content-center mt-3">
                <nav>
                    <ul class="pagination">
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo; Prev</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                                <span aria-hidden="true">Next &raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("searchInput").addEventListener("keyup", function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#roomTable tbody tr");

            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
        });
    </script>

    <?php
} else {
    header("Location: ../Authentication/login.html");
    exit();
}
?>
