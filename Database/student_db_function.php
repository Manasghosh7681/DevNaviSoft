<?php
require_once "connection.php";
function displayAllNotice(){
    global $conn;
    try{
        $qry = "SELECT * FROM notice ORDER BY notice_date DESC";
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
        $conn->close();
    }
}
?>