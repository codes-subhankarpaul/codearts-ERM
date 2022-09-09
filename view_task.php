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
                                <?php
                                    if($_SESSION['emp_type'] == "admin") {
                                ?>
                                    <a class="add-employee-btn" href="create_project_task.php?project_id=<?php echo $_GET['project_id'] ?>"><span class="add-icon">+</span> Create Task</a>
                                <?php
                                    }
                                ?>
                            </section>

                            <section id="filter_task" class="py-5">
                                <div class="row">
                                    <div class="col">
                                    <label for="filter_task_dropdown" class="form-label text-danger">* filter task by department</label>
                                    <form action="" method="post">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <select class="form-control" id="filter_task_dropdown" name="filter_task_select">
                                                <option value="">select department</option>
                                                <option value="all">all departments</option>
                                                <?php
                                                $sql1 = "SELECT * FROM `capms_department_info`";
                                                // $sql2 = "";
                                                $result = mysqli_query($con, $sql1);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $selected = "";
                                                    if ($row['dept_id'] == $task_domain) {
                                                        $selected = 'selected';
                                                    }
                                                    echo '<option value="' . $row['dept_id'] . '" ' . $selected . '>' . $row["dept_name"] . '</option>';
                                                }
                                                ?>
                                                </select>  
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <button type="submit" id="fillter_task_button" class="btn btn-primary" disabled>filter task</button>
                                            </div>
                                        </div>
                                    </form> 
                                    </div>
                                </div>
                            </section>

                            <section class="employee-profiles">
                                <div class="row">
                                    <?php 
                                        if(isset($_POST['filter_task_select']) && $_POST['filter_task_select']!='all') {
                                            $query = "SELECT DISTINCT capms_project_task_info.`task_id` FROM `capms_user_workload_info` inner join `capms_project_task_info` on capms_user_workload_info.task_id = capms_project_task_info.task_id inner join capms_department_info on capms_project_task_info.task_domain = `capms_department_info`.dept_id WHERE `project_id` = '".$_REQUEST['project_id']."' AND capms_project_task_info.`task_domain` = '".$_POST['filter_task_select']."'";
                                        }
                                        else {
                                            $query = "SELECT DISTINCT `task_id` FROM `capms_user_workload_info` WHERE `project_id` = '".$_REQUEST['project_id']."'";
                                        }
                                        $result1 = mysqli_query($con, $query);
                                        if($result1->num_rows > 0)
                                        {
                                            while($row1 = mysqli_fetch_assoc($result1)) {
                                                $task_name_sql = "SELECT `task_name`,`task_number`,`task_status`,`task_start_date`,`task_end_date` FROM `capms_project_task_info` WHERE `task_id` = '".$row1['task_id']."'";
                                                $result2 = mysqli_query($con, $task_name_sql);
                                                while($row2 = mysqli_fetch_assoc($result2)) {
                                    ?>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="employee-profiles-thubmnail">
                                                            <div class="employee-content">
                                                                <a href="edit_project_task.php?project_id=<?php echo $_REQUEST['project_id']; ?>&task_id=<?php echo $row1['task_id']?>"><?php echo $row2['task_name']; ?> (<?php echo $row2['task_number'];?>)</a>
                                                                <h6>status : <?php echo $row2['task_status']; ?></h6>
                                                                <h6>task_id : <?php echo $row1['task_id']; ?></h6>
                                                                <h6>duration : <?php echo $row2['task_start_date']."  to  ".$row2['task_end_date']; ?></h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>

    <script>
    $(document).ready(function() {
        $('#filter_task_dropdown').on('change', function () {
            var selectVal = this.value;
            if(selectVal!='') {
                $('#fillter_task_button').prop('disabled', false);
            }
            else {
                $('#fillter_task_button').prop('disabled', true);
            }
        });
    });
    </script>
</html>






<hr>