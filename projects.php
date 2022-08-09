<!doctype html>
<html lang="en">

    <head>
        <!-- Header CSS files -->
        <?php include 'header_css.php'; ?>
        <?php
                if($_SESSION['emp_id'] == '')
                {
                  echo "<script>location.href='http://localhost/codearts/login.php';</script>";
                }
            ?>
        <title>Projects - CERM :: Codearts Employee Relationship Management</title>
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
                            <!-- Dashboard Left Sidebar -->
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
                                    <li><a class="creat-project-btn" href="create-project.php"><span>+</span> Creat Project</a></li>
                                </ul>
                            </section>
                            <section class="project-search">
                                <div class="project-search-frm-wrap">
                                    <form method="POST">
                                        <input type="text" pacleholder="Search Project Name" name="search" style="width: 85%;margin: 20px;">
                                        <button type="submit" class="btn employee-search-btn" style="width: 10%" name="submit">Search</button>
                                        <!-- <div class="row">
                                            <div class="form-group col-lg-3 col-md-6">
                                                <input type="text" class="form-control" placeholder="Project Name">
                                            </div>
                                            <div class="form-group col-lg-3 col-md-6">
                                                <input type="text" class="form-control" placeholder="Employee Name">
                                            </div>
                                            <div class="form-group col-lg-3 col-md-6"> <span class="des">Designation</span>
                                                <select class="form-control" id="exampleFormControlSelect1">
                                                    <option>Select Roll</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 text-center">
                                                <button type="submit" class="btn employee-search-btn">Search</button>
                                            </div>
                                        </div> -->
                                    </form>
                                </div>
                            </section>

                            <section class="custom-projects">
                                <div class="row">
                                <?php   
                                        $num_per_page = 8;
                                        if(!isset($_GET['page'])){
                                            $page = 1;
                                        }
                                        else{
                                            $page = $_GET['page'];
                                        }

                                        $start_form =  ($page - 1)*$num_per_page;
                                        $ret=mysqli_query($con,"SELECT * FROM `capms_admin_project` LIMIT $start_form,$num_per_page");
                                        
                                        //$ret=mysqli_query($con,"SELECT * FROM `capms_admin_project`");
                                        $cnt=1;
                                        $row=mysqli_num_rows($ret);
                                        if($row>0){
                                        while ($row=mysqli_fetch_array($ret)) {
                                ?>

                                    <div class="col-lg-3 col-md-6">
                                        <div class="custom-project-wrap">
                                            <div class="dropdown project-thumb-toggle">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a
                                                        class="dropdown-item" href="view-project.php?viewid=<?php echo $row['project_id'];?>">View</a> <a class="dropdown-item"
                                                        href="edit-project.php?editid=<?php echo $row['project_id'];?>">Edit</a> </div>
                                            </div>
                                            <a class="project-title" href="#"><?php echo $row['project_name'];?></a>
                                            <h6><span class="project-count">1</span> open tasks, <span
                                                    class="project-count">9</span> tasks completed</h6>
                                            <p class="demo"><?php echo $row['project_details']; ?></p>
                                            <h5 class="custom-deadline">Deadline :</h5>
                                            <p class="deadline-date"><?php echo $row['project_deadline'];?></p>
                                            <!-- <h5 class="pro-leader">Project Leader :</h5>
                                            <a class="project-leader-img" href="#"> <img src="assets/images/client-img-1.jpg" alt="">
                                            </a> -->
                                            <h5 class="pro-team">Project Team :</h5>
                                            <ul class="project-team-list">
                                            <?php $team = $row['project_team'];
                                                  $team_members = explode(",",$team);
                                                 
                                                  foreach ($team_members as $each_members) {
                                                    //print_r($each_members);
                                                    
                                            
                                                    $sql1 = " SELECT * FROM capms_admin_users WHERE id ='".$each_members."' ";
                                                    $result1 = mysqli_query($con, $sql1);
                                                    
                                                    if($result1->num_rows > 0)
                                                    {
                                                        while($row1 = mysqli_fetch_assoc($result1))
                                                        {
                                                            
                                            ?>
                                                <li><a href="#"><img src="assets/uploads/user_featured_images/<?php echo $row1['user_featured_image'] ?>" alt=""></a></li>

                                            <?php  } } } ?>

                                            </ul>

                                        </div>
                                    </div>

                                    <?php 
                                            $cnt=$cnt+1;

                                            }
                                            $sql2 = "SELECT * FROM `capms_admin_project`";
                                          $rs_result = mysqli_query($con, $sql2);
                                          $total_records = mysqli_num_rows($rs_result);
                                          //echo $total_records;
                                          $total_pages=ceil($total_records/$num_per_page);
                                          //echo $total_pages;
                                          if($page>1){
                                             echo "<a href='projects.php?page=".($page-1)."' class='btn btn-danger'>Previous</a>";
                                          }


                                          for($i=1;$i<=$total_pages;$i++)
                                          {
                                            echo "<a href='projects.php?page=".$i."' class='btn btn-primary'>".$i."</a>";
                                          }

                                          if($i>$page){
                                             echo "<a href='projects.php?page=".($page+1)."' class='btn btn-danger'>Next</a>";
                                          }

                                          } else {?>
                                            <div>
                                                <h3 style="text-align:center; color:red;" colspan="6">No Record Found</h3>
                                            </div>
                                    <?php } ?>
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
    </body>
</html>