-- Backup of app_languages
DROP TABLE IF EXISTS `app_languages`;
CREATE TABLE `app_languages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_languages_code_unique` (`code`),
  KEY `app_languages_code_index` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `app_languages` (`id`, `code`, `name`, `default`, `created_at`, `updated_at`) VALUES ('1', 'en', 'English', '1', '2026-01-24 14:37:08', '2026-01-24 14:37:08');
