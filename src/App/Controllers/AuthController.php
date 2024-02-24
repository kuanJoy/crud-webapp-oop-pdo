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

    public function login()
    {
        return $this->authModel->login();
    }

    public function regUser()
    {
        return $this->authModel->register();
    }
}
