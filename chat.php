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
                            <a id="group_link" href="chat_group.php" class="btn btn-dark p-3 float-right">Group Chat <span class="badge badge-light float-end" id="group_noti"></span></a>
                            <?php
                                $sql_chat_users = "SELECT * FROM capms_admin_users WHERE id!= '".$_SESSION['emp_id']."'";
                                $result_chat_users = $con->query($sql_chat_users);
                            ?>
                            <section style="background-color: #eee;">
                                <div class="container py-5">

                                    <div class="row">

                                    <div class="col-md-20 col-lg-10 col-xl-10 mb-10 mb-md-0">

                                        <h5 class="font-weight-bold mb-3 text-lg-start">Member</h5>

                                        <div class="list-group">

                                            <ul class="list-unstyled mb-0">
                                                <?php
                                                    if($result_chat_users->num_rows > 0){
                                                        while($row_chat_users = $result_chat_users->fetch_assoc()) {
                                                            $id_array[]=$row_chat_users['id'];
                                                ?>
                                                <li class="list-group-item" style="background-color: #fff;">
                                                    <a id="individual_link_<?php echo $row_chat_users['id']; ?>" href="chat_individual.php?reciever_user_id=<?php echo $row_chat_users['id']; ?>" class="d-flex justify-content-between" >
                                                    <div class="d-flex flex-row">
                                                        <img src="assets/uploads/user_featured_images/<?php echo $row_chat_users['user_featured_image']; ?>" alt="avatar"
                                                        class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60" height="60">
                                                        <div class="pt-2 m-1">
                                                        <p class="h6 mb-0" style="color:black;"><?php echo $row_chat_users['user_fullname']; ?></p>
                                                        <!-- <p class="small text-muted">Hello, Are you there?</p> -->
                                                        </div>
                                                    </div>
                                                    <div class="pt-1" id="noti_div">
                                                        <span hidden><?php echo $row_chat_users['id']; ?></span>
                                                        <span class="badge badge-light float-end" id="notification_<?php echo $row_chat_users['id']; ?>"></span>
                                                    </div>
                                                    </a>
                                                </li>
                                                <?php
                                                        }
                                                    }  
                                                ?>
                                            </ul>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                    </div>
                                </div>
                            </section>
                            <!-- <ul>
                            <?php
                                                // if($result_chat_users->num_rows > 0){
                                                //     while($row_chat_users = $result_chat_users->fetch_assoc()) {
                                            ?>
                                    <li><a href="chat_individual.php?reciever_user_id=<?php //echo $row_chat_users['id']; ?>"><?php //echo $row_chat_users['user_fullname']; ?></a></li>
                            <?php
                            //     }
                            //   }  
                            ?>
                            </ul> -->
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function group_notification(){
                    $.ajax({
                        url: 'chat_group_notification.php',
                        type: 'post',
                        success: function(data){
                            $('#group_noti').text(data);
                        },
                        complete: function(data){
                            setTimeout(group_notification,5000);
                        }
                    });
                }
                function individual_notification(){
                    $.ajax({
                        url: 'chat_notification.php',
                        type: 'post',
                        success: function(data){
                            data = JSON.parse(data);
                            for(var j = 0; j<data.length; j++){  
                                $('#notification_'+data[j]['f_id']).text(data[j]['count']);
                            }
                        },
                        complete:function(data){
                            setTimeout(individual_notification,5000);
                        }
                    });
                }

                $(document).ready(function(){
                    setTimeout(individual_notification,5000);
                    setTimeout(group_notification,5000);
                    <?php for($i=0; $i<count($id_array); $i++) { ?>
                        $('#individual_link_<?php echo $id_array[$i]; ?>').on('click',function(){
                            $.ajax({
                                url: 'chat_individual_status_change.php',
                                type: 'post',
                                data: {
                                    from_user_id: <?php echo $id_array[$i]; ?>
                                },
                                success: function(){}
                            });
                        });
                    <?php } ?>
                    $('#group_link').on('click',function(){
                        $.ajax({
                            url: 'chat_group_status_change.php',
                            type: 'post',
                            success: function(){}
                        });
                    });
                });
            </script>
        </main>
    </body>
</html>
