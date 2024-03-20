INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `remember_token`, `password_reset_at`, `created_at`, `verified`, `token`, `reset_token_hash`, `reset_token_expires_at`) VALUES
	(8, 'kuanJoy', 'kuanishmykyev@mail.ru', '$2y$10$JgH52ukM9JNVRQe7tg/Bzei9ze6Mo0DqYn6rM9DhyusfPhR/YbqKm', 'админ', NULL, NULL, '2024-02-25 09:09:55', 'true', '5433', 'bc32c0fe1adbd9c8aa66c2712d4e408903b048b2d8300d08253795289020a0b9', '2024-03-06 17:11:58');

-- Дамп данных таблицы bigidea.categories: ~7 rows (приблизительно)
INSERT INTO `categories` (`id`, `name`, `status`) VALUES
	(1, 'История', 'активен'),
	(2, 'География', 'активен'),
	(3, 'Биология', 'скрыт'),
	(4, 'Экономика', 'скрыт'),
	(5, 'Математика', 'скрыт'),
	(6, 'Психология', 'скрыт'),
	(7, 'Искусство', 'скрыт'),
	(8, 'Test', 'удален');