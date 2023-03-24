<?php
require_once "database.php";
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if(isset($_POST['payslipView'])) {
    $query = "SELECT * FROM `capms_payslips` WHERE id='".$_REQUEST['id']."'";
    $query_run = mysqli_query($con, $query);
    if($query_run->num_rows > 0){
        while ($row = $query_run->fetch_assoc()) {
            $pdf = $row['payslip'];
            $filePath = "assets/payslips/" .$pdf;
        }
        header('Content-type: application/pdf'); 
        header('Content-Disposition: inline; filename="' .$filePath. '"'); 
        header('Content-Transfer-Encoding: binary'); 
        header('Accept-Ranges: bytes'); 
        @readfile($filePath);
    }
}

$con->close();
?>