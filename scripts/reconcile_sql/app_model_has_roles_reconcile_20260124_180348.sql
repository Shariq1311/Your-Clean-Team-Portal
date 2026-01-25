-- Reconcile: app_model_has_roles <=> model_has_roles
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_model_has_roles_20260124_180348.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/model_has_roles_20260124_180348.sql

-- Option A: Merge rows from app_model_has_roles into model_has_roles (non-destructive).
-- Using primary key `role_id` to avoid duplicates.
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) SELECT `role_id`, `model_type`, `model_id` FROM `app_model_has_roles` AS s WHERE NOT EXISTS (SELECT 1 FROM `model_has_roles` AS t WHERE t.`role_id` = s.`role_id`);

-- Option B: If you prefer to keep `app_model_has_roles` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `model_has_roles` TO `model_has_roles_backup_20260124_180348`, `app_model_has_roles` TO `model_has_roles`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_model_has_roles`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_model_has_roles_20260124_180348.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/model_has_roles_20260124_180348.sql if needed to restore.
