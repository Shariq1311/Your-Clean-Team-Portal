-- Reconcile: app_single_taxonomy_metas <=> single_taxonomy_metas
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_single_taxonomy_metas_20260124_180351.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/single_taxonomy_metas_20260124_180351.sql

-- Option A: Merge rows from app_single_taxonomy_metas into single_taxonomy_metas (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `single_taxonomy_metas` (`id`, `taxonomy_id`, `meta_key`, `meta_value`) SELECT `id`, `taxonomy_id`, `meta_key`, `meta_value` FROM `app_single_taxonomy_metas` AS s WHERE NOT EXISTS (SELECT 1 FROM `single_taxonomy_metas` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_single_taxonomy_metas` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `single_taxonomy_metas` TO `single_taxonomy_metas_backup_20260124_180351`, `app_single_taxonomy_metas` TO `single_taxonomy_metas`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_single_taxonomy_metas`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_single_taxonomy_metas_20260124_180351.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/single_taxonomy_metas_20260124_180351.sql if needed to restore.
