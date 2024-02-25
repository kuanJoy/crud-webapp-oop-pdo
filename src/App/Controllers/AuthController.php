<?php

namespace App\App\Controllers;

use App\Config\Database;
use App\App\Models\Auth;

class AuthController
{
    protected $authModel;

    public function __construct()
    {
        $db = new Database();
        $this->authModel = new Auth($db);
    }

    // ЛОГИН
    public function login()
    {
        return $this->authModel->login();
    }

    // РЕГИСТРАЦИЯ
    public function register()
    {
        return $this->authModel->register();
    }
}
