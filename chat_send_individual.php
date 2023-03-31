<?php
session_start();
require_once('database.php');

$s_uid= $_SESSION['emp_id'];
$r_uid = $_POST['to_user_id'];
$ms = $_POST['msg'];
$sql = "INSERT INTO `capms_personal_chat`(`to_user_id`, `from_user_id`, `chat_message`, `chat_status`, `created_at`) VALUES ('".$r_uid."','".$s_uid."','".$ms."','1','".date('Y-m-d H:i:s', strtotime('now'))."')";
$result = mysqli_query($con,$sql);
if($result){
    header("location: chat_individual.php?reciever_user_id=".$_GET['recievers_user_id']);
}
?>