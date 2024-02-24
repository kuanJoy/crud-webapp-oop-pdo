<?php

namespace App\Controllers;

use App\Config\Database;
use App\Models\Post;

class PostController
{
    protected $postModel;

    public function __construct()
    {
        $db = new Database();
        $this->postModel = new Post($db);
    }

    public function index()
    {
        return $this->postModel->getPosts();
    }
}
