<?php
if(isset($_POST)){
    session_start();
    $current_password = $_POST['currentPassword'];
    $new_password = $_POST['newPassword'];
    $confirm_password = $_POST['confirmPassword'];
    require_once "../Database/student_db_function.php";
    $res = studentLogin($_SESSION['sic'], $current_password);
    if($res){
        if($current_password !== $new_password){
            if($new_password === $confirm_password){
                $res1 = updateStudentPassword($_SESSION['sic'], $new_password);
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