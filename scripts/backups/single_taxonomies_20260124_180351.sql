-- Backup of single_taxonomies
DROP TABLE IF EXISTS `single_taxonomies`;
CREATE TABLE `single_taxonomies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `thumbnail` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(100) NOT NULL,
  `post_type` varchar(50) NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `taxonomy` varchar(50) NOT NULL,
  `total_post` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `single_taxonomies_post_type_post_id_unique` (`post_type`,`post_id`),
  UNIQUE KEY `single_taxonomies_slug_unique` (`slug`),
  KEY `single_taxonomies_post_type_index` (`post_type`),
  KEY `single_taxonomies_post_id_index` (`post_id`),
  KEY `single_taxonomies_taxonomy_index` (`taxonomy`),
  CONSTRAINT `single_taxonomies_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

