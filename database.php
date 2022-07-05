<?php
date_default_timezone_set("Asia/Kolkata");

$servername = "107.180.58.68";
$username = "codearts_pms";
$password = "2Z6!ON!n_{aU";
$database = "codearts_pms";

$con = mysqli_connect($servername, $username, $password, $database);
session_start();

if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

$baseURL = 'http://codeartssolution.com/ERM/';
?>