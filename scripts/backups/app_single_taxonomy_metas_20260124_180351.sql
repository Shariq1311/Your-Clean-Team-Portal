-- Backup of app_single_taxonomy_metas
DROP TABLE IF EXISTS `app_single_taxonomy_metas`;
CREATE TABLE `app_single_taxonomy_metas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `taxonomy_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(150) NOT NULL,
  `meta_value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_single_taxonomy_metas_taxonomy_id_meta_key_unique` (`taxonomy_id`,`meta_key`),
  KEY `app_single_taxonomy_metas_taxonomy_id_index` (`taxonomy_id`),
  KEY `app_single_taxonomy_metas_meta_key_index` (`meta_key`),
  CONSTRAINT `app_single_taxonomy_metas_taxonomy_id_foreign` FOREIGN KEY (`taxonomy_id`) REFERENCES `app_single_taxonomies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

