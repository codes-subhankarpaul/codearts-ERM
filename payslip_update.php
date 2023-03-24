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
    <?php
        $id = $_GET['id'];
        $query = "SELECT * FROM capms_payslips WHERE id ='" . $id . "'";
        $query_run = mysqli_query($con, $query);
        $data = mysqli_fetch_assoc($query_run);
    ?>
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
                                <li><a href="<?php echo $baseURL; ?>payslip_add.php">Update Employee Pay Slip</a></li>
                            </ul>
                        </section>
                        <div id="myDIV">
                                <h1 style="text-decoration: underline;" class="text-center">Update Payslip </h1>
                                <form style="padding-top: 120px; padding-left: 130px;" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="salarymonth">Salary of (month and year):</label>
                                        <input type="month" id="salarymonth" name="salarymonth" value="<?php echo $data["salary_month"] ?>" readonly="readonly">
                                    </div>
                                    <div class="form-group">
                                        <label for="payslip">Choose file...</label>
                                        <input type="file" id="payslip" name="payslip" accept="application/pdf" hidden="hidden">
                                        <button type="button" id="customBtn"> Choose File</button>
                                        <span id="customTxt"><?php echo $data["payslip"]; ?></span>
                                    </div>
                                    <input type="submit" name="emppayslipUpdate" value="Update" class="btn btn-primary"> 
                                </form>
                            </div>
                            <?php
                            if(isset($_POST['emppayslipUpdate'])){
                                if($_POST['salarymonth']!= $data['salary_month']){
                                    echo "<p class='text-danger'>Month can't be Updated.</p>";
                                }
                                else{
                                    if(isset($_FILES['payslip']['name']))
                                    {
                                        $sql1 = "UPDATE `capms_payslips` SET `updated_at`='".date('Y-m-d h:i:s', strtotime('now'))."' WHERE id= '".$_REQUEST['id']."'";
                                        $result1 = mysqli_query($con, $sql1);
                                        $last_payslip_id = $_REQUEST['id'];
                                        if($last_payslip_id){
                                            if(isset($_FILES['payslip']['name']))
                                            {
                                                $tmpFileName = $_FILES['payslip']['tmp_name'];
                                                if($tmpFileName != "")
                                                {
                                                    $shortname = $_FILES['payslip']['name'];
                                                    $timestamp = strtotime('now').'-'.$_FILES['payslip']['name'];
                                                    $filename = $_FILES['payslip']['name'];
                                                    $filePath = "assets/payslips/" .$timestamp;
                                                    
                                                    if(move_uploaded_file($tmpFileName, $filePath))
                                                    {
                                                        $sql3 = "UPDATE capms_payslips SET payslip = '".$timestamp."' WHERE id = '".$last_payslip_id."' ";
                                                        mysqli_query($con, $sql3);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    else{
                                        echo "<p class='text-danger'>Please attach the payslip first.</p>";
                                    }
                                }
                                echo '<script>window.location="employee_payslip_add.php?user_id='.$data["user_id"].'"</script>';
                            }
                            ?>
                        </div>
                        <script type="text/javascript">
                            const file= document.getElementById('payslip');
                            const btn= document.getElementById('customBtn');
                            const txt= document.getElementById('customTxt');

                            btn.addEventListener("click", function(){
                                payslip.click();
                            });

                            file.addEventListener("change", function(){
                                if(!file.value){
                                    txt.innerHTML ="<?php echo $data["payslip"]; ?>";

                                } else{
                                    txt.innerHTML = file.value.replace(/^.*[\\\/]/, '');
                                }
                            })
                        </script>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
<?php
}
?>