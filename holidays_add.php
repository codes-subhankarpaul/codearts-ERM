<?php
session_start();
if ($_SESSION['emp_type'] != "hr" && $_SESSION['emp_type'] != "admin") { 
        header("Location: holidays_view.php");
}

else{
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Header CSS files -->
    <?php include 'header_css.php'; ?>
    <title>Add Holidays - CERM :: Codearts Employee Relationship Management</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        // var dates = ["20/01/2018", "21/01/2018", "22/01/2018", "23/01/2018"];
        // function DisableDates(date) {
        //     var string = jQuery.datepicker.formatDate('dd/mm/yy', date);
        //     return [dates.indexOf(string) == -1];
        // }
        $(function() {

            $("#start_date").datepicker({
                // beforeShowDay: DisableDates
                onSelect: function(dateText, inst) {
                    const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                    var date = $(this).val();
                    console.log(date);
                    var fullDate = new Date();
                    var twoDigitMonth = ((fullDate.getMonth().length + 1) === 1) ? (fullDate.getMonth() + 1) : '0' + (fullDate.getMonth() + 1);
                    var currentDate = twoDigitMonth + "/" + fullDate.getDate() + "/" + fullDate.getFullYear();
                    console.log(currentDate);
                    var fullDateObj = new Date(date);
                    var currentDateObj = new Date();
                    if (fullDateObj < currentDateObj) {
                        // console.log(currentDateObj.getMonth()+1);
                        if(fullDateObj.getDate() === currentDateObj.getDate()){
                            display(weekday[new Date(dateText).getDay()]);
                        }
                        if (fullDateObj.getMonth() < currentDateObj.getMonth()) {
                            alert("Previous date not allowed!!!");
                            $.datepicker._clearDate(this);
                        } else if (fullDateObj.getDate() < currentDateObj.getDate()) {
                            alert("Previous date not allowed!!!");
                            $.datepicker._clearDate(this);
                        }
                    }
                    display(weekday[new Date(dateText).getDay()]);

                }
                //   }).on("change", function() {
                //     display("Change event");
            });

            function display(msg) {
                if($("#start_date").val() != ''){
                    $("#start_day").val(msg);
                }
                else{
                    $("#start_day").val('');
                }
            }
        });
        $(function() {
            $("#end_date").datepicker({
                onSelect: function(dateText, inst) {
                    if ($("#start_date").val() == '') {
                        // alert("Please enter start date first.");
                        $.datepicker._clearDate(this);
                    } else {
                        const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                        var date = $(this).val();
                        console.log(date);
                        var s_date = $("#start_date").val();
                        console.log("This is start_date " + s_date);
                        var st_date = new Date(s_date);
                        var e_date = new Date(date);
                        if (e_date < st_date) {
                            alert("End date can't be previous date from start date");
                            $.datepicker._clearDate(this);
                        } else {
                            var fullDate = new Date();
                            var twoDigitMonth = ((fullDate.getMonth().length + 1) === 1) ? (fullDate.getMonth() + 1) : '0' + (fullDate.getMonth() + 1);
                            var currentDate = twoDigitMonth + "/" + fullDate.getDate() + "/" + fullDate.getFullYear();
                            console.log(currentDate);
                            var fullDateObj = new Date(date);
                            var currentDateObj = new Date();
                            if (fullDateObj < currentDateObj) {
                                // console.log(currentDateObj.getMonth()+1);
                                if (fullDateObj.getDate() === currentDateObj.getDate()){
                                    display(weekday[new Date(dateText).getDay()]);
                                }
                                if (fullDateObj.getMonth() < currentDateObj.getMonth()){
                                    alert("Previous date not allowed!!!");
                                    $.datepicker._clearDate(this);
                                }
                                else if(fullDateObj.getDate() < currentDateObj.getDate()){
                                    alert("Previous date not allowed!!!");
                                    $.datepicker._clearDate(this);
                                }
                            }
                            display(weekday[new Date(dateText).getDay()]);
                        }

                    }

                }
                //   }).on("change", function() {
                //     display("Change event");
            });

            function display(mess) {
                $("#end_day").val(mess);
            }
    });
    </script>
</head>
<?php
if ($_SESSION['emp_id'] == '') {
    echo "<script>location.href='".$baseURL."login.php';</script>";
}

?>

<?php

$sql = "SELECT * FROM capms_admin_users";
$result = $con->query($sql);
$names = '[';

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $names .= '"' . $row["user_fullname"] . '"' . ",";
    }
} else {
}
$names .= "]";
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
    <?php
    require_once('database.php');
    $errstartdatemsg = "";
    $errsdmsg = "";
    $errtdmsg = "";
    if (isset($_POST['add'])) {
        $occasion = $_POST['occasion'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $start_day = $_POST['start_day'];
        $end_day = $_POST['end_day'];
        $remarks = $_POST['remarks'];

        $today = date("m/d/Y");

        $td = strtotime($today);
        $sd = strtotime($start_date);
        $ed = strtotime($end_date);
        if ($start_date == "" || $end_date == "") {
            $errstartdatemsg = "Start Date or End Date is missing";
        } else {

            if ($sd < $td) {
                $errtdmsg = "Start date atleast be today";
            } else {
                if ($sd > $ed) {
                    $errsdmsg = "End date must be future date";
                } else {

                    $query = "INSERT INTO `capms_holidays`(`id`,`occasion`, `start_dates`, `end_dates`, `start_day`, `end_day`,`remarks`) VALUES (NULL,'" . $occasion . "','" . $start_date . "','" . $end_date . "','" . $start_day . "','" . $end_day . "','" . $remarks . "')";
                    $query_run = mysqli_query($con, $query);
                    if ($query_run) {
                        // header('location: holidays_view.php');
                        echo '<script>window.location="holidays_view.php"</script>';
                        // <script type="text/javascript">
                        // window.location
                        // 
                    } else {
                        echo "fail";
                    }
                }
            }
        }
    }

    ?>
    <main class="custom-dahboard-main">
        <div class="custom-page-wrap-dp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <?php include 'dashboard.php'; ?>
                    </div>
                    <div class="col-lg-9">
                        <section class="inner-head-brd">
                            <h2>Holidays</h2>
                            <ul>
                                <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                <li>Add</li>
                            </ul>

                        </section>
                        <form method="post" action="holidays_add.php">
                            <div class="mb-3">
                                <label for="occasion" class="form-label">Occasion</label>
                                <input type="text" class="form-control" name="occasion" required>
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="text" id="start_date" class='date' name="start_date" readonly="readonly" />
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="text" id="end_date" class='dateP' name="end_date" readonly="readonly" />
                                <span><?php echo $errstartdatemsg; ?></span>
                                <span><?php echo $errsdmsg; ?></span>
                                <span><?php echo $errtdmsg; ?></span>
                            </div>
                            <div class="mb-3">
                                <label for="start_day" class="form-label">Start Day</label>
                                <input type="text" id="start_day" name="start_day" readonly class="form-control">
                                <label for="end_day" class="form-label">End Day</label>
                                <input type="text" id="end_day" name="end_day" readonly class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks#</label>
                                <input type="text" id="remarks" name="remarks" class="form-control">
                            </div>
                            <input type="submit" value="Add" name="add" class="btn btn-primary">
                            <button onclick="location.href='holidays_view.php'" class="btn btn-primary">View</button>
                        </form>
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