-- Backup of app_media_folders
DROP TABLE IF EXISTS `app_media_folders`;
CREATE TABLE `app_media_folders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'image',
  `folder_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_media_folders_folder_id_index` (`folder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

