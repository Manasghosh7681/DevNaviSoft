<?php
$userId = $_POST['userId'];
$password = $_POST['password'];
if($userId === "admin@silicon.ac.in"){
    require_once "../Database/admin_db_functions.php";
    $res = fetchAdminData($userId, $password);
    if($res){
       echo "Admin True Data";
    } else{
        echo "Admin False Data";
    }
}
?>