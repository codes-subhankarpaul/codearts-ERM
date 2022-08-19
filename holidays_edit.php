<!doctype html>
<html lang="en">

<head>
    <!-- Header CSS files -->
    <?php include 'header_css.php'; ?>
    <title>Projects - CERM :: Codearts Employee Relationship Management</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {

            $("#start_date").datepicker({

                onSelect: function(dateText, inst) {

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
                        if (fullDateObj.getMonth() < currentDateObj.getMonth()) {
                            alert("Previous date not allowed!!!");
                            $.datepicker._clearDate(this);
                        } else if (fullDateObj.getDate() < currentDateObj.getDate()) {
                            alert("Previous date not allowed!!!");
                            $.datepicker._clearDate(this);
                        }
                    }
                    if ($(this).val() == '') {
                        // alert("Please enter start date first.");
                        $.datepicker._clearDate($("#end_date"));
                    } else {
                        var e_date = $("#end_date").val();
                        var st_date = new Date(date);
                        var e_date = new Date(e_date);
                        if (e_date < st_date) {
                            alert("End date can't be previous date from start date");
                            $.datepicker._clearDate($("#end_date"));
                        } else {
                            var fullDate = new Date();
                            var twoDigitMonth = ((fullDate.getMonth().length + 1) === 1) ? (fullDate.getMonth() + 1) : '0' + (fullDate.getMonth() + 1);
                            var currentDate = twoDigitMonth + "/" + fullDate.getDate() + "/" + fullDate.getFullYear();
                            console.log(currentDate);
                            var fullDateObj = new Date(e_date);
                            var currentDateObj = new Date();
                            if (fullDateObj < currentDateObj) {
                                // console.log(currentDateObj.getMonth()+1);
                                if (fullDateObj.getDate() < currentDateObj.getDate()) {
                                    alert("Previous date not allowed!!!");
                                    $.datepicker._clearDate($("#end_date"));
                                }
                            }
                        }
                    }
                    const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                    display(weekday[new Date(dateText).getDay()]);
                }
            });

            function display(msg) {
                $("#start_day").val(msg);
            }
        });
        $(function() {
            $("#end_date").datepicker({

                onSelect: function(dateText, inst) {
                    if ($("#start_date").val() == '') {
                        // alert("Please enter start date first.");
                        $.datepicker._clearDate(this);
                    } else {
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
                                if (fullDateObj.getDate() < currentDateObj.getDate()) {
                                    alert("Previous date not allowed!!!");
                                    $.datepicker._clearDate(this);
                                }
                            }
                        }
                        const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                        display(weekday[new Date(dateText).getDay()]);
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
    echo "<script>location.href='http://localhost/codearts/login.php';</script>";
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

<?php
require_once('database.php');
$sid = $_GET['id'];
$query = "SELECT * FROM capms_holidays WHERE id ='" . $sid . "'";
$query_run = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($query_run);
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
    $errstartdatemsg = "";
    $errsdmsg = "";
    $errtdmsg = "";
    if (isset($_POST['update'])) {
        $occasion = $_POST['edit_occasion'];
        $start_date = $_POST['edit_start_date'];
        $end_date = $_POST['edit_end_date'];
        $start_day = $_POST['edit_start_day'];
        $end_day = $_POST['edit_end_day'];
        $remarks = $_POST['edit_remarks'];

        // $today = date("m/d/Y");

        // $td = strtotime($today);
        // $sd = strtotime($start_date);
        // $ed = strtotime($end_date);
        // if ($start_date == "" || $end_date == "") {
        //     $errstartdatemsg = "Start Date or End Date is missing";
        // } else {

        //     if ($sd < $td) {
        //         $errtdmsg = "Start date atleast be today";
        //     } else {
        //         if ($sd > $ed) {
        //             $errsdmsg = "End date must be future date";
        //         } else {

                    $sql1 = "UPDATE `capms_holidays` SET `occasion`='" . $occasion . "',`start_dates`='" . $start_date . "',`end_dates`='" . $end_date . "',`start_day`='" . $start_day . "',`end_day`='" . $end_day . "',`remarks`='" . $remarks . "' WHERE `id`='" . $_REQUEST['id'] . "'";
                    $sql1_run = mysqli_query($con, $sql1);
                    if ($sql1_run) {
                        // exit(header('location: holidays_view.php'));
                        echo '<script>window.location="holidays_view.php"</script>';
                    } else {
                        echo "fail";
                    }
        //         }
        //     }
        // }
    }

    // function isPrevious($date1, $date2)
    // {
    //     $d1 = strtotime($date1);
    //     $d2 = strtotime($date2);
    //     // $dt1=date('m-d-Y',$d1);
    //     // $dt2=date('m-d-Y',$d2);
    //     // $dt1= explode('/',$dt1);
    //     // $dt2=explode('/',$dt2);
    //     // $year1 = $dt1[2];
    //     // $day1 = $dt1[1];
    //     // $month1=$dt1[0];
    //     // $year2= $dt2[2];
    //     // $day2 = $dt2[1];
    //     // $month2 = $dt2[0];
    //     // if($year1<$year2){
    //     //     echo "You can't add previous year date";
    //     // }
    //     // else{
    //     //     if($month1<$month2){
    //     //         echo "You can't add previous month";
    //     //     }
    //     //     else{
    //     //         if($day1<$day2){

    //     //         }
    //     //     }
    //     // }
    //     if ($d1 < $d2) {
    //         echo "<script> alert('You have selected previous date.');</script>";
    //         return 0;
    //     } else {
    //         return 1;
    //     }
    // }
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
                                <li>Edit</li>
                            </ul>

                        </section>
                        <form method="post" action="holidays_edit.php?id=<?php echo $_REQUEST['id']?>">
                            <div class="mb-3">
                                <label for="occasion" class="form-label">Occasion</label>
                                <input type="text" class="form-control" name="edit_occasion" value='<?php echo $data["occasion"] ?>' required>
                            </div>
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="text" id="start_date" class='date' name="edit_start_date" value='<?php echo $data["start_dates"] ?>' readonly="readonly" />
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="text" id="end_date" class='dateP' name="edit_end_date" value='<?php echo $data["end_dates"] ?>' readonly="readonly" />
                                
                            </div>
                            <div class="mb-3">
                                <label for="start_day" class="form-label">Start Day</label>
                                <input type="text" id="start_day" name="edit_start_day" value='<?php echo $data["start_day"] ?>' readonly class="form-control">
                                <label for="end_day" class="form-label">End Day</label>
                                <input type="text" id="end_day" name="edit_end_day" value='<?php echo $data["end_day"] ?>' readonly class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks#</label>
                                <input type="text" id="remarks" name="edit_remarks" value='<?php echo $data["remarks"] ?>' class="form-control">
                            </div>
                            <input type="submit" value="Update" name="update" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>