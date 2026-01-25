-- Backup of mc_translations
DROP TABLE IF EXISTS `mc_translations`;
CREATE TABLE `mc_translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL DEFAULT 1,
  `locale` varchar(50) NOT NULL,
  `group` varchar(50) NOT NULL,
  `namespace` varchar(50) NOT NULL,
  `key` text NOT NULL,
  `value` text DEFAULT NULL,
  `object_type` varchar(50) DEFAULT NULL,
  `object_key` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mc_translations_status_index` (`status`),
  KEY `mc_translations_locale_index` (`locale`),
  KEY `mc_translations_group_index` (`group`),
  KEY `mc_translations_namespace_index` (`namespace`),
  KEY `mc_translations_object_type_index` (`object_type`),
  KEY `mc_translations_object_key_index` (`object_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

