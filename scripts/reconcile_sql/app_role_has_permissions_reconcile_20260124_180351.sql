-- Reconcile: app_role_has_permissions <=> role_has_permissions
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_role_has_permissions_20260124_180351.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/role_has_permissions_20260124_180351.sql

-- Option A: Merge rows from app_role_has_permissions into role_has_permissions (non-destructive).
-- Using primary key `permission_id` to avoid duplicates.
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) SELECT `permission_id`, `role_id` FROM `app_role_has_permissions` AS s WHERE NOT EXISTS (SELECT 1 FROM `role_has_permissions` AS t WHERE t.`permission_id` = s.`permission_id`);

-- Option B: If you prefer to keep `app_role_has_permissions` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `role_has_permissions` TO `role_has_permissions_backup_20260124_180351`, `app_role_has_permissions` TO `role_has_permissions`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_role_has_permissions`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_role_has_permissions_20260124_180351.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/role_has_permissions_20260124_180351.sql if needed to restore.
