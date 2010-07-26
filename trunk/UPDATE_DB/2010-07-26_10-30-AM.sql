CREATE OR REPLACE VIEW `vu_detail_ambil_paket_rawat`
AS
   SELECT `detail_ambil_paket`.`dapaket_id` AS `dapaket_id`,
          date_format(`detail_ambil_paket`.`dapaket_date_create`,
                      '%Y-%m-%d')
             AS `tanggal`,
          `perawatan`.`rawat_nama` AS `rawat_nama`,
          `perawatan`.`rawat_kode` AS `rawat_kode`,
          `perawatan`.`rawat_id` AS `rawat_id`,
          `detail_ambil_paket`.`dapaket_jumlah`
             AS `dapaket_jumlah`,
          `pemakai`.`cust_nama` AS `pemakai_nama`,
          if(
             (isnull(`terapis`.`karyawan_username`)
              AND isnull(`dokter`.`karyawan_username`)),
             `referal`.`karyawan_username`,
             if(
                (`tindakan_detail`.`dtrawat_petugas1` = 0),
                if((`tindakan_detail`.`dtrawat_petugas2` = 0),
                   NULL,
                   `terapis`.`karyawan_username`),
                `dokter`.`karyawan_username`))
             AS `referal`,
          `detail_ambil_paket`.`dapaket_stat_dok`
             AS `dapaket_stat_dok`,
          `master_jual_paket`.`jpaket_cust` AS `jpaket_cust`,
          `customer`.`cust_id` AS `cust_id`,
          `master_jual_paket`.`jpaket_tanggal` AS `tanggal_beli`,
          `master_jual_paket`.`jpaket_nobukti` AS `no_bukti`,
          `customer`.`cust_no` AS `cust_no`,
          `customer`.`cust_nama` AS `cust_nama`,
          `paket`.`paket_kode` AS `paket_kode`,
          `paket`.`paket_nama` AS `paket_nama`,
          `detail_ambil_paket`.`dapaket_paket` AS `dapaket_paket`,
          `master_jual_paket`.`jpaket_stat_dok`
             AS `jpaket_stat_dok`
     FROM (   (   (   (   (   (   (   (   (   
                                              `detail_ambil_paket`
                                           JOIN
                                              `master_jual_paket`
                                           ON ((
                                                `master_jual_paket`.
                                                `jpaket_id` =
                                                   
                                                   `detail_ambil_paket`.
                                                   `dapaket_jpaket`)))
                                       JOIN
                                          `customer`
                                       ON ((`master_jual_paket`.
                                            `jpaket_cust` =
                                               `customer`.
                                               `cust_id`)))
                                   JOIN
                                      `paket`
                                   ON ((`detail_ambil_paket`.
                                        `dapaket_paket` =
                                           `paket`.`paket_id`)))
                               LEFT JOIN
                                  `perawatan`
                               ON ((`detail_ambil_paket`.
                                    `dapaket_item` =
                                       `perawatan`.`rawat_id`)))
                           LEFT JOIN
                              `customer` `pemakai`
                           ON ((`detail_ambil_paket`.
                                `dapaket_cust` = `pemakai`.`cust_id`)))
                       LEFT JOIN
                          `tindakan_detail`
                       ON ((`detail_ambil_paket`.
                            `dapaket_dtrawat` =
                               `tindakan_detail`.`dtrawat_id`)))
                   LEFT JOIN
                      `karyawan` `dokter`
                   ON ((`tindakan_detail`.`dtrawat_petugas1` =
                           `dokter`.`karyawan_id`)))
               LEFT JOIN
                  `karyawan` `terapis`
               ON ((`tindakan_detail`.`dtrawat_petugas2` =
                       `terapis`.`karyawan_id`)))
           LEFT JOIN
              `karyawan` `referal`
           ON ((`detail_ambil_paket`.`dapaket_referal` =
                   `referal`.`karyawan_id`)))
   ORDER BY `detail_ambil_paket`.`dapaket_date_create` DESC;