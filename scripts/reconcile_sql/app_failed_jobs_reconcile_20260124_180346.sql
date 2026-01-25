-- Reconcile: app_failed_jobs <=> failed_jobs
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_failed_jobs_20260124_180346.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/failed_jobs_20260124_180346.sql

-- Option A: Merge rows from app_failed_jobs into failed_jobs (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `failed_jobs` (`id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at`) SELECT `id`, `uuid`, `connection`, `queue`, `payload`, `exception`, `failed_at` FROM `app_failed_jobs` AS s WHERE NOT EXISTS (SELECT 1 FROM `failed_jobs` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_failed_jobs` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `failed_jobs` TO `failed_jobs_backup_20260124_180346`, `app_failed_jobs` TO `failed_jobs`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_failed_jobs`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_failed_jobs_20260124_180346.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/failed_jobs_20260124_180346.sql if needed to restore.
