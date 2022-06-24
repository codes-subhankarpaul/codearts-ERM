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
                jQuery("#password-reset-link-form").submit( function(event) {
                    event.preventDefault();
                    var user_info = jQuery("#user_info").val();
                    jQuery.ajax({
                        type: "GET",
                        url: "<?php echo $baseURL; ?>ajax_reset_password_link.php",
                        data: {
                            user_info: user_info,
                        },
                        dataType: "json",
                        success: function(response){
                            console.log(response);
                        }
                    });
                });
            });
        </script>
    </body>
</html>