-- Reconcile: app_resource_metas <=> resource_metas
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_resource_metas_20260124_180350.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/resource_metas_20260124_180350.sql

-- Option A: Merge rows from app_resource_metas into resource_metas (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `resource_metas` (`id`, `resource_id`, `meta_key`, `meta_value`) SELECT `id`, `resource_id`, `meta_key`, `meta_value` FROM `app_resource_metas` AS s WHERE NOT EXISTS (SELECT 1 FROM `resource_metas` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_resource_metas` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `resource_metas` TO `resource_metas_backup_20260124_180350`, `app_resource_metas` TO `resource_metas`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_resource_metas`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_resource_metas_20260124_180350.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/resource_metas_20260124_180350.sql if needed to restore.
