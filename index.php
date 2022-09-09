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
                                                            $sql2 = "SELECT * FROM capms_login_information WHERE user_id = '".$_SESSION['emp_id']."' ";
                                                            $result2 = mysqli_query($con, $sql2);
                                                            if($result2->num_rows > 0)
                                                            {
                                                                while($row2 = mysqli_fetch_assoc($result2))
                                                                {
                                                                    ?>
                                                                    <tr>
                                                                        <!-- login date -->
                                                                        <th scope="row">
                                                                            <?php echo date('d-m-Y', strtotime($row2['login_date'])); ?>
                                                                        </th>
                                                                        <!-- login time -->
                                                                        <td class="bg-dp-drk">
                                                                            <?php echo $row2['login_time']; ?>
                                                                        </td>
                                                                        <!-- lunch break duration -->
                                                                        <td>
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
                                                                        <td>
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
                                                                                $logout_time = str_replace('-', ':', $row2['logout_time']);
                                                                                $logout_time = date('g:i A' ,strtotime($logout_time));
                                                                                echo $logout_time;
                                                                            ?>
                                                                        </td>
                                                                        <!-- total hours -->
                                                                        <td>7.45</td>
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
<!--                             <section class="main-dash-board-work-input-time-sheet-custom">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Start Time</th>
                                            <th scope="col">End Time</th>
                                            <th scope="col">Project Id</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Issue No</th>
                                            <th scope="col">Comment</th>
                                            <th scope="col">Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="addRow">
                                            <form>
                                                <th scope="row">
                                                    <select class="form-control">
                                                        <option>12.00 am</option>
                                                        <option>12.30am</option>
                                                        <option>1am</option>
                                                        <option>1.30am</option>
                                                        <option>2am</option>
                                                        <option>2.30am</option>
                                                        <option>3am</option>
                                                        <option>3.30am</option>
                                                        <option>4am</option>
                                                        <option>4.30am</option>
                                                        <option>5am</option>
                                                        <option>5.50am</option>
                                                        <option>6am</option>
                                                        <option>6.30am</option>
                                                        <option>7am</option>
                                                        <option>7.30am</option>
                                                        <option>8am</option>
                                                        <option>8.30am</option>
                                                        <option>9am</option>
                                                        <option>9.30am</option>
                                                        <option>10am</option>
                                                        <option>10.30am</option>
                                                        <option>11am</option>
                                                        <option>11.30am</option>
                                                        <option>12pm</option>
                                                        <option>12.30pm</option>
                                                        <option>1pm</option>
                                                        <option>1.30pm</option>
                                                        <option>2pm</option>
                                                        <option>2.30pm</option>
                                                        <option>3pm</option>
                                                        <option>3.30pm</option>
                                                        <option>4pm</option>
                                                        <option>4.30pm</option>
                                                        <option>5pm</option>
                                                        <option>5.30pm</option>
                                                        <option>6pm</option>
                                                        <option>6.30pm</option>
                                                        <option>7pm</option>
                                                        <option>7.30pm</option>
                                                        <option>8pm</option>
                                                        <option>8.30pm</option>
                                                        <option>9pm</option>
                                                        <option>9.30pm</option>
                                                        <option>10pm</option>
                                                        <option>10.30pm</option>
                                                        <option>11pm</option>
                                                        <option>11.30pm</option>
                                                    </select>
                                                </th>
                                                <td>
                                                    <select class="form-control">
                                                        <option>12.00 am</option>
                                                        <option>12.30am</option>
                                                        <option>1am</option>
                                                        <option>1.30am</option>
                                                        <option>2am</option>
                                                        <option>2.30am</option>
                                                        <option>3am</option>
                                                        <option>3.30am</option>
                                                        <option>4am</option>
                                                        <option>4.30am</option>
                                                        <option>5am</option>
                                                        <option>5.50am</option>
                                                        <option>6am</option>
                                                        <option>6.30am</option>
                                                        <option>7am</option>
                                                        <option>7.30am</option>
                                                        <option>8am</option>
                                                        <option>8.30am</option>
                                                        <option>9am</option>
                                                        <option>9.30am</option>
                                                        <option>10am</option>
                                                        <option>10.30am</option>
                                                        <option>11am</option>
                                                        <option>11.30am</option>
                                                        <option>12pm</option>
                                                        <option>12.30pm</option>
                                                        <option>1pm</option>
                                                        <option>1.30pm</option>
                                                        <option>2pm</option>
                                                        <option>2.30pm</option>
                                                        <option>3pm</option>
                                                        <option>3.30pm</option>
                                                        <option>4pm</option>
                                                        <option>4.30pm</option>
                                                        <option>5pm</option>
                                                        <option>5.30pm</option>
                                                        <option>6pm</option>
                                                        <option>6.30pm</option>
                                                        <option>7pm</option>
                                                        <option>7.30pm</option>
                                                        <option>8pm</option>
                                                        <option>8.30pm</option>
                                                        <option>9pm</option>
                                                        <option>9.30pm</option>
                                                        <option>10pm</option>
                                                        <option>10.30pm</option>
                                                        <option>11pm</option>
                                                        <option>11.30pm</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control">
                                                        <option>#123456</option>
                                                        <option>#123457</option>
                                                        <option>#123458</option>
                                                        <option>#123459</option>
                                                        <option>#123450</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" id="exampleFormControlSelect1">
                                                        <option>Type A</option>
                                                        <option>Type B</option>
                                                        <option>Type C</option>
                                                        <option>Type D</option>
                                                        <option>Type E</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control">
                                                        <option>Issue No. 1</option>
                                                        <option>Issue No. 2</option>
                                                        <option>Issue No. 3</option>
                                                        <option>Issue No. 4</option>
                                                        <option>Issue No. 5</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control">

                                                    <span class="addBtn">
                                                        <i class="fa fa-plus"></i>
                                                    </span>
                                                </td>



                                            </form>

                                        </tr>

                                    </tbody>
                                </table>
                            </section> -->
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