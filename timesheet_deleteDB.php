<?php
require_once "database.php";
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

echo "
<script>
  
</script>
";

$sql = "DELETE FROM capms_user_timesheet WHERE `capms_user_timesheet`.`timesheet_id` = '".$_REQUEST['id']."'";

if ($con->query($sql) === TRUE) {
  echo "<script>Timesheet_id : ".$_REQUEST['id']." record deleted successfully</script>";
  header('location:timesheet.php');
  exit();
} 
else {
  echo "Error deleting record: " . $con->error;
}

$con->close();
?>