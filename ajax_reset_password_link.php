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
			echo json_encode(
				array(
					"status" => 'success',
					"action" => "<p class='user-info-success text-success'><span class='validation-success'><i class='fas fa-tick'></i></span>A Password Reset Link has been sento the registered email address. Please check.".$row1['user_email']."-".$token."</p>"
				)
			);
		}
		// Import PHPMailer classes into the global namespace 
		use PHPMailer\PHPMailer\PHPMailer; 
		use PHPMailer\PHPMailer\Exception; 
		 
		require 'PHPMailer/Exception.php'; 
		require 'PHPMailer/PHPMailer.php'; 
		require 'PHPMailer/SMTP.php'; 
		 
		$mail = new PHPMailer; 
		 
		$mail->isSMTP();                      // Set mailer to use SMTP 
		$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
		$mail->SMTPAuth = true;               // Enable SMTP authentication 
		$mail->Username = 'user@gmail.com';   // SMTP username 
		$mail->Password = 'gmail_password';   // SMTP password 
		$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
		$mail->Port = 587;                    // TCP port to connect to 
		 
		// Sender info 
		$mail->setFrom('sender@codexworld.com', 'CodexWorld'); 
		$mail->addReplyTo('reply@codexworld.com', 'CodexWorld'); 
		 
		// Add a recipient 
		$mail->addAddress('recipient@example.com'); 
		 
		//$mail->addCC('cc@example.com'); 
		//$mail->addBCC('bcc@example.com'); 
		 
		// Set email format to HTML 
		$mail->isHTML(true); 
		 
		// Mail subject 
		$mail->Subject = 'Email from Localhost by CodexWorld'; 
		 
		// Mail body content 
		$bodyContent = '<h1>How to Send Email from Localhost using PHP by CodexWorld</h1>'; 
		$bodyContent .= '<p>This HTML email is sent from the localhost server using PHP by <b>CodexWorld</b></p>'; 
		$mail->Body    = $bodyContent; 
		 
		// Send email 
		if(!$mail->send()) { 
		    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
		} else { 
		    echo 'Message has been sent.'; 
		} 
		 
	}

?>