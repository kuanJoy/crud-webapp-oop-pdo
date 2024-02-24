<?php

namespace App\Controllers;

use App\Config\Database;
use App\Models\Auth;

class AuthController
{
    protected $authModel;

    public function __construct()
    {
        $db = new Database();
        $this->authModel = new Auth($db);
    }

    public function login($emailOrNickname, $password)
    {
        $this->authModel->authenticate($emailOrNickname, $password);
    }

    public function regUser()
    {
        $this->authModel->register();
    }
}
