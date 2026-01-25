-- Backup of users
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(150) DEFAULT NULL,
  `employee_id` varchar(150) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `city` varchar(150) DEFAULT NULL,
  `state` varchar(150) DEFAULT NULL,
  `zip_code` varchar(150) DEFAULT NULL,
  `hourly_rate` decimal(10,2) DEFAULT NULL,
  `employment_type` varchar(150) NOT NULL DEFAULT 'full-time',
  `hire_date` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
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
  `json_metas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_metas`)),
  `is_fake` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_employee_id_unique` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

