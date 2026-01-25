-- Reconcile: app_post_metas <=> post_metas
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_post_metas_20260124_180350.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/post_metas_20260124_180350.sql

-- Option A: Merge rows from app_post_metas into post_metas (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `post_metas` (`id`, `post_id`, `meta_key`, `meta_value`) SELECT `id`, `post_id`, `meta_key`, `meta_value` FROM `app_post_metas` AS s WHERE NOT EXISTS (SELECT 1 FROM `post_metas` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_post_metas` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `post_metas` TO `post_metas_backup_20260124_180350`, `app_post_metas` TO `post_metas`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_post_metas`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_post_metas_20260124_180350.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/post_metas_20260124_180350.sql if needed to restore.
