<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>ERM - Timesheet</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js'>
<link rel='stylesheet' href='https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/components/accordion.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/components/accordion.min.js'><link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"></script>  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/components/accordion.min.css"/>
      <link rel="stylesheet" href="./assets/./css/./custom.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.7/components/accordion.min.js"></script>
  
</head>

  <div>
    <p class="maintitle">Monthly Timesheet</p>
  </div>

<section class="timesheet-navigation">
    <div class="nav">
      <div class="container-fluid nopaddingmail">
       <div class="tabbable">
        <ul class="nav nav-tabs" data-tabs="tabs" id="myTab">
        <li class="active"><a data-toggle="tab" href="#incoming">Current</a></li>
        <li><a data-toggle="tab" href="#sentmsg">Previous</a></li>
        <li><a data-toggle="tab" href="#sentmsg">Not Sent</a></li>
        <li><a data-toggle="tab" href="#sentmsg">Wait for Accept</a></li>
        <li><a data-toggle="tab" href="#sentmsg">Accepted</a></li>
        <li><a data-toggle="tab" href="#sentmsg">Rejected</a></li>
        </ul>
        <div class="tab-content">
        <div class="tab-pane active" id="incoming">
</section>


<section class="timesheet-buttons">
  <input type="date" id="theDate">
  <div class="today-timesheet">
    <button type="button" class="newmsgb">Today</button>
    <button type="button" class="add-task-timesheet" data-toggle="modal" data-target="#addtask">Add New Task</button>
  </div>
</section>

<section style="margin-top: -40px">
  <p class="picked-day">2016-12-30</p>
</section>

<section>
 <div class="container-fluid">
   <div class="row">
     <div class="col-md-12 col-sm-12 col-xs-12 tab-title">
       <div class="row">
          <div class="col-md-2 col-sm-2 col-xs-1">
            <div class="statustitle">Project</div>
           </div>
           <div class="col-md-2 col-sm-2 col-xs-2">
             <div class="projectnametitle"> Trello Task Id</div>
           </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="completiontitle">Date</div>
           </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="detailstitle">Start Date/End Date</div>
            </div>
            <div class="col-md-1 col-sm-1 col-xs-1">
              <div class="detailstitle">Duration</div>
            </div>
             <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="detailstitle">Description</div>
            </div>
             <div class="col-md-1 col-sm-1 col-xs-1">
              <div class="tsdelete-row"></div>
            </div>
          </div>
        </div>
      </div>
    </div>  
</section>


<section>
 <div class="container-fluid">
   <div class="row">
     <div class="col-md-12 col-sm-12 col-xs-12">
       <div class="row timesheet-task-row">
          <div class="col-md-2 col-sm-2 col-xs-1">
            <div class="statustitle">Project 1</div>
           </div>
           <div class="col-md-2 col-sm-2 col-xs-2">
             <div class="projectnametitle">Task 1</div>
           </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="completiontitle">2016-12-12</div>
           </div>
            <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="detailstitle">12:00/13:00</div>
            </div>
            <div class="col-md-1 col-sm-1 col-xs-1">
              <div class="detailstitle">1 Hr.</div>
            </div>
             <div class="col-md-2 col-sm-2 col-xs-2">
              <div class="detailstitle">Really hard work.</div>
            </div>
             <div class="col-md-1 col-sm-1 col-xs-1">
              <div class="tsdelete-row">x</div>
            </div>
          </div>
        </div>
      </div>
    </div>  
</section>


<!-- Modal -->
<div id="addtask" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content timesheet">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Task</h4>
      </div>
      <div class="modal-body">
        
        <form method="POST" enctype="multipart/form-data" id="add-task-timesheet">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <p>Project</p>
                </div>
                <div class="col-md-9">
                  
                <select class="js-example-basic-single">
                  <option>Project1</option>
                  <option>Project2</option>
                  <option>Project3</option>
                  <option>Project4</option>
                  <option>Project5</option>
                </select>
                  
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p> Trello Task Id</p>
                </div>
                <div class="col-md-9"> 
                <input class="js-example-basic-single" type="text">
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p> Trello Title</p>
                </div>
                <div class="col-md-9"> 
                <input class="js-example-basic-single" type="text">
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p>Date</p>
                </div>
                <div class="col-md-9">
                  <input type="date">
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p>Start Time</p>
                </div>
                <div class="col-md-9">
                  <input type="time" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p>End Time</p>
                </div>
                <div class="col-md-9">
                  <input type="time" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p>Task Details</p>
                </div>
                <div class="col-md-9">
                <select class="js-example-basic-single">
                  <option>Backend Devlopment</option>
                  <option>Banckend Fixing</option>
                  <option>Front End Devlopment</option>
                  <option>Front End Fixing</option>
                  <option>Designing</option>
                  <option>Design Fixing</option>
                </select>
                </div>
              </div>
              <!-- <div class="row">
                <div class="col-md-3">
                  <p>Description</p>
                </div>
                <div class="col-md-9">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="">Option 1
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="">Option 2
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="" disabled>Option 3
                  </label>
                </div>
              </div>
              </div> -->
              <div class="row">
                <div class="col-md-3">
                  <p>Trello Link</p>
                </div>
                <div class="col-md-9">
                  <input type="text" class="js-example-basic-single"/>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p>Description</p>
                </div>
                <div class="col-md-9">
                  <input type="text" class="timesheet-description"/>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                  
                   <div clas="actionbutton">
                      <p class="button-container"><input class="user-aciton" type="submit">Add Task</p>
                   </div>  
                </div>
        
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
        
        <?php

        ?>
        
        
        
        
        
      </div>
    </div>

  </div>
</div>
<!-- partial -->
  <script  src="./script.js"></script>

</body>
</html>
