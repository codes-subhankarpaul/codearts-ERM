<?php
session_start();
include "database.php";

if(isset($_POST)) {
    $s_uid= $_SESSION['emp_id'];
	$r_uid= $_POST['from_user_id'];
    // $r_uid = $_POST['to_user_id'];
	// $chats = array();
	$q="UPDATE `capms_personal_chat` SET `chat_status`='0' WHERE `to_user_id`='".$s_uid."' AND `from_user_id`='".$r_uid."' AND `chat_status`='1'";
	$result=mysqli_query($con,$q);
	
}
?>