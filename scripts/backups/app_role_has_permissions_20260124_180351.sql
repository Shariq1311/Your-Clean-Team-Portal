-- Backup of app_role_has_permissions
DROP TABLE IF EXISTS `app_role_has_permissions`;
CREATE TABLE `app_role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `app_role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `app_role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `app_permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `app_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

