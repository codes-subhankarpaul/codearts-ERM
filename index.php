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

            // preventing auto-login using session when previous session is set and no previous logout time is there.

            $login_details = "SELECT * FROM `capms_login_information` WHERE user_id = '".$_SESSION['emp_id']."' ORDER BY ID DESC LIMIT 1";

            $result_logout = mysqli_query($con, $login_details);

            while($row_logout = mysqli_fetch_assoc($result_logout)) {
                if($row_logout['logout_time']=='') {
                    unset($_SESSION['emp_id']);
                    unset($_SESSION['emp_name']);
                    unset($_SESSION['emp_image']);
                    session_destroy();
                    echo "<script>location.href='".$baseURL."login.php';</script>";
                }
            }
        ?>
        <title>CERM :: Codearts Employee Relationship Management</title>
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
                            <section class="dashboard-cal-sheet">
                                <div class="row">
                                    
                                    <div class="col-lg-12">
                                        <div class="dp-weekly-time-sheet">
                                            <div class="custom-heading">
                                                <h3>Monthly Access Log</h3>
                                            </div>
                                            <div class="weekly-time-table-dashboard">
                                                <h4>Employee Name: <span><?php echo $_SESSION['emp_name'];  ?></span></h4>
                                                <!-- Employee Weekly Timesheet file -->
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
                                                            $sql2 = "SELECT * FROM capms_login_information WHERE user_id = '".$_SESSION['emp_id']."' ORDER BY `login_date` ASC ";
                                                            $result2 = mysqli_query($con, $sql2);
                                                            if($result2->num_rows > 0)
                                                            {
                                                                while($row2 = mysqli_fetch_assoc($result2))
                                                                {
                                                                    $checkTime = strtotime('10:45:00');
                                                                    $loginTime = strtotime($row2['login_time']);
                                                                    $diff = $checkTime - $loginTime;
                                                                    ($diff < 0)? $class='late' : $class='right';

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
                                                                        ($diff_lunch_break > 3600)? $class='late' : $class='right';
                                                                        
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
                                                                        ($diff_evn_break > 600)? $class='late' : $class='right';
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
                                                                                $logout_time = str_replace('-', ':', $row2['logout_time']);
                                                                                $logout_time = date('g:i A' ,strtotime($logout_time));
                                                                                echo $logout_time;
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
                                                                            $class = 'right';
                                                                           }
                                                                           else{
                                                                            $class = 'late';
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
                                            </div>
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

    </body>
</html>