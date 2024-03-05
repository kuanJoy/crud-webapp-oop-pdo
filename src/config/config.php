<?php

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    protected $conn;

    public function __construct()
    {
        try {
            $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->conn = new PDO('mysql:host=localhost;dbname=bigidea', 'root', '', $opt);
        } catch (PDOException $e) {
            echo $e->getmessage();
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
