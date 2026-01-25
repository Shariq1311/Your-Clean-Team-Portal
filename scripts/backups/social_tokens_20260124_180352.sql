-- Backup of social_tokens
DROP TABLE IF EXISTS `social_tokens`;
CREATE TABLE `social_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `social_provider` varchar(10) NOT NULL,
  `social_id` varchar(100) NOT NULL,
  `social_token` varchar(500) NOT NULL,
  `social_refresh_token` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `social_tokens_user_id_social_provider_unique` (`user_id`,`social_provider`),
  KEY `social_tokens_user_id_index` (`user_id`),
  KEY `social_tokens_social_provider_index` (`social_provider`),
  KEY `social_tokens_social_id_index` (`social_id`),
  CONSTRAINT `social_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

