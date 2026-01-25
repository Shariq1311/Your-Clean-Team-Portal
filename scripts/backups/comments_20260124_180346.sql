-- Backup of comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `content` varchar(300) NOT NULL,
  `object_id` bigint(20) unsigned NOT NULL COMMENT 'Post type ID',
  `object_type` varchar(50) NOT NULL COMMENT 'Post type',
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `json_metas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_metas`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_index` (`user_id`),
  KEY `comments_email_index` (`email`),
  KEY `comments_object_id_index` (`object_id`),
  KEY `comments_object_type_index` (`object_type`),
  CONSTRAINT `comments_object_id_foreign` FOREIGN KEY (`object_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

