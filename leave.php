<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <?php include 'header_css.php'; ?>
    <title>Dashboard Leave</title>
</head>

<body>
    <!--
    <div id="custom-owl" class="owl-carousel owl-theme">
      <div class="item"><h4>1</h4></div>
  </div>
-->


    <header class="custom-header">
        <?php include 'info_panel.php'; ?>
    </header>
    <main class="custom-dahboard-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <?php include 'dashboard.php'; ?>
                </div>
                <div class="col-lg-9">
                    <section class="inner-head-brd">
                        <h2>Leave</h2>
                        <ul>
                            <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                            <li>Leaves</li>
                        </ul>
                        <a class="add-employee-btn" href="leave_form.php"><span class="add-icon">+</span> Add Leave</a>
                    </section>
                    <?php
                        $sql1 = "SELECT * FROM capms_admin_users WHERE id = '".$_SESSION['emp_id']."' ";
                        $result1 = mysqli_query($con, $sql1);
                        //print_r($result1);
                        if($result1->num_rows > 0)
                        {
                            while($row1 = mysqli_fetch_assoc($result1))
                            {
                    ?>
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
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php

                                        $result2 = "SELECT * FROM capms_admin_leave WHERE user_empid = '".$row1['user_empid']."' ";

                                        $row2 = mysqli_query($con, $result2);
                                        if($row2->num_rows > 0)
                                           {
                                            while($row3 = mysqli_fetch_assoc($row2))
                                    {

                                        ?>
                                            <tr>
                                                <td scope="row">
                                                    <h5>11-02-2022</h5>
                                                    </t>
                                                <td>
                                                    <?php echo $row3['user_reason']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row3['user_ldate']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row3['user_rdate']; ?>
                                                </td>
                                                <td>
                                                    <h4>
                                                        <?php echo $row1['user_designation']; ?>
                                                    </h4>
                                                </td>
                                                <td><a class="leave-status-btn pending-btn" href="#">Pending</a></td>
                                                <td>
                                                    <div class="dropdown project-thumb-toggle">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenuButton1" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <?php 

                                                            echo '<a class="dropdown-item" href="leave_update.php?leave_id='.$row3['leave_ID'].'">Edit</a>';
                                                            ?>
                                                            <?php 

                                                            echo '<a class="dropdown-item" href="leave_view.php?leave_id='.$row3['leave_ID'].'">View</a>';
                                                            ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php 
                                            }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php

                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </main>
    <footer class="custom-footer">
        <?php include 'copyright_content.php'; ?>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php include 'footer_js.php' ?>
</body>

</html>