<?php
require_once "database.php";
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if(isset($_POST['leave_status'])) {
    $u_id = $_REQUEST['user_id'];
    $sql_leave_days = "SELECT * FROM `capms_admin_individual_leaves` WHERE `capms_admin_individual_leaves`.`id` = '".$_REQUEST['id']."'";
    $result_leave_days = mysqli_query($con,$sql_leave_days);
    if($result_leave_days->num_rows>0){
        while($row1=mysqli_fetch_assoc($result_leave_days)){
            if(strtotime(date('Y-m-d', strtotime($row1['leave_date']))) <strtotime(date('Y-m-d'))){
                echo "<script type='text/javascript'>alert('Previous leave cannott be aproved.');";
                echo "location='employee_leave_view.php?user_id=";
                echo $u_id;
                echo "'";
                echo "</script>";
                // header('location:employee_leave_view.php?user_id='.$u_id);
            }
            else{
                // $l_date = explode('-',$row1['leave_date']);
                // $year = $l_date[2];
                // $month = $l_date[1];
                if($_POST['paid_unpaid_status']==''){
                    $sql = "UPDATE `capms_admin_individual_leaves` SET `leave_status` = '".$_POST['leave_status']."' WHERE `capms_admin_individual_leaves`.`id` = '".$row1['id']."'";
                }
                else if($_POST['leave_status']==''){
                    $sql = "UPDATE `capms_admin_individual_leaves` SET `paid_unpaid_status`='".$_POST['paid_unpaid_status']."' WHERE `capms_admin_individual_leaves`.`id` = '".$row1['id']."'";
                }
                else{
                    $sql = "UPDATE `capms_admin_individual_leaves` SET `leave_status` = '".$_POST['leave_status']."', `paid_unpaid_status`='".$_POST['paid_unpaid_status']."' WHERE `capms_admin_individual_leaves`.`id` = '".$row1['id']."'";
                }
                if ($con->query($sql) === TRUE) {
                    // if($_POST['leave_status']!=''){                       
                    //     $sql_admin_leave = "UPDATE `capms_admin_leave_applications` SET `leave_status`='".$_POST['leave_status']."' WHERE `leave_ID`='".$_REQUEST['leave_id']."'";
                    //     $result_admin_leave = mysqli_query($con,$sql_admin_leave);
                    // }
                    if($_POST['leave_status']=='Aproved' && $row1['type_of_leave']=='Full Day'){
                        $sql_timesheet = "UPDATE `capms_user_timesheet` SET start_time='00:00' end_time='00:00' WHERE timesheet_date='".date("m/d/Y",strtotime($row1['leave_date']))."'";
                        $result_timesheet = mysqli_query($con,$sql_leave_days);
                        $sql_login = "UPDATE `capms_login_information` SET `login_time`='00:00',`logout_time`='00-00-00',`lunch_break_start`='00:00',`lunch_break_end`='00:00',`evening_break_start`='00:00',`evening_break_end`='00:00' WHERE login_date ='".$row1['leave_date']."'";
                        $result_login = mysqli_query($con,$sql_login);
                    }
                    header('location:employee_leave_view.php?user_id='.$u_id);
                    exit();
                }
            }
        }
        
    } 
    else {
        echo "Error updating record: " . $con->error;
    }
}

$con->close();
?>