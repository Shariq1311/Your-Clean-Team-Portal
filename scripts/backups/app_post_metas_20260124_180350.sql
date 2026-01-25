-- Backup of app_post_metas
DROP TABLE IF EXISTS `app_post_metas`;
CREATE TABLE `app_post_metas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(150) NOT NULL,
  `meta_value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_post_metas_post_id_meta_key_unique` (`post_id`,`meta_key`),
  KEY `app_post_metas_post_id_index` (`post_id`),
  KEY `app_post_metas_meta_key_index` (`meta_key`),
  CONSTRAINT `app_post_metas_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

