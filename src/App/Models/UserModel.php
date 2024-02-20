<?php

namespace App\Models;

use App\Config\Database;

class User
{
    protected $db;

    public function __construct()
    {
        $this->db = (new Database());
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $this->db->query($sql);
        return $result->fetch();
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
