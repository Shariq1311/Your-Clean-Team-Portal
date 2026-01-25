-- Reconcile: app_email_lists <=> email_lists
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_email_lists_20260124_180346.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/email_lists_20260124_180346.sql

-- Option A: Merge rows from app_email_lists into email_lists (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `email_lists` (`id`, `email`, `template_id`, `params`, `status`, `priority`, `error`, `data`, `created_at`, `updated_at`) SELECT `id`, `email`, `template_id`, `params`, `status`, `priority`, `error`, `data`, `created_at`, `updated_at` FROM `app_email_lists` AS s WHERE NOT EXISTS (SELECT 1 FROM `email_lists` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_email_lists` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `email_lists` TO `email_lists_backup_20260124_180346`, `app_email_lists` TO `email_lists`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_email_lists`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_email_lists_20260124_180346.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/email_lists_20260124_180346.sql if needed to restore.
