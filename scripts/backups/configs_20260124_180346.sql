-- Backup of configs
DROP TABLE IF EXISTS `configs`;
CREATE TABLE `configs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `configs_code_unique` (`code`),
  KEY `configs_code_index` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

