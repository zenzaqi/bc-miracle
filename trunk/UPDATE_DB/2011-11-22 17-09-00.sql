ALTER TABLE `sr_setup`  CHANGE COLUMN `setsr_jenis` `setsr_jenis` ENUM('Kunjungan','Kunjungan Pria','Kunjungan Wanita','Customer Lama','Customer Baru','Member Baru','Perawatan Medis (Rp)','Perawatan Medis (Qty)','Perawatan Non Medis (Rp)','Perawatan Non Medis (Qty)','Produk (Qty)','Produk (Rp)','Jum Hari Kerja') NOT NULL AFTER `setsr_tahun`;