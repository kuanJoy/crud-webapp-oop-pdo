<?php

namespace App\App\Controllers;

use App\Config\Database;
use App\App\Models\Password;

class PasswordController
{
    protected $password;

    public function __construct()
    {
        $db = new Database();
        $this->password = new Password($db);
    }

    public function sendLink()
    {
        if (isset($_POST['sendLink'])) {
            return $this->password->sendLink();
        }
    }

    public function checkToken()
    {
        if (isset($_GET['token'])) {
            return $this->password->checkToken();
        }
    }

    public function resetPassword()
    {
        if (isset($_POST['resetPass'])) {
            return $this->password->resetPassword();
        }
    }
}
