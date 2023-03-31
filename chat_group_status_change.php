<?php
session_start();
include "database.php";

if(isset($_POST)) {
    // $s_uid= $_SESSION['emp_id'];
	// $r_uid= $_POST['from_user_id'];
    $q="UPDATE `capms_group_chat` SET `chat_status`='0' WHERE `chat_status`='1'";
    $result=mysqli_query($con,$q);

}
?>