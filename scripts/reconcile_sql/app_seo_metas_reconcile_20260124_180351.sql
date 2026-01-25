-- Reconcile: app_seo_metas <=> seo_metas
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_seo_metas_20260124_180351.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/seo_metas_20260124_180351.sql

-- Option A: Merge rows from app_seo_metas into seo_metas (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `seo_metas` (`id`, `object_type`, `object_id`, `meta_title`, `meta_description`) SELECT `id`, `object_type`, `object_id`, `meta_title`, `meta_description` FROM `app_seo_metas` AS s WHERE NOT EXISTS (SELECT 1 FROM `seo_metas` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_seo_metas` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `seo_metas` TO `seo_metas_backup_20260124_180351`, `app_seo_metas` TO `seo_metas`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_seo_metas`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_seo_metas_20260124_180351.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/seo_metas_20260124_180351.sql if needed to restore.
