<?php

namespace App\App\Controllers;

use App\App\Models\Password;
use App\Config\Database;

class PasswordController extends Password
{
    protected $password;

    public function __construct()
    {
        $db = new Database();
        $this->password = new Password($db);
    }

    public function sendLink()
    {
        if (isset($_POST['sendLink'])) { {
                return $this->password->sendLink();
            }
        }
    }

    public function checkToken()
    {
        if (isset($_GET['token'])) {
            return $this->password->chechToken();
        }
    }
}
