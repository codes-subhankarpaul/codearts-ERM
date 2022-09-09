<?php
require './database.php';

$delete_project_task_sql = "DELETE FROM `capms_project_task_info` WHERE `capms_project_task_info`.`task_id` = '".$_REQUEST['task_id']."'";

if($con->query($delete_project_task_sql) === TRUE) {
    header("location:view_project_task.php?project_id=".$_REQUEST['project_id']."");
    mysqli_close($con);
} 
else {
  echo "Error: " . $delete_project_task_sql . "<br>" . $con->error;
}