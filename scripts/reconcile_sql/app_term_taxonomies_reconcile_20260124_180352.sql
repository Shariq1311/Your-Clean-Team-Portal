-- Reconcile: app_term_taxonomies <=> term_taxonomies
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_term_taxonomies_20260124_180352.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/term_taxonomies_20260124_180352.sql

-- Option A: Merge rows from app_term_taxonomies into term_taxonomies (non-destructive).
-- Using primary key `term_id` to avoid duplicates.
INSERT INTO `term_taxonomies` (`term_id`, `taxonomy_id`, `term_type`) SELECT `term_id`, `taxonomy_id`, `term_type` FROM `app_term_taxonomies` AS s WHERE NOT EXISTS (SELECT 1 FROM `term_taxonomies` AS t WHERE t.`term_id` = s.`term_id`);

-- Option B: If you prefer to keep `app_term_taxonomies` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `term_taxonomies` TO `term_taxonomies_backup_20260124_180352`, `app_term_taxonomies` TO `term_taxonomies`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_term_taxonomies`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_term_taxonomies_20260124_180352.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/term_taxonomies_20260124_180352.sql if needed to restore.
