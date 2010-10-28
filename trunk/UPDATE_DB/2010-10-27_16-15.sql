-- table untuk mencatat setiap event yg terjadi di Kasir & Persediaan (akan dicoba untuk Surat Pesanan terlebih dahulu)

CREATE TABLE  `log_transaksi` (
`log_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
`log_no_faktur` VARCHAR( 30 ) NOT NULL ,
`log_event` VARCHAR( 30 ) NOT NULL ,
`log_author` VARCHAR( 30 ) NOT NULL ,
`log_date` DATETIME NOT NULL ,
PRIMARY KEY (  `log_id` )
) ENGINE = InnoDB ;