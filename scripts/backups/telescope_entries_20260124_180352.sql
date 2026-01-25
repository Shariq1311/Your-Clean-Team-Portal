-- Backup of telescope_entries
DROP TABLE IF EXISTS `telescope_entries`;
CREATE TABLE `telescope_entries` (
  `sequence` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `batch_id` char(36) NOT NULL,
  `family_hash` varchar(150) DEFAULT NULL,
  `should_display_on_index` tinyint(1) NOT NULL DEFAULT 1,
  `type` varchar(20) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`sequence`),
  UNIQUE KEY `telescope_entries_uuid_unique` (`uuid`),
  KEY `telescope_entries_batch_id_index` (`batch_id`),
  KEY `telescope_entries_family_hash_index` (`family_hash`),
  KEY `telescope_entries_created_at_index` (`created_at`),
  KEY `telescope_should_display_on_index` (`type`,`should_display_on_index`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

