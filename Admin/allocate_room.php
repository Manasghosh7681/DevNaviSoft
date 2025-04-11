<?php
if(!empty($_POST['bed_id'])){
    $sic = $_POST['sic'];
    $room_id = $_POST['room_id'];
    $bed_id = $_POST['bed_id'];

    require_once "../Database/admin_db_functions.php";
    $res = fetchAvailableBedsInRoom($room_id);
    if($res->fetch_assoc()['availability_beds'] > 1  ){ // if we have more than 1 bed for this room_id

        $res1 = updateRoomTableByAvailability($room_id); // here we update the available of bed
        $res2 = insertIntoRoomAllocationTable($sic,$room_id,$bed_id,);
        $res3 = updateBedsTable($bed_id,$room_id,"Occupied");
        if($res1 && $res2 && $res3){
            echo "True";
        }
    }else{ // Here we have only 1 bed, so allocate it and update this room to 'Full'

        $res1 = updateRoomTableByAvailability($room_id); // here we update the available of bed
        $res2 = insertIntoRoomAllocationTable($sic,$room_id,$bed_id,);
        $res3 = updateBedsTable($bed_id,$room_id,"Occupied");
        if($res1 && $res2 && $res3){
            $response = updateRoomTableByStatus($room_id,"Full");
            echo "True";
        }
    }

}
?>