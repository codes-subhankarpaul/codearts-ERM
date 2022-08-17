<?php
require_once "database.php";
$task_id = $_POST["task_id"];

echo $sql = "SELECT * FROM capms_project_task_info JOIN capms_user_workload_info ON capms_project_task_info.task_id = capms_user_workload_info.task_id join `capms_department_info` on capms_project_task_info.task_domain = capms_department_info.dept_id Where capms_user_workload_info.task_id = " . $task_id . " AND capms_user_workload_info.user_id = " . $_SESSION['emp_id'] . " LIMIT 0, 25;";
$result = mysqli_query($con, $sql);
?>
<!-- <option value="" selected>select task_id</option> -->

<?php
while ($row = mysqli_fetch_array($result)) {
    $selected = "selected";
    echo '<option value="' . $row['task_domain'] . '" ' . $selected . '>' . $row["dept_name"] . '</option>';
}
?>