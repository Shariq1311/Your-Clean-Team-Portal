-- Backup of app_resource_metas
DROP TABLE IF EXISTS `app_resource_metas`;
CREATE TABLE `app_resource_metas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `resource_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(150) NOT NULL,
  `meta_value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_resource_metas_resource_id_meta_key_unique` (`resource_id`,`meta_key`),
  KEY `app_resource_metas_resource_id_index` (`resource_id`),
  KEY `app_resource_metas_meta_key_index` (`meta_key`),
  CONSTRAINT `app_resource_metas_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `app_resources` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

