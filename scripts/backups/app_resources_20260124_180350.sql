-- Backup of app_resources
DROP TABLE IF EXISTS `app_resources`;
CREATE TABLE `app_resources` (
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
  PRIMARY KEY (`id`),
  KEY `app_resources_post_id_foreign` (`post_id`),
  KEY `app_resources_parent_id_foreign` (`parent_id`),
  KEY `app_resources_type_index` (`type`),
  KEY `app_resources_status_index` (`status`),
  CONSTRAINT `app_resources_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `app_resources` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_resources_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `app_posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

