<?php
require_once "database.php";
$task_id = $_POST["task_id"];

echo $sql = "SELECT * FROM capms_project_task_info JOIN capms_user_workload_info ON capms_project_task_info.task_id = capms_user_workload_info.task_id join `capms_project_tasktype_info` on capms_project_task_info.task_type = capms_project_tasktype_info.task_type_id Where capms_user_workload_info.user_id = " . $_SESSION['emp_id'] . " LIMIT 0, 25;";
$result = mysqli_query($con, $sql);
?>
<option value="" selected>select task_id</option>
<?php
while ($row = mysqli_fetch_array($result)) {
    if(isset($_SESSION['task_id'])) {
        $selected = "selected";
        echo '<option value="' . $row['task_type'] . '" ' . $selected . '>' . $row["task_type_name"] . '</option>';
    }
    else {
        echo '<option value="' . $row['task_type'] . '">' . $row["task_type_name"] . '</option>';
    }
}
unset($_SESSION['task_id']);
?>