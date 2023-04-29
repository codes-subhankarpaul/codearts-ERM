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
        <title>Salary - CERM :: Codearts Employee Relationship Management</title>
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
                                <h2>Employee Salary</h2>
                                <ul>
                                    <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                    <li><a href="<?php echo $baseURL; ?>salary.php">Salary</a></li>
                                </ul>
                            </section>
                            <?php
                                $salary = "SELECT * FROM `capms_admin_users` WHERE id='".$_REQUEST['user_id']."'";
                                $result_salary = mysqli_query($con,$salary);
                                $row_salary = mysqli_fetch_assoc($result_salary);
                            ?>
                            <form method="POST" enctype="multipart/form-data" action="salary_add.php?user_id=<?php echo $_REQUEST['user_id']; ?>">
                                <label for="salary">Gross Salary:</label>
                                <input type="text" id="salary" name="salary" value="<?php echo $row_salary['user_salary'];?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                                <input type="submit" name="salaryAdd" value="Update" class="btn btn-primary" onclick="return confirm('Do you want to update?')"> 
                            </form>
                            <?php 
                                if(isset($_POST['salaryAdd'])){
                                    if($_POST['salary']==''){
                                        echo '<p class="text-danger">Please enter the salary amount to update.</p>';
                                    }
                                    else{
                                        $updated_salary = number_format((float)$_POST['salary'], 2, '.', '');
                                        $salary_update = "UPDATE `capms_admin_users` SET `user_salary`='".$updated_salary."',`updated_at`='".date('Y-m-d h:i:s', strtotime('now'))."' WHERE id='".$_REQUEST['user_id']."'";
                                        $result_salary_update = mysqli_query($con,$salary_update);
                                        if($result_salary_update){
                                            echo 'Salary has been successfully updated.';
                                        }
                                        else{
                                            echo 'Something went wrong.';
                                        } 
                                    }
                                }
                            ?>
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
