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

-- Дамп данных таблицы bigidea.categories: ~7 rows (приблизительно)
INSERT INTO `categories` (`id`, `name`, `status`) VALUES
	(1, 'История', 'активен'),
	(2, 'География', 'активен'),
	(3, 'Биология', 'скрыт'),
	(4, 'Экономика', 'скрыт'),
	(5, 'Математика', 'скрыт'),
	(6, 'Психология', 'скрыт'),
	(7, 'Искусство', 'скрыт'),
	(8, 'wewq', 'удален'),
	(9, 'Архитектура', 'скрыт'),
	(10, 'Генетика', 'скрыт'),
	(12, 'Физика', 'скрыт'),
	(13, 'Философия', 'скрыт');

-- Дамп данных таблицы bigidea.comments: ~0 rows (приблизительно)

-- Дамп данных таблицы bigidea.hashtags: ~1 rows (приблизительно)
INSERT INTO `hashtags` (`id`, `name`) VALUES
	(51, '');

-- Дамп данных таблицы bigidea.posts: ~0 rows (приблизительно)

-- Дамп данных таблицы bigidea.post_hashtags: ~0 rows (приблизительно)

-- Дамп данных таблицы bigidea.post_likes: ~0 rows (приблизительно)

-- Дамп данных таблицы bigidea.users: ~1 rows (приблизительно)
INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `remember_token`, `password_reset_at`, `created_at`, `verified`, `token`, `reset_token_hash`, `reset_token_expires_at`) VALUES
	(8, 'kuanJoy', 'kuanishmykyev@mail.ru', '$2y$10$JgH52ukM9JNVRQe7tg/Bzei9ze6Mo0DqYn6rM9DhyusfPhR/YbqKm', 'админ', NULL, NULL, '2024-02-25 09:09:55', 'true', '5433', 'bc32c0fe1adbd9c8aa66c2712d4e408903b048b2d8300d08253795289020a0b9', '2024-03-06 17:11:58');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
