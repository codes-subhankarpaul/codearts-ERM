<?php
session_start();
if ($_SESSION['emp_type'] != "hr" && $_SESSION['emp_type'] != "admin") { 
        header("Location: payslip.php");
}

else{
?>

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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <title>Pay Slip - CERM :: Codearts Employee Relationship Management</title>
        <style>
            .ui-datepicker-calendar {
                display: none;
            }
        </style>
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
                                <h2>Employee Pay Slip</h2>
                                <ul>
                                    <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                    <li><a href="<?php echo $baseURL; ?>payslip_add.php">Add Pay Slip</a></li>
                                </ul>
                            </section>
                            <section class="employee-profiles">
                                    <div class="row">
                                        <?php 
                                            $sql1 = "SELECT * FROM capms_admin_users";
                                            $result1 = mysqli_query($con, $sql1);
                                            if($result1->num_rows > 0)
                                            {
                                                while($row1 = mysqli_fetch_assoc($result1))
                                                {
                                                    ?>
                                                        <div class="col-lg-3 col-md-6">
                                                            <div class="employee-profiles-thubmnail">
                                                                <div class="dropdown employee-thumb-toggle">
                                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fas fa-ellipsis-v"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                        <a class="dropdown-item"
                                                                            href="javascript:void(0)"><?php echo ucwords($row1['user_type']); ?></a>
                                                                        <a class="dropdown-item" href="employee_payslip_add.php?user_id=<?php echo $row1['id']; ?>">Payslip</a>
                                                                    </div>
                                                                </div>
                                                                <div class="employee-image">
                                                                    <a href="employee_payslip_add.php?user_id=<?php echo $row1['id']; ?>"><img src="assets/uploads/user_featured_images/<?php echo $row1['user_featured_image']; ?>" alt=""></a>
                                                                </div>
                                                                <div class="employee-content">
                                                                    <a href="employee_payslip_add.php?user_id=<?php echo $row1['id']; ?>"><?php echo $row1['user_fullname']; ?></a>
                                                                    <h6><?php echo $row1['user_designation']; ?></h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                </section>
                        </div>
                        
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
<?php
}
?>