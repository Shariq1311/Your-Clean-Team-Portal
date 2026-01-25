-- Backup of search
DROP TABLE IF EXISTS `search`;
CREATE TABLE `search` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(190) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `keyword` varchar(190) DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  `post_type` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `search_post_id_post_type_unique` (`post_id`,`post_type`),
  KEY `search_title_index` (`title`),
  KEY `search_slug_index` (`slug`),
  KEY `search_post_id_index` (`post_id`),
  KEY `search_post_type_index` (`post_type`),
  KEY `search_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

