-- Reconcile: app_telescope_entries <=> telescope_entries
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_telescope_entries_20260124_180352.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/telescope_entries_20260124_180352.sql

-- Option A: Merge rows from app_telescope_entries into telescope_entries (non-destructive).
-- Using primary key `sequence` to avoid duplicates.
INSERT INTO `telescope_entries` (`sequence`, `uuid`, `batch_id`, `family_hash`, `should_display_on_index`, `type`, `content`, `created_at`) SELECT `sequence`, `uuid`, `batch_id`, `family_hash`, `should_display_on_index`, `type`, `content`, `created_at` FROM `app_telescope_entries` AS s WHERE NOT EXISTS (SELECT 1 FROM `telescope_entries` AS t WHERE t.`sequence` = s.`sequence`);

-- Option B: If you prefer to keep `app_telescope_entries` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `telescope_entries` TO `telescope_entries_backup_20260124_180352`, `app_telescope_entries` TO `telescope_entries`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_telescope_entries`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_telescope_entries_20260124_180352.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/telescope_entries_20260124_180352.sql if needed to restore.
