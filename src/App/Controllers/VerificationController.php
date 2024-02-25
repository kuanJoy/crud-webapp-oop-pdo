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

    // Перенаправление если ЕМЕЙЛ НЕ подтвержден
    public function redirectToVerifyEmail()
    {
        $this->verification->redirectToVerifyEmail();
    }

    public function verifyEmailToken()
    {
        $db = new Database();
        return $this->verification->verifyEmailToken($db);
    }
}
