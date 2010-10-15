/* VIEW KAS/BANK GROUP */
CREATE OR REPLACE VIEW `vu_kasbank_group`
AS
   SELECT `kasbank_detail`.`dkasbank_master` AS `kasbank_master`,
          ifnull(sum(`kasbank_detail`.`dkasbank_debet`), 0)
             AS `kasbank_debet`,
          ifnull(sum(`kasbank_detail`.`dkasbank_kredit`), 0)
             AS `kasbank_kredit`
     FROM `kasbank_detail`
   GROUP BY `kasbank_detail`.`dkasbank_master`;

/* VIEW JURNAL_KASBANK */
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
          `vu_kasbank`.`kasbank_date_post` AS `post_date`
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
          `vu_kasbank_detail`.`kasbank_date_post` AS `post_date`
     FROM `vu_kasbank_detail`;

/* JURNAL UMUM */
DROP TABLE IF EXISTS jurnal_umum;

CREATE TABLE `jurnal` (
  `jurnal_id` int(11) NOT NULL AUTO_INCREMENT,
  `jurnal_no` varchar(30) DEFAULT NULL,
  `jurnal_tanggal` date DEFAULT NULL,
  `jurnal_keterangan` varchar(250) DEFAULT NULL,
  `jurnal_noref` varchar(50) DEFAULT NULL,
  `jurnal_unit` int(65) DEFAULT NULL,
  `jurnal_author` varchar(50) DEFAULT NULL,
  `jurnal_date_create` datetime DEFAULT NULL,
  `jurnal_update` varchar(255) DEFAULT NULL,
  `jurnal_date_update` datetime DEFAULT NULL,
  `jurnal_post` ENUM('T','Y') DEFAULT 'T',
  `jurnal_date_post` datetime DEFAULT NULL,
  `jurnal_arsip` ENUM('T','Y') DEFAULT 'T',
  `jurnal_revised` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`jurnal_id`),
  KEY `id_jurnal` (`jurnal_id`),
  KEY `ID_Unit` (`jurnal_author`),
  KEY `TransactionID` (`jurnal_noref`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

/* JURNAL UMUM DETAIL */

DROP TABLE IF EXISTS jurnal_umum_detail;

CREATE TABLE `jurnal_detail` (
  `djurnal_id` int(11) NOT NULL AUTO_INCREMENT,
  `djurnal_master` int(11) DEFAULT NULL,
  `djurnal_akun` int(11) DEFAULT NULL,
  `djurnal_detail` varchar(100) DEFAULT NULL,
  `djurnal_debet` double DEFAULT NULL,
  `djurnal_kredit` double DEFAULT NULL,
  PRIMARY KEY (`djurnal_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


/* BUKU BESAR */
DROP TABLE IF EXISTS buku_besar;

CREATE TABLE `buku_besar` (
  `buku_id` int(11) NOT NULL AUTO_INCREMENT,
  `buku_tanggal` datetime DEFAULT NULL,
  `buku_ref` varchar(50) DEFAULT NULL,
  `buku_akun` int(11) DEFAULT NULL,
  `buku_akun_kode` varchar(50) DEFAULT NULL,
  `buku_debet` double DEFAULT NULL,
  `buku_kredit` double DEFAULT NULL,
  `buku_author` varchar(50) DEFAULT NULL,
  `buku_date_create` datetime DEFAULT NULL,
  `buku_update` varchar(50) DEFAULT NULL,
  `buku_date_update` datetime DEFAULT NULL,
  `buku_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`buku_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

/* VIEW JURNAL UMUM */
DROP VIEW IF EXISTS `vu_jurnal_umum`;

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
          `jurnal_detail`.`djurnal_id` AS `djurnal_id`
     FROM (   (   `jurnal`
               JOIN
                  `jurnal_detail`
               ON ((`jurnal_detail`.`djurnal_master` = `jurnal`.`jurnal_id`)))
           JOIN
              `akun`
           ON ((`jurnal_detail`.`djurnal_akun` = `akun`.`akun_id`)));

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
          `vu_jurnal`.`jurnal_date_post` AS `post_date`
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
          `vu_jurnal_bank`.`post_date` AS `post_date`
     FROM `vu_jurnal_bank`;

/* VIEW BUKU BESAR */
CREATE OR REPLACE VIEW `vu_buku_besar`
AS
   SELECT `buku_besar`.`buku_id` AS `buku_id`,
          `buku_besar`.`buku_tanggal` AS `buku_tanggal`,
          `buku_besar`.`buku_ref` AS `buku_ref`,
          `buku_besar`.`buku_akun` AS `buku_akun`,
          `buku_besar`.`buku_debet` AS `buku_debet`,
          `buku_besar`.`buku_kredit` AS `buku_kredit`,
          `buku_besar`.`buku_author` AS `buku_author`,
          `buku_besar`.`buku_date_create` AS `buku_date_create`,
          `buku_besar`.`buku_update` AS `buku_update`,
          `buku_besar`.`buku_date_update` AS `buku_date_update`,
          `buku_besar`.`buku_revised` AS `buku_revised`,
          `akun`.`akun_id` AS `akun_id`,
          `akun`.`akun_parent_kode` AS `akun_parent_kode`,
          `akun`.`akun_kode` AS `akun_kode`,
          `akun`.`akun_jenis` AS `akun_jenis`,
          `akun`.`akun_parent` AS `akun_parent`,
          `akun`.`akun_level` AS `akun_level`,
          `akun`.`akun_nama` AS `akun_nama`,
          `akun`.`akun_debet` AS `akun_debet`,
          `akun`.`akun_kredit` AS `akun_kredit`,
          `akun`.`akun_saldo` AS `akun_saldo`
     FROM (   `buku_besar`
           JOIN
              `akun`
           ON ((`buku_besar`.`buku_akun` =
                   `akun`.`akun_id`)));
