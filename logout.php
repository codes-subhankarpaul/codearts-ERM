<?php
	session_start();
	$baseURL = 'http://capms.codeartssolution.com/';
	date_default_timezone_set('Asia/Kolkata');
	$con = mysqli_connect("localhost","root","","codearts_pms_new");

	if(isset($_SESSION['emp_id']))
	{
		$sql1 = "SELECT * FROM capms_login_information WHERE user_id = '".$_SESSION['emp_id']."' AND login_date = '".date('d-m-Y', strtotime('now'))."' ";
	    $result1 = mysqli_query($con, $sql1);
		if($result1->num_rows > 0)
	    {
	        $sql2 = "UPDATE capms_login_information SET logout_time = '".date('G-i-s', strtotime('now'))."' WHERE login_date = '".date('d-m-Y', strtotime('now'))."' AND user_id = '".$_SESSION['emp_id']."' ";
	        $result2 = mysqli_query($con, $sql2);
	    }
		unset($_SESSION['emp_id']);
		unset($_SESSION['emp_name']);
		unset($_SESSION['emp_image']);
	}
	session_destroy();

	echo "<script>location.href='".$baseURL."login.php';</script>";
?>