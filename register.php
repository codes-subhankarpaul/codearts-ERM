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
                                        <input type="text" class="form-control" placeholder="Full Name"
                                            name="user_fullname" required>
                                        <span class="custom-input-icon">
                                            <img src="assets/images/register-frm-icon-1.png">
                                        </span>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12">
                                        <input type="email" class="form-control" placeholder="Email Address"
                                            name="user_email" required>
                                        <span class="custom-input-icon">
                                            <img src="assets/images/register-frm-icon-2.png">
                                        </span>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12">
                                        <input type="tel" class="form-control" placeholder="Contact Number"
                                            name="user_contact" required>
                                        <span class="custom-input-icon">
                                            <img src="assets/images/register-frm-icon-3.png">
                                        </span>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12">
                                        <input type="text" class="form-control" placeholder="Job Role"
                                            name="user_job_role" required>
                                        <span class="custom-input-icon">
                                            <img src="assets/images/register-frm-icon-2.png">
                                        </span>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12">
                                        <input placeholder="Date Of Joining" class="form-control" type="text"
                                            onfocus="(this.type='date')" id="date" name="user_joining_date">

                                        <!-- <input placeholder="Date" class="textbox-n" type="text" onfocus="(this.type='date')" id="date"> -->
                                        <span class="custom-input-icon">
                                            <img src="assets/images/register-frm-icon-7.png">
                                        </span>
                                    </div>
                                    <!-- <div class="form-group col-lg-12 col-md-12">
                                            <input type="text" class="form-control" placeholder="Initial Salary" name="user_salary">
                                            <span class="custom-input-icon">
                                                <img src="assets/images/register-frm-icon-4.png">
                                            </span>
                                        </div> -->
                                    <div class="form-group col-lg-12 col-md-12">
                                        <input type="password" class="form-control" placeholder="Password"
                                            name="user_password" required>
                                        <span class="custom-input-icon">
                                            <img src="assets/images/register-frm-icon-5.png">
                                        </span>
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12">
                                        <input type="password" class="form-control" placeholder="Confirm Password"
                                            name="confirm_user_password" required>
                                        <span class="custom-input-icon">
                                            <img src="assets/images/register-frm-icon-5.png">
                                        </span>
                                    </div>
                                    <!-- <div class="form-group col-lg-12 col-md-12">
                                            <input class="form-control" id="file-img" type="file" placeholder="Password" name="user_featured_image" required>
                                            <label for="file-img">Upload Image</label>
                                            <span class="custom-input-icon">
                                                <img src="assets/images/register-frm-icon-6.png">
                                            </span>
                                             
                                        </div> -->
                                    <div class="form-group col-lg-12 col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                                required>
                                            <label class="form-check-label" for="invalidCheck">
                                                Agree to terms and conditions
                                            </label>
                                            <div class="invalid-feedback">
                                                You must agree before submitting.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="submit" name="user_register" class="btn dp-reg-btn"
                                            value="Register Now">
                                        <button type="reset" class="btn dp-reset-btn">
                                            <img src="assets/images/reset_icon.png" class="" style="max-width: 42px;"
                                                alt="">
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
                                                 
                                                if(isset($_FILES['user_featured_image'])) {
                                                    $errors     = "";
                                                    if ($_FILES["user_featured_image"]["size"] > 50000000000000) 
                                                        echo "Sorry, your file is too large.";
                                                    // echo $errors;
                                                } 
                                                else{
                                                    
                                                //$empid = strtolower(str_replace(" ", "-", $_POST['user_fullname']));
                                                    $empid = 'CODE-'.rand(1111,9999);
                                                    
                                                    
                                                    // $sql2= "INSERT INTO `capms_admin_users` (`id`, `user_type`, `user_fullname`, `user_department`, `user_empid`, `user_email`, `user_contact`, `user_joining_date`, `user_featured_image`, `user_salary`, `user_password`, `user_designation`, `user_dob`, `user_address`, `user_gender`, `reports_to_uid`, `user_passport_number`, `user_adhar_number`, `user_voter_id`, `user_pan_number`, `user_nationality`, `user_religion`, `user_marital_status`, `user_employment_of_spouse`, `user_children_number`, `emergency_primary_name`, `emergency_primary_relation`, `emergency_primary_contact`, `emergency_secondary_name`, `emergency_secondary_relation`, `emergency_secondary_contact`, `user_bank_name`, `user_bank_ifsc_code`, `user_bank_account_no`, `created_at`, `updated_at`) VALUES (NULL, '', '".$_POST['user_fullname']."', '', '".$empid."', '".$_POST['user_email']."', '".$_POST['user_contact']."', '".$_POST['user_joining_date']."', '', '".$_POST['user_salary']."', '".md5($_POST['user_password'])."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '".date('Y-m-d h:i:s', strtotime('now'))."', '".date('Y-m-d h:i:s', strtotime('now'))."')";
                                                    
                                                    $sql2 = "INSERT INTO `capms_admin_users` (`id`, `user_type`, `user_fullname`, `user_department`, `user_empid`, `user_email`, `user_contact`, `user_joining_date`, `user_featured_image`, `user_salary`, `user_password`, `user_designation`, `user_dob`, `user_address`, `user_gender`, `reports_to_uid`, `user_passport_number`, `user_adhar_number`, `user_voter_id`, `user_pan_number`, `user_pf_number`, `user_esi_number`, `user_uan_number`, `user_nationality`, `user_religion`, `user_marital_status`, `user_employment_of_spouse`, `user_children_number`, `emergency_primary_name`, `emergency_primary_relation`, `emergency_primary_contact`, `emergency_secondary_name`, `emergency_secondary_relation`, `emergency_secondary_contact`, `user_bank_name`, `user_bank_ifsc_code`, `user_bank_account_no`, `created_at`, `updated_at`) VALUES (NULL, 'employee', '".$_POST['user_fullname']."', '', '".$empid."', '".$_POST['user_email']."', '".$_POST['user_contact']."', '".$_POST['user_joining_date']."', '', '', '".md5($_POST['user_password'])."', '".$_POST['user_job_role']."', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');";
                                                    mysqli_query($con, $sql2);
                                                   
                                                    $html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                                    <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
                                                    
                                                    <head>
                                                        <meta charset="UTF-8">
                                                        <meta content="width=device-width, initial-scale=1" name="viewport">
                                                        <meta name="x-apple-disable-message-reformatting">
                                                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                                        <meta content="telephone=no" name="format-detection">
                                                        <title></title>
                                                        <!--[if (mso 16)]>
                                                        <style type="text/css">
                                                        a {text-decoration: none;}
                                                        </style>
                                                        <![endif]-->
                                                        <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]-->
                                                        <!--[if gte mso 9]>
                                                    <xml>
                                                        <o:OfficeDocumentSettings>
                                                        <o:AllowPNG></o:AllowPNG>
                                                        <o:PixelsPerInch>96</o:PixelsPerInch>
                                                        </o:OfficeDocumentSettings>
                                                    </xml>
                                                    <![endif]-->
                                                    </head>
                                                    
                                                    <body>
                                                        <div class="es-wrapper-color">
                                                            <!--[if gte mso 9]>
                                                                <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                                                                    <v:fill type="tile" color="#f6f6f6"></v:fill>
                                                                </v:background>
                                                            <![endif]-->
                                                            <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="esd-email-paddings" valign="top">
                                                                            <table class="esd-header-popover es-header" cellspacing="0" cellpadding="0" align="center">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-stripe" align="center">
                                                                                            <table class="es-header-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="esd-structure es-p20t es-p20r es-p20l" align="left">
                                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                                                <tbody>
                                                                                                                                    <tr>
                                                                                                                                        <td align="center" class="esd-block-image" style="font-size: 0px;"><a target="_blank"><img class="adapt-img" src="https://demo.stripocdn.email/content/guids/2665a439-ff35-41b0-a43c-7b34a3f2eb54/images/logomain.png" alt style="display: block;" width="181"></a></td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-stripe" align="center">
                                                                                            <table class="es-content-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="es-p20t es-p20r es-p20l esd-structure" align="left">
                                                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <td class="esd-container-frame" width="560" valign="top" align="center">
                                                                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                                                                <tbody>
                                                                                                                                    <tr>
                                                                                                                                        <td align="center" class="esd-block-text es-p10">
                                                                                                                                            <p style="color: #f6b26b; font-size: 24px; font-family: "comic sans ms", "marker felt-thin", arial, sans-serif;">Welcome To CodeArts Solution</p>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="esd-structure es-p20t es-p20r es-p20l" align="left">
                                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                                                <tbody>
                                                                                                                                    <tr>
                                                                                                                                        <td align="left" class="esd-block-text">
                                                                                                                                            <p>Hello '.$_POST['user_fullname'].',</p>
                                                                                                                                            <p><br></p>
                                                                                                                                            <p>We are delighted to welcome you to the Codearts team! Congratulations on your new position as Junior Software Developer.&nbsp;We are confident that your skills and experience will contribute significantly to our ongoing success.</p>
                                                                                                                                            <p><br></p>
                                                                                                                                            <p>To begin the onboarding process, we kindly request that you complete your new employee registration. This step is essential to ensure a smooth integration into our organization and to provide you with access to our systems and resources.</p>
                                                                                                                                            <p style="display: none;"><br></p>
                                                                                                                                            <p><br></p>
                                                                                                                                            <p>Please follow the instructions below to complete your registration:</p>
                                                                                                                                            <ol style="display: none;">
                                                                                                                                                <li><br></li>
                                                                                                                                            </ol>
                                                                                                                                            <p><br></p>
                                                                                                                                            <ol>
                                                                                                                                                <li>Access the Codearts employee portal by visiting CodeartsPms</li>
                                                                                                                                                <li>Fill Up The Details Of Login Page.</li>
                                                                                                                                                <li>After Login Go To The Profile Tab.</li>
                                                                                                                                                <li>Provide the required information, including your personal details, contact information, and any additional documents requested.</li>
                                                                                                                                                <li>Submit your registration form.</li>
                                                                                                                                            </ol>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="esd-structure es-p20t es-p20r es-p20l" align="left">
                                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                                                <tbody>
                                                                                                                                    <tr>
                                                                                                                                        <td align="center" class="esd-block-text">
                                                                                                                                            <p style="font-size: 18px;"><b style="font-family: "comic sans ms", "marker felt-thin", arial, sans-serif;">Your Registration&nbsp;</b>
                                                                                                                                                <font face="comic sans ms, marker felt-thin, arial, sans-serif"><b>Details</b></font><b style="font-family: "comic sans ms", "marker felt-thin", arial, sans-serif;">&nbsp;Are Followings:</b>
                                                                                                                                            </p>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <table class="esd-footer-popover es-footer" cellspacing="0" cellpadding="0" align="center">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="esd-stripe" align="center">
                                                                                            <table class="es-footer-body" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="esd-structure es-p20t es-p20b es-p20r es-p20l" align="left">
                                                                                                            <!--[if mso]><table width="560" cellpadding="0" 
                                                                            cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
                                                                                                            <table class="es-left" cellspacing="0" cellpadding="0" align="left">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <td class="es-m-p20b esd-container-frame" width="270" align="left">
                                                                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                                                                <tbody>
                                                                                                                                    <tr>
                                                                                                                                        <td align="left" class="esd-block-text">
                                                                                                                                            <p style="font-family: helvetica, "helvetica neue", arial, verdana, sans-serif;"><strong>Name : '.$_POST['user_fullname'].'</strong></p>
                                                                                                                                            <p style="font-family: helvetica, "helvetica neue", arial, verdana, sans-serif;"><strong>Email: '.$_POST['user_email'].'</strong></p>
                                                                                                                                            <p style="font-family: helvetica, "helvetica neue", arial, verdana, sans-serif;"><strong>Phone: '.$_POST['user_contact'].'</strong></p>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                            <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
                                                                                                            <table class="es-right" cellspacing="0" cellpadding="0" align="right">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <td class="esd-container-frame" width="270" align="left">
                                                                                                                            <table width="100%" cellspacing="0" cellpadding="0">
                                                                                                                                <tbody>
                                                                                                                                    <tr>
                                                                                                                                        <td align="left" class="esd-block-text">
                                                                                                                                            <p style="font-family: helvetica, "helvetica neue", arial, verdana, sans-serif;"><strong>Date Of Joining: '.$_POST['user_joining_date'].'</strong></p>
                                                                                                                                            <p style="font-family: helvetica, "helvetica neue", arial, verdana, sans-serif;"><strong>Employee Code: '.$empid.'</strong></p>
                                        
                                                                                                                                            <p style="font-family: helvetica, "helvetica neue", arial, verdana, sans-serif;"><strong>Employee Code: '.$_POST['user_job_role'].'</strong></p>
                                                                                                                                            
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                            <!--[if mso]></td></tr></table><![endif]-->
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="esd-structure es-p20t es-p20r es-p20l" align="left">
                                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                                                <tbody>
                                                                                                                                    <tr>
                                                                                                                                        <td align="left" class="esd-block-text">
                                                                                                                                            <p>If you have any questions or encounter any issues during the registration process, please do not hesitate to reach out to our Human Resources department at Projects@codeartssolution.com or 8777691218. We are here to assist you and ensure a seamless onboarding experience.</p>
                                                                                                                                            <p style="display: none;">&nbsp;</p>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="esd-structure es-p20t es-p20r es-p20l" align="left">
                                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                                                <tbody>
                                                                                                                                    <tr>
                                                                                                                                        <td align="left" class="esd-block-text">
                                                                                                                                            <p>We look forward to having you on board and witnessing your contributions to our team. Welcome once again to the Codearts family!</p>
                                                                                                                                            <p style="display: none;">&nbsp;</p>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="esd-structure es-p20t es-p20r es-p20l" align="left">
                                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                                                <tbody>
                                                                                                                                    <tr>
                                                                                                                                        <td align="left" class="esd-block-text">
                                                                                                                                            <p>Best regards,</p>
                                                                                                                                            <p>Sukalyan Ghosh<br></p>
                                                                                                                                            <p>Director<br></p>
                                                                                                                                            <p>Codearts Solution Pvt Ltd<br></p>
                                                                                                                                            <p>+91-8777691218</p>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="esd-structure es-p20t es-p20r es-p20l" align="left">
                                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                                <tbody>
                                                                                                                    <tr>
                                                                                                                        <td width="560" class="esd-container-frame" align="center" valign="top">
                                                                                                                            <table cellpadding="0" cellspacing="0" width="100%">
                                                                                                                                <tbody>
                                                                                                                                    <tr>
                                                                                                                                        <td align="center" class="esd-block-social" style="font-size:0">
                                                                                                                                            <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social">
                                                                                                                                                <tbody>
                                                                                                                                                    <tr>
                                                                                                                                                        <td align="center" valign="top" class="es-p10r"><a target="_blank" href><img src="https://stripo.email/static/assets/img/social-icons/circle-colored/twitter-circle-colored.png" alt="Tw" title="Twitter" width="32"></a></td>
                                                                                                                                                        <td align="center" valign="top" class="es-p10r"><a target="_blank" href><img src="https://stripo.email/static/assets/img/social-icons/circle-colored/facebook-circle-colored.png" alt="Fb" title="Facebook" width="32"></a></td>
                                                                                                                                                        <td align="center" valign="top" class="es-p10r"><a target="_blank" href><img src="https://stripo.email/static/assets/img/social-icons/circle-colored/youtube-circle-colored.png" alt="Yt" title="Youtube" width="32"></a></td>
                                                                                                                                                        <td align="center" valign="top"><a target="_blank" href><img src="https://stripo.email/static/assets/img/social-icons/circle-colored/vk-circle-colored.png" alt="VK" title="Vkontakte" width="32"></a></td>
                                                                                                                                                    </tr>
                                                                                                                                                </tbody>
                                                                                                                                            </table>
                                                                                                                                        </td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </body>
                                                    
                                                    </html>';
                                                    
                                                    $last_id = $con->insert_id;
                                                    $ch = curl_init();
                            
                                                    curl_setopt($ch, CURLOPT_URL, 'https://api.sendinblue.com/v3/smtp/email');
                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                                    curl_setopt($ch, CURLOPT_POST, 1);


                                                    $arrayVar = [
                                                            "sender" => ["name" => "ERM Registartion", "email" => "projects@codeartssolution.com"],
                                                        "to" => [
                                                            ["email" => "magentoshourya@gmail.com", "name" => "WebAdmin"],
                                                            ["email" => $_POST['user_email'], "name" => $_POST['user_fullname']]
                                                            ],
                                                            "subject" => "ERM Registartion",
                                                            "htmlContent" =>
                                                            $html
                                                        ];
                                                        

                                                    $jsonData = json_encode($arrayVar);
                                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);


                                                    $headers = array();
                                                    $headers[] = 'Accept: application/json';
                                                    $headers[] = 'Api-Key: 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';
                                                    $headers[] = 'Content-Type: application/json';
                                                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                                                    $result = curl_exec($ch);
                                                    if (curl_errno($ch)) {
                                                        echo 'Error:' . curl_error($ch);
                                                    }
                                                    curl_close($ch);
                                                  
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