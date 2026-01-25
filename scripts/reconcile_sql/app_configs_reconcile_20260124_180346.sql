-- Reconcile: app_configs <=> configs
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_configs_20260124_180346.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/configs_20260124_180346.sql

-- Option A: Merge rows from app_configs into configs (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `configs` (`id`, `code`, `value`) SELECT `id`, `code`, `value` FROM `app_configs` AS s WHERE NOT EXISTS (SELECT 1 FROM `configs` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_configs` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `configs` TO `configs_backup_20260124_180346`, `app_configs` TO `configs`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_configs`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_configs_20260124_180346.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/configs_20260124_180346.sql if needed to restore.
