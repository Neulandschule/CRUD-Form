<?php

echo "<h1>Mail verschicken...</h1>";

$to = "name@provider.com";
$subject = "E-Mail Test";
$message = "Das ist ein Testmail!";
$from = "From: Tim Tester <Noreply@provider.com>";

if (mail($to, $subject, $message, $from)) {
    echo "E-Mail gesendet!";
} else {
    echo "Fehler beim Senden!";
};

/*
* EINSTELLUNGEN *

php.ini
--------------
SMTP=smtp.gmail.com
smtp_port=587
sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"

sendmail.ini
--------------
smtp_server=smtp.gmail.com
smtp_port=587
auth_username=xxx@gmail.com
auth_password=xxx

*/

?>

