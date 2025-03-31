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
            return $res->fetch_assoc();
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

function fetchAllStudents(){
    global $conn;
    try {

        $records_per_page = 10;
        // Get the current page number from URL, default to 1 if not set
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max($page, 1); // Ensure page is at least 1
        // Calculate the offset
        $offset = ($page - 1) * $records_per_page;
        $total_records_query = "SELECT COUNT(*) AS total FROM students"; // Change 'students' to your table name
        $stmt1 = $conn->prepare($total_records_query);
        $stmt1->execute();
        $result = $stmt1->get_result();
        $total_records = $result->fetch_assoc()['total'];
        // Calculate total pages
        $total_pages = ceil($total_records / $records_per_page);


        $qry = "SELECT * FROM students LIMIT $offset, $records_per_page";
        $stmt= $conn->prepare($qry);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0){
            return [
                'res' => $res,
                'page' => $page,
                'total_pages' => $total_pages
            ];
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
    finally{
        $conn->close();
    }
}
function fetchAllRooms(){
    global $conn;
    try {
        $records_per_page = 10;
        // // Get the current page number from URL, default to 1 if not set
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max($page, 1); // Ensure page is at least 1
        // // Calculate the offset
        $offset = ($page - 1) * $records_per_page;
        $total_records_query = "SELECT COUNT(*) AS total FROM rooms"; // Change 'students' to your table name
        $stmt1 = $conn->prepare($total_records_query);
        $stmt1->execute();
        $result = $stmt1->get_result();
        $total_records = $result->fetch_assoc()['total'];
        // Calculate total pages
        $total_pages = ceil($total_records / $records_per_page);


        $qry = "SELECT * FROM rooms LIMIT $offset, $records_per_page";
        $stmt= $conn->prepare($qry);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0){
            return [
                'res' => $res,
                'page' => $page,
                'total_pages' => $total_pages
            ];
        }else{
            return false;
        }
        



    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
    finally{
        $conn->close();
    }
}
?>