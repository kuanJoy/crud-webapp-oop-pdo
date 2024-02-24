<?php

namespace App\App\Controllers;

use App\App\Models\Session;

class SessionController
{
    protected $sessionModel;

    public function __construct()
    {
        $this->sessionModel = new Session();
    }

    public function redirect()
    {
        if ($this->sessionModel->getStatus()) {
            header("Location: /");
            exit();
        }
    }

    public function logout()
    {
        $this->sessionModel->logout();
    }
}
