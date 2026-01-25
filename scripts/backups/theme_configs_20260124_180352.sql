-- Backup of theme_configs
DROP TABLE IF EXISTS `theme_configs`;
CREATE TABLE `theme_configs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `theme` varchar(150) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `theme_configs_code_theme_unique` (`code`,`theme`),
  KEY `theme_configs_code_index` (`code`),
  KEY `theme_configs_theme_index` (`theme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

