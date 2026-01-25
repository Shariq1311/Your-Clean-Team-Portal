-- Reconcile: app_model_has_permissions <=> model_has_permissions
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_model_has_permissions_20260124_180348.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/model_has_permissions_20260124_180348.sql

-- Option A: Merge rows from app_model_has_permissions into model_has_permissions (non-destructive).
-- Using primary key `permission_id` to avoid duplicates.
INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) SELECT `permission_id`, `model_type`, `model_id` FROM `app_model_has_permissions` AS s WHERE NOT EXISTS (SELECT 1 FROM `model_has_permissions` AS t WHERE t.`permission_id` = s.`permission_id`);

-- Option B: If you prefer to keep `app_model_has_permissions` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `model_has_permissions` TO `model_has_permissions_backup_20260124_180348`, `app_model_has_permissions` TO `model_has_permissions`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_model_has_permissions`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_model_has_permissions_20260124_180348.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/model_has_permissions_20260124_180348.sql if needed to restore.
