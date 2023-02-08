<!doctype html>
<html lang="en">

<head>
  <!-- Header CSS files -->
  <?php include 'header_css.php'; ?>
  <title>Timesheet - CERM :: Codearts Employee Relationship Management</title>
</head>
<?php
if ($_SESSION['emp_id'] == '') {
  echo "<script>location.href='http://localhost/codearts/login.php';</script>";
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
	.blink_me {
		animation: blinker 1s linear infinite;
	}

	@keyframes blinker {
		50% {
			opacity: 0;
		}
	}
  </style>

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
              <h2>Timesheet</h2>
              <ul>
                <li><a href="<?php echo $baseURL; ?>">Home</a></li>
                <li>Timesheet</li>
              </ul>
              <?php 
                if($_SESSION['emp_type'] == "hr" || $_SESSION['emp_type'] == "admin"){
                  include 'timesheet_all.php';
                }
                else {
              ?>
            </section>

            <section class="py-3 mb-3">
              <button class="btn btn-primary" id="add_timesheet">add timesheet <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
              </svg></span></button>
              <button class="btn btn-warning" id="timesheet_filter">timesheet filter toggle <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-date" viewBox="0 0 16 16">
                <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>
                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
              </svg></span></button>
              <button class="btn btn-danger" id="unfilled_timesheet_button">unfilled timesheet <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-collection-fill" viewBox="0 0 16 16">
                <path d="M0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"/>
              </svg></span></button>
              <button class="btn btn-success" id="filled_timesheet_button">filled_timesheet <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-collection-play-fill" viewBox="0 0 16 16">
                <path d="M2.5 3.5a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-11zm2-2a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM0 13a1.5 1.5 0 0 0 1.5 1.5h13A1.5 1.5 0 0 0 16 13V6a1.5 1.5 0 0 0-1.5-1.5h-13A1.5 1.5 0 0 0 0 6v7zm6.258-6.437a.5.5 0 0 1 .507.013l4 2.5a.5.5 0 0 1 0 .848l-4 2.5A.5.5 0 0 1 6 12V7a.5.5 0 0 1 .258-.437z"/>
              </svg></span></button>
              <button class="btn btn-dark" id="view_filled_timesheet_button">view filled timesheet <span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database-fill" viewBox="0 0 16 16">
                <path d="M3.904 1.777C4.978 1.289 6.427 1 8 1s3.022.289 4.096.777C13.125 2.245 14 2.993 14 4s-.875 1.755-1.904 2.223C11.022 6.711 9.573 7 8 7s-3.022-.289-4.096-.777C2.875 5.755 2 5.007 2 4s.875-1.755 1.904-2.223Z"/>
                <path d="M2 6.161V7c0 1.007.875 1.755 1.904 2.223C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777C13.125 8.755 14 8.007 14 7v-.839c-.457.432-1.004.751-1.49.972C11.278 7.693 9.682 8 8 8s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
                <path d="M2 9.161V10c0 1.007.875 1.755 1.904 2.223C4.978 12.711 6.427 13 8 13s3.022-.289 4.096-.777C13.125 11.755 14 11.007 14 10v-.839c-.457.432-1.004.751-1.49.972-1.232.56-2.828.867-4.51.867s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
                <path d="M2 12.161V13c0 1.007.875 1.755 1.904 2.223C4.978 15.711 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13v-.839c-.457.432-1.004.751-1.49.972-1.232.56-2.828.867-4.51.867s-3.278-.307-4.51-.867c-.486-.22-1.033-.54-1.49-.972Z"/>
              </svg></span></button>
              <button class="btn btn-dark" id="accordion_button">filter timesheet <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-back" viewBox="0 0 16 16">
                <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z"/>
              </svg></button>
            <?php
              // if there is any grace time on that date and approved then add that grace time
			        $temp_gracetime = '';
              $sql_gracetime = "SELECT gracetime_taken FROM `capms_gracetime_info` WHERE `user_id`= '".$_SESSION['emp_id']."' and `gracetime_date` = '".date('m/d/Y')."' and `status` = '1';"; 
              $result_gracetime = mysqli_query($con, $sql_gracetime);
              while ($row_gracetime = mysqli_fetch_array($result_gracetime)) {
				// echo $row_gracetime['gracetime_taken'];
				echo '<span class="blink_me px-3 btn btn-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alarm-fill" viewBox="0 0 16 16">
				<path d="M6 .5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H9v1.07a7.001 7.001 0 0 1 3.274 12.474l.601.602a.5.5 0 0 1-.707.708l-.746-.746A6.97 6.97 0 0 1 8 16a6.97 6.97 0 0 1-3.422-.892l-.746.746a.5.5 0 0 1-.707-.708l.602-.602A7.001 7.001 0 0 1 7 2.07V1h-.5A.5.5 0 0 1 6 .5zm2.5 5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5zM.86 5.387A2.5 2.5 0 1 1 4.387 1.86 8.035 8.035 0 0 0 .86 5.387zM11.613 1.86a2.5 2.5 0 1 1 3.527 3.527 8.035 8.035 0 0 0-3.527-3.527z"/>
			  </svg> '.$row_gracetime['gracetime_taken'].' minutes</span>';
			  	$temp_gracetime = $row_gracetime['gracetime_taken'];
              }
            ?>
            </section>

            <section id="unfilled_timesheet" class="py-3 d-none">
              <div class="row">
                <div class="col">
                  <label for="unfilled_timesheet_dropdown" class="form-label text-danger">* please fill the unfilled timesheet of this month</label>
                  <form action="" method="post">
                    <div class="row">
                      <div class="col-md-10">
                        <select class="form-control" id="unfilled_timesheet_dropdown" name="unfilled_timesheet_select">
                          <option value="">select unfilled timesheet</option>
                          <?php
                            require_once "database.php";
                            $emp_id = $_SESSION['emp_id'];

                            date_default_timezone_set('UTC');

                            // $start_date = date('Y-m-01');
                            $start_date = date('Y-m-25', strtotime(date('Y-m')." -1 month"));
                            $end_date = date('Y-m-t');

                            // previous month saturday case
                            $this_start_date = date('Y-m-01');

                            $count_saturday = 0;

                            while (strtotime($start_date) <= strtotime(date('Y-m-d', strtotime('now')))) {
                              $unfilled_sql = "SELECT * FROM `capms_user_timesheet` WHERE `timesheet_date` = '".date("m/d/Y",strtotime($start_date))."' and user_id = '" . $emp_id . "'";
                              $result_unfilled = mysqli_query($con, $unfilled_sql);
                              $rowcount=mysqli_num_rows($result_unfilled);
                              if($rowcount<1) {
                                if(date('D', strtotime($start_date))=="Sat" && $start_date>$this_start_date) {
                                  $count_saturday++;
                                }
                                if(date('D', strtotime($start_date))!="Sun") {
                                  if(!(date('D', strtotime($start_date))=="Sat" && ($count_saturday==1 || $count_saturday==3))) {
                          ?>

                            <option value="<?php echo date("m/d/Y",strtotime($start_date)); ?>"><?php echo date("m/d/Y",strtotime($start_date))." - ".date('D', strtotime($start_date));?></option>

                          <?php
                                  }
                                }
                              }
                                $start_date = date("Y-m-d", strtotime("+1 days", strtotime($start_date)));
                              }
                          ?>
                        </select>  
                      </div>
                      
                      <div class="col-md-2">
                        <button type="submit" id="fill_unfilled_timesheet_button" class="btn btn-danger" disabled>fill timesheet</button>
                      </div>
                    </div>
                  </form> 
                </div>
              </div>
            </section>

            <section id="filled_timesheet" class="py-3 d-none">
            <div class="row">
                <div class="col">
                  <label for="filled_timesheet_dropdown" class="form-label text-success">* please fill the unfilled timesheet of this month</label>
                  <form action="" method="post">
                    <div class="row">
                      <div class="col-md-10">
                        <select class="form-control" id="filled_timesheet_dropdown" name="filled_timesheet_select">
                          <option value="">select unfilled timesheet</option>
                          <?php
                            require_once "database.php";
                            $emp_id = $_SESSION['emp_id'];

                            date_default_timezone_set('UTC');

                            // $start_date = date('Y-m-01');
                            $start_date = date('Y-m-25', strtotime(date('Y-m')." -1 month"));
                            $end_date = date('Y-m-t');

                            // previous month saturday case
                            $this_start_date = date('Y-m-01');

                            $count_saturday = 0;

                            while (strtotime($start_date) <= strtotime(date('Y-m-d', strtotime('now')))) {
                              $unfilled_sql = "SELECT * FROM `capms_user_timesheet` WHERE `timesheet_date` = '".date("m/d/Y",strtotime($start_date))."' and user_id = '" . $emp_id . "'";
                              $result_unfilled = mysqli_query($con, $unfilled_sql);
                              $rowcount=mysqli_num_rows($result_unfilled);
                              if($rowcount>0) {
                                if(date('D', strtotime($start_date))=="Sat" && $start_date>$this_start_date) {
                                  $count_saturday++;
                                }
                                if(date('D', strtotime($start_date))!="Sun") {
                                  if(!(date('D', strtotime($start_date))=="Sat" && ($count_saturday==1 || $count_saturday==3))) {
                          ?>

                            <option value="<?php echo date("m/d/Y",strtotime($start_date)); ?>"><?php echo date("m/d/Y",strtotime($start_date))." - ".date('D', strtotime($start_date));?></option>

                          <?php
                                  }
                                }
                              }
                                $start_date = date("Y-m-d", strtotime("+1 days", strtotime($start_date)));
                              }
                          ?>
                        </select>  
                      </div>
                      
                      <div class="col-md-2">
                        <button type="submit" id="fill_filled_timesheet_button" class="btn btn-success" disabled>fill timesheet</button>
                      </div>
                    </div>
                  </form> 
                </div>
              </div>
            </section>

            <section id="view_filled_timesheet" class="py-3 d-none">
              <div class="row">
                <div class="col">
                  <form action="" method="post">
                    <div class="row">
                      <div class="col-md-10">
                        <ul>
                          <?php
                            require_once "database.php";
                            $emp_id = $_SESSION['emp_id'];

                            date_default_timezone_set('UTC');

                            // $start_date = date('Y-m-01');
                            $start_date = date('Y-m-25', strtotime(date('Y-m')." -1 month"));
                            $end_date = date('Y-m-t');

                            // previous month saturday case
                            $this_start_date = date('Y-m-01');

                            $count_saturday = 0;

                            $filled_timesheet_count = 0;

                            while (strtotime($start_date) <= strtotime(date('Y-m-d', strtotime('now')))) {
                              $unfilled_sql = "SELECT * FROM `capms_user_timesheet` WHERE `timesheet_date` = '".date("m/d/Y",strtotime($start_date))."' and user_id = '" . $emp_id . "'";
                              $result_unfilled = mysqli_query($con, $unfilled_sql);
                              $rowcount=mysqli_num_rows($result_unfilled);
                              if($rowcount>0) {
                                if(date('D', strtotime($start_date))=="Sat" && $start_date>$this_start_date) {
                                  $count_saturday++;
                                }
                                if(date('D', strtotime($start_date))!="Sun") {
                                  if(!(date('D', strtotime($start_date))=="Sat" && ($count_saturday==1 || $count_saturday==3))) {
                          ?>

                            <li><a href="timesheet.php?selected_date=<?php echo date("m/d/Y",strtotime($start_date))?>"><?php echo date("m/d/Y",strtotime($start_date))." - ".date('D - M', strtotime($start_date));?></a></li>

                          <?php
                                  }
                                }
                                $filled_timesheet_count++;
                              }
                                $start_date = date("Y-m-d", strtotime("+1 days", strtotime($start_date)));
                              }

                              if($filled_timesheet_count==0) {
                                echo '<span class="bg-danger p-1 text-light">No filled timesheet for this month!</span>';
                              }
                          ?>
                        </ul> 
                      </div>
                    </div>
                  </form> 
                </div>
              </div>
            </section>

            <section id="timesheet_accordion" class="py-3 d-none">
              <?php
                // get years of employee
                $sql_timesheet_year = "SELECT DISTINCT SUBSTRING_INDEX(timesheet_date,'/',-1) AS timesheet_year from `capms_user_timesheet` where user_id='".$_SESSION['emp_id']."' order by timesheet_year desc;";
                $timesheet_year = '';
                $timesheet_year_array = array();
                $result_timesheet_year = mysqli_query($con,$sql_timesheet_year);
                if($result_timesheet_year->num_rows>0) {
                  while($row_timesheet_year = mysqli_fetch_assoc($result_timesheet_year)) {
                    $timesheet_year = $row_timesheet_year['timesheet_year'];
              ?>
            
              <h3 id="timesheet_<?php echo $timesheet_year?>_title"><?php echo $timesheet_year?></h3>
              <div>
                <p id="timesheet_<?php echo $timesheet_year?>_content">This is a demo description!</p>
              </div>
                  
              <?php
                  array_push($timesheet_year_array,$timesheet_year);
                }} 
                // print_r($timesheet_year_array);
              ?>
            </section>

            <section id="insert_timesheet" class="insert_timesheet d-none border shadow mb-3 bg-light">
              <div class="timesheet" id="timesheet">
                <form action="timesheetDB.php" method="post">
                  <div class="text-center bg-dark text-light py-2 fw-bolder mb-3">
                    <h5>* please fill the timesheet properly</h5> 
                  </div>
                  <div class="bg-light p-3 my-3 ">
                    <div id="date_row" class="row d-none">
                      <div class="col">
                          <div class="mb-3">
                              <label for="dt">Timesheet Date</label></br>
                              <input id="dt" class="form-control" name="dt" placeholder="select date" value="<?php echo date('m/d/Y', strtotime('now'));?>" required />
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="mb-3">
                          <label for="project">project</label>
                          <select class="form-control" id="project-dropdown" name="project" required>
                            <option value="">select project</option>
                            <?php
                            $emp_id = $_SESSION['emp_id'];
                            $sql = "SELECT DISTINCT user_id, cpi.project_id, title 
                            FROM `capms_user_workload_info` as cuwi 
                            inner join `capms_project_info` as cpi on cuwi.project_id = cpi.project_id 
                            where user_id = '" . $emp_id . "' and `project_status` = 1;";
                            $result = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                              <option value="<?php echo $row['project_id']; ?>"><?php echo $row["title"]; ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col">
                        <div class="mb-3">
                          <label for="task_id-dropdown">task_name</label>
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
                                <input type="text" class="form-control" name="start_time" value="<?php 
                                  $sql_last_end_time = "SELECT * FROM `capms_user_timesheet` WHERE timesheet_date = '".date('m/d/Y', strtotime('now'))."' ORDER BY end_time DESC LIMIT 1";
                                  $result_last_end_time = mysqli_query($con, $sql_last_end_time);
                                  if (mysqli_num_rows($result_last_end_time) > 0){
                                    while ($row_last_end_time = mysqli_fetch_array($result_last_end_time)) {
                                      echo $row_last_end_time['end_time'];
                                    }
                                  }
                                  else {
                                    echo "10:30";
                                  }
                                ?>" required>
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
                                <input type="text" class="form-control" name="end_time" value="19:30" required>
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
                          <label for="task_type-dropdown" class="form-label">task_type</label>
                          <select class="form-control" id="task_type-dropdown" name="task_type" required>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="mb-3">
                          <label for="trello_link" class="form-label">trello_link</label>
                          <input type="text" class="form-control" name="trello_link" placeholder="enter trello_link" required>
                        </div>
                      </div>
                      <div class="col">
                        <div class="mb-3">
                          <label for="description" class="form-label">description</label>
                          <input type="text" class="form-control" name="description" placeholder="enter description" required>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col">
                        <div class="mb-0">
                          <input id="submit_button" type="submit" class="block bg-primary text-light"></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </section>

            <?php
              if(isset($_POST['unfilled_timesheet_select'])) {
                echo '<script>
                  $("#insert_timesheet").removeClass("d-none");
                  $("#date_row").removeClass("d-none");
                  $("#dt").val("'.$_POST['unfilled_timesheet_select'].'");
                </script>';
              }
            ?>

            <?php
              if(isset($_POST['filled_timesheet_select'])) {
                echo '<script>
                  $("#insert_timesheet").removeClass("d-none");
                  $("#date_row").removeClass("d-none");
                  $("#dt").val("'.$_POST['filled_timesheet_select'].'");
                </script>';
              }
            ?>

            <?php
              $current_date = date('m/d/Y', strtotime('now'));
            ?>


            <section id="filter_date" class="d-none">
              <form action="" method="post">
                <div class="card">
                  <div class="card-header bg-warning text-dark">
                    Filter using start date and end date
                  </div>
                  <div class="card-body">
                    <div class="row text-dark">
                      <div class="col">
                        <div class="mb-3">
                          <label for="sdt">Start date - </label></br>
                          <input id="sdt" name="sdate" placeholder=" choose start date" autocomplete="off"/>
                        </div>
                      </div>
                      <div class="col">
                        <div class="mb-3">
                          <label for="edt">End date - </label></br>
                          <input id="edt" name="edate" placeholder=" choose end date" autocomplete="off"/>
                        </div>
                      </div>
                    </div>  
                    <div class="row">
                      <div class="col"></div>
                      <div class="col">
                        <div class="mb-3">
                          <button type="submit" id="filter_button" class="btn btn-primary" style="width: 100%;" disabled>Filter</button>
                        </div>
                      </div>
                      <div class="col"></div>
                    </div>
                  </div>
                </div>
              </form>
            </section>

            <section class="view-tasks">
              <table class="table">
                <thead class="bg-dark text-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Timesheet Date</th>
                    <th scope="col">Project Name</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Task Details</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Trello Link</th>
                    <th scope="col">Description</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include 'database.php';
                  $user_id = $_SESSION['emp_id'];
                  
                  // if(isset($_POST['sdate']) && isset($_POST['edate'])) {
                  //   $query = "SELECT * FROM `capms_user_timesheet` WHERE `user_id` = '" . $user_id . "' and `timesheet_date` BETWEEN '".$_POST['sdate']."' AND '".$_POST['edate']."'";
                  // }
                  // else if(isset($_GET['selected_date'])) {
                  //   $query = "SELECT * FROM `capms_user_timesheet` WHERE `user_id` = '" . $user_id . "' and `timesheet_date`= '".$_GET['selected_date']."'";
                  // }
                  // else {
                  //   $query = "SELECT * FROM `capms_user_timesheet` WHERE `user_id` = '" . $user_id . "' and `timesheet_date`= '".$current_date."'";
                  // }

                  if(isset($_POST['sdate']) && isset($_POST['edate'])) {
                    $query = "SELECT * FROM `capms_user_timesheet` WHERE `user_id` = '" . $user_id . "' and `timesheet_date` BETWEEN '".$_POST['sdate']."' AND '".$_POST['edate']."'";
                  }
                  else if(isset($_GET['selected_date'])) {
                    $query = "SELECT * FROM `capms_user_timesheet` WHERE `user_id` = '" . $user_id . "' and `timesheet_date`= '".$_GET['selected_date']."'";
                  }
                  else if(isset($_GET['timesheet_year_send']) && isset($_GET['timesheet_month_send']) && isset($_GET['timesheet_day_send'])) {
                    $selected_date_send = ''.$_GET['timesheet_month_send'].'/'.$_GET['timesheet_day_send'].'/'.$_GET['timesheet_year_send'].'';
                    $query = "SELECT * FROM `capms_user_timesheet` WHERE `user_id` = '" . $user_id . "' and `timesheet_date`= '".$selected_date_send."'";
                  }
                  else {
                    $query = "SELECT * FROM `capms_user_timesheet` WHERE `user_id` = '" . $user_id . "' and `timesheet_date`= '".$current_date."'";
                  }

                  $duration = array();
                  $task_number_array = array();

                  $result = mysqli_query($con, $query);
                  if (mysqli_num_rows($result) > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<td>" . $count++ . "</td>";
                      echo "<td>" . $row['timesheet_date'] . "</td>";

                      // find project_id and task_id from workload_id and user_id
                      $find_id_from_workload_sql = "SELECT * FROM `capms_user_workload_info` as cuwi inner join `capms_project_task_info` as cpti on cpti.task_id = cuwi.task_id inner join `capms_project_info` as cpi on cpi.project_id = cuwi.project_id WHERE cuwi.`user_id` = '" . $_SESSION['emp_id'] . "' AND `workload_id` = '" . $row['workload_id'] . "'";

                      $result_from_workload = mysqli_query($con, $find_id_from_workload_sql);

                      while ($row_from_workload = mysqli_fetch_array($result_from_workload)) {
                        $project_name = $row_from_workload['title'];
                        $task_name = $row_from_workload['task_name'];
                        $task_number = $row_from_workload['task_number'];
                      }

                      // find task_domain name by task_domain_id
                      $task_domain_name_sql = "SELECT * FROM `capms_user_timesheet` WHERE `timesheet_id` = '".$row['timesheet_id']."'";

                      $result_task_domain_name = mysqli_query($con, $task_domain_name_sql);

                      while ($row_task_domain_name = mysqli_fetch_array($result_task_domain_name)) {
                        $task_domain = $row_task_domain_name['task_domain'];
                      }

                      // for each task domain, find task_domain_name eg. frontend, backend, seo
                      $task_domain_array = explode(',',$task_domain);
                      $task_domain = '';
                      foreach($task_domain_array as $td) {
                        $sql_dept_select = "SELECT * FROM `capms_department_info` WHERE `dept_id` = '".$td."'";
                        $result_dept_select = mysqli_query($con, $sql_dept_select);
                        while($row_dept_select = mysqli_fetch_array($result_dept_select)) {
                          if($task_domain=='') {
                            $task_domain = $row_dept_select['dept_name'];
                          }
                          else {
                            $task_domain .= ', '.$row_dept_select['dept_name'];
                          }
                        }
                      }

                      // find task_type by task_domain_id
                      $task_type_name_sql = "SELECT * FROM `capms_project_tasktype_info` WHERE `task_type_id` = '". $row['task_type'] . "'";

                      $result_task_type_name = mysqli_query($con, $task_type_name_sql);

                      while ($row_task_type_name = mysqli_fetch_array($result_task_type_name)) {
                        $task_type = $row_task_type_name['task_type_name'];
                      }
              
                      $diff = strtotime($row['end_time']) - strtotime($row['start_time']);
                      $secs = $diff % 60;
                      $hrs = $diff / 60;
                      $mins = $hrs % 60;
                      $hrs = $hrs / 60;
                      $duration_one = sprintf('%0.2f', (float)((int)$hrs . "." . (int)$mins));
                      array_push($duration,$duration_one);
                      array_push($task_number_array,$task_number);

                      echo "<td>" . $project_name . "</td>";
                      echo "<td>" . $task_name . "</td>";
                      echo "<td>" . $task_domain . " => " . $task_type . "</td>";
                      echo "<td>" . $row['start_time'] . "hrs - " . $row['end_time'] . "hrs" . " (".$duration_one.") "."</td>";
                      echo "<td><a href=".$row['trello_link'].">" . $row['trello_link'] ."</a></td>";
                      echo "<td>" . $row['description'] . "</td>";
                      $id = $row['timesheet_id'];
                      echo '<td><a href="timesheet_edit.php?id=' . $id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg></a></td>';

                      // EDIT TIMESHEET BASED ON TIMESHEET_ID

                      echo '<td><a class="text-danger" href="timesheet_deleteDB.php?id=' . $id . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                    </svg></a></td>';
                      echo "</tr>";
                    }
                  }
                  ?>
                </tbody>
              </table>
            </section>
              
            <section class="total_time">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Time - <span class="text-danger">Task Number</span></h5>
                  <p class="card-text">
                    <?php
                      $total_hours = 0;
                      $total_minutes = 0;

                      // if there is any gracetime add that to minutes
                      if($temp_gracetime!='') {
                        $exploded_gracetime= explode(':',$temp_gracetime);
                        $total_minutes+=(int)$exploded_gracetime[1];
                        echo '<h5>+'.$exploded_gracetime[0].'.'.$exploded_gracetime[1].' - <span class="px-1 text-danger">GRACE TIME APPLIED</span></h5> ';
                      }

                      // check if any breaks are there, add the break time difference in total_hours and total_minutes
                      
                      $user_id = $_SESSION['emp_id'];
                      if(isset($_GET['selected_date'])) {
                        $sql_break = "SELECT * FROM `capms_login_information` WHERE user_id='".$user_id."' and `login_date`= '".date('d-m-Y', strtotime($_GET['selected_date']))."'";
                      }
                      else {
                        $sql_break = "SELECT * FROM `capms_login_information` WHERE user_id='".$user_id."' and `login_date`= '".date('d-m-Y', strtotime($current_date))."'";
                      }
                      $result_break = mysqli_query($con, $sql_break);
                      if (mysqli_num_rows($result_break) > 0) {
                        while ($row_break = mysqli_fetch_assoc($result_break)) {
                          $lunch_start = $row_break['lunch_break_start'];
                          $lunch_end = $row_break['lunch_break_end'];

                          $from_time_lunch = strtotime($lunch_start); 
                          $to_time_lunch = strtotime($lunch_end); 
                          $diff_minutes_lunch = round(abs($from_time_lunch - $to_time_lunch) / 60,2);

                          $evening_start = $row_break['evening_break_start'];
                          $evening_end = $row_break['evening_break_end'];

                          $from_time_evening = strtotime($evening_start); 
                          $to_time_evening = strtotime($evening_end); 
                          $diff_minutes_evening = round(abs($from_time_evening - $to_time_evening) / 60,2);
                        }
                      }

                      // if lunch break then add
                      if($diff_minutes_lunch!='') {
                        $total_minutes+=(int)$diff_minutes_lunch;
                        echo '<h5>+'.$diff_minutes_lunch.' - <span class="px-1 text-danger">lunch break</span></h5> ';
                      }

                      // if evening break then add
                      if($diff_minutes_evening!='') {
                        $total_minutes+=(int)$diff_minutes_evening;
                        echo '<h5>+'.$diff_minutes_evening.' - <span class="px-1 text-danger">evening break</span></h5> ';
                      }

                      for($i=0; $i<count($duration); $i++) {
                        $du_array= explode('.',$duration[$i]);
                        $task_number_temp = $task_number_array[$i];
                        if($task_number_temp=='') {
                          $task_number_temp = 'Please assign a task number!';
                        }
                        echo '<h5>+'.$du_array[0].'.'.$du_array[1].' - <span class="px-1 text-danger">'.$task_number_temp.'</span></h5> ';
                        $total_hours += (int)$du_array[0];
                        $total_minutes += (int)$du_array[1];
                      }
                      
                      $hours_add = (int)$total_minutes/60;
                      $total_minutes = $total_minutes%60;
                      $total_hours+=(int)$hours_add;
                      echo '<hr><h1>Total - '.$total_hours.'.'.$total_minutes.' Hours</h1>';
                    ?>
                  </p>
                </div>
              </div>
            </section>
            <?php } ?>
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
    // $(function() {
    //   var availableTeamMembers = <?php //echo $names ?>;
    //   $("#leaders").autocomplete({
    //     source: availableTeamMembers
    //   });
    //   var availableTeams = ['Html-Css', 'Angular-Iocic', 'Development', 'Testing'];
    //   $("#teams").autocomplete({
    //     source: availableTeams
    //   });
    // });
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
        var date = $(this).val();
        // console.log(date);
        var fullDate = new Date();
        var twoDigitMonth = ((fullDate.getMonth().length + 1) === 1) ? (fullDate.getMonth() + 1) : '0' + (fullDate.getMonth() + 1);
        var currentDate = fullDate.getDate() + "/" + twoDigitMonth + "/" + fullDate.getFullYear();
        // console.log(currentDate);
        var fullDateObj = new Date(date);
        var currentDateObj = new Date();
        if (fullDateObj > currentDateObj) {
          alert("Future date not allowed!!!");
          $.datepicker._clearDate(this);
        } else {
          // console.log(currentDateObj.getMonth()+1);
          if (fullDateObj < currentDateObj.getMonth()) {
            alert("Previous month's date not allowed!!!");
            $.datepicker._clearDate(this);
          }
        }
      }
    });
  </script>

  <!-- START DATE AND END DATE PICKER -->
  <script>
    $("#sdt").datepicker({
      onSelect: function(dateText, inst) {
        var sdate = $(this).val();
        var fullStartDate = new Date(sdate);
        var twoDigitMonthStart = ((fullStartDate.getMonth().length + 1) === 1) ? (fullStartDate.getMonth() + 1) : '0' + (fullStartDate.getMonth() + 1);
        var startDate = fullStartDate.getDate() + "/" + twoDigitMonthStart + "/" + fullStartDate.getFullYear();

        if($('#edt').val()!='' && startDate!='') {
          $('#filter_button').prop('disabled', false);
        }
      }
    });
    $("#edt").datepicker({
      onSelect: function(dateText, inst) {
        var edate = $(this).val();
        var fullEndDate = new Date(edate);
        var twoDigitMonthEnd = ((fullEndDate.getMonth().length + 1) === 1) ? (fullEndDate.getMonth() + 1) : '0' + (fullEndDate.getMonth() + 1);
        var endDate = fullEndDate.getDate() + "/" + twoDigitMonthEnd + "/" + fullEndDate.getFullYear();

        if(endDate!='' && $('#sdt').val()!='') {
          // enable submit button
          $('#filter_button').prop('disabled', false);
        }
      }
    });
  </script>

  <!-- TIMESHEET ADD AND CLEAR JQUERY -->
  <script>
    $(document).ready(function() {
      $("#add_timesheet").click(function() {
        $("#insert_timesheet").toggleClass("d-none");
      });
    });
  </script>

  <!-- FILTER TOGGLE -->
  <script>
    $(document).ready(function() {
      $("#timesheet_filter").click(function() {
        $("#filter_date").toggleClass("d-none");
      });
    });
  </script>

  <!-- UNFILLED TIMESHEET TOGGLE -->
  <script>
    $(document).ready(function() {
      $("#unfilled_timesheet_button").click(function() {
        $("#unfilled_timesheet").toggleClass("d-none");
      });
      $("#filled_timesheet_button").click(function() {
        $("#filled_timesheet").toggleClass("d-none");
      });
      $("#view_filled_timesheet_button").click(function() {
        $("#view_filled_timesheet").toggleClass("d-none");
      });
      $("#accordion_button").click(function() {
        $("#timesheet_accordion").toggleClass("d-none");
      });
    });
  </script>

  <!-- FILL UNFILLED TIMESHEET -->
  <script>
    $(document).ready(function() {
      $('#unfilled_timesheet_dropdown').on('change', function () {
          var selectVal = this.value;
          if(selectVal!='') {
            $('#fill_unfilled_timesheet_button').prop('disabled', false);
          }
      });
      $('#filled_timesheet_dropdown').on('change', function () {
          var selectVal = this.value;
          if(selectVal!='') {
            $('#fill_filled_timesheet_button').prop('disabled', false);
          }
      });
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
            project_id: project_id
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

  <!-- jquery for nested data fetch -->
  <?php if(isset($timesheet_year_array)) { foreach($timesheet_year_array as $timesheet_year) {?>
  <script>
    $(document).ready(function() {
      $('#timesheet_<?php echo $timesheet_year?>_title').on('click', function() {
        // console.log($(this).text());
        var timesheet_year_js = $(this).text();
        $.ajax({
          url: "timesheet_months_by_year_ajax.php",
          type: "POST",
          dataType: "JSON",
          data: {
            timesheet_year: timesheet_year_js,
            user_id: <?php echo $_SESSION['emp_id']?>
          },
          cache: false,
          success: function(result) {
            // console.log(result);
            var len = result.length;
            var ul_str = "<ul>";
            for(let i=0; i<len; i++) {
              var id = result[i].id;
              var value = result[i].value;
              var month_value = result[i].month_value;
              const p_string = '<p id="'+timesheet_year_js+'_content"'+'></p>';
              // console.log(p_string);
              if(i===len-1) {
                ul_str += "<li id='"+id+"'>"+month_value+"-"+value+p_string+"</li>";
              }
              else {
                ul_str += "<li id='"+id+"'>"+month_value+"-"+value+"</li>";
              }
            }
            ul_str += "</ul>";
            
            $("#timesheet_<?php echo $timesheet_year?>_content").html(ul_str);

            for(let i=0; i<len; i++) {
              var inner_id = result[i].id;
              $('#'+inner_id).on('click',function(){
                var clicked_inner_id = result[i].id;
                var timesheet_month_js = result[i].value;
                // console.log("timesheet_month : "+timesheet_month_js);
                console.log(clicked_inner_id);
                $.ajax({
                  url: "timesheet_days_by_month_ajax.php",
                  type: "POST",
                  dataType: "JSON",
                  data: {
                    timesheet_year: timesheet_year_js,
                    timesheet_month: timesheet_month_js,
                    user_id: <?php echo $_SESSION['emp_id']?>
                  },
                  cache: false,
                  success: function(result) {
                    // console.log(result);
                    const day_length = result.length;
                    // <div class="row">
                    //   <div class="col-sm">
                    //     One of three columns
                    //   </div>
                    // </div>
                    var ul_str = "<div class='row py-3'>";
                    for(let j=0; j<day_length; j++) {
                      var day_value = result[j].value;
                      // console.log(day_value);
                      day_value_id = clicked_inner_id+'_'+day_value;
                      console.log(day_value_id);
                      ul_str += "<div class='col-sm'><a href='timesheet.php?user_id=<?php echo $_SESSION['emp_id']?>&timesheet_year_send="+timesheet_year_js+"&timesheet_month_send="+timesheet_month_js+"&timesheet_day_send="+day_value+"' class='btn btn-dark text-light w-100' id='"+day_value_id+"'>"+day_value+"</a></div>";
                      // <button type="button" class="btn btn-primary btn-sm rounded">Small</button>
                    }
                    ul_str += "</div>";
                    const ul_heading = "<hr><h6 class='fw-bolder'>Month - "+timesheet_month_js+"</h6>";
                    const ul_final = ul_heading+ul_str;
                    $("#"+timesheet_year_js+'_content').html(ul_final);
                  },
                  error: function() {
                    alert('problem in state');
                  }
                });
              });
            }
          },
          error: function() {
            alert('problem in state');
          }
        });
      });
    });
  </script>
  <?php }}?>

  <!-- CLOCK WIDGETS -->
  <script type="text/javascript">
  $('.clockpicker').clockpicker({
      placement: 'top',
      align: 'left',
      donetext: 'Done',
      autoclose: true
  });
  </script>

  <!-- JQUERY UI ACCORDION -->
  <script>
  $( function() {
    $( "#timesheet_accordion" ).accordion({
      collapsible: true,
      heightStyle: "content",
      active: false
    });
  });
  </script>

</body>

</html>