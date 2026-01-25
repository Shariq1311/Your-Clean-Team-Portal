-- Backup of app_password_resets
DROP TABLE IF EXISTS `app_password_resets`;
CREATE TABLE `app_password_resets` (
  `email` varchar(150) NOT NULL,
  `token` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `app_password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

