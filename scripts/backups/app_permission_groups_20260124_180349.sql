-- Backup of app_permission_groups
DROP TABLE IF EXISTS `app_permission_groups`;
CREATE TABLE `app_permission_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `plugin` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_permission_groups_plugin_index` (`plugin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

