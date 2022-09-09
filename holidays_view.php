<?php
require_once('database.php');
$year = date("Y");
// $query1="SELECT start_dates FROM capms_holidays ORDER BY str_to_date(`start_dates`, '%m/%d/%Y') DESC";
// $query1_run=mysqli_query($conn,$query);
$query = "SELECT * FROM capms_holidays WHERE start_dates LIKE '%/$year' ORDER BY str_to_date(`start_dates`, '%m/%d/%Y')";
$query_run = mysqli_query($con, $query);
?>

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

            $(".date").datepicker({

                onSelect: function(dateText) {
                    display("Selected date: " + dateText + ", Current Selected Value= " + this.value);
                    const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                    display(weekday[new Date(dateText).getDay()]);
                    $(this).change();
                }
                //   }).on("change", function() {
                //     display("Change event");
            });

            function display(msg) {
                $("#start_day").val(msg);
            }
        });
        $(function() {
            $(".dateP").datepicker({

                onSelect: function(dateText) {
                    display("Selected date: " + dateText + ", Current Selected Value= " + this.value);
                    const weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                    display(weekday[new Date(dateText).getDay()]);
                    $(this).change();
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
                            <h2>Holidays</h2>
                            <ul>
                                <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                <li>View</li>
                            </ul>

                        </section>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Occasion</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Start Day</th>
                                    <th>End Day</th>
                                    <th>Remarks#</th>
                                    <?php if ($_SESSION['emp_type'] == "admin" || $_SESSION['emp_type'] == "hr") { ?>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                                    <tr>
                                        <th><?php echo ($row["occasion"]) ?></th>
                                        <td><?php echo ($row["start_dates"]) ?></td>
                                        <td><?php echo ($row["end_dates"]) ?></td>
                                        <td><?php echo ($row["start_day"]) ?></td>
                                        <td><?php echo ($row["end_day"]) ?></td>
                                        <td><?php echo ($row["remarks"]) ?></td>
                                        <?php if ($_SESSION['emp_type'] == "admin" || $_SESSION['emp_type'] == "hr") { ?>
                                            <td><button onclick="location.href='holidays_edit.php?id=<?php echo $row['id'] ?>';" class="btn btn-primary">Edit</button></td>
                                            <td><a href="holidays_delete.php?id=<?php echo $row["id"];?>" onclick="return confirm('Are you sure to delete?')" class="btn btn-primary">Delete</a></td>
                                        <?php } ?>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php if ($_SESSION['emp_type'] === "admin" || $_SESSION['emp_type'] === "hr") { ?>
                            <button onclick="location.href='holidays_add.php'" class="btn btn-primary">ADD HOLIDAYS</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>