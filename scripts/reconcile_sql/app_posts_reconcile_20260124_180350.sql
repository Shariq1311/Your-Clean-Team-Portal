-- Reconcile: app_posts <=> posts
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_posts_20260124_180350.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/posts_20260124_180350.sql

-- Option A: Merge rows from app_posts into posts (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `posts` (`id`, `title`, `thumbnail`, `slug`, `description`, `content`, `status`, `views`, `created_at`, `updated_at`, `created_by`, `updated_by`, `type`, `json_metas`, `json_taxonomies`, `rating`, `total_rating`) SELECT `id`, `title`, `thumbnail`, `slug`, `description`, `content`, `status`, `views`, `created_at`, `updated_at`, `created_by`, `updated_by`, `type`, `json_metas`, `json_taxonomies`, `rating`, `total_rating` FROM `app_posts` AS s WHERE NOT EXISTS (SELECT 1 FROM `posts` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_posts` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `posts` TO `posts_backup_20260124_180350`, `app_posts` TO `posts`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_posts`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_posts_20260124_180350.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/posts_20260124_180350.sql if needed to restore.
