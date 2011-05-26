/*UPDATE TABEL AKUN */
UPDATE akun
   SET akun_jenis = 'R/L'
 WHERE akun_jenis = 'RL';

/* VIEW JURNAL UMUM */

CREATE OR REPLACE VIEW `vu_jurnal`
AS
   SELECT `jurnal`.`jurnal_id` AS `jurnal_id`,
          `jurnal`.`jurnal_no` AS `jurnal_no`,
          `jurnal`.`jurnal_tanggal` AS `jurnal_tanggal`,
          `jurnal_detail`.`djurnal_akun` AS `djurnal_akun`,
          `jurnal_detail`.`djurnal_detail` AS `djurnal_detail`,
          `jurnal_detail`.`djurnal_debet` AS `djurnal_debet`,
          `jurnal_detail`.`djurnal_kredit` AS `djurnal_kredit`,
          `jurnal`.`jurnal_unit` AS `jurnal_unit`,
          `jurnal`.`jurnal_author` AS `jurnal_author`,
          `jurnal`.`jurnal_date_create` AS `jurnal_date_create`,
          `jurnal`.`jurnal_update` AS `jurnal_update`,
          `jurnal`.`jurnal_date_update` AS `jurnal_date_update`,
          `jurnal`.`jurnal_post` AS `jurnal_post`,
          `jurnal`.`jurnal_date_post` AS `jurnal_date_post`,
          `jurnal`.`jurnal_revised` AS `jurnal_revised`,
          `akun`.`akun_kode` AS `akun_kode`,
          `akun`.`akun_jenis` AS `akun_jenis`,
          `akun`.`akun_parent` AS `akun_parent`,
          `akun`.`akun_level` AS `akun_level`,
          `akun`.`akun_nama` AS `akun_nama`,
          `jurnal_detail`.`djurnal_master` AS `djurnal_master`,
          `jurnal_detail`.`djurnal_id` AS `djurnal_id`,
          `jurnal`.`jurnal_arsip` AS `jurnal_arsip`
     FROM (   (   `jurnal`
               JOIN
                  `jurnal_detail`
               ON ((`jurnal_detail`.`djurnal_master` = `jurnal`.`jurnal_id`)))
           JOIN
              `akun`
           ON ((`jurnal_detail`.`djurnal_akun` = `akun`.`akun_id`)));

/* VIEW KASBANK MASTER */
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

/* VIEW KASBANK DETAIL */
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
          `kasbank`.`kasbank_arsip` AS `kasbank_arsip`,
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

/* VIEW JURNAL KASBANK */
CREATE OR REPLACE VIEW `vu_jurnal_bank`
AS
   SELECT `vu_kasbank`.`kasbank_tanggal` AS `tanggal`,
          `vu_kasbank`.`kasbank_nobukti` AS `no_jurnal`,
          `vu_kasbank`.`kasbank_akun` AS `akun`,
          `vu_kasbank`.`akun_kode` AS `akun_kode`,
          `vu_kasbank`.`akun_nama` AS `akun_nama`,
          `vu_kasbank`.`kasbank_terimauntuk` AS `terimauntuk`,
          `vu_kasbank`.`kasbank_jenis` AS `jenis`,
          `vu_kasbank`.`kasbank_noref` AS `noref`,
          `vu_kasbank`.`kasbank_keterangan` AS `keterangan`,
          `vu_kasbank`.`kasbank_debet` AS `debet`,
          `vu_kasbank`.`kasbank_kredit` AS `kredit`,
          `vu_kasbank`.`kasbank_post` AS `post`,
          `vu_kasbank`.`kasbank_date_post` AS `post_date`,
          `vu_kasbank`.`kasbank_arsip` AS `kasbank_arsip`
     FROM `vu_kasbank`
   UNION
   SELECT `vu_kasbank_detail`.`kasbank_tanggal` AS `tanggal`,
          `vu_kasbank_detail`.`kasbank_nobukti` AS `no_jurnal`,
          `vu_kasbank_detail`.`dkasbank_akun` AS `akun`,
          `vu_kasbank_detail`.`akun_kode` AS `akun_kode`,
          `vu_kasbank_detail`.`akun_nama` AS `akun_nama`,
          `vu_kasbank_detail`.`kasbank_terimauntuk` AS `terimauntuk`,
          `vu_kasbank_detail`.`kasbank_jenis` AS `jenis`,
          `vu_kasbank_detail`.`kasbank_noref` AS `noref`,
          `vu_kasbank_detail`.`dkasbank_detail` AS `keterangan`,
          `vu_kasbank_detail`.`dkasbank_debet` AS `debet`,
          `vu_kasbank_detail`.`dkasbank_kredit` AS `kredit`,
          `vu_kasbank_detail`.`kasbank_post` AS `post`,
          `vu_kasbank_detail`.`kasbank_date_post` AS `post_date`,
          `vu_kasbank_detail`.`kasbank_arsip` AS `kasbank_arsip`
     FROM `vu_kasbank_detail`;

/* VIEW JURNAL HARIAN */
CREATE OR REPLACE VIEW `vu_jurnal_harian`
AS
   SELECT `vu_jurnal`.`jurnal_no` AS `no_jurnal`,
          `vu_jurnal`.`jurnal_tanggal` AS `tanggal`,
          `vu_jurnal`.`djurnal_akun` AS `akun`,
          `vu_jurnal`.`akun_kode` AS `akun_kode`,
          `vu_jurnal`.`akun_nama` AS `akun_nama`,
          `vu_jurnal`.`djurnal_detail` AS `keterangan`,
          `vu_jurnal`.`djurnal_debet` AS `debet`,
          `vu_jurnal`.`djurnal_kredit` AS `kredit`,
          `vu_jurnal`.`jurnal_post` AS `post`,
          `vu_jurnal`.`jurnal_date_post` AS `post_date`,
          `vu_jurnal`.`jurnal_arsip` AS `jurnal_arsip`
     FROM `vu_jurnal`
   UNION
   SELECT `vu_jurnal_bank`.`no_jurnal` AS `no_jurnal`,
          `vu_jurnal_bank`.`tanggal` AS `tanggal`,
          `vu_jurnal_bank`.`akun` AS `akun`,
          `vu_jurnal_bank`.`akun_kode` AS `akun_kode`,
          `vu_jurnal_bank`.`akun_nama` AS `akun_nama`,
          `vu_jurnal_bank`.`keterangan` AS `keterangan`,
          `vu_jurnal_bank`.`debet` AS `debet`,
          `vu_jurnal_bank`.`kredit` AS `kredit`,
          `vu_jurnal_bank`.`post` AS `post`,
          `vu_jurnal_bank`.`post_date` AS `post_date`,
          `vu_jurnal_bank`.`kasbank_arsip` AS `jurnal_arsip`
     FROM `vu_jurnal_bank`;
