-- Backup of telescope_entries_tags
DROP TABLE IF EXISTS `telescope_entries_tags`;
CREATE TABLE `telescope_entries_tags` (
  `entry_uuid` char(36) NOT NULL,
  `tag` varchar(150) NOT NULL,
  KEY `telescope_entries_tags_entry_uuid_tag_index` (`entry_uuid`,`tag`),
  KEY `telescope_entries_tags_tag_index` (`tag`),
  CONSTRAINT `telescope_entries_tags_entry_uuid_foreign` FOREIGN KEY (`entry_uuid`) REFERENCES `telescope_entries` (`uuid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

