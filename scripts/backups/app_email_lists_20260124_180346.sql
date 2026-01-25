-- Backup of app_email_lists
DROP TABLE IF EXISTS `app_email_lists`;
CREATE TABLE `app_email_lists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `template_id` bigint(20) unsigned DEFAULT NULL,
  `params` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending' COMMENT 'pending => processing => (success || error)',
  `priority` int(11) NOT NULL DEFAULT 1,
  `error` text DEFAULT NULL,
  `data` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_email_lists_email_index` (`email`),
  KEY `app_email_lists_template_id_index` (`template_id`),
  KEY `app_email_lists_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

