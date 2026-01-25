-- Backup of app_page_metas
DROP TABLE IF EXISTS `app_page_metas`;
CREATE TABLE `app_page_metas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` bigint(20) unsigned NOT NULL,
  `meta_key` varchar(150) NOT NULL,
  `meta_value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_page_metas_page_id_meta_key_unique` (`page_id`,`meta_key`),
  KEY `app_page_metas_page_id_index` (`page_id`),
  KEY `app_page_metas_meta_key_index` (`meta_key`),
  CONSTRAINT `app_page_metas_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `app_pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

