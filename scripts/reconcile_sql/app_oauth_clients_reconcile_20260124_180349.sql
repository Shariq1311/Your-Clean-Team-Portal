-- Reconcile: app_oauth_clients <=> oauth_clients
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_oauth_clients_20260124_180349.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/oauth_clients_20260124_180349.sql

-- Option A: Merge rows from app_oauth_clients into oauth_clients (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) SELECT `id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at` FROM `app_oauth_clients` AS s WHERE NOT EXISTS (SELECT 1 FROM `oauth_clients` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_oauth_clients` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `oauth_clients` TO `oauth_clients_backup_20260124_180349`, `app_oauth_clients` TO `oauth_clients`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_oauth_clients`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_oauth_clients_20260124_180349.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/oauth_clients_20260124_180349.sql if needed to restore.
