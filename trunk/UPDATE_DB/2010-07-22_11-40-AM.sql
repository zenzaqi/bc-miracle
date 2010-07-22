ALTER TABLE `master_jual_produk` ADD INDEX `NOBUKTI` ( `jproduk_nobukti` );
ALTER TABLE `master_jual_rawat` ADD INDEX `NOBUKTI` ( `jrawat_nobukti` );
ALTER TABLE `master_jualproduk_grooming` ADD INDEX `NOBUKTI` ( `jpgrooming_nobukti` );
ALTER TABLE `master_jual_paket` ADD INDEX `NOBUKTI` ( `jpaket_nobukti` );
ALTER TABLE `master_lunas_piutang` ADD INDEX `NOBUKTI` ( `lpiutang_faktur` );


ALTER TABLE `jual_card` ADD INDEX `NOREF` ( `jcard_ref` );
ALTER TABLE `jual_cek` ADD INDEX `NOREF` ( `jcek_ref` ) ;
ALTER TABLE `jual_kredit` ADD INDEX `NOREF` ( `jkredit_ref` );
ALTER TABLE `jual_kwitansi` ADD INDEX `NOREF` ( `jkwitansi_ref` );
ALTER TABLE `jual_transfer` ADD INDEX `NOREF` ( `jtransfer_ref` ) ;
ALTER TABLE `jual_tunai` ADD INDEX `NOREF` ( `jtunai_ref` );
