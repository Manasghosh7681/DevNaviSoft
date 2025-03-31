<?php
session_start();
if (isset($_SESSION['email'])) {
    $current_file = basename(__FILE__);
    include "admin_navbar.html";
    ?>
    <div class="d-flex">
        <?php include_once "admin_sidebar.php"; ?>
        <div id="main-content">
            <h2 style="color:rgb(152, 136, 13)">Room Records</h2>

            <!-- Search Box -->
            <div class="mb-3 d-flex justify-content-between">
                <input type="text" id="searchInput" class="form-control w-50" placeholder="Search rooms...">
            </div>

            <!-- Table to display room records -->
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
                    <tbody id="roomData">
                        <!-- Room records will be loaded here via AJAX -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                <nav>
                    <ul class="pagination" id="pagination">
                        <!-- Pagination will be updated dynamically -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchRooms(query = "", page = 1) {
            $.ajax({
                url: "fetch_rooms.php",
                method: "POST",
                data: { search: query, page: page },
                success: function (response) {
                    let data = JSON.parse(response);
                    $("#roomData").html(data.tableData);
                    $("#pagination").html(data.pagination);
                }
            });
        }

        // Fetch all rooms on page load
        $(document).ready(function () {
            fetchRooms();

            // Search event
            $("#searchInput").on("keyup", function () {
                let query = $(this).val();
                fetchRooms(query);
            });

            // Handle pagination click
            $(document).on("click", ".page-link", function (e) {
                e.preventDefault();
                let page = $(this).data("page");
                let query = $("#searchInput").val();
                fetchRooms(query, page);
            });
        });
    </script>

    <?php
} else {
    header("Location: ../Authentication/login.html");
    exit();
}
?>
