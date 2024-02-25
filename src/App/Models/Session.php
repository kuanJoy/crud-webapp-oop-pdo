<?php

namespace App\App\Models;

class Session
{
    public function logout()
    {
        if (isset($_POST['logout'])) {
            session_destroy();
            header("Location: /");
            exit;
        }
    }
}
