<?php


//including database connection..
require_once 'database.php';
include 'salary_calculation.php';

// html content to display..
$paySlip_Data = '';


//Fetching All necessary data from database..
$userID = $_SESSION['emp_id'];
$user_details = "SELECT 
                capms_admin_users.user_fullname, 
                capms_admin_users.user_empid, 
                capms_admin_users.user_designation, 
                capms_admin_users.user_department, 
                capms_admin_users.user_bank_name, 
                capms_admin_users.user_bank_account_no, 
                capms_admin_users.user_pan_number, 
                capms_pay_structure.gross_salary, 
                capms_admin_leave_applications.remaining_pls 
                FROM capms_admin_users 
                INNER JOIN capms_pay_structure ON capms_admin_users.id = capms_pay_structure.emp_id 
                INNER JOIN capms_admin_leave_applications ON capms_admin_users.id = capms_admin_leave_applications.user_empid WHERE capms_admin_users.id = $userID ";

$result = mysqli_query($con, $user_details);


 if($result->num_rows > 0){
    while($data = mysqli_fetch_assoc($result)){
        
   
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
           <td style="padddig-bottom:10px;">Pay slip for the month of August 2022</td>
        </tr>
        </table>
        <table class="table p-table-first" style="border: 1px solid #292929; width:100%;">
        <tr>
        <th style="text-align:left;">Employee ID</th>
        <td style="text-align:left;">'.$data["user_empid"].'</td>
        <th style="text-align:left;">Employee Name</th>
        <td style="text-align:left;">'.$data["user_fullname"].'</td>
        </tr>
        <tr>
           <th style="text-align:left;">Designation</th>
           <td style="text-align:left;">'.$data["user_designation"].'</td>
           <th style="text-align:left;">Bank Name</th>
           <td style="text-align:left;">'.$data["user_bank_name"].'</td>
        </tr>
        <tr>
           <th style="text-align:left;">Department</th>
           <td style="text-align:left;">'.$data["user_department"].'</td>
           <th style="text-align:left;">Bank A/C No</th>
           <td style="text-align:left;">'.$data["user_bank_account_no"].'</td>
        </tr>
        <tr>
           <th style="text-align:left;">Location</th>
           <td style="text-align:left;">Kolkata</td>
           <th style="text-align:left;">Pan No</th>
           <td style="text-align:left;">'.$data["user_pan_number"].'</td>
        </tr>
        <tr>
           <th style="text-align:left;">Gross Salary</th>
           <td style="text-align:left;">'.get_gross_salary($user_salary).'</td>
           <th style="text-align:left;">UAN No</th>
           <td style="text-align:left;">N/A</td>
        </tr>
        <tr>
           <th style="text-align:left;">Effective Work Days</th>
           <td style="text-align:left;">24</td>
           <th style="text-align:left;">PF No</th>
           <td style="text-align:left;">N/A</td>
        </tr>
        <tr>
           <th style="text-align:left;">LOP</th>
           <td style="text-align:left;">0</td>
           <th style="text-align:left;">ESI No</th>
           <td >N/A</td>
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
           <td style="border-left: 1px solid #292929; text-align:left;">'.get_basic_salary($gross_salary).'</td>
           <th style="border-left: 1px solid #292929; text-align:left;">PF</th>
           <td style="border-right: 1px solid #292929; border-left: 1px solid #292929; text-align:left;">'.get_pf($basic_salary).'</td>
        </tr>
        <tr>
           <th style="border-left: 1px solid #292929; text-align:left;">HRA</th>
           <td style="border-left: 1px solid #292929; text-align:left;">'.get_hra($gross_salary).'</td>
           <th style="border-left: 1px solid #292929; text-align:left;">P.Tax</th>
           <td style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;">'.get_ptax($gross_salary).'</td>
        </tr>
        <tr>
           <th style="border-left: 1px solid #292929; text-align:left;">Medical Allowance</th>
           <td style="border-left: 1px solid #292929; text-align:left;">'.get_ma($gross_salary).'</td>
           <th style="border-left: 1px solid #292929; text-align:left;">E.S.I</th>
           <td style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;">'.get_esi($basic_salary).'</td>
        </tr>
        <tr>
           <th style="border-left: 1px solid #292929; text-align:left;">DA</th>
           <td style="border-left: 1px solid #292929; text-align:left;">'.get_da($gross_salary).'</td>
           <th style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;">Gap Deduction</th>
           <td style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;">'.get_gap($check).'</td>
        </tr>
        <tr>
           <th style="border-left: 1px solid #292929; text-align:left;">TA</th>
           <td style="border-left: 1px solid #292929; text-align:left;">'.get_ta($gross_salary).'</td>
           <th style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;"></th>
           <td style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;"></td>
        </tr>
        <tr>
           <th style="border-left: 1px solid #292929; text-align:left;">Special Allowance</th>
           <td style="border-left: 1px solid #292929; text-align:left;">'.get_sp($gross_salary).'</td>
           <th style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;"></th>
           <td style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;"></td>
        </tr>
        <tr>
           <th style="border-left: 1px solid #292929; text-align:left;">Gap Adjusment</th>
           <td style="border-left: 1px solid #292929; text-align:left;">'.get_gap($check).'</td>
           <th style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;"></th>
           <td style="border-left: 1px solid #292929; border-right: 1px solid #292929; text-align:left;"></td>
        </tr>
        <tr style="border: 1px solid #292929;">
           <th style="border-right: 1px solid #292929; text-align:left;">Total Addition</th>
           <td style="border-right: 1px solid #292929; text-align:left;">'.get_total($gross_salary,$basic_salary).'</td>
           <th style="border-right: 1px solid #292929; text-align:left;">Total Deduction</th>
           <td>'.get_deduction($gross_salary, $basic_salary, $user_salary).'</td>
        </tr>
        <tr style="border: 1px solid #292929 ;">
           <th style="border: 1px solid #292929 ; text-align:left;" colspan="2">Net Salary</th>
           <td style="border: 1px solid #292929 ; text-align:left;" colspan="2">'.round(((get_total($gross_salary,$basic_salary))-(get_deduction($gross_salary, $basic_salary))),4).'</td>
        </tr>
        </table>
    ';

    }
 }


?>