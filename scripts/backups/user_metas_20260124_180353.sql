-- Backup of user_metas
DROP TABLE IF EXISTS `user_metas`;
CREATE TABLE `user_metas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(150) NOT NULL,
  `meta_value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_metas_user_id_meta_key_unique` (`user_id`,`meta_key`),
  KEY `user_metas_meta_key_index` (`meta_key`),
  CONSTRAINT `user_metas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

