<?php
$conn = new mysqli('127.0.0.1','root','','HMS');
if($conn->connect_error){
    die($conn->error);
}
?>