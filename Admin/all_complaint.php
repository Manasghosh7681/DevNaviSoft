<?php
session_start();
// Database connection
require_once '../Database/connection.php';
if (isset($_SESSION['email'])) {
    include "./admin_navbar.html";
    $current_file = "admin_complaint.php";
    include "admin_navbar.html";
    $sql = "SELECT * FROM complaint ORDER BY apply_date DESC";
    $result = $conn->query($sql);
    // Fetch all complaint requests
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
            <h2>All Complaint Requests</h2>
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-calendar-alt fa-icon"></i>Apply Date</th>
                        <th><i class="fas fa-id-card"></i> SIC</th>
                        <th><i class="fas fa-exclamation-circle"></i> Complaint Type</th>
                        <th><i class="fas fa-file-alt"></i> Description</th>
                        <th><i class="fas fa-tasks"></i> Status</th>
                        <th><i class="fas fa-tasks"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['apply_date']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['sic']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['complaint_type']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['complaint_description']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                            echo "<td>
                                <a href='edit_leave.php?id=" . $row['apply_date'] . "'><i class='fas fa-edit'></i></a> |
                                <a href='delete_leave.php?id=" . $row['apply_date'] . "' onclick='return confirm(\"Are you sure?\")'><i class='fas fa-trash-alt'></i></a>
                              </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No complaint requests found.</td></tr>";
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