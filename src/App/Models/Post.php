<?php

namespace App\App\Models;

use App\Config\Database;
use PDOException;

class Post
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getPostById($id)
    {
        $sql = "SELECT * FROM posts WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getPosts()
    {
        $sql = "SELECT * FROM posts";
        return $this->db->getConnection()->query($sql)->fetchAll();
    }

    public function getPostsForBanner()
    {
        $sql = "SELECT posts.id, posts.title, posts.description, posts.pic, COUNT(post_likes.post_id) likes_count
                FROM posts
                LEFT JOIN post_likes ON posts.id = post_likes.post_id
                WHERE posts.status = 1
                GROUP BY posts.id, posts.title
                ORDER BY likes_count DESC
                LIMIT 10";
        return $this->db->getConnection()->query($sql)->fetchAll();
    }

    public function getHashtagsForMain()
    {
        $sql = "SELECT hashtags.id, hashtags.name, COUNT(post_likes.post_id) AS likes_count
                FROM hashtags
                LEFT JOIN post_hashtags ON hashtags.id = post_hashtags.hashtag_id
                LEFT JOIN posts ON post_hashtags.post_id = posts.id
                LEFT JOIN post_likes ON posts.id = post_likes.post_id
                GROUP BY hashtags.id
                ORDER BY likes_count DESC
                LIMIT 20";
        return $this->db->getConnection()->query($sql)->fetchAll();
    }

    public function getCategoriesForNavbar()
    {
        $sql = "SELECT * FROM categories ORDER BY categories.name asc";
        return $this->db->getConnection()->query($sql)->fetchAll();
    }

    public function createPost($title, $description, $content, $status, $category_id, $user_id, $pic, array $hashtags)
    {
        try {
            $sql = "INSERT INTO posts (title, description, content, status, category_id, user_id, pic) 
                VALUES (:title, :description, :content, :status, :category_id, :user_id, :pic)";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':pic', $pic);
            $stmt->execute();

            $postId = $this->db->getConnection()->lastInsertId();

            // Проверяем существующие хештеги и добавляем новые при необходимости
            $hashtagsIds = [];
            foreach ($hashtags as $hashtagName) {
                $sql = "SELECT id FROM hashtags WHERE name = :name";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->bindParam(':name', $hashtagName);
                $stmt->execute();
                $hashtagId = $stmt->fetchColumn();

                if (!$hashtagId) {
                    // Хештег не найден, создаем новый
                    $sql = "INSERT INTO hashtags (name) VALUES (:name)";
                    $stmt = $this->db->getConnection()->prepare($sql);
                    $stmt->bindParam(':name', $hashtagName);
                    $stmt->execute();

                    $hashtagId = $this->db->getConnection()->lastInsertId();
                }

                $hashtagsIds[] = $hashtagId;
            }

            // Вставляем хештеги для поста в таблицу post_hashtags
            foreach ($hashtagsIds as $hashtagId) {
                $sql = "INSERT INTO post_hashtags (post_id, hashtag_id) VALUES (:post_id, :hashtag_id)";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->bindParam(':post_id', $postId);
                $stmt->bindParam(':hashtag_id', $hashtagId);
                $stmt->execute();
            }

            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
