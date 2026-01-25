-- Reconcile: app_roles <=> roles
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_roles_20260124_180351.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/roles_20260124_180351.sql

-- Option A: Merge rows from app_roles into roles (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `description`) SELECT `id`, `name`, `guard_name`, `created_at`, `updated_at`, `description` FROM `app_roles` AS s WHERE NOT EXISTS (SELECT 1 FROM `roles` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_roles` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `roles` TO `roles_backup_20260124_180351`, `app_roles` TO `roles`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_roles`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_roles_20260124_180351.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/roles_20260124_180351.sql if needed to restore.
