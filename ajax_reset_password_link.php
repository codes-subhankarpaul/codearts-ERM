<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	$con = mysqli_connect("localhost","root","","codearts_pms_new");

	$baseURL = $_REQUEST['baseURL'];
	$user_info = $_REQUEST['user_info'];
	$token = md5(rand());
	$sql1 = "SELECT * FROM capms_admin_users WHERE user_email = '".$user_info."' OR user_contact = '".$user_info."' OR user_empid = '".$user_info."' ";
	$result1 = mysqli_query($con, $sql1);
	if($result1->num_rows > 0)
	{
		while($row1 = mysqli_fetch_assoc($result1))
		{
			$headers = 'Content-type: text/html; charset=utf-8'."\r\n";
			$headers .= 'From: Codearts Solution ERM <erm.codeartssolution@gmail.com>'."\r\n";
			$email_to = $row1['user_email'];
			$subject = "Password reset token";

			$body =
			'<!DOCTYPE HTML>
			<html xmlns="https://www.w3.org/1999/xhtml">
				<head>
					<title>Password Reset Token</title>
					<style>
						*{
							margin: 0;
							padding: 0;
						}
							.cus-box{
							margin: auto;
							width: 60%;
							padding: 10px;
						}
							.custom-title{
							background-color: #557da1;
							text-align: center;
							padding: 20px 10px;
						}
							.cus-title-cs{
							color: whitesmoke;
							font-size: 25px;
							font-weight: 400;
						}
							.custom-details{
							padding: 40px 70px;
							text-align: center;
							border: 1px solid #C0C2C9;
						}
							.cus_dash{
							border: 1px dashed #333;
							width: 100%;
						}
							.cus-points{
							font-size: 18px;
							font-weight: 800;
							color: #717274;
						}
							.cus-details{
							text-align: center;
							width: 100%;
						}
							.cus-text{
							font-size: 10px;
							margin: 20px 10px;
							color: #717274;
						}
						.custom-details-inner {
							border: 1px dashed #dcd6d0;
							padding: 14px 25px;
						}
						.cus-reset-token {
							background: #20e277;
							text-decoration: none !important;
							font-weight: 500;
							margin-top: 35px;
							color: #fff;
							text-transform: uppercase;
							font-size: 14px;
							padding: 10px 24px;
							display: inline-block;
							border-radius: 50px;
						}
					</style>
				</head>
				<body>
					<div class="cus-box">
						<div class="custom-title">
							<h1 class="cus-title-cs">Password Reset Token</h1>
						</div>
						<div class="custom-details">
							<div class="custom-details-inner">
								<h2 class="cus-points">We cannot simply send you your old password. A unique token to reset your password has been generated for you. To reset your password, copy the following token and use it while setting new password.</h2>
								<p class="cus-reset-token">'.$token.'</p>
							</div>
						</div>
					</div>
					<div class="cus-details">
						<h3 class="cus-text">Codearts Solution ERM – Powered by Codearts</h3>
					</div>
				</body>
			</html>';

			if(mail($email_to, $subject, $body, $headers))
			{
				echo json_encode(
					array(
						"status"	=> 'success',
						"action"	=> "<p class='user-info-success text-success'><span class='validation-success'><i class='fas fa-tick'></i></span>A Password Reset Link has been sent to the registered email address. Please check ".$row1['user_email'].". The token is - ".$token."</p>",
						"message"	=> "Password reset token sent successfully. Please check your inbox.",
						"token"		=> $token,
						"user_mail" => $email_to
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
						"token"		=> '',
						"user_mail" => '',
					)
				);
			}
		}
	}

?>