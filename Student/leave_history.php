<?php
session_start();
if(isset($_SESSION['sic'])){
    require_once "../Database/student_db_function.php";
    $res = leaveHistory($_SESSION['sic']);
    if($res){
        $data = $res->fetch_all(MYSQLI_ASSOC);
        echo json_encode($data);
    }else {
        echo "False";
    }
}
?>