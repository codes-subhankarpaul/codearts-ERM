<?php
error_reporting(E_ALL ^ E_NOTICE);
?>
<?php
require_once "database.php";
// getting task_id from workload_id
$sql_task_id_from_workload_id = "SELECT task_id FROM `capms_user_workload_info` WHERE `workload_id` = '".$_REQUEST['task_id']."'";
$result_task_id_from_workload_id = mysqli_query($con, $sql_task_id_from_workload_id);
if ($result_task_id_from_workload_id->num_rows > 0) {
    while ($row_task_id_from_workload_id = mysqli_fetch_assoc($result_task_id_from_workload_id)) {
        $task_id = $row_task_id_from_workload_id['task_id'];
    }
}
?>

<?php
    $checked_domains = '';
    $sql_domains = "SELECT * FROM `capms_project_task_info` WHERE `task_id` = '".$task_id."'";
    $result_domains = mysqli_query($con, $sql_domains);
    if ($result_domains->num_rows > 0) {
        while ($row_domains = mysqli_fetch_assoc($result_domains)) {
            $checked_domains = $row_domains['task_domain'];
        }
        $checked_domains_array = explode(',', $checked_domains);
    }
?>

<?php
    $checked_domains_timesheet = '';
    $sql_domains_timesheet = "SELECT * FROM `capms_user_timesheet` WHERE `timesheet_id` = '".$_REQUEST['timesheet_id']."'";
    $result_domains_timesheet = mysqli_query($con, $sql_domains_timesheet);
    if ($result_domains_timesheet->num_rows > 0) {
        while ($row_domains_timesheet = mysqli_fetch_assoc($result_domains_timesheet)) {
            $checked_domains_timesheet = $row_domains_timesheet['task_domain'];
        }
        $checked_domains_timesheet_array = explode(',', $checked_domains_timesheet);
    }
?>

<div class="col mb-3">
    <label>Task Domain</label>
    <button id="task_domain_btn" class="btn btn-outline-dark w-100 form-control" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        Select Task Domain
    </button>
    <div class="collapse" id="collapseExample">
        <div class="card">
            <div class="card-body w-100">  
            <?php
                $assined_domain_ids = '';
                $project_domain = "SELECT `domain` FROM `capms_project_info` WHERE project_id = '".$_REQUEST['project_id']."'";
                $assign_domain = mysqli_query($con,$project_domain);
                if($assign_domain->num_rows > 0){
                    while($assign_domain_row = mysqli_fetch_assoc($assign_domain)){
                        $assign_domain_ids = explode(',', $assign_domain_row['domain']);
                    }
                }

                // print_r($assign_domain_ids);

                $user_domain = "SELECT * FROM `capms_department_info`";
                $result_domain = mysqli_query($con,$user_domain);
                if($result_domain->num_rows > 0)
                {
            ?>
            <div class="checkbox-group required">
            <?php
                    while($row_domain = mysqli_fetch_assoc($result_domain))
                    {   
                        if (in_array($row_domain['dept_id'], $assign_domain_ids)) {
                            $checked = 'yes';
                        }
                        else {
                            $checked = 'no';
                        }
                    if($checked == 'yes'){    
                        if (in_array($row_domain['dept_id'], $checked_domains_array)) {   
            ?>
                <input type="checkbox" id="domain_name" name="domain_name[]" value="<?php echo $row_domain['dept_id']; ?>" <?php if ($_REQUEST['timesheet_id']!='' && in_array($row_domain['dept_id'], $checked_domains_timesheet_array)) echo 'checked';?>>
                <label for="domain_name"><?php echo $row_domain['dept_name']; ?> </label>
                
            <?php } } } } ?>
            </div>
            </div>
        </div>
    </div>
</div>


