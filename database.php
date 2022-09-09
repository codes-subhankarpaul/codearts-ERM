<?php
date_default_timezone_set("Asia/Kolkata");

$servername = "localhost";
$username = "root";
$password = "";
$database = "codearts_pms_new";

$con = mysqli_connect($servername, $username, $password, $database);
if(!isset($_SESSION)) { 
  session_start(); 
} 

if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

$baseURL = 'http://localhost/ERM/';
?>