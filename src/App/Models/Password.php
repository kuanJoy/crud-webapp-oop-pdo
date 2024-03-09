<?php

namespace App\App\Models;

use App\Config\Database;
use PDOException;

class Password
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function findUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateResetToken($email, $token_hash, $expire)
    {
        $sql = "UPDATE users SET reset_token_hash = :token_hash, reset_token_expires_at = :expire WHERE email = :email";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':token_hash', $token_hash);
        $stmt->bindParam(':expire', $expire);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function findUserByResetToken($token)
    {
        $sql = "SELECT * FROM users WHERE reset_token_hash = :reset_token_hash";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':reset_token_hash', hash("sha256", $token));
        $stmt->execute();
        return $stmt->fetch();
    }

    public function resetUserPassword($user_id, $hashedPass)
    {
        $sql = "UPDATE users SET password = :hashedPass, 
                password_reset_at = :password_reset_at, 
                reset_token_hash = NULL, 
                reset_token_expires_at = NULL
                WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(":hashedPass", $hashedPass);
        $stmt->bindParam(":password_reset_at", date("Y-m-d H:i:s"));
        $stmt->bindParam(":id", $user_id);
        return $stmt->execute();
    }
}
