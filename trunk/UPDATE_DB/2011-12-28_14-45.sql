/*Menambahkan total jumlah isi paket*/
ALTER TABLE `detail_jual_paket`  ADD COLUMN `dpaket_isi_paket` SMALLINT(3) NOT NULL DEFAULT '0' AFTER `dpaket_jumlah`;