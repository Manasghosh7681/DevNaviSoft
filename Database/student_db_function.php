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
function apply_leave($sic,$apply_date,$leave_days,$destination,$contact_no,$reason,$status){
    global $conn;
    try {
        $qry = "INSERT INTO leave_request(sic,apply_date,leave_days,destination,contact_no,reason,status)VALUES(?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ssssiss",$sic,$apply_date,$leave_days,$destination,$contact_no,$reason,$status);
        $res = $stmt->execute();
        return $res;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    finally{
        $conn->close();
    }
}
function pending_leave_list($sic){
    global $conn;
    try {
        $qry = "SELECT * FROM leave_request WHERE status='Pending' OR status='Approved' OR status='Rejected' AND sic=? ORDER BY sno DESC";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s",$sic);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0){
            return $res;
        }
        else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function withdraw($sic,$apply_date){
    global $conn;
    try {
        $qry = "UPDATE leave_request SET status='Withdraw' WHERE sic=? AND apply_date=? AND status='Pending' OR status='Approved'";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ss",$sic,$apply_date);
        $stmt->execute();
        if($conn->affected_rows>0){
            return true;
        }else{
            return false;
        } 
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function  leaveHistory($sic){
    global $conn;
    try {
        $qry = "SELECT * FROM leave_request WHERE sic=? ORDER BY sno DESC";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s",$sic);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0){
            return $res;
        }
        else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>