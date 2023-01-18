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
                                    <li>Employee Information Form</li>
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
                                                    <!-- Fullname  -->
                                                    <div class="form-group col-md-12">
                                                        <label>Fullname</label>
                                                        <input type="text" class="form-control" placeholder="Fullname" name="user_fullname" id="user_fullname" value="<?php if($row1['user_fullname'] != '') { echo $row1['user_fullname']; }?>" required>
                                                    </div>
                                                    <!-- EMP ID -->
                                                    <div class="form-group col-md-12">
                                                        <label>Employee ID</label>
                                                        <input type="text" class="form-control" placeholder="Employee ID" name="user_empid" id="user_empid" value="<?php if($row1['user_empid'] != '') { echo $row1['user_empid']; }?>" disabled>
                                                    </div>
                                                    <!-- Email Address -->
                                                    <div class="form-group col-md-12">
                                                        <label>Email Address</label>
                                                        <input type="email" class="form-control" placeholder="Email Address" name="user_email" id="user_email" value="<?php if($row1['user_email'] != '') { echo $row1['user_email']; }?>" required>
                                                    </div>
                                                    <!-- Contact Number -->
                                                    <div class="form-group col-md-12">
                                                        <label>Contact Number</label>
                                                        <input type="text" class="form-control" placeholder="Contact Number" name="user_contact" id="user_contact" value="<?php if($row1['user_contact'] != '') { echo $row1['user_contact']; }?>" required>
                                                    </div>
                                                    <!-- Joining Date -->
                                                    <div class="form-group col-md-12">
                                                        <label>Joining Date</label>
                                                        <input type="date" class="form-control" name="user_joining_date" id="user_joining_date" value="<?php if($row1['user_joining_date'] != '') { echo $row1['user_joining_date']; }?>" required>
                                                    </div>
                                                    <!-- Featured Image -->
                                                    <div class="form-group col-md-12">
                                                        <label>Featured Image</label>
                                                        <span class="featured-img-wrap">
                                                            <img src="<?php if($row1['user_featured_image'] != '') { echo 'assets/uploads/user_featured_images/'.$row1['user_featured_image']; }?>" title="<?php if($row1['user_fullname'] != '') { echo $row1['user_fullname']; }?>" alt="<?php if($row1['user_fullname'] != '') { echo $row1['user_fullname']; }?>" class="user-featured-img" width=150 height=180>
                                                        </span>
                                                        <input type="file" class="form-control" name="user_featured_image" id="user_featured_image">
                                                    </div>

                                                    <?php
                                                        $report_original_query = "SELECT reports_to_uid FROM capms_admin_users WHERE id = '".$_SESSION['emp_id']."' ";
                                                        $reportOriginalResult = mysqli_query($con, $report_original_query);
                                                        if($reportOriginalResult-> num_rows > 0) {
                                                            while($reportOriginalRow = mysqli_fetch_assoc($reportOriginalResult)){
                                                                $reports_to_uid_original = $reportOriginalRow['reports_to_uid'];
                                                            }
                                                        }
                                                    ?>


                                                    <!-- reports to -->
                                                    <div class="form-group col-md-12">
                                                        <label>Reports to</label>
                                                        <select type="text" class="form-control" name="select_reports_to" id="Reports_to_dropdown">
                                                        <option> CHOOSE ONE..</option>
                                                        <?php
                                                            $report_query = "SELECT * FROM capms_admin_users WHERE id != '".$_SESSION['emp_id']."' ";
                                                            $reportResult = mysqli_query($con, $report_query);
                                                            if($reportResult-> num_rows > 0) {
                                                                while($reportRow = mysqli_fetch_assoc($reportResult)){
                                                        ?>
                                                            <option value="<?php echo $reportRow['user_empid'];?>" <?php if($reports_to_uid_original == $reportRow['user_empid']) { echo 'selected'; } ?>><?php echo $reportRow['user_fullname']; ?></option>
                                                             
                                                                <?php
                                                                }
                                                                ?>
                                                           <?php
                                                            }
                                                            ?>
                                                        
                                                        </select>
                                                        
                                                    </div>



                                                    <!-- Salary -->
                                                    <div class="form-group col-md-12">
                                                        <label>Salary</label>
                                                        <input type="text" class="form-control" placeholder="Salary" name="user_salary" id="user_salary" value="<?php if($row1['user_salary'] != '') { echo $row1['user_salary']; }?>" disabled>
                                                    </div>
                                                    <!-- Navigation Button -->
                                                    <div class="col-md-12 text-center">
                                                        <!-- <a href="profile.php" class="btn dp-em-nxt-btn frm-previous-btn">Previous</a> -->
                                                        <input type="submit" name="user_information_update" class="btn dp-em-nxt-btn frm-next-btn" id="user_information_update" value="Next">
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                </form>
                                <?php
                                    if(isset($_POST['user_information_update']))
                                    {
                                        $sql1 = "UPDATE capms_admin_users SET user_fullname = '".$_POST['user_fullname']."', user_email = '".$_POST['user_email']."', user_contact = '".$_POST['user_contact']."', updated_at = '".date('Y-m-d h:i:s', strtotime('now'))."' WHERE id = '".$_SESSION['emp_id']."' ";
                                        $result1 = mysqli_query($con, $sql1);

                                        if(isset($_FILES['user_featured_image'])) {
                                            $errors     = "";
                                            if ($_FILES["user_featured_image"]["size"] > 500000) 
                                                echo "Sorry, your file is too large.";
                                            // echo $errors;
                                        }
                                        else{
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
                                                        $sql3 = "UPDATE capms_admin_users SET user_featured_image = '".$timestamp."' WHERE id = '".$_SESSION['emp_id']."' ";
                                                        mysqli_query($con, $sql3);
                                                    }
                                                }
                                            }
                                        }

                                        $sql4="UPDATE capms_admin_users SET reports_to_uid='".$_POST['select_reports_to']."' WHERE id='".$_SESSION['emp_id']."'";
                                        $query=mysqli_query($con,$sql4);

                                        echo "<script>location.href='".$baseURL."edit_profile_basic_info.php';</script>";
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