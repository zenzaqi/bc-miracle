ALTER TABLE `produk`  ADD COLUMN `produk_aktif_cabang` VARCHAR(30) NULL DEFAULT '000000000000000000' AFTER `produk_update`;

ALTER TABLE `perawatan`  ADD COLUMN `rawat_aktif_cabang` VARCHAR(30) NULL DEFAULT '000000000000000000' AFTER `rawat_jumlah_tindakan`;