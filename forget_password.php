<!doctype html>
<html lang="en">

    <head>
        <?php include 'header_css.php'; ?>
        <?php
            if(isset($_SESSION['emp_id']) )
            {
                echo "<script>location.href='".$baseURL."';</script>";
            }
        ?>
        <title>Forget Password - CERM :: Codearts Employee Relationship Management</title>
    </head>

    <body>
        <section class="custom-login">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 pl-0 pr-0 align-self-center">
                        <div class="custom-login-left" style="background-image: url(assets/images/login-left-img.jpg);">
                            <div class="custom-login-left-wrap">
                                <div class="login-content">
                                    <h3>Forget Password</h3>
                                    <p class="demo">Enter the registered Username or Email ID or Contact Number to get the Password Reset Link in the Email inbox.
                                    </p>
                                </div>
                                <div class="custom-login-form">
                                    <form method="POST" id="password-reset-link-form">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Username or Email ID or Contact Number" id="user_info" name="user_info" required>
                                        </div>
                                        <div class="form-group form-check">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="reset-wrapper">
                                                        <button type="reset" class="btn dp-login-reset-btn">Reset Credentials</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary dp-login-btn" id="password_reset_link">Send Password Reset Link</button>
                                        </div>
                                    </form>

                                    <form method="POST" id="set-new-password-form">
                                        <div class="form-group">
                                            <input type="hidden" name="set_new_password_email" id="set_new_password_email">
                                            <input type="hidden" name="password_reset_token_mailbox" id="password_reset_token_mailbox">
                                            <input type="text" class="form-control" placeholder="Token recieved in Mailbox" id="password_reset_token" name="password_reset_token">
                                            <input type="password" class="form-control" placeholder="Set New Password" id="set_new_password" name="set_new_password" required>
                                            <input type="password" class="form-control" placeholder="Confirm New Password" id="confirm_new_password" name="confirm_new_password" required>
                                        </div>
                                        <div class="form-group form-check">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="reset-wrapper">
                                                        <button type="reset" class="btn dp-login-reset-btn">Reset Credentials</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary dp-login-btn" id="set_new_password">Set New Password</button>
                                        </div>
                                    </form>

                                    <div class="dp-register-ac register_now">
                                        <p class="demo">Don't Have An Account? <a href="register.php">Register Here</a></p>
                                        <p class="demo">Remeber User Credentials? <a href="login.php">Try Login</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pl-0 pr-0 align-self-center">
                        <div class="custom-login-right" style="background-image: url(assets/images/login-right-img.jpg)">
                            <div class="custom-login-right-wrap">
                                <h5>Don't worry,</h5>
                                <h3>We are here help you to recover your password.</h3>
                                <a class="video-btn" href="#"><span class="play-btn"><i class="fas fa-play"></i></span>
                                    Watch Demo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include 'footer_js.php'; ?>
        <script src="assets/js/jquery-min.js"></script>
        <script>
            jQuery( document ).ready(function() {
                jQuery("#password-reset-link-form").show();
                jQuery("#set-new-password-form").hide();
                jQuery("#password-reset-link-form").submit( function(event) {
                    event.preventDefault();
                    var user_info = jQuery("#user_info").val();
                    jQuery.ajax({
                        type: "GET",
                        url: "<?php echo $baseURL; ?>ajax_reset_password_link.php",
                        data: {
                            baseURL: '<?php echo $baseURL; ?>',
                            user_info: user_info,
                        },
                        dataType: "json",
                        success: function(response){
                            if(response.status == 'success')
                            {
                                jQuery("#password-reset-link-form").hide();
                                jQuery("#set-new-password-form").show();
                                jQuery("#password_reset_token_mailbox").val(response.token);
                                jQuery("#set_new_password_email").val(response.user_mail);
                            }
                            else
                            {
                                jQuery("#password-reset-link-form").show();
                                jQuery("#set-new-password-form").hide();
                            }
                        }
                    });
                });
                jQuery("#set-new-password-form").submit( function(event) {
                    event.preventDefault();
                    var user_mail = jQuery("#set_new_password_email").val();
                    var token = jQuery("#password_reset_token").val();
                    token = token.toLowerCase();
                    var mailbox_token = jQuery("#password_reset_token_mailbox").val();
                    if(token == mailbox_token)
                    {
                        var new_password = jQuery("#set_new_password").val();
                        var confirm_new_password = jQuery("#confirm_new_password").val();
                        if(new_password == confirm_new_password)
                        {
                            jQuery.ajax({
                                type: "GET",
                                url: "<?php echo $baseURL; ?>ajax_set_new_password.php",
                                data: {
                                    baseURL: '<?php echo $baseURL; ?>',
                                    password: confirm_new_password,
                                    user_mail: user_mail
                                },
                                dataType: "json",
                                success: function(result){
                                    if(result.status == "success")
                                    {
                                        window.location.href="<?php echo $baseURL.'login.php'; ?>";
                                    }
                                }
                            });
                        }
                        else
                        {
                            alert("Password Confirmation in invalid. Try again.");
                        }

                    }
                    else
                    {
                        alert("Password Reset Token in not matching. Try again.");
                    }
                });
            });
        </script>
    </body>
</html>