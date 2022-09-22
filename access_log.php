<?php
error_reporting(E_ALL ^ E_NOTICE);
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
        <title>Access Logs - CERM :: Codearts Employee Relationship Management</title>
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
                                <h2>Access Log</h2>
                                <ul>
                                    <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                    <li>Access Log</li>
                                </ul>
                            </section>
                            <?php if($_SESSION['emp_type'] == 'hr' || $_SESSION['emp_type'] == 'admin') { ?>
                                <section class="employee-profiles">
                                    <div class="row">
                                        <?php 
                                            $sql1 = "SELECT * FROM capms_admin_users";
                                            $result1 = mysqli_query($con, $sql1);
                                            if($result1->num_rows > 0)
                                            {
                                                while($row1 = mysqli_fetch_assoc($result1))
                                                {
                                                    ?>
                                                        <div class="col-lg-3 col-md-6">
                                                            <div class="employee-profiles-thubmnail">
                                                                <div class="dropdown employee-thumb-toggle">
                                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fas fa-ellipsis-v"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                        <a class="dropdown-item"
                                                                            href="javascript:void(0)"><?php echo ucwords($row1['user_type']); ?></a>
                                                                        <a class="dropdown-item" href="employee_access_log.php?user_id=<?php echo $row1['id']; ?>">Access Log</a>
                                                                    </div>
                                                                </div>
                                                                <div class="employee-image">
                                                                    <a href="employee_access_log.php?user_id=<?php echo $row1['id']; ?>"><img src="assets/uploads/user_featured_images/<?php echo $row1['user_featured_image']; ?>" alt=""></a>
                                                                </div>
                                                                <div class="employee-content">
                                                                    <a href="employee_access_log.php?user_id=<?php echo $row1['id']; ?>"><?php echo $row1['user_fullname']; ?></a>
                                                                    <h6><?php echo $row1['user_designation']; ?></h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                </section>
                            <?php } else if($_SESSION['emp_type'] == 'employee' || $_SESSION['emp_type'] == '') { ?>
                                <section>
                                    <button type="button" id="lunch-break-btn" class="btn btn-primary lunch-break-btn">Lunch Break</button>
                                    <button type="button" id="evening-break-btn" class="btn btn-primary evening-break-btn">Evening Break</button>
                                </section>
                                <section class="access-logs">
                                    <table class="table weekly-time-table-dp">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Login Time</th>
                                                <th scope="col">Lunch Break</th>
                                                <th scope="col">Evening Breaks</th>
                                                <th scope="col">Logout Time</th>
                                                <th scope="col">Total Hours</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql2 = "SELECT * FROM capms_login_information WHERE user_id = '".$_SESSION['emp_id']."' ORDER BY `login_date` ASC";
                                                $result2 = mysqli_query($con, $sql2);
                                                if($result2->num_rows > 0)
                                                {
                                                    while($row2 = mysqli_fetch_assoc($result2))
                                                    {
                                                        $checkTime = strtotime('10:45:00');
                                                        $loginTime = strtotime($row2['login_time']);
                                                        $diff = $checkTime - $loginTime;
                                                        ($diff < 0)? $class='access_log_wrong' : $class='access_log_ok';

                                                        ?>
                                                        <tr>
                                                            <!-- login date -->
                                                            <th scope="row">
                                                                <?php echo date('d-m-Y', strtotime($row2['login_date'])); ?>
                                                            </th>
                                                            <!-- login time -->
                                                            <td class="bg-dp-drk <?php echo $class ?>">
                                                                <?php echo $row2['login_time']; ?>
                                                            </td>
                                                            <!-- lunch break duration -->
                                                            <?php 
                                                            
                                                            $diff_lunch_break = strtotime($row2['lunch_break_end']) - strtotime($row2['lunch_break_start']);
                                                            ($diff_lunch_break > 3600)? $class='access_log_wrong' : $class='access_log_ok';
                                                            
                                                            ?>
                                                            <td class="<?php echo $class ?>">
                                                                <?php
                                                                    if($row2['lunch_break_start'] != '')
                                                                    {
                                                                        echo $row2['lunch_break_start'];
                                                                    }
                                                                    if($row2['lunch_break_end'] != '')
                                                                    {
                                                                        echo " - ".$row2['lunch_break_end'];
                                                                    }
                                                                ?>
                                                            </td>
                                                            <!-- evening break duration -->
                                                            <?php 
                                                            $diff_evn_break = strtotime($row2['evening_break_end']) - strtotime($row2['evening_break_start']);
                                                            ($diff_evn_break > 600)? $class='access_log_wrong' : $class='access_log_ok';
                                                            ?>
                                                            <td class="<?php echo $class?>">
                                                                <?php
                                                                    if($row2['evening_break_start'] != '')
                                                                    {
                                                                        echo $row2['evening_break_start'];
                                                                    }
                                                                    if($row2['evening_break_end'] != '')
                                                                    {
                                                                        echo " - ".$row2['evening_break_end'];
                                                                    }
                                                                ?>
                                                            </td>
                                                            <!-- logout time -->
                                                            <td class="bg-dp-drk">
                                                                <?php
                                                                if($row2['logout_time'] !=""){
                                                                    $logout_time_array = explode(" ", $row2['logout_time']);
                                                                    $logout_time = str_replace('-', ':', $logout_time_array[0]);
                                                                    $logout_time = date('g:i A' ,strtotime($logout_time));
                                                                    echo $logout_time." <span class='text-danger'><b>".$logout_time_array[1]."</b></span>";
                                                                }
                                                                ?>
                                                            </td>
                                                            <!-- total hours -->
                                                            <?php 
                                                                $diff = strtotime($logout_time) - strtotime($row2['login_time'])-$diff_lunch_break-$diff_evn_break;
                                                                $secs = $diff % 60;
                                                                $hrs = $diff / 60;
                                                                $mins = $hrs % 60;
                                                                $hrs = $hrs / 60;
                                                                $working_hours = (float) ((int)$hrs . "." . (int)$mins);
                                                            
                                                                if(number_format($working_hours,2) >=7.40){
                                                                $class = 'access_log_ok';
                                                                }
                                                                else{
                                                                $class = 'access_log_wrong';
                                                                }
                                                            ?>
                                                            <td class="<?php echo $class ?>">
                                                                <?php 
                                                                if($row2['logout_time'] !="" && $row2['login_time'] !="") {
                                                                    echo $working_hours; 
                                                                }
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
                            <?php } ?>
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
        <script src="assets/js/jquery-min.js"></script>
        <script>
            jQuery( document ).ready(function() {
                /* lunch break time duration */
                lunch_break_time_duration('blank');
                jQuery('#lunch-break-btn').click(function () {
                    if(jQuery(this).hasClass('lunch-break-btn-disabled'))
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
                            baseURL: '<?php echo $baseURL; ?>',
                            status: status,
                            emp_id: emp_id
                        },
                        dataType: "json",
                        success: function(response){
                            console.log(response);
                            if(response.status == 'lunch_break_started')
                            {
                                jQuery('#lunch-break-btn').addClass('lunch-break-btn-disabled');
                                jQuery('#lunch-break-btn').removeClass('btn-primary');
                                jQuery('#lunch-break-btn').addClass('btn-warning');
                            }
                            else if(response.status == 'lunch_break_stopped')
                            {
                                jQuery('#lunch-break-btn').removeClass('lunch-break-btn-disabled');
                                jQuery('#lunch-break-btn').removeClass('btn-warning');
                                jQuery('#lunch-break-btn').addClass('btn-secondary');
                                jQuery('#lunch-break-btn').attr('disabled', true);
                            }
                        }
                    });
                }
                /* evening break time duration */
                evening_break_time_duration('blank');
                jQuery('#evening-break-btn').click(function () {
                    if(jQuery(this).hasClass('evening-break-btn-disabled'))
                    {
                        evening_break_time_duration('stop_now');
                    }
                    else
                    {
                        evening_break_time_duration('start_now');
                    }
                });
                function evening_break_time_duration(status)
                {
                    var status = status;
                    var emp_id = <?php echo $_SESSION['emp_id']; ?>;
                    jQuery.ajax({
                        type: "GET",
                        url: "<?php echo $baseURL; ?>ajax_evening_break_duration.php",
                        data: {
                            baseURL: '<?php echo $baseURL; ?>',
                            status: status,
                            emp_id: emp_id
                        },
                        dataType: "json",
                        success: function(response){
                            console.log(response);
                            if(response.status == 'evening_break_started')
                            {
                                jQuery('#evening-break-btn').addClass('evening-break-btn-disabled');
                                jQuery('#evening-break-btn').removeClass('btn-primary');
                                jQuery('#evening-break-btn').addClass('btn-warning');
                            }
                            else if(response.status == 'evening_break_stopped')
                            {
                                jQuery('#evening-break-btn').removeClass('evening-break-btn-disabled');
                                jQuery('#evening-break-btn').removeClass('btn-warning');
                                jQuery('#evening-break-btn').addClass('btn-secondary');
                                jQuery('#evening-break-btn').attr('disabled', true);
                            }
                        }
                    });
                }
            });
        </script>
    </body>
</html>