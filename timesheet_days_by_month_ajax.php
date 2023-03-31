<?php
    require_once "database.php";
    // echo "Hello";
    // echo $_REQUEST['user_id'];
    // echo $_REQUEST['timesheet_month'];
    $timesheet_year = $_POST["timesheet_year"];
    $timesheet_month = $_POST["timesheet_month"];
    $user_id = $_POST["user_id"];
    $sql_timesheet_day = "SELECT DISTINCT SUBSTRING_INDEX(SUBSTRING_INDEX(timesheet_date,'/',2),'/',-1) AS timesheet_day from `capms_user_timesheet` where SUBSTRING_INDEX(timesheet_date,'/',1)='".$timesheet_month."' and user_id='".$user_id."' order by timesheet_day;";
    $result_timesheet_day = mysqli_query($con, $sql_timesheet_day);

    while ($row = mysqli_fetch_array($result_timesheet_day)) {
        $id = 'timesheet_'.$timesheet_year.'_'.$timesheet_month.'_'.$row['timesheet_day'];
        $value = $row['timesheet_day'];

        $return_arr[] = array(
            "id" => $id,
            "value" => $value,
            "day_value" => ''
        );
    }

    echo json_encode($return_arr);
?>