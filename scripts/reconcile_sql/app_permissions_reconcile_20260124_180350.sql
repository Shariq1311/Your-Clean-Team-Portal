-- Reconcile: app_permissions <=> permissions
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_permissions_20260124_180350.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/permissions_20260124_180350.sql

-- Option A: Merge rows from app_permissions into permissions (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `description`) SELECT `id`, `name`, `guard_name`, `created_at`, `updated_at`, `description` FROM `app_permissions` AS s WHERE NOT EXISTS (SELECT 1 FROM `permissions` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_permissions` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `permissions` TO `permissions_backup_20260124_180350`, `app_permissions` TO `permissions`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_permissions`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_permissions_20260124_180350.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/permissions_20260124_180350.sql if needed to restore.
