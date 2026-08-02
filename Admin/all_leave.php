<?php
session_start();
// Database connection
require_once '../Database/connection.php';
if (isset($_SESSION['email'])) {
    include "./admin_navbar.html";
    $current_file = "admin_leave.php";
    include "admin_navbar.html";
    $sql = "SELECT * FROM leave_request ORDER BY apply_date DESC";
    $result = $conn->query($sql);
    // Fetch all leave requests
    ?>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        .fa-icon {
            margin-right: 6px;
            color: #555;
        }
    </style>
    <div class="d-flex">
        <?php
            include_once "admin_sidebar.php";
        ?>
        <div id="main-content">
            <h2>All Leave Requests</h2>
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-id-card fa-icon"></i>SIC</th>
                        <th><i class="fas fa-calendar-alt fa-icon"></i>Apply Date</th>
                        <th><i class="fas fa-moon fa-icon"></i>Leave Days</th>
                        <th><i class="fas fa-comment-dots fa-icon"></i>Reason</th>
                        <th><i class="fas fa-hourglass-half fa-icon"></i>Status</th>
                        <th><i class="fas fa-tasks fa-icon"></i>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['sic']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['apply_date']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['leave_days']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['reason']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                            echo "<td>
                                <a href='edit_leave.php?id=" . $row['sno'] . "'><i class='fas fa-edit'></i></a> |
                                <a href='delete_leave.php?id=" . $row['sno'] . "' onclick='return confirm(\"Are you sure?\")'><i class='fas fa-trash-alt'></i></a>
                              </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No leave requests found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
} else {
    header("Location: ../login.php");
    exit();
}
$conn->close();
?>