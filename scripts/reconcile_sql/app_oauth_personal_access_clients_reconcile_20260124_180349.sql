-- Reconcile: app_oauth_personal_access_clients <=> oauth_personal_access_clients
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_oauth_personal_access_clients_20260124_180349.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/oauth_personal_access_clients_20260124_180349.sql

-- Option A: Merge rows from app_oauth_personal_access_clients into oauth_personal_access_clients (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) SELECT `id`, `client_id`, `created_at`, `updated_at` FROM `app_oauth_personal_access_clients` AS s WHERE NOT EXISTS (SELECT 1 FROM `oauth_personal_access_clients` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_oauth_personal_access_clients` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `oauth_personal_access_clients` TO `oauth_personal_access_clients_backup_20260124_180349`, `app_oauth_personal_access_clients` TO `oauth_personal_access_clients`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_oauth_personal_access_clients`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_oauth_personal_access_clients_20260124_180349.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/oauth_personal_access_clients_20260124_180349.sql if needed to restore.
