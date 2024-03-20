<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->CharSet = "utf-8"; // set charset to utf8
$mail->SMTPAuth = true; // Enable SMTP authentication
$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted

$mail->Host = 'mail.bigidea.edu.kg'; // Specify main and backup SMTP servers
$mail->Port = 465; // TCP port to connect to
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->isHTML(true); // Set email format to HTML
$mail->Username = 'bigidea.edu.kg@bigidea.edu.kg'; // SMTP username
$mail->Password = ''; // SMTP password

$mail->setFrom('bigidea.edu.kg@bigidea.edu.kg');
$mail->addAddress($email);

$mail->isHTML(true);
