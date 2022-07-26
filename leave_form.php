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
                                                                <!-- Employee Name -->
                                                                <div class="form-group row">
                                                                    <label for="inputText" class="col-sm-3 col-form-label">Employee Name</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" class="form-control" id="empname" placeholder="" name="ename" value="<?php echo $_SESSION['emp_name'];  ?>" disabled>
                                                                    </div>
                                                                </div>
                                                                <!-- Employee Department -->
                                                                <div class="form-group row">
                                                                    <label for="inputText" class="col-sm-3 col-form-label">Department</label>
                                                                    <div class="col-sm-9">
                                                                        <input type="" class="form-control" id="empdept" placeholder="" name="department" value="<?php echo $row1['user_designation']; ?>" disabled>
                                                                    </div>
                                                                </div>
                                                                <!-- Remaining PL(s) -->
                                                                <div class="form-group total-no row">
                                                                      <div class="col-sm-3">
                                                                            <h6>Remaining PL(s)</h6>
                                                                        </div>
                                                                      <div class="col-sm-9">
                                                                        <input class="form-control" type="text" id="remaining_pls" name="remaining_pls" value="18" disabled>
                                                                      </div>
                                                                </div>
                                                                <!-- Reson of Leave -->
                                                                <div class="form-group row">
                                                                    <div class="col-sm-3">
                                                                        <h6>Reason of Leave</h6>
                                                                    </div>
                                                                    <div class="col-sm-9">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="reason_of_leave" id="reason_of_leave_vacation_leave" value="Vacation Leave">
                                                                            <label class="form-check-label" for="reason_of_leave_vacation_leave">
                                                                                Vacation Leave
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="reason_of_leave" id="reason_of_leave_medical_leave" value="Medical Leave">
                                                                            <label class="form-check-label" for="reason_of_leave_medical_leave">
                                                                                Medcial Leave
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="reason_of_leave_family_emergency" name="reason_of_leave" value="Family Emergency">
                                                                            <label class="form-check-label" for="reason_of_leave_family_emergency">
                                                                                Family Emergency
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="reason_of_leave_parental_leave" name="reason_of_leave" value="Parental Leave">
                                                                            <label class="form-check-label" for="reason_of_leave_parental_leave">
                                                                                Parental Leave
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="reason_of_leave_study_leave" name="reason_of_leave" value="Study Leave">
                                                                            <label class="form-check-label" for="reason_of_leave_study_leave">
                                                                                Study Leave
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="reason_of_leave_doctor_appointment" name="reason_of_leave" value="Doctor Appointment">
                                                                            <label class="form-check-label" for="reason_of_leave_doctor_appointment">
                                                                                Doctor Appointment
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="reason_of_leave_religious_leave" name="reason_of_leave" value="Religious Leave">
                                                                            <label class="form-check-label" for="reason_of_leave_religious_leave">
                                                                                Religious Leave
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="reason_of_leave_natural_calamity" name="reason_of_leave" value="Natural Calamity">
                                                                            <label class="form-check-label" for="reason_of_leave_natural_calamity">
                                                                                Natural Calamity
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="reason_of_leave_bereavement_leave" name="reason_of_leave" value="Bereavement Leave">
                                                                            <label class="form-check-label" for="reason_of_leave_bereavement_leave">
                                                                                Bereavement Leave
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="reason_of_leave_others" name="reason_of_leave" value="Others">
                                                                            <label class="form-check-label" for="reason_of_leave_others">
                                                                                Others
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Type of Leave -->
                                                                <div class="form-group row">
                                                                    <div class="col-sm-3">
                                                                        <h6>Type for Leave</h6>
                                                                    </div>
                                                                    <div class="col-sm-9">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="type_of_leave_full_day" name="type_of_leave" value="Full Day">
                                                                            <label class="form-check-label" for="type_of_leave_full_day">Full Day</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="type_of_leave_first_half" name="type_of_leave" value="First Half">
                                                                            <label class="form-check-label" for="type_of_leave_first_half">Fist Half</label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" id="type_of_leave_second_half" name="type_of_leave" value="Second Half">
                                                                            <label class="form-check-label" for="type_of_leave_second_half">Second Half</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Leave Start Date -->
                                                                <div class="form-group calender row" id="leave_ip">
                                                                    <div class="col-sm-3">
                                                                        <h6>Leave Start Date</h6>
                                                                    </div>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" id="leave_start_date" class="form-control" name="leave_start_date" />
                                                                    </div>
                                                                </div>
                                                                <!-- Leave End Date -->
                                                                <div class="form-group calender row" id="return_ip">
                                                                    <div class="col-sm-3" id="leave_end_date_label">
                                                                        <h6>Leave End Date</h6>
                                                                    </div>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" id="leave_end_date" class="form-control" name="leave_end_date" />
                                                                    </div>
                                                                </div>
                                                                <!-- Leave Message -->
                                                                <div class="form-group row">
                                                                    <div class="col-sm-3">
                                                                            <h6>Leave Message</h6>
                                                                    </div>
                                                                    <div class="col-sm-9">
                                                                        <textarea class="form-control" id="leave_message" name="leave_message" rows="6"></textarea>
                                                                    </div>
                                                                </div>
                                                                <!-- Confirm Application -->
                                                                <div class="form-group send">
                                                                    <button class="btn btn-primary" id="confirm_leave_application" name="confirm_leave_application">Confirm Leave Application</button>
                                                                </div>
                                                                <!-- Leave Status Clarification -->
                                                                <div class="leave_status_clarification" id="leave_status_clarification">
                                                                    <table class="table table-striped">
                                                                        <thead class="thead-dark">
                                                                            <tr>
                                                                                <th>Reason</th>
                                                                                <th>Type</th>
                                                                                <th>Date</th>
                                                                                <th>Day</th>
                                                                                <th>Leaves</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="leave_status_clarification_body"></tbody>
                                                                    </table>
                                                                </div>
                                                                <!-- Total No. of Leaves -->
                                                                <div class="form-group row">
                                                                    <div class="col-sm-3" id="total_leave_days_label">
                                                                        <h6>Total No. of Leaves</h6>
                                                                    </div>
                                                                    <div class="col-sm-9">
                                                                        <input type="text" id="total_leave_days" class="form-control" name="total_leave_days" />
                                                                    </div>
                                                                </div>
                                                                <!-- Submit Leave Application -->
                                                                <div class="send">
                                                                    <button type="submit" class="btn btn-primary" name="submit_leave_application" id="submit_leave_application" value="Send and Email">Submit Application</button>
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

        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery("#submit_leave_application").hide();
                jQuery("#leave_status_clarification").hide();
                jQuery("#total_leave_days_label").hide();
                jQuery("#total_leave_days").hide();

                jQuery("#leave_start_date").datepicker({
                    dateFormat: 'dd-mm-yy',
                    minDate: 0,
                    onSelect: function(date) {
                        jQuery("#leave_end_date").datepicker('option', 'minDate', date);
                    }
                });
                jQuery("#leave_end_date").datepicker({
                    dateFormat: 'dd-mm-yy',
                });
                
                jQuery("#type_of_leave_first_half").click  (function(){ 
                    jQuery("#leave_end_date").css("display", "none");
                    jQuery("#leave_end_date_label").css("display", "none");
                });
                jQuery("#type_of_leave_second_half").click  (function(){ 
                    jQuery("#leave_end_date").css("display", "none");
                    jQuery("#leave_end_date_label").css("display", "none");
                });
                jQuery("#type_of_leave_full_day").click  (function(){ 
                    jQuery("#leave_end_date").css("display", "block");
                    jQuery("#leave_end_date_label").css("display", "block");
                });

                jQuery("#confirm_leave_application").click( function(e) {
                    e.preventDefault();
                    var emp_name = jQuery("#empname").val();
                    var emp_dept = jQuery("#empdept").val();
                    var emp_remaining_pls = jQuery("#remaining_pls").val();
                    var reason_of_leave = jQuery("input[name='reason_of_leave']:checked").val();
                    var type_of_leave = jQuery("input[name='type_of_leave']:checked").val();
                    var leave_start_date = jQuery("#leave_start_date").val();
                    var leave_end_date = jQuery("#leave_end_date").val();
                    var leave_message = jQuery("#leave_message").val();
                    
                    if(reason_of_leave == null || type_of_leave == null)
                    {
                        alert('Choose both Reason of Leave and Type of Leave');      
                    }
                    else
                    {
                        if(leave_start_date == '' || leave_message == '')
                        {
                            alert('Select Leave dates and put the Leave message both');
                        }
                        else
                        {
                            if(leave_end_date == '')
                            {

                            }
                            else
                            {
                                var getDaysBetweenDates = function(startDate, endDate) {
                                    var now = startDate.clone(), dates = [];
                              
                                    while (now.isSameOrBefore(endDate)) {
                                        dates.push(now.format('DD-MM-YYYY'));
                                        now.add(1, 'days');
                                    }
                                    return dates;
                                };
                          
                                var startDate = moment(leave_start_date, "DD-MM-YYYY");
                                var endDate = moment(leave_end_date, "DD-MM-YYYY");
                              
                                var dateList = getDaysBetweenDates(startDate, endDate);
                                var status_table = '';
                                var i=1;

                                function test(mJsDate){
                                   //var str = mJsDate.toLocaleString().substring(0, 3) +" number " + Math.ceil(mJsDate.date() / 7) +" of the month";
                                   var str = Math.ceil(mJsDate.date() / 7)+" Saturday";
                                   return str;
                                }

                                jQuery.each(dateList, function(key, value){
                                    status_table += '<tr>';
                                    status_table += '<td>'+reason_of_leave+'</td>';
                                    status_table += '<td>'+type_of_leave+'</td>';
                                    status_table += '<td>'+value+'</td>';
                                    var oneDate = moment(value, 'DD-MM-YYYY');
                                    if(oneDate.format('dddd') == 'Saturday')
                                    {
                                        if(test(oneDate) == '1 Saturday' || test(oneDate) == '3 Saturday')
                                        {
                                            status_table += '<td>'+oneDate.format('dddd')+'</td>';
                                            status_table += '<td>-</td>';
                                        }
                                        else
                                        {
                                            status_table += '<td>'+oneDate.format('dddd')+'</td>';
                                            status_table += '<td>'+i+'</td>';
                                            i++;
                                        }
                                        
                                    }
                                    else if(oneDate.format('dddd') == 'Sunday')
                                    {
                                        status_table += '<td>'+oneDate.format('dddd')+'</td>';
                                        status_table += '<td>-</td>';
                                    }
                                    else
                                    {
                                        status_table += '<td>'+oneDate.format('dddd')+'</td>';
                                        status_table += '<td>'+i+'</td>';
                                        i++;
                                    }
                                    status_table += '</tr>';
                                });
                                jQuery("#total_leave_days_label").show();
                                jQuery("#total_leave_days").show();
                                jQuery("#total_leave_days").val(i);
                                jQuery("#leave_status_clarification").show();
                                jQuery("#confirm_leave_application").hide();
                                jQuery("#submit_leave_application").show();
                                jQuery("#leave_status_clarification_body").append(status_table);
                            }
                        }
                    }
                });
            });
        </script>
    </body>
</html>