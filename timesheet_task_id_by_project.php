<?php
    require_once "database.php";
    $project_id = $_POST["project_id"];

   

   $sql = "SELECT * FROM capms_project_task_info JOIN capms_user_workload_info ON capms_project_task_info.task_id = capms_user_workload_info.task_id Where capms_user_workload_info.project_id = " . $project_id . " AND capms_user_workload_info.user_id = ".$_SESSION['emp_id']." LIMIT 0, 25;";
    $result = mysqli_query($con, $sql);
?>
    <option value="" selected>select task_id</option>

<?php
    while ($row = mysqli_fetch_array($result)) {
?>
    <option value="<?php echo $row["task_id"]; ?>"><?php echo $row["task_name"]; ?></option>
<?php
    }
?>