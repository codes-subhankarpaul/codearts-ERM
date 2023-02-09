<?php 
session_start();
if ($_SESSION['emp_type'] != "hr") { 
    echo $_SESSION['emp_type'];
    header("Location: notice.php");
}
else{

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header_css.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Notice - CERM :: Codearts Employee Relationship Management</title>
</head>
<body>
    <!-- create notice update file for git hub -->
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
                            <section class="notfication-body">
                                <form style="padding-top: 130px;" method="POST" enctype="multipart/form-data" id="noticeForm" action="create_notice.php">
                                    <div class="form-group">
                                        <label for="noticeSubject">Notice Subject</label>
                                        <input type="text" class="form-control" id="noticeSubject" placeholder="Enter Notification Subject" name="noticeSubject" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="noticeBody">Notice Content</label>
                                        <textarea class="form-control" id="editor" name="noticeBody"></textarea>
                                        <!-- <span><?php //echo $errnoticemsg; ?></span> -->
                                    </div>
                                    <div class="form-group">
                                        <label for="noticeFile">Choose file...</label>
                                        <input type="file" id="noticeFile" name="noticeFile" accept="image/*, application/pdf">
                                    </div>

                                    <input type="submit" name="noticeSubmit" value="Submit" class="btn btn-primary">
                                </form>
                                <?php
                                    if(isset($_POST['noticeSubmit'])){
                                        $errnoticemsg = "";
                                        if($_POST['noticeBody'] ==""){
                                            $errnoticemsg = "Notice Body is missing";
                                            echo '<span class="text-danger">'.$errnoticemsg.'</span>';
                                            die();
                                        }
                                        else{
                                            $current_date=strtotime("now");
                                            $current_date=date("Y-m-d h:i:s",$current_date);
                                            $query = "INSERT INTO `capms_notice_info` (`notice_id`, `notice_subject`, `notice_body`, `notice_file_name`, `created_at`) VALUES (Null, '".$_POST['noticeSubject']."', '".$_POST['noticeBody']."', '', '".$current_date."');";

                                            mysqli_query($con, $query);
                                            $last_notice_id = $con->insert_id;
                                            if($last_notice_id){
                                                if(isset($_FILES['noticeFile']['name']))
                                                        {
                                                            $tmpFileName = $_FILES['noticeFile']['tmp_name'];
                                                            if($tmpFileName != "")
                                                            {
                                                                $shortname = $_FILES['noticeFile']['name'];
                                                                $timestamp = strtotime('now').'-'.$_FILES['noticeFile']['name'];
                                                                $filename = $_FILES['noticeFile']['name'];
                                                                $filePath = "assets/noticeFiles/" .$timestamp;

                                                                if(move_uploaded_file($tmpFileName, $filePath))
                                                                {
                                                                    $sql3 = "UPDATE capms_notice_info SET notice_file_name = '".$timestamp."' WHERE notice_id = '".$last_notice_id."' ";
                                                                    mysqli_query($con, $sql3);
                                                                }
                                                            }
                                                        }
                                            }
                                            echo '<script>window.location="notice.php"</script>';
                                        }
                                    }
                                ?>        
                            </section>
                        </div>
                    </div>
                </div>
            </div>        
    </main>
    <script src="https://cdn.tiny.cloud/1/04z7u7156gqei101i37ypflfj99zptjgbodnyi91ni0bs5je/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea#editor',
            menubar: false
        });
    </script>
</body>
</html>

<?php
}
?>

