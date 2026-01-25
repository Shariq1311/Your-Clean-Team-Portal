-- Reconcile: app_taxonomies <=> taxonomies
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_taxonomies_20260124_180352.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/taxonomies_20260124_180352.sql

-- Option A: Merge rows from app_taxonomies into taxonomies (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `taxonomies` (`id`, `name`, `thumbnail`, `description`, `slug`, `post_type`, `taxonomy`, `parent_id`, `total_post`, `created_at`, `updated_at`, `level`) SELECT `id`, `name`, `thumbnail`, `description`, `slug`, `post_type`, `taxonomy`, `parent_id`, `total_post`, `created_at`, `updated_at`, `level` FROM `app_taxonomies` AS s WHERE NOT EXISTS (SELECT 1 FROM `taxonomies` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_taxonomies` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `taxonomies` TO `taxonomies_backup_20260124_180352`, `app_taxonomies` TO `taxonomies`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_taxonomies`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_taxonomies_20260124_180352.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/taxonomies_20260124_180352.sql if needed to restore.
