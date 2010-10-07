/*---- MAPPING KODE AKUN ---------------------*/

CREATE TABLE `akun_map` (
  `map_id` int(11) NOT NULL AUTO_INCREMENT,
  `map_kategori` varchar(50) NOT NULL,
  `map_nama` varchar(50) NOT NULL,
  `map_akun` int(11) DEFAULT NULL,
  `map_akun_kode` varchar(20) DEFAULT NULL,
  `map_jenis` ENUM('Detail','Master') DEFAULT 'Detail',
  `map_aktif` ENUM('Tidak','Ya') NOT NULL DEFAULT 'Ya',
  `map_author` varchar(50) DEFAULT NULL,
  `map_date_create` timestamp NULL DEFAULT NULL,
  `map_update` varchar(50) DEFAULT NULL,
  `map_date_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `map_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`map_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE OR REPLACE VIEW `vu_akun_map`
AS
   SELECT `akun_map`.`map_id` AS `map_id`,
          `akun_map`.`map_kategori` AS `map_kategori`,
          `akun_map`.`map_nama` AS `map_nama`,
          `akun_map`.`map_akun` AS `map_akun`,
          `akun_map`.`map_akun_kode` AS `map_akun_kode`,
          `akun_map`.`map_aktif` AS `map_aktif`,
          `akun_map`.`map_author` AS `map_author`,
          `akun_map`.`map_date_create` AS `map_date_create`,
          `akun_map`.`map_update` AS `map_update`,
          `akun_map`.`map_date_update` AS `map_date_update`,
          `akun_map`.`map_revised` AS `map_revised`,
          `akun`.`akun_parent_kode` AS `akun_parent_kode`,
          `akun`.`akun_kode` AS `akun_kode`,
          `akun`.`akun_jenis` AS `akun_jenis`,
          `akun`.`akun_parent` AS `akun_parent`,
          `akun`.`akun_level` AS `akun_level`,
          `akun`.`akun_nama` AS `akun_nama`,
          `akun`.`akun_id` AS `akun_id`
     FROM (   `akun`
           JOIN
              `akun_map`
           ON ((`akun_map`.`map_akun` =
                   `akun`.`akun_id`)));