<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header_css.php'; ?>
    <?php
        if(isset($_SESSION['emp_id']) )
        {
            echo "<script>location.href='".$baseURL."';</script>";
        }
        ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
                                    <button type="submit" name="noticeSubmit" class="btn btn-primary">Submit</button>
                                </form>
                                <?php
                                    if(isset($_POST['noticeSubmit'])){
                                        $query = "INSERT into capms_notice_info (notice_id, notice_subject, notice_body, created_at ) VALUES (NULL, '".$_POST['noticeSubject']."', '".$_POST['noticeBody']."', '".date('Y-m-d h:i:s', strtotime('now'))."')";
                                        $result = mysqli_query($con, $query);
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