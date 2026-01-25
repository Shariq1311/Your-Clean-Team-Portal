-- Reconcile: app_oauth_refresh_tokens <=> oauth_refresh_tokens
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_oauth_refresh_tokens_20260124_180349.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/oauth_refresh_tokens_20260124_180349.sql

-- Option A: Merge rows from app_oauth_refresh_tokens into oauth_refresh_tokens (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) SELECT `id`, `access_token_id`, `revoked`, `expires_at` FROM `app_oauth_refresh_tokens` AS s WHERE NOT EXISTS (SELECT 1 FROM `oauth_refresh_tokens` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_oauth_refresh_tokens` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `oauth_refresh_tokens` TO `oauth_refresh_tokens_backup_20260124_180349`, `app_oauth_refresh_tokens` TO `oauth_refresh_tokens`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_oauth_refresh_tokens`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_oauth_refresh_tokens_20260124_180349.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/oauth_refresh_tokens_20260124_180349.sql if needed to restore.
