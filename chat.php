<!doctype html>
<html lang="en">

    <head>
        <!-- Header CSS files -->
        <?php include 'header_css.php'; ?>
        <title>Projects - CERM :: Codearts Employee Relationship Management</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
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
                            <br />
                            <a href="chat_group.php" class="btn btn-dark p-3 float-right">Group Chat</a>
                            <?php
                                $sql_chat_users = "SELECT * FROM capms_admin_users WHERE id!= '".$_SESSION['emp_id']."'";
                                $result_chat_users = $con->query($sql_chat_users);
                            ?>
                            <ul>
                            <?php
                              if($result_chat_users->num_rows > 0){
                                while($row_chat_users = $result_chat_users->fetch_assoc()) {
                            ?>
                                    <li><a href="chat_individual.php?reciever_user_id=<?php echo $row_chat_users['id']; ?>"><?php echo $row_chat_users['user_fullname']; ?></a></li>
                            <?php
                                }
                              }  
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
