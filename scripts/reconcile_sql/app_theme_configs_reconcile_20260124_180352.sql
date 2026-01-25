-- Reconcile: app_theme_configs <=> theme_configs
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_theme_configs_20260124_180352.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/theme_configs_20260124_180352.sql

-- Option A: Merge rows from app_theme_configs into theme_configs (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `theme_configs` (`id`, `code`, `theme`, `value`, `created_at`, `updated_at`) SELECT `id`, `code`, `theme`, `value`, `created_at`, `updated_at` FROM `app_theme_configs` AS s WHERE NOT EXISTS (SELECT 1 FROM `theme_configs` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_theme_configs` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `theme_configs` TO `theme_configs_backup_20260124_180352`, `app_theme_configs` TO `theme_configs`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_theme_configs`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_theme_configs_20260124_180352.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/theme_configs_20260124_180352.sql if needed to restore.
