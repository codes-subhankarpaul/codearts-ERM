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
    <title>Edit Notice</title>
</head>
<?php
    $sid = $_GET['id'];
    $query = "SELECT * FROM capms_notice_info WHERE notice_id ='" . $sid . "'";
    $query_run = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($query_run);
?>
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
                                        <input type="text" class="form-control" id="noticeSubject" placeholder="Enter Notification Subject" name="noticeSubject" value='<?php echo $data["notice_subject"]; ?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="noticeBody">Notice Content</label>
                                        <textarea class="form-control" id="noticeBody" name="noticeBody" rows="3"><?php echo $data["notice_body"]; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="noticeFile">Choose file...</label>
                                        <input type="file" id="noticeFile" name="noticeFile" hidden="hidden">
                                        <button type="button" id="customBtn"> Choose File</button>
                                        <span id="customTxt"><?php echo $data["notice_file_name"]; ?></span>
                                    </div>

                                    <input type="submit" name="noticeSubmit" value="Update" class="btn btn-primary">
                                </form>
                                <?php
                                    if(isset($_POST['noticeSubmit'])){
                                        $query_update="UPDATE `capms_notice_info` SET `notice_subject`='".$_POST['noticeSubject']."',`notice_body`='".$_POST['noticeBody']."' WHERE notice_id= '".$_REQUEST['id']."'";

                                        mysqli_query($con, $query_update);
                                        $last_notice_id = $_REQUEST['id'];
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
                                ?>        
                            </section>
                        </div>
                    </div>
                </div>
            </div>        
    </main>
    <script type="text/javascript">
        const file= document.getElementById('noticeFile');
        const btn= document.getElementById('customBtn');
        const txt= document.getElementById('customTxt');

        btn.addEventListener("click", function(){
            noticeFile.click();
        });

        file.addEventListener("change", function(){
            if(!file.value){
                txt.innerHTML ="<?php echo $data["notice_file_name"]; ?>";

            } else{
                txt.innerHTML = file.value.replace(/^.*[\\\/]/, '');
            }
        })
    </script>
</body>
</html>

<?php
}
?>