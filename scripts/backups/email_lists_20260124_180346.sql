-- Backup of email_lists
DROP TABLE IF EXISTS `email_lists`;
CREATE TABLE `email_lists` (
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
  `template_code` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email_lists_email_index` (`email`),
  KEY `email_lists_template_id_index` (`template_id`),
  KEY `email_lists_status_index` (`status`),
  KEY `email_lists_template_code_index` (`template_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

