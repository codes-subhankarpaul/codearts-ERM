<!doctype html>
<html lang="en">

    <head>
        <!-- Header CSS files -->
        <?php include 'header_css.php'; ?>
        <title>Chat - CERM :: Codearts Employee Relationship Management</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
        <link rel="stylesheet" href="assets/css/user-style.css">
    </head>
    <?php
        $sql = "SELECT * FROM capms_admin_users";
        $result = $con->query($sql);
        $names = '[';

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $names .= '"' . $row["user_fullname"] . '"' . ",";
            }
        } else {
        }
        $names .= "]";
        //$con->close();
    ?>

    <body>
        <header class="custom-header">
            <!-- Dashboard Top Info Panel -->
            <?php
            include 'info_panel.php';
            //include('database.php');
            ?>
        </header>
        <main class="custom-dahboard-main">
            <div class="custom-page-wrap-dp">  
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <?php include 'dashboard.php'; ?>
                        </div>
                        <div class="col-lg-9">
                            <section class="inner-head-brd">
                                <h2>Chat</h2>
                                <ul>
                                    <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                    <li>Edit</li>
                                </ul>
                            </section>
                            <h3 align="center">SELECT TO START A CONVERSATION</a></h3><br />
                            <div class="wrapper">
                                <section class="users">
                                <header>
                                    <div class="content">
                                    <?php 
                                        $sql = mysqli_query($con, "SELECT * FROM capms_admin_users WHERE id = {$_SESSION['emp_id']}");
                                        if(mysqli_num_rows($sql) > 0){
                                        $row = mysqli_fetch_assoc($sql);
                                        }
                                    ?>
                                    <img src="http://localhost/ERM/assets/uploads/user_featured_images/<?php echo $row['user_featured_image']; ?>" alt="">
                                    <div class="details">
                                        <span><?php echo $row['user_fullname'];?></span>
                                        <p><?php echo 'Active'; ?></p>
                                    </div>
                                    </div>
                                   
                                </header>
                                <div class="search">
                                    <span class="text">Select an user to start chat</span>
                                    <input type="text" placeholder="Enter name to search...">
                                    <button><i class="fas fa-search"></i></button>
                                </div>
                                <div class="users-list">
                            
                                </div>
                                </section>
                            </div>

                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <script src="assets/js/users.js"></script>
        </main>
    </body>
</html>
