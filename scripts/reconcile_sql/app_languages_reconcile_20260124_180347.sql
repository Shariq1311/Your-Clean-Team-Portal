-- Reconcile: app_languages <=> languages
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_languages_20260124_180347.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/languages_20260124_180347.sql

-- Option A: Merge rows from app_languages into languages (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `languages` (`id`, `code`, `name`, `default`, `created_at`, `updated_at`) SELECT `id`, `code`, `name`, `default`, `created_at`, `updated_at` FROM `app_languages` AS s WHERE NOT EXISTS (SELECT 1 FROM `languages` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_languages` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `languages` TO `languages_backup_20260124_180347`, `app_languages` TO `languages`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_languages`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_languages_20260124_180347.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/languages_20260124_180347.sql if needed to restore.
