<?php
date_default_timezone_set("Asia/Kolkata");

$servername = "localhost";
$username = "root";
$password = "";
$database = "codearts_pms";

$con = mysqli_connect($servername, $username, $password, $database);
session_start();

if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

$baseURL = 'http://localhost/ERM/';
?>