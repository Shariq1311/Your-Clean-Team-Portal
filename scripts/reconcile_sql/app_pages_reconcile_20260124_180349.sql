-- Reconcile: app_pages <=> pages
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_pages_20260124_180349.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/pages_20260124_180349.sql

-- Option A: Merge rows from app_pages into pages (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `pages` (`id`, `title`, `thumbnail`, `slug`, `template`, `content`, `template_data`, `status`, `views`, `created_at`, `updated_at`, `description`) SELECT `id`, `title`, `thumbnail`, `slug`, `template`, `content`, `template_data`, `status`, `views`, `created_at`, `updated_at`, `description` FROM `app_pages` AS s WHERE NOT EXISTS (SELECT 1 FROM `pages` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_pages` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `pages` TO `pages_backup_20260124_180349`, `app_pages` TO `pages`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_pages`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_pages_20260124_180349.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/pages_20260124_180349.sql if needed to restore.
