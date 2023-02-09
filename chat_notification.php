<?php
session_start();
include "database.php";

if(isset($_POST)) {
    $s_uid= $_SESSION['emp_id'];
	// $r_uid= $_POST['from_user_id'];
    // $r_uid = $_POST['to_user_id'];
	$chats = array();
	// $q="SELECT * FROM `capms_personal_chat` WHERE `to_user_id`='".$s_uid."' AND `from_user_id`='".$r_uid."' AND `chat_status`='1'";
	$q="SELECT * FROM `capms_personal_chat` WHERE `to_user_id`='".$s_uid."' AND `chat_status`='1'";
	$result=mysqli_query($con,$q);
	// echo $q;
	if(mysqli_num_rows($result)>0) {
		// echo mysqli_num_rows($result);
		while($row = mysqli_fetch_array($result))
		{
			$q_s = "SELECT * FROM `capms_personal_chat` WHERE `to_user_id`='".$s_uid."' AND `from_user_id`='".$row['from_user_id']."' AND `chat_status`='1'";
			$r_s = mysqli_query($con,$q_s);
			$chats[] = array(
				'f_id'=> $row['from_user_id'],
				'count'=> mysqli_num_rows($r_s)
			);
		}
		echo json_encode($chats);
	}
	
}
?>