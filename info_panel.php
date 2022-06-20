<div class="container">
    <div class="row">
        <div class="col-lg-7 col-md-6 align-self-center">
            <div class="dashboard-header-left"> <a href="#" class="logo"> <img src="assets/images/logo-main.png"
                        class="img-fluid" alt="Codearts Logo"> </a> </div>
        </div>
        <div class="col-lg-3 col-md-6 align-self-center">
            <div class="header-search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Here">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="button"> <i class="fa fa-search"></i> </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 align-self-center">
            <ul class="notification-chat">
                <li><a href=""><img src="assets/images/notification-icon-header.png"
                            alt="Notifications"><span>3</span></a></li>
                <li><a href="#"><img src="assets/images/chat-icon-header.png" alt="Chat"><span>2</span></a></li>
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