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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <title>Change Password - CERM :: Codearts Employee Relationship Management</title>
        <style>
            .ui-datepicker-calendar {
                display: none;
            }
        </style>
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
                            <h2>Change Password</h2>
                            <ul>
                                <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                <li><a href="<?php echo $baseURL; ?>payslip_add.php">Change Password</a></li>
                            </ul>
                        </section>
                        <div id="myDIV">
                            <h1 style="text-decoration: underline;" class="text-center">Change Password </h1>
                            <div class="custom-login-form">
                                <form method="POST" id="set-new-password-form">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Old Password" id="old_password" name="old_password" required>
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
                                        <button class="btn btn-primary" name="set" id="set">Set New Password</button>
                                    </div>
                                </form>
                            </div>
                            <?php
                                if(isset($_POST['set'])){
                                    if($_POST['old_password']=='' || $_POST['set_new_password']=='' || $_POST['confirm_new_password']==''){
                                        echo "<p class='text-danger'>Please enter all the fields.</p>";
                                    }
                                    else{
                                        $old_password = $_POST['old_password'];
                                        $password = $_POST['set_new_password'];
                                        $sql="SELECT * FROM capms_admin_users WHERE id='".$_SESSION['emp_id']."'";
                                        $result1=mysqli_query($con,$sql);
                                        if($result1->num_rows > 0)
                                        {
                                            while($row1 = mysqli_fetch_assoc($result1))
                                            {
                                                if( md5($old_password) == $row1['user_password'] )
                                                {
                                                    if($_POST['set_new_password']==$_POST['confirm_new_password']){
                                                        $sql2 = "UPDATE capms_admin_users SET user_password = '".md5($password)."', updated_at = '".date('Y-m-d h:i:s', strtotime('now'))."' WHERE id = '".$_SESSION['emp_id']."' ";
                                                        $result2 = mysqli_query($con, $sql2);
                                                        echo "<p class='text-success'>Password changed successfully.Please login with the new one.</p>";
                                                        echo "<script>
                                                            alert('Password changed successfully.Please login with the new one.');
                                                            location.href='".$baseURL."logout.php';
                                                            </script>";
                                                        
                                                    }
                                                    else{
                                                        echo "<p class='text-danger'>Password and Confirm Password not matched. Please enter it correctly.</p>";
                                                    }
                                                }
                                                else{
                                                    echo "<p class='text-danger'>Please enter correct password to set the new one.</p>";
                                                }
                                            }
                                        }
                                    }    
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>