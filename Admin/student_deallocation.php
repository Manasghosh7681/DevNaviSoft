<?php
if(isset($_POST['sic'])){
    $sic = $_POST['sic'];
    $bed_id = $_POST['bedId'];
    $room_id = $_POST['roomId'];
    require_once "../Database/admin_db_functions.php";
    $res1 = removeFromRoomAllocation($sic);
    $res2 = deallocateBed($bed_id);
    $res3 = deallocateRoomTable($room_id);
    if($res1 && $res2){
        echo "True";
    }else{
        echo "False";
    }
}
?>