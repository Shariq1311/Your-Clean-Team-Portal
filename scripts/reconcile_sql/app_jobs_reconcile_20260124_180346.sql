-- Reconcile: app_jobs <=> jobs
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_jobs_20260124_180346.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/jobs_20260124_180346.sql

-- Option A: Merge rows from app_jobs into jobs (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) SELECT `id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at` FROM `app_jobs` AS s WHERE NOT EXISTS (SELECT 1 FROM `jobs` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_jobs` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `jobs` TO `jobs_backup_20260124_180346`, `app_jobs` TO `jobs`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_jobs`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_jobs_20260124_180346.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/jobs_20260124_180346.sql if needed to restore.
