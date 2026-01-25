-- Backup of menus
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

