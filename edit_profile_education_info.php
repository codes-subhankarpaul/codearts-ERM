<?php
    //error_reporting(E_ERROR | E_WARNING | E_PARSE); 
?>
<!doctype html>
<html lang="en">

    <head>
        <!-- Header CSS files -->
        <?php include 'header_css.php'; ?>
        <?php
            if($_SESSION['emp_id'] == '')
            {
              echo "<script>location.href='".$baseURL."login.php';</script>";
            }
        ?>
        <title>Edit Profile - CERM :: Codearts Employee Relationship Management</title>
    </head>

    <body>
        <header class="custom-header">
            <!-- Dashboard Top Info Panel -->
            <?php include 'info_panel.php'; ?>
        </header>
        <main class="custom-dahboard-main">
            <div class="custom-page-wrap-dp">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <!-- Dashboard Left Sidebar -->
                            <?php include 'dashboard.php'; ?>
                        </div>
                        <div class="col-lg-9">
                            <section class="inner-head-brd">
                                <h2>Employee Information Form</h2>
                                <ul>
                                <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                    <li><a href="<?php echo $baseURL; ?>profile.php">Profile</a></li>
                                    <li><a href="<?php echo $baseURL; ?>edit_profile.php">Employee Personal Information Form</a></li>
                                    <li><a href="<?php echo $baseURL; ?>edit_profile_personal_info.php">Employee Personal Information Form</a></li>
                                    <li><a href="<?php echo $baseURL; ?>edit_profile_emargency_contact.php">Employee Emargency Contact Information Form</a></li>
                                    <li><a href="<?php echo $baseURL; ?>edit_profile_education_info.php">Employee Education Information Form</a></li>
                                    <li>Employee Education Information Form</li>
                                </ul>
                            </section>

                            <section class="employee-form employee-basic-personal-bank-information">
                                <form method="POST" enctype="multipart/form-data" id="education_form">
                                <h4>Education Informations</h4> 
                                    <div class="form-row" id="secondary_form">
                                        <div class="col-md-3 align-self-center">
                                            <label>Secondary Institute Name</label> 
                                            <input type="text" class="form-control" placeholder="Secondary Institute Name" name="secondary_institute_name" id="secondary_institute_name" required>
                                        </div>
                                        <div class="col-md-3 align-self-center">
                                            <label>Board Name</label> 
                                            <input type="text" class="form-control" placeholder="Board Name" name="secondary_board" id="secondary_board" required>
                                        </div>
                                        <div class="col-md-3 align-self-center">
                                            <label>Year of Passout</label> 
                                            <input type="date" class="form-control" name="secondary_yop" id="secondary_yop" required>
                                        </div>
                                        <div class="col-md-2 align-self-center">
                                            <label>Percentage</label> 
                                            <input type="text" class="form-control" placeholder="Exam Percentage" name="secondary_percentage" id="secondary_percentage" required>
                                        </div>
                                        <div class="col-md-1 align-self-center text-right">
                                            <div id="secondary_verification" class="verification-btn">
                                                <i class="far fa-check-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 align-self-center">
                                            <label>Higher Secondary Institute Name</label> 
                                            <input type="text" class="form-control" placeholder="Higher Secondary Institute Name" name="hs_institute_name" id="hs_institute_name" required>
                                        </div>
                                        <div class="col-md-3 align-self-center">
                                            <label>Board Name</label> 
                                            <input type="text" class="form-control" placeholder="Board Name" name="hs_board" id="hs_board" required>
                                        </div>
                                        <div class="col-md-2 align-self-center">
                                            <label>Year of Start</label> 
                                            <input type="date" class="form-control" name="hs_start_year" id="hs_start_year" required>
                                        </div>
                                        <div class="col-md-2 align-self-center">
                                            <label>Year of Finish</label>
                                            <input type="date" class="form-control" name="hs_finish_year" id="hs_finish_year" required>
                                        </div>
                                        <div class="col-md-1 align-self-center">
                                            <label>Percentage</label> 
                                            <input type="text" class="form-control" placeholder="Exam Percentage" name="hs_passing_percentage" id="hs_passing_percentage" required>
                                        </div>
                                        <div class="col-md-1 align-self-center text-right">
                                            <div id="higher_secondary_verification" class="verification-btn">
                                                <i class="far fa-check-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 align-self-center">
                                            <label>Graduation collage Name</label> 
                                            <input type="text" class="form-control" placeholder="Collage Name" name="ug_institute_name" id="ug_institute_name" required>
                                        </div>
                                        <div class="col-md-3 align-self-center">
                                            <label>University Name</label> 
                                            <input type="text" class="form-control" placeholder="University Name" name="ug_university_name" id="ug_university_name" required>
                                        </div>
                                        <div class="col-md-2 align-self-center">
                                            <label>Year of Start</label> 
                                            <input type="date" class="form-control" name="ug_start_year" id="ug_start_year" required>
                                        </div>
                                        <div class="col-md-2 align-self-center">
                                            <label>Year of Finish</label> 
                                            <input type="date" class="form-control" name="ug_finish_year" id="ug_finish_year" required>
                                        </div>
                                        <div class="col-md-1 align-self-center">
                                            <label>Percentage</label> 
                                            <input type="text" class="form-control" placeholder="Exam Percentage" name="ug_passing_percentage" id="ug_passing_percentage" required>
                                        </div>
                                        <div class="col-md-1 align-self-center text-right">
                                            <div id="ug_verification" class="">
                                                <i class="far fa-check-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-3 align-self-center">
                                            <label>University Name (PG)</label> 
                                            <input type="text" class="form-control" placeholder="University Name" name="pg_institute_name" id="pg_institute_name" required>
                                        </div>
                                        <div class="col-md-2 align-self-center">
                                            <label>Year of Start</label> 
                                            <input type="date" class="form-control" name="pg_start_year" id="pg_start_year" required>
                                        </div>
                                        <div class="col-md-2 align-self-center">
                                            <label>Year of Finish</label> 
                                            <input type="date" class="form-control" name="pg_finish_year" id="pg_finish_year" required>
                                        </div>
                                        <div class="col-md-4 align-self-center">
                                            <label>Percentage</label> 
                                            <input type="text" class="form-control" placeholder="Exam Percentage" name="pg_passing_percentage" id="pg_passing_percentage" required>
                                        </div>
                                        <div class="col-md-1 align-self-center text-right">
                                            <div id="pg_verification" class="verification-btn">
                                                <i class="far fa-check-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-devider-dp"></div>
                                    
                                    <div class="col-md-12 text-center">
                                        <button type="submit" name= "user_education_info" class="btn dp-em-nxt-btn">Submit</button>
                                    </div>

                                </form>
                         </section>

                         <?php
                            if(isset($_POST['user_education_info'])){
                            $query = "SELECT * FROM capms_user_education_info WHERE user_id = '".$_SESSION['emp_id']."' ";
                            $result = mysqli_query($con, $query);
                            if($result->num_rows > 0){
                                    $update_query = "UPDATE capms_user_education_info SET secondary_institute = '".$_POST['secondary_institute_name']."', secondary_board = '".$_POST['secondary_board']."', secondary_yop = '".$_POST['secondary_yop']."', secondary_exam_percentage = '".$_POST['secondary_percentage']."', higher_secondary_institute = '".$_POST['hs_institute_name']."', higher_secondary_board = '".$_POST['hs_board']."', higher_secondary_start_date = '".$_POST['hs_start_year']."', higher_secondary_end_date = '".$_POST['hs_finish_year']."', higher_secondary_exam_percentage = '".$_POST['hs_passing_percentage']."', ug_institute_name = '".$_POST['ug_institute_name']."', ug_university_name = '".$_POST['ug_university_name']."', ug_start_year = '".$_POST['ug_start_year']."', ug_finish_year = '".$_POST['ug_finish_year']."', ug_passing_percentage = '".$_POST['ug_passing_percentage']."', pg_institute_name = '".$_POST['pg_institute_name']."', pg_start_year = '".$_POST['pg_start_year']."', pg_finish_year = '".$_POST['pg_finish_year']."', pg_passing_percentage = '".$_POST['pg_passing_percentage']."', updated_at = '".date('Y-m-d h:i:s', strtotime('now'))."' WHERE user_id = '".$_SESSION['emp_id']."' ";

                                    //echo $update_query;

                                    mysqli_query($con, $update_query);
                                    echo "<script>location.href='".$baseURL."profile.php';</script>";
                                }
                                else {
                                    $insertQuery = "INSERT INTO capms_user_education_info (id, user_id, secondary_institute, secondary_board, secondary_yop, secondary_exam_percentage, higher_secondary_institute, higher_secondary_board, higher_secondary_start_date, higher_secondary_end_date, higher_secondary_exam_percentage, ug_institute_name, ug_university_name, ug_start_year, ug_finish_year, ug_passing_percentage, pg_institute_name, pg_start_year, pg_finish_year, pg_passing_percentage, created_at, updated_at) VALUES (NULL, '".$_SESSION['emp_id']."', '".$_POST['secondary_institute_name']."', '".$_POST['secondary_board']."', '".$_POST['secondary_yop']."', '".$_POST['secondary_percentage']."', '".$_POST['hs_institute_name']."', '".$_POST['hs_board']."', '".$_POST['hs_start_year']."', '".$_POST['hs_finish_year']."', '".$_POST['hs_passing_percentage']."', '".$_POST['ug_institute_name']."', '".$_POST['ug_university_name']."', '".$_POST['ug_start_year']."','".$_POST['ug_finish_year']."','".$_POST['ug_passing_percentage']."','".$_POST['pg_institute_name']."','".$_POST['pg_start_year']."','".$_POST['pg_finish_year']."','".$_POST['pg_passing_percentage']."', '".date('Y-m-d h:i:s', strtotime('now'))."', '".date('Y-m-d h:i:s', strtotime('now'))."') ";
                                    //echo $insertQuery;
                                    //die();
                                    $resultQuery = mysqli_query($con, $insertQuery);
                                    echo "<script>location.href='".$baseURL."profile.php';</script>";
                                    
                                }
                            }
                         ?>


        </main>
        <footer class="custom-footer">
            <!-- Copyright Content file -->
            <?php include 'copyright_content.php'; ?>
        </footer>
        <!-- Footer JS files -->
        <?php include 'footer_js.php' ?>

        <script src="assets/js/jquery-min.js"></script>
        <script src="assets/js/jquery-ui.min.js"></script>
        <script>
            jQuery(document).ready(function(){

                // //validation of secondary education checking blank or not
                jQuery("#secondary_verification").click(function(){
                    var secondary_institute_name = jQuery("#secondary_institute_name").val();
                    var secondary_board = jQuery("#secondary_board").val();
                    var secondary_yop = jQuery("#secondary_yop").val();
                    var secondary_percentage = jQuery("#secondary_percentage").val();
                    
                    if(secondary_institute_name == ""){
                        alert("Please enter the Secondary Institute name");
                    }
                    else if(secondary_institute_name != "" && secondary_board == ""){
                        alert("Please enter the Secondary Board name");
                    }
                    else if(secondary_institute_name != "" && secondary_board != "" && secondary_yop == ""){
                        alert("Please enter your finishing year of secondary education");
                    }
                    else if(secondary_institute_name != "" && secondary_board != "" && secondary_yop != "" && secondary_percentage == "" ){
                        alert("Please enter your percentage of secondary education");
                    }
                });

                //....@higher secondary form field validation...
                jQuery("#higher_secondary_verification").click(function(){
                    var result = demo_function_name('#secondary_yop', '#hs_start_year');
                    if(result == false){
                        alert("Please enter a correct date");
                    }
                    else {
                        jQuery(this).addClass("text-sucess");
                    }
                });

                
                //....@Under Graduation verification....
                jQuery("#ug_verification").click(function(){
                    var result = demo_function_name('#hs_finish_year', '#ug_start_year');
                    if(result == false){
                        alert("Please enter a correct date");
                    }
                });

                //...@PG verification....
                jQuery("#pg_verification").click(function(){
                    var result = demo_function_name('#ug_finish_year', '#pg_start_year');
                    if(result == false){
                        alert("Please enter a correct date");
                    }
                });
            });

            //function to check bewteen two dates
            function demo_function_name(date1,date2)
                {
                    var date_1 = jQuery(date1).val().split("-");
                    var lastYop = new Date(date_1);
                    var date_2 = jQuery(date2).val().split("-");
                    var startDate = new Date(date_2);

                    if(lastYop == "" && startDate == ""){
                        alert("You did not enter a date please enter a date");
                    }
                    else{
                    var differenceBewteenDays = daysdifference(lastYop , startDate);
                    if(differenceBewteenDays == 0 || startDate < lastYop){
                        return false;
                    }
                   }
                }

            //Function to check difference bewteen two days
                    function daysdifference(firstDate, secondDate){  
                        var startDay = new Date(firstDate);  
                        var endDay = new Date(secondDate);  
                    
                    // Determine the time difference between two dates     
                        var millisBetween = startDay.getTime() - endDay.getTime();  
                    
                    // Determine the number of days between two dates  
                        var days = millisBetween / (1000 * 3600 * 24);  
                    
                    // Show the final number of days between dates     
                        return Math.round(Math.abs(days));  
                    }  

            //checking class
            // new file

        </script>
    </body>
</html>  