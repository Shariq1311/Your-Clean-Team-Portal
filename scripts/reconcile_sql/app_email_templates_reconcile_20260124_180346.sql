-- Reconcile: app_email_templates <=> email_templates
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_email_templates_20260124_180346.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/email_templates_20260124_180346.sql

-- Option A: Merge rows from app_email_templates into email_templates (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `email_templates` (`id`, `code`, `subject`, `body`, `params`, `layout`, `created_at`, `updated_at`, `email_hook`) SELECT `id`, `code`, `subject`, `body`, `params`, `layout`, `created_at`, `updated_at`, `email_hook` FROM `app_email_templates` AS s WHERE NOT EXISTS (SELECT 1 FROM `email_templates` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_email_templates` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `email_templates` TO `email_templates_backup_20260124_180346`, `app_email_templates` TO `email_templates`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_email_templates`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_email_templates_20260124_180346.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/email_templates_20260124_180346.sql if needed to restore.
