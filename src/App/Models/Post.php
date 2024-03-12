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

    public function deletePost($id, $pic)
    {
        $id = intval($id);
        try {
            $this->db->getConnection()->beginTransaction();

            $this->db->getConnection()->exec('SET FOREIGN_KEY_CHECKS=0');

            $sql = "DELETE FROM posts WHERE posts.id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $tables = ['post_hashtags', 'post_likes'];

            foreach ($tables as $table) {
                $sql = "DELETE FROM $table WHERE post_id = :id";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
            }

            $this->db->getConnection()->exec('SET FOREIGN_KEY_CHECKS=1');

            $this->db->getConnection()->commit();

            if (file_exists($pic)) {
                if ($pic !== './
                            assets/images/upload/default_pic.jpg') {
                    unlink($pic);
                }
            }

            return true;
        } catch (PDOException $e) {
            $this->db->getConnection()->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function updatePost($postId, $title, $description, $categoryId, $content, $status, $pic, $hashtags)
    {
        try {
            $this->db->getConnection()->beginTransaction();

            $this->db->getConnection()->exec('SET FOREIGN_KEY_CHECKS=0');

            $sql = "UPDATE posts SET title = :title, description = :description, category_id = :category_id, content = :content, status = :status, pic = :pic WHERE id = :post_id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':post_id', $postId);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':category_id', $categoryId);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':pic', $pic);
            $stmt->execute();

            $sql = "DELETE FROM post_hashtags WHERE post_id = :post_id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':post_id', $postId);
            $stmt->execute();

            // Добавление новых хештегов для этого поста
            foreach ($hashtags as $hashtagName) {
                // Проверяем существует ли хештег с таким именем
                $sql = "SELECT id FROM hashtags WHERE name = :hashtag_name";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->bindParam(':hashtag_name', $hashtagName);
                $stmt->execute();
                $hashtagId = $stmt->fetchColumn();

                // Если хештег существует, вставляем его id в таблицу post_hashtags
                if ($hashtagId) {
                    $sql = "INSERT INTO post_hashtags (post_id, hashtag_id) VALUES (:post_id, :hashtag_id)";
                    $stmt = $this->db->getConnection()->prepare($sql);
                    $stmt->bindParam(':post_id', $postId);
                    $stmt->bindParam(':hashtag_id', $hashtagId);
                    $stmt->execute();
                }
            }

            $this->db->getConnection()->exec('SET FOREIGN_KEY_CHECKS=1');

            $this->db->getConnection()->commit();

            return true;
        } catch (PDOException $e) {
            $this->db->getConnection()->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    public function getPostById($id)
    {
        $sql = "SELECT posts.*, categories.name AS category_name, users.username, users.id
        FROM posts 
        LEFT JOIN categories ON posts.category_id = categories.id 
        LEFT JOIN users ON posts.user_id = users.id
        WHERE posts.id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getRandomPosts()
    {
        $sql = "SELECT * FROM `posts` ORDER BY RAND() LIMIT 3;";
        return $this->db->getConnection()->query($sql)->fetchAll();
    }

    public function getPostHashtags($id)
    {
        $sql = "SELECT hashtags.name 
            FROM hashtags 
            INNER JOIN post_hashtags ON hashtags.id = post_hashtags.hashtag_id 
            WHERE post_hashtags.post_id = :post_id";

        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':post_id', $id);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getPostLikesCount($id)
    {
        $sql = "SELECT posts.id, COUNT(post_likes.post_id) AS likes_count
                FROM posts
                LEFT JOIN post_likes ON posts.id = post_likes.post_id
                WHERE posts.id = :post_id
                GROUP BY posts.id;
                ";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':post_id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getPosts()
    {
        $sql = "SELECT * FROM posts";
        return $this->db->getConnection()->query($sql)->fetchAll();
    }

    public function getCategoriesCount()
    {
        $sql = "SELECT categories.id AS category_id,
                    categories.name AS category_name,
                    COUNT(posts.id) AS post_count
                FROM categories
                LEFT JOIN posts ON categories.id = posts.category_id
                WHERE posts.status = 'активен'
                GROUP BY categories.id, categories.name;";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getPostsByCategory($id)
    {
        $sql = "SELECT posts.*, 
                categories.name AS category_name,
                GROUP_CONCAT(hashtags.name) AS hashtags
            FROM 
                posts 
            LEFT JOIN 
                categories ON posts.category_id = categories.id 
            LEFT JOIN 
                post_hashtags ON posts.id = post_hashtags.post_id
            LEFT JOIN 
                hashtags ON post_hashtags.hashtag_id = hashtags.id
            WHERE 
                posts.category_id = :id
            GROUP BY 
                posts.id;";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll();
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
        $sql = "SELECT c.id, c.name
                FROM categories c
                JOIN posts p ON c.id = p.category_id
                GROUP BY c.id, c.name
                HAVING COUNT(p.id) > 0;";
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
