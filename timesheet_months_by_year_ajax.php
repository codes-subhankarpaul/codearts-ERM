<?php
    require_once "database.php";
    $timesheet_year = $_POST["timesheet_year"];
    $user_id = $_POST["user_id"];
    $sql_timesheet_month = "SELECT DISTINCT SUBSTRING_INDEX(timesheet_date,'/',1) AS timesheet_month from `capms_user_timesheet` where SUBSTRING_INDEX(timesheet_date,'/',-1)='".$timesheet_year."' and user_id='".$user_id."' order by timesheet_month;";
    $result_timesheet_month = mysqli_query($con, $sql_timesheet_month);

    // echo '<ul>';
    // while ($row = mysqli_fetch_array($result_timesheet_month)) {
    //     echo '<li id="timesheet_'.$timesheet_year.'_'.$row['timesheet_month'].'">'.date("F", mktime(null, null, null, $row['timesheet_month'])).'-'.$row['timesheet_month'].'</li>';
    // }
    // echo '</ul>';

    while ($row = mysqli_fetch_array($result_timesheet_month)) {
        $id = 'timesheet_'.$timesheet_year.'_'.$row['timesheet_month'];
        $value = $row['timesheet_month'];
        $month_value = date("F", mktime(null, null, null, $row['timesheet_month']));

        $return_arr[] = array(
            "id" => $id,
            "value" => $value,
            "month_value" => $month_value
        );
    }

    echo json_encode($return_arr);

?>