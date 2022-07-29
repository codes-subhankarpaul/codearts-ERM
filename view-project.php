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
                               
                            </section>
                            
                            <section class="custom-projects">
                                <form method="POST" enctype="multipart/form-data">
                                    <h4>Create Project</h4>
                                    <div class="form-row"> 
                                    <?php
                                    
                                    if(isset($_GET['viewid'])){
                                        $vid = $_GET['viewid'];

                                        $ret=mysqli_query($con,"SELECT * FROM `capms_admin_project` WHERE project_id = '".$vid."' ");
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
                                                    <input type="text" class="form-control" placeholder="Name" name="project_name" value="<?php echo $row['project_name']; ?>" disabled>
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Priority</label> 
                                                    <select class="form-control" id="priority" name="priority">
                                                        <option value="High" <?php if($row['project_priority'] == 'High') { echo 'selected'; } ?> disabled>High</option>
                                                        <option value="Medium" <?php if($row['project_priority'] == 'Medium') { echo 'selected'; } ?> disabled>Medium</option>
                                                        <option value="Low" <?php if($row['project_priority'] == 'Low') { echo 'selected'; } ?> disabled>Low</option>
                                                        <option value="Top" <?php if($row['project_priority'] == 'Top') { echo 'selected'; } ?> disabled>Top</option>
                                                    <!-- <label>Priority</label> </br>
                                                    <input type="radio" id="top" name="Priority" value="TOP">
                                                    <label for="top">Top</label>
                                                    <input type="radio" id="high" name="Priority" value="HIGH">
                                                    <label for="high">High</label>
                                                    <input type="radio" id="medium" name="Priority" value="Medium">
                                                    <label for="medium">Medium</label>
                                                    <input type="radio" id="low" name="Priority" value="Low">
                                                    <label for="low">Low</label> -->
                                                    </select>
                                                </div>
                                               
                                                <div class="col-md-6">
                                                    <label>Start Date</label> 
                                                    <input type="date" class="form-control" name="start_date" value="<?php echo $row['project_sdate']; ?>" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>End Date</label> 
                                                    <input type="date" class="form-control" name="end_date" value="<?php echo $row['project_edate']; ?>" disabled>
                                                </div>
                                                

                                                <div class="col-md-6">
                                                    <label>Deadline</label> 
                                                    <input type="date" class="form-control" placeholder="Name" name="deadline" id="deadline" value="<?php echo $row['project_deadline']; ?>" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Project Assigned to:</label> 
                                                    <input type="text" class="form-control" placeholder="Name" name="team_name" id="teams" value="<?php echo $row['project_team']; ?>" disabled>
                                                </div>
 
                   
                                                <div class="col-md-12">
                                                    <label>Project Details</label> 
                                                      <textarea id="editor" name="description" disabled><?php if($row['project_details'] != '') { echo $row['project_details']; } ?></textarea>
                                                </div>
                                                  

                                                <!-- <div class="col-md-12">
                                                    <div class="form-group files color">
                                                         <label>Upload Your File </label>
                                                        <label>Featured Image</label>
                                                        <span class="featured-img-wrap">
                                                            <img src="<?php if($row['user_featured_image'] != '') { echo 'Project_file/'.$row['file_upload']; }
                                                            else {
                                                                echo $row['project_name']; 
                                                            }?>" title="<?php if($row['project_name'] != '') { echo $row['project_name']; }?>" alt="<?php if($row['project_name'] != '') { echo $row['project_name']; }?>" class="user-featured-img">
                                                        </span>
                                                        <input type="file" class="form-control" multiple="" name="document_files">
                                                      </div>
                                                </div> -->


                                              </div>
                                          </div>                        
                                          </div>    
                                                         
                                              
                                          </div>
                                      </div>
                                      <?php $cnt=$cnt+1;
                                            } } } 
                                      ?>
                                   
                                    <div class="col-md-12 text-center">
                                        <input type="submit" class="btn dp-em-nxt-btn" name="create" value="Create" >
                                      </div>
                                    </div>
                                </form>
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
        <?php include 'footer_js.php' ?>

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


    </body>
</html>
