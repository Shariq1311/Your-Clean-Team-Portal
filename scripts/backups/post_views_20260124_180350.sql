-- Backup of post_views
DROP TABLE IF EXISTS `post_views`;
CREATE TABLE `post_views` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL,
  `views` bigint(20) NOT NULL DEFAULT 0,
  `day` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_views_post_id_index` (`post_id`),
  KEY `post_views_day_index` (`day`),
  CONSTRAINT `post_views_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

