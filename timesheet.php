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

            <section class="py-3 mb-3">
              <button class="btn btn-primary" id="add_timesheet">add timesheet</button>
              <button class="btn btn-danger" id="close_add_timesheet">close timesheet</button>
            </section>

            <section id="insert-project" class="insert-project d-none border p-3 my-3 shadow">
              <div class="timesheet" id="timesheet">
                <form action="timesheetDB.php" method="post">
                  <div class="container">
                    <div class="row text-dark">
                      <div class="col">
                        <div class="mb-3">
                          <label for="dt">Select date - </label></br>
                          <input id="dt" name="dt" placeholder=" choose date" autocomplete="off"/>
                        </div>
                      </div>
                    </div>
                    <hr class="py-3">
                    <div class="row">
                      <div class="col">
                        <div class="mb-3">
                          <label for="project">project</label>
                          <select class="form-control" id="project-dropdown" name="project">
                            <option value="">select project</option>
                            <?php
                            require_once "database.php";

                            $emp_id = $_SESSION['emp_id'];

                            $sql = "SELECT DISTINCT user_id, cpi.project_id, title 
                            FROM `capms_user_workload_info` as cuwi 
                            inner join `capms_project_info` as cpi on cuwi.project_id = cpi.project_id 
                            where user_id = " . $emp_id . ";";
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
                          <label for="task_id-dropdown">task_id</label>
                          <select class="form-control" id="task_id-dropdown" name="task_id">
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="mb-3">
                          <label for="start_time" class="form-label">start_time(24 hrs)</label>
                          <input type="text" class="form-control" name="start_time" max="24" min="1" step="1" placeholder="enter start_time (ex - 11.20)">
                        </div>
                      </div>
                      <div class="col">
                        <div class="mb-3">
                          <label for="end_time" class="form-label">end_time(24 hrs)</label>
                          <input type="text" class="form-control" name="end_time" max="24" min="1" step="1" placeholder="enter end_time (ex - 15.45)">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="mb-3">
                          <label for="task_type-dropdown" class="form-label">task_type</label>
                          <select class="form-control" id="task_type-dropdown" name="task_type">
                          </select>
                        </div>
                      </div>
                      <div class="col">
                        <div class="mb-3">
                          <label for="task_domain-dropdown" class="form-label">task_domain</label>
                          <select class="form-control" id="task_domain-dropdown" name="task_domain">
                            <option value="">select task_domain</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="mb-3">
                          <label for="trello_link" class="form-label">trello_link</label>
                          <input type="text" class="form-control" name="trello_link" placeholder="enter trello_link">
                        </div>
                      </div>
                      <div class="col">
                        <div class="mb-3">
                          <label for="description" class="form-label">description</label>
                          <input type="text" class="form-control" name="description" placeholder="enter description">
                        </div>
                      </div>
                    </div>
                    <hr class="py-3">
                    <div class="row">
                      <div class="col">
                        <div class="mb-3">
                          <input type="submit" class="btn btn-primary my-3"></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </section>

            <section class="view-tasks">
              <table class="table">
                <thead class="bg-dark text-light">
                  <tr>
                    <th scope="col">Timesheet_id</th>
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
                  $query = "SELECT * FROM `capms_user_timesheet` WHERE `user_id` = '" . $user_id . "'";
                  $result = mysqli_query($con, $query);
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<td>" . $row['timesheet_id'] . "</td>";
                      echo "<td>" . $row['timesheet_date'] . "</td>";

                      // find project_id and task_id from workload_id and user_id
                      $find_id_from_workload_sql = "SELECT * FROM `capms_user_workload_info` as cuwi inner join `capms_project_task_info` as cpti on cpti.task_id = cuwi.task_id inner join `capms_project_info` as cpi on cpi.project_id = cuwi.project_id WHERE cuwi.`user_id` = '" . $_SESSION['emp_id'] . "' AND `workload_id` = '" . $row['workload_id'] . "'";

                      $result_from_workload = mysqli_query($con, $find_id_from_workload_sql);
                      $project_name = 0;
                      $task_name = 0;

                      while ($row_from_workload = mysqli_fetch_array($result_from_workload)) {
                        $project_name = $row_from_workload['title'];
                        $task_name = $row_from_workload['task_name'];
                      }

                      echo "<td>" . $project_name . "</td>";
                      echo "<td>" . $task_name . "</td>";
                      echo "<td>" . $row['task_domain'] . " - " . $row['task_type'] . "</td>";
                      echo "<td>" . $row['start_time'] . "hrs -" . $row['end_time'] . "hrs" . "</td>";
                      echo "<td>" . $row['trello_link'] . "</td>";
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
                  } else {
                    echo "<script>alert(\"no result\")</script>";
                  }
                  ?>
                </tbody>
              </table>
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
          if (fullDateObj.getMonth() < currentDateObj.getMonth()) {
            alert("Previous month's date not allowed!!!");
            $.datepicker._clearDate(this);
          }
        }
      }
    });
  </script>

  <!-- TIMESHEET ADD AND CLEAR JQUERY -->
  <script>
    $(document).ready(function() {
      $("#add_timesheet").click(function() {
        $("#insert-project").removeClass("d-none");
      });
      $("#close_add_timesheet").click(function() {
        $("#insert-project").addClass("d-none");
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