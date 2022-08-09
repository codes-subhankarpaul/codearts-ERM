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
                                <h2>Projects Task</h2>
                                <ul>
                                    <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                    <li>Projects</li>
                                </ul>
                               
                            </section>
                            
                            <section class="custom-projects">
                                <form method="POST" enctype="multipart/form-data">
                                    <h4>Create Task</h4>
                                    <div class="form-row"> 
                                  
                                      <div class="form-group col-md-12">  
                                          <div class="multi-field-wrapper">
                                          <div class="multi-fields dp-custom-multifields">
                                          <div class="multi-field">
                                            <div class="form-row">

                                                 <div class="col-md-6">
                                                    <label>Task Name</label> 
                                                    <input type="text" class="form-control" placeholder=" Task Name" name="task_name">
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Priority</label> 
                                                    <select class="form-control" id="priority" name="task_priority">
                                                        <option value="4">Top</option>
                                                        <option value="3">High</option>
                                                        <option value="2">Medium</option>
                                                        <option value="1">Low</option>
                                                        <option value="0">None</option>
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
                                                    <label>Task Domain</Th></label> 
                                                    <select id="domain-type" name="task_domain">
                                                        <option>Select Any</option>
                                                        <?php
                                                            $query1 = "SELECT * FROM capms_department_info" ;
                                                            $result1 = mysqli_query($con,$query1);
                                                            if($result1->num_rows > 0){
                                                                while($row1 = mysqli_fetch_assoc($result1)){
                                                        ?>
                                                             <option value="<?php echo $row1['dept_id'] ?>"><?php echo $row1['dept_name']; ?></option>
                                                        <?php
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

                                                <div class="col-md-6">
                                                    <label>Assigned Member</label> 
                                                        <?php
                                                          $query = "SELECT * FROM capms_admin_users";
                                                          $result = mysqli_query($con, $query);
                                                          if($result->num_rows > 0){
                                                            while($row = mysqli_fetch_assoc($result)){
                                                        ?>
                                                        <input type="checkbox" class="form-control" placeholder="Members Name" name="members_name[]" value="<?php echo $row['id']; ?>">
                                                        <span><?php echo $row['user_fullname']; ?></span>
                                                        <?php
                                                            }
                                                          }
                                                    ?>
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Trello Task ID</label> 
                                                    <input type="text" class="form-control" placeholder="Trello task Id" name="trello_taskid">
                                                </div>

                                                <div class="col-md-6">
                                                    <label>Trello Link</label> 
                                                    <input type="text" class="form-control" placeholder="Trello Link" name="trello_link">
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
                                        $members = $_POST['members_name'];
                                        $team = implode(",", $members);

                                        $task_insert_query = "INSERT INTO `capms_project_task_info`(`task_id`, `task_name`, `priority`, `task_start_date`, `task_end_date`, `task_domain`, `task_type`, `assigned_members`, `trello_task_id`, `trello_task_link`, `task_desc`, `created_at`, `updated_at`) VALUES (NULL, '".$_POST['task_name']."', '".$_POST['task_priority']."', '".$_POST['start_date']."', '".$_POST['end_date']."', '".$_POST['task_domain']."', '".$_POST['task_type']."', '".$team."', '".$_POST['trello_taskid']."', '".$_POST['trello_link']."', '".$_POST['description']."', '".date('Y-m-d h:i:s', strtotime('now'))."', '".date('Y-m-d h:i:s', strtotime('now'))."' )";
                                        
                                        $task_insert_result = mysqli_query($con, $task_insert_query);

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
