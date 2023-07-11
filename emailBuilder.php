<?php
$ch = curl_init();
                            
curl_setopt($ch, CURLOPT_URL, 'https://api.sendinblue.com/v3/smtp/email');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);


$arrayVar = [
        "sender" => ["name" => "ERM Registartion Mail", "email" => "magentoshourya@gmail.com"],
       "to" => [
           ["email" => "magentoshourya@gmail.com", "name" => "WebAdmin"],
           ["email" => "chowdhury.shourya19@gmail.com", "name" => "Peggy Kee"]
        ],
        "subject" => "ERM Registartion Mail",
        "htmlContent" =>
            "Welcome To The ERM Of CodeArts"
    ];
    

$jsonData = json_encode($arrayVar);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);


$headers = array();
$headers[] = 'Accept: application/json';
$headers[] = 'Api-Key: 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';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);