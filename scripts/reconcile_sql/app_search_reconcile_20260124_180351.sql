-- Reconcile: app_search <=> search
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_search_20260124_180351.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/search_20260124_180351.sql

-- Option A: Merge rows from app_search into search (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `search` (`id`, `title`, `description`, `keyword`, `slug`, `post_id`, `post_type`, `status`, `created_at`, `updated_at`) SELECT `id`, `title`, `description`, `keyword`, `slug`, `post_id`, `post_type`, `status`, `created_at`, `updated_at` FROM `app_search` AS s WHERE NOT EXISTS (SELECT 1 FROM `search` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_search` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `search` TO `search_backup_20260124_180351`, `app_search` TO `search`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_search`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_search_20260124_180351.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/search_20260124_180351.sql if needed to restore.
