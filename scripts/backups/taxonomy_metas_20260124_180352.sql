-- Backup of taxonomy_metas
DROP TABLE IF EXISTS `taxonomy_metas`;
CREATE TABLE `taxonomy_metas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `taxonomy_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(150) NOT NULL,
  `meta_value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `taxonomy_metas_taxonomy_id_meta_key_unique` (`taxonomy_id`,`meta_key`),
  KEY `taxonomy_metas_taxonomy_id_index` (`taxonomy_id`),
  KEY `taxonomy_metas_meta_key_index` (`meta_key`),
  CONSTRAINT `taxonomy_metas_taxonomy_id_foreign` FOREIGN KEY (`taxonomy_id`) REFERENCES `taxonomies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

