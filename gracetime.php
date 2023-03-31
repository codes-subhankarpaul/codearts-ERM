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

            if(isset($_SESSION['gracetime_delete_msg'])) {
                echo "<script>alert(".$_SESSION['gracetime_delete_msg'].");</script>";
            }
        ?>
        <title>Gracetime - CERM :: Codearts Employee Relationship Management</title>
    </head>

    <body>
        <style>
            table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            display: block;
            overflow-x: auto;
            white-space: nowrap;
            }

            td, th {
            border: 1px solid #dddddd;
            text-align: left;
            }

            tr:nth-child(even) {
            background-color: #dddddd;
            }
        </style>
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

                        <?php if($_SESSION['emp_type'] == 'hr' || $_SESSION['emp_type'] == 'admin' ||$_SESSION['emp_type'] == 'project_lead' ) { ?>
                            <section class="inner-head-brd">
                                <h2>Gracetime</h2>
                                <ul>
                                    <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                    <li>Gracetime</li>
                                </ul>
                            </section>
                        <?php } else {?>
                            <section class="inner-head-brd">
                                <h2>Gracetime</h2>
                                <ul>
                                    <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                    <li>Gracetime</li>
                                </ul>
                                <?php
                                    // check if there are two gracetimes disable 'apply gracetime' - 1. fetching
                                    $sql_gracetime_count = "SELECT COUNT(`id`) AS gracetime_no FROM capms_gracetime_info where (`status`=1 or `status`=0) and user_id='".$_SESSION['emp_id']."';";
                                    $result_gracetime_count = mysqli_query($con,$sql_gracetime_count);
                                    if($result_gracetime_count->num_rows>0) {
                                        while($row_gracetime_count = mysqli_fetch_assoc($result_gracetime_count)) {
                                            $gracetime_count = $row_gracetime_count['gracetime_no'];
                                        }
                                    }
                                ?>
                                <?php
                                    // check if there are two gracetimes disable 'apply gracetime' - 2. checking
                                    if($gracetime_count<2) {
                                ?>
                                <a class="add-employee-btn" href="gracetime_apply.php">
                                    <span class="add-icon">+</span> Apply Gracetime
                                </a>
                                <?php 
                                    }
                                ?>
                            </section>
                        <?php }?>

                            <?php if($_SESSION['emp_type'] == 'hr' || $_SESSION['emp_type'] == 'admin' ||$_SESSION['emp_type'] == 'project_lead') { ?>
                                <section class="custom-salary-table custom-leave-table">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <section class="noticeList">
                                                    <table class="table-light">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>User_ID</th>
                                                            <th>User_Name</th>
                                                            <th>Date</th>
                                                            <th>Time_Taken</th>
                                                            <th>Reason</th>
                                                            <th>Feedback</th>
                                                            <th colspan="2">Action</th>
                                                        </tr>
                                                        <?php
                                                            $query_gracetime = "SELECT * FROM `capms_gracetime_info` WHERE status=0 ORDER BY `updated_at` DESC";
                                                            $result_gracetime = mysqli_query($con, $query_gracetime);
                                                            $id = 1;
                                                            if($result_gracetime->num_rows > 0){
                                                                echo "<span class='btn btn-danger'>GRACETIME PENDING APPLICATION</span>";
                                                                while($row_gracetime = mysqli_fetch_assoc($result_gracetime)){
                                                                    $query_user = "SELECT * FROM `capms_admin_users` WHERE id = '".$row_gracetime['user_id']."'";
                                                                    $result_user = mysqli_query($con, $query_user);
                                                                    if($result_user->num_rows > 0){
                                                                        while($row_user = mysqli_fetch_assoc($result_user)){

                                                                         
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $id++; ?></td>
                                                            <td><?php echo $row_gracetime['user_id']; ?></td>
                                                            <td><?php echo $row_user['user_fullname'] ?></td>
                                                            <td><?php echo $row_gracetime['gracetime_date']; ?></td>
                                                            <td><?php echo $row_gracetime['gracetime_taken']; ?></td>
                                                            <td><?php echo $row_gracetime['reason']; ?></td>
                                                            <td><?php echo $row_gracetime['feedback']; ?></td>
                                                            <form action="gracetime_status_change.php?gracetime_id=<?php echo $row_gracetime['id']?>" method="POST">
                                                            <td>
                                                                <div class="form-group">
                                                                    <label for="status">status</label>
                                                                    <select class="form-control" id="status" name="status">
                                                                        <option value="0" <?php if($row_gracetime['status'] == "0") { echo 'selected'; } ?>>Pending</option>
                                                                        <option value="1" <?php if($row_gracetime['status'] == "1") { echo 'selected'; } ?>>Aproved</option>
                                                                        <option value="2" <?php if($row_gracetime['status'] == "2") { echo 'selected'; } ?>>Rejected</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td><button type="submit" class="btn btn-outline-primary">change</button></td>
                                                            </form>
                                                        </tr>
                                                        <?php
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            else {
                                                                // echo "<span class='btn btn-success'>NO GRACETIME PENDING APPLICATION</span>";
                                                            }
                                                        ?>
                                                        <?php
                                                            $query_gracetime = "SELECT * FROM `capms_gracetime_info` WHERE status!=0 ORDER BY `updated_at` DESC";
                                                            $result_gracetime = mysqli_query($con, $query_gracetime);
                                                            $id = 1;
                                                            if($result_gracetime->num_rows > 0) {
                                                                // echo "<span class='btn btn-danger'>GRACETIME PENDING APPLICATION</span>";
                                                                while($row_gracetime = mysqli_fetch_assoc($result_gracetime)) {
                                                                    $query_user = "SELECT * FROM `capms_admin_users` WHERE id = '".$row_gracetime['user_id']."'";
                                                                    $result_user = mysqli_query($con, $query_user);
                                                                    if($result_user->num_rows > 0) {
                                                                        while($row_user = mysqli_fetch_assoc($result_user)) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $id++; ?></td>
                                                            <td><?php echo $row_gracetime['user_id']; ?></td>
                                                            <td><?php echo $row_user['user_fullname'] ?></td>
                                                            <td><?php echo $row_gracetime['gracetime_date']; ?></td>
                                                            <td><?php echo $row_gracetime['gracetime_taken']; ?></td>
                                                            <td><?php echo $row_gracetime['reason']; ?></td>
                                                            <td><?php echo $row_gracetime['feedback']; ?></td>
                                                            <form action="gracetime_status_change.php?gracetime_id=<?php echo $row_gracetime['id']?>" method="POST">
                                                            <td>
                                                                <div class="form-group">
                                                                    <label for="status">status</label>
                                                                    <select class="form-control" id="status" name="status">
                                                                        <option value="0" <?php if($row_gracetime['status'] == "0") { echo 'selected'; } ?>>Pending</option>
                                                                        <option value="1" <?php if($row_gracetime['status'] == "1") { echo 'selected'; } ?>>Aproved</option>
                                                                        <option value="2" <?php if($row_gracetime['status'] == "2") { echo 'selected'; } ?>>Rejected</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td><button type="submit" class="btn btn-outline-primary">change</button></td>
                                                            </form>
                                                        </tr>
                                                        <?php
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </table>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            <?php } else if($_SESSION['emp_type'] == 'employee' || $_SESSION['emp_type'] == '') { ?>
                                <section class="custom-salary-table custom-leave-table">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <section class="noticeList">
                                                    <table class="table-light">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Date</th>
                                                            <th>Time_Taken</th>
                                                            <th>Reason</th>
                                                            <th>Feedback</th>
                                                            <th>Status</th>
                                                            <th colspan="2">Action</th>
                                                        </tr>
                                                        <?php
                                                            $query_gracetime = "SELECT * FROM `capms_gracetime_info` WHERE `user_id` = '".$_SESSION['emp_id']."' ";
                                                            $result_gracetime = mysqli_query($con, $query_gracetime);
                                                            $id = 1;
                                                            if($result_gracetime->num_rows > 0){
                                                                while($row_gracetime = mysqli_fetch_assoc($result_gracetime)){
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $id++; ?></td>
                                                            <td><?php echo $row_gracetime['gracetime_date']; ?></td>
                                                            <td><?php echo $row_gracetime['gracetime_taken']; ?></td>
                                                            <td><?php echo $row_gracetime['reason']; ?></td>
                                                            <td><?php echo $row_gracetime['feedback']; ?></td>
                                                            <td>
                                                                <?php 
                                                                    if($row_gracetime['status'] == "0") { 
                                                                        echo 'Pending'; 
                                                                    }
                                                                    else if($row_gracetime['status'] == "1") { 
                                                                        echo 'Approved'; 
                                                                    }
                                                                    else if($row_gracetime['status'] == "2") { 
                                                                        echo 'Rejected'; 
                                                                    }
                                                                    else {
                                                                        echo 'Unknown';
                                                                    }
                                                                ?>
                                                            </td>
                                                            <?php
                                                                if($row_gracetime['status']!='1') {
                                                            ?>
                                                            <form action="gracetime_delete.php?gracetime_id=<?php echo $row_gracetime['id']?>" method="POST">
                                                            <td><button type="submit" class="btn btn-outline-primary">delete</button></td>
                                                            </form>
                                                            <?php
                                                                }
                                                                else {
                                                                    echo '<td class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                                                    <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                                                                  </svg></td>';
                                                                }
                                                            ?>
                                                        </tr>
                                                        <?php
                                                                }
                                                            }
                                                            else {
                                                                echo "<span class='btn btn-danger'>NO GRACETIME APPLICATION</span>";
                                                            }
                                                        ?>
                                                    </table>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            <?php } ?>
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