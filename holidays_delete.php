<?php
    require_once('database.php');
    $sid=$_GET['id'];
    echo $sid;
    $query= "DELETE FROM capms_holidays WHERE id ='$sid'";
    $query_run=mysqli_query($con,$query);
    if($query_run){
        header('location: holidays_view.php');
    }
    else{
        echo "Not Deleted";
    }
?>