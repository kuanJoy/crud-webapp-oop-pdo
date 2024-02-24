<?php

namespace App\App\Controllers;

use App\Config\Database;
use App\App\Models\Auth;

class SessionController
{
    protected $sessionModel;

    public function __construct()
    {
        $db = new Database();
        $this->sessionModel = new Auth($db);
    }

    public function login()
    {
        return $this->sessionModel->authenticate();
    }

    public function regUser()
    {
        return $this->sessionModel->register();
    }
}
