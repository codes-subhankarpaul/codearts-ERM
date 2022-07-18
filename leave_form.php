<?php 
   
date_default_timezone_set('Asia/Kolkata');
$date_today = date('d/m/Y', strtotime('now'));
//print_r($date_today);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <?php include 'header_css.php'; ?>
    <title>employee leave request form</title>
</head>


<body>
<header class="custom-header">
    <?php include 'info_panel.php'; ?>
</header>
<main class="custom-dahboard-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <?php include 'dashboard.php'; ?>
            </div>
            <div class="col-lg-9">
                <section class="inner-head-brd">
                    <h2>Leave</h2>
                    <ul>
                        <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                        <li><a href="leave.php">Leaves</a></li>
                        <li>Add Leave</li>
                    </ul>
                </section>

                <section class="custom-salary-table">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text">
                                    <h2>Employee Leave Request Form</h2>
                                    <p>Please fill in this form with all the requird information. HR will contact you shortly after the
                                    leave request has been approved by your supervisor</p>
                                    <hr>
                                    </hr>
                                </div>
                        <?php
                            $sql1 = "SELECT * FROM capms_admin_users WHERE id = '".$_SESSION['emp_id']."' ";
                            $result1 = mysqli_query($con, $sql1);
                            //print_r($result1);
                            if($result1->num_rows > 0)
                            {
                                while($row1 = mysqli_fetch_assoc($result1))
                                {
                        ?>
                        <div class="sent-notification">
                                <form class="emp-form" method="POST" enctype="multipart/form-data" id="myForm">
                                <?php
                                  

                                  if(isset($_POST['submit'])){
                                   
                                    $date1= new DateTime($_POST['leave']);
                                    $date2= new DateTime($_POST['return']);
                                    $interval = $date1-> diff($date2);
                                    //echo $interval;
                                    // print_r($interval);
                                    // die();
                                    $total_pl=18;
                                    // if()
                                    $balance_pl= $total_pl-$interval->d;  
                                   // print_r($balance_pl);
                                   // die();


                                    $insert1 = " INSERT INTO capms_admin_leave1(leave_ID, user_empid,user_designation, user_reason,user_ldate,user_rdate,leave_type,no_of_leave_days,balance_leave,created_at,updated_at) VALUES ('','".$row1['user_empid']."','".$row1['user_fullname']."','".$row1['user_designation']."','".$_POST['reason']."','".$_POST['leave']."','".$_POST['return']."','".$interval->d."','".$balance_pl."','".date('Y-m-d h:i:s',strtotime('now'))."','".date('Y-m-d h:i:s',strtotime('now'))."') ";



                                    // $insert = "INSERT INTO capms_admin_leave1(leave_ID, user_empid, user_designation, user_reason, user_ldate, user_rdate, leave_type, no_of_leave_days, balance_leave, created_at, updated_at) VALUES ('','".$row1['user_empid']."','".$row1['user_fullname']."','".$row1['user_designation']."','".$_POST['reason']."','".$_POST['leave']."','".$_POST['return']."','".$interval->d."','".$balance_pl."','".date('Y-m-d h:i:s', strtotime('now'))."','".date('Y-m-d h:i:s', strtotime('now'))."')" ;

                                    echo $insert1;
                                    $insert_qry = mysqli_query($con, $insert1);
                                    //print_r($insert_qry);
                                    //die();

                                    if($insert_qry)
                                    {
                                      echo '<script> alert("Data saved") </script>';
                                    }
                                    else
                                    {
                                      echo '<script> alert("Data Not saved!") </script>';
                                    }

                                  }

                                ?>
                                

                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-3 col-form-label">Employee Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="empname" placeholder="" name="ename" value="<?php echo $_SESSION['emp_name'];  ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputText" class="col-sm-3 col-form-label">Department</label>
                                        <div class="col-sm-9">
                                            <input type="" class="form-control" id="empdept" placeholder="" name="department" value="<?php echo $row1['user_designation']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <h6>Reason for Leave</h6>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="empreason" name="reason" value="Vacation" <?php if($row1['user_reason'] == 'Vacation') { echo 'checked'; } ?> >
                                                <label class="form-check-label" for="empreason">
                                                    Vacation
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="empreason" name="reason" value="Sick-Self" <?php if($row1['user_reason'] == 'Vacation') { echo 'checked'; } ?> >
                                                <label class="form-check-label" for="empreason">
                                                    Sick-Self
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="empreason" name="reason" value="Leave of Absence" <?php if($row1['user_reason'] == 'Vacation') { echo 'checked'; } ?> >
                                                <label class="form-check-label" for="empreason">
                                                    Leave of Absence
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="empreason" name="reason" value="Jury Duty" <?php if($row1['user_reason'] == 'Vacation') { echo 'checked'; } ?> >
                                                <label class="form-check-label" for="empreason">
                                                    Jury Duty
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="empreason" name="reason" value="Sick-Family" <?php if($row1['user_reason'] == 'Vacation') { echo 'checked'; } ?> >
                                                <label class="form-check-label" for="empreason">
                                                    Sick-Family
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="empreason" name="reason" value="Doctor Appointment" <?php if($row1['user_reason'] == 'Vacation') { echo 'checked'; } ?> >
                                                <label class="form-check-label" for="empreason">
                                                    Doctor Appointment
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="empreason" name="reason" value="Funeral"
                                                <?php if($row1['user_reason'] == 'Vacation') { echo 'checked'; } ?> >
                                                <label class="form-check-label" for="empreason">
                                                    Funeral
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="empreason" name="reason" value="Natural Calamity" <?php if($row1['user_reason'] == 'Vacation') { echo 'checked'; } ?> >
                                                <label class="form-check-label" for="empreason">
                                                    Natural Calamity
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group calender row">
                                        <label for="Leave" class="col-sm-3 col-form-label"></label>
                                        <input type="radio" id="full" name="leave_type" value="Full" checked>
                                        <label for="full">Full</label><br>
                                        <input type="radio" id="half" name="leave_type" value="Half">
                                        <label for="half">Half</label><br>
                                    </div>

                                    <div class="form-group calender row" id="leave_ip">
                                        <label for="Leave" class="col-sm-3 col-form-label">Leave Date:</label>
                                        <div class="col-sm-9">
                                            <input id="leave_date" class="form-control" name="leave"/>
                                        </div>
                                    </div>
                                    <div class="form-group calender row" id="return_ip">
                                        <label for="Leave" class="col-sm-3 col-form-label">Return Date:</label>
                                        <div class="col-sm-9">
                                            <input id="return_date" class="form-control" name="return" />
                                        </div>
                                    </div>
                                    <div class="total-no row">
                                          <label for="Leave" class="col-sm-3 col-form-label">Remaining Leave:</label>
                                          <div class="col-sm-9">
                                            <input class="form-control" type="text" id="balance" name="balance" value="" disabled>
                                          </div>
                                    </div>
                                    <!-- <div class="form-group calender row">
                                        <div class="form-group mb-2"><input type="button" class="btn btn-primary m-2" value="Calculate" id="calculate"></div>
                                        <div id="result" name="half_full"></div>
                                    </div> -->
                                    <div class="send">
                                        <button type="submit" class="btn btn-primary" name="submit" value="Send and Email">Submit</button>
                                    </div>
                                </form>

                            </div>
                            <?php } } ?>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
</main>
<footer class="custom-footer">
    <?php include 'copyright_content.php'; ?>
</footer>


<?php include 'footer_js.php' ?>





</body>




</html>