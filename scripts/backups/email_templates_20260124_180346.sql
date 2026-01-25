-- Backup of email_templates
DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE `email_templates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `body` text NOT NULL,
  `params` text DEFAULT NULL,
  `layout` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_hook` varchar(100) DEFAULT NULL,
  `uuid` char(36) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `to_sender` tinyint(1) NOT NULL DEFAULT 1,
  `to_emails` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`to_emails`)),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_templates_code_unique` (`code`),
  UNIQUE KEY `email_templates_uuid_unique` (`uuid`),
  KEY `email_templates_active_index` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

