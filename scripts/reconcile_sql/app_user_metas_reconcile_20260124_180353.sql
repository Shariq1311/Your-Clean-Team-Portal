-- Reconcile: app_user_metas <=> user_metas
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_user_metas_20260124_180353.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/user_metas_20260124_180353.sql

-- Option A: Merge rows from app_user_metas into user_metas (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `user_metas` (`id`, `user_id`, `meta_key`, `meta_value`) SELECT `id`, `user_id`, `meta_key`, `meta_value` FROM `app_user_metas` AS s WHERE NOT EXISTS (SELECT 1 FROM `user_metas` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_user_metas` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `user_metas` TO `user_metas_backup_20260124_180353`, `app_user_metas` TO `user_metas`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_user_metas`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_user_metas_20260124_180353.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/user_metas_20260124_180353.sql if needed to restore.
