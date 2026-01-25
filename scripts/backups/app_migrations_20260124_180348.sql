-- Backup of app_migrations
DROP TABLE IF EXISTS `app_migrations`;
CREATE TABLE `app_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(150) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('1', '2014_04_02_193005_create_translations_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('2', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('3', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('4', '2016_06_01_000001_create_oauth_auth_codes_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('5', '2016_06_01_000002_create_oauth_access_tokens_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('6', '2016_06_01_000003_create_oauth_refresh_tokens_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('7', '2016_06_01_000004_create_oauth_clients_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('8', '2016_06_01_000005_create_oauth_personal_access_clients_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('9', '2018_08_08_100000_create_telescope_entries_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('10', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('11', '2019_12_14_000001_create_personal_access_tokens_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('12', '2020_06_17_141252_create_pages_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('13', '2020_06_17_141314_create_posts_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('14', '2020_06_17_141546_create_configs_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('15', '2020_07_13_101632_create_media_files_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('16', '2020_07_13_101706_create_media_folders_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('17', '2020_07_19_093715_create_theme_configs_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('18', '2020_08_05_145156_create_comments_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('19', '2021_01_08_103537_add_columns_to_users_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('20', '2021_01_08_143358_create_taxonomies_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('21', '2021_01_08_143537_create_user_metas_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('22', '2021_01_09_154753_create_email_lists_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('23', '2021_02_09_091923_create_email_templates_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('24', '2021_03_10_031508_create_term_taxonomies_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('25', '2021_04_18_072732_update_notifications_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('26', '2021_04_18_093643_create_manual_notifications_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('27', '2021_08_12_053735_create_menus_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('28', '2021_09_12_142856_update_database_v106', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('29', '2021_09_21_055918_add_level_column_to_taxonomies_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('30', '2021_09_21_074810_create_search_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('31', '2021_09_26_053902_add_description_column_to_pages_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('32', '2021_10_19_153921_create_language_lines_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('33', '2021_10_19_162424_create_resources_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('34', '2021_10_19_163450_create_single_taxonomies_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('35', '2021_10_24_061612_add_type_to_posts_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('36', '2021_10_25_063534_add_data_to_users_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('37', '2021_11_06_044329_create_jobs_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('38', '2021_11_06_123423_add_metas_column_to_posts_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('39', '2021_11_06_164602_create_languages_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('40', '2021_11_13_112150_add_json_taxonomies_column_to_posts_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('41', '2021_11_23_053012_add_display_order_column_to_resources_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('42', '2021_11_26_100137_create_post_views_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('43', '2021_11_26_150252_create_post_ratings_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('44', '2021_11_26_172822_add_rating_column_to_posts_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('45', '2021_11_27_074456_add_object_key_to_translations_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('46', '2021_12_14_142948_create_permission_groups_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('47', '2021_12_15_083034_create_social_tokens_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('48', '2021_12_15_141831_create_permission_tables', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('49', '2021_12_16_070521_add_columns_to_roles_table', '1');
INSERT INTO `app_migrations` (`id`, `migration`, `batch`) VALUES ('50', '2021_12_18_051140_create_seo_metas_table', '1');
