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
                                    <li><a href="<?php echo $baseURL; ?>payslip.php">Pay Slip</a></li>
                                </ul>
                                <?php if($_SESSION['emp_type'] == 'hr' || $_SESSION['emp_type'] == 'admin' ) { ?>
                                <a class="add-employee-btn" href="payslip_add.php">
                                    <span class="add-icon">+</span> Add Payslip
                                </a>
                                <?php } ?>
                                <a href="payslip_details.php">Payslip</a>
                            </section>
                            <!-- <section class="pay-slip-table" style="text-align:center ;">
                                <button type="submit"><a href="payslip_details.php">view</a></button>
                            </section> -->
                            <form method="POST" enctype="multipart/form-data" action="payslip.php">
                                <label for="salarymonth">Salary of (month and year):</label>
                                <input type="month" id="salarymonth" name="salarymonth" required>
                                <input type="submit" name="payslipView" value="View Payslip" class="btn btn-primary"> 
                            </form>
                            <?php
                                if(isset($_POST['payslipView'])){
                                    if($_POST['salarymonth']==''){
                                        echo "Select the month first";
                                    }
                                    else{
                                        $query = "SELECT * FROM `capms_payslips` WHERE user_id='".$_SESSION['emp_id']."' and salary_month = '".$_POST['salarymonth']."';";
                                        $query_run = mysqli_query($con, $query);
                                        if($query_run->num_rows > 0){
                                            while ($row = $query_run->fetch_assoc()) {
                                                $pdf = $row['payslip'];
                                                $filePath = "assets/payslips/" .$pdf;
                                            }
                                            echo '<h1>Payslip</h1>';
                            ?>
                                            <br/><br/>
                                            <iframe src="<?php echo $filePath; ?>" width="90%" height="500px"></iframe>
                                            <button type="submit" class="btn btn-success"><a href="<?php echo $filePath; ?>" download>Download</a></button>
                            <?php
                                        }
                                        else{
                                            echo '<h1>No record found for this month.</h1>';
                                        }
                                    }
                                }
                            ?>
                            
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

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $(document).ready(function() {
                $('#txtDate').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'MM yy',
                    
                    onClose: function() {
                        var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
                    },
                    
                    beforeShow: function() {
                    if ((selDate = $(this).val()).length > 0) 
                    {
                        iYear = selDate.substring(selDate.length - 4, selDate.length);
                        iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), $(this).datepicker('option', 'monthNames'));
                        $(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
                        $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
                    }
                    }
                });
                });
        </script>
    </body>
</html>