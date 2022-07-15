<div class="custom-main-aside-menu">
    <div style="color:white;">
        <?php  
            if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
            $url = "https://";   
            else  
            $url = "http://";      
            $url.= $_SERVER['HTTP_HOST'];     
            $url.= $_SERVER['REQUEST_URI'];  
            //echo $url;  
            $parts = explode("/", $url);
            $slug = end($parts);
            //echo $slug;
        ?>    
    </div>

    <ul class="dp-left-menu">
        <li class="<?php if($slug == 'index.php' || $url == $baseURL) { echo 'active'; } ?>">
            <a href="<?php echo $baseURL; ?>">
                <span>
                    <img src="assets/images/menu-icon-1.png" alt="">
                </span>
                Dashboard
            </a>
        </li>

        <li class="<?php if($slug == 'profile.php') { echo 'active'; } ?>">
            <a href="profile.php">
                <span>
                    <img src="assets/images/menu-icon-2.png" alt="">
                </span> Profile
            </a>
        </li>

        <li><a href="#"><span><img src="assets/images/menu-icon-3.png" alt=""></span> Leave</a></li>
        
        <li><a href="#"><span><img src="assets/images/menu-icon-4.png" alt=""></span> Holidays</a></li>
        
        <li><a href="#"><span><img src="assets/images/menu-icon-5.png" alt=""></span> Salary</a></li>
        
        <li><a href="#"><span><img src="assets/images/menu-icon-6.png" alt=""></span> Pay Slip</a></li>
        
        <li class="<?php if($slug == 'projects.php') { echo 'active'; } ?>">
            <a href="projects.php">
                <span>
                    <img src="assets/images/menu-icon-7.png" alt="">
                </span> Projects
            </a>
        </li>
        
        <li><a href="#"><span><img src="assets/images/menu-icon-8.png" alt=""></span> Time Sheet</a></li>
        
        <li class="<?php if( ($slug == 'access_log.php') || (strpos($slug, 'employee_access_log.php')!== false) ) { echo 'active'; } ?>">
            <a href="access_log.php">
                <span>
                    <img src="assets/images/menu-icon-8.png" alt="">
                </span> Access Log
            </a>
        </li>
       
        <li><a href="#"><span><img src="assets/images/menu-icon-9.png" alt=""></span> Chat</a></li>
       
        <li><a href="#"><span><img src="assets/images/menu-icon-10.png" alt=""></span> Notices</a></li>
       
        <!-- <li>
            <a href="logout.php">
                <span>
                    <img src="assets/images/menu-icon-11.png" alt="">
                </span> Logout</a>
        </li> -->
    </ul>
</div>