<?php
require_once "connection.php";
function addNotice($notice_title,$notice_date,$notice_description,$notice_file="empty"){
    global $conn;
    try{
        $qry = "INSERT INTO notice(notice_title,notice_date,notice_description,notice_file)VALUES(?,?,?,?)";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ssss",$notice_title,$notice_date,$notice_description,$notice_file);
        $res = $stmt->execute();
        return $res;
    }catch(Exception $e){
        echo $e->getMessage();
    }finally{
        // $conn->close();
    }
}
function displayAllNotice(){
    global $conn;
    try{
        $qry = "SELECT * FROM notice";
        $stmt = $conn->prepare($qry);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0)
            return $res;
        else{
            return false;
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }finally{
        // $conn->close();
    }
}
?>