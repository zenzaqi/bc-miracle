/*menambah field untuk tanggal nilai saldo awal*/
ALTER TABLE `produk`  ADD COLUMN `produk_tgl_nilai_saldo_awal` DATE NULL DEFAULT NULL AFTER `produk_nilai_saldo_awal`