<!doctype html>
<html lang="en">

<head>
    <!-- Header CSS files -->
    <?php include 'header_css.php'; ?>
    <?php
    if ($_SESSION['emp_id'] == '') {
        echo "<script>location.href='" . $baseURL . "login.php';</script>";
    }
    ?>
    <title>Profile - CERM :: Codearts Employee Relationship Management</title>
    <style media="screen">
    .upload-label {
        display: inline-block;
        line-height: 2.2em;
        padding: 0 0.62em;
        border: 1px solid #666;
        border-radius: 0.25em;
        background-image: linear-gradient(to bottom, #fff, #ccc);
        box-shadow: inset 0 0 0.1em #fff, 0.2em 0.2em 0.2em rgba(0, 0, 0, 0.3);
        font-family: arial, sans-serif;
        font-size: 0.8em;
    }

    .upload-label:hover {
        border-color: #3c7fb1;
        background-image: linear-gradient(to bottom, #fff, #a9dbf6);
    }

    .upload-label:focus {
        padding: 0 0.56em 0 0.68em;
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
                            <h2>Profile</h2>
                            <ul>
                                <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                <li>Profile</li>
                            </ul>
                        </section>
                        <?php
                        $sql1 = "SELECT * FROM capms_admin_users WHERE id = '" . $_SESSION['emp_id'] . "' ";
                        $result1 = mysqli_query($con, $sql1);
                        if ($result1->num_rows > 0) {
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                        ?>
                                <section class="custom-employee-profile">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="em-pro-main-details">
                                                <div class="media em-pro-main-media"> 
                                                <!-- Button trigger modal -->
                                                <button type="button" data-toggle="modal" data-target="#exampleModal" style="border: none; appearance: none; cursor: pointer; background-color: inherit;" aria-expanded="false">
                                                <img class="mr-3" src="assets/uploads/user_featured_images/<?php echo $row1['user_featured_image']; ?>" id="userImg" width=200 height=250 alt="Employee Image"/>
                                                </button>
                                                <!-- Fullscreen Image Modal -->
                                                <div class="modal fade vw-100" id="fullimagemodal" tabindex="-1" role="dialog" aria-labelledby="fullimagemodal" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <img class="mr-3 w-100" src="assets/uploads/user_featured_images/<?php echo $row1['user_featured_image']; ?>" alt="Employee Image">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Update Image Modal -->
                                                <div class="modal fade vw-100" id="updateimagemodal" tabindex="-1" role="dialog" aria-labelledby="updateimagemodal" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <form method="POST" action="update_image.php?id=<?php echo $row1['id']; ?>" enctype="multipart/form-data">
                                                                <img class="mr-3 w-100" src="assets/uploads/user_featured_images/<?php echo $row1['user_featured_image']; ?>" id="output" name="u_image" alt="Employee Image">
                                                                <div class="form-group">
                                                                <img id="output" class="mr-3 w-100" />
                                                                <p><input type="file" accept="image/*" name="u_img" id="u_img" onchange="loadFile(event)"></p>
                                                                </div>
                                                                <!-- <p class="h5" style="text-align:center"><label for="file" class="upload-label" tabindex="1">Upload Image</label></p> -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-primary" name="updateimg">Update Image</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-target="#fullimagemodal" data-toggle="modal" data-dismiss="modal">View Image</button>
                                                                <button type="button" class="btn btn-secondary" data-target="#updateimagemodal" data-toggle="modal" data-dismiss="modal">Update Image</button>
                                                                <!-- <a href="update_image.php?id=<?php //echo $row1['id']; ?>"><button class="btn btn-secondary">Update Image</button></a> -->
                                                                <a href="remove_image.php?id=<?php echo $row1['id']; ?>"><button class="btn btn-danger">Remove Image</button></a>
                                                                <!-- <form method="POST" action="">
                                                                    <button type="submit" value="rmvImg" class="btn btn-danger" data-dismiss="modal">Remove Image</button>
                                                                </form> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="media-body">
                                                        <h4><?php echo $row1['user_fullname']; ?></h4>
                                                        <?php if($row1['user_designation']) { ?>
                                                            <p class="demo"><?php echo $row1['user_designation']; ?></p>
                                                        <?php } ?>
                                                        <span class="employee-id">Employee ID : <?php echo $row1['user_empid']; ?></span>
                                                        <p class="demo">Date of Join : <?php echo $row1['user_joining_date']; ?></p>
                                                        <a href="edit_profile.php" class="snd-msg-emp">Edit Profile</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="em-pro-contact-details">
                                                <div class="contact-pin"> <a href="edit_profile.php"><span class="demo"><i class="fas fa-thumbtack"></i></span></a>
                                                </div>
                                                <ul class="common-details  employee-contact-list">
                                                    <li><span>Phone: </span><a href="tel:9876543210;"><?php echo $row1['user_contact']; ?></a></li>
                                                    <li><span>Email: </span>
                                                        <a href="mailto:johndoe@example.com;"><?php echo $row1['user_email']; ?></a>
                                                    </li>
                                                    <?php if($row1['user_dob']) { ?>
                                                    <li><span>Birthday: </span>
                                                        <p class="demo">
                                                            <?php echo $row1['user_dob']; ?></p>

                                                    </li>
                                                    <?php } ?>
                                                    <?php if($row1['user_address']) { ?>
                                                    <li><span>Address: </span>
                                                        <p class="demo">
                                                            <?php echo $row1['user_address']; ?></p>
                                                    </li>
                                                    <?php } ?>
                                                    <?php if($row1['user_gender']) { ?>
                                                    <li><span>Gender: </span>
                                                        <p class="demo">
                                                            <?php echo $row1['user_gender']; ?></p>

                                                    </li>
                                                    <?php } ?>
                                                    
                                                        <?php
                                                        // $sql = "SELECT user_featured_image, user_fullname FROM capms_admin_users WHERE user_empid = '" . $row1['reports_to_uid'] . "' ";
                                                        // $report_query = mysqli_query($con, $sql);
                                                        // if ($report_query->num_rows > 0) {
                                                        //     while ($report_row = mysqli_fetch_assoc($report_query)) {
                                                        ?>
                                                    <!-- <li><span>Reports to: </span><a href="#"><span> <img class="mr-3" src="assets/uploads/user_featured_images/<?php //echo $report_row['user_featured_image']; ?>" alt="Employee Image">
                                                            </span>
                                                            <p class="demo d-inline"><?php //echo $report_row['user_fullname']; ?></p>
                                                        </a></li> -->

                                                        <?php
                                                                    //     }
                                                                    // } else {
                                                                    //     //echo '<p class="demo">Null</p>';
                                                                    // }

                                                        ?>
                                                        






                                            </select>

                                            </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="show">
                                    <div class="overlay"></div>
                                    <div class="img-show">
                                        <span>X</span>
                                        <img src="">
                                    </div>
                                </div>
                                <section class="custom-profile-information-tab">
                                    <ul class="nav nav-tabs dp-information-tab" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Profile</a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Projects</a> </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content information-tab-content">
                                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                            <div class="common-info-outer-wrap">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="common-info-inner-wrap">
                                                            <h4>Personal Informations</h4>
                                                            <div class="contact-pin"> <a href="edit_profile.php"><span class="demo"><i class="fas fa-thumbtack"></i></span></a> </div>
                                                            <ul class="common-details  per-info-list">
                                                            <?php if($row1['user_passport_number']) { ?>    
                                                                <li><span>Passport No: </span>
                                                                    <p class="demo"><?php echo $row1['user_passport_number']; ?></p>
                                                                </li>
                                                            <?php } ?>    
                                                            
                                                            <?php if($row1['user_nationality']) { ?> 
                                                                <li><span>Nationality: </span>
                                                                    <p class="demo"><?php echo $row1['user_nationality']; ?></p>
                                                                </li>
                                                            <?php } ?>   
                                                            <?php //if($row1['user_religion']) { ?> 
                                                                <!-- <li><span>Religion: </span>
                                                                    <p class="demo"><?php //echo $row1['user_religion']; ?></p>
                                                                </li> -->
                                                            <?php //} ?>
                                                               
                                                            <?php if($row1['user_marital_status']) { ?> 
                                                                <li><span>Marital status: </span>
                                                                    <p class="demo"><?php echo $row1['user_marital_status']; ?></p>
                                                                </li>

                                                            <?php } ?>    
                                                            

                                                            <?php //if($row1['user_employment_of_spouse']) { ?> 

                                                                <!-- <li><span>Employment of spouse: </span>
                                                                    <p class="demo"><?php //echo $row1['user_employment_of_spouse']; ?></p>
                                                                </li> -->
                                                            <?php //} ?>    

                                                        
                                                            <?php //if($row1['user_children_number']) { ?>   
                                                                <!-- <li><span>No. of children: </span>
                                                                    <p class="demo"><?php //echo $row1['user_children_number']; ?></p>
                                                                </li> -->
                                                            <?php //} ?>    
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="common-info-inner-wrap">
                                                            <h4>Bank information</h4>
                                                            <div class="contact-pin"> <a href="edit_profile_emargency_contact.php"><span class="demo"><i class="fas fa-thumbtack"></i></span> </a></div>
                                                            <ul class="common-details  per-info-list">
                                                                <?php if($row1['user_bank_name']) { ?>
                                                                <li><span>Bank name: </span>
                                                                    <p class="demo"><?php echo $row1['user_bank_name']; ?></p>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if($row1['user_bank_account_no']) { ?>
                                                                <li><span>Bank account No: </span>
                                                                    <p class="demo"><?php echo $row1['user_bank_account_no']; ?></p>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if($row1['user_bank_ifsc_code']) { ?>
                                                                <li><span>IFSC Code: </span>
                                                                    <p class="demo"><?php echo $row1['user_bank_ifsc_code']; ?></p>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if($row1['user_pan_number']) { ?>
                                                                <li><span>PAN No: </span>
                                                                    <p class="demo"><?php echo $row1['user_pan_number']; ?></p>
                                                                </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="common-info-inner-wrap emergency-info">
                                                            <h4>Emergency Contact</h4>
                                                            <div class="contact-pin"> <a href="edit_profile_emargency_contact.php"><span class="demo"><i class="fas fa-thumbtack"></i></span> </a></div>
                                                            <ul class="common-details  per-info-list">
                                                                <h5>Primary</h5>
                                                                <?php if($row1['emergency_primary_name']) { ?>
                                                                <li><span>Name: </span>
                                                                    <p class="demo"><?php echo $row1['emergency_primary_name']; ?></p>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if($row1['emergency_primary_relation']) { ?>
                                                                <li>
                                                                    <span>Relationship:</span>
                                                                    <p class="demo"><?php echo $row1['emergency_primary_relation']; ?></p>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if($row1['emergency_primary_contact']) { ?>
                                                                <li><span>phone: </span>
                                                                    <p class="demo"><?php echo $row1['emergency_primary_contact']; ?></p>
                                                                </li>
                                                                <?php } ?>    
                                                            </ul>
                                                            <ul class="common-details  per-info-list">
                                                                <h5>Secondary</h5>
                                                                <?php if($row1['emergency_secondary_name']) { ?>
                                                                <li><span>Name: </span>
                                                                    <p class="demo"><?php echo $row1['emergency_secondary_name']; ?></p>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if($row1['emergency_secondary_relation']) {  ?>
                                                                <li><span>Relationship: </span>
                                                                    <p class="demo"><?php echo $row1['emergency_secondary_relation']; ?></p>
                                                                </li>
                                                                <?php } ?>
                                                                <?php if($row1['emergency_secondary_contact']) {  ?>
                                                                <li><span>Phone: </span>
                                                                    <p class="demo"><?php echo $row1['emergency_secondary_contact']; ?></p>
                                                                </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="common-info-inner-wrap">
                                                            <h4>Education Informations</h4>
                                                            <?php
                                                            $sql2 = "SELECT * FROM `capms_user_education_info` WHERE user_id = '" . $_SESSION['emp_id'] . "' ";
                                                            $result2 = mysqli_query($con, $sql2);
                                                            if ($result2->num_rows > 0) {
                                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                            ?>
                                                                    <div class="contact-pin"> <a href="edit_profile_emargency_contact.php"><span class="demo"><i class="fas fa-thumbtack"></i></span> </a></div>
                                                                    <ul class="custom-education-exp-list education-custom">
                                                                        <li>
                                                                            <h6><?php echo $row2['secondary_institute'] ?></h6>
                                                                            <p class="demo"><?php echo $row2['secondary_board'] ?></p>
                                                                            <p class="demo"><?php echo $row2['secondary_yop'] ?> to <?php echo $row2['secondary_yop'] ?></p>
                                                                            <p class="demo"><?php echo $row2['secondary_exam_percentage'] ?>%<span class="px-3">(secondary)</span></p>
                                                                        </li>
                                                                        <li>
                                                                            <h6><?php echo $row2['higher_secondary_institute'] ?></h6>
                                                                            <p class="demo"><?php echo $row2['higher_secondary_board'] ?></p>
                                                                            <p class="demo"><?php echo $row2['higher_secondary_start_date'] ?> to <?php echo $row2['higher_secondary_end_date'] ?></p>
                                                                            <p class="demo"><?php echo $row2['higher_secondary_exam_percentage'] ?>%<span class="px-3">(higher secondary)</span></p>
                                                                        </li>
                                                                        <li>
                                                                            
                                                                            <h6><?php print_r($row2['ug_institute_name']);?></h6>
                                                                            <p class="demo"><?php echo $row2['ug_university_name'] ?></p>
                                                                            <p class="demo"><?php echo $row2['ug_start_year'] ?> to <?php echo $row2['ug_finish_year'] ?></p>
                                                                            <p class="demo"><?php echo $row2['ug_passing_percentage'] ?>%<span class="px-3">(ug)</span></p>
                                                                        </li>
                                                                        
                                                                        <li>
                                                                        <?php if($row2['pg_institute_name']) { ?>
                                                                            <h6><?php echo $row2['pg_institute_name'] ?></h6>
                                                                        <?php } ?>  
                                                                        <?php if($row2['pg_start_year']) { ?>  
                                                                            <p class="demo"><?php echo $row2['pg_start_year'] ?></p>
                                                                        <?php } ?>     
                                                                        <?php if($row2['pg_start_year']) { ?>    
                                                                            <p class="demo"><?php echo $row2['pg_start_year'] ?> to <?php echo $row2['pg_finish_year'] ?></p>
                                                                        <?php } ?> 
                                                                        <?php if($row2['pg_passing_percentage']) { ?> 
                                                                            <p class="demo"><?php echo $row2['pg_passing_percentage'] ?>%<span class="px-3">(pg)</span></p>
                                                                        <?php } ?>     
                                                                        </li>
                                                                    </ul>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                                            <p>Second Panel</p>
                                        </div>
                                        
                                    </div>
                                </section>
                        <?php }
                        } ?>
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
    <script>
        var loadFile = function (event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
            // var uImg = document.getElementById('updateImg');
            // uImg.style.visibility = 'hidden';
        };
    </script>
</body>

</html>