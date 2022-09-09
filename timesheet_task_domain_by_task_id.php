<?php
require_once "database.php";
$workload_id = $_POST["task_id"];
$task_category = $_POST["task_category"];


if($task_category==1) {
    // echo $sql = "SELECT * FROM capms_project_task_info JOIN capms_user_workload_info ON capms_project_task_info.task_id = capms_user_workload_info.task_id join `capms_department_info` on capms_project_task_info.task_domain = capms_department_info.dept_id Where capms_user_workload_info.task_id = " . $task_id . " AND capms_user_workload_info.user_id = " . $_SESSION['emp_id'] . " LIMIT 0, 25;";
    $sql = "SELECT * FROM `capms_user_workload_info` WHERE `workload_id` = '".$workload_id."'";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result)) {
        $sql1 = "SELECT * FROM `capms_project_task_info` WHERE `task_id` = '".$row['task_id']."'";
        $result1 = mysqli_query($con, $sql1);
        while ($row1 = mysqli_fetch_array($result1)) {
            $sql2 = "SELECT * FROM `capms_department_info` WHERE `dept_id` = '".$row1['task_domain']."'";
            $result2 = mysqli_query($con, $sql2);
            while ($row2 = mysqli_fetch_array($result2)) {
                $selected = "selected";
                echo '<option value="' . $row2['dept_id'] . '" ' . $selected . '>' . $row2["dept_name"] . '</option>';
            }
        }
    }
}
else if($task_category == 0) {
    $result = mysqli_query($con, "SELECT * FROM `capms_department_info`");
    while ($row = mysqli_fetch_array($result)) {
        $selected = "";
        echo '<option value="' . $row['dept_id'] . '" ' . $selected . '>' . $row["dept_name"] . '</option>';
    }
}
else {
    echo '<option value="waiting..  "</option>';
}


?>


