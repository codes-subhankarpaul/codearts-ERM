<?php
session_start();
include "database.php";

if(isset($_POST)) {
    // $s_uid= $_SESSION['emp_id'];
	// $r_uid= $_POST['from_user_id'];
    $q="SELECT * FROM `capms_group_chat` WHERE `chat_status`='1'";
    $result=mysqli_query($con,$q);
    // echo $q;
    if(mysqli_num_rows($result)>0) {
        echo mysqli_num_rows($result);
    }
    else{
        echo 0;
    }

}
?>