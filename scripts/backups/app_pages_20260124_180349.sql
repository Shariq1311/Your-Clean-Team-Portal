-- Backup of app_pages
DROP TABLE IF EXISTS `app_pages`;
CREATE TABLE `app_pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `thumbnail` varchar(250) DEFAULT NULL,
  `slug` varchar(150) NOT NULL,
  `template` varchar(50) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `template_data` longtext DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'draft',
  `views` bigint(20) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_pages_slug_unique` (`slug`),
  KEY `app_pages_template_index` (`template`),
  KEY `app_pages_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

