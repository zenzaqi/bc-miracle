/* TABLE JURNAL KAS/BANK */
CREATE TABLE `kasbank` (
  `kasbank_id` int(11) NOT NULL AUTO_INCREMENT,
  `kasbank_tanggal` datetime DEFAULT NULL,
  `kasbank_nobukti` varchar(50) DEFAULT NULL,
  `kasbank_akun` int(11) DEFAULT NULL,
  `kasbank_terimauntuk` varchar(250) DEFAULT NULL,
  `kasbank_jenis` ENUM('keluar','masuk') DEFAULT 'keluar',
  `kasbank_noref` varchar(50) DEFAULT NULL,
  `kasbank_keterangan` varchar(250) DEFAULT NULL,
  `kasbank_author` varchar(50) DEFAULT NULL,
  `kasbank_date_create` datetime DEFAULT NULL,
  `kasbank_update` varchar(50) DEFAULT NULL,
  `kasbank_date_update` datetime DEFAULT NULL,
  `kasbank_post` ENUM('T','Y') DEFAULT 'T',
  `kasbank_date_post` datetime DEFAULT NULL,
  `kasbank_arsip` ENUM('T','Y') DEFAULT 'T',
  `kasbank_revised` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`kasbank_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/* TABLE JURNAL KAS/BANK DETAIL */
CREATE TABLE `kasbank_detail` (
  `dkasbank_id` int(11) NOT NULL AUTO_INCREMENT,
  `dkasbank_master` int(11) DEFAULT NULL,
  `dkasbank_akun` int(11) DEFAULT NULL,
  `dkasbank_detail` varchar(250) DEFAULT NULL,
  `dkasbank_debet` double DEFAULT NULL,
  `dkasbank_kredit` double DEFAULT NULL,
  PRIMARY KEY (`dkasbank_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/* VIEW DETAIL JURNAL KAS/BANK */
CREATE OR REPLACE VIEW vu_kasbank_detail
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
     FROM ((   (   `kasbank`
                JOIN
                   `kasbank_detail`
                ON ((`kasbank`.`kasbank_id` =
                        `kasbank_detail`.`dkasbank_master`)))
            JOIN
               `akun`
            ON ((`akun`.`akun_id` = `kasbank_detail`.`dkasbank_akun`))));

/* VIEW DETAIL GROUP KAS/BANK */
CREATE OR REPLACE VIEW vu_kasbank_group
AS
   SELECT `kasbank_detail`.`dkasbank_master` AS `kasbank_master`,
          ifnull(sum(`kasbank_detail`.`dkasbank_debet`), 0)
             AS `kasbank_debet`,
          ifnull(sum(`kasbank_detail`.`dkasbank_kredit`), 0)
             AS `kasbank_kredit`
     FROM `kasbank_detail`
   GROUP BY `kasbank_detail`.`dkasbank_master`;

/*VIEW KAS/BANK MASTER */
CREATE OR REPLACE VIEW vu_kasbank
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
          `akun`.`akun_jenis` AS `akun_jenis`
     FROM ((   (   `kasbank`
                JOIN
                   `vu_kasbank_group`
                ON ((`kasbank`.`kasbank_id` =
                        `vu_kasbank_group`.`kasbank_master`)))
            JOIN
               `akun`
            ON ((`kasbank`.`kasbank_akun` = `akun`.`akun_id`))));

/* EDIT MENU */
ALTER TABLE `menus` ADD `menu_kode` VARCHAR( 20 ) NULL AFTER `menu_id` ;
