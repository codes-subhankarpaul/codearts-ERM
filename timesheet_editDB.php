<?php
require './database.php';
$timesheet_date = $_REQUEST['dt'];
$start_time = $_REQUEST['start_time'];
$end_time = $_REQUEST['end_time'];
$task_domain = $_REQUEST['task_domain'];
$task_type = $_REQUEST['task_type'];
$description = $_REQUEST['description'];
$trello_link = $_REQUEST['trello_link'];
$task_id = $_REQUEST['task_id'];
$project_id = $_REQUEST['project'];
$created_at = date('Y-m-d h:i:s', strtotime('now'));
$updated_at = date('Y-m-d h:i:s', strtotime('now'));

echo $timesheet_update_sql = "UPDATE `capms_user_timesheet` SET `user_id`='".$_SESSION['emp_id']."',`workload_id`='".$_SESSION['workload_id']."',`timesheet_date`='".$timesheet_date."',`start_time`='".$start_time."',`end_time`='".$end_time."',`task_domain`='".$task_domain."',`task_type`='".$task_type."',`description`='".$description."',`trello_link`='".$trello_link."',`created_at`='".$created_at."',`updated_at`='".$updated_at."' WHERE `timesheet_id` = '".$_REQUEST['id']."'";

// $timesheet_insert_sql = "INSERT INTO `capms_user_timesheet` (`timesheet_id`, `user_id`, `workload_id`, `timesheet_date`, `start_time`, `end_time`, `task_domain`, `task_type`, `description`, `trello_link`, `created_at`, `updated_at`) VALUES (NULL, '".$_SESSION['emp_id']."', '".$_SESSION['workload_id']."', '".$timesheet_date."','".$start_time."',  '".$end_time."', '".$task_domain."', '".$task_type."', '".$description."', '".$trello_link."', '".$created_at."', '".$updated_at."')";

if($con->query($timesheet_update_sql) === TRUE) {
  header('location:timesheet.php');
  mysqli_close($con);
}
else {
  echo "Error: " . $timesheet_update_sql . "<br>" . $con->error;
}
