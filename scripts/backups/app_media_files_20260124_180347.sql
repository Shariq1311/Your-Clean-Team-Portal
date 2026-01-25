-- Backup of app_media_files
DROP TABLE IF EXISTS `app_media_files`;
CREATE TABLE `app_media_files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'image',
  `mime_type` varchar(150) NOT NULL,
  `path` varchar(150) NOT NULL,
  `extension` varchar(150) NOT NULL,
  `size` bigint(20) NOT NULL DEFAULT 0,
  `folder_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_media_files_folder_id_index` (`folder_id`),
  KEY `app_media_files_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

