-- Backup of app_taxonomies
DROP TABLE IF EXISTS `app_taxonomies`;
CREATE TABLE `app_taxonomies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `thumbnail` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `post_type` varchar(50) NOT NULL,
  `taxonomy` varchar(50) NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `total_post` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_taxonomies_slug_unique` (`slug`),
  KEY `app_taxonomies_post_type_index` (`post_type`),
  KEY `app_taxonomies_taxonomy_index` (`taxonomy`),
  KEY `app_taxonomies_parent_id_index` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

