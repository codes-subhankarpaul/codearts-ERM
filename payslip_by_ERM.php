
<?php
require_once 'database.php';
$user_salary = "SELECT * FROM `capms_admin_users` WHERE id='".$_SESSION['emp_id']."'";
$result_user_salary = mysqli_query($con,$user_salary);
$row_user_salary = mysqli_fetch_assoc($result_user_salary);
$gross_salary = $row_user_salary['user_salary'];
$basic = ($gross_salary*50)/100;
$da = ($basic*10)/100;
$hra = ($basic*50)/100 + $da;
$ma = ($basic*10)/100;
$gap = $gross_salary-($basic+$da+$hra+$ma);
if($row_user_salary['user_salary']==''){
    echo 'Salary amount not added.';
}
else{
    $loa =0;
    $prevMonth = strtotime("-1 month");
    $prevMonth = date("Y-m", $prevMonth);
    $sql_leaves = "SELECT * FROM `capms_admin_individual_leaves` WHERE user_id='".$_SESSION['emp_id']."' AND leave_status='Aproved' AND SUBSTRING_INDEX(leave_date,'-',-2)='".date("m-Y",strtotime($prevMonth))."'";
    $result_leaves = mysqli_query($con,$sql_leaves);
    $half_leave_dates = array();
    $second_half_leaves = array();
    if(mysqli_num_rows($result_leaves)>0){
        while($row_leaves = mysqli_fetch_array($result_leaves)){
            if($row_leaves['type_of_leave']!="Full Day"){
                $half_leave_dates[] = date_format(date_create($row_leaves['leave_date']),"d-m-Y");
            }
            if($row_leaves['type_of_leave']=="Second Half"){
                $second_half_leaves[] = date_format(date_create($row_leaves['leave_date']),"d-m-Y");
            }
        }
    }
    $sql_login_details = "SELECT * FROM `capms_login_information` WHERE SUBSTRING_INDEX(login_date,'-',-2)='".date("m-Y",strtotime($prevMonth))."' AND user_id='".$_SESSION['emp_id']."'";
    $result_login = mysqli_query($con,$sql_login_details);
    $count_late =0;
    $count_day =0;
    if(mysqli_num_rows($result_login)>0){
        while($row_login = mysqli_fetch_assoc($result_login)){
            $flag_leave =0;
            for($i=0;$i<count($half_leave_dates);$i++){
                if($half_leave_dates[$i]==$row_login['login_date']){
                    $flag_leave =1;
                    break;
                }
            }
            $flag_second_half_leave =0;
            for($i=0;$i<count($second_half_leaves);$i++){
                if($second_half_leaves[$i]==$row_login['login_date']){
                    $flag_second_half_leave =1;
                    break;
                }
            }
            $loginTime = strtotime($row_login['login_time']);
            $diff_lunch_break = strtotime($row_login['lunch_break_end']) - strtotime($row_login['lunch_break_start']);
            $diff_evn_break = strtotime($row_login['evening_break_end']) - strtotime($row_login['evening_break_start']);
            if($row_login['logout_time'] !=""){
                $logout_time_array = explode(" ", $row_login['logout_time']);
                $logout_time = str_replace('-', ':', $logout_time_array[0]);
                $logout_time = date('g:i A' ,strtotime($logout_time));
            }
            $diff = strtotime($logout_time) - $loginTime - $diff_lunch_break - $diff_evn_break;
            $secs = $diff % 60;
            $hrs = $diff / 60;
            $mins = $hrs % 60;
            $hrs = $hrs / 60;
            $working_hours = (float) ((int)$hrs . "." . (int)$mins);
            if($flag_leave==1){
                $min_hours=4.00;
            }
            else{
                $min_hours=7.40;
            }
            if($flag_second_half_leave==1){
                $checkTime = strtotime('3:00:00');
            }
            else{
                $checkTime = strtotime('10:45:00');
            }
            if(number_format($working_hours,2) >=$min_hours){
                // $count_day++;
                // $checkTime = strtotime('10:45:00');
                echo $row_login['login_date'];
                echo number_format($working_hours,2);
                // if there is any grace time on that date and approved then add that grace time
                $temp_gracetime = '';
                $sql_gracetime = "SELECT gracetime_taken FROM `capms_gracetime_info` WHERE `user_id`= '".$_SESSION['emp_id']."' and `gracetime_date` = '".date('m/d/Y',strtotime($row_login['login_date']))."' and `status` = '1'";
                $result_gracetime = mysqli_query($con, $sql_gracetime);
                while ($row_gracetime = mysqli_fetch_array($result_gracetime)) {
                    $temp_gracetime = $row_gracetime['gracetime_taken'];
                }
                $total_hours = 0;
                $total_minutes = 0;
                // if there is any gracetime add that to minutes
                if($temp_gracetime!='') {
                    $exploded_gracetime= explode(':',$temp_gracetime);
                    $total_minutes+=(int)$exploded_gracetime[1];
                }
                //timesheet hour calculation
                $sql_timesheet = "SELECT * FROM `capms_user_timesheet` WHERE timesheet_date='".date("m/d/Y", strtotime($row_login['login_date']))."' AND user_id='".$_SESSION['emp_id']."'";
                $duration = array();
                $result_timesheet = mysqli_query($con,$sql_timesheet);
                $diff_timesheet=0;
                if(mysqli_num_rows($result_timesheet)>0){
                    while($row_timesheet = mysqli_fetch_assoc($result_timesheet)){
                        $diff_timesheet = strtotime($row_timesheet['end_time']) - strtotime($row_timesheet['start_time']);
                        $secs = $diff_timesheet % 60;
                        $hrs = $diff_timesheet / 60;
                        $mins = $hrs % 60;
                        $hrs = $hrs / 60;
                        $duration_one = sprintf('%0.2f', (float)((int)$hrs . "." . (int)$mins));
                        array_push($duration,$duration_one);
                    }
                }
                $diff_minutes_lunch = round(abs($diff_lunch_break) / 60,2);
                $diff_minutes_evening = round(abs($diff_evn_break) / 60,2);
                // if lunch break then add
                // if($diff_minutes_lunch!='') {
                //     $total_minutes+=(int)$diff_minutes_lunch;
                // }
                
                // // if evening break then add
                // if($diff_minutes_evening!='') {
                // $total_minutes+=(int)$diff_minutes_evening;
                // }

                for($i=0; $i<count($duration); $i++) {
                    $du_array= explode('.',$duration[$i]);
                    $total_hours += (int)$du_array[0];
                    $total_minutes += (int)$du_array[1];
                }
                
                $hours_add = (int)$total_minutes/60;
                $total_minutes = $total_minutes%60;
                $total_hours+=(int)$hours_add;
                $total = $total_hours.'.'.$total_minutes;
                if($working_hours==$total){
                    if($min_hours==4.00){
                        $count_day = $count_day+0.5;
                    }
                    else{
                        $count_day++;
                    }
                }
                // else{
                //     echo "timesheet not filled properly.";
                //     echo $total_hours;
                // }
                $diff_late = $checkTime - $loginTime;
                if($diff_late <0){
                    $count_late++;
                }
                if($count_late>=3){
                    // echo $count_day;
                    // $count_day=$count_day-1;
                    $loa++;
                    // echo $count_day;
                    $count_late=0;
                }

            }
            
        }
    }


    //Sunday, first and third Saturdays remove
    $prev_month_dates = date('F Y', strtotime(' -1 months'));
    $dateList[]= date("Y-m-d",strtotime($prev_month_dates));
    while (strtotime($prev_month_dates) < strtotime(date('Y-m',strtotime('-1 months')) . '-' . date('t', strtotime($prev_month_dates)))) {
        $prev_month_dates = date("Y-m-d", strtotime("+1 day", strtotime($prev_month_dates))); 
        $dateList[]= $prev_month_dates;  
    }
    $time=strtotime($dateList[0]);
    $month=date("m",$time);
    $year = date("Y",$time);
    $firstday = new  DateTime("$year-$month-1 0:0:0");
    $first_w=$firstday->format('w'); // weekday of firstday 
    $saturday1=new DateTime;
    $saturday1->setDate($year,$month,7-$first_w);
    $sat1=$saturday1->format('Y-m-d');
    $saturday2=new DateTime;
    $saturday2->setDate($year,$month,21-$first_w);
    $sat3=$saturday2->format('Y-m-d');
    for($i = 0; $i<=count($dateList)-1; $i++){
        if(date('D', strtotime($dateList[$i]))=="Sat") {
            if($dateList[$i]==$sat1 || $dateList[$i]==$sat3){
                array_splice($dateList, $i, 2);
            }
        }
        else if(date('D', strtotime($dateList[$i]))=="Sun"){
            array_splice($dateList, $i, 1);          
        }
    }
    $sql_holiday = "SELECT * FROM `capms_holidays` WHERE (SUBSTRING_INDEX(start_dates,'/',1)='".$month."' AND SUBSTRING_INDEX(start_dates,'/',-1)='".$year."') OR (SUBSTRING_INDEX(end_dates,'/',1)='".$month."' AND SUBSTRING_INDEX(end_dates,'/',-1)='".$year."')";
    $result_holiday = mysqli_query($con,$sql_holiday);
    if(mysqli_num_rows($result_holiday)>0){
        while($row_holiday = mysqli_fetch_assoc($result_holiday)){
            $start_date = $row_holiday['start_dates'];
            // echo $start_date;
            $end_date = $row_holiday['end_dates'];
            if($start_date!=$end_date){
                $dates = getDatesFromRange($start_date, $end_date);
                for($i = 0; $i<=count($dateList); $i++){
                    for($j = 0; $j<=count($dates); $j++){
                        if($dateList[$i]==$dates[$j]){
                            array_splice($dateList,$i,1);
                        }
                    }
                }
            }
            else{
                for($i = 0; $i<count($dateList); $i++){
                    if($dateList[$i]==date("Y-m-d",strtotime($start_date))){
                        array_splice($dateList,$i,1);
                    }
                }
            }
        }
    }
    // Function to get all the dates in given range
    function getDatesFromRange($start, $end, $format = 'Y-m-d') {
        
        // Declare an empty array
        $array = array();
        
        // Variable that store the date interval
        // of period 1 day
        $interval = new DateInterval('P1D');
    
        $realEnd = new DateTime($end);
        $realEnd->add($interval);
    
        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
    
        // Use loop to store date into array
        foreach($period as $date) {                 
            $array[] = $date->format($format); 
        }
    
        // Return the array elements
        return $array;
    }
    
    $sql_leave = "SELECT * FROM `capms_admin_individual_leaves` WHERE user_id='".$_SESSION['emp_id']."' AND leave_status='Aproved' AND SUBSTRING_INDEX(leave_date,'-',-2)='".date("m-Y",strtotime($prevMonth))."'";
    $result_leave_day = mysqli_query($con,$sql_leave);
    $count_paid_leave=0;
    $count_leave =0;
    if($result_leave_day->num_rows>0){
        while($row_leave = mysqli_fetch_assoc($result_leave_day)){
            if($row_leave['type_of_leave']=='Full Day'){
                $count_leave++;
                // $count_day++;
            }
            else{
                $count_leave=$count_leave+0.5;
                // $count_day=$count_day+0.5;
            }
            if($row_leave['paid_unpaid_status']=='Paid'){
                if($row_leave['type_of_leave']=='Full Day')                    
                        $count_paid_leave++;
                    else
                        $count_paid_leave = $count_paid_leave + 0.5;
            }
            else if($row_leave['paid_unpaid_status']=='Half-Paid'){
                $count_paid_leave = $count_paid_leave + 0.5;
            }
            
        }
    }
    if($gross_salary<=10000){
        $p_tax=0;
    }
    else if(($gross_salary>10000) && ($gross_salary<=15000)){
        $p_tax=110;
    }
    else if(($gross_salary>15000) && ($gross_salary<=25000)){
        $p_tax=130;
    }
    else if(($gross_salary>25000) && ($gross_salary<=40000)){
        $p_tax=150;
    }
    else{
        $p_tax=200;
    }
    if(abs(count($dateList)-$count_paid_leave)==$count_day){
        $pf=($gross_salary*12)/100;
        $esi=($gross_salary*0.75)/100;
        $total_deduction = $pf+$esi+$p_tax;
        $total_salary = $gross_salary - $pf - $esi - $p_tax;
    }
    else{
        $unaproved_leaves = $count_leave - $count_paid_leave;
        echo count($dateList)-$count_paid_leave;

        $loa = $loa+ ((count($dateList)-$count_paid_leave)-$count_day);
        $salary_deduct_for_leave= ($gross_salary/date("t", strtotime(date('F Y', strtotime(' -1 months')))))*$loa;
        // echo date("t", strtotime(date('F Y', strtotime(' -1 months'))));
        // echo $salary_deduct_for_leave;
        $remaining = $gross_salary-$salary_deduct_for_leave;
        // echo $remaining;
        $pf = ($remaining*12)/100;
        $esi = ($remaining*0.75)/100;
        $total_deduction = $pf+$esi+$p_tax+$salary_deduct_for_leave; 
        $total_salary = $remaining - $pf - $esi - $p_tax;
    }



    // $current_month = date("m");
    // $month = date("m", strtotime ( '-1 month' , strtotime ( $current_month ) ));
    // $year = date("Y");
    // $date = date('F Y', strtotime(' -1 months'));
    // $dateList[]= date("Y-m-d",strtotime($date));
    // while (strtotime($date) < strtotime(date('Y-m',strtotime('-1 months')) . '-' . date('t', strtotime($date)))) {
    //     $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
    //     $sql_unfilled_dates = "SELECT * FROM `capms_user_timesheet` WHERE user_id='".$_SESSION['emp_id']."' AND timesheet_date='".date("m/d/Y",strtotime($date))."'";
    //     $result_unfilled = mysqli_query($con,$sql_unfilled_dates);
    //     if(mysqli_num_rows($result_unfilled)<=0){
    //         $dateList[]= $date;
    //     }
    // }
    // $count_days = 0;
    // $time=strtotime($dateList[0]);
    // $month=date("m",$time);
    // $year = date("Y",$time);
    // $firstday = new  DateTime("$year-$month-1 0:0:0");
    // $first_w=$firstday->format('w'); // weekday of firstday 
    // $saturday1=new DateTime;
    // $saturday1->setDate($year,$month,7-$first_w);
    // $sat1=$saturday1->format('Y-m-d');
    // $saturday2=new DateTime;
    // $saturday2->setDate($year,$month,21-$first_w);
    // $sat3=$saturday2->format('Y-m-d');
    // for($i = 0; $i<=count($dateList)-1; $i++){
    //     if(date('D', strtotime($dateList[$i]))=="Sat") {
    //         if($dateList[$i]==$sat1 || $dateList[$i]==$sat3){
    //             $count_days = $count_days +1;
    //             array_splice($dateList, $i, 1);
    //         }
    //     }
    //     else if(date('D', strtotime($dateList[$i]))=="Sun"){
    //         $count_days = $count_days +1;
    //         array_splice($dateList, $i, 1);
    //     }
    // }
    // $sql_holiday = "SELECT * FROM `capms_holidays` WHERE (SUBSTRING_INDEX(start_dates,'/',1)='".$month."' AND SUBSTRING_INDEX(start_dates,'/',-1)='".$year."') OR (SUBSTRING_INDEX(end_dates,'/',1)='".$month."' AND SUBSTRING_INDEX(start_dates,'/',-1)='".$year."')";
    // $result_holiday = mysqli_query($con,$sql_holiday);
    // if(mysqli_num_rows($result_holiday)>0){
    //     while($row_holiday = mysqli_fetch_assoc($result_holiday)){
    //         $start_date = $row_holiday['start_dates'];
    //         $end_date = $row_holiday['end_dates'];
    //         if($start_date!=$end_date){
    //             $dates = getDatesFromRange($start_date, $end_date);
    //             for($i = 0; $i<=count($dateList); $i++){
    //                 $count_days = $count_days+1;
    //                 for($j = 0; $j<=count($dates); $j++){
    //                     if($dateList[$i]==$dates[$j]){
    //                         array_splice($dateList,$i,1);
    //                     }
    //                 }
    //             }
    //         }
    //         else{
    //             for($i = 0; $i<=count($dateList); $i++){
    //                 if($dateList[$i]==date("Y-m-d",strtotime($start_date))){
    //                     array_splice($dateList,$i,1);
    //                 }
    //             } 
    //         }
    //     }
    // }
    // // Function to get all the dates in given range
    // function getDatesFromRange($start, $end, $format = 'Y-m-d') {
        
    //     // Declare an empty array
    //     $array = array();
        
    //     // Variable that store the date interval
    //     // of period 1 day
    //     $interval = new DateInterval('P1D');
    
    //     $realEnd = new DateTime($end);
    //     $realEnd->add($interval);
    
    //     $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
    
    //     // Use loop to store date into array
    //     foreach($period as $date) {                 
    //         $array[] = $date->format($format); 
    //     }
    
    //     // Return the array elements
    //     return $array;
    // }
    
    // $current_year = date("Y");
    // $full_leaves = "SELECT COUNT(leave_id) AS Remaining_full FROM `capms_admin_individual_leaves` WHERE user_id ='".$_SESSION['emp_id']."' AND leave_status = 'Aproved' AND type_of_leave ='Full Day' AND leave_date LIKE '%-".$current_year."'";
    // $result_full_leaves = mysqli_query($con,$full_leaves);
    // $total_full_leaves = mysqli_fetch_assoc($result_full_leaves);
    // $half_leaves = "SELECT COUNT(leave_id) AS Remaining_half FROM `capms_admin_individual_leaves` WHERE user_id ='".$_SESSION['emp_id']."' AND leave_status = 'Aproved' AND (type_of_leave ='Second Half' OR type_of_leave='First Half') AND leave_date LIKE '%-".$current_year."'";
    // $result_half_leaves = mysqli_query($con,$half_leaves);
    // $total_half_leaves = mysqli_fetch_assoc($result_half_leaves);
    // $total_leaves = $total_full_leaves['Remaining_full'] + ($total_half_leaves['Remaining_half']/2);
    // $remaining=0;
    // for($j = 0; $j<=count($dateList)-1; $j++){
    //     $sql_leaves = "SELECT * FROM `capms_admin_individual_leaves` WHERE user_id='".$_SESSION['emp_id']."' AND leave_date='".date("d-m-Y",strtotime($dateList[$j]))."'";
    //     $result_leaves = mysqli_query($con,$sql_leaves);
    //     if(mysqli_num_rows($result_leaves)>0){
    //         if($total_leaves<=18){
    //             array_splice($dateList, $j, 1);
    //         }
    //         else{
    //             $remaining = abs(18-$total_leaves);
    //             array_splice($dateList, $j, 1);
    //         }
    //     }
    // }
    // $working_days = date("t", strtotime(date('F Y', strtotime(' -1 months'))))-$count_days;
    // $one_day_salary= $row_user_salary['user_salary']/$working_days;
    // $gross_salary =  $row_user_salary['user_salary'];
    // $basic = ($gross_salary*50)/100;
    // $da = ($basic*10)/100;
    // $hra = ($basic*50)/100 + $da;
    // $ma = ($basic*10)/100;
    // $gap = $gross_salary-($basic+$da+$hra+$ma);
    // $pf = ($row_user_salary['user_salary']*12)/100;
    // $esi = ($row_user_salary['user_salary']*0.75)/100;
    // $p_tax = ($gross_salary <= 10000)?0:(($gross_salary>10000) && ($gross_salary <= 15000))?110:(($gross_salary > 15000) && ($gross_salary <= 25000))?130:(($gross_salary > 25000) && ($gross_salary <= 40000))?150:200;
    // $total_deduction = $p_tax+$pf+$esi+$remaining*$one_day_salary +count($dateList)*$one_day_salary;
    // $total_salary = $gross_salary - $pf - $esi - $p_tax - $remaining*$one_day_salary - count($dateList)*$one_day_salary;

    if($row_user_salary["user_pan_number"]==''){
        $pan_no = "-";
    }
    else{
        $pan_no = $row_user_salary["user_pan_number"];
    }
    if($row_user_salary["user_uan_number"]==''){
        $uan_no = "-";
    }
    else{
        $uan_no = $row_user_salary["user_uan_number"];
    }
    if($row_user_salary["user_pf_number"]==''){
        $pf_no = "-";
    }
    else{
        $pf_no = $row_user_salary["user_pf_number"];
    }
    if($row_user_salary["user_esi_number"]==''){
        $esi_no = "-";
    }
    else{
        $esi_no = $row_user_salary["user_esi_number"];
    }
    $paySlip_Data = '';
    $paySlip_Data .= '
        <table class="p-table-head" style="border-bottom: 1px solid #292929; text-align: center; margin-bottom:30px;width:100%;">
        <tr>
        <td style=" padddig-bottom:10px;"><img src="http://localhost/ERM/pdf/codearts-logo.jpg" style="height:80px; width:120px;" alt=""></td>
        </tr>
        <tr>
        <td style="padddig-bottom:10px";><strong>CodeArts Solution Private Limited<strong></td>
        </tr>
        <tr>
        <td style="padddig-bottom:10px;">Martin Burn House, 1 R.N. Mukherjee Road BBD Bagh, Kolkata, Room No. 227</td>
        </tr>
        <tr>
        <td style="padddig-bottom:10px;">Pay slip for the month of '.date('F Y', strtotime($prevMonth)).'</td>
        </tr>
        </table>
        <table class="table p-table-first" style="border: 1px solid #292929; width:100%;">
        <tr>
        <th style="text-align:left;">Employee ID</th>
        <td style="text-align:left;">'.$row_user_salary["user_empid"].'</td>
        <th style="text-align:left;">Employee Name</th>
        <td style="text-align:left;">'.$row_user_salary["user_fullname"].'</td>
        </tr>
        <tr>
        <th style="text-align:left;">Designation</th>
        <td style="text-align:left;">'.$row_user_salary["user_designation"].'</td>
        <th style="text-align:left;">Bank Name</th>
        <td style="text-align:left;">'.$row_user_salary["user_bank_name"].'</td>
        </tr>
        <tr>
        <th style="text-align:left;">Department</th>
        <td style="text-align:left;">'.$row_user_salary["user_department"].'</td>
        <th style="text-align:left;">Bank A/C No</th>
        <td style="text-align:left;">'.$row_user_salary["user_bank_account_no"].'</td>
        </tr>
        <tr>
        <th style="text-align:left;">Location</th>
        <td style="text-align:left;">'.$row_user_salary['user_address'].'</td>
        <th style="text-align:left;">Pan No</th>
        <td style="text-align:left;">'.$pan_no.'</td>
        </tr>
        <tr>
        <th style="text-align:left;">Gross Salary</th>
        <td style="text-align:left;">'.$gross_salary.'</td>
        <th style="text-align:left;">UAN No</th>
        <td style="text-align:left;">'.$uan_no.'</td>
        </tr>
        <tr>
        <th style="text-align:left;">Effective Work Days</th>
        <td style="text-align:left;">'.$count_day.'</td>
        <th style="text-align:left;">PF No</th>
        <td style="text-align:left;">'.$pf_no.'</td>
        </tr>
        <tr>
        <th style="text-align:left;">LOA</th>
        <td style="text-align:left;">'.$loa.'</td>
        <th style="text-align:left;">ESI No</th>
        <td >'.$esi_no.'</td>
        </tr>
        </table>
        </div>
        </div>
        <div class="row">
        <div class="col-lg-12">
        <table class="table p-table-second" style="width:100%; margin-bottom:100px;" border="0" cellspacing="0 cellpadding="0">
        <tr style="background-color: #bfe6f9;">
        <th style="border: 1px solid #292929; text-align:left;">Earnings</th>
        <th style="border: 1px solid #292929; text-align:left;"></th>
        <th style="border: 1px solid #292929; text-align:left;">Deduction</th>
        <th style="border: 1px solid #292929; text-align:left;"></th>
        </tr>
        <tr>
        <th style="border-left: 1px solid #292929; text-align:left; ">Basic</th>
        <td style="border-left: 1px solid #292929; text-align:left;">'.number_format((float)$basic, 2, '.', '').'</td>
        <th style="border-left: 1px solid #292929; text-align:left;">PF</th>
        <td style="border-right: 1px solid #292929; border-left: 1px solid #292929; text-align:left;">'.number_format((float)$pf, 2, '.', '').'</td>
        </tr>
        <tr>
        <th style="border-left: 1px solid #292929; text-align:left;">HRA</th>
        <td style="border-left: 1px solid #292929; text-align:left;">'.number_format((float)$hra, 2, '.', '').'</td>
        <th style="border-left: 1px solid #292929; text-align:left;">P.Tax</th>
        <td style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;">'.$p_tax.'</td>
        </tr>
        <tr>
        <th style="border-left: 1px solid #292929; text-align:left;">Medical Allowance</th>
        <td style="border-left: 1px solid #292929; text-align:left;">'.number_format((float)$ma, 2, '.', '').'</td>
        <th style="border-left: 1px solid #292929; text-align:left;">E.S.I</th>
        <td style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;">'.number_format((float)$esi, 2, '.', '').'</td>
        </tr>
        <tr>
        <th style="border-left: 1px solid #292929; text-align:left;">DA</th>
        <td style="border-left: 1px solid #292929; text-align:left;">'.number_format((float)$da, 2, '.', '').'</td>
        <th style="border-left: 1px solid #292929; text-align:left;">LOA</th>
        <td style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;">'.number_format((float)$salary_deduct_for_leave, 2, '.', '').'</td>
        </tr>
        <tr>
        <th style="border-left: 1px solid #292929; text-align:left;">TA</th>
        <td style="border-left: 1px solid #292929; text-align:left;">N/A</td>
        <th style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;"></th>
        <td style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;"></td>
        </tr>
        <tr>
        <th style="border-left: 1px solid #292929; text-align:left;">Special Allowance</th>
        <td style="border-left: 1px solid #292929; text-align:left;">'.$gap.'</td>
        <th style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;"></th>
        <td style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;"></td>
        </tr>
        
        <tr style="border: 1px solid #292929;">
        <th style="border-right: 1px solid #292929; text-align:left;">Total Addition</th>
        <td style="border-right: 1px solid #292929; text-align:left;">'.$gross_salary.'</td>
        <th style="border-right: 1px solid #292929; text-align:left;">Total Deduction</th>
        <td>'.number_format((float)$total_deduction, 2, '.', '').'</td>
        </tr>
        <tr style="border: 1px solid #292929 ;">
        <th style="border: 1px solid #292929 ; text-align:left;" colspan="2">Net Salary</th>
        <td style="border: 1px solid #292929 ; text-align:left;" colspan="2">'.number_format((float)$total_salary, 2, '.', '').'</td>
        </tr>
        </table>
    ';
}
?>
