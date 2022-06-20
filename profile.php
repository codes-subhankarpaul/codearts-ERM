<!doctype html>
<html lang="en">

    <head>    
        <!-- Header CSS files -->
        <?php include 'header_css.php'; ?>
        <?php
            if($_SESSION['emp_id'] == '')
            {
              echo "<script>location.href='http://codeartssolution.com/ERM/login.php';</script>";
            }
        ?>
        <title>Profile - CERM :: Codearts Employee Relationship Management</title>
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
                                $sql1 = "SELECT * FROM capms_admin_users WHERE id = '".$_SESSION['emp_id']."' ";
                                $result1 = mysqli_query($con, $sql1);
                                if($result1->num_rows > 0)
                                {
                                    while($row1 = mysqli_fetch_assoc($result1))
                                    {
                                        ?>
                                <section class="custom-employee-profile">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="em-pro-main-details">
                                                <div class="media em-pro-main-media"> <img class="mr-3"
                                                        src="assets/images/client-img-1.jpg" alt="Employee Image">
                                                    <div class="media-body">
                                                        <h4><?php echo $row1['user_fullname']; ?></h4>
                                                        <p class="demo">UI/UX Design Team</p>
                                                        <p class="demo">Web Designer</p>
                                                        <span class="employee-id">Employee ID : FT-0001</span>
                                                        <p class="demo">Date of Join : <?php echo $row1['user_joining_date']; ?></p>
                                                        <a href="edit_profile.php" class="snd-msg-emp">Edit Profile</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="em-pro-contact-details">
                                                <div class="contact-pin"> <span class="demo"><i class="fas fa-thumbtack"></i></span>
                                                </div>
                                                <ul class="common-details  employee-contact-list">
                                                    <li><span>Phone: </span><a href="tel:9876543210;">9876543210</a></li>
                                                    <li><span>Email: </span><a
                                                            href="mailto:johndoe@example.com;">johndoe@example.com</a></li>
                                                    <li><span>Birthday: </span>
                                                        <p class="demo">24th July</p>
                                                    </li>
                                                    <li><span>Address: </span>
                                                        <p class="demo">1861 Bayonne Ave, Manchester Township, NJ, 08759</p>
                                                    </li>
                                                    <li><span>Gender: </span>
                                                        <p class="demo">Male</p>
                                                    </li>
                                                    <li><span>Reports to: </span><a href="#"><span><img src="assets/images/admin-img.jpg"
                                                                    alt=""></span> Jeffery Lalor</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section class="custom-profile-information-tab">
                                    <ul class="nav nav-tabs dp-information-tab" role="tablist">
                                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tabs-1"
                                                role="tab">Profile</a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tabs-2"
                                                role="tab">Projects</a> </li>
                                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Bank &
                                                Statutory <span>(Admin Only)</span></a> </li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content information-tab-content">
                                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                            <div class="common-info-outer-wrap">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="common-info-inner-wrap">
                                                            <h4>Personal Informations</h4>
                                                            <div class="contact-pin"> <span class="demo"><i
                                                                        class="fas fa-thumbtack"></i></span> </div>
                                                            <ul class="common-details  per-info-list">
                                                                <li><span>Passport No: </span>
                                                                    <p class="demo">9876543210</p>
                                                                </li>
                                                                <li><span>Passport Exp Date: </span>
                                                                    <p class="demo">9876525412</p>
                                                                </li>
                                                                <li><span>Tel: </span>
                                                                    <p class="demo">24th July</p>
                                                                </li>
                                                                <li><span>Nationality: </span>
                                                                    <p class="demo">Indian</p>
                                                                </li>
                                                                <li><span>Religion: </span>
                                                                    <p class="demo">Christian</p>
                                                                </li>
                                                                <li><span>Marital status: </span>
                                                                    <p class="demo">Married</p>
                                                                </li>
                                                                <li><span>Employment of spouse: </span>
                                                                    <p class="demo">No</p>
                                                                </li>
                                                                <li><span>No. of children: </span>
                                                                    <p class="demo">2</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="common-info-inner-wrap emergency-info">
                                                            <h4>Emergency Contact</h4>
                                                            <div class="contact-pin"> <span class="demo"><i
                                                                        class="fas fa-thumbtack"></i></span> </div>
                                                            <ul class="common-details  per-info-list">
                                                                <h5>Primary</h5>
                                                                <li><span>Name: </span>
                                                                    <p class="demo">John Doe</p>
                                                                </li>
                                                                <li><span>Relationship: </span>
                                                                    <p class="demo">Father</p>
                                                                </li>
                                                                <li><span>Phone: </span><a href="tel:9876543210">9876543210</a></li>
                                                            </ul>
                                                            <ul class="common-details  per-info-list">
                                                                <h5>Secondary</h5>
                                                                <li><span>Name: </span>
                                                                    <p class="demo">Karen Wills</p>
                                                                </li>
                                                                <li><span>Relationship: </span>
                                                                    <p class="demo">Son</p>
                                                                </li>
                                                                <li><span>Phone: </span><a href="tel:9876543210">9876543210</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="common-info-inner-wrap">
                                                            <h4>Bank information</h4>
                                                            <div class="contact-pin"> <span class="demo"><i
                                                                        class="fas fa-thumbtack"></i></span> </div>
                                                            <ul class="common-details  per-info-list">
                                                                <li><span>Bank name: </span>
                                                                    <p class="demo">ICICI Bank</p>
                                                                </li>
                                                                <li><span>Bank account No: </span>
                                                                    <p class="demo">154978625412</p>
                                                                </li>
                                                                <li><span>IFSC Code: </span>
                                                                    <p class="demo">ICI24508</p>
                                                                </li>
                                                                <li><span>PAN No: </span>
                                                                    <p class="demo">TC000YB6 </p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="common-info-inner-wrap">
                                                            <h4>Family information</h4>
                                                            <div class="contact-pin"> <span class="demo"><i
                                                                        class="fas fa-thumbtack"></i></span> </div>
                                                            <table class="table family-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Name </th>
                                                                        <th scope="col">Relationship</th>
                                                                        <th scope="col">Date of Birth</th>
                                                                        <th scope="col">Phone</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row">Leo</th>
                                                                        <td>Brother</td>
                                                                        <td>Feb 16th, 2019</td>
                                                                        <td><a href="#">9876543210</a></td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="common-info-inner-wrap">
                                                            <h4>Education Informations</h4>
                                                            <div class="contact-pin"> <span class="demo"><i
                                                                        class="fas fa-thumbtack"></i></span> </div>
                                                            <ul class="custom-education-exp-list education-custom">
                                                                <li>
                                                                    <h6>International College of Arts and Science (UG)</h6>
                                                                    <p class="demo">Bsc Computer Science</p>
                                                                    <p class="demo">2000 - 2003</p>
                                                                </li>
                                                                <li>
                                                                    <h6>International College of Arts and Science (UG)</h6>
                                                                    <p class="demo">Msc Computer Science</p>
                                                                    <p class="demo">2000 - 2003</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="common-info-inner-wrap">
                                                            <h4>Education Informations</h4>
                                                            <div class="contact-pin"> <span class="demo"><i
                                                                        class="fas fa-thumbtack"></i></span> </div>
                                                            <ul class="custom-education-exp-list experience-custom">
                                                                <li>
                                                                    <h6>Web Designer at Zen Corporation</h6>
                                                                    <p class="demo">Jan 2013 - Present (5 years 2 months)</p>
                                                                </li>
                                                                <li>
                                                                    <h6>Web Designer at Ron-tech</h6>
                                                                    <p class="demo">Jan 2013 - Present (5 years 2 months)</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                                            <p>Second Panel</p>
                                        </div>
                                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                                            <p>Third Panel</p>
                                        </div>
                                    </div>
                                </section>
                            <?php } } ?>
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
        <?php include 'footer_js.php' ?>
    </body>
</html>