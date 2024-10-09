-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Listage de la structure de table test_neurones. failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table test_neurones.failed_jobs : ~0 rows (environ)

-- Listage de la structure de table test_neurones. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table test_neurones.migrations : ~0 rows (environ)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_10_09_112605_create_posts_table', 1);

-- Listage de la structure de table test_neurones. password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table test_neurones.password_reset_tokens : ~0 rows (environ)

-- Listage de la structure de table test_neurones. personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table test_neurones.personal_access_tokens : ~0 rows (environ)
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
	(1, 'App\\Models\\User', 2, 'main', 'cf167c14b5e248eb16219479347a5f4d3cea2ebd07b9782d680cd6030bf37a74', '["*"]', NULL, NULL, '2024-10-09 14:54:22', '2024-10-09 14:54:22'),
	(4, 'App\\Models\\User', 2, 'main', 'd0b1c7bfbeaa294c2b79427a7a5f15accd7515c8e22d6d9067193c4126f6dcfe', '["*"]', '2024-10-09 20:14:31', NULL, '2024-10-09 18:02:00', '2024-10-09 20:14:31');

-- Listage de la structure de table test_neurones. posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `last_update` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table test_neurones.posts : ~0 rows (environ)
INSERT INTO `posts` (`id`, `title`, `user_id`, `slug`, `content`, `image_path`, `created_at`, `last_update`) VALUES
	(1, 'uyy oiuo', 2, 'uyy-oiuo', 'zegger eerre', NULL, '2024-10-09 16:19:32', '2024-10-09 16:19:32'),
	(3, 'JHUGGJHDSQGSJ JHHKUJADFZZUG ZEFFEZ', 2, 'jhuggjhdsqgsj-jhhkujadfzzug-zeffez', 'HUGGJHDSQGSJ JHHKUJADFZZUG ZEFFEZ', NULL, '2024-10-09 16:25:46', '2024-10-09 16:25:46'),
	(4, 'ertr grefvhrthh geeg', 2, 'ertr-grefvhrthh-geeg', 'ertr grefvhrthh geeg', NULL, '2024-10-09 17:13:54', '2024-10-09 17:13:54'),
	(5, 'ertr grefvhrthh geeg', NULL, 'ertr-grefvhrthh-geeg-1', 'ertr grefvhrthh geeg', NULL, '2024-10-09 18:27:40', '2024-10-09 18:27:40'),
	(6, 'ertr grefvhrthh geeg', NULL, 'ertr-grefvhrthh-geeg-2', 'ertr grefvhrthh geeg', NULL, '2024-10-09 18:27:40', '2024-10-09 18:27:40'),
	(7, 'ffez ezffe', NULL, 'ffez-ezffe', 'zegez ez', NULL, '2024-10-09 19:09:45', '2024-10-09 19:09:45'),
	(8, 'aefedvz dzvvez', 2, 'aefedvz-dzvvez', 'efber febrerefef', 'post2024-10-09-201209-photo.jpeg', '2024-10-09 20:14:30', '2024-10-09 20:14:30'),
	(9, 'nouveau', 2, 'nouveau', 'feffv  nouveau', 'post2024-10-09-201137-photo.jpeg', '2024-10-09 20:12:39', '2024-10-09 20:12:39'),
	(10, 'dzfzaf esdsdddddzffezr', 2, 'dzfzaf-esdsdddddzffezr', 'feffv  zefzefeazf', 'post2024-10-09-200343-photo.jpeg', '2024-10-09 20:03:43', '2024-10-09 20:03:43');

-- Listage de la structure de table test_neurones. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `picture_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table test_neurones.users : ~4 rows (environ)
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `age`, `picture_path`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Huberson', 'etien', 'etienblog@gmail.com', 65, 'huberson2024-10-09-140853-photo.jpeg', NULL, '$2y$12$LqLZjqIlvEAQWzIwuAQ2WOJTIfjq/8nuwF.j1kWuwJq/2dQ.Dtbum', NULL, '2024-10-09 14:08:53', '2024-10-09 14:08:53'),
	(2, 'Huberson', 'etien', 'etienirahuberson@gmail.com', 656, 'huberson2024-10-09-143313-photo.jpeg', NULL, '$2y$12$HeTIFRTlWaIcJya7ExyiQe0WzUq/qRJ3UVsxdACSs.d/fQcsSM35.', NULL, '2024-10-09 14:33:13', '2024-10-09 14:33:13'),
	(3, 'Huberson', 'etien', 'bkohg12@gmail.com', 69, 'huberson2024-10-09-145955-photo.jpeg', NULL, '$2y$12$qvFxjW2f7yX9cb/Jp9ZfWuErjdBONIvfLtgjIn7raV0.P69mecOdi', NULL, '2024-10-09 14:59:55', '2024-10-09 14:59:55'),
	(4, 'Huberson', 'etien', 'abou12@gmail.com', 5, 'huberson2024-10-09-150058-photo.jpeg', NULL, '$2y$12$6MCZobwhECTSRcCnnJtHv.DZPRn7bclRLUx6N.XFJJS3Mh4HqxBIe', NULL, '2024-10-09 15:00:58', '2024-10-09 15:00:58');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
