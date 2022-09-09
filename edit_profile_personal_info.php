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
                                    <li>Employee Personal Information Form</li>
                                </ul>
                            </section>
                             <section class="employee-form employee-basic-personal-bank-information">
        	                    <form method="POST" enctype="multipart/form-data" id="user-info-form">
                                        <h4>Personal Informations</h4>
                                        <?php
                                            $query = "SELECT * FROM capms_admin_users WHERE id = '".$_SESSION['emp_id']."' ";
                                            $result = mysqli_query($con, $query);
                                            if($result->num_rows > 0){
                                                while($row = mysqli_fetch_assoc($result)){
                                                    ?>
                                                    <div class="form-group col-md-12">    
                                                        <label>Passport No</label>            
                                                        <input type="text" class="form-control"  placeholder="Passport Number" name="passport_no" value="<?php if($row['user_passport_number']!=''){echo $row['user_passport_number'];} ?>">
                                                    </div>
                                                    <div class="form-group col-md-12">    
                                                        <label>Adhar No</label>            
                                                        <input type="text" class="form-control"  placeholder="Adhar Number" name="adhar_number" value="<?php if($row['user_adhar_number']!=''){echo $row['user_adhar_number'];} ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-12">    
                                                        <label>Voter No</label>            
                                                        <input type="text" class="form-control"  placeholder="Voter Number" name="voter_id" value="<?php if($row['user_voter_id']!=''){echo $row['user_voter_id'];} ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-12">    
                                                        <label>Pan No</label>            
                                                        <input type="text" class="form-control"  placeholder="Pan Number" name="pan_number" value="<?php if($row['user_pan_number']!=''){echo $row['user_pan_number'];} ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-12">    
                                                        <label>Nationality</label>            
                                                        <input type="text" class="form-control" placeholder="Your Nationality" name="nationality" value="<?php if($row['user_nationality']!=''){echo $row['user_nationality'];} ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-12">    
                                                        <label>Religion</label>            
                                                        <input type="text" class="form-control" placeholder="Your Religion" name="religion" value="<?php if($row['user_religion']!=''){echo $row['user_religion'];} ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-12">    
                                                        <label>Marital status</label>            
                                                        <select class="form-control" id="user_marital_status" name="user_marital_status">
                                                        <option>Choose Option</option>
                                                        <option value="Single" <?php if($row['user_marital_status'] == 'Single') { echo 'selected'; } ?>>Single</option>
                                                        <option value="Engaged" <?php if($row['user_marital_status'] == 'Engaged') { echo 'selected'; } ?>>Engaged</option>
                                                        <option value="Single" <?php if($row['user_marital_status'] == 'Married') { echo 'selected'; } ?>>Married</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">    
                                                        <label>Employment of spouse</label>            
                                                        <select class="form-control" id="user_employment_of_spouse" name="user_employment_of_spouse">
                                                        <option>Choose Option</option>
                                                        <option value="Yes" <?php if($row['user_employment_of_spouse'] == 'Yes') { echo 'selected'; } ?>>Yes</option>
                                                        <option value="No" <?php if($row['user_employment_of_spouse'] == 'No') { echo 'selected'; } ?>>No</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">    
                                                        <label>No. of children</label>            
                                                        <input type="text" class="form-control" placeholder="Number of children" name="number_of_children" value="<?php if($row['user_children_number']!=''){echo $row['user_children_number'];} ?>">
                                                    </div>

                                                    <div class="col-md-12 text-center">
                                                        <button type="submit" name="user_personal_info_update" class="btn dp-em-nxt-btn">Next</button>
                                                    </div>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </form>
                                    <?php
                                        if(isset($_POST['user_personal_info_update']))
                                        {
                                            $query = "UPDATE capms_admin_users SET user_passport_number = '".$_POST['passport_no']."' , user_adhar_number = '".$_POST['adhar_number']."', user_voter_id = '".$_POST['voter_id']."', user_pan_number = '".$_POST['pan_number']."', user_nationality = '".$_POST['nationality']."', user_religion = '".$_POST['religion']."', user_marital_status = '".$_POST['user_marital_status']."' , user_employment_of_spouse = '".$_POST['user_employment_of_spouse']."', user_children_number = '".$_POST['number_of_children']."' WHERE id = '".$_SESSION['emp_id']."' ";
                                            $result = mysqli_query($con,$query);
                                            echo "<script>location.href='".$baseURL."edit_profile_emargency_contact.php';</script>";
                                        } 
                                    ?>
                                </section>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="custom-footer">
            <!-- Copyright Content file -->
            <?php include 'copyright_content.php'; ?>
        </footer>
        <!-- Footer JS files -->
    </body>
</html>