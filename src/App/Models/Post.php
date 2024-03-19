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

    // ================= ЛАЙКИ / LIKES  =================

    public function sendLike($postId, $userId)
    {
        $sql = "SELECT COUNT(*) FROM post_likes WHERE post_id = :post_id AND user_id = :user_id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':post_id', $postId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            $sql = "INSERT INTO post_likes (post_id, user_id) VALUES (:post_id, :user_id)";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':post_id', $postId);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
        }
    }

    public function deleteLike($postId, $userId)
    {
        try {
            $sql = "DELETE FROM post_likes WHERE post_id = :post_id AND user_id = :user_id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':post_id', $postId);
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // ================= ПОСТЫ / POSTS  =================

    public function createPost($title, $description, $content, $status, $category_id, $user_id, $pic, array $hashtags)
    {
        try {
            $sql = "INSERT INTO posts (title, description, content, status, category_id, user_id, pic, created_at, updated_at) 
            VALUES (:title, :description, :content, :status, :category_id, :user_id, :pic, NOW(), NOW())";
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

    public function deletePost($id, $pic)
    {
        $id = intval($id);
        if ($id <= 0) {
            return false;
        }

        try {
            $this->db->getConnection()->beginTransaction();

            $this->db->getConnection()->exec('SET FOREIGN_KEY_CHECKS=0');

            $sql = "DELETE FROM post_likes WHERE post_id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $sql = "DELETE FROM posts WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $tables = ['post_hashtags'];
            foreach ($tables as $table) {
                $sql = "DELETE FROM $table WHERE post_id = :id";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
            }

            $this->db->getConnection()->exec('SET FOREIGN_KEY_CHECKS=1');

            $this->db->getConnection()->commit();

            if (file_exists($pic) && $pic !== './assets/images/upload/default_pic.jpg') {
                unlink($pic);
            }

            return true;
        } catch (PDOException $e) {
            $this->db->getConnection()->rollBack();
            error_log("Error deleting post: " . $e->getMessage());
            return false;
        }
    }

    public function updatePost($postId, $title, $description, $categoryId, $content, $status, $pic, $hashtags, $createdTime)
    {
        try {
            $this->db->getConnection()->beginTransaction();

            $this->db->getConnection()->exec('SET FOREIGN_KEY_CHECKS=0');

            $sql = "UPDATE posts SET title = :title, description = :description, category_id = :category_id, content = :content, status = :status, pic = :pic, updated_at = :updated_at WHERE id = :post_id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':post_id', $postId);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':category_id', $categoryId);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':pic', $pic);
            $updated_at = date('Y-m-d H:i:s');
            $stmt->bindParam(':updated_at', $updated_at);
            $stmt->execute();

            $sql = "DELETE FROM post_hashtags WHERE post_id = :post_id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':post_id', $postId);
            $stmt->execute();

            foreach ($hashtags as $hashtagName) {
                $sql = "SELECT id FROM hashtags WHERE name = :hashtag_name";
                $stmt = $this->db->getConnection()->prepare($sql);
                $stmt->bindParam(':hashtag_name', $hashtagName);
                $stmt->execute();
                $hashtagId = $stmt->fetchColumn();

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
        $sql = "SELECT posts.*, DATE_FORMAT(posts.created_at, '%d.%m.%y') AS posts_time, categories.name AS category_name, users.username, users.id
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
        $sql = "SELECT 
                    p.id AS post_id,
                    p.title,
                    p.user_id,
                    p.pic,
                    DATE_FORMAT(p.created_at, '%d.%m.%Y %H:%i:%s') AS created_time,
                    COUNT(pl.post_id) AS like_count,
                    u.username AS user_nickname
                FROM 
                    posts p
                LEFT JOIN 
                    post_likes pl ON p.id = pl.post_id
                LEFT JOIN 
                    users u ON p.user_id = u.id
                GROUP BY 
                    p.id
                ORDER BY 
                    RAND()
                LIMIT 3";
        return $this->db->getConnection()->query($sql)->fetchAll();
    }

    public function getFavouritePosts($id)
    {
        $sql = "SELECT 
                    ps.post_id,
                    ps.user_id,
                    p.id,
                    p.title,
                    p.pic,
                    u.username,
                    DATE_FORMAT(p.created_at, '%d.%m.%Y %H:%i:%s') AS created_time,
                    COUNT(pl.post_id) AS like_count
                FROM 
                    post_likes AS ps
                INNER JOIN 
                    posts AS p ON ps.post_id = p.id
                INNER JOIN 
                    users AS u ON ps.user_id = u.id
                LEFT JOIN 
                    post_likes AS pl ON p.id = pl.post_id
                WHERE 
                    ps.user_id = :user_id
                GROUP BY 
                    ps.post_id, ps.user_id, p.id, p.title, p.pic, u.username, created_time";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(":user_id", $id);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getUserPosts($id)
    {
        $sql = "SELECT 
                p.id AS post_id,
                p.title,
                p.user_id,
                p.pic,
                c.name,
                DATE_FORMAT(p.created_at, '%d.%m.%Y %H:%i:%s') AS created_time,
                COUNT(pl.post_id) AS like_count,
                u.username AS user_nickname
            FROM 
                posts p
            LEFT JOIN 
                post_likes pl ON p.id = pl.post_id
            LEFT JOIN 
                users u ON p.user_id = u.id
            LEFT JOIN 
                categories c ON p.category_id = c.id
            WHERE p.user_id = :user_id
            GROUP BY 
                p.id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(":user_id", $id);
        $stmt->execute();

        return $stmt->fetchAll();
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

    public function getUserLikeOnPost($userId, $postId)
    {
        $sql = "SELECT * FROM post_likes WHERE user_id = :user_id AND post_id = :post_id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':post_id', $postId);
        $stmt->execute();

        if ($stmt->fetch()) {
            return "liked";
        } else {
            return "not-liked";
        }
    }

    public function getPosts()
    {
        $sql = "SELECT * FROM posts";
        return $this->db->getConnection()->query($sql)->fetchAll();
    }

    public function getPostsByCategory($id)
    {
        $sql = "SELECT 
                p.id AS post_id,
                p.title,
                p.user_id,
                p.pic,
                c.name,
                DATE_FORMAT(p.created_at, '%d.%m.%Y %H:%i:%s') AS created_time,
                COUNT(pl.post_id) AS like_count,
                u.username AS user_nickname
            FROM 
                posts p
            LEFT JOIN 
                post_likes pl ON p.id = pl.post_id
            LEFT JOIN 
                users u ON p.user_id = u.id
            LEFT JOIN 
                categories c ON p.category_id = c.id
            WHERE 
                p.category_id = :category_id
            GROUP BY 
                p.id;
";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':category_id', $id);
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



    // =================== КАТЕГОРИИ / CATEGORIES ===================

    public function createCategory($name, $status)
    {
        $sql = "INSERT INTO categories (name, status) VALUES (:name, :status)";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':status', $status);

        try {
            if ($stmt->execute()) {
                return "Категория успешно добавлена";
            }
        } catch (\PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                // 1062 это ошибка что ключ имеется
                return "Категория уже существует";
            } else {
                return "Произошла ошибка при выполнении запроса";
            }
        }
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

    public function getPostsByHashtag($hashtagName)
    {
        $sql = "SELECT DISTINCT posts.id, posts.title, posts.description, posts.pic, hashtags.name FROM posts 
                INNER JOIN post_hashtags ON posts.id = post_hashtags.post_id 
                INNER JOIN hashtags ON post_hashtags.hashtag_id = hashtags.id 
                WHERE hashtags.name = :hashtag_name";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':hashtag_name', $hashtagName);
        $stmt->execute();

        return $stmt->fetchAll();
    }


    // =================== ХЕШТЕГИ / HASHTAGS ===================

    public function getHashtagsCount()
    {
        $sql = "SELECT h.name AS hashtag, COUNT(ph.post_id) AS count
                FROM hashtags h
                LEFT JOIN post_hashtags ph ON h.id = ph.hashtag_id
                GROUP BY h.id
                HAVING hashtag != ''
                ORDER BY count DESC
                LIMIT 5;";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getHashtagsForMain()
    {
        $sql = "SELECT hashtags.id, hashtags.name, COUNT(post_likes.post_id) AS likes_count
                FROM hashtags
                LEFT JOIN post_hashtags ON hashtags.id = post_hashtags.hashtag_id
                LEFT JOIN posts ON post_hashtags.post_id = posts.id
                LEFT JOIN post_likes ON posts.id = post_likes.post_id
                WHERE hashtags.name IS NOT NULL AND hashtags.name != ''
                GROUP BY hashtags.id
                ORDER BY likes_count DESC
                LIMIT 20";
        return $this->db->getConnection()->query($sql)->fetchAll();
    }

    // =================== КАТЕГОРИИ / CATEGORIES ===================

    public function getCategoriesForNavbar()
    {
        $sql = "SELECT * FROM categories";
        return $this->db->getConnection()->query($sql)->fetchAll();
    }



    // =================== АДМИНКА / ADMIN PANEL ===================
    public function getPostsTable()
    {
        $sql = "SELECT posts.*, DATE_FORMAT(posts.created_at, '%d.%m.%y') as create_time, users.username, users.id as user_id FROM posts INNER JOIN users ON posts.user_id = users.id";
        return $this->db->getConnection()->query($sql)->fetchAll();
    }

    public function getUsersTable()
    {
        $sql = "SELECT users.id, users.username, users.email, users.role, DATE_FORMAT(users.created_at, '%d.%m.%y') as create_time FROM users";
        return $this->db->getConnection()->query($sql)->fetchAll();
    }

    public function getCatTable()
    {
        $sql = "SELECT * FROM categories";
        return $this->db->getConnection()->query($sql)->fetchAll();
    }


    // ====================== EDIT / UPDATE FOR ADMIN ======================

    public function getCatForEdit($id)
    {
        $sql = "SELECT * FROM categories WHERE categories.id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getUserForEdit($id)
    {
        $sql = "SELECT users.id, users.username, users.role FROM users WHERE users.id = :id";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function updateCat($id, $name, $status)
    {
        try {
            $this->db->getConnection()->exec('SET FOREIGN_KEY_CHECKS=0');

            $sql = "UPDATE categories
                SET name = :name, status = :status
                WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':status', $status);
            $stmt->execute();
            $this->db->getConnection()->exec('SET FOREIGN_KEY_CHECKS=1');
        } catch (PDOException $e) {
            $this->db->getConnection()->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function updateUser($id, $role)
    {
        try {
            $this->db->getConnection()->exec('SET FOREIGN_KEY_CHECKS=0');
            $sql = "UPDATE users
                    SET role = :role
                    WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':role', $role);
            $stmt->execute();
            $this->db->getConnection()->exec('SET FOREIGN_KEY_CHECKS=1');
        } catch (PDOException $e) {
            $this->db->getConnection()->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
