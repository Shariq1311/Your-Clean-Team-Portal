-- Reconcile: app_oauth_auth_codes <=> oauth_auth_codes
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_oauth_auth_codes_20260124_180348.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/oauth_auth_codes_20260124_180348.sql

-- Option A: Merge rows from app_oauth_auth_codes into oauth_auth_codes (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `oauth_auth_codes` (`id`, `user_id`, `client_id`, `scopes`, `revoked`, `expires_at`) SELECT `id`, `user_id`, `client_id`, `scopes`, `revoked`, `expires_at` FROM `app_oauth_auth_codes` AS s WHERE NOT EXISTS (SELECT 1 FROM `oauth_auth_codes` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_oauth_auth_codes` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `oauth_auth_codes` TO `oauth_auth_codes_backup_20260124_180348`, `app_oauth_auth_codes` TO `oauth_auth_codes`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_oauth_auth_codes`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_oauth_auth_codes_20260124_180348.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/oauth_auth_codes_20260124_180348.sql if needed to restore.
