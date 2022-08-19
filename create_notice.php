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
    <title>Document</title>
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
                                <form style="padding-top: 130px;" method="POST" enctype="multipart/form-data" id="noticeForm">
                                    <div class="form-group">
                                        <label for="noticeSubject">Notice Subject</label>
                                        <input type="text" class="form-control" id="noticeSubject" placeholder="Enter Notification Subject" name="noticeSubject">
                                    </div>
                                    <div class="form-group">
                                        <label for="noticeBody">Notice Content</label>
                                        <textarea class="form-control" id="noticeBody" name="noticeBody" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="noticeFile">Choose file...</label>
                                        <input type="file" id="noticeFile" name="noticeFile">
                                    </div>

                                    <button type="submit" name="noticeSubmit" class="btn btn-primary">Submit</button>
                                </form>
                                <?php
                                    if(isset($_POST['noticeSubmit'])){
                                        
                                        $query = "INSERT INTO `capms_notice` (`notice_id`, `notice_title`, `notice_content`, `notice_file`, `created_at`) VALUES (Null, '".$_POST['noticeSubject']."', '".$_POST['noticeBody']."', '', '');";

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
                                                                $sql3 = "UPDATE capms_notice SET notice_file = '".$timestamp."' WHERE notice_id = '".$last_notice_id."' ";
                                                                mysqli_query($con, $sql3);
                                                            }
                                                        }
                                                    }
                                        }
                                    }
                                 ?>
                            </section>
                        </div>
                    </div>
                </div>
            </div>        
    </main>
    
</body>
</html>

<?php
}
?>