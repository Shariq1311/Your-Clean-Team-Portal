-- Backup of notifications
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(150) NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `notifiable_type` varchar(150) NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

