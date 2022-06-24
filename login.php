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
        <title>Log In - CERM :: Codearts Employee Relationship Management</title>
    </head>

    <body>
        <section class="custom-login">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 pl-0 pr-0 align-self-center">
                        <div class="custom-login-left" style="background-image: url(assets/images/login-left-img.jpg);">
                            <div class="custom-login-left-wrap">
                                <div class="login-content">
                                    <h3>Login</h3>
                                    <p class="demo">Enter the Email Address or Contact Number associated with your Account.
                                    </p>
                                </div>
                                <div class="custom-login-form">
                                    <form method="POST" id="login-form">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Username or Email ID or Contact Number" id="login_username" name="login_username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="Password" id="login_password" name="login_password" required>
                                        </div>
                                        <div class="form-group form-check">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="reset-wrapper">
                                                        <button type="reset" class="btn dp-login-reset-btn">Reset Credentials</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="dp-forget-pw">
                                                        <a href="forget_password.php">Forgot Password ?</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary dp-login-btn" id="user_login">Login</button>
                                        </div>
                                    </form>
                                    <div class="dp-register-ac register_now">
                                        <p class="demo">Don't Have An Account? <a href="register.php">Register Here</a>
                                        </p>
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
        
                jQuery("#login-form").submit( function(event) {
                    event.preventDefault();
                    var login_username = jQuery("#login_username").val();
                    var login_password = jQuery("#login_password").val();
                    jQuery.ajax({
                        type: "GET",
                        url: "<?php echo $baseURL; ?>ajax_user_login.php",
                        data: {
                            baseURL: '<?php echo $baseURL; ?>',
                            login_username: login_username,
                            login_password: login_password,
                        },
                        dataType: "json",
                        success: function(response){
                            console.log(response);
                            if(response.status == 'success')
                            {
                                window.location.href="<?php echo $baseURL; ?>";
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>