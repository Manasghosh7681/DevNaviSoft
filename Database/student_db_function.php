<?php
require_once "connection.php";
function studentLogin($sic, $password) {
    global $conn;
    try {
        $qry = "SELECT * FROM students WHERE sic = ? AND password = ?";
        $stmt = $conn->prepare("$qry");
        $stmt->bind_param("ss",  $sic,$password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }finally{
        $conn->close();
    }
}
function displayAllNotice()
{
    global $conn;
    try {
        $qry = "SELECT * FROM notice ORDER BY notice_date DESC";
        $stmt = $conn->prepare($qry);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0)
            return $res;
        else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}
function apply_leave($sic, $apply_date, $leave_days, $destination, $contact_no, $reason, $status)
{
    global $conn;
    try {
        $qry = "INSERT INTO leave_request(sic,apply_date,leave_days,destination,contact_no,reason,status)VALUES(?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ssssiss", $sic, $apply_date, $leave_days, $destination, $contact_no, $reason, $status);
        $res = $stmt->execute();
        return $res;
    } catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        $conn->close();
    }
}
function pending_leave_list($sic)
{
    global $conn;
    try {
        $qry = "SELECT * FROM leave_request WHERE status='Pending' AND sic=? ORDER BY sno DESC";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $sic);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            return $res;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function withdraw($sic, $apply_date)
{
    global $conn;
    try {
        $qry = "UPDATE leave_request SET status='Withdraw' WHERE sic=? AND apply_date=? AND status='Pending' OR status='Approved'";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ss", $sic, $apply_date);
        $stmt->execute();
        if ($conn->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function leaveHistory($sic)
{
    global $conn;
    try {
        $qry = "SELECT * FROM leave_request WHERE sic=? ORDER BY sno DESC";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $sic);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            return $res;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function addComplaint($sic, $complaint_type, $complaint_description, $file, $status,$apply_date)
{
    global $conn;
    try {
        $qry = 'INSERT INTO complaint(sic,complaint_type,complaint_description,file,status,apply_date)VALUES(?,?,?,?,?,?)';
        $stmt = $conn->prepare($qry);
        $stmt->bind_param('ssssss', $sic, $complaint_type, $complaint_description, $file, $status,$apply_date);
        $res = $stmt->execute();
        return $res;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function pending_complaint_list($sic){
    global $conn;
    try {
        $qry = "SELECT * FROM complaint WHERE  sic=? AND status='Pending'";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $sic);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            return $res;
        } else {
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
function complaintHistory($sic){
    global $conn;
    try{
        $qry = "SELECT * FROM complaint WHERE sic=? ORDER BY apply_date DESC";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("s", $sic);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            return $res;
        } else {
            return false;
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }
}

function updateStudentPassword($sic, $password){
    global $conn;
    try {
        $qry = "UPDATE students SET password=? WHERE sic=?";
        $stmt = $conn->prepare($qry);
        $stmt->bind_param("ss", $password,$sic);
        $stmt->execute();
        if ($conn->affected_rows > 0) {
            return true;
        }else{
            return false;
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }finally{
        $conn->close();
    }
}
?>