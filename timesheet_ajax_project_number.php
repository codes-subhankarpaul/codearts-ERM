<?php
require_once "database.php";
$project_id = $_POST["project_id"];
$sql = "SELECT project_number FROM `capms_project_info` WHERE `project_id` = $project_id";
$result1 = mysqli_query($con, $sql);
?>

<?php
    while ($row = mysqli_fetch_array($result1)) {
        echo $row["project_number"];
    }
?>