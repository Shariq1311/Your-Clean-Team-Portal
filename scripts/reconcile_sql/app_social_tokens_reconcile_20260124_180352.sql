-- Reconcile: app_social_tokens <=> social_tokens
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_social_tokens_20260124_180352.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/social_tokens_20260124_180352.sql

-- Option A: Merge rows from app_social_tokens into social_tokens (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `social_tokens` (`id`, `user_id`, `social_provider`, `social_id`, `social_token`, `social_refresh_token`) SELECT `id`, `user_id`, `social_provider`, `social_id`, `social_token`, `social_refresh_token` FROM `app_social_tokens` AS s WHERE NOT EXISTS (SELECT 1 FROM `social_tokens` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_social_tokens` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `social_tokens` TO `social_tokens_backup_20260124_180352`, `app_social_tokens` TO `social_tokens`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_social_tokens`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_social_tokens_20260124_180352.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/social_tokens_20260124_180352.sql if needed to restore.
