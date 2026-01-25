-- Reconcile: app_oauth_access_tokens <=> oauth_access_tokens
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_oauth_access_tokens_20260124_180348.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/oauth_access_tokens_20260124_180348.sql

-- Option A: Merge rows from app_oauth_access_tokens into oauth_access_tokens (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) SELECT `id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at` FROM `app_oauth_access_tokens` AS s WHERE NOT EXISTS (SELECT 1 FROM `oauth_access_tokens` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_oauth_access_tokens` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `oauth_access_tokens` TO `oauth_access_tokens_backup_20260124_180348`, `app_oauth_access_tokens` TO `oauth_access_tokens`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_oauth_access_tokens`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_oauth_access_tokens_20260124_180348.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/oauth_access_tokens_20260124_180348.sql if needed to restore.
