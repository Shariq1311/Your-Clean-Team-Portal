-- Backup of app_model_has_roles
DROP TABLE IF EXISTS `app_model_has_roles`;
CREATE TABLE `app_model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(150) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `app_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `app_model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `app_roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

