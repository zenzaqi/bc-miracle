CREATE OR REPLACE VIEW vu_tindakan AS

select `tindakan`.`trawat_id` AS `trawat_id`,`tindakan`.`trawat_cust` AS `trawat_cust`,`tindakan`.`trawat_keterangan` AS `trawat_keterangan`,`tindakan`.`trawat_creator` AS `trawat_creator`,`tindakan`.`trawat_update` AS `trawat_update`,`tindakan`.`trawat_date_update` AS `trawat_date_update`,`tindakan`.`trawat_revised` AS `trawat_revised`,`customer`.`cust_nama` AS `cust_nama`,`customer`.`cust_no` AS `cust_no`,`tindakan_detail`.`dtrawat_id` AS `dtrawat_id`,`tindakan_detail`.`dtrawat_perawatan` AS `dtrawat_perawatan`,`tindakan_detail`.`dtrawat_jam` AS `dtrawat_jam`,`tindakan_detail`.`dtrawat_jam_datang` AS `dtrawat_jam_datang`,

`tindakan_detail`.`dtrawat_jam_siap` AS `dtrawat_jam_siap`,
addtime(str_to_date(dtrawat_jam_siap, '%H:%i:%s'), concat('0:', perawatan.rawat_durasi, ':0')) AS est_jam_selesai,
`tindakan_detail`.`dtrawat_jam_selesai` AS `dtrawat_jam_selesai`,
`tindakan_detail`.`dtrawat_jam_batal` AS `dtrawat_jam_batal`,`tindakan_detail`.`dtrawat_tglapp` AS `dtrawat_tglapp`,`tindakan_detail`.`dtrawat_status` AS `dtrawat_status`,`tindakan_detail`.`dtrawat_keterangan` AS `dtrawat_keterangan`,`tindakan_detail`.`dtrawat_dapp` AS `dtrawat_dapp`,`tindakan_detail`.`dtrawat_master` AS `dtrawat_master`,`tindakan_detail`.`dtrawat_petugas2` AS `dtrawat_petugas2`,`tindakan_detail`.`dtrawat_ambil_paket` AS `dtrawat_ambil_paket`,`tindakan_detail`.`dtrawat_jumlah` AS `dtrawat_jumlah`,if((`tindakan_detail`.`dtrawat_locked` = 0),_utf8'Terbuka',_utf8'Tertutup') AS `dtrawat_edit`,`perawatan`.`rawat_nama` AS `rawat_nama`,`perawatan`.`rawat_harga` AS `rawat_harga`,`perawatan`.`rawat_du` AS `rawat_du`,`perawatan`.`rawat_dm` AS `rawat_dm`,`dokter`.`karyawan_nama` AS `dokter_nama`,`dokter`.`karyawan_id` AS `dokter_id`,`dokter`.`karyawan_username` AS `dokter_username`,`terapis`.`karyawan_nama` AS `terapis_nama`,`terapis`.`karyawan_id` AS `terapis_id`,`terapis`.`karyawan_username` AS `terapis_username`,`kategori`.`kategori_nama` AS `kategori_nama`,`tindakan_detail`.`dtrawat_jumlah` AS `jumlah`,`tindakan_detail`.`dtrawat_dpaket_id` AS `dtrawat_dpaket_id`,`paket`.`paket_nama` AS `paket_nama` 

from (((((((((`tindakan` 
join `customer` on((`tindakan`.`trawat_cust` = `customer`.`cust_id`))) 
join `tindakan_detail` on((`tindakan_detail`.`dtrawat_master` = `tindakan`.`trawat_id`))) 
left join `perawatan` on((`tindakan_detail`.`dtrawat_perawatan` = `perawatan`.`rawat_id`))) 
left join `karyawan` `dokter` on((`tindakan_detail`.`dtrawat_petugas1` = `dokter`.`karyawan_id`))) 
left join `karyawan` `terapis` on((`tindakan_detail`.`dtrawat_petugas2` = `terapis`.`karyawan_id`))) 
left join `kategori` on((`perawatan`.`rawat_kategori` = `kategori`.`kategori_id`))) 
left join `detail_jual_paket` on((`detail_jual_paket`.`dpaket_id` = `tindakan_detail`.`dtrawat_dpaket_id`))) 
left join `master_jual_paket` on((`master_jual_paket`.`jpaket_id` = `detail_jual_paket`.`dpaket_master`))) 
left join `paket` on((`detail_jual_paket`.`dpaket_paket` = `paket`.`paket_id`)))