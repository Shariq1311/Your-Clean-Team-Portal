-- Backup of app_oauth_auth_codes
DROP TABLE IF EXISTS `app_oauth_auth_codes`;
CREATE TABLE `app_oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

