<?php
if (isset($_POST['hostel_name'])) {
    $hostel_name = $_POST['hostel_name'];
    $non_ac_rooms = (int) $_POST['non_ac_rooms'];
    $ac_rooms =(int) $_POST['ac_rooms'];

    require "../Database/admin_db_functions.php";
    
    function addRoomDetails($room_code, $hostel_name, $non_ac_rooms, $ac_rooms)
    {
        $counter = 0;
        $max_roomNo = getMaximumRoomNoFromRoomsTable($hostel_name);
        for ($i = $max_roomNo + 1; $i <= $non_ac_rooms + $max_roomNo; $i++) {
            $room_id = $room_code.$i;
            $room_no = $i;
            $room_type = "NON-AC";
            $bed_capacity = 4;
            $available_beds = 0;
            $status = "Available";
            $res1 = insertRooms($room_id, $room_no, $room_type, $hostel_name, $bed_capacity, $available_beds, $status);
            // for ($j = 'A'; $j <= 'D' ; $j++) { 
            //     $bed_id = $room_id.$j;
            //     $res2 = insertBeds($bed_id,$room_id,'Vacant');
            // }
            if ($res1) {
                $counter = 1;
            }
        }
        $max_roomNo = getMaximumRoomNoFromRoomsTable($hostel_name);
        for ($i = $max_roomNo + 1; $i <= $ac_rooms + $max_roomNo; $i++) {
            $room_id = $room_code.$i;
            $room_no = $i;
            $room_type = "AC";
            $bed_capacity = 3;
            $available_beds = 0;
            $status = "Available";
            $res = insertRooms($room_id, $room_no, $room_type, $hostel_name, $bed_capacity, $available_beds, $status);
            // for ($j = 'A'; $j <= 'C' ; $j++) { 
            //     $bed_id = $room_id.$j;
            //     $res2 = insertBeds($bed_id,$room_id,'Vacant');
            // }
            if ($res) {
               $counter = 1;
            }
        }
        if($counter == 1){
            echo "True";
        }else{
            echo "False";
        }
    }

    if($hostel_name === 'Girls Hostel'){
        addRoomDetails('GH-',$hostel_name,$non_ac_rooms,$ac_rooms);
    }else if($hostel_name === 'Boys Hostel 1'){
        addRoomDetails('BH1-',$hostel_name,$non_ac_rooms,$ac_rooms);
    }else if($hostel_name === 'Boys Hostel 2'){
        addRoomDetails('BH2-',$hostel_name,$non_ac_rooms,$ac_rooms);
    }else if($hostel_name === 'Boys Hostel 3'){
        addRoomDetails('BH3-',$hostel_name,$non_ac_rooms,$ac_rooms);
    }
    
}

?>