-- Backup of manual_notifications
DROP TABLE IF EXISTS `manual_notifications`;
CREATE TABLE `manual_notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `method` varchar(150) DEFAULT NULL,
  `users` text NOT NULL,
  `data` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2,
  `error` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `manual_notifications_method_index` (`method`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

