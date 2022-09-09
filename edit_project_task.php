<!doctype html>
<html lang="en">

<head>
    <!-- Header CSS files -->
    <?php include 'header_css.php'; ?>
    <?php
    if ($_SESSION['emp_id'] == '') {
        echo "<script>location.href='" . $baseURL . "login.php';</script>";
    }
    ?>

    <?php

    $sql = "SELECT * FROM capms_admin_users";
    $result = $con->query($sql);
    $names = '[';

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $names .= '"' . $row["user_fullname"] . '"' . ",";
        }
    } 
    else {
    }
    $names .= "]";
    //$con->close();

    ?>
    <title>Edit Task - CERM :: Codearts Employee Relationship Management</title>
</head>

<body>
    <header class="custom-header">
        <!-- Dashboard Top Info Panel -->
        <?php include 'info_panel.php'; ?>
    </header>

    <?php 
        $project_name_sql = "SELECT * FROM `capms_project_info` WHERE `project_id` = '".$_REQUEST['project_id']."'";
        $result_project_name = mysqli_query($con, $project_name_sql);
        if (mysqli_num_rows($result_project_name) > 0) {
            while ($row_project_name = mysqli_fetch_assoc($result_project_name)) {
                $project_name = $row_project_name['title'];
                $project_number = $row_project_name['project_number'];
            }
        }
    ?>

    <main class="custom-dahboard-main">
        <div class="custom-page-wrap-dp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <?php include 'dashboard.php'; ?>
                    </div>
                    <div class="col-lg-9">
                        <section class="inner-head-brd">
                            <h2 id="project_heading">Project - <?php echo $project_name;?> (<?php if($project_number == '') echo "NULL Project Number"; else echo $project_number;?>)</h2>
                            <ul>
                                <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                <li>Projects</li>
                            </ul>

                        </section>

                        <section class="custom-projects">
                            <form method="POST" enctype="multipart/form-data">
                                <h4>Edit Task</h4>
                                <div class="form-row">

                                    <div class="form-group col-md-12">
                                        <div class="multi-field-wrapper">
                                            <div class="multi-fields dp-custom-multifields">
                                                <div class="multi-field">
                                                    <div class="form-row">
                                                    <?php
                                                        $query = "SELECT * FROM `capms_project_task_info` WHERE `task_id` = '" . $_REQUEST['task_id'] . "'";
                                                        $result = mysqli_query($con, $query);
                                                        if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                        <div class="col-md-6">
                                                            <label>Task Name</label>
                                                            <input type="text" class="form-control" placeholder=" Task Name" name="task_name" value="<?php echo $row['task_name']?>">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Task Number</label>
                                                            <input type="text" class="form-control" placeholder=" Task Number" name="task_number" value="<?php echo $row['task_number']?>" disabled>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Priority</label>
                                                            <select class="form-control" id="priority" name="task_priority" value="<?php echo $row['priority']?>">
                                                                <option value="4">Top</option>
                                                                <option value="3">High</option>
                                                                <option value="2">Medium</option>
                                                                <option value="1">Low</option>
                                                                <option value="0">None</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Start Date</label>
                                                            <input type="text" class="form-control" id="start_date" name="start_date" value="<?php echo $row['task_start_date']?>" autocomplete="off">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>End Date</label>
                                                            <input type="text" class="form-control" id="end_date" name="end_date" value="<?php echo $row['task_end_date']?>" autocomplete="off">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label><th>Task Domain</th></label>
                                                            <select id="domain-type" name="task_domain">
                                                            <option>Select Any</option>
                                                            <?php
                                                                $query1 = "SELECT domain FROM capms_project_info WHERE project_id = '" . $_GET['project_id'] . "' ";
                                                                $result1 = mysqli_query($con, $query1);

                                                                $domain_names = array();
                                                                if ($result1->num_rows > 0) {
                                                                    while ($domain_names = mysqli_fetch_assoc($result1)) {
                                                                        $dept_ids = explode(',', $domain_names['domain']);
                                                                        foreach ($dept_ids as $key) {
                                                                            $domain_name_fetch = "SELECT dept_name FROM capms_department_info WHERE dept_id = '" . $key . "' ";
                                                                            $result2 = mysqli_query($con, $domain_name_fetch);
                                                                            if ($result2->num_rows > 0) {
                                                                                while ($row100 = mysqli_fetch_assoc($result2)) {
                                                                ?>
                                                                <option value="<?php echo $key; ?>"><?php echo $row100['dept_name']; ?></option>
                                                            <?php
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Task type</Th></label>
                                                            <select id="task-type" name="task_type">
                                                                <option>Select Any</option>
                                                                <?php
                                                                $query2 = "SELECT * FROM capms_project_tasktype_info";
                                                                $result2 = mysqli_query($con, $query2);
                                                                if ($result2->num_rows > 0) {
                                                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                                                        $selected = "";
                                                                        if($row2['task_type_id'] == $row['task_type']) {
                                                                            $selected = "selected";
                                                                        }
                                                                ?>
                                                                        <option value="<?php echo $row2['task_type_id']; ?>" <?php echo $selected;?>><?php echo $row2['task_type_name']; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>

                                                            </select>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <lable>Task Status</lable>
                                                            <select class="form-control" id="task_status" name="task_status">
                                                                <option value="0" <?php if($row['task_status'] == 0) { echo 'selected'; } ?> >In Progress</option>
                                                                <option value="1" <?php if($row['task_status'] == 1) { echo 'selected'; } ?> >Stand By</option>
                                                                <option value="2" <?php if($row['task_status'] == 2) { echo 'selected'; } ?> >Finished</option>
                                                                <option value="3" <?php if($row['task_status'] == 3) { echo 'selected'; } ?> > Closed</option>
                                                            </select>
                                                        </div>
                                                        
                                                        <?php
                                                            $checked_members = '';
                                                            $query = "SELECT user_id FROM `capms_user_workload_info` WHERE `project_id` = '".$_REQUEST['project_id']."' AND `task_id` = '".$_REQUEST['task_id']."' and status = 1";
                                                            $result = mysqli_query($con, $query);
                                                            if ($result->num_rows > 0) {
                                                                while ($row101 = mysqli_fetch_assoc($result)) {
                                                                    if($checked_members=='') {
                                                                        $checked_members = $row101['user_id'];
                                                                    }
                                                                    else {
                                                                        $checked_members = $checked_members.','.$row101['user_id'];
                                                                    } 
                                                                }
                                                            }
                                                            // echo $checked_members;
                                                            // echo "\n";
                                                            // $checked_members_array = explode(',',$checked_members);
                                                            // print_r($checked_members_array);
                                                        ?>

                                                        <div class="col-md-6">
                                                            <label>Assigned Member</label> 
                                                                <?php
                                                                $assigned_members_selected = explode(',',$checked_members);
                                                                $query = "SELECT * FROM capms_admin_users";
                                                                $result = mysqli_query($con, $query);
                                                                if($result->num_rows > 0){
                                                                    while($row1001 = mysqli_fetch_assoc($result)){
                                                                        if (in_array($row1001['id'], $assigned_members_selected)) {
                                                                            $checked = 'checked';
                                                                        }
                                                                        else {
                                                                            $checked = '';
                                                                        }
                                                                        echo '<input type="checkbox" class="form-control" placeholder="Members Name" name="members_name[]" value="' .$row1001['id']. '" ' . $checked . '>' . $row1001['user_fullname'] . '</option>';
                                                                    }
                                                                }
                                                                ?>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Trello Task ID</label>
                                                            <input type="text" class="form-control" placeholder="Trello task Id" name="trello_taskid" value="<?php echo $row['trello_task_id']?>">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Trello Link</label>
                                                            <input type="text" class="form-control" placeholder="Trello Link" name="trello_link" value="<?php echo $row['trello_task_link']?>">
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label>project_task Details</label>
                                                            <textarea id="editor" name="description"><?php echo $row['task_desc']?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php 
                                                }
                                            }
                                        ?>
                                        </div>
                                    </div>

                                    <?php if($_SESSION['emp_type'] == "hr" || $_SESSION['emp_type'] == "admin"){
                                    ?>
                                    <div class="col-md-12 text-center">
                                        <input type="submit" class="btn dp-em-nxt-btn" name="update_task" value="Update">
                                        <a href="delete_project_task.php?project_id=<?php echo $_REQUEST['project_id']?>&task_id=<?php echo $_REQUEST['task_id']?>&user_id=<?php echo $_SESSION['emp_id']?>" class="btn dp-em-nxt-btn">Delete</a>
                                        <!-- <input type="submit" class="btn dp-em-nxt-btn" name="delete_task" value="Delete"> -->
                                    </div>
                                    <?php }?>
                                </div>
                            </form>
                         

                            <?php 
                                if (isset($_POST['update_task'])) {
                                
                                    //echo $_POST['task_name'];
                                    //die();
    
                                      $task_update_query = "UPDATE `capms_project_task_info` SET `task_name`='" . $_POST['task_name'] . "', `task_status`='" . $_POST['task_status'] . "', `priority`='" . $_POST['task_priority'] . "',`task_start_date`='" . $_POST['start_date'] . "',`task_end_date`='" . $_POST['end_date'] . "',`task_domain`='" . $_POST['task_domain'] . "',`task_type`='" . $_POST['task_type'] . "',`trello_task_id`='" . $_POST['trello_taskid'] . "',`trello_task_link`='" . $_POST['trello_link'] . "',`task_desc`='" . $_POST['description'] . "',`updated_at`='" . date('Y-m-d h:i:s', strtotime('now')) . "' WHERE `task_id` = '".$_GET['task_id']."'";

                                   // die();
    
                                    $task_insert_result = mysqli_query($con, $task_update_query);
    
                                    $check_assign_user = "SELECT `user_id` FROM `capms_user_workload_info` WHERE project_id = '".$_GET['project_id']."' AND task_id = '".$_GET['task_id']."' ";
    
                                    $user_list = array();
                                    $result = mysqli_query($con, $check_assign_user);
                                    if($result->num_rows > 0){
                                        while($user_ids = mysqli_fetch_array($result)){
                                            $user_list[] = $user_ids['user_id']; 
                                        } 
                                        
                                    }

                                    // print_r($_POST['members_name']);

                                    foreach($user_list as $key){
                                        if(!in_array($key, $_POST['members_name'])){
                                            $unassigned = "UPDATE `capms_user_workload_info` SET status = 0 WHERE user_id ='". $key."' AND project_id = '".$_GET['project_id']."' AND task_id = '".$_GET['task_id']."' ";
                                            mysqli_query($con, $unassigned);
                                        }
                                    }

                                    foreach($_POST['members_name'] as $key){
                                        if(!in_array($key, $user_list)){
                                            $user_work_load = "INSERT INTO `capms_user_workload_info` (`workload_id`, `user_id`, `project_id`, `task_id`, `status`, `created_at`, `updated_at`) VALUES (NULL, '".$key."', '".$_GET['project_id']."', '".$_GET['task_id']."', '1', '', '');";
                                            mysqli_query($con, $user_work_load);
                                        }
                                        else {
                                            $assigned = "UPDATE `capms_user_workload_info` SET status = 1 WHERE user_id ='". $key."' AND project_id = '".$_GET['project_id']."' AND task_id = '".$_GET['task_id']."' ";
                                            mysqli_query($con, $assigned);
                                        }
                                    }


                                    // if status == 0 (we need to change the status to 1)
                                    echo "<script>location.href='".$baseURL."edit_project_task.php?project_id=".$_GET['project_id']."&task_id=".$_GET['task_id']."';</script>";
                                }
                            ?>


                         
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

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://jqueryui.com//resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
        $(function() {
            var availableTeamMembers = <?php echo $names ?>;
            $("#leaders").autocomplete({
                source: availableTeamMembers
            });

            var availableTeams = ['Html-Css', 'Angular-Iocic', 'Development', 'Testing'];
            $("#teams").autocomplete({
                source: availableTeams
            });


        });
    </script>

    <script src="https://cdn.tiny.cloud/1/04z7u7156gqei101i37ypflfj99zptjgbodnyi91ni0bs5je/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea#editor',
            menubar: false
        });
    </script>

<?php
    
    $query11 = "SELECT start_date, end_date FROM capms_project_info WHERE project_id = '".$_GET['project_id']."' " ;
    $result11 = mysqli_query($con,$query11);

    if($result11->num_rows > 0){
        while($end = mysqli_fetch_assoc($result11)){
            $psdate = $end['start_date'];
            $pedate = $end['end_date'];
?>

<!-- START DATE AND END DATE PICKER -->
<script>
    $("#start_date").datepicker({
        onSelect: function(dateText, inst) {
            var sdate = $(this).val();
            var fullStartDate = new Date(sdate);
            var twoDigitMonthStart = ((fullStartDate.getMonth().length + 1) === 1) ? (fullStartDate.getMonth() + 1) : '0' + (fullStartDate.getMonth() + 1);
            var startDate = fullStartDate.getDate() + "/" + twoDigitMonthStart + "/" + fullStartDate.getFullYear();

            var projectStartDate = new Date("<?php echo $psdate;?>");
            var projectEndDate = new Date("<?php echo $pedate;?>");
            var selectedDate = new Date(sdate);

            if (selectedDate > projectEndDate) {
                alert("Can't select date after project end_date!!!");
                $.datepicker._clearDate(this);
            }
            else if(selectedDate < projectStartDate.setDate(projectStartDate.getDate() - 1)){
                alert("Can't select date before project start_date!!!");
                $.datepicker._clearDate(this);
            }
        }
    });
    $("#end_date").datepicker({
        onSelect: function(dateText, inst) {
            var edate = $(this).val();
            var fullStartDate = new Date(edate);
            var twoDigitMonthStart = ((fullStartDate.getMonth().length + 1) === 1) ? (fullStartDate.getMonth() + 1) : '0' + (fullStartDate.getMonth() + 1);
            var startDate = fullStartDate.getDate() + "/" + twoDigitMonthStart + "/" + fullStartDate.getFullYear();

            var projectStartDate = new Date("<?php echo $psdate;?>");
            var projectEndDate = new Date("<?php echo $pedate;?>");
            var selectedDate = new Date(edate);

            if (selectedDate > projectEndDate) {
                alert("Can't select date after project end_date!!!");
                $.datepicker._clearDate(this);
            }
            else if(selectedDate < projectStartDate.setDate(projectStartDate.getDate() - 1)){
                alert("Can't select date before project start_date!!!");
                $.datepicker._clearDate(this);
            }
        }
    });
</script>

<script>
    $(document).ready(function() {
        $("#project_heading").append(" [duration : <?php echo $psdate.' to '.$pedate;?>]");
    });
</script>

<?php
        }
    }
?>


    <style type="text/css">
        .files input {
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear;
            padding: 120px 0px 85px 35%;
            text-align: center !important;
            margin: 0;
            width: 100% !important;
        }

        .files input:focus {
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear;
            border: 1px solid #92b0b3;
        }

        .files {
            position: relative
        }

        .files:after {
            pointer-events: none;
            position: absolute;
            top: 60px;
            left: 0;
            width: 50px;
            right: 0;
            height: 56px;
            content: "";
            background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png);
            display: block;
            margin: 0 auto;
            background-size: 100%;
            background-repeat: no-repeat;
        }

        .color input {
            background-color: #f1f1f1;
        }

        .files:before {
            position: absolute;
            bottom: 10px;
            left: 0;
            pointer-events: none;
            width: 100%;
            right: 0;
            height: 57px;
            content: " or drag it here. ";
            display: block;
            margin: 0 auto;
            color: #2ea591;
            font-weight: 600;
            text-transform: capitalize;
            text-align: center;
        }
    </style>


</body>

</html>