<?php 
use PHPMailer\PHPMailer\PHPMailer;


if(isset($_POST['submit'])){
		$leave_user_id = $row1['user_empid']; 
		$ename = $_POST['ename'];
		$department = $_POST['department'];
		$reason = $_POST['reason'];
		$leave = $_POST['leave'];
		$time = $_POST['time'];
		$return = $_POST['return'];
		$no_of_leave = $_POST['no_of_leave'];


		require_once "PHPMailer/PHPMailer.php";
		require_once "PHPMailer/SMTP.php";
		require_once "PHPMailer/Exception.php";


		$mail = new PHPMailer();

		$mail->isSMTP();            

		$mail->Host = "smtp.gmail.com";

		$mail->SMTPAuth = true;                          
 
		$mail->Username = "animesh.codearts@gmail.com";

		$mail->Password = "animesh@123";                           

		$mail->SMTPSecure = "SSL";                        

		$mail->Port = 465;



		$mail->isHTML(true);
		
		$mail->setFrom($email, $name);

		$mail->addAddress("animesh.codearts@gmail.com");

		$mail->Subject = ($email ($subject));
		
		$mail->Body = $body;


		if($mail -> send()){
			$status = "success";
			$response = "Email is sent!";
		}
		else {
			$status = "failed";
			$response = "Something went Wrong!";
		}
		exit(json_encode(array('status' => $status, 'response' => $response )));




}

?>