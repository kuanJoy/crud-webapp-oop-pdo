<?php

namespace App\App\Models;

use App\Config\Database;

class Verification
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function redirectToVerifyEmail()
    {
        if (isset($_SESSION['id_user']) && $_SESSION['verified'] == "false") {
            header("Location: /verify");
        }
    }

    public function redirectGuest()
    {
        if (empty($_SESSION)) {
            header("Location: /");
        }
    }

    public function redirectUser()
    {
        if (isset($_SESSION['id_user']) && $_SESSION['verified'] == "true") {
            header("Location: /");
        }
    }

    public function verifyEmailToken()
    {
        if (isset($_POST['checkToken'])) {
            if ($_SESSION['token'] == $_POST['token']) {
                $sql = "UPDATE users SET verified = 'true' WHERE id = :id_user";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->bindParam(':id_user', $_SESSION['id_user']);
                $stmt->execute();
                $_SESSION['verified'] = 'true';
                header("Location: /");
                exit;
            } else {
                $error = "Неверный код";
                return $error;
            }
        }
    }
}
