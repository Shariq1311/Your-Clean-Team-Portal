-- Backup of seo_metas
DROP TABLE IF EXISTS `seo_metas`;
CREATE TABLE `seo_metas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `object_type` varchar(10) NOT NULL,
  `object_id` bigint(20) unsigned NOT NULL,
  `meta_title` varchar(150) DEFAULT NULL,
  `meta_description` varchar(320) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seo_metas_object_type_index` (`object_type`),
  KEY `seo_metas_object_id_index` (`object_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

