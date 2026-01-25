-- Reconcile: app_media_files <=> media_files
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_media_files_20260124_180347.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/media_files_20260124_180347.sql

-- Option A: Merge rows from app_media_files into media_files (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `media_files` (`id`, `name`, `type`, `mime_type`, `path`, `extension`, `size`, `folder_id`, `user_id`, `created_at`, `updated_at`) SELECT `id`, `name`, `type`, `mime_type`, `path`, `extension`, `size`, `folder_id`, `user_id`, `created_at`, `updated_at` FROM `app_media_files` AS s WHERE NOT EXISTS (SELECT 1 FROM `media_files` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_media_files` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `media_files` TO `media_files_backup_20260124_180347`, `app_media_files` TO `media_files`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_media_files`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_media_files_20260124_180347.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/media_files_20260124_180347.sql if needed to restore.
