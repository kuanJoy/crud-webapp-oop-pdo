<?php

namespace App\App\Controllers;

use App\App\Models\Verification;
use App\Config\Database;


class VerificationController
{
    protected $verification;

    public function __construct()
    {
        $this->verification = new Verification();
    }

    public function redirectIfNotAdmin()
    {
        $this->verification->redirectIfNotAdmin();
    }

    // Перенаправление если Email не подтвержден
    public function redirectToVerifyEmail()
    {
        $this->verification->redirectToVerifyEmail();
    }

    // Перенаправление если Гость
    public function redirectGuest()
    {
        $this->verification->redirectGuest();
    }

    // Перенаправление если Юзер
    public function redirectUser()
    {
        $this->verification->redirectUser();
    }

    public function redirectIfNoToken()
    {
        if (empty($_GET['token'])) {
            $this->verification->redirectToVerifyEmail();
            $this->verification->redirectGuest();
            $this->verification->redirectUser();
        }
    }

    // Подтверждение токена в verify.php
    public function verifyEmailToken()
    {
        $db = new Database();
        return $this->verification->verifyEmailToken($db);
    }

    public function sendToken()
    {
        if (isset($_POST['sendToken'])) {
            if (!isset($_SESSION['last_token_send']) || (time() - $_SESSION['last_token_send']) > 120) {
                $_SESSION['last_token_send'] = time();
                return $this->verification->sendToken();
            } else {
                return ['error' => "Подождите 2 минуты перед отправкой нового пароля"];
            }
        }
    }
}
