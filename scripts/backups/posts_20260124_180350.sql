-- Backup of posts
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
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
  `total_comment` bigint(20) NOT NULL DEFAULT 0,
  `uuid` char(36) DEFAULT NULL,
  `locale` varchar(5) NOT NULL DEFAULT 'vi',
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  UNIQUE KEY `posts_uuid_unique` (`uuid`),
  KEY `posts_status_index` (`status`),
  KEY `posts_created_by_index` (`created_by`),
  KEY `posts_updated_by_index` (`updated_by`),
  KEY `posts_type_index` (`type`),
  KEY `posts_locale_index` (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

