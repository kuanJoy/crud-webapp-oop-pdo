<?php

namespace App\Models;

use App\Config\Database;

class User
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->getConnection()->query($sql);
        return $stmt->fetchAll();
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
}
