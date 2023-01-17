<?php
session_start();
require_once('database.php');

$s_uid= $_SESSION['emp_id'];
$r_uid = $_POST['to_user_id'];
$ms = $_POST['msg'];
$sql = "INSERT INTO `capms_personal_chat`(`to_user_id`, `from_user_id`, `chat_message`, `created_at`) VALUES ('".$r_uid."','".$s_uid."','".$ms."','".date('Y-m-d H:i:s', strtotime('now'))."')";
$result = mysqli_query($con,$sql);
if($result){
    $query = "SELECT * FROM `capms_personal_chat` WHERE (to_user_id='".$r_uid."' AND from_user_id='".$s_uid."') OR (to_user_id='".$s_uid."' AND from_user_id='".$r_uid."') ORDER BY created_at";
    $query_run = mysqli_query($con, $query);
    $data = [];
    if($query_run->num_rows > 0){
        foreach($query_run as $row){
            $data[] = $row;
        }
	    echo json_encode($data);
    } 
    
    // header("location: chat_individual.php?reciever_user_id=".$_GET['recievers_user_id']);
}
?>