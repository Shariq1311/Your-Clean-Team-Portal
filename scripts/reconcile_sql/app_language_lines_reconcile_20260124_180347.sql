-- Reconcile: app_language_lines <=> language_lines
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_language_lines_20260124_180347.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/language_lines_20260124_180347.sql

-- Option A: Merge rows from app_language_lines into language_lines (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `language_lines` (`id`, `namespace`, `group`, `key`, `text`, `created_at`, `updated_at`) SELECT `id`, `namespace`, `group`, `key`, `text`, `created_at`, `updated_at` FROM `app_language_lines` AS s WHERE NOT EXISTS (SELECT 1 FROM `language_lines` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_language_lines` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `language_lines` TO `language_lines_backup_20260124_180347`, `app_language_lines` TO `language_lines`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_language_lines`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_language_lines_20260124_180347.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/language_lines_20260124_180347.sql if needed to restore.
