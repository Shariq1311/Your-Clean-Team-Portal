-- Reconcile: app_personal_access_tokens <=> personal_access_tokens
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_personal_access_tokens_20260124_180350.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/personal_access_tokens_20260124_180350.sql

-- Option A: Merge rows from app_personal_access_tokens into personal_access_tokens (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) SELECT `id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at` FROM `app_personal_access_tokens` AS s WHERE NOT EXISTS (SELECT 1 FROM `personal_access_tokens` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_personal_access_tokens` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `personal_access_tokens` TO `personal_access_tokens_backup_20260124_180350`, `app_personal_access_tokens` TO `personal_access_tokens`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_personal_access_tokens`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_personal_access_tokens_20260124_180350.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/personal_access_tokens_20260124_180350.sql if needed to restore.
