CREATE TABLE IF NOT EXISTS `log_poin_reset` (
  `log_id` int(10) NOT NULL AUTO_INCREMENT,
  `log_cust` int(10) NOT NULL DEFAULT '0',
  `log_poin` smallint(6) NOT NULL DEFAULT '0',
  `log_date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='digunakan utk mencatat setiap poin yg dihanguskan by system';


SET GLOBAL event_scheduler = ON;

--event ini digunakan untuk peraturan membership baru, yaitu poin customer hanya bisa diisikan pada hari transaksi, sehingga setiap awal hari semua poin customer harus direset ke 0

CREATE EVENT `ev_poin_reset` ON SCHEDULE EVERY 1 DAY STARTS '2011-01-01 06:00:00' ON COMPLETION PRESERVE ENABLE DO BEGIN
	insert into log_poin_reset (log_cust, log_poin)
		select c.cust_id, c.cust_point
		from customer c
		where c.cust_point > 0;

	update customer c
	set c.cust_point = 0;
END