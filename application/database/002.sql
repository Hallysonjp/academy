ALTER TABLE `users`
ADD COLUMN `bank_code` int(3) NULL AFTER `is_instructor`,
ADD COLUMN `agencia` varchar(5) NULL AFTER `bank_code`,
ADD COLUMN `agencia_dv` varchar(2) NULL AFTER `agencia`,
ADD COLUMN `conta` varchar(8) NULL AFTER `agencia_dv`,
ADD COLUMN `conta_dv` varchar(2) NULL AFTER `conta`,
ADD COLUMN `tipo_conta` varchar(20) NULL AFTER `conta_dv`,
ADD COLUMN `transfer_interval` varchar(20) NULL AFTER `tipo_conta`,
ADD COLUMN `transfer_enabled` tinyint(2) NULL AFTER `transfer_interval`,
ADD COLUMN `transfer_day` tinyint(2) NULL AFTER `transfer_enabled`;
ADD COLUMN `pagarme_account_id` varchar(20) NULL AFTER `transfer_day`,
ADD COLUMN `recipient_id` varchar(255) NULL AFTER `pagarme_account_id`,
ADD COLUMN `percentage` tinyint(3) NULL AFTER `recipient_id`;