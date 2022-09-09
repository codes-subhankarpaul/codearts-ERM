<?php
require_once "database.php";
$workload_id = $_POST["task_id"];
$task_category = $_POST["task_category"];

if($task_category==1) {
    $sql = "SELECT * FROM `capms_user_workload_info` WHERE `workload_id` = '".$workload_id."'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $sql1 = "SELECT * FROM `capms_project_task_info` WHERE `task_id` = '".$row['task_id']."'";
        $result1 = mysqli_query($con, $sql1);
        while ($row1 = mysqli_fetch_array($result1)) {
            $sql2 = "SELECT * FROM `capms_project_tasktype_info` WHERE `task_type_id` = '".$row1['task_type']."'";
            $result2 = mysqli_query($con, $sql2);
            while ($row2 = mysqli_fetch_array($result2)) {
                $selected = "selected";
                echo '<option value="' . $row2['task_type_id'] . '" ' . $selected . '>' . $row2["task_type_name"] . '</option>';
            }
        }
    }
}
else if($task_category == 0) {
    $result = mysqli_query($con, "SELECT * FROM `capms_project_task_info` as cpti right join capms_project_tasktype_info as cptti on cpti.task_id = cptti.task_type_id;");
    while ($row = mysqli_fetch_array($result)) {
        $selected = "";
        echo '<option value="' . $row['task_type_id'] . '" ' . $selected . '>' . $row["task_type_name"] . '</option>';
    }
}
else {
    echo '<option value="waiting.."</option>';
}
?>