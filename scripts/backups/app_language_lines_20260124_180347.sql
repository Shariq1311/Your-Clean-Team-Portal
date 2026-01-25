-- Backup of app_language_lines
DROP TABLE IF EXISTS `app_language_lines`;
CREATE TABLE `app_language_lines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `namespace` varchar(50) NOT NULL,
  `group` varchar(50) NOT NULL,
  `key` varchar(150) NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_language_lines_namespace_index` (`namespace`),
  KEY `app_language_lines_group_index` (`group`),
  KEY `app_language_lines_key_index` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

