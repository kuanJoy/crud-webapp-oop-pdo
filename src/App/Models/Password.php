<?php

namespace App\App\Models;

use App\Config\Database;

class Password
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function sendLink()
    {
        if (isset($_POST['sendLink'])) {
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Неправильная почта';
            }

            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(1, $email);
            $stmt->execute();

            // etc
        }
    }
}
