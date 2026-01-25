-- Reconcile: app_post_views <=> post_views
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_post_views_20260124_180350.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/post_views_20260124_180350.sql

-- Option A: Merge rows from app_post_views into post_views (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `post_views` (`id`, `post_id`, `views`, `day`) SELECT `id`, `post_id`, `views`, `day` FROM `app_post_views` AS s WHERE NOT EXISTS (SELECT 1 FROM `post_views` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_post_views` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `post_views` TO `post_views_backup_20260124_180350`, `app_post_views` TO `post_views`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_post_views`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_post_views_20260124_180350.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/post_views_20260124_180350.sql if needed to restore.
