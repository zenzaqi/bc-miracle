DROP TABLE jurnal;

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
);

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

