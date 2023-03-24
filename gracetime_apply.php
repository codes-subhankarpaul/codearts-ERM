<?php 
session_start();
if ($_SESSION['emp_type'] != "employee") { 
    // echo "<script>location.href='gracetime.php';</script>";
}
else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header_css.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Gracetime - CERM :: Codearts Employee Relationship Management</title>
</head>
<body>
    <style>
        .clockpicker-tick-disabled {
            border-radius: 50%;
            color: rgb(192, 192, 192);
            line-height: 26px;
            text-align: center;
            width: 26px;
            height: 26px;
            position: absolute;
            cursor: not-allowed;
        }
    </style>
    <!-- create notice update file for git hub -->
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
                            <h2>Gracetime</h2>
                            <ul>
                                <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                <li>Gracetime</li>
                            </ul>
                        </section>
                        <section class="py-3">
                            <form method="POST">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="gracetime_date">Date</label>
                                            <input type="text" class="form-control" id="gracetime_date" name="gracetime_date" placeholder="Enter gracetime date" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group clockpicker">
                                            <label for="gracetime_taken">Time</label>
                                            <input type="text" class="form-control" id="gracetime_taken" name="gracetime_taken" placeholder="Enter gracetime" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="reason">Reason</label> 
                                        <textarea class="form-control" id="reason" name="reason">Enter your reason here</textarea>
                                    </div>
                                </div>
                                <hr class="py-3">
                                <button type="submit" class="btn btn-primary w-100" name="apply_gracetime">Submit</button>
                            </form>
                            <?php
                                if(isset($_POST['apply_gracetime'])){
                                    $created_at = date('Y-m-d h:i:s', strtotime('now'));
                                    $updated_at = date('Y-m-d h:i:s', strtotime('now'));

                                    $sql_gracetime = "INSERT INTO `capms_gracetime_info`(`user_id`, `gracetime_date`, `gracetime_taken`, `reason`, `status`, `feedback`, `created_at`, `updated_at`) VALUES ('".$_SESSION['emp_id']."','".$_POST['gracetime_date']."','".$_POST['gracetime_taken']."','".$_POST['reason']."','0','','".$created_at."','".$updated_at."')";

                                    if($con->query($sql_gracetime) === TRUE) {
                                        echo "<script>location.href='".$baseURL."gracetime.php';</script>";
                                    }
                                    else {
                                        echo "Error: " . $sql_gracetime . "<br>" . $con->error;
                                    }
                                }
                            ?>
                        </section>
                    </div>
                </div>
            </div>
        </div>     
    </main>

    <!-- CDNS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://jqueryui.com//resources/demos/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap-clockpicker.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="assets/js/bootstrap-clockpicker.js"></script>
    
    <script src="https://cdn.tiny.cloud/1/04z7u7156gqei101i37ypflfj99zptjgbodnyi91ni0bs5je/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: 'textarea#reason',
        menubar: false
    });
    </script>

    <!-- CLOCK WIDGETS -->
    <!-- <script type="text/javascript">
    $('.clockpicker').clockpicker({
        placement: 'bottom',
        align: 'left',
        donetext: 'Done',
        autoclose: true,
        // twelvehour: true
    });
    </script> -->

    <?php
        // for every grace time input if there is any previous gracetime, use that for calculation and find minute_max value
        $check_month = date('m');
        $minute_max = '';
        // SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(gracetime_date,'/',1),'/',2) AS gracetime_month from `capms_gracetime_info` where user_id=17 group by gracetime_month;
        $sql_gracetime = "SELECT gracetime_taken, SUBSTRING_INDEX(SUBSTRING_INDEX(gracetime_date,'/',1),'/',2) AS gracetime_month from `capms_gracetime_info` where user_id='".$_SESSION['emp_id']."' and status='1' or status='0' group by gracetime_month having gracetime_month='".$check_month."';";
        $result_gracetime = mysqli_query($con,$sql_gracetime);
        if($result_gracetime->num_rows>0) {
            while($row_gracetime = mysqli_fetch_assoc($result_gracetime)) {
                $minute_max = $row_gracetime['gracetime_taken'];
            }
        }
    ?>

    <script type="text/javascript">
        var minute_min = 0;
        var minute_max = <?php if($minute_max==''){ echo '60';}else {$remaining_max = 60-(int)explode(":",$minute_max)[1]; echo $remaining_max;}?>;
        var ticksDisabled = false;

        // Handlers to toggle the "hiddenTicksDisabled"
        $(document).on("mouseenter",".clockpicker-hours>.clockpicker-tick-disabled",function(e){
            ticksDisabled = true;  
        });
                
        $(document).on("mouseenter",".clockpicker-hours>.clockpicker-tick",function(e){
            ticksDisabled = false;  
        });
        
        var input = $('#gracetime_taken').clockpicker({
            placement: 'bottom',
            align: 'left',
            autoclose: true,
            afterShow: function() {  // Disable all hours out of range
                $(".clockpicker-minutes").find(".clockpicker-tick").filter(function(index,element){
                    return !(parseInt($(element).html()) >= minute_min && parseInt($(element).html()) <= minute_max);      
                }).removeClass('clockpicker-tick').addClass('clockpicker-tick-disabled');
            },
            // twelvehour: true
        });

        // Manually toggle to the minutes view
        $('#gracetime_taken').click(function(e){
            // Have to stop propagation here
            e.stopPropagation();
            input.clockpicker('show')
                    .clockpicker('toggleView', 'minutes');
        });
    </script>

    <!-- DATE VALIDATION -->
    <script>
        $("#gracetime_date").datepicker({
            onSelect: function(dateText, inst) {
                var date = $(this).val();
                // console.log(date);
                var fullDate = new Date();
                var twoDigitMonth = ((fullDate.getMonth().length + 1) === 1) ? (fullDate.getMonth() + 1) : '0' + (fullDate.getMonth() + 1);
                var currentDate = fullDate.getDate() + "/" + twoDigitMonth + "/" + fullDate.getFullYear();
                // console.log(currentDate);
                var fullDateObj = new Date(date);
                var currentDateObj = new Date();
                currentDateObj.setDate(currentDateObj.getDate() - 1);
                if (fullDateObj < currentDateObj) {
                alert("Past date not allowed!!!");
                $.datepicker._clearDate(this);
                }
            }
        });
    </script>
</body>
</html>

<?php
}
?>

