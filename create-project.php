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
                            <?php
                        $sql1 = "SELECT * FROM capms_admin_users WHERE id = '".$_SESSION['emp_id']."' ";
                        $result1 = mysqli_query($con, $sql1);
                        
                        if($result1->num_rows > 0)
                        {
                            while($row1 = mysqli_fetch_assoc($result1))
                            {

                    ?>
                            
                            <section class="custom-projects">
                                <form method="POST" enctype="multipart/form-data">
                                    <h4>Create Project</h4>
                                    <div class="form-row"> 
                                    <?php
                                    
                                    if(isset($_POST['create'])){
                                      $project_name = $_POST['project_name']; 
                                      $project_priority = $_POST['priority'];
                                      $project_sdate = $_POST['start_date'];
                                      $project_edate = $_POST['end_date'];
                                      $project_deadline = $_POST['deadline'];
                                      $project_team = $_POST['team_name'];
                                      $team = implode(",", $project_team);
                                      $project_details = $_POST['description'];
                                      $project_files = $_FILES['document_files'];

                                      //print_r($project_files);
                                      
                                      $filename = $project_files['name'];
                                      $filepath = $project_files['tmp_name'];
                                      $fileerror = $project_files['error'];

                                      if($fileerror == 0){ 

                                        $destfile = 'Project_file/'.$filename;
                                        //echo $destfile;
                                        move_uploaded_file($filepath, $destfile);
                                      }
                                        
                                     //$query=mysqli_query($con, "INSERT INTO capms_admin_project(project_id, project_name, project_priority, project_sdate, project_edate, project_deadline, project_team, project_details) VALUES ('','$project_name','$project_priority','$project_sdate','$project_edate','$project_deadline','$team','$project_details')");
                                     $query = mysqli_query($con,"INSERT INTO capms_admin_project(project_id, project_name, project_priority, project_sdate, project_edate, project_deadline, project_team, project_details) VALUES (Null,'".$project_name."','".$project_priority."','".$project_sdate."','".$project_edate."','".$project_deadline."','".$team."','".$project_details."')");
                                      


                                    //   $query1=mysqli_query($con, "INSERT INTO `capms_member_assigned_project`(`assign_id`, `project_id`, `user_id`, `memeber_name`) VALUES ('','[value-2]',".$row1['user_empid']."','$team')");
                                      
                                    

                                    if ($query) {
                                        echo "<script>alert('You have successfully inserted the data');</script>";
                                        echo "<script type='text/javascript'> document.location ='projects.php'; </script>";
                                    }
                                    else
                                        {
                                        echo "<script>alert('Something Went Wrong. Please try again');</script>";
                                        }

                                    }

                                  ?>
                                  
                                      <div class="form-group col-md-12">  
                                          <div class="multi-field-wrapper">
                                          <div class="multi-fields dp-custom-multifields">
                                          <div class="multi-field">
                                            <div class="form-row">

                                                 <div class="col-md-6">
                                                    <label>Project Name</label> 
                                                    <input type="text" class="form-control" placeholder="Name" name="project_name">
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Priority</label> 
                                                    <select class="form-control" id="priority" name="priority">
                                                        <option>High</option>
                                                        <option>Medium</option>
                                                        <option>Low</option>
                                                        <option>Top</option>
                                                    </select>
                                                </div>
                                               
                                                <div class="col-md-6">
                                                    <label>Start Date</label> 
                                                    <input type="date" class="form-control" name="start_date">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>End Date</label> 
                                                    <input type="date" class="form-control" name="end_date">
                                                </div>
                                                

                                                <div class="col-md-6">
                                                    <label>Deadline</label> 
                                                    <input type="date" class="form-control" placeholder="Name" name="deadline" id="deadline">
                                                </div>
                                                <div class="col-md-6">
                                                     <label>Project Assigned to:</label> 
                                                    <!-- <input type="text" class="form-control" placeholder="Name" name="team_name" id="teams"> -->
                                                    <?php
                                                        $sql1 = "SELECT * FROM capms_admin_users";
                                                        $result1 = mysqli_query($con, $sql1);
                                                        //print_r($result1);
                                                        if($result1->num_rows > 0)
                                                        {
                                                            while($row1 = mysqli_fetch_assoc($result1))
                                                            {
                                                    ?>
                                                        <input type="checkbox" id="team_name" name="team_name[]" value="<?php echo $row1['id']; ?>">
                                                        <label for="team_name"><?php echo $row1['user_fullname']; ?> </label>
                                                        
                                                    <?php } } ?>
                                                </div>


                                                <div class="col-md-12">
                                                    <label>Project Details</label> 
                                                      <textarea id="editor" name="description"></textarea>
                                                </div>
                                               

                                                <div class="col-md-12">
                                                    <div class="form-group files color">
                                                        <label>Upload Your File </label>
                                                        <input type="file" class="form-control" multiple="" name="document_files">
                                                      </div>
                                                </div>


                                              </div>
                                          </div>                        
                                          </div>    
                                                         
                                              
                                          </div>
                                      </div>
                                  
                                    <div class="col-md-12 text-center">
                                        <input type="submit" class="btn dp-em-nxt-btn" name="create" value="Create" >
                                      </div>
                                    </div>
                                </form>
                            </section>
                        <?php } } ?>
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
