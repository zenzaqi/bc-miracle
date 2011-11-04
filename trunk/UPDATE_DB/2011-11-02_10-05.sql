/*untuk master Group 1, menambah diskon Promo*/

ALTER TABLE `produk_group`  ADD COLUMN `group_dpromo` INT(11) NULL DEFAULT NULL AFTER `group_dstaffnondokter`;
ALTER TABLE `produk`  ADD COLUMN `produk_dpromo` INT(11) NULL DEFAULT NULL AFTER `produk_dstaffnondokter`;
ALTER TABLE `paket`  ADD COLUMN `paket_dpromo` INT(11) NULL DEFAULT NULL AFTER `paket_dstaffnondokter`;
ALTER TABLE `perawatan`  ADD COLUMN `rawat_dpromo` INT(11) NULL DEFAULT NULL AFTER `rawat_dstaffnondokter`;