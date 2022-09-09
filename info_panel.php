<div class="container">
    <div class="row">
        <div class="col-lg-7 col-md-6 align-self-center">
            <div class="dashboard-header-left"> <a href="#" class="logo"> <img src="assets/images/logo-main.png"
                        class="img-fluid" alt="Codearts Logo"> </a> </div>
        </div>
        <div class="col-lg-3 col-md-6 align-self-center">
            
        </div>
        <div class="col-lg-2 col-md-6 align-self-center">
            <ul class="notification-chat">
                <?php $sql2 = "SELECT * FROM capms_login_information WHERE user_id = '".$_SESSION['emp_id']."' "; 
                $result2 = mysqli_query($con, $sql2);
                if($result2->num_rows > 0)
                {
                    while($row2 = mysqli_fetch_assoc($result2))
                    {?>
                <li><a href="javascript:void(0)">Login<span><?php echo $row2['login_time']; ?></span></a></li>
                <?php }
                } ?>
                
            </ul>
            <ul class="header-admin">
                <div class="dropdown">
                    <button class="dropdown-toggle header-admin-btn" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="assets/uploads/user_featured_images/<?php echo $_SESSION['emp_image']; ?>" alt="User" title="<?php echo $_SESSION['emp_name']; ?>">
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="profile.php?emp_id=<?php echo $_SESSION['emp_id']; ?>"><?php echo $_SESSION['emp_name']; ?></a>
                        <a class="dropdown-item" href="#">Employee Role</a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                    <span class="active"></span>
                </div>
            </ul>
        </div>
    </div>
</div>