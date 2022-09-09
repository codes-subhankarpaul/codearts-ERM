<!doctype html>
<html lang="en">

    <head>
        <!-- Header CSS files -->
        <?php include 'header_css.php'; ?>
        <title>Projects - CERM :: Codearts Employee Relationship Management</title>
    </head>
    <?php
            if($_SESSION['emp_id'] == '')
            {
            echo "<script>location.href='http://localhost/codearts/login.php';</script>";
            }
            ?>

            <?php 

            $sql = "SELECT * FROM capms_admin_users";
            $result = $con->query($sql);
            $names = '[';

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            $names.='"'.$row["user_fullname"].'"'.",";
            }
            } else {

            }
            $names.="]";
            //$con->close();
    ?>

    <body>

        <style>
            table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
            }
        </style>
        
        <header class="custom-header">
            <!-- Dashboard Top Info Panel -->
            <?php 
            include 'info_panel.php';
            //include('database.php');
            ?>
        </header>

        <main class="custom-dahboard-main">
            <div class="custom-page-wrap-dp">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <?php include 'dashboard.php'; ?>
                        </div>
                        <div class="col-lg-9">
                            <section class="inner-head-brd">
                                <h2>View Task</h2>
                                <ul>
                                <li><a href="#">Home</a></li>
                                <li>View Task</li>
                                </ul>
                                <a class="add-employee-btn" href="create_project_task.php?project_id=<?php echo $_GET['project_id'] ?>"><span class="add-icon">+</span> Create Task</a>
                            </section>

                            <section class="custom-salary-table custom-leave-table">
                                <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                    <table class="table table-striped leave-table">
                                        <thead>
                                        <tr>
                                            <th scope="col">user id</th>
                                            <th scope="col">task id</th>
                                            <th scope="col">task name</th>
                                            <th scope="col">priority</th>
                                            <th scope="col">start date</th>
                                            <th scope="col">end date</th>
                                            <th scope="col">task domain</th>
                                            <th scope="col">task type</th>
                                            <th scope="col">trello task id</th>
                                            <th scope="col">trello task link</th>
                                            <th scope="col">description</th>
                                            <th scope="col">edit</th>
                                            <th scope="col">delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $query = "SELECT * FROM `capms_project_task_info` join `capms_user_workload_info` on capms_project_task_info.task_id = capms_user_workload_info.task_id WHERE `project_id` = '".$_REQUEST['project_id']."'";
                                            $result = mysqli_query($con, $query);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {

                                                    // find task_domain name by task_domain id
                                                    $task_domain_name_sql = "SELECT * FROM `capms_department_info` WHERE `dept_id` = '". $row['task_domain'] . "'";

                                                    $result_task_domain_name = mysqli_query($con, $task_domain_name_sql);

                                                    while ($row_task_domain_name = mysqli_fetch_array($result_task_domain_name)) {
                                                        $task_domain = $row_task_domain_name['dept_name'];
                                                    }

                                                    // find task_domain name by task_domain id
                                                    $task_type_name_sql = "SELECT * FROM `capms_project_tasktype_info` WHERE `task_type_id` = '". $row['task_type'] . "'";

                                                    $result_task_type_name = mysqli_query($con, $task_type_name_sql);

                                                    while ($row_task_type_name = mysqli_fetch_array($result_task_type_name)) {
                                                        $task_type = $row_task_type_name['task_type_name'];
                                                    }
                                        ?>
                                        <tr>
                                            <td><?php echo $row['user_id']?></td>
                                            <td><?php echo $row['task_id']?></td>
                                            <td scope="row">
                                            <h5><?php echo $row['task_name']?></h5>
                                            </td>
                                            <td><a class="leave-status-btn pending-btn" href="#"><?php echo $row['priority']?></a></td>
                                            <td><?php echo $row['task_start_date']?></td>
                                            <td><?php echo $row['task_end_date']?></td>
                                            <td>
                                            <h4><?php echo $task_domain?></h4>
                                            </td>
                                            <td><span class="salary-amt"><?php echo $task_type?></span></td>
                                            <td><?php echo $row['trello_task_id']?></td>
                                            <td>
                                            <!-- <div class="dropdown project-thumb-toggle">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                    class="fas fa-ellipsis-v"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item"
                                                    href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a
                                                    class="dropdown-item" href="#">Something else here</a> </div>
                                            </div> -->
                                            <a href="#"><?php echo $row['trello_task_link']?></a>
                                            </td>
                                            <td><?php echo $row['task_desc']?></td>
                                            <?php
                                            session_start();
                                            if ($_SESSION['emp_type'] != "hr" || $_SESSION['emp_type'] != "admin") { 
                                            }
                                            else{
                                            ?>
                                            <td><a href="edit_project_task.php?task_id=<?php echo $row['task_id']?>&project_id=<?php echo $_REQUEST['project_id']?>"><?php echo "edit"?></a></td>
                                            <td><a href="delete_project_task.php?task_id=<?php echo $row['task_id']?>&project_id=<?php echo $_REQUEST['project_id']?>"><?php echo "delete"?></a></td>
                                            <?php } ?>
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
    </body>
</html>