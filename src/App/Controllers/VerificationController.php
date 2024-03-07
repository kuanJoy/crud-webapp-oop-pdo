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
}
