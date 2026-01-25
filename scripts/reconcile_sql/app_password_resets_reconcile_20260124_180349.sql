-- Reconcile: app_password_resets <=> password_resets
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_password_resets_20260124_180349.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/password_resets_20260124_180349.sql

-- Option A: Merge rows from app_password_resets into password_resets (non-destructive).
-- No single-column primary key detected. Consider reviewing unique keys before running the insert.
INSERT IGNORE INTO `password_resets` (`email`, `token`, `created_at`) SELECT `email`, `token`, `created_at` FROM `app_password_resets`;

-- Option B: If you prefer to keep `app_password_resets` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `password_resets` TO `password_resets_backup_20260124_180349`, `app_password_resets` TO `password_resets`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_password_resets`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_password_resets_20260124_180349.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/password_resets_20260124_180349.sql if needed to restore.
