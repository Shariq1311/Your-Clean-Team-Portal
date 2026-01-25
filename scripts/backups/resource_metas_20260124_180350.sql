-- Backup of resource_metas
DROP TABLE IF EXISTS `resource_metas`;
CREATE TABLE `resource_metas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `resource_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(150) NOT NULL,
  `meta_value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `resource_metas_resource_id_meta_key_unique` (`resource_id`,`meta_key`),
  KEY `resource_metas_resource_id_index` (`resource_id`),
  KEY `resource_metas_meta_key_index` (`meta_key`),
  CONSTRAINT `resource_metas_resource_id_foreign` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

