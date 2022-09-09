<?php
require_once "database.php";
$workload_id = $_POST["workload_id"];
$sql = "SELECT DISTINCT capms_project_task_info.task_number FROM capms_user_workload_info inner join capms_project_task_info on capms_user_workload_info.task_id = capms_project_task_info.task_id WHERE capms_user_workload_info.workload_id = '".$workload_id."'";
$result = mysqli_query($con, $sql);
?>

<?php
    while ($row = mysqli_fetch_array($result)) {
        echo $row["task_number"];
    }
?>