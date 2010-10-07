/*---- TABEL AKUN ----------------*/

CREATE TABLE `akun` (
  `akun_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `akun_parent_kode` varchar(50) DEFAULT NULL,
  `akun_kode` varchar(50) DEFAULT NULL,
  `akun_jenis` varchar(255) DEFAULT NULL,
  `akun_parent` smallint(6) DEFAULT NULL,
  `akun_level` smallint(6) DEFAULT NULL,
  `akun_nama` varchar(255) NOT NULL,
  `akun_debet` double DEFAULT NULL,
  `akun_kredit` double DEFAULT NULL,
  `akun_saldo` ENUM('Debet','Kredit') DEFAULT NULL,
  `akun_aktif` ENUM('T','Y') DEFAULT 'Y',
  `akun_creator` varchar(50) DEFAULT NULL,
  `akun_date_create` datetime DEFAULT NULL,
  `akun_update` varchar(50) DEFAULT NULL,
  `akun_date_update` datetime DEFAULT NULL,
  `akun_revised` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`akun_id`),
  KEY `kode_akun` (`akun_kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE OR REPLACE VIEW `vu_akun`
AS
   SELECT `akun`.`akun_id` AS `akun_id`,
          `akun`.`akun_kode` AS `akun_kode`,
          `akun`.`akun_jenis` AS `akun_jenis`,
          `akun`.`akun_parent` AS `akun_parent`,
          `akun_parent`.`akun_id` AS `parent_d`,
          `akun_parent`.`akun_kode` AS `parent_kode`,
          `akun_parent`.`akun_jenis` AS `parent_jenis`,
          `akun_parent`.`akun_nama` AS `parent_nama`,
          `akun_parent`.`akun_level` AS `parent_level`,
          `akun`.`akun_level` AS `akun_level`,
          `akun`.`akun_nama` AS `akun_nama`,
          `akun`.`akun_debet` AS `akun_debet`,
          `akun`.`akun_kredit` AS `akun_kredit`,
          `akun`.`akun_saldo` AS `akun_saldo`,
          `akun`.`akun_aktif` AS `akun_aktif`,
          `akun`.`akun_creator` AS `akun_creator`,
          `akun`.`akun_date_create` AS `akun_date_create`,
          `akun`.`akun_update` AS `akun_update`,
          `akun`.`akun_date_update` AS `akun_date_update`
     FROM (   `akun`
           LEFT JOIN
              `akun` `akun_parent`
           ON ((`akun`.`akun_parent` = `akun_parent`.`akun_id`)));