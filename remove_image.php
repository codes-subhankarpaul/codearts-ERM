<?php
require_once('database.php');
$id=$_GET['id']; 
$res=mysqli_query($con,"SELECT* from capms_admin_users WHERE id='" .$id. "' limit 1");
if($row=mysqli_fetch_array($res)) {
	$deleteimage=$row['user_featured_image']; 
}
$folder="assets/uploads/user_featured_images/";
unlink($folder.$deleteimage);
$sql = "UPDATE `capms_admin_users` SET `user_featured_image`='' WHERE `id`='" .$id. "';";
$result=mysqli_query($con,$sql) ; 
if($result) {
	$_SESSION['emp_image'] = '';
	header("location:profile.php");
}

?>