
<div class="offcanvas offcanvas-start bg-dark text-white w-50" tabindex="-1" id="offcanvasSidebar"
    aria-labelledby="offcanvasSidebarLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <nav class="sidebar">
            <a class="nav-link <?php echo $current_file === 'student_dashboard.php' ? 'active' : '' ?>"
                href="student_dashboard.php"><i class="fa fa-fw fa-home"></i> Dashboard</a>
            <a class="nav-link <?php echo $current_file === 'student_leave.php' ? 'active' : '' ?>"
                href="student_leave.php"><i class="fa-solid fa-plane-departure"></i> Leave</a>
            <a class="nav-link <?php echo $current_file === 'student_notice_board.php' ? 'active' : '' ?>"
                href="student_notice_board.php"><i class="fa-solid fa-bell"></i> Notice</a>
            <a class="nav-link" href="#"><i class="fa-solid fa-list"></i> Complain</a>
            <a class="nav-link <?php echo $current_file === '#' ? 'active' : '' ?>" href="#"><i class="fa-solid fa-bars"></i> Feedback</a>
        </nav>
    </div>
</div>
<div class="d-flex">
    <nav id="sidebarMenu" class="sidebar collapse d-md-block bg-dark">
        <a class="nav-link <?php echo $current_file === 'student_dashboard.php' ? 'active' : '' ?>"
            href="student_dashboard.php"><i class="fa fa-fw fa-home"></i> Dashboard</a>
        <a class="nav-link <?php echo $current_file === 'student_leave.php' ? 'active' : '' ?>"
            href="student_leave.php"><i class="fas fa-plane-departure"></i> Apply Leave</a>
        <a class="nav-link <?php echo $current_file === "student_notice_board.php" ? 'active' : '' ?>"
            href="student_notice_board.php"><i class="fa-solid fa-bell"></i> Notice</a>
        <a class="nav-link" href="student_complaint.php"><i class="fa-solid fa-list"></i> Complain</a>
        <a class="nav-link <?php echo $current_file === '#' ? 'active' : '' ?>" href="#"><i class="fa-solid fa-bars"></i> Feedback</a>
    </nav>
</div>