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
        if (isset($_SESSION['id_user']) && $_SESSION['verified'] == "false") {
            header("Location: /verify");
        }
    }

    public function verifyEmailToken()
    {
        $db = new Database();
        return $this->verification->verifyEmailToken($db);
    }
}
