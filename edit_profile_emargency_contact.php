<?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE); 
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
                                    <li>Employee Emargency Contact Information Form</li>
                                </ul>
                            </section>
                             <section class="employee-form employee-basic-personal-bank-information">
                                <form method="POST" enctype="multipart/form-data" id="user-info-form">
                                    <?php
                                        $query = "SELECT * FROM capms_admin_users WHERE id = '".$_SESSION['emp_id']."' ";
                                        $result = mysqli_query($con,$query);
                                        if($result->num_rows > 0){
                                            while($row1 = mysqli_fetch_assoc($result))
                                            {
                                                ?>
                                            <h4>Emergency Contact</h4>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">    
                                                    <label>Primary</label> 
                                                    <div class="form-row">
                                                        <div class="col-md-4">
                                                        <input type="text" class="form-control" placeholder=" Full Name" name="p_fullname" value="<?php if($row1['emergency_primary_name']!=''){echo $row1['emergency_primary_name'];} ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" placeholder="Relationship" name="p_relation" value="<?php if($row1['emergency_primary_relation']!=''){echo $row1['emergency_primary_relation'];} ?>">
                                                    </div>  
                                                    <div class="col-md-4">
                                                        <input type="tel" class="form-control" placeholder=" Contact Number" name="p_contact" value="<?php if($row1['emergency_primary_contact']!=''){echo $row1['emergency_primary_contact'];} ?>">
                                                    </div> 
                                                </div>
                                            </div>
                                                
                                            <div class="form-group col-md-12">    
                                                <label>Secondary</label> 
                                                <div class="form-row">
                                                    <div class="col-md-4">
                                                    <input type="text" class="form-control" placeholder=" Full Name" name="s_fullname" value="<?php if($row1['emergency_secondary_name']!=''){echo $row1['emergency_secondary_name'];} ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" placeholder="Relationship" name="s_relation" value="<?php if($row1['emergency_secondary_relation']!=''){echo $row1['emergency_secondary_relation'];} ?>">
                                                    </div>  
                                                    <div class="col-md-4">
                                                        <input type="tel" class="form-control" placeholder="Contact Number" name="s_contact" value="<?php if($row1['emergency_secondary_contact']!=''){echo $row1['emergency_secondary_contact'];} ?>">
                                                    </div> 
                                                </div>
                                            </div>
                                                
                                                <div class="custom-devider-dp"></div>
                                                
                                            <h4>Bank Information</h4>                  
                                                <div class="form-group col-md-12">    
                                                    <label>Bank name</label> 
                                                    <input type="text" class="form-control" placeholder="Bank" name="bank_name" value="<?php if($row1['user_bank_name']!=''){echo $row1['user_bank_name'];} ?>">
                                                </div>

                                                <div class="form-group col-md-12">    
                                                    <label>IFSC Code</label> 
                                                    <input type="text" class="form-control" placeholder="Code" name="bank_ifsc" value="<?php if($row1['user_bank_ifsc_code']!=''){echo $row1['user_bank_ifsc_code'];} ?>">
                                                </div>

                                                <div class="form-group col-md-12">    
                                                    <label>Bank account No</label> 
                                                    <input type="text" class="form-control" placeholder="Account No" name="user_acc_number" value="<?php if($row1['user_bank_account_no']!=''){echo $row1['user_bank_account_no'];} ?>">
                                                </div>
                                                
                                                <div class="col-md-12 text-center">
                                                    <a href="edit_profile_personal_info.php" class="btn dp-em-nxt-btn frm-previous-btn">Previous</a>
                                                    <button type="submit" class="btn dp-em-nxt-btn" name="emergency_form_btn">Next</button>
                                                </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                </form>
                                <?php
                                    if(isset($_POST['emergency_form_btn']))
                                    {
                                        $query = "UPDATE capms_admin_users SET emergency_primary_name = '".$_POST['p_fullname']."' , emergency_primary_relation = '".$_POST['p_relation']."', emergency_primary_contact = '".$_POST['p_contact']."', emergency_secondary_name = '".$_POST['s_fullname']."', emergency_secondary_relation = '".$_POST['s_relation']."', emergency_secondary_contact = '".$_POST['s_contact']."' , user_bank_name = '".$_POST['bank_name']."', user_bank_ifsc_code = '".$_POST['bank_ifsc']."', user_bank_account_no = '".$_POST['user_acc_number']."' WHERE id = '".$_SESSION['emp_id']."' ";
                                        $result1 = mysqli_query($con, $query);
                                        echo "<script>location.href='".$baseURL."edit_profile_education_info.php';</script>";
                                    }
                                    
                                ?>
                            </section>
                    </div> 
        </main>
        <footer class="custom-footer">
            <!-- Copyright Content file -->
            <?php include 'copyright_content.php'; ?>
        </footer>
        <!-- Footer JS files -->
    </body>
    <!-- new file -->
</html>