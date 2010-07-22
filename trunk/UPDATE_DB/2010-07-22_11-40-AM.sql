ALTER TABLE `miracledb`.`master_jual_produk` ADD UNIQUE `NOBUKTI` ( `jproduk_nobukti` );
ALTER TABLE `miracledb`.`master_jual_rawat` ADD INDEX `NOBUKTI` ( `jrawat_nobukti` );
ALTER TABLE `miracledb`.`master_jualproduk_grooming` ADD INDEX `NOBUKTI` ( `jpgrooming_nobukti` );
ALTER TABLE `miracledb`.`master_jual_paket` ADD INDEX `NOBUKTI` ( `jpaket_nobukti` );
ALTER TABLE `miracledb`.`master_lunas_piutang` ADD INDEX `NOBUKTI` ( `lpiutang_faktur` );


ALTER TABLE `miracledb`.`jual_card` ADD INDEX `NOREF` ( `jcard_ref` );
ALTER TABLE `miracledb`.`jual_cek` ADD INDEX `NOREF` ( `jcek_ref` ) ;
ALTER TABLE `miracledb`.`jual_kredit` ADD INDEX `NOREF` ( `jkredit_ref` );
ALTER TABLE `miracledb`.`jual_kwitansi` ADD INDEX `NOREF` ( `jkwitansi_ref` );
ALTER TABLE `miracledb`.`jual_transfer` ADD INDEX `NOREF` ( `jtransfer_ref` ) ;
ALTER TABLE `miracledb`.`jual_tunai` ADD INDEX `NOREF` ( `jtunai_ref` );
