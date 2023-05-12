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
                                <h4 class="mb-3">Edit Task</h4>
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
                                                        <div class="col-md-6 mb-3">
                                                            <label>Task Name</label>
                                                            <input type="text" class="form-control" placeholder=" Task Name" name="task_name" value="<?php echo $row['task_name']?>" <?php if($_SESSION['emp_type'] == "employee") echo "disabled";?> required>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Task Number</label>
                                                            <input type="text" class="form-control" placeholder=" Task Number" name="task_number" value="<?php echo $row['task_number']?>" disabled>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Priority</label>
                                                            <select class="form-control" id="priority" name="task_priority" value="<?php echo $row['priority']?>" <?php if($_SESSION['emp_type'] == "employee") echo "disabled";?>>
                                                                <option value="4">Top</option>
                                                                <option value="3">High</option>
                                                                <option value="2">Medium</option>
                                                                <option value="1">Low</option>
                                                                <option value="0">None</option>
                                                            </select>
                                                        </div>

                                                        <?php
                                                            $checked_domains = '';
                                                            $sql_domains = "SELECT * FROM `capms_project_task_info` WHERE `task_id` = '".$_REQUEST['task_id']."'";
                                                            $result_domains = mysqli_query($con, $sql_domains);
                                                            if ($result_domains->num_rows > 0) {
                                                                while ($row_domains = mysqli_fetch_assoc($result_domains)) {
                                                                    $checked_domains = $row_domains['task_domain'];
                                                                }
                                                                // echo $checked_domains;
                                                                $checked_domains_array = explode(',', $checked_domains);
                                                            }
                                                        ?>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Task Domain</label>
                                                            <button class="btn btn-outline-dark w-100 form-control" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                                Select Task Domain
                                                            </button>
                                                            <div class="collapse" id="collapseExample">
                                                                <div class="card">
                                                                    <div class="card-body w-100">  
                                                                    <?php
                                                                        $assined_domain_ids = '';
                                                                        $project_domain = "SELECT `domain` FROM `capms_project_info` WHERE project_id = '".$_GET['project_id']."'";
                                                                        $assign_domain = mysqli_query($con,$project_domain);
                                                                        if($assign_domain->num_rows > 0){
                                                                            while($assign_domain_row = mysqli_fetch_assoc($assign_domain)){
                                                                                $assign_domain_ids = explode(',', $assign_domain_row['domain']);
                                                                            }
                                                                        }

                                                                        // print_r($assign_domain_ids);

                                                                        $user_domain = "SELECT * FROM `capms_department_info`";
                                                                        $result_domain = mysqli_query($con,$user_domain);
                                                                        if($result_domain->num_rows > 0)
                                                                        {
                                                                            while($row_domain = mysqli_fetch_assoc($result_domain))
                                                                            {   
                                                                                if (in_array($row_domain['dept_id'], $assign_domain_ids)) {
                                                                                    $checked = 'yes';
                                                                                }
                                                                                else {
                                                                                    $checked = 'no';
                                                                                }
                                                                            if($checked == 'yes'){        
                                                                    ?>
                                                                        <input type="checkbox" id="domain_name" name="domain_name[]" value="<?php echo $row_domain['dept_id']; ?>" <?php if (in_array($row_domain['dept_id'], $checked_domains_array)) echo 'checked';?>>
                                                                        <label for="domain_name"><?php echo $row_domain['dept_name']; ?> </label>
                                                                        
                                                                    <?php } } } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Start Date</label>
                                                            <input type="text" class="form-control" id="start_date" name="start_date" value="<?php $task_start_date_select = $row['task_start_date']; echo $task_start_date_select;?>" autocomplete="off" <?php if($_SESSION['emp_type'] == "employee") echo "disabled";?> required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>End Date</label>
                                                            <input type="text" class="form-control" id="end_date" name="end_date" value="<?php $task_end_date_select = $row['task_end_date']; echo $task_end_date_select;?>" autocomplete="off" <?php if($_SESSION['emp_type'] == "employee") echo "disabled";?> required>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Task type</label>
                                                            <select class="form-control" id="task-type" name="task_type" <?php if($_SESSION['emp_type'] == "employee") echo "disabled";?>>
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

                                                        <div class="col-md-6 mb-3">
                                                            <label>Task Status</label>
                                                            <select class="form-control" id="task_status" name="task_status" <?php if($_SESSION['emp_type'] == "employee") echo "disabled";?>>
                                                                <option value="0" <?php if($row['task_status'] == 0) { echo 'selected'; } ?> >Finished</option>
                                                                <option value="1" <?php if($row['task_status'] == 1) { echo 'selected'; } ?> >In Progress</option>
                                                                <option value="2" <?php if($row['task_status'] == 2) { echo 'selected'; } ?> >Stand By</option>
                                                                <option value="3" <?php if($row['task_status'] == 3) { echo 'selected'; } ?> >Closed</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Trello Task ID</label>
                                                            <input type="text" class="form-control" placeholder="Trello task Id" name="trello_taskid" value="<?php echo $row['trello_task_id']?>" <?php if($_SESSION['emp_type'] == "employee") echo "disabled";?>>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Trello Link</label>
                                                            <input type="text" class="form-control" placeholder="Trello Link" name="trello_link" value="<?php echo $row['trello_task_link']?>" <?php if($_SESSION['emp_type'] == "employee") echo "disabled";?>>
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
                                                                // echo $checked_members;
                                                                $checked_members_array = explode(',', $checked_members);
                                                            }
                                                        ?>

                                                        <div class="col-md-12 mb-3">
                                                            <button class="btn btn-dark w-100" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                                                                Assigned to ->
                                                            </button>
                                                            <div class="collapse show" id="collapseExample2">
                                                                <div class="card">
                                                                    <div class="card-body w-75">
                                                                    <?php
                                                                        $assined_user_ids = '';
                                                                        $project_user = "SELECT `user_id` FROM `capms_project_assigned_user_info` WHERE project_id = '".$_GET['project_id']."'";
                                                                        $assign_user = mysqli_query($con,$project_user);
                                                                        if($assign_user->num_rows > 0){
                                                                            while($assign_user_row = mysqli_fetch_assoc($assign_user)){
                                                                                $assined_user_ids = explode(',', $assign_user_row['user_id']);
                                                                            }
                                                                        }
                                                                        $user_query = "SELECT * FROM capms_admin_users";
                                                                        $result_user = mysqli_query($con,$user_query);
                                                                        if($result_user->num_rows > 0)
                                                                        {
                                                                            while($row1 = mysqli_fetch_assoc($result_user))
                                                                            {   
                                                                                if (in_array($row1['id'], $assined_user_ids))
                                                                                {
                                                                                $checked = 'yes';
                                                                                }
                                                                                else{
                                                                                    $checked = 'no';
                                                                                }
                                                                            if($checked == 'yes') {
                                                                    ?>
                                                                        <input type="checkbox" id="members_name" name="members_name[]" value="<?php echo $row1['id']; ?>" <?php if(in_array($row1['id'], $checked_members_array)) echo 'checked';?>>
                                                                        <label for="members_name"><?php echo $row1['user_fullname']; ?> </label>
                                                                    <?php } } } ?>
                                                                    </div>
                                                                </div>
                                                            </div>  
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
                                if(isset($_POST['update_task'])) {

                                    if(!(isset($_POST['domain_name'])) ){
                                        echo "Domain name is not defined.Please set the domain name first.";
                                        die();
                                    }
                                    if(!(isset($_POST['members_name']))){
                                        echo "Team members are not defined.Please set the team first.";
                                        die();
                                    }

                                    $temp_task_domain = implode(",", $_POST['domain_name'] );
    
                                    $task_update_query = "UPDATE `capms_project_task_info` SET `task_name`='" . $_POST['task_name'] . "', `task_status`='" . $_POST['task_status'] . "', `priority`='" . $_POST['task_priority'] . "',`task_start_date`='" . $_POST['start_date'] . "',`task_end_date`='" . $_POST['end_date'] . "',`task_domain`='" . $temp_task_domain . "',`task_type`='" . $_POST['task_type'] . "',`trello_task_id`='" . $_POST['trello_taskid'] . "',`trello_task_link`='" . $_POST['trello_link'] . "',`task_desc`='" . $_POST['description'] . "',`updated_at`='" . date('Y-m-d h:i:s', strtotime('now')) . "' WHERE `task_id` = '".$_GET['task_id']."'";
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
            <?php if($_SESSION['emp_type'] == "employee") echo ",readonly : 1";?>
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
            else {
                // end date checking
                var edate = $('#end_date').val();
                var edate = new Date(edate);
                if(edate < selectedDate) {
                    alert("Start date can't be greater than end date");
                    $('#start_date').val('');
                }
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
            else {
                var s_date = $("#start_date").val();
                var st_date = new Date(s_date);
                var e_date = new Date(edate);
                if(e_date < st_date) {
                    alert("End date can't be less than start date");
                    $.datepicker._clearDate(this);
                }
            } 
        }
    });
</script>

<script>
    $(document).ready(function() {
        $("#project_heading").append("<h6 class='py-1'>[duration : <?php echo $psdate.' to '.$pedate;?>]</h6>");
        $('#start_date').datepicker('setDate', new Date('<?php echo $task_start_date_select;?>'));
        $('#end_date').datepicker('setDate', new Date('<?php echo $task_end_date_select;?>'));
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