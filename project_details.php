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
        <title>Project Details- CERM :: Codearts Employee Relationship Management</title>
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
                                <h2>Project Title</h2>
                            </section>
                            <section class="project-details">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="project-name">
                                            <h3>Project name</h3>
                                        </div>
                                        <div class="project-description">
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit doloremque iste numquam corporis mollitia quod. Est optio dolores voluptatum debitis!</p>
                                        </div>
                                        <div class="project-priority">
                                            <p>High</p>
                                        </div>
                                        <div class="project-team-lead">
                                            <h4>Subhankar Paul</h4>
                                        </div>
                                        <div class="project-dead-line">
                                            <p>some date</p>
                                        </div>
                                        <div class="project-status">
                                            <p>in progress</p>
                                        </div>
                                        <div class="view-task">
                                           <a href="project_task.php"> <button>view task</button></a>
                                        </div>
                                        <div class="project-members">
                                            <button>view members</button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>