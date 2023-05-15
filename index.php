<!doctype html>
<html lang="en">

<head>
  <!-- Header CSS files -->
  <?php include 'header_css.php'; ?>
  <?php
  //error_reporting(E_ALL ^ E_NOTICE);
  if ($_SESSION['emp_id'] == '') {
    echo "<script>location.href='" . $baseURL . "login.php';</script>";
  }

  // preventing auto-login using session when previous session is set and no previous logout time is there.
  //echo date('d-m-Y');

  $login_details = "SELECT * FROM `capms_login_information` WHERE user_id = '" . $_SESSION['emp_id'] . "' AND `logout_time` = '' ORDER BY ID DESC LIMIT 1";

  $result_logout = mysqli_query($con, $login_details);

  while ($row_logout = mysqli_fetch_assoc($result_logout)) {
    // echo '<pre>';
    // print_r($_SESSION['start']);
    // echo "<br/>";
    // echo date('d-m-Y', 1662966494);

    //print_r($row_logout);
    //die;
    if ($row_logout['logout_time'] == '' && $row_logout['login_date'] != date('d-m-Y')) {
      unset($_SESSION['emp_id']);
      unset($_SESSION['emp_name']);
      unset($_SESSION['emp_image']);
      session_destroy();
      echo "<script>location.href = '" . $baseURL . "login.php';</script>";
    }
  }
  if (date('d-m-Y', $_SESSION['start']) != date('d-m-Y')) {
    unset($_SESSION['emp_id']);
    unset($_SESSION['emp_name']);
    unset($_SESSION['emp_image']);
    session_destroy();
    echo "<script>location.href = '" . $baseURL . "login.php';</script>";
  }
  //die;
  ?>
  <title>CAPMS :: CodeArts Performance Management System</title>
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
            <section class="dashboard-cal-sheet">
              <div class="row">

                <div class="col-lg-12">
                  <div class="dp-weekly-time-sheet">
                    <div class="custom-heading">
                      <h3>Monthly Access Log</h3>
                    </div>
                    <div class="weekly-time-table-dashboard">
                      <div class="custom-heading">
                        <h4>Employee Name: <span>
                            <?php echo $_SESSION['emp_name'];  ?>
                          </span></h4>
                        <h3>Filter By Month & Year</h3>
                        <label for="month">Choose a Month:</label>

                        <select name="month" id="months">
                          <option value="01">January</option>
                          <option value="02">February</option>
                          <option value="03">March</option>
                          <option value="04">April</option>
                          <option value="05">May</option>
                          <option value="06">June</option>
                          <option value="07">July</option>
                          <option value="08">Auguest</option>
                          <option value="09">September</option>
                          <option value="10">October</option>
                          <option value="11">November</option>
                          <option value="12">December</option>
                        </select>

                        <label for="month">Choose a Year:</label>

                        <select name="year" id="years">
                          <option value="2021">2021</option>
                          <option value="2022">2022</option>
                          <option value="2023">2023</option>

                        </select>

                        <div class="go_filter">
                          <button type="button" class="go_btn">Go</button>
                        </div>

                      </div>
                      <!-- Employee Weekly Timesheet file -->
                      <table class="table weekly-time-table-dp">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Login Time</th>
                            <th scope="col">Lunch Break</th>
                            <th scope="col">Evening Breaks</th>
                            <th scope="col">Logout Time</th>
                            <th scope="col">Total Hours</th>
                          </tr>
                        </thead>
                        <tbody class="user_access_montly">
                          <?php
                          $fir_sat = date('d-m-Y', strtotime('first saturday of March 2023'));

                          $third_sat = date('d-m-Y', strtotime('third saturday of March 2023'));
                          $wkend_days = array($fir_sat, $third_sat);


                          function getSundays($y, $m)
                          {
                            return new DatePeriod(
                              new DateTime("first sunday of $y-$m"),
                              DateInterval::createFromDateString('next sunday'),
                              new DateTime("last day of $y-$m 23:59:59")
                            );
                          }

                          foreach (getSundays(2023, 03) as $sunday) {
                            array_push($wkend_days, $sunday->format("d-m-Y"));
                          }

                          //print_r($wkend_days);

                          $month = date('m');
                          $sql2 = "SELECT * FROM `capms_login_information` WHERE `user_id` = '" . $_SESSION['emp_id'] . "' AND `login_date` LIKE '%-" . $month . "-%'";


                          $result2 = mysqli_query($con, $sql2);
                          if ($result2->num_rows > 0) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                              //print_r($row2);
                              //die;
                              $checkTime = strtotime('10:45:00');
                              $loginTime = strtotime($row2['login_time']);
                              $diff = $checkTime - $loginTime;
                              ($diff < 0) ? $class = 'late' : $class = 'right';

                              if (!in_array(date('d-m-Y', strtotime($row2['login_date'])), $wkend_days)) {
                          ?>
                                <tr>
                                  <!-- login date -->
                                  <th scope="row">
                                    <?php echo date('d-m-Y', strtotime($row2['login_date'])); ?>
                                  </th>
                                  <!-- login time -->
                                  <td class="bg-dp-drk <?php echo $class ?>">
                                    <?php echo $row2['login_time']; ?>
                                  </td>
                                  <!-- lunch break duration -->
                                  <?php
                                  $diff_lunch_break = strtotime($row2['lunch_break_end']) - strtotime($row2['lunch_break_start']);
                                  ($diff_lunch_break > 3600) ? $class = 'late' : $class = 'right';
                                  ?>
                                  <td class="<?php echo $class ?>">
                                    <?php
                                    if ($row2['lunch_break_start'] != '') {
                                      echo $row2['lunch_break_start'];
                                    }
                                    if ($row2['lunch_break_end'] != '') {
                                      echo " - " . $row2['lunch_break_end'];
                                    }
                                    ?>
                                  </td>
                                  <!-- evening break duration -->
                                  <?php
                                  $diff_evn_break = strtotime($row2['evening_break_end']) - strtotime($row2['evening_break_start']);
                                  ($diff_evn_break > 600) ? $class = 'late' : $class = 'right';
                                  ?>
                                  <td class="<?php echo $class ?>">
                                    <?php
                                    if ($row2['evening_break_start'] != '') {
                                      echo $row2['evening_break_start'];
                                    }
                                    if ($row2['evening_break_end'] != '') {
                                      echo " - " . $row2['evening_break_end'];
                                    }
                                    ?>
                                  </td>
                                  <!-- logout time -->
                                  <td class="bg-dp-drk">
                                    <?php
                                    if ($row2['logout_time'] != "") {
                                      $logout_time_array = explode(" ", $row2['logout_time']);
                                      $logout_time = str_replace('-', ':', $logout_time_array[0]);
                                      $logout_time = date('g:i A', strtotime($logout_time));
                                      echo $logout_time . " <span class='text-danger'><b>" . $logout_time_array[1] . "</b></span>";
                                    }
                                    ?>
                                  </td>
                                  <!-- total hours -->
                                  <?php
                                  $diff = strtotime($logout_time) - strtotime($row2['login_time']) - $diff_lunch_break - $diff_evn_break;
                                  $secs = $diff % 60;
                                  $hrs = $diff / 60;
                                  $mins = $hrs % 60;
                                  $hrs = $hrs / 60;
                                  $working_hours = (float) ((int)$hrs . "." . (int)$mins);

                                  if (number_format($working_hours, 2) >= 7.40) {
                                    $class = 'right';
                                  } else {
                                    $class = 'late';
                                  }
                                  ?>
                                  <td class="<?php echo $class ?>">
                                    <?php
                                    if ($row2['logout_time'] != "" && $row2['login_time'] != "") {
                                      echo $working_hours;
                                    }
                                    ?>
                                  </td>

                                </tr>
                          <?php
                              }
                            }
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>
              </div>
            </section>

          </div>
        </div>
      </div>
    </div>
  </main>
  <footer class="custom-footer">
    <!-- Copyright Content file -->
    <?php include 'copyright_content.php'; ?>
  </footer>
  <!-- Footer JS files -->
  <script>
    jQuery(document).ready(function() {
      jQuery('.go_btn').click(function() {
        var month = $("#months option:selected").val();
        var year = $("#years option:selected").val();

        jQuery.ajax({
          type: "GET",
          url: "<?php echo $baseURL; ?>ajax_access_log.php",
          data: {
            month: month,
            year: year,
          },
          dataType: "json",
          success: function(response) {
            console.log(response);
            if (response.status == 'success') {
              var html = (response.data);
              jQuery('.user_access_montly').html(html)
            }
          }
        });

      })
    })
  </script>
</body>

</html>