/* CREATE OR REPLACE VIEW VU_JURNAL_KASBANK */
CREATE OR REPLACE VIEW `vu_jurnal_bank`
AS
   SELECT `vu_kasbank`.`kasbank_id` AS `kasbank_id`,
          `vu_kasbank`.`kasbank_tanggal` AS `tanggal`,
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
   SELECT `vu_kasbank_detail`.`kasbank_id` AS `kasbank_id`,
          `vu_kasbank_detail`.`kasbank_tanggal` AS `tanggal`,
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