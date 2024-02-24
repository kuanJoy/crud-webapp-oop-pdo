<?php

namespace App\App\Models;

use App\Config\Database;
use PDOException;


class Session
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }
}
