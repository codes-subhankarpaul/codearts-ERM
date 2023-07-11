<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	include 'database.php';
	//$con = mysqli_connect("localhost","root","","codearts_erm");

	$baseURL = $_REQUEST['baseURL'];
	$status = $_REQUEST['status'];
	$date_today = date('d-m-Y', strtotime('now'));
	$time_now = date('g:i A', strtotime('now'));
	$emp_id = $_REQUEST['emp_id'];

	$sql1 = "SELECT * FROM capms_login_information WHERE user_id = '".$emp_id."' AND login_date = '".$date_today."' ";
	$result1 = mysqli_query($con, $sql1);
	if($result1->num_rows > 0)
	{
		while($row1 = mysqli_fetch_assoc($result1))
		{
			if($row1['evening_break_start'] == '' && $row1['evening_break_end'] == '' && $status == 'start_now')
			{
				$sql2 = "UPDATE capms_login_information SET evening_break_start = '".$time_now."' WHERE user_id = '".$emp_id."' AND login_date = '".$date_today."' ";
				$result2 = mysqli_query($con, $sql2);
				echo json_encode(array( "status" => 'evening_break_started' ) );
			}
			else if($row1['evening_break_start'] != '' && $row1['evening_break_end'] == '' && $status == 'stop_now')
			{
				$sql3 = "UPDATE capms_login_information SET evening_break_end = '".$time_now."' WHERE user_id = '".$emp_id."' AND login_date = '".$date_today."' ";
				$result3 = mysqli_query($con, $sql3);
				echo json_encode(array( "status" => 'evening_break_stopped' ) );
			}
			else if($row1['evening_break_start'] != '' && $row1['evening_break_end'] != '' && $status == 'blank')
			{
				echo json_encode(array( "status" => 'evening_break_stopped' ) );
			}
			else if($row1['evening_break_start'] != '' && $row1['evening_break_end'] == '' && $status == 'blank')
			{
				echo json_encode(array( "status" => 'evening_break_started' ) );
			}
			else if($row1['evening_break_start'] != '' && $row1['evening_break_end'] && $status == 'start_now')
			{
				echo json_encode(array( "status" => 'evening_break_stopped') );
			}
		}
	}