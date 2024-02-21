<?php

namespace App\AuthController;

use App\Models\Auth;
use App\Config\Database;


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
}
