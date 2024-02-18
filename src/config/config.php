<?php

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    protected $db;

    public function __construct()
    {
        try {
            $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->db = new PDO('mysql:host=HOSTNAME;dbname=DB_NAME', 'USERNAME', 'PASSWORD', $opt);
        } catch (PDOException $e) {
            echo $e->getmessage();
        }
    }

    public function connect()
    {
        return $this->db;
    }
}
