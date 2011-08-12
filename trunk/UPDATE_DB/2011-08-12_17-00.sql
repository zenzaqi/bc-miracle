/*Trigger utk mencatat dorder_harga_log hanya ketika terjadi perubahan pada harga, untuk kepentingan Accounting */
ALTER TABLE `detail_order_beli`  CHANGE COLUMN `dorder_harga_log` `dorder_harga_log` TIMESTAMP NULL AFTER `dorder_diskon`;

DELIMITER //
CREATE TRIGGER `insert_log_harga_op` BEFORE INSERT ON `detail_order_beli` FOR EACH ROW BEGIN   IF NEW.dorder_harga <> 0 THEN     SET NEW.dorder_harga_log = CURRENT_TIMESTAMP();   END IF; END;


CREATE TRIGGER `update_log_harga_op` BEFORE UPDATE ON `detail_order_beli` FOR EACH ROW BEGIN   IF NEW.dorder_harga <> 0 THEN     SET NEW.dorder_harga_log = CURRENT_TIMESTAMP();   END IF; END;
DELIMITER ;