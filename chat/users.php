<?php
    session_start();
    include_once "../database.php";
    $outgoing_id = $_SESSION['emp_id'];
    $sql = "SELECT * FROM capms_admin_users WHERE NOT id = {$outgoing_id} ORDER BY id DESC";
    $query = mysqli_query($con, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>