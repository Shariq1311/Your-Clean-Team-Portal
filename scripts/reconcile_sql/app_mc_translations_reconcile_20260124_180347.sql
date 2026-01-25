-- Reconcile: app_mc_translations <=> mc_translations
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_mc_translations_20260124_180347.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/mc_translations_20260124_180347.sql

-- Option A: Merge rows from app_mc_translations into mc_translations (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `mc_translations` (`id`, `status`, `locale`, `group`, `namespace`, `key`, `value`, `object_type`, `object_key`) SELECT `id`, `status`, `locale`, `group`, `namespace`, `key`, `value`, `object_type`, `object_key` FROM `app_mc_translations` AS s WHERE NOT EXISTS (SELECT 1 FROM `mc_translations` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_mc_translations` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `mc_translations` TO `mc_translations_backup_20260124_180347`, `app_mc_translations` TO `mc_translations`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_mc_translations`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_mc_translations_20260124_180347.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/mc_translations_20260124_180347.sql if needed to restore.
