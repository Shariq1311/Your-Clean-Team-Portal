-- Reconcile: app_notifications <=> notifications
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_notifications_20260124_180348.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/notifications_20260124_180348.sql

-- Option A: Merge rows from app_notifications into notifications (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `notifications` (`id`, `type`, `data`, `read_at`, `notifiable_type`, `notifiable_id`, `created_at`, `updated_at`) SELECT `id`, `type`, `data`, `read_at`, `notifiable_type`, `notifiable_id`, `created_at`, `updated_at` FROM `app_notifications` AS s WHERE NOT EXISTS (SELECT 1 FROM `notifications` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_notifications` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `notifications` TO `notifications_backup_20260124_180348`, `app_notifications` TO `notifications`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_notifications`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_notifications_20260124_180348.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/notifications_20260124_180348.sql if needed to restore.
