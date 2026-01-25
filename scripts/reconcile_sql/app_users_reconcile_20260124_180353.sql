-- Reconcile: app_users <=> users
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_users_20260124_180353.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/users_20260124_180353.sql

-- Option A: Merge rows from app_users into users (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`, `is_admin`, `status`, `language`, `verification_token`, `data`) SELECT `id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `avatar`, `is_admin`, `status`, `language`, `verification_token`, `data` FROM `app_users` AS s WHERE NOT EXISTS (SELECT 1 FROM `users` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_users` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `users` TO `users_backup_20260124_180353`, `app_users` TO `users`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_users`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_users_20260124_180353.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/users_20260124_180353.sql if needed to restore.
