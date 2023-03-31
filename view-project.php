<!doctype html>
<html lang="en">

    <head>
        <!-- Header CSS files -->
        <?php

use LDAP\Result;

 include 'header_css.php'; ?>
        <title>View Projects - CERM :: Codearts Employee Relationship Management</title>
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
                                <h2>Projects</h2>
                                <ul>
                                    <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                    <li>Projects</li>
                                </ul>
                                <ul class="projects-btn">
                                    <li><a class="creat-project-btn bg-primary" href="view_task.php?project_id=<?php echo $_GET['viewid'] ?>"><span>+</span> View Task</a></li>
                                    <?php if($_SESSION['emp_type'] == "hr" || $_SESSION['emp_type'] == "admin"){
                                    ?>
                                        <li><a class="creat-project-btn" href="create_project_task.php?project_id=<?php echo $_GET['viewid'] ?>"><span>+</span> Create Task</a></li>
                                    <?php }?>
                                </ul>
                               
                            </section>
                            
                            <section class="custom-projects">
                                <form method="POST" enctype="multipart/form-data">
                                    
                                    <div class="form-row"> 
                                    <?php
                                    
                                    if(isset($_GET['viewid'])){
                                        $vid = $_GET['viewid'];

                                        $ret=mysqli_query($con,"SELECT * FROM `capms_project_info` WHERE project_id = '".$vid."' ");
                                        $cnt=1;
                                        $row=mysqli_num_rows($ret);
                                        if($row>0){
                                        while ($row=mysqli_fetch_array($ret)) {


                                   ?>
                                  
                                      <div class="form-group col-md-12">  
                                          <div class="multi-field-wrapper">
                                          <div class="multi-fields dp-custom-multifields">
                                          <div class="multi-field">
                                            <div class="form-row">

                                                 <div class="col-md-6">
                                                    <label>Project Name</label> 
                                                    <input type="text" class="form-control" placeholder="Name" name="project_name" value="<?php echo $row['title']; ?>" required>
                                                </div>

                                                <div class="col-md-6">
                                                    <lable>Project Number</lable>
                                                    <input type="text" class="form-control readonly" placeholder="Project Number"
                                                    value="<?php echo $row['project_number']; ?>" disabled>
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Priority</label> 
                                                    <select class="form-control" id="priority" name="priority">
                                                        <option value="3" <?php if($row['priority'] == 3) { echo 'selected'; } ?> >High</option>
                                                        <option value="2" <?php if($row['priority'] == 2) { echo 'selected'; } ?> >Medium</option>
                                                        <option value="1" <?php if($row['priority'] == 1) { echo 'selected'; } ?> >Low</option>
                                                        <option value="0" <?php if($row['priority'] == 0) { echo 'selected'; } ?> >None</option>
                                                    </select>
                                                </div>
                                            
                                                <div class="col-md-6">
                                                    <label>Domain</label> 
                                                    <?php
                                                        $domain_array = array();
                                                        $domain_query = "SELECT * FROM capms_department_info";
                                                        $domain_result = mysqli_query($con, $domain_query);
                                                        if($domain_result-> num_rows > 0){
                                                            while($domain_rows = mysqli_fetch_assoc($domain_result)){
                                                                $domain_selector = "SELECT `domain` FROM `capms_project_info` WHERE project_id = ".$row['project_id']." ";
                                                                $domain_selector_result = mysqli_query($con,$domain_selector);
                                                                if($domain_selector_result-> num_rows > 0){
                                                                    while($row99 = mysqli_fetch_assoc($domain_selector_result)){
                                                                        $domain_array = explode(',',$row99['domain']);
                                                                        if (in_array($domain_rows['dept_id'], $domain_array))
                                                                        {
                                                                        $checked = 'yes';
                                                                        }
                                                                        else{
                                                                            $checked = 'no';
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                    <input type="checkbox" id="team_name" name="domain_name[]" value="<?php echo $domain_rows['dept_id']; ?>" <?php if($checked == 'yes'){ echo 'checked'; }?>>
                                                    <label for="domain"><?php echo $domain_rows['dept_name']; ?> </label>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                    
                                                </div>
                                               
                                                <div class="col-md-6">
                                                    <label>Start Date</label> 
                                                    <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $row['start_date']; ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>End Date</label> 
                                                    <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $row['end_date']; ?>" required>
                                                </div>
                                                

                                                <!-- <div class="col-md-6">
                                                    <label>Deadline</label> 
                                                    <input type="date" class="form-control" placeholder="Name" name="deadline" id="deadline" value="<?php echo $row['end_date']; ?>" disabled>
                                                </div> -->
                                                <div class="col-md-12">
                                                    <label>Project Assigned to:</label> 
                                                        <?php
                                                            $assined_user_ids = '';
                                                            $project_user = "SELECT `user_id` FROM `camps_project_assigned_user_info` WHERE project_id = '".$row['project_id']."'";
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
                                                                    
                                                        ?>
                                                            <input type="checkbox" id="team_name" name="team_name[]" value="<?php echo $row1['id']; ?>" <?php if($checked == 'yes'){ echo 'checked'; }?>>
                                                            <label for="team_name"><?php echo $row1['user_fullname']; ?> </label>
                                                            
                                                        <?php } } ?>

                                                         
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <lable>Project Status</lable>
                                                    <select class="form-control" id="project-status" name="project_status">
                                                    <option value="1" <?php if($row['project_status'] == 1) { echo 'selected'; } ?> >In Progress</option>
                                                        <option value="2" <?php if($row['project_status'] == 2) { echo 'selected'; } ?> >Stand By</option>
                                                        <option value="0" <?php if($row['project_status'] == 0) { echo 'selected'; } ?> >Finished</option>
                                                        <option value="3" <?php if($row['project_status'] == 3) { echo 'selected'; } ?> > Closed</option>
                                                    </select>

                                                </div>

                                                <div class="col-md-12">
                                                    <label>Project Details</label> 
                                                      <textarea id="editor" name="project_details"><?php if($row['project_details'] != '') { echo $row['project_details']; } ?>
                                                      </textarea>
                                                </div>

                                              </div>
                                          </div>                        
                                          </div>    
                                                         
                                              
                                          </div>
                                      </div>
                                      <?php $cnt=$cnt+1;
                                            } } } 
                                      ?>
                                   
                                    <?php if($_SESSION['emp_type'] == "hr" || $_SESSION['emp_type'] == "admin"){
                                    ?>
                                        <div class="col-md-12 text-center">
                                            <input type="submit" class="btn dp-em-nxt-btn" name="update" value="Update" >
                                            <input type="submit" class="btn dp-em-nxt-btn" name="delete" value="delete">
                                        </div>
                                    <?php }?>
                                    </div>
                                </form>
                                <?php
                                    if(isset($_POST['update'])){
                                        if(!(isset($_POST['domain_name'])) ){
                                            echo "Domain name is not defined.Please set the domain name first.";
                                            die();
                                        }
                                        if(!(isset($_POST['team_name']))){
                                            echo "Team members are not defined.Please set the team first.";
                                            die();
                                        }
                                        $project_domain = $_POST['domain_name'];
                                        $temp_project_domain = implode(",", $project_domain );

                                        $project_update = "UPDATE `capms_project_info` SET `title`='".$_POST['project_name']."',`domain`='".$temp_project_domain."',`start_date`='".$_POST['start_date']."',`end_date`='".$_POST['end_date']."',`priority`='".$_POST['priority']."',`project_details`='".$_POST['project_details']."',`project_status`='".$_POST['project_status']."',updated_at='".date('Y-m-d h:i:s', strtotime('now'))."' where project_id = '".$_GET['viewid']."' ";

                                       mysqli_query($con, $project_update);

                                       $project_team = $_POST['team_name'];
                                       $team = implode(",", $project_team);

                                       $project_member_update = "UPDATE `camps_project_assigned_user_info` SET `user_id`='".$team."',`updated_at`='".date('Y-m-d h:i:s', strtotime('now'))."' WHERE project_id = '".$_GET['viewid']."' ";
                                       mysqli_query($con,$project_member_update);

                                       echo "<script>location.href='".$baseURL."view-project.php?viewid=".$vid." ';</script>";
                                    }

                                    if(isset($_POST['delete'])){
                                        $query = "DELETE FROM `capms_project_info` WHERE project_id = '".$vid."'";
                                        
                                        mysqli_query($con,$query);
                                        echo "<script>location.href='".$baseURL."projects.php';</script>";
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

<script>
$('#start_date').on('input',function(e){
    var e_date = $("#end_date").val();
    var e_date = new Date(e_date);
    var st_date = new Date($(this).val());
    if(e_date < st_date) {
        alert("End date can't be less than start date");
        $('#end_date').val('');
    }
});
$('#end_date').on('input',function(e){
    var s_date = $("#start_date").val();
    var st_date = new Date(s_date);
    var e_date = new Date($(this).val());
    if(e_date < st_date) {
        alert("Start date can't be greater than end date");
        $('#start_date').val('');
    }
});
</script>

    </body>
</html>
