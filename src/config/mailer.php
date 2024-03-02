<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER;


$mail->isSMTP();
$mail->SMTPAuth = true;


$mail->Host = "smtp.mail.ru";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "hjejssdsdssdsd@mail.ru";
$mail->Password = "JHwnUkyJ7AXeFizL81xT";

$mail->isHTML(true);
