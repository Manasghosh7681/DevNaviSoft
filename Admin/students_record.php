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

                <div class="my-3 d-flex justify-content-between">
                    <h2 style="color:rgb(152, 136, 13)">Students Records</h2>
                    <input type="text" id="searchInput" class="form-control w-50 w-md-25" placeholder="Search students...">
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>SIC</th>
                                <th>Name</th>
                                <th>Branch</th>
                                <th>Year</th>
                                <th>Gender</th>
                                <th>Preference</th>
                                <th>Add</th>
                            </tr>
                        </thead>
                        <tbody id="studentData">
                        </tbody>
                    </table>
                </div>

            <div class="d-flex justify-content-center mt-3">
                <nav>
                    <ul class="pagination" id="pagination">
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchStudents(query = "", page = 1) {
            $.ajax({
                url: "fetch_students.php",
                method: "POST",
                data: { search: query, page: page },
                success: function (response) {

                    let data = JSON.parse(response);
                    $("#studentData").html(data.tableData);
                    $("#pagination").html(data.pagination);
                }
            });
        }

        // Fetch all rooms on page load
        $(document).ready(function () {
            fetchStudents();

            // Search event
            $("#searchInput").on("keyup", function () {
                let query = $(this).val();
                fetchStudents(query);
            });

            // Handle pagination click
            $(document).on("click", ".page-link", function (e) {
                e.preventDefault();
                let page = $(this).data("page");
                let query = $("#searchInput").val();
                fetchStudents(query, page);
            });
        });
    </script>
    <?php
} else {
    header("Location: ../Authentication/login.html");
    exit(); // Always use exit() after header redirection
}
?>