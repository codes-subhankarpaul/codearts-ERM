<?php
require_once "database.php";
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if(isset($_POST['leave_status'])) {
    $sql = "UPDATE `capms_admin_individual_leaves` SET `leave_status` = '".$_POST['leave_status']."' WHERE `capms_admin_individual_leaves`.`leave_id` = '".$_REQUEST['leave_id']."'";
    $u_id = $_REQUEST['user_id'];
    if ($con->query($sql) === TRUE) {
        header('location:employee_leave_view.php?user_id='.$u_id);
        exit();
    } 
    else {
        echo "Error updating record: " . $con->error;
    }
}

$con->close();
?>