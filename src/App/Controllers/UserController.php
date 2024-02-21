<?php

namespace App\UserController;

use App\Config\Database;
use App\Models\User;

class UserController
{
    protected $userModel;

    public function __construct()
    {
        $db = new Database();
        $this->userModel = new User($db);
    }

    public function index()
    {
        $users = $this->userModel->getUsers();
    }
}
