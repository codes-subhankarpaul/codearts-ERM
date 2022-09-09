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
        <title>Employee Timesheet Log - CERM :: Codearts Employee Relationship Management</title>
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
                                <h2>Timesheet Log</h2>
                                <ul>
                                    <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                    <li><a href="<?php echo $baseURL; ?>access_log.php">Timesheet</a></li>
                                    <li>Employee Timesheet Log</li>
                                </ul>
                            </section>
                            <?php $user_id = $_REQUEST['user_id']; ?>
                            <?php if($user_id == $_SESSION['emp_id'] && $_SESSION['emp_type'] == 'hr') { ?>
                                <section>
                                    <a href="Javascript:void(0)" id="lunch-break-btn" class="lunch-break-btn">Lunch Break</a>
                                </section>
                                
                            <?php } ?>

                            <section class="py-3 mb-3">
                                <button class="btn btn-warning" id="timesheet_filter">timesheet filter toggle <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
                    <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                    </svg></span></button>
                                <button class="btn btn-danger" id="unfilled_timesheet_button">unfilled timesheet <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                    </svg></span></button>
                            </section>

                            <?php
                                // username from user_id
                                if(isset($_REQUEST['user_id'])) {
                                    $sql_user = "SELECT * FROM `capms_admin_users` WHERE `id` = '".$_REQUEST['user_id']."'";
                                    $result_user = mysqli_query($con, $sql_user);
                                    while($row_user = mysqli_fetch_assoc($result_user)) {
                                        $user_name = $row_user['user_fullname'];
                                    }
                                }   
                            ?>

                            
                            <section id="unfilled_timesheet" class="py-3 d-none">
                                <div class="row">
                                    <div class="col">
                                    <label for="unfilled_timesheet_dropdown" class="form-label text-danger">* unfilled timesheet of this month for current user - <span class="fw-bolder text-primary fs-2"><?php echo $user_name; ?></span></label>
                                        <div class="row">
                                        <div class="col-md-10">
                                            <ul>
                                            <?php
                                                    require_once "database.php";
                                                    $emp_id = $_SESSION['emp_id'];

                                                    // loop through two dates
                                                    date_default_timezone_set('UTC');

                                                    $start_date = date('Y-m-01');;
                                                    $end_date = date('Y-m-t');
                                                    $day_count = 0;

                                                    while (strtotime($start_date) <= strtotime($end_date)) {
                                                        $unfilled_sql = "SELECT * FROM `capms_user_timesheet` WHERE `timesheet_date` = '".date("m/d/Y",strtotime($start_date))."' and user_id = '" . $_REQUEST['user_id'] . "'";
                                                        $result_unfilled = mysqli_query($con, $unfilled_sql);
                                                        $rowcount=mysqli_num_rows($result_unfilled);
                                                        if($rowcount<1) {
                                                            $day_count++;
                                            ?>
                                            <li><?php echo date("m/d/Y",strtotime($start_date))." - ".date('D', strtotime($start_date)); ?></li>
                                            <?php
                                                        }
                                                        $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
                                                    }
                                            ?>
                                                <li class="py-1 text-danger">total unfilled days - <?php echo $day_count;?></li>
                                            </ul>  
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <?php
                            if(isset($_POST['unfilled_timesheet_select'])) {
                                // 1. open add timesheet, 2. set date filled with post date
                                echo '<script>
                                console.log("inside post - unfilled timesheet select");
                                $("#insert_timesheet").removeClass("d-none");
                                </script>';
                            }
                            ?>

                            <?php
                            $current_date = date('m/d/Y', strtotime('now'));
                            ?>


                            <section id="filter_date" class="d-none py-3">
                                <form action="" method="post">
                                    <div class="card">
                                    <div class="card-header bg-warning text-dark">
                                        Filter using start date and end date
                                    </div>
                                    <div class="card-body">
                                        <div class="row text-dark">
                                        <div class="col">
                                            <div class="mb-3">
                                            <label for="sdt">Start date - </label></br>
                                            <input id="sdt" name="sdate" placeholder=" choose start date" autocomplete="off"/>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3">
                                            <label for="edt">End date - </label></br>
                                            <input id="edt" name="edate" placeholder=" choose end date" autocomplete="off"/>
                                            </div>
                                        </div>
                                        </div>  
                                        <div class="row">
                                        <div class="col"></div>
                                        <div class="col">
                                            <div class="mb-3">
                                            <button type="submit" id="filter_button" class="btn btn-primary" disabled>Filter</button>
                                            </div>
                                        </div>
                                        <div class="col"></div>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                            
                            </section>

                            <section>
                                <table class="table weekly-time-table-dp access_log_table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Start Time</th>
                                            <th scope="col">End Time</th>
                                            <th scope="col">Task Domain</th>
                                            <th scope="col">Task Type</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Trello Link</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $current_date = date('m/d/Y', strtotime('now'));
                                            if(isset($_POST['sdate']) && isset($_POST['edate'])) {
                                                // echo $_POST['sdate']." - ";
                                                // echo $_POST['edate'];
                                                $sql1 = "SELECT * FROM `capms_user_timesheet` WHERE `user_id` = '" . $_REQUEST['user_id'] . "' and `timesheet_date` BETWEEN '".$_POST['sdate']."' AND '".$_POST['edate']."'";
                                            }
                                            else {
                                                $sql1 = "SELECT * FROM `capms_user_timesheet` WHERE `user_id` = '" . $_REQUEST['user_id'] . "' and `timesheet_date`= '".$current_date."'";
                                            }

                                            // $sql1 = "SELECT * FROM capms_user_timesheet WHERE user_id = '".$user_id."' ";
                                            $result1 = mysqli_query($con, $sql1);
                                            if($result1->num_rows > 0)
                                            {
                                                while($row1 = mysqli_fetch_assoc($result1))
                                                {
                                                    // find task_domain name by task_domain id
                                                    $task_domain_name_sql = "SELECT * FROM `capms_department_info` WHERE `dept_id` = '". $row1['task_domain'] . "'";

                                                    $result_task_domain_name = mysqli_query($con, $task_domain_name_sql);

                                                    while ($row_task_domain_name = mysqli_fetch_array($result_task_domain_name)) {
                                                        $task_domain = $row_task_domain_name['dept_name'];
                                                    }

                                                    // find task_domain name by task_domain id
                                                    $task_type_name_sql = "SELECT * FROM `capms_project_tasktype_info` WHERE `task_type_id` = '". $row1['task_type'] . "'";

                                                    $result_task_type_name = mysqli_query($con, $task_type_name_sql);

                                                    while ($row_task_type_name = mysqli_fetch_array($result_task_type_name)) {
                                                        $task_type = $row_task_type_name['task_type_name'];
                                                    }

                                                    ?>
                                                    <tr>
                                                        <th scope="row">
                                                            <?php echo date('d-m-Y', strtotime($row1['timesheet_date'])); ?>
                                                        </th>
                                                        <td class="bg-dp-drk">
                                                            <?php
                                                                // $start_time = str_replace('-', ':', $row1['start_time']);
                                                                // $start_time = date('G:i A' ,strtotime($start_time));
                                                                echo $row1['start_time']."hrs";
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                // $end_time = str_replace('-', ':', $row1['end_time']);
                                                                // $end_time = date('G:i A' ,strtotime($end_time));
                                                                echo $row1['end_time']."hrs";
                                                            ?>
                                                        </td>
                                                        <td class="bg-dp-drk">
                                                            <?php
                                                                echo $task_domain;
                                                            ?> 
                                                        </td>
                                                        <td>
                                                            <?php
                                                                echo $task_type;
                                                            ?>
                                                        </td>
                                                        <td  class="bg-dp-drk">
                                                            <?php
                                                                echo $row1['description'];
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                echo "<a href='". $row1['trello_link'] . "'>". $row1['trello_link'] . "</a>";
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
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

        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://jqueryui.com//resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
        <script>
            $(function() {
            var availableTeamMembers = <?php echo $names ?>;
            $("#leaders").autocomplete({
                source: availableTeamMembers
            });

            var availableTeams = ['Html-Css', 'Angular-Iocic', 'Development', 'Testing'];
            $("#teams").autocomplete({
                source: availableTeams
            });


            });
        </script>

        <script src="https://cdn.tiny.cloud/1/04z7u7156gqei101i37ypflfj99zptjgbodnyi91ni0bs5je/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

        <script>
            tinymce.init({
            selector: 'textarea#editor',
            menubar: false
            });
        </script>

        <script src="assets/js/jquery-min.js"></script>
        <script>
            jQuery( document ).ready(function() {
                lunch_break_time_duration('blank');
                jQuery('#lunch-break-btn').click(function () {
                    if(jQuery(this).hasClass('disabled'))
                    {
                        lunch_break_time_duration('stop_now');
                    }
                    else
                    {
                        lunch_break_time_duration('start_now');
                    }
                });

                function lunch_break_time_duration(status)
                {
                    var status = status;
                    var emp_id = <?php echo $_SESSION['emp_id']; ?>;
                    jQuery.ajax({
                        type: "GET",
                        url: "<?php echo $baseURL; ?>ajax_lunch_break_duration.php",
                        data: {
                            status: status,
                            emp_id: emp_id
                        },
                        dataType: "json",
                        success: function(response){
                            console.log(response);
                            if(response.status == 'lunch_break_started')
                            {
                                jQuery('#lunch-break-btn').addClass('disabled');
                            }
                            else if(response.status == 'lunch_break_stopped')
                            {
                                jQuery('#lunch-break-btn').removeClass('disabled');
                            }
                        }
                    });
                }
            });
        </script>

        <!-- START DATE AND END DATE PICKER -->
        <script>
            $("#sdt").datepicker({
            onSelect: function(dateText, inst) {
                var sdate = $(this).val();
                var fullStartDate = new Date(sdate);
                var twoDigitMonthStart = ((fullStartDate.getMonth().length + 1) === 1) ? (fullStartDate.getMonth() + 1) : '0' + (fullStartDate.getMonth() + 1);
                var startDate = fullStartDate.getDate() + "/" + twoDigitMonthStart + "/" + fullStartDate.getFullYear();

                if($('#edt').val()!='' && startDate!='') {
                // enable submit button
                $('#filter_button').prop('disabled', false);
                }
            }
            });
            $("#edt").datepicker({
            onSelect: function(dateText, inst) {
                var edate = $(this).val();
                var fullEndDate = new Date(edate);
                var twoDigitMonthEnd = ((fullEndDate.getMonth().length + 1) === 1) ? (fullEndDate.getMonth() + 1) : '0' + (fullEndDate.getMonth() + 1);
                var endDate = fullEndDate.getDate() + "/" + twoDigitMonthEnd + "/" + fullEndDate.getFullYear();

                if(endDate!='' && $('#sdt').val()!='') {
                // enable submit button
                $('#filter_button').prop('disabled', false);
                }
            }
            });
        </script>

        <!-- FILTER TOGGLE -->
        <script>
            $(document).ready(function() {
            $("#timesheet_filter").click(function() {
                $("#filter_date").toggleClass("d-none");
            });
            });
        </script>

        <!-- UNFILLED TIMESHEET TOGGLE -->
        <script>
            $(document).ready(function() {
            $("#unfilled_timesheet_button").click(function() {
                $("#unfilled_timesheet").toggleClass("d-none");
            });
            });
        </script>

        <!-- FILL UNFILLED TIMESHEET -->
        <script>
            $(document).ready(function() {
            $('#unfilled_timesheet_dropdown').on('change', function () {
                var selectVal = this.value;
                if(selectVal!='') {
                    $('#fill_unfilled_timesheet_button').prop('disabled', false);
                }
            });
            });
        </script>
    </body>
</html>