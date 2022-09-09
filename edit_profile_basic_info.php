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
                                    <li><a href="<?php echo $baseURL; ?>edit_profile.php">Employee Information Form</a></li>
                                    <li>Employee Basic Information Form</li>
                                </ul>
                            </section>
                            <section class="employee-form employee-basic-personal-bank-information">
                                <form method="POST" enctype="multipart/form-data" id="user-info-form">
                                    <h4>User Information</h4>
                                    <?php
                                        $sql1 = "SELECT * FROM capms_admin_users WHERE id = '".$_SESSION['emp_id']."' ";
                                        $result1 = mysqli_query($con, $sql1);
                                        if($result1->num_rows > 0)
                                        {
                                            while($row1 = mysqli_fetch_assoc($result1))
                                            {
                                                ?>
                                                <div class="form-row">
                                                    <!-- Designation  -->
                                                    <div class="form-group col-md-12">
                                                        <label>Designation</label>
                                                        <div class="designation-dd-wrap">
                                                            <?php
                                                                $rank ='';
                                                                $designation ='';
                                                                if($row1['user_designation'] != '')
                                                                {
                                                                    
                                                                    $user_designation_name = $row1['user_designation'];
                                                                    $user_designation_name = explode("-",$user_designation_name);
                                                                    $rank = $user_designation_name[0];
                                                                    $designation = $user_designation_name[1];
                                                                }
                                                            ?>
                                                            <select id="user_designation_rank" name="user_designation_rank" class="form-control">
                                                                <option value="">Select Any Rank</option>
                                                                <option value="Junior" <?php if($rank == 'Junior') { echo 'selected'; } ?> >Junior</option>
                                                                <option value="Senior" <?php if($rank == 'Senior') { echo 'selected'; } ?>>Senior</option>
                                                            </select>

                                                            <select id="user_designation_title" name="user_designation_title" class="form-control">
                                                                <option value="">Select Any Designation</option>  
                                                                <option value="Digital Marketing Executive" <?php if($designation == 'Digital Marketing Executive') { echo 'selected'; } ?>>Digital Marketing Executive</option>
                                                                <option value="Designer" <?php if($designation == 'Designer') { echo 'selected'; } ?>>Designer</option>
                                                                <option value="Frontend Developer" <?php if($designation == 'Frontend Developer') { echo 'selected'; } ?>>Frontend Developer</option>
                                                                <option value="Backend Developer" <?php if($designation == 'Backend Developer') { echo 'selected'; } ?>>Backend Developer</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- Date Of Birth -->
                                                    <div class="form-group col-md-12">
                                                        <label>Date Of Birth</label>
                                                        <input type="date" class="form-control" name="user_dob" id="user_dob" value="<?php if($row1['user_dob'] != '') { echo $row1['user_dob']; }?>" required>
                                                    </div>
                                                    <!-- Address -->
                                                    <div class="form-group col-md-12">
                                                        <label>Address</label>
                                                        <textarea class="form-control" placeholder="Address" name="user_address" id="user_address" required><?php if($row1['user_address'] != '') { echo $row1['user_address']; }?></textarea>
                                                    </div>
                                                    <!-- Gender -->
                                                    <div class="form-group col-md-12">
                                                        <label>Gender</label>
                                                        <?php echo $row1['user_gender']; ?>
                                                        <input type="radio" name="user_gender" id="user_gender" value="Male" <?php if($row1['user_gender'] == 'Male') { echo 'checked'; } ?> />
                                                        <label for="male">Male</label>
                                                        <input type="radio" name="user_gender" id="user_gender" value="Female" <?php if($row1['user_gender'] == 'Female') { echo 'checked'; } ?> />
                                                        <label for="female">Female</label>
                                                    </div>
                                                    <!-- Navigation Button -->
                                                    <div class="col-md-12 text-center">
                                                        <a href="edit_profile.php" class="btn dp-em-nxt-btn frm-previous-btn">Previous</a>
                                                        <input type="submit" name="user_basic_information_update" class="btn dp-em-nxt-btn frm-next-btn" id="user_basic_information_update" value="Next">
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </form>
                                <?php
                                    if(isset($_POST['user_basic_information_update']))
                                    {
                                        if(($_POST['user_designation_rank']!='') && ($_POST['user_designation_title']!=''))
                                        {
                                            $user_designation = $_POST['user_designation_rank'].'-'.$_POST['user_designation_title'];

                                            $sql1 = "UPDATE capms_admin_users SET user_designation = '".$user_designation."', user_dob = '".$_POST['user_dob']."', user_address = '".$_POST['user_address']."', user_gender = '".$_POST['user_gender']."',  updated_at = '".date('Y-m-d h:i:s', strtotime('now'))."' WHERE id = '".$_SESSION['emp_id']."' ";
                                            $result1 = mysqli_query($con, $sql1);
                                            echo "<script>location.href='".$baseURL."edit_profile_personal_info.php';</script>";

                                        }
                                        else
                                        {
                                            echo "<p class='register-error text-danger'>Please select Designation Rank and Title.</p>";
                                        }
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