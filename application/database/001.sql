ALTER TABLE `course`
ADD COLUMN `enable_comments` tinyint(2) NULL DEFAULT 0 AFTER `visibility`;