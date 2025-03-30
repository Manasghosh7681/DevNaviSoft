<?php
require_once "connection.php";

function fetchAdminData($userId, $password){
    global $conn;
    try {
        $qry = "SELECT * FROM admin WHERE adminId = ? AND password = ?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ss", $userId, $password);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    finally{
        $conn->close();
    }
}
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
function displayAllPendingLeave(){
    global $conn;
    try{
        $qry = "SELECT * FROM leave_request WHERE status='Pending'";
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
function leaveApproved($sic,$apply_date){
    global $conn;
    try {
        $qry = "UPDATE leave_request SET status='Approved' WHERE sic=? AND apply_date=? AND status='Pending'";
        $stmt= $conn->prepare($qry);
        $stmt->bind_param("ss",$sic,$apply_date);
        $stmt->execute();
        $res = $stmt->get_result();
        if($conn->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }finally{
        $conn->close();
    }
}
function leaveRejected($sic,$apply_date){
    global $conn;
    try {
        $qry = "UPDATE leave_request SET status='Rejected' WHERE sic=? AND apply_date=? AND status='Pending'";
        $stmt= $conn->prepare($qry);
        $stmt->bind_param("ss",$sic,$apply_date);
        $stmt->execute();
        $res = $stmt->get_result();
        if($conn->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }finally{
        $conn->close();
    }
}

function displayAllPendingComplaint(){
    global $conn;
    try{
        $qry = "SELECT * FROM complaint WHERE status='Pending' ORDER BY apply_date DESC";
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
function complaintApproved($sic,$apply_date){
    global $conn;
    try {
        $qry = "UPDATE complaint SET status='Approved' WHERE sic=? AND apply_date=?";
        $stmt= $conn->prepare($qry);
        $stmt->bind_param("ss",$sic,$apply_date);
        $stmt->execute();
        $res = $stmt->get_result();
        if($conn->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }finally{
        $conn->close();
    }
}
function complaintRejected($sic,$apply_date){
    global $conn;
    try {
        $qry = "UPDATE complaint SET status='Rejected' WHERE sic=? AND apply_date=?";
        $stmt= $conn->prepare($qry);
        $stmt->bind_param("ss",$sic,$apply_date);
        $stmt->execute();
        $res = $stmt->get_result();
        if($conn->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }finally{
        $conn->close();
    }
}
?>