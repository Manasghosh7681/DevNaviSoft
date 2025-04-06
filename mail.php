<?php
$receiver = "abhayakumardas2002@gmail.com";
$subject = "Test Email";
$body = "Good Morning";
$sender = "From:abhayakumardas375@gmail.com";
if(mail($receiver, $subject, $body, $sender)) {
    echo "Email sent";
}else{
    echo "Failed";
}
?>