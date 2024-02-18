-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.51-log - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных edu
CREATE DATABASE IF NOT EXISTS `edu` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `edu`;

-- Дамп структуры для таблица edu.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Дамп данных таблицы edu.categories: ~0 rows (приблизительно)

-- Дамп структуры для таблица edu.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `post_id` int(255) DEFAULT '0',
  `user_id` int(255) DEFAULT '0',
  `content` text,
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_comments_post_id` (`post_id`),
  KEY `fk_comments_user_id` (`user_id`),
  CONSTRAINT `fk_comments_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Дамп данных таблицы edu.comments: ~0 rows (приблизительно)

-- Дамп структуры для таблица edu.hashtags
CREATE TABLE IF NOT EXISTS `hashtags` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `name` int(70) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Дамп данных таблицы edu.hashtags: ~0 rows (приблизительно)

-- Дамп структуры для таблица edu.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(70) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `content` text,
  `status` enum('активен','скрыт') DEFAULT NULL,
  `category_id` int(255) DEFAULT NULL,
  `user_id` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_posts_category_id` (`category_id`),
  KEY `fk_posts_user_id` (`user_id`),
  CONSTRAINT `fk_posts_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_posts_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Дамп данных таблицы edu.posts: ~0 rows (приблизительно)

-- Дамп структуры для таблица edu.post_hashtags
CREATE TABLE IF NOT EXISTS `post_hashtags` (
  `post_id` int(255) DEFAULT NULL,
  `hashtag_id` int(255) DEFAULT NULL,
  KEY `fk_post_hashtags_post_id` (`post_id`),
  KEY `fk_post_hashtags_hashtag_id` (`hashtag_id`),
  CONSTRAINT `fk_post_hashtags_hashtag_id` FOREIGN KEY (`hashtag_id`) REFERENCES `hashtags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_hashtags_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Дамп данных таблицы edu.post_hashtags: ~0 rows (приблизительно)

-- Дамп структуры для таблица edu.post_likes
CREATE TABLE IF NOT EXISTS `post_likes` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `post_id` int(255) DEFAULT '0',
  `user_id` int(255) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_post_likes_post_id` (`post_id`),
  KEY `fk_post_likes_user_id` (`user_id`),
  CONSTRAINT `fk_post_likes_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_likes_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Дамп данных таблицы edu.post_likes: ~0 rows (приблизительно)

-- Дамп структуры для таблица edu.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('админ','модератор','читатель') DEFAULT 'читатель',
  `remember_token` varchar(100) DEFAULT NULL,
  `password_reset_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `unique_email` (`email`),
  UNIQUE KEY `unique_username` (`username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Дамп данных таблицы edu.users: ~0 rows (приблизительно)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
