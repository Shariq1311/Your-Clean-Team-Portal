-- Reconcile: app_migrations <=> migrations
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_migrations_20260124_180348.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/migrations_20260124_180348.sql

-- Option A: Merge rows from app_migrations into migrations (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `migrations` (`id`, `migration`, `batch`) SELECT `id`, `migration`, `batch` FROM `app_migrations` AS s WHERE NOT EXISTS (SELECT 1 FROM `migrations` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_migrations` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `migrations` TO `migrations_backup_20260124_180348`, `app_migrations` TO `migrations`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_migrations`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_migrations_20260124_180348.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/migrations_20260124_180348.sql if needed to restore.
