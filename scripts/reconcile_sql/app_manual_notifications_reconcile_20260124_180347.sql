-- Reconcile: app_manual_notifications <=> manual_notifications
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_manual_notifications_20260124_180347.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/manual_notifications_20260124_180347.sql

-- Option A: Merge rows from app_manual_notifications into manual_notifications (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `manual_notifications` (`id`, `method`, `users`, `data`, `status`, `error`, `created_at`, `updated_at`) SELECT `id`, `method`, `users`, `data`, `status`, `error`, `created_at`, `updated_at` FROM `app_manual_notifications` AS s WHERE NOT EXISTS (SELECT 1 FROM `manual_notifications` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_manual_notifications` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `manual_notifications` TO `manual_notifications_backup_20260124_180347`, `app_manual_notifications` TO `manual_notifications`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_manual_notifications`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_manual_notifications_20260124_180347.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/manual_notifications_20260124_180347.sql if needed to restore.
