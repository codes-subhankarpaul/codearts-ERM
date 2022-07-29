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
                                    <!-- <li>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                                    class="fas fa-bars"></i> </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a
                                                    class="dropdown-item" href="#">Action</a> <a class="dropdown-item"
                                                    href="#">Another action</a> <a class="dropdown-item" href="#">Something else
                                                    here</a> </div>
                                        </div>
                                    </li> -->
                                    <li><a class="creat-project-btn" href="create-project.php"><span>+</span> Creat Project</a></li>
                                </ul>
                            </section>
                            <section class="project-search">
                                <div class="project-search-frm-wrap">
                                    <form>
                                        <div class="row">
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
                                        </div>
                                    </form>
                                </div>
                            </section>

                            <section class="custom-projects">
                                <div class="row">
                                <?php
                                        $ret=mysqli_query($con,"SELECT * FROM `capms_admin_project`");
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
                                            <!-- <div class="custom-project-progress">
                                                <h5 class="pro-team">Progress :</h5>
                                                <div class="custom-dp-progress" style="width: 100%;">
                                                    <div class="dp-progress-value">
                                                        <p class="demo">40%</p>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="40"
                                                            aria-valuemin="0" aria-valuemax="100" style="max-width: 40%"></div>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <?php 
                                            $cnt=$cnt+1;
                                            } } else {?>
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