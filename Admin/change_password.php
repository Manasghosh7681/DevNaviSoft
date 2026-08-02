<?php
if(isset($_POST)){
    $current_password = $_POST['currentPassword'];
    $new_password = $_POST['newPassword'];
    $confirm_password = $_POST['confirmPassword'];
    require_once "../Database/admin_db_functions.php";
    $res = fetchAdminData("admin@silicon.ac.in",$current_password);
    if($res){
        if($current_password !== $new_password){
            if($new_password === $confirm_password){
                $res1 = updateAdminPassword($new_password);
                if($res1){
                    echo "<script>alert('Updated Successfully.');window.history.back();</script>";
                }
            }else{
                echo "<script>alert('New password and confirm password do not match.');window.history.back();</script>";
            }
        }else{
            echo "<script>alert('New Password already exist.');window.history.back();</script>";
        }
    }else{
        echo "<script>alert('Current Password is incorrect.');window.history.back();</script>";
    }
}
?>