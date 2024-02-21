<?php

namespace App\PostController;

use App\Models\Post;
use App\Config\Database;

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
        $posts = $this->postModel->getPosts();
    }
}
