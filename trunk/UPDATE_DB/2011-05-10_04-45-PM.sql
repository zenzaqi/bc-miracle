/* Add INDEX pada master AKUN */
ALTER TABLE `akun` ADD INDEX ( `akun_departemen` );

/* Alter tabel jurnal umum */
ALTER TABLE `jurnal_detail` ADD `djurnal_akun_kode` VARCHAR( 15 ) NOT NULL AFTER `djurnal_akun` ;

/* Alter view kasbak */
CREATE OR REPLACE VIEW `vu_kasbank`
AS
   SELECT `kasbank`.`kasbank_id` AS `kasbank_id`,
          `kasbank`.`kasbank_tanggal` AS `kasbank_tanggal`,
          `kasbank`.`kasbank_nobukti` AS `kasbank_nobukti`,
          `kasbank`.`kasbank_akun` AS `kasbank_akun`,
          `kasbank`.`kasbank_terimauntuk` AS `kasbank_terimauntuk`,
          `kasbank`.`kasbank_jenis` AS `kasbank_jenis`,
          `kasbank`.`kasbank_noref` AS `kasbank_noref`,
          `kasbank`.`kasbank_keterangan` AS `kasbank_keterangan`,
          `kasbank`.`kasbank_author` AS `kasbank_author`,
          `kasbank`.`kasbank_date_create` AS `kasbank_date_create`,
          `kasbank`.`kasbank_update` AS `kasbank_update`,
          `kasbank`.`kasbank_date_update` AS `kasbank_date_update`,
          `kasbank`.`kasbank_post` AS `kasbank_post`,
          `kasbank`.`kasbank_date_post` AS `kasbank_date_post`,
          `kasbank`.`kasbank_revised` AS `kasbank_revised`,
          `vu_kasbank_group`.`kasbank_debet` AS `kasbank_kredit`,
          `vu_kasbank_group`.`kasbank_kredit` AS `kasbank_debet`,
          `akun`.`akun_kode` AS `akun_kode`,
          `akun`.`akun_nama` AS `akun_nama`,
          `akun`.`akun_level` AS `akun_level`,
          `akun`.`akun_jenis` AS `akun_jenis`,
          `kasbank`.`kasbank_arsip` AS `kasbank_arsip`
     FROM (   (   `kasbank`
               JOIN
                  `vu_kasbank_group`
               ON ((`kasbank`.`kasbank_id` =
                       `vu_kasbank_group`.`kasbank_master`)))
           JOIN
              `akun`
           ON ((`kasbank`.`kasbank_akun` = `akun`.`akun_id`)));

/* Alter View Detail Kasbank */
CREATE OR REPLACE VIEW `vu_kasbank_detail`
AS
   SELECT `kasbank`.`kasbank_id` AS `kasbank_id`,
          `kasbank`.`kasbank_tanggal` AS `kasbank_tanggal`,
          `kasbank`.`kasbank_nobukti` AS `kasbank_nobukti`,
          `kasbank`.`kasbank_akun` AS `kasbank_akun`,
          `kasbank`.`kasbank_terimauntuk` AS `kasbank_terimauntuk`,
          `kasbank`.`kasbank_jenis` AS `kasbank_jenis`,
          `kasbank`.`kasbank_noref` AS `kasbank_noref`,
          `kasbank`.`kasbank_keterangan` AS `kasbank_keterangan`,
          `kasbank`.`kasbank_author` AS `kasbank_author`,
          `kasbank`.`kasbank_date_create` AS `kasbank_date_create`,
          `kasbank`.`kasbank_update` AS `kasbank_update`,
          `kasbank`.`kasbank_date_update` AS `kasbank_date_update`,
          `kasbank`.`kasbank_post` AS `kasbank_post`,
          `kasbank`.`kasbank_date_post` AS `kasbank_date_post`,
          `kasbank`.`kasbank_revised` AS `kasbank_revised`,
          `kasbank_detail`.`dkasbank_id` AS `dkasbank_id`,
          `kasbank_detail`.`dkasbank_master` AS `dkasbank_master`,
          `kasbank_detail`.`dkasbank_akun` AS `dkasbank_akun`,
          `kasbank_detail`.`dkasbank_detail` AS `dkasbank_detail`,
          `kasbank_detail`.`dkasbank_debet` AS `dkasbank_debet`,
          `kasbank_detail`.`dkasbank_kredit` AS `dkasbank_kredit`,
          `akun`.`akun_kode` AS `akun_kode`,
          `akun`.`akun_jenis` AS `akun_jenis`,
          `akun`.`akun_parent` AS `akun_parent`,
          `akun`.`akun_level` AS `akun_level`,
          `akun`.`akun_nama` AS `akun_nama`
     FROM (   (   `kasbank`
               JOIN
                  `kasbank_detail`
               ON ((`kasbank`.`kasbank_id` =
                       `kasbank_detail`.`dkasbank_master`)))
           JOIN
              `akun`
           ON ((`akun`.`akun_id` = `kasbank_detail`.`dkasbank_akun`)));