-- Reconcile: app_menus <=> menus
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_menus_20260124_180348.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/menus_20260124_180348.sql

-- Option A: Merge rows from app_menus into menus (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `menus` (`id`, `name`, `description`, `created_at`, `updated_at`) SELECT `id`, `name`, `description`, `created_at`, `updated_at` FROM `app_menus` AS s WHERE NOT EXISTS (SELECT 1 FROM `menus` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_menus` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `menus` TO `menus_backup_20260124_180348`, `app_menus` TO `menus`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_menus`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_menus_20260124_180348.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/menus_20260124_180348.sql if needed to restore.
