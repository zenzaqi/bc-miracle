/*Jalankan query ini utk mengganti no_ref yang menyimpan PK dari detail_mutasi_racikan menjadi menyimpan PK dari mutasi_id.. 
Query ini harus dijalankan agar laporan mutasi barang produk racikan menjadi valid..
*/


UPDATE detail_mutasi_racikan c
LEFT JOIN detail_mutasi_racikan d on (c.dmracikan_noref = d.dmracikan_id)
set c.dmracikan_noref = d.dmracikan_mutasi_id
where c.dmracikan_jenis = 1