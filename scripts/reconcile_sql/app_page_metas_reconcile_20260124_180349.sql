-- Reconcile: app_page_metas <=> page_metas
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_page_metas_20260124_180349.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/page_metas_20260124_180349.sql

-- Option A: Merge rows from app_page_metas into page_metas (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `page_metas` (`id`, `page_id`, `meta_key`, `meta_value`) SELECT `id`, `page_id`, `meta_key`, `meta_value` FROM `app_page_metas` AS s WHERE NOT EXISTS (SELECT 1 FROM `page_metas` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_page_metas` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `page_metas` TO `page_metas_backup_20260124_180349`, `app_page_metas` TO `page_metas`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_page_metas`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_page_metas_20260124_180349.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/page_metas_20260124_180349.sql if needed to restore.
