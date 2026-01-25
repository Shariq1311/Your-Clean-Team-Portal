-- Backup of media_folders
DROP TABLE IF EXISTS `media_folders`;
CREATE TABLE `media_folders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'image',
  `folder_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `disk` varchar(50) NOT NULL DEFAULT 'public',
  PRIMARY KEY (`id`),
  KEY `media_folders_folder_id_index` (`folder_id`),
  KEY `media_folders_type_index` (`type`),
  KEY `media_folders_disk_index` (`disk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

