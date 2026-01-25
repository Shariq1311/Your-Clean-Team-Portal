-- Backup of app_post_ratings
DROP TABLE IF EXISTS `app_post_ratings`;
CREATE TABLE `app_post_ratings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL,
  `client_ip` varchar(50) NOT NULL,
  `star` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_post_ratings_post_id_index` (`post_id`),
  KEY `app_post_ratings_client_ip_index` (`client_ip`),
  CONSTRAINT `app_post_ratings_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

