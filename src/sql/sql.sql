-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.51 - MySQL Community Server (GPL)
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


-- Дамп структуры базы данных bigidea
CREATE DATABASE IF NOT EXISTS `bigidea` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `bigidea`;

-- Дамп структуры для таблица bigidea.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Дамп данных таблицы bigidea.categories: ~4 rows (приблизительно)
INSERT INTO `categories` (`id`, `name`) VALUES
	(1, 'История'),
	(2, 'География'),
	(3, 'Биология'),
	(4, 'Экономика');

-- Дамп структуры для таблица bigidea.comments
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

-- Дамп данных таблицы bigidea.comments: ~0 rows (приблизительно)

-- Дамп структуры для таблица bigidea.hashtags
CREATE TABLE IF NOT EXISTS `hashtags` (
  `id` int(250) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Дамп данных таблицы bigidea.hashtags: ~6 rows (приблизительно)
INSERT INTO `hashtags` (`id`, `name`) VALUES
	(1, 'воины'),
	(2, 'микробы'),
	(3, 'реки'),
	(4, 'мореплавание'),
	(5, 'путешественники'),
	(6, 'деньги');

-- Дамп структуры для таблица bigidea.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(70) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `content` text,
  `status` enum('активен','скрыт') DEFAULT NULL,
  `category_id` int(255) DEFAULT NULL,
  `user_id` int(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `fk_posts_category_id` (`category_id`),
  KEY `fk_posts_user_id` (`user_id`),
  CONSTRAINT `fk_posts_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_posts_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Дамп данных таблицы bigidea.posts: ~3 rows (приблизительно)
INSERT INTO `posts` (`id`, `title`, `description`, `content`, `status`, `category_id`, `user_id`, `pic`) VALUES
	(1, 'СТАТЬЯ 1', 'ОПИСАНИЕ КРАТКОЕ', 'СОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕ', 'активен', 1, 8, 'public/assets/images/upload/default_pic.jpg'),
	(2, 'СТАТЬЯ 2', 'Описание 2 2 2 2 2', 'СОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕ', 'активен', 2, 8, 'public/assets/images/upload/default_pic.jpg'),
	(3, 'СТАТЬЯ 3', 'ОПИСАНИЕ 33333333333', 'СОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕСОДЕРЖИМОЕ', 'активен', NULL, NULL, 'public/assets/images/upload/default_pic.jpg');

-- Дамп структуры для таблица bigidea.post_hashtags
CREATE TABLE IF NOT EXISTS `post_hashtags` (
  `post_id` int(255) DEFAULT NULL,
  `hashtag_id` int(255) DEFAULT NULL,
  KEY `fk_post_hashtags_post_id` (`post_id`),
  KEY `fk_post_hashtags_hashtag_id` (`hashtag_id`),
  CONSTRAINT `fk_post_hashtags_hashtag_id` FOREIGN KEY (`hashtag_id`) REFERENCES `hashtags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_hashtags_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Дамп данных таблицы bigidea.post_hashtags: ~5 rows (приблизительно)
INSERT INTO `post_hashtags` (`post_id`, `hashtag_id`) VALUES
	(1, 6),
	(1, 2),
	(1, 3),
	(2, 1),
	(2, 5);

-- Дамп структуры для таблица bigidea.post_likes
CREATE TABLE IF NOT EXISTS `post_likes` (
  `post_id` int(255) DEFAULT '0',
  `user_id` int(255) DEFAULT '0',
  KEY `fk_post_likes_post_id` (`post_id`),
  KEY `fk_post_likes_user_id` (`user_id`),
  CONSTRAINT `fk_post_likes_post_id` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_likes_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Дамп данных таблицы bigidea.post_likes: ~8 rows (приблизительно)
INSERT INTO `post_likes` (`post_id`, `user_id`) VALUES
	(1, 8),
	(1, 11),
	(1, 12),
	(1, 13),
	(2, 14),
	(2, 8),
	(2, 13),
	(2, 11);

-- Дамп структуры для таблица bigidea.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('админ','модератор','читатель') DEFAULT 'читатель',
  `remember_token` varchar(100) DEFAULT NULL,
  `password_reset_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `verified` enum('false','true') DEFAULT 'false',
  `token` varchar(50) DEFAULT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `unique_email` (`email`),
  UNIQUE KEY `unique_username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Дамп данных таблицы bigidea.users: ~6 rows (приблизительно)
INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `remember_token`, `password_reset_at`, `created_at`, `verified`, `token`, `reset_token_hash`, `reset_token_expires_at`) VALUES
	(8, 'kuanJoy', 'kuanishmykyev@mail.ru', '$2y$10$JgH52ukM9JNVRQe7tg/Bzei9ze6Mo0DqYn6rM9DhyusfPhR/YbqKm', 'админ', NULL, NULL, '2024-02-25 09:09:55', 'true', '5433', 'bc32c0fe1adbd9c8aa66c2712d4e408903b048b2d8300d08253795289020a0b9', '2024-03-06 17:11:58'),
	(11, 'dsada', 'wowcool2001@mail.ru', '$2y$10$v7sASMZ0aSlHEdhlOv/GA.cF.am7/eJqjt0Xz7GE.hxr5yodQ.DGC', 'читатель', NULL, '2024-03-07 16:31:14', '2024-03-06 15:13:03', 'true', '2115', NULL, NULL),
	(12, 'test1', NULL, '123', 'читатель', NULL, NULL, '2024-03-09 06:28:05', 'false', NULL, NULL, NULL),
	(13, 'test2', NULL, '123', 'читатель', NULL, NULL, '2024-03-09 06:28:10', 'false', NULL, NULL, NULL),
	(14, 'test3', NULL, '123', 'читатель', NULL, NULL, '2024-03-09 06:28:22', 'false', NULL, NULL, NULL),
	(15, 'ывфвфвф', 'wowcool2000@mail.ru', '$2y$10$iB/9X9p6e3UJS9mUqPUG4.odRgolnDTQ0YxT9kSPceXu74THbkedC', 'читатель', NULL, NULL, '2024-03-09 09:07:07', 'true', '89494', NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
