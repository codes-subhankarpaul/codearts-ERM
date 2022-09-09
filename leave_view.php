<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <?php include 'header_css.php'; ?>
    <title>employee leave request form</title>
</head>

<body>


  <?php $view_leave_id = $_REQUEST['leave_id']; 
  //print_r($view_leave_id);

  ?>                                      
                                       
   
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
                            <li>View Leave</li>
                        </ul>
                    </section>
                    <?php
                        $sql1 = "SELECT * FROM capms_admin_users WHERE id = '".$_SESSION['emp_id']."' ";
                        $result1 = mysqli_query($con, $sql1);
                        
                        if($result1->num_rows > 0)
                        {
                            while($row1 = mysqli_fetch_assoc($result1))
                            {

                    ?>

                    <section class="custom-salary-table">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text">
                                        <h2>Employee Leave Request Form</h2>
                                        <p>Please fill in this form with all the requird information. HR will contact
                                            you shortly after the
                                            leave request has been approved by your supervisor</p>
                                        <hr>
                                        </hr>
                                    </div>

                                    <form class="emp-form" method="POST" enctype="multipart/form-data">

                                        <?php

                                        $result2 = "SELECT * FROM capms_admin_leave WHERE user_empid = '".$row1['user_empid']."' AND leave_id = '".$view_leave_id."'  ";

                                        $row2 = mysqli_query($con, $result2);
                                        if($row2->num_rows > 0)
                                           {
                                        while($row3 = mysqli_fetch_assoc($row2))

                                    {

                                        ?>
                                      

                                        <div class="form-group row">
                                            <label for="inputText" class="col-sm-3 col-form-label">Employee Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="inputText" placeholder="" name="ename" value="<?php echo $_SESSION['emp_name'];  ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputText" class="col-sm-3 col-form-label">Department</label>
                                            <div class="col-sm-9">
                                                <input type="" class="form-control" id="inputT" placeholder="" name="department" value="<?php echo $row1['user_designation']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <h6>Reason for Leave</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="form-check">

                                                    <input class="form-check-input" type="checkbox" id="gridCheck1" name="reason" value="Vacation" <?php
                                                        if($row3['user_reason']=='Vacation' ) { echo 'checked' ; } ?> disabled>
                                                    <label class="form-check-label" for="gridCheck1">
                                                        Vacation
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="gridCheck1" name="reason" value="Sick-Self" <?php
                                                        if($row3['user_reason']=='Sick-Self' ) { echo 'checked' ; } ?> disabled>
                                                    <label class="form-check-label" for="gridCheck1">
                                                        Sick-Self
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="gridCheck1" name="reason" value="Leave of Absence" <?php
                                                        if($row3['user_reason']=='Leave of Absence' ) { echo 'checked' ; } ?> disabled>
                                                    <label class="form-check-label" for="gridCheck1">
                                                        Leave of Absence
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="gridCheck1" name="reason" value="Jury Duty" <?php
                                                        if($row3['user_reason']=='Jury Duty' ) { echo 'checked' ; } ?> disabled>
                                                    <label class="form-check-label" for="gridCheck1">
                                                        Jury Duty
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="gridCheck1" name="reason" value="Sick-Family" <?php
                                                        if($row3['user_reason']=='Sick-Family' ) { echo 'checked' ; } ?>  disabled>
                                                    <label class="form-check-label" for="gridCheck1">
                                                        Sick-Family
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="gridCheck1" name="reason" value="Doctor Appointment" <?php
                                                        if($row3['user_reason']=='Doctor Appointment' ) { echo 'checked' ; } ?> disabled>
                                                    <label class="form-check-label" for="gridCheck1">
                                                        Doctor Appointment
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="gridCheck1" name="reason" value="Funeral" <?php
                                                        if($row3['user_reason']=='Funeral' ) { echo 'checked' ; } ?> disabled>
                                                    <label class="form-check-label" for="gridCheck1">
                                                        Funeral
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="gridCheck1" name="reason" value="Natural Calamity" <?php
                                                        if($row3['user_reason']=='Natural Calamity' ) { echo 'checked' ; } ?> disabled>
                                                    <label class="form-check-label" for="gridCheck1">
                                                        Natural Calamity
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group calender row">
                                            <label for="Leave" class="col-sm-3 col-form-label">Leave Date:</label>
                                            <div class="col-sm-9">
                                                <input class=" form-control" type="date" id="leave" name="leave" value="<?php  if($row3['user_ldate'] != "") {
                                                    echo $row3['user_ldate'];
                                                } ?>" disabled>
                                            </div>
                                        </div>
<!--                                         <div class="form-group time row">
                                            <label for="Leave" class="col-sm-3 col-form-label">Leave Time:</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="time" id="time" name="time" value="<?php echo $row3['user_time']; ?>" disabled>
                                            </div>
                                        </div> -->
                                        <div class="form-group calender row">

                                            <label for="Leave" class="col-sm-3 col-form-label">Return Date:</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="date" id="leave" name="return" value="<?php echo $row3['user_rdate']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="total-no row">
                                            <label for="Leave" class="col-sm-3 col-form-label">Total number of days
                                                requested:</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" id="time" name="no_of_leave" value="<?php echo $row3['no_of_leave_days']; ?>" disabled>
                                            </div>
                                        </div>
                                    <?php
                                     }

                                     }
                                    ?>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php 
                }
                 } 
                ?>

                </div>
            </div>
        </div>
    </main>
    <footer class="custom-footer">
        <?php include 'copyright_content.php'; ?>
    </footer>

</body>

</html>