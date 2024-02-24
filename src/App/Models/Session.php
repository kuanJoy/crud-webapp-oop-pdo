<?php

namespace App\App\Models;

class Session
{
    protected $status;

    public function __construct()
    {
        if (isset($_SESSION['id_user'])) {
            $this->status = true;
        } else {
            $this->status = false;
        }
    }

    public function getStatus()
    {
        return $this->status;
    }
}
