<?php

namespace App\App\Controllers;

use App\App\Models\Session;

class SessionController extends Session
{
    protected $sessionModel;

    public function __construct()
    {
        $this->sessionModel = new Session();
    }

    public function logout()
    {
        $this->sessionModel->logout();
    }
}
