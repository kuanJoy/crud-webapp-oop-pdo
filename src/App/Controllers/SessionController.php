<?php

namespace App\App\Controllers;

use App\App\Models\Session;

class SessionController
{
    protected $sessionModel;

    public function __construct()
    {
        $this->sessionModel = new Session();
        var_dump($this->sessionModel);
        var_dump($_SESSION);
    }

    public function redirect()
    {
        if ($this->sessionModel->getStatus()) {
            header("Location: /");
            exit();
        }
    }
}
