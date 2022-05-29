<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = TRUE;
    $mail->SMTPSecure = 'tls';
    $mail->Username = '';
    $mail->Password = '';

    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
     );

    $mail->setFrom('tim@example.com', 'Tim Tester');
    $mail->addAddress('mtw62528@jiooq.com', 'Testperson');

    $mail->isHTML(TRUE);
    $mail->Subject = 'TEST Datei';
    $mail->Body = '<h1>Das ist ein Test</h1>';
    $mail->AltBody = 'Alternativtext';
    //$mail->addAttachment('TEST-PDF.pdf', 'Testdatei');

    $mail->send();

}
catch (Exception $e) {
    echo $e->errorMessage();
}

?>