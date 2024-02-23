<?php

namespace App\Models;

use App\Config\Database;

class Auth
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function register()
    {
        $sql = "INSERT INTO users('')"
    }

    public function authenticate($emailOrUsername, $password)
    {
        $sql = "SELECT * FROM users WHERE id = :email OR username = :username";
        $stmt = $this->db->getConnection()->prepare($sql);

        $stmt->execute([
            ":email" => $emailOrUsername,
            ":username" => $emailOrUsername
        ]);

        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSON['id_user'] = $user['id'];
                $_SESSON['username'] = $user['username'];
                $_SESSON['email'] = $user['email'];
                return true;
            } else {
                $_POST['error_login'] = "Неверный пароль";
                return false;
            }
        } else {
            $_POST['error_login'] = "Пользователь не найден";
            return false;
        }
    }
}
