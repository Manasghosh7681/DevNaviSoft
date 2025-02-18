<?php
session_start();
require_once "../Database/student_db_function.php";
$apply_date = $_POST['apply_date'];
$sic = $_SESSION['sic'];
$res = withdraw($sic,$apply_date);
if($res) echo "True";
else echo "False";
?>