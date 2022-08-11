<?php
require './database.php';
$timesheet_date = $_REQUEST['dt'];
$start_time = $_REQUEST['start_time'];
$end_time = $_REQUEST['end_time'];
$description = $_REQUEST['description'];
$trello_link = $_REQUEST['trello_link'];
$task_id = $_REQUEST['task_id'];
$project_id = $_REQUEST['project'];
$created_at = date('Y-m-d h:i:s', strtotime('now'));
$updated_at = date('Y-m-d h:i:s', strtotime('now'));





$sql1 = "INSERT INTO `capms_user_timesheet` (`timesheet_id`, `timesheet_date`, `start_time`, `end_time`, `description`, `trello_link`, `created_at`, `updated_at`) VALUES (NULL, '".$timesheet_date."', '".$start_time."', '".$end_time."', '".$description."', '".$trello_link."', '".$created_at."', '".$updated_at."');";



if ($con->query($sql1) === TRUE) {

    header('location:timesheet.php');

    mysqli_close($con);
    
  } else {
    echo "Error: " . $sql1 . "<br>" . $con->error;
  }

$user_id = $_SESSION['emp_id'];

// $sql2 = "INSERT INTO `capms_user_workload_info`(`workload_id`, `user_id`, `project_id`, `task_id`, `created_at`, `updated_at`) 
// VALUES ('',$user_id,$project_id,$task_id,'$created_at','$updated_at')";

// mysqli_query($con, $sql2);

// print_r($sql);
// die();

// if (mysqli_query($con, $sql)) {
//     echo "<script>setTimeout(function() { alert(\"task added\"); }, 3000);</script>";
// } 
// else {
//     echo "<script>setTimeout(function() { alert(\"ERROR: Hush! Sorry $sql. "
//         . mysqli_error($con)."\")},3000)</script>";
// }



?>