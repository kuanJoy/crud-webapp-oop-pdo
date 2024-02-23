<?php

namespace App\Models;

use App\Config\Database;

class Post
{
    protected $db;

    public function __construct(Database $conn)
    {
        $this->db = $conn;
    }

    public function getPostbyId($id)
    {
        $sql = "SELECT * FROM posts WHERE id = ?";
        // Чтобы выполнить такой запрос, сначала его надо подготовить с помощью функции prepare(). 
        return $this->db->getConnection()->prepare($sql)->execute($id);
    }

    public function getPosts()
    {
        $sql = "SELECT * FROM posts";
        $stmt = $this->db->getConnection()->query($sql);
        return $stmt->fetchAll();
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
