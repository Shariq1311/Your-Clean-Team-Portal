-- Backup of app_telescope_entries_tags
DROP TABLE IF EXISTS `app_telescope_entries_tags`;
CREATE TABLE `app_telescope_entries_tags` (
  `entry_uuid` char(36) NOT NULL,
  `tag` varchar(150) NOT NULL,
  KEY `app_telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  KEY `app_telescope_entries_tags_tag_index` (`tag`),
  CONSTRAINT `app_telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `app_telescope_entries` (`uuid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

