<?php
require_once "database.php";
$project_id = $_POST["project_id"];

$sql = "SELECT * FROM capms_project_task_info JOIN capms_user_workload_info ON capms_project_task_info.task_id = capms_user_workload_info.task_id Where capms_user_workload_info.project_id = " . $project_id . " AND capms_user_workload_info.user_id = " . $_SESSION['emp_id'] . " AND capms_user_workload_info.status = 1 AND capms_project_task_info.task_status = 1 LIMIT 0, 25;";
$result1 = mysqli_query($con, $sql);

?>
<option value="" selected>select task_name</option>

<?php
while ($row = mysqli_fetch_array($result1)) {
    // if(isset($_SESSION['workload_id'])) {
    //     unset($_SESSION['workload_id']);
    // }
    // $_SESSION['workload_id'] = $row['workload_id'];
    
    // if (isset($_SESSION['task_id'])) {
    //     $selected = "";
    //     if ($row['task_id'] == $_SESSION['task_id']) {
    //         $selected = 'selected';
    //     }
    //     echo '<option value="' . $row['task_id'] . '" ' . $selected . '>' . $row["task_name"] . '</option>';
    // }
    echo '<option value="' . $row['workload_id'] . '">' . $row["task_name"] . '</option>';
}
// unset($_SESSION['task_id']);
?>