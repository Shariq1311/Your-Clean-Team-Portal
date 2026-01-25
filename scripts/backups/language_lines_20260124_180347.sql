-- Backup of language_lines
DROP TABLE IF EXISTS `language_lines`;
CREATE TABLE `language_lines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `namespace` varchar(50) NOT NULL,
  `group` varchar(50) NOT NULL,
  `key` varchar(150) NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `object_type` varchar(20) DEFAULT NULL,
  `object_key` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `language_lines_namespace_index` (`namespace`),
  KEY `language_lines_group_index` (`group`),
  KEY `language_lines_key_index` (`key`),
  KEY `language_lines_object_type_index` (`object_type`),
  KEY `language_lines_object_key_index` (`object_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

