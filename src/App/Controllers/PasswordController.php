<?php

namespace App\App\Controllers;

use App\App\Models\Password;

class PasswordController extends Password
{
    protected $password;

    public function __construct()
    {
        $this->password = new Password();
    }

    public function sendLink()
    {
        return $this->password->sendLink();
    }
}
