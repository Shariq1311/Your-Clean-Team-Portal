-- Backup of app_configs
DROP TABLE IF EXISTS `app_configs`;
CREATE TABLE `app_configs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_configs_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `app_configs` (`id`, `code`, `value`) VALUES ('1', 'sitename', 'Your Clean Team');
INSERT INTO `app_configs` (`id`, `code`, `value`) VALUES ('2', 'title', 'Your Clean Team');
INSERT INTO `app_configs` (`id`, `code`, `value`) VALUES ('3', 'logo', 'mc-styles/Your Clean Team/assets/static/logo.png');
INSERT INTO `app_configs` (`id`, `code`, `value`) VALUES ('4', 'different_auth_logo', 'mc-styles/Your Clean Team/assets/static/logo.png');
INSERT INTO `app_configs` (`id`, `code`, `value`) VALUES ('5', 'admin_logo', 'mc-styles/Your Clean Team/assets/static/logo.png');
INSERT INTO `app_configs` (`id`, `code`, `value`) VALUES ('6', 'pwa_app_name', 'Your Clean Team');
INSERT INTO `app_configs` (`id`, `code`, `value`) VALUES ('7', 'pwa_description', 'Your Clean Team portal');
