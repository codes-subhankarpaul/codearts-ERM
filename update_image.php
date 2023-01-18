<?php
require_once('database.php');
$id=$_GET['id'];
?>
	<?php
		if(isset($_POST['updateimg']))
		{
			// echo 'updateimg as6e';
			if(isset($_FILES['u_img'])) {
				$errors = "";
				if ($_FILES["u_img"]["size"] > 500000) {
					echo "Sorry, your file is too large.";
				}
				else {
					if(isset($_FILES['u_img']['name']))
					{
						$tmpFileName = $_FILES['u_img']['tmp_name'];
						if($tmpFileName != "")
						{
							$folder = "assets/uploads/user_featured_images/";
							
							$timestamp = strtotime('now').'-'.$_FILES['u_img']['name'];
							$filename = $_FILES['u_img']['name'];
							$filePath = "assets/uploads/user_featured_images/" .$timestamp;
							$target_file=$folder.basename($filename);
							$imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
							if(move_uploaded_file($tmpFileName, $filePath))
							{
								$sql3 = "UPDATE capms_admin_users SET user_featured_image = '".$timestamp."' WHERE id = '".$id."' ";
								mysqli_query($con, $sql3);
								$_SESSION['emp_image'] = $timestamp;
							}
						}
					}
					header('location: profile.php');
				}
			}
		}

		
?>