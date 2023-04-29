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
                                    <li>Leaves</li>
                                </ul>
                                <?php if($_SESSION['emp_type'] == 'employee' || $_SESSION['emp_type'] == '' ) { ?>
                                <a class="add-employee-btn" href="leave_form.php">
                                    <span class="add-icon">+</span> Add Leave
                                </a>
                                <?php } ?>
                            </section>

                            <section class="custom-salary-table custom-leave-table">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                                $sql_leave_view = "SELECT * FROM `capms_admin_individual_leaves` WHERE `user_id` = '".$_REQUEST['user_id']."' ORDER BY STR_TO_DATE(`leave_date`, '%d-%m-%Y')";
                                                $result_leave_view = mysqli_query($con,$sql_leave_view);
                                                ?>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">approved</th>
                                                            <th scope="col">leave_id</th>
                                                            <th scope="col">user_id</th>
                                                            <th scope="col">reason</th>
                                                            <th scope="col">type_of_leave</th>
                                                            <th scope="col">leave_date</th>
                                                            <th scope="col">leave_status</th>
                                                            <th scope="col">Paid or Unpaid</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                <?php
                                                $i = 1;
                                                $j = 0;
                                                static $month='';
                                                if($result_leave_view->num_rows > 0) {
                                                    while($row_leave_view = mysqli_fetch_assoc($result_leave_view)) {
                                                        $leave_date = explode('-',$row_leave_view['leave_date']);
                                                        if($month!= $leave_date[1]){
                                                            $j=0;
                                                        }
                                                        if($row_leave_view['leave_status']=='Aproved'){
                                                            if($row_leave_view['type_of_leave']=='Full Day') {
                                                                $j++;
                                                            }
                                                            else {
                                                                $j = $j+0.5;
                                                            }
                                                        }
                                                        ?>
                                                        <tr>
                                                            <th scope="row"><?php echo $i++;?></th>
                                                            <td><?php echo $j;?></td>
                                                            <td><?php echo $row_leave_view['leave_id'];?></td>
                                                            <td><?php echo $row_leave_view['user_id'];?></td>
                                                            <td><?php echo $row_leave_view['reason_of_leave'];?></td>
                                                            <td><?php echo $row_leave_view['type_of_leave'];?></td>
                                                            <!-- <td><?php //echo $row_leave_view['leave_status'];?></td> -->
                                                            <td><?php echo $row_leave_view['leave_date'];?></td>
                                                            <form action="leave_status_change.php?id=<?php echo $row_leave_view['id']?>&user_id=<?php echo $_REQUEST['user_id']; ?>" method="POST">
                                                            <td>
                                                                <div class="form-group">
                                                                    <?php
                                                                    if ($row_leave_view['leave_status'] == 'Rejected')
                                                                        $disabled = 'disabled';
                                                                    else
                                                                        $disabled = '';
                                                                    ?>
                                                                    <select class="form-control" id="status" name="leave_status" <?php echo $disabled; ?>>
                                                                        <option value="Pending" <?php if($row_leave_view['leave_status'] == "Pending") { echo 'selected'; } ?>>Pending</option>
                                                                        <option value="Aproved" <?php if($row_leave_view['leave_status'] == "Aproved") { echo 'selected'; } ?>>Aproved</option>
                                                                        <option value="Rejected" <?php if($row_leave_view['leave_status'] == "Rejected") { echo 'selected'; } ?>>Rejected</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <?php 
                                                                        $leave_date = explode('-',$row_leave_view['leave_date']);
                                                                        $year = $leave_date[2];
                                                                        $full_leaves_year = "SELECT COUNT(id) AS Remaining_full FROM `capms_admin_individual_leaves` WHERE user_id ='".$_REQUEST['user_id']."' AND leave_status = 'Aproved' AND type_of_leave ='Full Day' AND paid_unpaid_status = 'Paid' AND leave_date LIKE '%-".$year."'";
                                                                        $result_full_leaves_year = mysqli_query($con,$full_leaves_year);
                                                                        $total_full_leaves_year = mysqli_fetch_assoc($result_full_leaves_year);
                                                                        $full_leaves_half_paid_year = "SELECT COUNT(id) AS Remaining_full_half_paid FROM `capms_admin_individual_leaves` WHERE user_id ='".$_REQUEST['user_id']."' AND leave_status = 'Aproved' AND paid_unpaid_status = 'Half-Paid' AND type_of_leave ='Full Day' AND leave_date LIKE '%-".$year."'";
                                                                        $result_full_leaves_half_paid_year = mysqli_query($con,$full_leaves_half_paid_year);
                                                                        $total_full_leaves_half_paid_year = mysqli_fetch_assoc($result_full_leaves_half_paid_year);
                                                                        $half_leaves_year = "SELECT COUNT(id) AS Remaining_half FROM `capms_admin_individual_leaves` WHERE user_id ='".$_REQUEST['user_id']."' AND leave_status = 'Aproved' AND (type_of_leave ='Second Half' OR type_of_leave='First Half') AND paid_unpaid_status = 'Paid' AND leave_date LIKE '%-".$year."'";
                                                                        $result_half_leaves_year = mysqli_query($con,$half_leaves_year);
                                                                        $total_half_leaves_year = mysqli_fetch_assoc($result_half_leaves_year);
                                                                        $total_leaves_year = $total_full_leaves_year['Remaining_full'] + ($total_full_leaves_half_paid_year['Remaining_full_half_paid']/2) + ($total_half_leaves_year['Remaining_half']/2);
                                                                        if ($total_leaves_year>18) {
                                                                            $disabled = 'disabled';
                                                                            // $sql_leave_current_year= "SELECT * FROM `capms_admin_individual_leaves` WHERE user_id ='".$_REQUEST['user_id']."' AND leave_date LIKE '%-".$year."'";
                                                                            // $result_leave_current_year = mysqli_query($con,$sql_leave_current_year);
                                                                            // if($result_leave_current_year->num_rows >0){
                                                                            //     while($row_leave_current_year = mysqli_fetch_assoc($result_leave_current_year)){
                                                                                    ?>
                                                                                    <select class="form-control" id="paid_unpaid" name="paid_unpaid_status">
                                                                                        <option value="Paid" <?php if($row_leave_view['paid_unpaid_status'] == "Paid") { echo 'selected'; } ?> <?php echo $disabled; ?>>Paid</option>
                                                                                        <option value="Half-Paid" <?php if($row_leave_view['paid_unpaid_status'] == "Half-Paid") { echo 'selected'; } ?> <?php echo $disabled; ?>>Half-Paid</option>
                                                                                        <option value="Unpaid" <?php if($row_leave_view['paid_unpaid_status'] == "Unpaid") { echo 'selected'; } ?>>Unpaid</option>
                                                                                    </select>
                                                                                    <?php
                                                                            //     }
                                                                            // }
                                                                        } 
                                                                        else
                                                                        {
                                                                            
                                                                            
                                                                            $month = $leave_date[1];
                                                                            // print_r($leave_date);
                                                                            $full_leaves_month = "SELECT COUNT(id) AS Remaining_full FROM `capms_admin_individual_leaves` WHERE user_id ='".$_REQUEST['user_id']."' AND leave_status = 'Aproved' AND type_of_leave ='Full Day' AND leave_date LIKE '%-".$month."-%'";
                                                                            $result_full_leaves_month = mysqli_query($con,$full_leaves_month);
                                                                            $total_full_leaves_month = mysqli_fetch_assoc($result_full_leaves_month);
                                                                            $half_leaves_month = "SELECT COUNT(id) AS Remaining_half FROM `capms_admin_individual_leaves` WHERE user_id ='".$_REQUEST['user_id']."' AND leave_status = 'Aproved' AND (type_of_leave ='Second Half' OR type_of_leave='First Half') AND leave_date LIKE '%-".$month."-%'";
                                                                            $result_half_leaves_month = mysqli_query($con,$half_leaves_month);
                                                                            $total_half_leaves_month = mysqli_fetch_assoc($result_half_leaves_month);
                                                                            $total_leaves_month = $total_full_leaves_month['Remaining_full'] + ($total_half_leaves_month['Remaining_half']/2);
                                                                            // if($total_leaves_month<1.5){
                                                                            //     $disabled = 'disabled';
                                                                            //     // echo $total_leaves_month;
                                                                            // }
                                                                            // else{
                                                                            //     $disabled = '';
                                                                            // }
                                                                            $hidden = 'hidden';
                                                                            // if($total_leaves_month && fmod($j,$total_leaves_month==0)) $j = 0;
                                                                            // if($month)
                                                                    ?>
                                                                    <select class="form-control" id="paid_unpaid" name="paid_unpaid_status">
                                                                        <option value="Paid" <?php if($row_leave_view['paid_unpaid_status'] == "Paid" || ($row_leave_view['paid_unpaid_status']=='' && ($j<1 || $total_leaves_month==0 || $j>=1.5)) || ($row_leave_view['type_of_leave']=='First Half' || $row_leave_view['type_of_leave']=='Second Half')) { echo 'selected'; } else echo 'disabled'; ?>>Paid</option>
                                                                        <option value="Half-Paid" <?php if($row_leave_view['paid_unpaid_status'] == "Half-Paid" || ($row_leave_view['paid_unpaid_status']=='' && ($j>1 && $j<=2)) && $row_leave_view['type_of_leave']=='Full Day') { echo 'selected'; }?><?php if($j>=1.5 || $j<1 || $row_leave_view['type_of_leave']!='Full Day') echo 'disabled'; ?>>Half-Paid</option>
                                                                        <option value="Unpaid"  <?php if($j<=1.5) { echo 'disabled'; } ?> <?php if($row_leave_view['paid_unpaid_status'] == "Unpaid" || ($row_leave_view['paid_unpaid_status']=='' && $j>2)) { echo 'selected'; } ?>>Unpaid</option>
                                                                    </select>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </td>
                                                            <td><button type="submit" class="btn btn-outline-primary">change</button></td>
                                                            <td>
                                                                <!-- test-start -->
                                                                <?php   
                                                                    $total_leaves_month = $total_leaves_month==''?0:$total_leaves_month;
                                                                    echo "For month : ";
                                                                    // print_r($leave_date);
                                                                    echo " Total Leave Taken Month (Prevously approved) : ";
                                                                    echo $total_leaves_month;  
                                                                ?>
                                                                <!-- test-end -->
                                                            </td>
                                                            </form>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                    </tbody>
                                                </table>
                                                
                                                <?php 
                                                    $year = date("Y");
                                                    $full_leaves = "SELECT COUNT(id) AS Remaining_full FROM `capms_admin_individual_leaves` WHERE user_id ='".$_REQUEST['user_id']."' AND leave_status = 'Aproved' AND paid_unpaid_status = 'Paid' AND type_of_leave ='Full Day' AND leave_date LIKE '%-".$year."'";
                                                    $result_full_leaves = mysqli_query($con,$full_leaves);
                                                    $total_full_leaves = mysqli_fetch_assoc($result_full_leaves);
                                                    $full_leaves_half_paid = "SELECT COUNT(id) AS Remaining_full_half_paid FROM `capms_admin_individual_leaves` WHERE user_id ='".$_REQUEST['user_id']."' AND leave_status = 'Aproved' AND paid_unpaid_status = 'Half-Paid' AND type_of_leave ='Full Day' AND leave_date LIKE '%-".$year."'";
                                                    $result_full_leaves_half_paid = mysqli_query($con,$full_leaves_half_paid);
                                                    $total_full_leaves_half_paid = mysqli_fetch_assoc($result_full_leaves_half_paid);
                                                    $half_leaves = "SELECT COUNT(id) AS Remaining_half FROM `capms_admin_individual_leaves` WHERE user_id ='".$_REQUEST['user_id']."' AND leave_status = 'Aproved' AND paid_unpaid_status = 'Paid' AND (type_of_leave ='Second Half' OR type_of_leave='First Half') AND leave_date LIKE '%-".$year."'";
                                                    $result_half_leaves = mysqli_query($con,$half_leaves);
                                                    $total_half_leaves = mysqli_fetch_assoc($result_half_leaves);
                                                    $total_leaves = $total_full_leaves['Remaining_full'] + ($total_full_leaves_half_paid['Remaining_full_half_paid']/2) + ($total_half_leaves['Remaining_half']/2);
                                                ?>
                                                <p class="text-danger">Remaining PLs: <?php if(18-$total_leaves>0){
                                                    echo 18-$total_leaves;
                                                } 
                                                else{
                                                    echo "No Remaining PLs.Non paid leaves: ".abs(18-$total_leaves);
                                                }
                                                ?></p>
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
            <?php include 'copyright_content.php'; ?>
        </footer>
        <!-- Footer JS files -->
    </body>
</html>