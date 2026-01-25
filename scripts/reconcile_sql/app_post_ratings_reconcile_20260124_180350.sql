-- Reconcile: app_post_ratings <=> post_ratings
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_post_ratings_20260124_180350.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/post_ratings_20260124_180350.sql

-- Option A: Merge rows from app_post_ratings into post_ratings (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `post_ratings` (`id`, `post_id`, `client_ip`, `star`, `created_at`, `updated_at`) SELECT `id`, `post_id`, `client_ip`, `star`, `created_at`, `updated_at` FROM `app_post_ratings` AS s WHERE NOT EXISTS (SELECT 1 FROM `post_ratings` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_post_ratings` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `post_ratings` TO `post_ratings_backup_20260124_180350`, `app_post_ratings` TO `post_ratings`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_post_ratings`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_post_ratings_20260124_180350.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/post_ratings_20260124_180350.sql if needed to restore.
