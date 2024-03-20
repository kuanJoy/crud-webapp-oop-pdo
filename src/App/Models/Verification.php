<?php

namespace App\App\Models;

use App\Config\Database;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Verification
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function redirectIfNotAdmin()
    {
        if ($_SESSION['role'] !== "админ" && $_SESSION['role'] !== "модератор") {
            header("Location: / ");
        }
    }

    // Перенаправление если Email не подтвержден
    public function redirectToVerifyEmail()
    {
        if (isset($_SESSION['id_user']) && $_SESSION['verified'] === 'false') {
            header("Location: /verify");
        }
    }

    // Перенаправление если Гость
    public function redirectGuest()
    {
        if (empty($_SESSION)) {
            header("Location: /");
        }
    }

    // Перенаправление если Юзер
    public function redirectUser()
    {
        if (isset($_SESSION['id_user']) && $_SESSION['verified'] === 'true') {
            header("Location: /");
        }
    }

    // Подтверждение токена в verify.php
    public function verifyEmailToken()
    {
        if (isset($_POST['checkToken'])) {
            if ($_SESSION['token'] == $_POST['token']) {
                $sql = "UPDATE users SET verified = 'true' WHERE id = :id_user";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->bindParam(':id_user', $_SESSION['id_user']);
                $stmt->execute();
                $_SESSION['verified'] = 'true';
                header("Location: /");
                exit;
            } else {
                $error = "Неверный код";
                return $error;
            }
        }
    }

    public function sendToken()
    {
        $errors = [];
        $token = $_SESSION['token'];
        $mail = new PHPMailer(true);

        $mail->CharSet = "utf-8"; // set charset to utf8
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted

        $mail->Host = 'mail.bigidea.edu.kg'; // Specify main and backup SMTP servers
        $mail->Port = 465; // TCP port to connect to
        $mail->Username = 'bigidea.edu.kg@bigidea.edu.kg'; // SMTP username
        $mail->Password = ''; // SMTP password
        $mail->setFrom('bigidea.edu.kg@bigidea.edu.kg');

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->isHTML(true); // Set email format to HTML

        $mail->addAddress($_SESSION['email']);
        $mail->isHTML(true);
        $mail->Subject = 'Регистрация Big.Idea';
        $mail->Body    = <<<END
                        
<h1>Ваш код подтверждения $token </h1>

END;
        $mail->send();
        $errors['success'] = 'На Вашу почту был повторно выслан код';
        return $errors;
    }
}
