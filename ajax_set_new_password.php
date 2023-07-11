<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	include 'database.php';
	//$con = mysqli_connect("localhost","root","","codearts_erm");

	$baseURL = $_REQUEST['baseURL'];
	$password = $_REQUEST['password'];
	$user_mail = $_REQUEST['user_mail'];

	$sql1 = "UPDATE capms_admin_users SET user_password = '".md5($password)."', updated_at = '".date('Y-m-d h:i:s', strtotime('now'))."' WHERE user_email = '".$user_mail."' ";
	$result1 = mysqli_query($con, $sql1);
	echo json_encode( array( "status" => 'success' ) );
?>