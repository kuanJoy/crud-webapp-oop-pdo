<?php

namespace App\Models;

use App\Config\Database;

class UserModel
{
    protected $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function register()
    {
    }

    public function login()
    {
    }

    public function logout()
    {
    }

    public function changePassword()
    {
    }

    public function showUser()
    {
    }

    public function editUser()
    {
    }

    public function deleteUser()
    {
    }

    public function getAllUsers()
    {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }
}
