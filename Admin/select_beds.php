<?php
if(isset($_POST['room_id'])){
    $room_id = $_POST['room_id'];
    require_once "../Database/admin_db_functions.php";
    $res = fetchBeds($room_id);
    if($res){
        $data = $res->fetch_all(MYSQLI_ASSOC);
        echo json_encode($data);
    }
}

?>