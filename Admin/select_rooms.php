<?php
if(isset($_POST['hostel_name'])){
    $hostel_name = $_POST['hostel_name'];
    $preference_type = $_POST['preference_type'];
    require_once "../Database/admin_db_functions.php";
    $res = fetchSelectedRooms($hostel_name, $preference_type);
    if($res){
        $data = $res->fetch_all(MYSQLI_ASSOC);
        echo json_encode($data);
    }
}

?>