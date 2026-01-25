-- Reconcile: app_menu_items <=> menu_items
-- Backups saved: C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_menu_items_20260124_180348.sql, C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/menu_items_20260124_180348.sql

-- Option A: Merge rows from app_menu_items into menu_items (non-destructive).
-- Using primary key `id` to avoid duplicates.
INSERT INTO `menu_items` (`id`, `menu_id`, `parent_id`, `box_key`, `label`, `model_class`, `model_id`, `link`, `icon`, `target`, `num_order`) SELECT `id`, `menu_id`, `parent_id`, `box_key`, `label`, `model_class`, `model_id`, `link`, `icon`, `target`, `num_order` FROM `app_menu_items` AS s WHERE NOT EXISTS (SELECT 1 FROM `menu_items` AS t WHERE t.`id` = s.`id`);

-- Option B: If you prefer to keep `app_menu_items` as canonical table name, you can rename: (non-destructive)
-- RENAME TABLE `menu_items` TO `menu_items_backup_20260124_180348`, `app_menu_items` TO `menu_items`;

-- Option C: After merging and verifying data, drop the redundant table: (DESCTRUCTIVE - review backups first)
-- DROP TABLE `app_menu_items`;

-- NOTES:
-- 1) Verify schema compatibility and indexes before running Option A.
-- 2) Run backups first: mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/app_menu_items_20260124_180348.sql; mysql < C:\Users\shari\OneDrive\Desktop\Your Clean Team Portal\scripts/backups/menu_items_20260124_180348.sql if needed to restore.
