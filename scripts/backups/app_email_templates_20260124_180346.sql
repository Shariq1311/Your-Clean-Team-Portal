-- Backup of app_email_templates
DROP TABLE IF EXISTS `app_email_templates`;
CREATE TABLE `app_email_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `body` text NOT NULL,
  `params` text DEFAULT NULL,
  `layout` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_hook` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_email_templates_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

