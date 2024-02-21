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

    public function getPostbyId($id)
    {
        $sql = "SELECT * FROM posts WHERE id = ?";
        // Чтобы выполнить такой запрос, сначала его надо подготовить с помощью функции prepare(). 
        $stmt = $this->db->getConnection()->prepare($sql);
        return $stmt->execute($id);
    }

    public function getPosts()
    {
    }

    public function getById()
    {
    }

    public function addPost()
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
