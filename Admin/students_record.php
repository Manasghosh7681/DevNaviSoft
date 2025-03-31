<?php
session_start();
if (isset($_SESSION['email'])) {
    $current_file = basename(__FILE__);
    include "admin_navbar.html"
        ?>
    <div class="d-flex">
        <?php
        include_once "admin_sidebar.php";
        ?>
        <div id="main-content">
            <?php require_once "../Database/admin_db_functions.php";
            $paginatioinData = fetchAllStudents();
            $res = $paginatioinData['res'];
            $page = $paginatioinData['page'];
            $total_pages = $paginatioinData['total_pages'];
            if ($res) {
                ?>
                <h2 style="color:rgb(152, 136, 13)">Student Records</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>SIC</th>
                                <th>Name</th>
                                <th>Branch</th>
                                <th>Year</th>
                                <th>Gender</th>
                                <th>Add</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($std = $res->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $std['sic'] ?></td>
                                    <td><?php echo $std['name'] ?></td>
                                    <td><?php echo $std['branch'] ?></td>
                                    <td><?php echo $std['year']." year" ?></td>
                                    <td><?php echo $std['gender'] ?></td>
                                    <td><a href="student_form.php?sic=<?php echo $std['sic'] ?>"
                                            class="btn btn-info text-white">Allocate Room</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <?php
            }
            ?>
            <div class="d-flex justify-content-center mt-3">
                <nav>
                    <ul class="pagination">
                        <!-- Previous Button -->
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo; Prev</span>
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <!-- Next Button -->
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
    <?php
} else {
    header("Location: ../Authentication/login.html");
    exit(); // Always use exit() after header redirection
}
?> 
