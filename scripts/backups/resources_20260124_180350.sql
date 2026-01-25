-- Backup of resources
DROP TABLE IF EXISTS `resources`;
CREATE TABLE `resources` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL,
  `thumbnail` varchar(150) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `json_metas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_metas`)),
  `status` varchar(50) NOT NULL DEFAULT 'publish',
  `post_id` bigint(20) unsigned DEFAULT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT 1,
  `slug` varchar(150) DEFAULT NULL,
  `uuid` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `resources_slug_unique` (`slug`),
  UNIQUE KEY `resources_uuid_unique` (`uuid`),
  KEY `resources_post_id_foreign` (`post_id`),
  KEY `resources_parent_id_foreign` (`parent_id`),
  KEY `resources_type_index` (`type`),
  KEY `resources_status_index` (`status`),
  CONSTRAINT `resources_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `resources` (`id`) ON DELETE CASCADE,
  CONSTRAINT `resources_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

