<?php
session_start();
include "database.php";

if(isset($_POST)) {
	$id = $_POST['last_message_id'];
    $s_uid= $_SESSION['emp_id'];
    $r_uid = $_POST['to_user_id'];
	$chats = array();

	if(isset($_POST)) {
		$q="select * from capms_personal_chat where (chat_message_id > $id) AND ((to_user_id='".$r_uid."' AND from_user_id='".$s_uid."') OR (to_user_id='".$s_uid."' AND from_user_id='".$r_uid."')) order by created_at;";
        
		$result=mysqli_query($con,$q);
		if(mysqli_num_rows($result)>0) {
			while($row = mysqli_fetch_array($result))
			{
				$chats[] = $row;
			}
		}
		echo json_encode($chats);
	}
}

