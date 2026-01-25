-- Backup of app_comments
DROP TABLE IF EXISTS `app_comments`;
CREATE TABLE `app_comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `content` varchar(300) NOT NULL,
  `object_id` bigint(20) unsigned NOT NULL COMMENT 'Post type ID',
  `object_type` varchar(50) NOT NULL COMMENT 'Post type',
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_comments_user_id_index` (`user_id`),
  KEY `app_comments_email_index` (`email`),
  KEY `app_comments_object_id_index` (`object_id`),
  KEY `app_comments_object_type_index` (`object_type`),
  CONSTRAINT `app_comments_object_id_foreign` FOREIGN KEY (`object_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

