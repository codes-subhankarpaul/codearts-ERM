<!doctype html>
<html lang="en">

<head>
    <!-- Header CSS files -->
    <?php include 'header_css.php'; ?>
    <title>Edit Timesheet - CERM :: Codearts Employee Relationship Management</title>
</head>
<?php
if ($_SESSION['emp_id'] == '') {
    echo "<script>location.href='".$baseURL."login.php';</script>";
}
?>

<body>

    <style>
        .block {
        display: block;
        width: 100%;
        border: none;
        padding: 14px 28px;
        font-size: 16px;
        cursor: pointer;
        text-align: center;
        }
    </style>

    <style type="text/css">
        .files input {
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear;
            padding: 120px 0px 85px 35%;
            text-align: center !important;
            margin: 0;
            width: 100% !important;
        }

        .files input:focus {
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear;
            border: 1px solid #92b0b3;
        }

        .files {
            position: relative
        }

        .files:after {
            pointer-events: none;
            position: absolute;
            top: 60px;
            left: 0;
            width: 50px;
            right: 0;
            height: 56px;
            content: "";
            background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png);
            display: block;
            margin: 0 auto;
            background-size: 100%;
            background-repeat: no-repeat;
        }

        .color input {
            background-color: #f1f1f1;
        }

        .files:before {
            position: absolute;
            bottom: 10px;
            left: 0;
            pointer-events: none;
            width: 100%;
            right: 0;
            height: 57px;
            content: " or drag it here. ";
            display: block;
            margin: 0 auto;
            color: #2ea591;
            font-weight: 600;
            text-transform: capitalize;
            text-align: center;
        }
    </style>

    <style>
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
    </style>

    <header class="custom-header">
        <!-- Dashboard Top Info Panel -->
        <?php
        include 'info_panel.php';
        //include('database.php');
        ?>
    </header>

    <!-- getting all data based on session_id -->
    <?php
    $user_id = $_SESSION['emp_id'];
    $timesheet_id = $_REQUEST['id'];
    echo "<script>console.log(\"hello\")</script>";
    echo "<script>console.log(\"" . $user_id . "\")</script>";
    echo "<script>console.log(\"" . $timesheet_id . "\")</script>";
    $select_all_sql = "SELECT * FROM `capms_user_timesheet` WHERE `user_id` = '" . $user_id . "' AND `timesheet_id` = '".$_REQUEST['id']."'";
    $result = mysqli_query($con, $select_all_sql);
    while ($row = mysqli_fetch_array($result)) {

        $timesheet_date = $row['timesheet_date'];
        $project_name = "";
        $task_name = "";
        $start_time = $row['start_time'];
        $end_time = $row['end_time'];
        $task_domain = $row['task_domain'];
        // $task_type = $row['task_type'];
        $trello_link = $row['trello_link'];
        $description = $row['description'];

        // find project_id and task_id from workload_id and user_id
        $find_id_from_workload_sql = "SELECT * FROM `capms_user_workload_info` WHERE `user_id` = '" . $_SESSION['emp_id'] . "' AND `workload_id` = '" . $row['workload_id'] . "'";

        $result_from_workload = mysqli_query($con, $find_id_from_workload_sql);
        $project_id = 0;
        $task_id = 0;

        while ($row_from_workload = mysqli_fetch_array($result_from_workload)) {
            $project_id = $row_from_workload['project_id'];
            $task_id = $row_from_workload['task_id'];
        }

        // getting task name from id
        $find_task_name_from_id_sql = "SELECT * FROM `capms_project_task_info` WHERE `task_id` = '".$task_id."'";
        $result_task_name = mysqli_query($con, $find_task_name_from_id_sql);

        while ($row_task_name = mysqli_fetch_array($result_task_name)) {
            $task_name = $row_task_name['task_name'];
        }

        // getting task_type from task_id
        $find_task_type_from_id_sql = "SELECT * FROM `capms_project_tasktype_info` WHERE `task_type_id` = '".$row['task_type']."'";
        $result_task_type = mysqli_query($con, $find_task_type_from_id_sql);

        while ($row_task_type = mysqli_fetch_array($result_task_type)) {
            $task_type = $row_task_type['task_type_name'];
        }

        echo "<script>console.log(\"" . $timesheet_date . "\")</script>";
        echo "<script>console.log(\"" . $project_name . "\")</script>";
        echo "<script>console.log(\"" . $task_name . "\")</script>";
        echo "<script>console.log(\"" . $start_time . "\")</script>";
        echo "<script>console.log(\"" . $end_time . "\")</script>";
        echo "<script>console.log(\"" . $task_domain . "\")</script>";
        echo "<script>console.log(\"" . $task_type . "\")</script>";
        echo "<script>console.log(\"" . $trello_link . "\")</script>";
        echo "<script>console.log(\"" . $description . "\")</script>";

        echo "<script>console.log(\"task_project\")</script>";

        echo "<script>console.log(\"" . $project_id . "\")</script>";
        echo "<script>console.log(\"" . $task_id . "\")</script>";
        $_SESSION['task_id'] = $task_id;

        echo '
        <script>
        jQuery(document).ready(function() {
            //alert("ready");
        });
        </script>
        ';
    }
    ?>

    <main class="custom-dahboard-main">
        <div class="custom-page-wrap-dp">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <?php include 'dashboard.php'; ?>
                    </div>
                    <div class="col-lg-9">
                        <section class="inner-head-brd">
                            <h2>Timesheet</h2>
                            <ul>
                                <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                                <li>Timesheet</li>
                            </ul>
                        </section>

                        <section id="insert-project" class="insert-project border bg-light shadow">
                            <div class="timesheet" id="timesheet">
                                <form action="timesheet_editDB.php?id=<?php echo $_REQUEST['id'] ?>" method="post">
                                    <div class="text-center bg-dark text-light py-2 fw-bolder mb-3">
                                        <h5>* please fill the timesheet properly</h5> 
                                    </div>
                                    <div class="bg-light p-3 my-3 ">
                                        <div class="row text-dark">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="dt">Update date - </label></br>
                                                    <input id="dt" name="dt" placeholder="<?php echo $timesheet_date ?>" value="<?php echo $timesheet_date ?>" required />
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="py-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="project">project</label>
                                                    <select class="form-control" id="project-dropdown" name="project" required>
                                                        <option value="">select option</option>
                                                        <?php
                                                        require_once "database.php";

                                                        $emp_id = $_SESSION['emp_id'];

                                                        $sql = "SELECT DISTINCT user_id, cpi.project_id, title 
                                                            FROM `capms_user_workload_info` as cuwi 
                                                            inner join `capms_project_info` as cpi on cuwi.project_id = cpi.project_id 
                                                            where user_id = " . $emp_id . " and project_status = 1;";
                                                        $result = mysqli_query($con, $sql);
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            $selected = "";
                                                            if ($row['project_id'] == $project_id) {
                                                                $selected = 'selected';
                                                            }
                                                            echo '<option value="' . $row['project_id'] . '" ' . $selected . '>' . $row["title"] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="task_id">task_name (current-<?php echo $task_name ?>)</label>
                                                    <select class="form-control" id="task_id-dropdown" name="workload_id" required>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                <label for="project_number">project_number</label>
                                                <input type="text" id="project_number" class="form-control" value="Project Number" disabled>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                <label for="task_number">task_number</label>
                                                <input type="text" id="task_number" class="form-control" value="Task Number" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                <label>start time</label>
                                                <div class="input-group clockpicker">
                                                    <input type="text" class="form-control" name="start_time" value="<?php echo $start_time ?>">
                                                    <span class="input-group-addon">
                                                        <span class="btn btn-outline-primary">select</span>
                                                    </span>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                <label>end time</label>
                                                <div class="input-group clockpicker">
                                                    <input type="text" class="form-control" name="end_time" value="<?php echo $end_time ?>">
                                                    <span class="input-group-addon">
                                                    <span class="btn btn-outline-primary">select</span>
                                                    </span>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                <div id="task_domain-dropdown">
                                                    <label for="demo_task_domain" class="form-label">task_domain</label>
                                                    <input type="text" class="form-control" placeholder="select task_name first" disabled>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="task_type" class="form-label">task_type</label>
                                                    <select class="form-control" id="task_type-dropdown" name="task_type" required></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="trello_link" class="form-label">trello_link</label>
                                                    <input type="text" class="form-control" name="trello_link" placeholder="enter trello_link" value="<?php if (isset($trello_link)) {
                                                                                                                                                            echo $trello_link;
                                                                                                                                                        } else {
                                                                                                                                                            echo "";
                                                                                                                                                        } ?>" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">description</label>
                                                    <input type="text" class="form-control" name="description" placeholder="<?php if (isset($description)) {
                                                                                                                                echo $description;
                                                                                                                            } else {
                                                                                                                                echo "";
                                                                                                                            } ?>" value="<?php if (isset($description)) {
                                                                                                                                                echo $description;
                                                                                                                                            } else {
                                                                                                                                                echo "";
                                                                                                                                            } ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="py-3">
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <input type="submit" class="block bg-primary text-light" value="Update">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="custom-footer">
        <!-- Copyright Content file -->
        <?php //include 'copyright_content.php'; 
        ?>
    </footer>
    <!-- Footer JS files -->

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://jqueryui.com//resources/demos/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap-clockpicker.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="assets/js/bootstrap-clockpicker.js"></script>
    <script>
        $(function() {
            var availableTeamMembers = <?php echo $names ?>;
            $("#leaders").autocomplete({
                source: availableTeamMembers
            });
            var availableTeams = ['Html-Css', 'Angular-Iocic', 'Development', 'Testing'];
            $("#teams").autocomplete({
                source: availableTeams
            });
        });
    </script>

    <script src="https://cdn.tiny.cloud/1/04z7u7156gqei101i37ypflfj99zptjgbodnyi91ni0bs5je/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea#editor',
            menubar: false
        });
    </script>

    <!-- DATE VALIDATION -->
    <script>
        $("#dt").datepicker({
            onSelect: function(dateText, inst) {
                $(this).attr("autocomplete", "off");
                var date = $(this).val();
                console.log(date);
                var fullDate = new Date();
                var twoDigitMonth = ((fullDate.getMonth().length + 1) === 1) ? (fullDate.getMonth() + 1) : '0' + (fullDate.getMonth() + 1);
                var currentDate = fullDate.getDate() + "/" + twoDigitMonth + "/" + fullDate.getFullYear();
                console.log(currentDate);
                var fullDateObj = new Date(date);
                var currentDateObj = new Date();
                if (fullDateObj > currentDateObj) {
                    alert("Future date not allowed!!!");
                    $.datepicker._clearDate(this);
                } else {
                    // console.log(currentDateObj.getMonth()+1);
                    if (fullDateObj.getMonth() < currentDateObj.getMonth()) {
                        alert("Previous month's date not allowed!!!");
                        $.datepicker._clearDate(this);
                    }
                }
            }
        });
    </script>

    <!-- TASK_ID FETCHED BASED ON PROJECT -->
    <script>
        $(document).ready(function() {
        $('#project-dropdown').on('change', function() {
            var project_id = this.value;
            console.log(project_id);
            $.ajax({
            url: "timesheet_task_id_by_project.php",
            type: "POST",
            data: {
                project_id: project_id
            },
            cache: false,
            success: function(result) {
                $("#task_id-dropdown").html(result);
            },
            error: function() {
                alert('problem in state');
            }
            });
        });
        $('#task_id-dropdown').on('change', function() {
            var task_id = this.value;
        });
        });
    </script>

    <script>
        $(document).ready(function() {
            var project_id = <?php echo $project_id ?>;
            console.log(project_id);
            $.ajax({
                url: "timesheet_task_id_by_project.php",
                type: "POST",
                data: {
                    project_id: project_id
                },
                cache: false,
                success: function(result) {
                    $("#task_id-dropdown").html(result);
                },
                error: function() {
                    alert('problem in state');
                }
            });
            
        });
    </script>

    <!-- TASK NUMBER AND PROJECT NUMBER FETCHED ON WORKLOAD_ID -->
    <!-- TASK_DOMAIN FETCHED BASED ON TASK_ID -->
    <script>
        $(document).ready(function() {
            $('#project-dropdown').on('change', function() {
                var project_id = this.value;
                $.ajax({
                    url: "timesheet_ajax_project_number.php",
                    type: "POST",
                    data: {
                        project_id: project_id
                    },
                    cache: false,
                    success: function(result) {
                        $("#project_number").val(result);
                    },
                    error: function() {
                        alert('problem in state');
                    }
                });
            });
            $('#task_id-dropdown').on('change', function() {
                var workload_id = this.value;
                $.ajax({
                    url: "timesheet_ajax_task_number.php",
                    type: "POST",
                    data: {
                        workload_id: workload_id
                    },
                    cache: false,
                    success: function(result) {
                        $("#task_number").val(result);
                    },
                    error: function() {
                        alert('problem in state');
                    }
                });
                var task_id = $('#task_id-dropdown').val();
                var project_id = $('#project-dropdown').val();
                console.log(project_id);
                $.ajax({
                    url: "timesheet_task_domain_by_task_id.php",
                    type: "POST",
                    data: {
                        task_id: task_id,
                        project_id: project_id,
                        timesheet_id: <?php echo $_REQUEST['id'] ?>
                    },
                    cache: false,
                    success: function(result) {
                        $("#task_domain-dropdown").html(result);
                    },
                    error: function() {
                        alert('problem in state');
                    }
                });
                $.ajax({
                    url: "timesheet_task_type_by_task_id.php",
                    type: "POST",
                    data: {
                        task_id: task_id
                    },
                    cache: false,
                    success: function(result) {
                        $("#task_type-dropdown").html(result);
                    },
                    error: function() {
                        alert('problem in state');
                    }
                });
            });
        });
    </script>

    <!-- CLOCK WIDGETS -->
    <script type="text/javascript">
    $('.clockpicker').clockpicker({
        placement: 'top',
        align: 'left',
        donetext: 'Done',
        autoclose: true
    });
    </script>



</body>

</html>