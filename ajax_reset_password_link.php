<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	$con = mysqli_connect("107.180.58.68","codearts_pms","2Z6!ON!n_{aU","codearts_pms");

	$baseURL = $_REQUEST['baseURL'];
	$user_info = $_REQUEST['user_info'];
	$token = md5(rand());
	$sql1 = "SELECT * FROM capms_admin_users WHERE user_email = '".$user_info."' OR user_contact = '".$user_info."' OR user_empid = '".$user_info."' ";
	$result1 = mysqli_query($con, $sql1);
	if($result1->num_rows > 0)
	{
		while($row1 = mysqli_fetch_assoc($result1))
		{
			$email_to = $row1['user_email'];
			$subject = "Password reset token";
			
			$body = '';
			$body .= '<h1>Password reset token</h1>'; 
			$body .= '<p>'.$token.'</p>';
			
			$headers  = 'From: Codearts Solution ERM <erm.codeartssolution@gmail.com>';

			if(mail($email_to, $subject, $body, $headers))
			{
				echo json_encode(
					array(
						"status"	=> 'success',
						"action"	=> "<p class='user-info-success text-success'><span class='validation-success'><i class='fas fa-tick'></i></span>A Password Reset Link has been sent to the registered email address. Please check ".$row1['user_email'].". The token is - ".$token."</p>",
						"message"	=> "Password reset token sent successfully. Please check your inbox.",
						"token"		=> $token
					)
				);
			}
			else
			{
				echo json_encode(
					array(
						"status"	=> 'failed',
						"action"	=> "<p class='user-info-success text-error'><span class='validation-error'><i class='fas fa-exclamation'></i></span>Something is wrong. Please contact the developer.</p>",
						"message"	=> "Failed operation. Please try again later.",
						"token"		=> ''
					)
				);
			}
		}
	}

?>