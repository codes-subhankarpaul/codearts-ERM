<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	$con = mysqli_connect("localhost","root","","codearts_pms_new");

    $baseURL = $_GET['baseURL'];
	$login_username = $_GET['login_username'];
    $login_password = $_GET['login_password'];

	$user = '';
	$action = '';

	$sql1 = "SELECT * FROM capms_admin_users WHERE user_email = '".$login_username."' OR user_contact = '".$login_username."' OR user_empid = '".$login_username."' ";
    $result1 = mysqli_query($con, $sql1);
    if($result1->num_rows > 0)
    {
        while($row1 = mysqli_fetch_assoc($result1))
        {
            if( md5($login_password) == $row1['user_password'] )
            {
                $_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + (1440 * 60);
                $_SESSION['emp_id'] = $row1['id'];
                $_SESSION['emp_type'] = $row1['user_type'];
                $_SESSION['emp_name'] = $row1['user_fullname'];
                $_SESSION['emp_image'] = $row1['user_featured_image'];

                // check if pervious logout time is there then, $_SESSION['auto_login_status'] = "auto" else ""
                $login_details = "SELECT * FROM `capms_login_information` WHERE user_id = '".$_SESSION['emp_id']."' ORDER BY ID DESC LIMIT 1";

                $result_logout = mysqli_query($con, $login_details);
                 
                while($row_logout = mysqli_fetch_assoc($result_logout)) {
                    if($row_logout['logout_time']=='') {
                        // update previous day's logout time
                        $logout_time = "UPDATE `capms_login_information` SET `logout_time`='19-30-00 auto' WHERE id = '".$row_logout['id']."'";
                        $con->query($logout_time);
                    }
                }

                $sql2 = "SELECT * FROM capms_login_information WHERE user_id = '".$_SESSION['emp_id']."' AND login_date = '".date('d-m-Y', strtotime('now'))."' ";
                $result2 = mysqli_query($con, $sql2);
                if($result2->num_rows > 0)
                {
                    echo json_encode( array( "status" => 'success' ) );
                }
                else
                {
                    

                    
                    $sql3 = "INSERT INTO `capms_login_information` (`id`, `user_id`, `login_date`, `login_time`, `logout_time`, `lunch_break_start`, `lunch_break_end`, `evening_break_start`, `evening_break_end`, `working_hours`, `break_duration`) VALUES (NULL, '".$_SESSION['emp_id']."', '".date('d-m-Y', strtotime('now'))."', '".date('g:i A', strtotime('now'))."', '', '', '', '', '', '', '');";
                    $result3 = mysqli_query($con, $sql3);
                   
                    echo json_encode( array( "status" => 'success' ) );
                }
            }
            else
            {
                echo json_encode( array( "status" => 'error', "action" => "<p class='login-error text-danger'><span class='validation-alert'><i class='fas fa-exclamation'></i></span>Something is wrong with the credentials. Please check again and try.</p>" ) );
            }
        }
    }
    else
    {
        echo json_encode( array( "status" => 'error', "action" => "<p class='login-error text-danger'><span class='validation-alert'><i class='fas fa-exclamation'></i></span>This Email ID does not exists. Either register or try some other Email ID.</p>" ) );
    }