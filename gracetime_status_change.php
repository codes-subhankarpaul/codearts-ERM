<?php
require_once "database.php";
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if(isset($_POST['status'])) {
    $sql = "UPDATE `capms_gracetime_info` SET `status` = '".$_POST['status']."' WHERE `capms_gracetime_info`.`id` = '".$_REQUEST['gracetime_id']."'";

    if ($con->query($sql) === TRUE) {
        header('location:gracetime.php');
        exit();
    } 
    else {
        echo "Error updating record: " . $con->error;
    }
}

$con->close();
?>