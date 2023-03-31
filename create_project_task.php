<?php
error_reporting(E_ALL ^ E_NOTICE);
?>
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
        <title>Create Task - CERM :: Codearts Employee Relationship Management</title>
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
                            <?php include 'dashboard.php'; ?>
                        </div>
                        <div class="col-lg-9">
                            <section class="inner-head-brd">
                                <h2 id="project_heading"></h2>
                                <ul>
                                    <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                    <li>Projects</li>
                                </ul>
                            </section>
                            
                            <section class="custom-projects">
                                <form method="POST" enctype="multipart/form-data">
                                    <h4 class="mb-3">Create Task</h4>
                                    <div class="form-row"> 
                                  
                                      <div class="form-group col-md-12">  
                                          <div class="multi-field-wrapper">
                                          <div class="multi-fields dp-custom-multifields">
                                          <div class="multi-field">
                                            <div class="form-row">

                                                 <div class="col-md-6 mb-3">
                                                    <label>Task Name</label> 
                                                    <input type="text" class="form-control" placeholder=" Task Name" name="task_name" required>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label>Priority</label> 
                                                    <select class="form-control" id="priority" name="task_priority" required>
                                                        <option value="4">Top</option>
                                                        <option value="3">High</option>
                                                        <option value="2">Medium</option>
                                                        <option value="1">Low</option>
                                                        <option value="0">None</option>
                                                    </select>
                                                </div>
                                               
                                                <div class="col-md-6 mb-3">
                                                    <label>Start Date</label> 
                                                    <input type="text" id="start_date" class="form-control" name="start_date" autocomplete="off" required>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label>End Date</label> 
                                                    <input type="text" id="end_date" class="form-control" name="end_date" autocomplete="off" required>
                                                </div>

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
                                                                <input type="checkbox" id="domain_name" name="domain_name[]" value="<?php echo $row_domain['dept_id']; ?>">
                                                                <label for="domain_name"><?php echo $row_domain['dept_name']; ?> </label>
                                                                
                                                            <?php } } } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label>Task Type</Th></label> 
                                                    <select id="task-type" class="form-control" name="task_type" required>
                                                        <option value="">Select Any</option>
                                                        <?php
                                                            $query2 = "SELECT * FROM capms_project_tasktype_info";
                                                            $result2 = mysqli_query($con, $query2);
                                                            if($result2->num_rows > 0){
                                                                while ($row2 = mysqli_fetch_assoc($result2)){
                                                        ?>
                                                                    <option value="<?php echo $row2['task_type_id']; ?>"><?php echo $row2['task_type_name']; ?></option>
                                                        <?php
                                                                }
                                                            } 
                                                        ?>
                                                        
                                                    </select>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label>Trello Task ID</label> 
                                                    <input type="text" class="form-control" placeholder="Trello task Id" name="trello_taskid">
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label>Trello Link</label> 
                                                    <input type="text" class="form-control" placeholder="Trello Link" name="trello_link">
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <button class="btn btn-dark w-100" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                                                        Assigned to ->
                                                    </button>
                                                    <div class="collapse show" id="collapseExample2">
                                                        <div class="card">
                                                            <div class="card-body w-75">
                                                            <?php
                                                                $assined_user_ids = '';
                                                                $project_user = "SELECT `user_id` FROM `camps_project_assigned_user_info` WHERE project_id = '".$_GET['project_id']."'";
                                                                $assign_user = mysqli_query($con,$project_user);
                                                                if($assign_user->num_rows > 0){
                                                                    while($assign_user_row = mysqli_fetch_assoc($assign_user)){
                                                                        $assined_user_ids = explode(',', $assign_user_row['user_id']);
                                                                        // print_r ($assined_user_ids); 
                                                                        // die();
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
                                                                    if($checked == 'yes'){ 
                                                                    
                                                                        
                                                            ?>
                                                                <input type="checkbox" id="members_name" name="members_name[]" value="<?php echo $row1['id']; ?>">
                                                                <label for="members_name"><?php echo $row1['user_fullname']; ?> </label>
                                                                
                                                            <?php } } } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <label>project_task Details</label> 
                                                      <textarea id="editor" name="description"></textarea>

                                                </div>
                                              </div>
                                          </div>                        
                                          </div>    
                                                         
                                              
                                          </div>
                                      </div>
                                  
                                    <div class="col-md-12 text-center">
                                        <input type="submit" class="btn dp-em-nxt-btn" name="create_task" value="Create" >
                                    </div>
                                    </div>
                                </form>
                                <?php
                                    if(isset($_POST['create_task'])){

                                        if(!(isset($_POST['domain_name'])) ){
                                            echo "Domain name is not defined.Please set the domain name first.";
                                            die();
                                        }
                                        if(!(isset($_POST['members_name']))){
                                            echo "Team members are not defined.Please set the team first.";
                                            die();
                                        }

                                        $temp_task_domain = implode(",", $_POST['domain_name'] );

                                        $task_insert_query = "INSERT INTO `capms_project_task_info`(`task_id`, `task_name`, `task_status`, `priority`, `task_start_date`, `task_end_date`, `task_domain`, `task_type`, `trello_task_id`, `trello_task_link`, `task_desc`, `created_at`, `updated_at`) VALUES (NULL, '".$_POST['task_name']."', '1', '".$_POST['task_priority']."', '".$_POST['start_date']."', '".$_POST['end_date']."', '".$temp_task_domain."', '".$_POST['task_type']."', '".$_POST['trello_taskid']."', '".$_POST['trello_link']."', '".$_POST['description']."', '".date('Y-m-d h:i:s', strtotime('now'))."', '".date('Y-m-d h:i:s', strtotime('now'))."' )";
                                        $task_insert_result = mysqli_query($con, $task_insert_query);
                                        $last_task_id = $con->insert_id;

                                        if($last_task_id){
                                            $invTID = str_pad($last_task_id, 4, '0', STR_PAD_LEFT);
                                            $invPID = str_pad($_GET['project_id'], 4, '0', STR_PAD_LEFT);

                                            $task_number = "capt".date("ymd").$invPID.$invTID;
                                            $task_number;

                                            $task_update = "UPDATE `capms_project_task_info` SET `task_number`='".$task_number."' WHERE task_id = '".$last_task_id."' ";

                                            mysqli_query($con,$task_update);

                                            if(is_array($_POST['members_name'])){
                                                foreach($_POST['members_name'] as $key){
                                                    $user_work_load = "INSERT INTO capms_user_workload_info (workload_id, user_id, project_id, task_id, created_at, updated_at) VALUES (NULL, '".$key."', '".$_GET['project_id']."', '".$last_task_id."', '".date('Y-m-d h:i:s', strtotime('now'))."', '".date('Y-m-d h:i:s', strtotime('now'))."' ) ";
                                                    mysqli_query($con, $user_work_load);
                                                }
                                            }
                                        echo "<script>location.href='".$baseURL."view_task.php?project_id=".$_GET['project_id']."';</script>";
                                        }
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
  $( function() {
    var availableTeamMembers = <?php echo $names ?>;
    $( "#leaders" ).autocomplete({
      source: availableTeamMembers
    });

    var availableTeams = ['Html-Css','Angular-Iocic','Development','Testing'];
    $( "#teams" ).autocomplete({
      source: availableTeams
    });


  } );
  </script>

 <script src="https://cdn.tiny.cloud/1/04z7u7156gqei101i37ypflfj99zptjgbodnyi91ni0bs5je/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: 'textarea#editor',
    menubar: false
  });
</script>


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
.files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
 }
.files{ position:relative}
.files:after {  pointer-events: none;
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
.color input{ background-color:#f1f1f1;}
.files:before {
    position: absolute;
    bottom: 10px;
    left: 0;  pointer-events: none;
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


<?php
                            
    $query11 = "SELECT * FROM capms_project_info WHERE project_id = '".$_GET['project_id']."' " ;
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
        $("#project_heading").append("<?php echo $end['title']?> [duration : <?php echo $psdate.' to '.$pedate;?>]");
        $('#start_date').datepicker('setDate', new Date('<?php echo $psdate;?>'));
        $('#end_date').datepicker('setDate', new Date('<?php echo $pedate;?>'));
    });
</script>

<?php
        }
    }
?>

</body>
</html>