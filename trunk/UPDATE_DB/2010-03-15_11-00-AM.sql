ALTER TABLE `detail_lunas_piutang` CHANGE `dpiutang_nohutang` `dpiutang_nobukti` VARCHAR( 15 ) NOT NULL ;
ALTER TABLE `detail_lunas_piutang` ADD `dpiutang_tanggal` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;
ALTER TABLE `detail_lunas_piutang` ADD `dpiutang_cara` ENUM( 'tunai', 'card', 'cek/giro', 'transfer' ) NULL DEFAULT NULL ;

ALTER TABLE `master_lunas_piutang` CHANGE `lpiutang_no` `lpiutang_faktur` VARCHAR( 15 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ;
ALTER TABLE `master_lunas_piutang` CHANGE `lpiutang_tanggal` `lpiutang_faktur_tanggal` DATE NULL DEFAULT NULL ;
ALTER TABLE `master_lunas_piutang` ADD `lpiutang_sisa` DOUBLE NULL DEFAULT NULL AFTER `lpiutang_total` ;
ALTER TABLE `master_lunas_piutang` ADD `lpiutang_status` ENUM( 'lunas', 'piutang' ) NOT NULL DEFAULT 'piutang' AFTER `lpiutang_keterangan` ;


CREATE TABLE IF NOT EXISTS `master_faktur_lunas_piutang` (
  `fpiutang_id` int(11) NOT NULL AUTO_INCREMENT,
  `fpiutang_nobukti` varchar(15) NOT NULL,
  `fpiutang_tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fpiutang_cara` enum('tunai','card','cek/giro','transfer') DEFAULT NULL,
  `fpiutang_creator` varchar(25) NOT NULL,
  PRIMARY KEY (`fpiutang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;