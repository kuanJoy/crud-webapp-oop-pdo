<?php

namespace App\UserController;

use App\Models\UserModel;

class UserController
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function index()
    {
        $users = $this->user->getAllUsers();
    }

    public function show($userId)
    {
        $user = $this->user->getUserById($userId);
    }
}
