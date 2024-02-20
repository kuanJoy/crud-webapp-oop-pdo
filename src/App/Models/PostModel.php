<?php

namespace App\Models;

use App\Config\Database;

class Post
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getById()
    {
    }

    public function addPost()
    {
    }

    public function readPosts()
    {
    }

    public function readPost()
    {
    }

    public function editPost()
    {
    }

    public function deletePost()
    {
    }
}
