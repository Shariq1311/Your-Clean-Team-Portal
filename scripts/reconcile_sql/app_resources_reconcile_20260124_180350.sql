-- Reconcile: app_resources <=> resources
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_resources_20260124_180350.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/resources_20260124_180350.sql

-- Option A: Merge rows from app_resources into resources (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `resources` (`id`, `name`, `type`, `thumbnail`, `description`, `json_metas`, `status`, `post_id`, `parent_id`, `created_at`, `updated_at`, `display_order`) SELECT `id`, `name`, `type`, `thumbnail`, `description`, `json_metas`, `status`, `post_id`, `parent_id`, `created_at`, `updated_at`, `display_order` FROM `app_resources` AS s WHERE NOT EXISTS (SELECT 1 FROM `resources` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_resources` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `resources` TO `resources_backup_20260124_180350`, `app_resources` TO `resources`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_resources`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_resources_20260124_180350.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/resources_20260124_180350.sql if needed to restore.
