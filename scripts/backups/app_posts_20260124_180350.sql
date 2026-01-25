-- Backup of app_posts
DROP TABLE IF EXISTS `app_posts`;
CREATE TABLE `app_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `thumbnail` varchar(250) DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'draft',
  `views` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'posts',
  `json_metas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_metas`)),
  `json_taxonomies` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_taxonomies`)),
  `rating` double(8,2) NOT NULL DEFAULT 0.00,
  `total_rating` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_posts_slug_unique` (`slug`),
  KEY `app_posts_status_index` (`status`),
  KEY `app_posts_created_by_index` (`created_by`),
  KEY `app_posts_updated_by_index` (`updated_by`),
  KEY `app_posts_type_index` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

