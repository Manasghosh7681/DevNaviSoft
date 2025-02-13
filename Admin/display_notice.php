<?php
require_once "../Database/admin_db_functions.php";
$res = displayAllNotice();
if($res){
    $data = $res->fetch_all(MYSQLI_ASSOC);
    echo json_encode($data);
}else{
    echo "false";
}
?>