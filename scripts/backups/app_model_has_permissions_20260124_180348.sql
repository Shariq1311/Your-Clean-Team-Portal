-- Backup of app_model_has_permissions
DROP TABLE IF EXISTS `app_model_has_permissions`;
CREATE TABLE `app_model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(150) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `app_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `app_model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `app_permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

