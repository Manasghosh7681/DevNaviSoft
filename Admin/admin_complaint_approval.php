<?php
$sic = $_POST['sic'] ;
$status = $_POST['status'] ;
$apply_date = $_POST['apply_date'];
require_once "../Database/admin_db_functions.php";
if($status === 'Approve'){
    $response = complaintApproved($sic,$apply_date);
    if($response){
        echo "True";
    }else{
        echo "False";
    }
}else{
    $response = complaintRejected($sic,$apply_date);
    if($response){
        echo "True";
    }else{
        echo "False";
    }
}
?>