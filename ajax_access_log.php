<?php
include 'database.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();
date_default_timezone_set('Asia/Kolkata');
//$con = mysqli_connect("localhost","root","","codearts_erm");
$month = $_REQUEST['month'];
$year = $_REQUEST['year'];

$month_year = $month.'-'.$year;

$html = '';

$fir_sat = date('d-m-Y', strtotime('first saturday of March 2023'));
                                                        
$third_sat = date('d-m-Y', strtotime('third saturday of March 2023'));
$wkend_days = array($fir_sat,$third_sat);


function getSundays($y, $m)
{
    return new DatePeriod(
        new DateTime("first sunday of $y-$m"),
        DateInterval::createFromDateString('next sunday'),
        new DateTime("last day of $y-$m 23:59:59")
    );
}

foreach (getSundays(2023, 03) as $sunday) {
    array_push($wkend_days,$sunday->format("d-m-Y"));
    
}

$month = date('m');


$sql2 = "SELECT * FROM `capms_login_information` WHERE `user_id` = '".$_SESSION['emp_id']."' AND `login_date` LIKE '%-".$month_year."%'";


$result2 = mysqli_query($con, $sql2);
if($result2->num_rows > 0)
{
    while($row2 = mysqli_fetch_assoc($result2))
    {
        //print_r($row2);
        //die;
        $checkTime = strtotime('10:45:00');
        $loginTime = strtotime($row2['login_time']);
        $diff = $checkTime - $loginTime;
        ($diff < 0)? $class='late' : $class='right';
        if (!in_array(date('d-m-Y', strtotime($row2['login_date'])), $wkend_days)) {   
        
        $html.='<tr>
            
            <th scope="row">
                '.date("d-m-Y", strtotime($row2["login_date"])).'
            </th>
            <!-- login time -->
            <td class="bg-dp-drk '.$class.'">
            '.$row2["login_time"].'
            </td>';
            
            
            $diff_lunch_break = strtotime($row2['lunch_break_end']) - strtotime($row2['lunch_break_start']);
            ($diff_lunch_break > 3600)? $class='late' : $class='right';
            
            $html.='
            <td class="'.$class.'">';
                
                    if($row2['lunch_break_start'] != '')
                    {
                        $html.=''.$row2['lunch_break_start'].'';
                    }
                    if($row2['lunch_break_end'] != '')
                    {
                        $val = " - ".$row2["lunch_break_end"];
                        $html.=''.$val.'';
                    }
                
            $html.='</td>';
            
            $diff_evn_break = strtotime($row2['evening_break_end']) - strtotime($row2['evening_break_start']);
            ($diff_evn_break > 600)? $class='late' : $class='right';
            
            $html.='
            <td class="'.$class.'">';

                    if($row2['evening_break_start'] != '')
                    {
                        $html.=''.$row2['evening_break_start'].'';
                    }
                    if($row2['evening_break_end'] != '')
                    {
                        $val = " - ".$row2["evening_break_end"];
                        $html.=''.$val.'';
                    }    
                
                    $html.='</td>';
            
            
            $html.='<td class="bg-dp-drk">';
                
                if($row2['logout_time'] !=""){
                    $logout_time_array = explode(" ", $row2['logout_time']);
                    $logout_time = str_replace('-', ':', $logout_time_array[0]);
                    $logout_time = date('g:i A' ,strtotime($logout_time));
                    $log_time_final = $logout_time." <span class='text-danger'><b>".$logout_time_array[1]."</b></span>";
                    $html.=''.$log_time_final.'';
                }
                
                $html.='</td>';
            
                $diff = strtotime($logout_time) - strtotime($row2['login_time'])-$diff_lunch_break-$diff_evn_break;
                $secs = $diff % 60;
                $hrs = $diff / 60;
                $mins = $hrs % 60;
                $hrs = $hrs / 60;
                $working_hours = (float) ((int)$hrs . "." . (int)$mins);
            
                if(number_format($working_hours,2) >=7.40){
                $class = 'right';
                }
                else{
                $class = 'late';
                }
            
                $html.='
                <td class="'.$class.'">';
                    
                if($row2['logout_time'] !="" && $row2['login_time'] !="") {
                $html.=''.$working_hours.''; 
                }
                
                $html.='</td>';
            
                $html.='</tr>';

        }
        
    }
    echo json_encode( array( "status" => 'success', "data" => $html) );
}

else{
    echo json_encode( array( "status" => 'error', "data" => '') );
}
            
   //echo $html;