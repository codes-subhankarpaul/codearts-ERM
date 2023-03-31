<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

    include 'database.php';

    //parameters
    $user_salary =''; // in lpa
    $join_month = '';
    $gap = '';
    //fetching joining month of the user
    
    $query = "SELECT * FROM capms_admin_users WHERE id = '".$_SESSION['emp_id']."' ";
    $result = mysqli_query($con, $query);

    if($result->num_rows > 0){
        while($row = mysqli_fetch_assoc($result)){
            $join_month =  date('F',strtotime($row['user_joining_date']));
            $user_salary = $row['user_salary'];
        }
    }
        
        //variables for salary
        $gross_salary = get_gross_salary($user_salary);
        $basic_salary = get_basic_salary($gross_salary);

        $check = is_eligible_gap($join_month);
        $gap = get_gap($check);
        
        //
        
        // calculation of HRA (20% of gross)
        function get_hra($ammount){
            return round(((20*$ammount)/100),4);
        }

        // calculation of MA
        function get_ma($ammount){
            return round(((20*$ammount)/100),4);
        }

        // calculation of DA
        function get_da($ammount){
            return round(((10*$ammount)/100),4);
        }

        // calculation of TA 
        function get_ta($ammount){
            return round(((10*$ammount)/100),4);
        }

        // calculation of Special
        function get_sp($ammount){
            return round(((10*$ammount)/100),4);
        }


    // checking if the user is elegible for gap or not...
    function is_eligible_gap($month){
        if(($month == 'January')||($month == 'April' ) || ($month == 'July') || ($month == 'October')){
            return true;
        }
        else{
            return false;
        }
    }

    //getting gap amount for the user
    function get_gap($check){
        if ($check == true){
            $GLOBALS['gap'] = gap_eligible_ammount($GLOBALS['user_salary']);
            return $GLOBALS['gap'];
        }
        else{
            return 0;
        }
    }
   
    //Getting gap adjustment
    function check_month_for_adjustment(){
        
    }

    //elegible for gap(10% of lpa/12)
    function gap_eligible_ammount($ammount){
            return round(((10*$ammount/100)/12),4);
        }

    // gross salary calculation (LPA/12)
    function get_gross_salary($ammount){
        return round(($ammount/12),4);
    }

   //basic salary calculation (30% of gross)
    function get_basic_salary($ammount){
        return round((30*$ammount/100),4);
    }

   //p.f calculation (5% of basic)
    function get_pf($ammount){
        return round((5*$ammount/100),4);
    }
   // E.s.i calculation (5% of basic)
    function get_esi($ammount){
        return round((5*$ammount/100),4);
    }

    //p.tax calculation(depends on gross salary)
    function get_ptax($ammount){
        if($ammount <= 10000){
            return 0;
        }
        elseif (($ammount>10000) && ($ammount <= 15000)){
            return 110;
        }
        elseif (($ammount > 15000) && ($ammount <= 25000)){
            return 130;
        }
        elseif (($ammount > 25000) && ($ammount <= 40000)){
            return 150;
        }
        elseif ($ammount > 40000){
            return 200;
        }
    }

    //total earnings 

    function get_total($gross_salary,$basic_salary){
        return $basic_salary+get_hra($gross_salary)+get_ma($gross_salary)+get_da($gross_salary)+get_ta($gross_salary)+get_sp($gross_salary);
    }

    //total deduction 

    function get_deduction($gross_salary,$basic_salary){
        return (get_pf($basic_salary) + get_ptax($gross_salary) + get_esi($basic_salary) + $GLOBALS['gap'] );
    }
?>