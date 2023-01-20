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
                                                $sql_leave_view = "SELECT * FROM `capms_admin_individual_leaves` WHERE `user_id` = '".$_REQUEST['user_id']."'";
                                                $result_leave_view = mysqli_query($con,$sql_leave_view);
                                                ?>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">leave_id</th>
                                                            <th scope="col">user_id</th>
                                                            <th scope="col">reason_of_leave</th>
                                                            <th scope="col">type_of_leave</th>
                                                            <th scope="col">leave_status</th>
                                                            <th scope="col">leave_date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                <?php
                                                $i = 1;
                                                if($result_leave_view->num_rows > 0) {
                                                    while($row_leave_view = mysqli_fetch_assoc($result_leave_view)) {
                                                        ?>
                                                        <tr>
                                                            <th scope="row"><?php echo $i++;?></th>
                                                            <td><?php echo $row_leave_view['leave_id'];?></td>
                                                            <td><?php echo $row_leave_view['user_id'];?></td>
                                                            <td><?php echo $row_leave_view['reason_of_leave'];?></td>
                                                            <td><?php echo $row_leave_view['type_of_leave'];?></td>
                                                            <td><?php echo $row_leave_view['leave_status'];?></td>
                                                            <td><?php echo $row_leave_view['leave_date'];?></td>
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