-- Backup of languages
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `languages_code_unique` (`code`),
  KEY `languages_code_index` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

