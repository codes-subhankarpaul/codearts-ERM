<!doctype html>
<html lang="en">

<head>
    <!-- Header CSS files -->
    <?php include 'header_css.php'; ?>
    <title>Projects - CERM :: Codearts Employee Relationship Management</title>
</head>
<?php
if ($_SESSION['emp_id'] == '') {
    echo "<script>location.href='http://localhost/codearts/login.php';</script>";
}
?>

<body>

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
                                                            where user_id = " . $emp_id . ";";
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
                                                    <label for="start_time_dropdown">start time</label>
                                                    <select class="form-control" name="start_time" id="start_time_dropdown" required>
                                                        <option selected>select start time (current-<?php echo $start_time ?>)</option>
                                                        <option value="00.00">12:00 am</option>
                                                        <option value="00.15">12:15 am</option>
                                                        <option value="00.30">12:30 am</option>
                                                        <option value="00.45">12:45 am</option>
                                                        <option value="01.00">01:00 am</option>
                                                        <option value="01.15">01:15 am</option>
                                                        <option value="01.30">01:30 am</option>
                                                        <option value="01.45">01:45 am</option>
                                                        <option value="02.00">02:00 am</option>
                                                        <option value="02.15">02:15 am</option>
                                                        <option value="02.30">02:30 am</option>
                                                        <option value="02.45">02:45 am</option>
                                                        <option value="03.00">03:00 am</option>
                                                        <option value="03.15">03:15 am</option>
                                                        <option value="03.30">03:30 am</option>
                                                        <option value="03.45">03:45 am</option>
                                                        <option value="04.00">04:00 am</option>
                                                        <option value="04.15">04:15 am</option>
                                                        <option value="04.30">04:30 am</option>
                                                        <option value="04.45">04:45 am</option>
                                                        <option value="05.00">05:00 am</option>
                                                        <option value="05.15">05:15 am</option>
                                                        <option value="05.30">05:30 am</option>
                                                        <option value="05.45">05:45 am</option>
                                                        <option value="06.00">06:00 am</option>
                                                        <option value="06.15">06:15 am</option>
                                                        <option value="06.30">06:30 am</option>
                                                        <option value="06.45">06:45 am</option>
                                                        <option value="07.00">07:00 am</option>
                                                        <option value="07.15">07:15 am</option>
                                                        <option value="07.30">07:30 am</option>
                                                        <option value="07.45">07:45 am</option>
                                                        <option value="08.00">08:00 am</option>
                                                        <option value="08.15">08:15 am</option>
                                                        <option value="08.30">08:30 am</option>
                                                        <option value="08.45">08:45 am</option>
                                                        <option value="09.00">09:00 am</option>
                                                        <option value="09.15">09:15 am</option>
                                                        <option value="09.30">09:30 am</option>
                                                        <option value="09.45">09:45 am</option>
                                                        <option value="10.00">10:00 am</option>
                                                        <option value="10.15">10:15 am</option>
                                                        <option value="10.30">10:30 am</option>
                                                        <option value="10.45">10:45 am</option>
                                                        <option value="11.00">11:00 am</option>
                                                        <option value="11.15">11:15 am</option>
                                                        <option value="11.30">11:30 am</option>
                                                        <option value="11.45">11:45 am</option>
                                                        <option value="12.00">12:00 pm</option>
                                                        <option value="12.15">12:15 pm</option>
                                                        <option value="12.30">12:30 pm</option>
                                                        <option value="12.45">12:45 pm</option>
                                                        <option value="13.00">01:00 pm</option>
                                                        <option value="13.15">01:15 pm</option>
                                                        <option value="13.30">01:30 pm</option>
                                                        <option value="13.45">01:45 pm</option>
                                                        <option value="14.00">02:00 pm</option>
                                                        <option value="14.15">02:15 pm</option>
                                                        <option value="14.30">02:30 pm</option>
                                                        <option value="14.45">02:45 pm</option>
                                                        <option value="15.00">03:00 pm</option>
                                                        <option value="15.15">03:15 pm</option>
                                                        <option value="15.30">03:30 pm</option>
                                                        <option value="15.45">03:45 pm</option>
                                                        <option value="16.00">04:00 pm</option>
                                                        <option value="16.15">04:15 pm</option>
                                                        <option value="16.30">04:30 pm</option>
                                                        <option value="16.45">04:45 pm</option>
                                                        <option value="17.00">05:00 pm</option>
                                                        <option value="17.15">05:15 pm</option>
                                                        <option value="17.30">05:30 pm</option>
                                                        <option value="17.45">05:45 pm</option>
                                                        <option value="18.00">06:00 pm</option>
                                                        <option value="18.15">06:15 pm</option>
                                                        <option value="18.30">06:30 pm</option>
                                                        <option value="18.45">06:45 pm</option>
                                                        <option value="19.00">07:00 pm</option>
                                                        <option value="19.15">07:15 pm</option>
                                                        <option value="19.30">07:30 pm</option>
                                                        <option value="19.45">07:45 pm</option>
                                                        <option value="20.00">08:00 pm</option>
                                                        <option value="20.15">08:15 pm</option>
                                                        <option value="20.30">08:30 pm</option>
                                                        <option value="20.45">08:45 pm</option>
                                                        <option value="21.00">09:00 pm</option>
                                                        <option value="21.15">09:15 pm</option>
                                                        <option value="21.30">09:30 pm</option>
                                                        <option value="21.45">09:45 pm</option>
                                                        <option value="22.00">10:00 pm</option>
                                                        <option value="22.15">10:15 pm</option>
                                                        <option value="22.30">10:30 pm</option>
                                                        <option value="22.45">10:45 pm</option>
                                                        <option value="23.00">11:00 pm</option>
                                                        <option value="23.15">11:15 pm</option>
                                                        <option value="23.30">11:30 pm</option>
                                                        <option value="23.45">11:45 pm</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="end_time_dropdown">end time</label>
                                                    <select class="form-control" name="end_time" id="end_time_dropdown">
                                                        <option selected>select end time (current-<?php echo $end_time ?>)</option>
                                                        <option value="00.00">12:00 am</option>
                                                        <option value="00.15">12:15 am</option>
                                                        <option value="00.30">12:30 am</option>
                                                        <option value="00.45">12:45 am</option>
                                                        <option value="01.00">01:00 am</option>
                                                        <option value="01.15">01:15 am</option>
                                                        <option value="01.30">01:30 am</option>
                                                        <option value="01.45">01:45 am</option>
                                                        <option value="02.00">02:00 am</option>
                                                        <option value="02.15">02:15 am</option>
                                                        <option value="02.30">02:30 am</option>
                                                        <option value="02.45">02:45 am</option>
                                                        <option value="03.00">03:00 am</option>
                                                        <option value="03.15">03:15 am</option>
                                                        <option value="03.30">03:30 am</option>
                                                        <option value="03.45">03:45 am</option>
                                                        <option value="04.00">04:00 am</option>
                                                        <option value="04.15">04:15 am</option>
                                                        <option value="04.30">04:30 am</option>
                                                        <option value="04.45">04:45 am</option>
                                                        <option value="05.00">05:00 am</option>
                                                        <option value="05.15">05:15 am</option>
                                                        <option value="05.30">05:30 am</option>
                                                        <option value="05.45">05:45 am</option>
                                                        <option value="06.00">06:00 am</option>
                                                        <option value="06.15">06:15 am</option>
                                                        <option value="06.30">06:30 am</option>
                                                        <option value="06.45">06:45 am</option>
                                                        <option value="07.00">07:00 am</option>
                                                        <option value="07.15">07:15 am</option>
                                                        <option value="07.30">07:30 am</option>
                                                        <option value="07.45">07:45 am</option>
                                                        <option value="08.00">08:00 am</option>
                                                        <option value="08.15">08:15 am</option>
                                                        <option value="08.30">08:30 am</option>
                                                        <option value="08.45">08:45 am</option>
                                                        <option value="09.00">09:00 am</option>
                                                        <option value="09.15">09:15 am</option>
                                                        <option value="09.30">09:30 am</option>
                                                        <option value="09.45">09:45 am</option>
                                                        <option value="10.00">10:00 am</option>
                                                        <option value="10.15">10:15 am</option>
                                                        <option value="10.30">10:30 am</option>
                                                        <option value="10.45">10:45 am</option>
                                                        <option value="11.00">11:00 am</option>
                                                        <option value="11.15">11:15 am</option>
                                                        <option value="11.30">11:30 am</option>
                                                        <option value="11.45">11:45 am</option>
                                                        <option value="12.00">12:00 pm</option>
                                                        <option value="12.15">12:15 pm</option>
                                                        <option value="12.30">12:30 pm</option>
                                                        <option value="12.45">12:45 pm</option>
                                                        <option value="13.00">01:00 pm</option>
                                                        <option value="13.15">01:15 pm</option>
                                                        <option value="13.30">01:30 pm</option>
                                                        <option value="13.45">01:45 pm</option>
                                                        <option value="14.00">02:00 pm</option>
                                                        <option value="14.15">02:15 pm</option>
                                                        <option value="14.30">02:30 pm</option>
                                                        <option value="14.45">02:45 pm</option>
                                                        <option value="15.00">03:00 pm</option>
                                                        <option value="15.15">03:15 pm</option>
                                                        <option value="15.30">03:30 pm</option>
                                                        <option value="15.45">03:45 pm</option>
                                                        <option value="16.00">04:00 pm</option>
                                                        <option value="16.15">04:15 pm</option>
                                                        <option value="16.30">04:30 pm</option>
                                                        <option value="16.45">04:45 pm</option>
                                                        <option value="17.00">05:00 pm</option>
                                                        <option value="17.15">05:15 pm</option>
                                                        <option value="17.30">05:30 pm</option>
                                                        <option value="17.45">05:45 pm</option>
                                                        <option value="18.00">06:00 pm</option>
                                                        <option value="18.15">06:15 pm</option>
                                                        <option value="18.30">06:30 pm</option>
                                                        <option value="18.45">06:45 pm</option>
                                                        <option value="19.00">07:00 pm</option>
                                                        <option value="19.15">07:15 pm</option>
                                                        <option value="19.30">07:30 pm</option>
                                                        <option value="19.45">07:45 pm</option>
                                                        <option value="20.00">08:00 pm</option>
                                                        <option value="20.15">08:15 pm</option>
                                                        <option value="20.30">08:30 pm</option>
                                                        <option value="20.45">08:45 pm</option>
                                                        <option value="21.00">09:00 pm</option>
                                                        <option value="21.15">09:15 pm</option>
                                                        <option value="21.30">09:30 pm</option>
                                                        <option value="21.45">09:45 pm</option>
                                                        <option value="22.00">10:00 pm</option>
                                                        <option value="22.15">10:15 pm</option>
                                                        <option value="22.30">10:30 pm</option>
                                                        <option value="22.45">10:45 pm</option>
                                                        <option value="23.00">11:00 pm</option>
                                                        <option value="23.15">11:15 pm</option>
                                                        <option value="23.30">11:30 pm</option>
                                                        <option value="23.45">11:45 pm</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="task_domain" class="form-label">task_domain</label>
                                                    <select class="form-control" id="task_domain-dropdown" name="task_domain" required>
                                                        <option value="">select option</option>
                                                        <?php
                                                        $result = mysqli_query($con, "SELECT * FROM `capms_department_info`");
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            $selected = "";
                                                            if ($row['dept_id'] == $task_domain) {
                                                                $selected = 'selected';
                                                            }
                                                            echo '<option value="' . $row['dept_id'] . '" ' . $selected . '>' . $row["dept_name"] . '</option>';
                                                        }
                                                        ?>
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="task_type" class="form-label">task_type (current-<?php echo $task_type ?>)</label>
                                                    <select class="form-control" id="task_type-dropdown" name="task_type" required>
                                                        <option value="">select option</option>
                                                        <?php
                                                        $result = mysqli_query($con, "SELECT * FROM `capms_project_task_info` as cpti right join capms_project_tasktype_info as cptti on cpti.task_id = cptti.task_type_id;");
                                                        while ($row = mysqli_fetch_array($result)) {
                                                            $selected = "";
                                                            if ($row['task_type'] == $task_type) {
                                                                $selected = 'selected';
                                                            }
                                                            echo '<option value="' . $row['task_type'] . '" ' . $selected . '>' . $row["task_type_name"] . '</option>';
                                                        }
                                                        ?>
                                                        </option>
                                                    </select>
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
                                                    <input type="submit" class="btn btn-primary my-3" value="Update">
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
    <?php include 'footer_js.php' ?>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://jqueryui.com//resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
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

    <!-- TASK_ID FETCHED BASED ON PROJECT -->
    <!-- TASK_DOMAIN FETCHED BASED ON TASK_ID -->
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
                // alert('Taks id is changed');
                var task_id = this.value;
                console.log(task_id);
                $.ajax({
                    url: "timesheet_task_domain_by_task_id.php",
                    type: "POST",
                    data: {
                        task_id: task_id
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





</body>

</html>