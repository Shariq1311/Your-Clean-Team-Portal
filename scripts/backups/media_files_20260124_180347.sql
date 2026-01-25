-- Backup of media_files
DROP TABLE IF EXISTS `media_files`;
CREATE TABLE `media_files` (
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
  `disk` varchar(50) NOT NULL DEFAULT 'public',
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`metadata`)),
  PRIMARY KEY (`id`),
  KEY `media_files_folder_id_index` (`folder_id`),
  KEY `media_files_user_id_index` (`user_id`),
  KEY `media_files_type_index` (`type`),
  KEY `media_files_mime_type_index` (`mime_type`),
  KEY `media_files_path_index` (`path`),
  KEY `media_files_extension_index` (`extension`),
  KEY `media_files_size_index` (`size`),
  KEY `media_files_disk_index` (`disk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

