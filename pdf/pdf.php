<?php
    require_once 'vendor/autoload.php';
    use Dompdf\Dompdf;
    use Dompdf\Options;
    require_once 'dompdf/autoload.inc.php';
    $options = new Options();
    $options->set('isRemoteEnabled', TRUE);
    $dompdf = new Dompdf($options);
    $contxt = stream_context_create([ 
        'ssl' => [ 
            'verify_peer' => FALSE, 
            'verify_peer_name' => FALSE,
            'allow_self_signed'=> TRUE
        ] 
    ]);
    $dompdf->setHttpContext($contxt);
    $dompdf->getOptions()->setChroot("/opt/lampp/htdoc/pdf");

    
    require('payslip_by_ERM.php');
    $html =  $paySlip_Data;

    

$dompdf->loadHtml($html);
//$dompdf->loadHtml($htmlDocument);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'potrait');

// Render the HTML as PDF
$dompdf->render();


// Output the generated PDF to Browser
$dompdf->stream();

$dompdf->stream("payslip.pdf", array("Attachment" => false));
?>