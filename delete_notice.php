<?php
    require_once('database.php');
    $sid=$_GET['id'];
    echo $sid;
    $query= "DELETE FROM capms_notice_info WHERE notice_id ='$sid'";
    $query_run=mysqli_query($con,$query);
    if($query_run){
        header('location: notice.php');
    }
    else{
        echo "Not Deleted";
    }
?>