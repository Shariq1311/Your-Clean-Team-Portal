-- Backup of term_taxonomies
DROP TABLE IF EXISTS `term_taxonomies`;
CREATE TABLE `term_taxonomies` (
  `term_id` bigint(20) NOT NULL,
  `taxonomy_id` bigint(20) NOT NULL,
  `term_type` varchar(50) NOT NULL,
  PRIMARY KEY (`term_id`,`term_type`,`taxonomy_id`),
  KEY `term_taxonomies_term_id_index` (`term_id`),
  KEY `term_taxonomies_taxonomy_id_index` (`taxonomy_id`),
  KEY `term_taxonomies_term_type_index` (`term_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

