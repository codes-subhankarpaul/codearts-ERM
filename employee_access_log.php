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
        <title>Employee Access Log - CERM :: Codearts Employee Relationship Management</title>
    </head>

    <body>
        <header class="custom-header">
            <!-- Dashboard Top Info Panel -->
            <?php include 'info_panel.php'; ?>
        </header>
        <?php 
            $sql_user = "SELECT * FROM `capms_admin_users` WHERE `id` = '".$_REQUEST['user_id']."'";
            $result_user = mysqli_query($con, $sql_user);
            while ($row_user = mysqli_fetch_array($result_user)) {
        ?>
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
                                <h2>Access Log - <span class="text-primary"><?php echo $row_user['user_fullname']?></span><span class="text-secondary h5"> (<?php echo $row_user['user_designation']?>)</span></h2>
                                <ul>
                                    <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                    <li><a href="<?php echo $baseURL; ?>access_log.php">Access Log</a></li>
                                    <li>Employee Access Log</li>
                                </ul>
                            </section>
                            <?php if($_SESSION['emp_type'] == 'hr' || $_SESSION['emp_type'] == 'admin') { ?>
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
                                                $sql2 = "SELECT * FROM capms_login_information WHERE user_id = '".$_REQUEST['user_id']."'";
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
                                                                $working_hours =  ((int)$hrs . "." . (int)$mins);
                                                            
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
        <?php
            }
        ?>
        <footer class="custom-footer">
            <!-- Copyright Content file -->
            <?php include 'copyright_content.php'; ?>
        </footer>
        <!-- Footer JS files -->
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
    </body>
</html>