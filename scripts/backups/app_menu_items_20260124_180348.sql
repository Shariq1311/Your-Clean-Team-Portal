-- Backup of app_menu_items
DROP TABLE IF EXISTS `app_menu_items`;
CREATE TABLE `app_menu_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint(20) unsigned NOT NULL,
  `parent_id` bigint(20) unsigned DEFAULT NULL,
  `box_key` varchar(50) NOT NULL,
  `label` varchar(100) NOT NULL,
  `model_class` varchar(100) DEFAULT NULL,
  `model_id` bigint(20) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  `icon` varchar(150) DEFAULT NULL,
  `target` varchar(10) NOT NULL DEFAULT '_self',
  `num_order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `app_menu_items_menu_id_foreign` (`menu_id`),
  KEY `app_menu_items_parent_id_foreign` (`parent_id`),
  KEY `app_menu_items_model_class_index` (`model_class`),
  KEY `app_menu_items_model_id_index` (`model_id`),
  KEY `app_menu_items_num_order_index` (`num_order`),
  CONSTRAINT `app_menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `app_menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_menu_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `app_menu_items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

