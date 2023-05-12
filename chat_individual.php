<!doctype html>
<html lang="en">

    <head>
        <!-- Header CSS files -->
        <?php include 'header_css.php'; ?>
        <title>Personal Chat - CERM :: Codearts Employee Relationship Management</title>
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
                                <h2>Personal Chat</h2>
                                <ul>
                                    <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                    <li>Edit</li>
                                </ul>
                            </section>
                            <?php $get_user_sql = "SELECT * FROM `capms_admin_users` where id='".$_GET['reciever_user_id']."'";
                            $user_result = mysqli_query($con,$get_user_sql);
                            $user = mysqli_fetch_assoc($user_result)
                            ?>
                            <h4 align="center"><u><?php echo $user['user_fullname']; ?></u><img src="assets/uploads/user_featured_images/<?php echo $user['user_featured_image']; ?>" alt="avatar"
                            class="rounded-circle" width="60" height="60"></h4>
                            <br />
                            <div class="output" id="output" style="height: 20rem; overflow-y: scroll;">
                                <?php 
                                    $r_u_id = $_GET['reciever_user_id'];
                                    $sql = "SELECT * FROM `capms_personal_chat` WHERE (to_user_id='".$r_u_id."' AND from_user_id='".$_SESSION['emp_id']."') OR (to_user_id='".$_SESSION['emp_id']."' AND from_user_id='".$r_u_id."') ORDER BY created_at;";
                                    
                                    $result = mysqli_query($con,$sql);
                                    if($result->num_rows > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            $id_array[]=$row['chat_message_id'];
                                            $message_id = $row['chat_message_id'];
                                            if($row['from_user_id'] === $_SESSION['emp_id']){
                                                echo '<div id="message_'.$message_id.'" class="p-1 m-1" style="float:right; color:white; display:inline-block; border-color: transparent
                                                transparent #28aefc transparent; background-color:#28aefc; border-radius:5px; border-style: solid; border-width: 0 8px 8px 8px; margin-right:20px; clear:both;"><p class="text-light">'.$row['chat_message'].'</p></div><br/><br/>';
                                            ?>
                                                <div id="message_<?php echo $message_id;?>_time" style="display:none;" class="p-1 m-1 h3">
                                                    <span style="color:black;float:right;
                                                    font-size:12px;clear:both;">
                                                        <?php echo $row['created_at']; ?>
                                                    </span>
                                                </div>
                                            <?php
                                            }
                                            else{
                                                echo '<div id="message_'.$message_id.'" class="p-1 m-1" style="float:left; display:inline-block; border-color: transparent
                                                transparent #bfd6f5 transparent; background-color:#bfd6f5; border-radius:5px; border-style: solid; border-width: 0 8px 8px 8px; margin-right:20px; clear:both;"><p>'.$row['chat_message'].'</p></div><br/><br/>';
                                            ?>
                                                <div id="message_<?php echo $message_id;?>_time" style="display:none;" class="p-1 m-1 h3">
                                                    <span style="color:black; float:left;
                                                    font-size:12px; clear:both; ">
                                                        <?php echo $row['created_at']; ?>
                                                    </span>
                                                </div>
                                            <?php
                                            }
                                        }
                                    }

                                    // $sql_reverse = "SELECT * FROM `capms_personal_chat` WHERE to_user_id='".$_SESSION['emp_id']."' AND from_user_id='".$r_u_id."' ORDER BY created_at;";
                                    // $result_reverese = mysqli_query($con,$sql_reverse);
                                    // if($result_reverese->num_rows > 0){
                                    //     while($row_reverese = mysqli_fetch_assoc($result_reverese)){
                                    //         echo $row_reverese['chat_message'].'<br/><br/>';
                                    //     }
                                    // }

                                ?>
                            </div>
                            <form id="formindividual">
                                <br/>
                                <textarea name="msg" id="msg" cols="50" rows="3" placeholder="Write message here..." class="form-control"></textarea>
                                <br/>
                                <button type="submit" name="sendbtn" class="btn btn-primary">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script>
            $(document).ready(function(){
                $("form#formindividual").submit(function(event) {
                    event.preventDefault();
                    var m = $("#msg").val();

                    $.ajax({
                        type: "POST",
                        url: "chat_send_individual.php",
                        data: {msg: m, to_user_id:<?php echo $_GET['reciever_user_id']?>},
                        success: function () {
                            $("#msg").val("");
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function(){
                <?php for($i=0; $i<count($id_array); $i++) {?>
                $('#message_<?php echo $id_array[$i];?>').on("click",function(){
                    $('#message_<?php echo $id_array[$i];?>_time').toggle();
                });
                <?php }?>
            });
        </script>

        <!-- SENDING LAST MESSAGE ID AND ADDING NEW CHAT VIA AJAX -->
        <script>
            function fetchdata(){
                $.ajax({
                    url: 'chat_get_new_individual_msg_ajax.php',
                    type: 'post',
                    dataType: 'JSON',
                    data: {
                        last_message_id: $("#output div").last().attr('id').split("_")[1],
                        to_user_id:<?php echo $_GET['reciever_user_id']?>
                    },
                    success: function(data){
                    
                        if(data.length==0){
                            console.log('no data!');
                        }
                        else{
                            for(var i = 0; i<data.length; i++){
                                var output_str = $("#output").html();
                                var div_str = '';
                                // if data is own user's then right side div
                                
                                if(data[i]['from_user_id']== <?php echo $_SESSION['emp_id']?>) {
                                    div_str += '<div id="message_'+data[i]['chat_message_id']+'" class="p-1 m-1" style="float:right; color:white; display:inline-block; border-color: transparent transparent #28aefc transparent; background-color:#28aefc; border-radius:5px; border-style: solid; border-width: 0 8px 8px 8px; margin-right:20px; clear:both;"><p class="text-light">'+data[i]['chat_message']+'</p></div>';
                                }
                                else {
                                    div_str += '<div id="message_'+data[i]['chat_message_id']+'" class="p-1 m-1" style="float:left; display:inline-block; border-color: transparent transparent #bfd6f5 transparent; background-color:#bfd6f5; border-radius:5px; border-style: solid; border-width: 0 8px 8px 8px; margin-right:20px; clear:both;"><p>'+data[i]['chat_message']+'</p></div>';
                                }
                                output_str+=div_str;
                                $("#output").html(output_str);
                            }
                        }
                    },
                    complete:function(data){
                        setTimeout(fetchdata,5000);
                    }
                });
            }

            $(document).ready(function(){
                setTimeout(fetchdata,5000);
            });
        </script>
    </body>
</html>