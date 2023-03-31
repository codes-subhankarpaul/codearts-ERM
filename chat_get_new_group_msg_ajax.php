<?php
include "database.php";

if(isset($_POST)) {
	$id = $_POST['last_message_id'];
	$chats = array();

	if(isset($_POST)) {
		$q="select * from capms_group_chat where message_id > $id";
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

