-- Reconcile: app_comments <=> comments
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_comments_20260124_180346.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/comments_20260124_180346.sql

-- Option A: Merge rows from app_comments into comments (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `comments` (`id`, `user_id`, `email`, `name`, `website`, `content`, `object_id`, `object_type`, `status`, `created_at`, `updated_at`) SELECT `id`, `user_id`, `email`, `name`, `website`, `content`, `object_id`, `object_type`, `status`, `created_at`, `updated_at` FROM `app_comments` AS s WHERE NOT EXISTS (SELECT 1 FROM `comments` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_comments` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `comments` TO `comments_backup_20260124_180346`, `app_comments` TO `comments`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_comments`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_comments_20260124_180346.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/comments_20260124_180346.sql if needed to restore.
