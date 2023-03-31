<?php
require_once "database.php";
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

$sql = "DELETE FROM capms_gracetime_info WHERE `capms_gracetime_info`.`id` = '".$_REQUEST['gracetime_id']."'";

if ($con->query($sql) === TRUE) {
  $_SESSION['gracetime_delete_msg'] = "Successfully deleted the record!";
  echo "<script>location.href='".$baseURL."gracetime.php'</script>";
}
else {
  $_SESSION['gracetime_delete_msg'] = "Error deleting record: " . $con->error;
}

$con->close();
?>