<?php
session_start();
require_once('database.php');

$u_id = $_SESSION['emp_id'];
$name = $_SESSION['emp_name'];
$ms = $_POST['msg'];
$sql = "INSERT INTO `capms_group_chat` (`user_id`, `user_name`, `message`, `chat_status`, `created_at`) VALUES ('".$u_id."', '".$name."', '".$ms."', '1', '".date('Y-m-d H:i:s', strtotime('now'))."')";
$result = mysqli_query($con,$sql);
if($result){
    header('location: chat_group.php');
}
?>