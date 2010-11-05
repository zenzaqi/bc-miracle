/* UBAH STRUKTUR PHONEGROUPED */

ALTER TABLE `phonegrouped` CHANGE `phonegrouped_number` `phonegrouped_cust` INT( 11 ) NOT NULL 

/* UPDATE VIEW PHONEGROUP */
CREATE OR REPLACE VIEW `vu_phonegroup`
AS
   SELECT count(`phonegrouped`.`phonegrouped_cust`)
             AS `phonegroup_jumlah`,
          `phonegroup`.`phonegroup_id` AS `phonegroup_id`,
          `phonegroup`.`phonegroup_nama` AS `phonegroup_nama`,
          `phonegroup`.`phonegroup_detail` AS `phonegroup_detail`
     FROM (   `phonegroup`
           JOIN
              `phonegrouped`)
    WHERE (`phonegrouped`.`phonegrouped_group` =
              `phonegroup`.`phonegroup_id`)
   GROUP BY `phonegroup`.`phonegroup_id`,
            `phonegroup`.`phonegroup_nama`,
            `phonegroup`.`phonegroup_detail`;

/* UBAH STATUS AKTIF AKUN */
ALTER TABLE `akun` CHANGE `akun_aktif` `akun_aktif` ENUM( 'Aktif', 'Tidak Aktif' ) NOT NULL DEFAULT 'Aktif' 