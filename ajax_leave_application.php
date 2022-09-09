<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	$con = mysqli_connect("localhost","root","","codearts_pms_new");

	$baseURL = $_REQUEST['baseURL'];
	$emp_id = $_REQUEST['emp_id'];
	$emp_name = $_REQUEST['emp_name'];
	$emp_dept = $_REQUEST['emp_dept'];
	$emp_remaining_pls = $_REQUEST['emp_remaining_pls'];
	$reason_of_leave = $_REQUEST['reason_of_leave'];
	$type_of_leave = $_REQUEST['type_of_leave'];
	$dateList = $_REQUEST['dateList'];
	$total_leaves = $_REQUEST['total_leaves'];
	$leave_message = $_REQUEST['leave_message'];

	$sql1 = "INSERT into capms_admin_leave_applications (leave_ID, user_empid, user_fullname, user_dept, reason_of_leave, leave_start_date, leave_end_date, no_of_leave_days, type_of_leave, leave_message, leave_application_feedback, leave_status, remaining_pls, created_at, updated_at) VALUES ('', '".$emp_id."', '".$emp_name."', '".$emp_dept."', '".$reason_of_leave."', '".$dateList[0]."', '".$dateList[count($dateList)-1]."', '".$total_leaves."', '".$type_of_leave."', '".$leave_message."', '', 'Pending', '".$emp_remaining_pls."', '".date('d-m-Y g:i A', strtotime('now'))."', '".date('d-m-Y g:i A', strtotime('now'))."')";
	$result1 = mysqli_query($con, $sql1);
	$last_insert_id = $con->insert_id;
	foreach($dateList as $eachDate)
	{
		$sql2 = "INSERT into capms_admin_individual_leaves (id, leave_id, user_id, reason_of_leave, type_of_leave, leave_status, leave_date, created_at, updated_at) VALUES ('', '".$last_insert_id."', '".$emp_id."', '".$reason_of_leave."', '".$type_of_leave."', 'Pending', '".$eachDate."', '".date('d-m-Y g:i A', strtotime('now'))."', '".date('d-m-Y g:i A', strtotime('now'))."')";
		$result2 = mysqli_query($con, $result2);
	}

	echo json_encode(
		array( 
			"baseURL" => $baseURL,
			"emp_id" => $emp_id,
			"emp_name" => $emp_name,
			"emp_dept" => $emp_dept,
			"emp_remaining_pls" => $emp_remaining_pls,
			"reason_of_leave" => $reason_of_leave,
			"type_of_leave" => $type_of_leave,
			"dateList" => $dateList,
			"total_leaves" => $total_leaves,
			"leave_message" => $leave_message
		)
	);