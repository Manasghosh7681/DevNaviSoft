<?php

if (isset($_POST['sic'])) {
    function generateRandomNumber()
    {
        $randNum = rand(0, 61);
        return $randNum;
    }
    function generatePassword()
    {
        $text = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $password = "";
        for ($i = 1; $i < 9; $i++) {
            $password .= $text[generateRandomNumber()];
        }
        return $password;
    }

    $password = generatePassword();
    require_once "../Database/student_db_function.php";
    $res = updateStudentPassword($_POST['sic'], $password);

    $receiver = "hotasubrat057@gmail.com";
    $subject = "Hostel Room Allocation Confirmation";
    $body = "   Dear $_POST[name],  \n\n";

    $body .= "We are delighted to inform you that your room at $_POST[hostel] has been successfully allocated. You have been assigned to Room $_POST[room], a $_POST[preference_type] room. We kindly request that you bring a valid student ID and your original documents for verification upon arrival. Should you have any questions or require further assistance, please do not hesitate to contact our hostel support team. We’re excited to welcome you to your new home and hope your stay with us will be both comfortable and enjoyable. You can use your sic $_POST[sic] as a login Id and password is $password.  \n\n";

    $body .= "Warm regards,\nHostel Management Team\nSilicon Hostel\nEmail: info@silicon.ac.in\nContact: 9937289499";
    $sender = "From:abhayakumardas375@gmail.com";
    if (mail($receiver, $subject, $body, $sender)) {
        echo "Email sent";
    } else {
        echo "Failed";
    }


}
?>



<b>Fatal error</b>: Uncaught Error: Call to undefined function generatePassword() in
D:\xampp\htdocs\FinalYearProject\DevNaviSoft\Admin\sending_mail.php:3
Stack trace:
#0 {main}
thrown in <b>D:\xampp\htdocs\FinalYearProject\DevNaviSoft\Admin\sending_mail.php</b> on line <b>3</b><br />