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
                                <h2>Leave</h2>
                                <ul>
                                <li><a href="#">Home</a></li>
                                <li>Leave</li>
                                </ul>
                                <a class="add-employee-btn" href="#"><span class="add-icon">+</span> Add Leave</a>
                            </section>

                            <section class="custom-salary-table custom-leave-table">
                                <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                    <table class="table table-striped leave-table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Salary</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td scope="row">
                                            <h5>1 Jan 2013</h5>
                                            </t>
                                            <td>Madical Leave</td>
                                            <td>10 Jan 2022</td>
                                            <td>17 Jan 2022</td>
                                            <td>
                                            <h4>Software Engineer</h4>
                                            </td>
                                            <td><span class="salary-amt">$73550</span></td>
                                            <td><a class="leave-status-btn pending-btn" href="#">Pending</a></td>
                                            <td>
                                            <div class="dropdown project-thumb-toggle">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                    class="fas fa-ellipsis-v"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item"
                                                    href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a
                                                    class="dropdown-item" href="#">Something else here</a> </div>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="row">
                                            <h5>18 Mar 2013</h5>
                                            </td>
                                            <td>Family Emergency</td>
                                            <td>8 Jan 2022</td>
                                            <td>10 Jan 2022</td>
                                            <td>
                                            <h4>web Devloper</h4>
                                            </td>
                                            <td><span class="salary-amt">$59698</span></td>
                                            <td><a class="leave-status-btn decline-btn" href="#">Decline</a></td>
                                            <td>
                                            <div class="dropdown project-thumb-toggle">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                    class="fas fa-ellipsis-v"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item"
                                                    href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a
                                                    class="dropdown-item" href="#">Something else here</a> </div>
                                            </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="row">
                                            <h5>1 Jan 2013</h5>
                                            </td>
                                            <td>Casual Leave</td>
                                            <td>1 Jan 2022</td>
                                            <td>5 Jan 2022</td>
                                            <td>
                                            <h4>Android Developer</h4>
                                            </td>
                                            <td><span class="salary-amt">$59698</span></td>
                                            <td><a class="leave-status-btn Successful-btn" href="#">Successful</a></td>
                                            <td>
                                            <div class="dropdown project-thumb-toggle">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                                    class="fas fa-ellipsis-v"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item"
                                                    href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a
                                                    class="dropdown-item" href="#">Something else here</a> </div>
                                            </div>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
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