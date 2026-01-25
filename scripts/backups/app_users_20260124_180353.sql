-- Backup of app_users
DROP TABLE IF EXISTS `app_users`;
CREATE TABLE `app_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(150) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL DEFAULT 'active' COMMENT 'unconfimred, banned, active',
  `language` varchar(5) NOT NULL DEFAULT 'en',
  `verification_token` varchar(150) DEFAULT NULL,
  `data` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `app_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`, `is_admin`, `status`, `language`, `verification_token`, `data`) VALUES ('1', 'Admin User', 'admin@cleanteam.local', '2026-01-24 15:38:55', '$2y$10$TV6z0l6BzOtmO6FwDcj7He/kr7OhKsIWTKCuA87cR/iAOQ6xyq1ZC', 'uTcRfT750aojuyZONIykjYRuDvT8lpTwWb8ypkT13R3A8oYl4aOC6weMFdk9', '2026-01-24 13:45:01', '2026-01-24 13:45:01', NULL, '1', 'active', 'en', NULL, NULL);
INSERT INTO `app_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`, `is_admin`, `status`, `language`, `verification_token`, `data`) VALUES ('2', 'John Doe', 'john@cleanteam.local', '2026-01-24 15:38:55', '$2y$10$TV6z0l6BzOtmO6FwDcj7He/kr7OhKsIWTKCuA87cR/iAOQ6xyq1ZC', NULL, '2026-01-24 13:45:02', '2026-01-24 13:45:02', NULL, '0', 'active', 'en', NULL, NULL);
INSERT INTO `app_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`, `is_admin`, `status`, `language`, `verification_token`, `data`) VALUES ('3', 'Jane Smith', 'jane@cleanteam.local', '2026-01-24 15:38:55', '$2y$10$TV6z0l6BzOtmO6FwDcj7He/kr7OhKsIWTKCuA87cR/iAOQ6xyq1ZC', NULL, '2026-01-24 13:45:02', '2026-01-24 13:45:02', NULL, '0', 'active', 'en', NULL, NULL);
