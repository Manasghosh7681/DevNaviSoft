<?php
require_once "../Database/student_db_function.php";
session_start();
$res = pending_leave_list($_SESSION['sic']);
if($res){
    $data = $res->fetch_all(MYSQLI_ASSOC);
    echo json_encode($data);
}
else {
    echo "False";
}
?>