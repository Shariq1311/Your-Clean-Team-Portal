-- Reconcile: app_permission_groups <=> permission_groups
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_permission_groups_20260124_180349.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/permission_groups_20260124_180349.sql

-- Option A: Merge rows from app_permission_groups into permission_groups (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `permission_groups` (`id`, `name`, `plugin`, `created_at`, `updated_at`) SELECT `id`, `name`, `plugin`, `created_at`, `updated_at` FROM `app_permission_groups` AS s WHERE NOT EXISTS (SELECT 1 FROM `permission_groups` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_permission_groups` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `permission_groups` TO `permission_groups_backup_20260124_180349`, `app_permission_groups` TO `permission_groups`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_permission_groups`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_permission_groups_20260124_180349.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/permission_groups_20260124_180349.sql if needed to restore.
