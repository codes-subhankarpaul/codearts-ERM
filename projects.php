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
                                    <li>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                                                    class="fas fa-bars"></i> </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a
                                                    class="dropdown-item" href="#">Action</a> <a class="dropdown-item"
                                                    href="#">Another action</a> <a class="dropdown-item" href="#">Something else
                                                    here</a> </div>
                                        </div>
                                    </li>
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
                                    <div class="col-lg-3 col-md-6">
                                        <div class="custom-project-wrap">
                                            <div class="dropdown project-thumb-toggle">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a
                                                        class="dropdown-item" href="#">Action</a> <a class="dropdown-item"
                                                        href="#">Another action</a> <a class="dropdown-item" href="#">Something
                                                        else here</a> </div>
                                            </div>
                                            <a class="project-title" href="#">Office Management</a>
                                            <h6><span class="project-count">1</span> open tasks, <span
                                                    class="project-count">9</span> tasks completed</h6>
                                            <p class="demo">Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry. When an unknown printer took a galley of type and scrambled it...</p>
                                            <h5 class="custom-deadline">Deadline :</h5>
                                            <p class="deadline-date">17 dec 2021</p>
                                            <h5 class="pro-leader">Project Leader :</h5>
                                            <a class="project-leader-img" href="#"> <img src="assets/images/client-img-1.jpg" alt="">
                                            </a>
                                            <h5 class="pro-team">Project Team :</h5>
                                            <ul class="project-team-list">
                                                <li><a href="#"><img src="assets/images/client-img-1.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/employee-1.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/employee-2.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/employee-5.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/employee-4.jpg" alt=""></a></li>
                                                <li><a href="#">+15</a></li>
                                            </ul>
                                            <div class="custom-project-progress">
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="custom-project-wrap">
                                            <div class="dropdown project-thumb-toggle">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a
                                                        class="dropdown-item" href="#">Action</a> <a class="dropdown-item"
                                                        href="#">Another action</a> <a class="dropdown-item" href="#">Something
                                                        else here</a> </div>
                                            </div>
                                            <a class="project-title" href="#">Office Management</a>
                                            <h6><span class="project-count">1</span> open tasks, <span
                                                    class="project-count">9</span> tasks completed</h6>
                                            <p class="demo">Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry. When an unknown printer took a galley of type and scrambled it...</p>
                                            <h5 class="custom-deadline">Deadline :</h5>
                                            <p class="deadline-date">17 dec 2021</p>
                                            <h5 class="pro-leader">Project Leader :</h5>
                                            <a class="project-leader-img" href="#"> <img src="assets/images/client-img-1.jpg" alt="">
                                            </a>
                                            <h5 class="pro-team">Project Team :</h5>
                                            <ul class="project-team-list">
                                                <li><a href="#"><img src="assets/images/client-img-1.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/employee-1.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/employee-2.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/employee-5.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/employee-4.jpg" alt=""></a></li>
                                                <li><a href="#">+15</a></li>
                                            </ul>
                                            <div class="custom-project-progress">
                                                <h5 class="pro-team">Progress :</h5>
                                                <div class="custom-dp-progress" style="width: 100%;">
                                                    <div class="dp-progress-value">
                                                        <p class="demo">60%</p>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="60"
                                                            aria-valuemin="0" aria-valuemax="100" style="max-width: 60%"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="custom-project-wrap">
                                            <div class="dropdown project-thumb-toggle">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a
                                                        class="dropdown-item" href="#">Action</a> <a class="dropdown-item"
                                                        href="#">Another action</a> <a class="dropdown-item" href="#">Something
                                                        else here</a> </div>
                                            </div>
                                            <a class="project-title" href="#">Office Management</a>
                                            <h6><span class="project-count">1</span> open tasks, <span
                                                    class="project-count">9</span> tasks completed</h6>
                                            <p class="demo">Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry. When an unknown printer took a galley of type and scrambled it...</p>
                                            <h5 class="custom-deadline">Deadline :</h5>
                                            <p class="deadline-date">17 dec 2021</p>
                                            <h5 class="pro-leader">Project Leader :</h5>
                                            <a class="project-leader-img" href="#"> <img src="assets/images/client-img-1.jpg" alt="">
                                            </a>
                                            <h5 class="pro-team">Project Team :</h5>
                                            <ul class="project-team-list">
                                                <li><a href="#"><img src="assets/images/client-img-1.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/employee-1.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/employee-2.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/employee-5.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/employee-4.jpg" alt=""></a></li>
                                                <li><a href="#">+15</a></li>
                                            </ul>
                                            <div class="custom-project-progress">
                                                <h5 class="pro-team">Progress :</h5>
                                                <div class="custom-dp-progress" style="width: 100%;">
                                                    <div class="dp-progress-value">
                                                        <p class="demo">80%</p>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="80"
                                                            aria-valuemin="0" aria-valuemax="100" style="max-width: 80%"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <div class="custom-project-wrap">
                                            <div class="dropdown project-thumb-toggle">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a
                                                        class="dropdown-item" href="#">Action</a> <a class="dropdown-item"
                                                        href="#">Another action</a> <a class="dropdown-item" href="#">Something
                                                        else here</a> </div>
                                            </div>
                                            <a class="project-title" href="#">Office Management</a>
                                            <h6><span class="project-count">1</span> open tasks, <span
                                                    class="project-count">9</span> tasks completed</h6>
                                            <p class="demo">Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry. When an unknown printer took a galley of type and scrambled it...</p>
                                            <h5 class="custom-deadline">Deadline :</h5>
                                            <p class="deadline-date">17 dec 2021</p>
                                            <h5 class="pro-leader">Project Leader :</h5>
                                            <a class="project-leader-img" href="#"> <img src="assets/images/client-img-1.jpg" alt="">
                                            </a>
                                            <h5 class="pro-team">Project Team :</h5>
                                            <ul class="project-team-list">
                                                <li><a href="#"><img src="assets/images/client-img-1.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/employee-1.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/employee-2.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/employee-5.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="assets/images/employee-4.jpg" alt=""></a></li>
                                                <li><a href="#">+15</a></li>
                                            </ul>
                                            <div class="custom-project-progress">
                                                <h5 class="pro-team">Progress :</h5>
                                                <div class="custom-dp-progress" style="width: 100%;">
                                                    <div class="dp-progress-value">
                                                        <p class="demo">98%</p>
                                                    </div>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="98"
                                                            aria-valuemin="0" aria-valuemax="100" style="max-width: 98%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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