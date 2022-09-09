<!doctype html>
<html lang="en">

    <head>
        <!-- Header CSS files -->
        <?php include 'header_css.php'; ?>
        <title>Register - CERM :: Codearts Employee Relationship Management</title>
    </head>

    <body>
        <section class="custom-register" style="background-image: url(assets/images/register-img.png);">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 ml-0">
                        <div class="reg-wrap">
                            <div class="register-heading">
                                <h3>Register</h3>
                                <p class="demo">Enter Your Information to setup a New User Account.</p>
                            </div>
                            <div class="reg-form">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="form-row">
                                        <div class="form-group col-lg-12 col-md-12">
                                            <input type="text" class="form-control" placeholder="Full Name" name="user_fullname" required>
                                            <span class="custom-input-icon">
                                                <img src="assets/images/register-frm-icon-1.png">
                                            </span>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12">
                                            <input type="email" class="form-control" placeholder="Email Address" name="user_email" required>
                                            <span class="custom-input-icon">
                                                <img src="assets/images/register-frm-icon-2.png">
                                            </span>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12">
                                            <input type="tel" class="form-control" placeholder="Contact Number" name="user_contact" required>
                                            <span class="custom-input-icon">
                                                <img src="assets/images/register-frm-icon-3.png">
                                            </span>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12">
                                            <input placeholder="Date Of Joining" class="form-control" type="text" onfocus="(this.type='date')" id="date" name="user_joining_date">

                                            <!-- <input placeholder="Date" class="textbox-n" type="text" onfocus="(this.type='date')" id="date"> -->
                                            <span class="custom-input-icon">
                                                <img src="assets/images/register-frm-icon-7.png">
                                            </span>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12">
                                            <input type="text" class="form-control" placeholder="Initial Salary" name="user_salary">
                                            <span class="custom-input-icon">
                                                <img src="assets/images/register-frm-icon-4.png">
                                            </span>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12">
                                            <input type="password" class="form-control" placeholder="Password" name="user_password" required>
                                            <span class="custom-input-icon">
                                                <img src="assets/images/register-frm-icon-5.png">
                                            </span>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12"> 
                                            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_user_password" required>
                                            <span class="custom-input-icon">
                                                <img src="assets/images/register-frm-icon-5.png">
                                            </span>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12">
                                            <input class="form-control" id="file-img" type="file" placeholder="Password" name="user_featured_image" required>
                                            <label for="file-img">Upload Image</label>
                                            <span class="custom-input-icon">
                                                <img src="assets/images/register-frm-icon-6.png">
                                            </span>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="submit" name="user_register" class="btn dp-reg-btn" value="Register Now">
                                            <button type="reset" class="btn dp-reset-btn">
                                                <img src="assets/images/reset_icon.png" class="" style="max-width: 42px;" alt="">
                                            </button>
                                        </div>
                                        <div class="dp-register-ac try_login">
                                            <p class="demo">Already Have An Account? <a href="login.php">Try Login</a>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                    if(isset($_POST['user_register']))
                                    {
                                        if($_POST['user_password'] == $_POST['confirm_user_password'])
                                        {
                                            $sql1 = "SELECT * FROM capms_admin_users WHERE user_email = '".$_POST['user_email']."' OR user_contact = '".$_POST['user_contact']."' ";
                                            $result1 = mysqli_query($con, $sql1);
                                            if($result1->num_rows > 0)
                                            {
                                                echo "<p class='register-error text-danger'>This Email ID or Contact Number already exists. Either login or try some other Email ID or Contact Number.</p>";
                                            }
                                            else
                                            {
                                                $empid = strtolower(str_replace(" ", "-", $_POST['user_fullname']));
                                                $empid = $empid."-".rand(1111,9999);
                                                $sql2= "INSERT INTO `capms_admin_users` (`id`, `user_type`, `user_fullname`, `user_department`, `user_empid`, `user_email`, `user_contact`, `user_joining_date`, `user_featured_image`, `user_salary`, `user_password`, `user_designation`, `user_dob`, `user_address`, `user_gender`, `reports_to_uid`, `user_passport_number`, `user_adhar_number`, `user_voter_id`, `user_pan_number`, `user_nationality`, `user_religion`, `user_marital_status`, `user_employment_of_spouse`, `user_children_number`, `emergency_primary_name`, `emergency_primary_relation`, `emergency_primary_contact`, `emergency_secondary_name`, `emergency_secondary_relation`, `emergency_secondary_contact`, `user_bank_name`, `user_bank_ifsc_code`, `user_bank_account_no`, `created_at`, `updated_at`) VALUES (NULL, '', '".$_POST['user_fullname']."', '', '".$empid."', '".$_POST['user_email']."', '''".$_POST['user_contact']."', '".$_POST['user_joining_date']."', '', '".$_POST['user_salary']."', '".md5($_POST['user_password'])."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '".date('Y-m-d h:i:s', strtotime('now'))."', '".date('Y-m-d h:i:s', strtotime('now'))."')";
                                              
                                                mysqli_query($con, $sql2);
                                                
                                                $last_id = $con->insert_id;
                                                if($last_id)
                                                {
                                                    if(isset($_FILES['user_featured_image']['name']))
                                                    {
                                                        $tmpFilePath = $_FILES['user_featured_image']['tmp_name'];
                                                        if($tmpFilePath != "")
                                                        {
                                                            $shortname = $_FILES['user_featured_image']['name'];
                                                            $timestamp = strtotime('now').'-'.$_FILES['user_featured_image']['name'];
                                                            $filename = $_FILES['user_featured_image']['name'];
                                                            $filePath = "assets/uploads/user_featured_images/" .$timestamp;

                                                            if(move_uploaded_file($tmpFilePath, $filePath))
                                                            {
                                                                $sql3 = "UPDATE capms_admin_users SET user_featured_image = '".$timestamp."' WHERE id = '".$last_id."' ";
                                                                mysqli_query($con, $sql3);
                                                            }
                                                        }
                                                    }
                                                }
                                                echo "<script>location.href='".$baseURL."login.php';</script>";
                                            }
                                        }
                                        else
                                        {
                                            echo "<p class='register-error text-danger'>Password Confirmation is unsuccessful.</p>";
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer JS files -->
        <?php include 'footer_js.php' ?>
    </body>
</html>