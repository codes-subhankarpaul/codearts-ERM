<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'header_css.php'; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }

            td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            }

            tr:nth-child(even) {
            background-color: #dddddd;
            }
    </style>
</head>
<body>
    <!-- notice model update git hub -->
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
                            <section class="noticeList"  style="padding-top: 130px;">
                            <table>
                                <tr>
                                    <th>Notice ID</th>
                                    <th>Notice Subject</th>
                                    <th>Notice Body</th>
                                    <th>Create Date</th>
                                </tr>
                                <?php
                                    $query = "SELECT * FROM capms_notice_info";
                                    $result = mysqli_query($con, $query);
                                    if($result->num_rows > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                ?>
                                <tr>
                                    <td><?php echo $row['notice_id']; ?></td>
                                    <td><?php echo $row['notice_subject']; ?></td>
                                    <td><?php echo $row['notice_body']; ?></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                </tr>
                                <?php
                                        }
                                    }
                                ?>
                            </table>
                            </section>
                            <div style="margin-top: 30px;">
                            <a class="creat-project-btn" href="create_notice.php"><span>+</span> Create Notice</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</body>
</html>      