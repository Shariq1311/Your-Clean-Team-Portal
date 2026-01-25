-- Reconcile: app_single_taxonomies <=> single_taxonomies
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_single_taxonomies_20260124_180351.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/single_taxonomies_20260124_180351.sql

-- Option A: Merge rows from app_single_taxonomies into single_taxonomies (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `single_taxonomies` (`id`, `name`, `thumbnail`, `description`, `slug`, `post_type`, `post_id`, `taxonomy`, `total_post`, `created_at`, `updated_at`) SELECT `id`, `name`, `thumbnail`, `description`, `slug`, `post_type`, `post_id`, `taxonomy`, `total_post`, `created_at`, `updated_at` FROM `app_single_taxonomies` AS s WHERE NOT EXISTS (SELECT 1 FROM `single_taxonomies` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_single_taxonomies` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `single_taxonomies` TO `single_taxonomies_backup_20260124_180351`, `app_single_taxonomies` TO `single_taxonomies`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_single_taxonomies`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_single_taxonomies_20260124_180351.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/single_taxonomies_20260124_180351.sql if needed to restore.
