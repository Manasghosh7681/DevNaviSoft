<?php
$sic = $_POST['sic'] ;
$status = $_POST['status'] ;
$apply_date = $_POST['apply_date'];
require_once "../Database/admin_db_functions.php";
if($status === 'Approved'){
    $response = leaveApproved($sic,$apply_date);
    if($response){
        echo "True";
    }else{
        echo "$apply_date";
    }
}else{
    $response = leaveRejected($sic,$apply_date);
    if($response){
        echo "False";
    }
}
?>