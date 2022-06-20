<!doctype html>
<html lang="en">

    <head>
        <!-- Header CSS files -->
        <?php include 'header_css.php'; ?>
        <?php
            if($_SESSION['emp_id'] == '')
            {
              echo "<script>location.href='http://codeartssolution.com/ERM/login.php';</script>";
            }
        ?>
        <title>Employee Access Log - CERM :: Codearts Employee Relationship Management</title>
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
                                    <li><a href="<?php echo $baseURL; ?>access_log.php">Access Log</a></li>
                                    <li>Employee Access Log</li>
                                </ul>
                            </section>
                            <?php $user_id = $_REQUEST['user_id']; ?>
                            <?php if($user_id == $_SESSION['emp_id'] && $_SESSION['emp_type'] == 'hr') { ?>
                                <section>
                                    <a href="Javascript:void(0)" id="lunch-break-btn" class="lunch-break-btn">Lunch Break</a>
                                </section>
                            <?php } ?>
                            <section>
                                <table class="table weekly-time-table-dp access_log_table">
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
                                            $sql1 = "SELECT * FROM capms_login_information WHERE user_id = '".$user_id."' ";
                                            $result1 = mysqli_query($con, $sql1);
                                            if($result1->num_rows > 0)
                                            {
                                                while($row1 = mysqli_fetch_assoc($result1))
                                                {
                                                    ?>
                                                    <tr>
                                                        <th scope="row">
                                                            <?php echo date('d-m-Y', strtotime($row1['login_date'])); ?>
                                                        </th>
                                                        <td class="bg-dp-drk">
                                                            <?php
                                                                $login_time = str_replace('-', ':', $row1['login_time']);
                                                                $login_time = date('G:i A' ,strtotime($login_time));
                                                                echo $login_time;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if($row1['lunch_break_start'] != '')
                                                                {
                                                                    echo date('h:i', strtotime($row1['lunch_break_start']));
                                                                }
                                                                if($row1['lunch_break_end'] != '')
                                                                {
                                                                    echo " - ".date('G:i', strtotime($row1['lunch_break_end']));
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>4.45 - 5.00</td>
                                                        <td class="bg-dp-drk">
                                                            <?php
                                                                $logout_time = str_replace('-', ':', $row1['logout_time']);
                                                                $logout_time = date('G:i A' ,strtotime($logout_time));
                                                                echo $logout_time;
                                                            ?>
                                                        </td>
                                                        <td>7.45</td>
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
        <?php include 'footer_js.php' ?>
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