<?php 
date_default_timezone_set('Asia/Kolkata');
$date_today = date('d/m/Y', strtotime('now'));
?>

<!doctype html>
<html lang="en">

    <head>
        <!-- Header CSS files -->
        <?php include 'header_css.php'; ?>
        <?php
            if($_SESSION['emp_id'] == '')
            {
              echo "<script>location.href='".$baseURL."login.php';</script>";
            }
        ?>
        <title>Leaves - CERM :: Codearts Employee Relationship Management</title>
    </head>
    
    <body>
        <header class="custom-header">
            <!-- Dashboard Top Info Panel -->
            <?php include 'info_panel.php'; ?>
        </header>
        <main class="custom-dahboard-main">
            <div class="custom-page-wrap-dp">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <!-- Dashboard Left Sidebar -->
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
                                            </div>
                                            <?php
                                                $sql1 = "SELECT * FROM capms_admin_users WHERE id = '".$_SESSION['emp_id']."' ";
                                                $result1 = mysqli_query($con, $sql1);
                                                if($result1->num_rows > 0)
                                                {
                                                    while($row1 = mysqli_fetch_assoc($result1))
                                                    {
                                                        ?>
                                                        <div class="sent-notification">
                                                            <form class="emp-form" method="POST" enctype="multipart/form-data" id="myForm">
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
                                                                <div class="form-group total-no row">
                                                                      <div class="col-sm-3">
                                                                            <h6>Remaining PL(s)</h6>
                                                                        </div>
                                                                      <div class="col-sm-9">
                                                                        <input class="form-control" type="text" id="remaining_pls" name="remaining_pls" value="18" disabled>
                                                                      </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-3">
                                                                        <h6>Reason for Leave</h6>
                                                                    </div>
                                                                    <div class="col-sm-9">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" id="reason_of_leave" name="reason" value="Vacation">
                                                                            <label class="form-check-label" for="reason_of_leave">
                                                                                Vacation
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" id="reason_of_leave" name="reason" value="Sick-Self">
                                                                            <label class="form-check-label" for="reason_of_leave">
                                                                                Sick-Self
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" id="reason_of_leave" name="reason" value="Leave of Absence">
                                                                            <label class="form-check-label" for="reason_of_leave">
                                                                                Leave of Absence
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" id="reason_of_leave" name="reason" value="Jury Duty">
                                                                            <label class="form-check-label" for="reason_of_leave">
                                                                                Jury Duty
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" id="reason_of_leave" name="reason" value="Sick-Family">
                                                                            <label class="form-check-label" for="reason_of_leave">
                                                                                Sick-Family
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" id="reason_of_leave" name="reason" value="Doctor Appointment">
                                                                            <label class="form-check-label" for="reason_of_leave">
                                                                                Doctor Appointment
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" id="reason_of_leave" name="reason" value="Funeral">
                                                                            <label class="form-check-label" for="reason_of_leave">
                                                                                Funeral
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" id="reason_of_leave" name="reason" value="Natural Calamity">
                                                                            <label class="form-check-label" for="reason_of_leave">
                                                                                Natural Calamity
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-3">
                                                                        <h6>Type for Leave</h6>
                                                                    </div>
                                                                    <div class="col-sm-9">
                                                                        <div class="">
                                                                            <input type="radio" name="type_of_leave" value="Full" checked>
                                                                            <label for="full">Full Day</label>
                                                                        </div>
                                                                        <div class="">
                                                                            <input type="radio" id="half" name="leave_type" value="Half">
                                                                            <label for="half">Fist Half</label>
                                                                        </div>
                                                                        <div class="">
                                                                            <input type="radio" id="half" name="leave_type" value="Half">
                                                                            <label for="half">Second Half</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group calender row" id="leave_ip">
                                                                    <div class="col-sm-3">
                                                                        <h6>Leave Start Date</h6>
                                                                    </div>
                                                                    <div class="col-sm-9">
                                                                        <input id="leave_start_date" class="form-control" name="leave_start_date"/>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group calender row" id="return_ip">
                                                                    <div class="col-sm-3">
                                                                        <h6>Leave End Date</h6>
                                                                    </div>
                                                                    <div class="col-sm-9">
                                                                        <input id="leave_end_date" class="form-control" name="leave_end_date" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-3">
                                                                            <h6>Leave Message</h6>
                                                                        </div>
                                                                      <div class="col-sm-9">
                                                                        <textarea class="form-control" id="leave_message" name="leave_message" rows="6"></textarea>
                                                                      </div>
                                                                </div>
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
            </div>
        </main>
        <footer class="custom-footer">
            <!-- Copyright Content file -->
            <?php include 'copyright_content.php'; ?>
        </footer>
        <!-- Footer JS files -->
        <?php include 'footer_js.php' ?>
        <script src="assets/js/jquery-min.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery("#leave_start_date").datepicker({
                    minDate: 0,
                    onSelect: function(date) {
                        jQuery("#leave_end_date").datepicker('option', 'minDate', date);
                    }
                });
                jQuery("#leave_end_date").datepicker({});
                jQuery("#half").click  (function(){ 
                    jQuery("#leave_end_date").css("display", "none");
                    jQuery("#calculate").css("display", "none");
                });
                jQuery("#full").click  (function(){ 
                    jQuery("#leave_end_date").css("display", "block");
                });
            });
        </script>
    </body>
</html>