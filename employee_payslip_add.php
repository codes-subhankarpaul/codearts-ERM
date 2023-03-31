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
        <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }

            td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            }

            tr:nth-child(even) {

            background-color: #dddddd;
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
                                    <li><a href="<?php echo $baseURL; ?>payslip_add.php">Add Employee Pay Slip</a></li>
                                </ul>
                            </section>
                            <table>
                                <tr>
                                    <th>#</th>
                                    <th>Salary Month and Year</th>
                                    <th>Payslip</th>
                                    <th>Create Date</th>
                                    <th>Update Date</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                <?php
                                    $i = 1;
                                    $query = "SELECT * FROM capms_payslips WHERE user_id='".$_REQUEST['user_id']."'";
                                    $result = mysqli_query($con, $query);
                                    if($result->num_rows > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i++;?></th>
                                    <td><?php echo $row['salary_month']; ?></td>
                                    <td><a href="assets\payslips\<?php echo $row['payslip']; ?>" download><?php echo $row['payslip']; ?></a></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td><?php echo $row['updated_at']; ?></td>
                                    <?php if ($_SESSION['emp_type'] == "hr" || $_SESSION['emp_type'] == "admin") { ?>
                                    <td><form method="POST" action="payslip_view.php?id=<?php echo $row['id']?>"><input type="submit" name="payslipView" value="View" class="btn btn-light"></form></td>
                                    <td><form method="POST" action="payslip_update.php?id=<?php echo $row['id']?>"><input type="submit" name="payslipUpdate" value="Update" class="btn btn-light"></form></td>
                                    <?php } ?>
                                </tr>
                                <?php
                                        }
                                    }
                                ?>
                            </table>
                            <br/><br/>
                            <button onclick="myFunctionshow()" class="btn btn-primary" id="btn">Add</button>
                            <div id="myDIV" style="display:none;">
                                <h1 style="text-decoration: underline;" class="text-center">Add Payslip </h1>
                                <form style="padding-top: 120px; padding-left: 130px;" method="POST" enctype="multipart/form-data" action="employee_payslip_add.php?user_id=<?php echo $_REQUEST['user_id']?>">
                                    <div class="form-group">
                                        <label for="salarymonth">Salary of (month and year):</label>
                                        <input type="month" id="salarymonth" name="salarymonth" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="payslip">Choose file...</label>
                                        <input type="file" id="payslip" name="payslip" accept="application/pdf" required>
                                    </div>
                                    <input type="submit" name="payslipAdd" value="Add" class="btn btn-primary">
                                    <button onclick="myFunctionhide()" class="btn btn-primary" id="cancelBtn">Cancel</button>
                                </form>
                            </div>
                            <?php
                            if(isset($_POST['payslipAdd'])){
                                if($_POST['salarymonth']==''){
                                    echo "Select the month first";
                                }
                                else{
                                    if(isset($_FILES['payslip']['name']))
                                    {
                                        $sql1 = "SELECT * FROM `capms_payslips` WHERE salary_month = '".$_POST['salarymonth']."' AND user_id = '".$_REQUEST['user_id']."' ";
                                        $result1 = mysqli_query($con, $sql1);
                                        if($result1->num_rows > 0)
                                        {
                                            echo "<p class='register-error text-danger'>Salary Paid.</p>";
                                        }
                                        else
                                        {
                                            $query = "INSERT INTO `capms_payslips`(`user_id`, `salary_month`, `payslip`, `created_at`, `updated_at`) VALUES ('".$_REQUEST['user_id']."','".$_POST['salarymonth']."','','".date('Y-m-d h:i:s', strtotime('now'))."', '".date('Y-m-d h:i:s', strtotime('now'))."')";
                                            
                                            mysqli_query($con, $query);
                                            $last_payslip_id = $con->insert_id;
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
                                            echo '<script>window.location="payslip_add.php"</script>';
                                        }
                                    }
                                    else{
                                        echo "<p class='text-danger'>Please attach the payslip first.</p>";
                                    }
                                }
                            }
                            ?>
                        </div>
                        <script>
                            function myFunctionshow() {
                            var x = document.getElementById("myDIV");
                            const btn = document.getElementById('btn');
                            const cbtn = document.getElementById('cancelBtn');
                            if (x.style.display === "none") {
                                x.style.display = "block";
                                btn.style.display = 'none';
                            }
                            }
                            function myFunctionhide() {
                            var x = document.getElementById("myDIV");
                            const btn = document.getElementById('btn');
                            const cbtn = document.getElementById('cancelBtn');
                            if (x.style.display === "block") {
                                x.style.display = "none";
                                btn.style.display = 'block';
                            }
                            }
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