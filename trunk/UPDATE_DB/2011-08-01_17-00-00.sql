ALTER TABLE `karyawan_medical` ADD `kmedical_tglkuitansi` DATE NULL AFTER `kmedical_total`;

ALTER TABLE `karyawan_keluarga` CHANGE `kkeluarga_hubungan` `kkeluarga_hubungan` ENUM( 'Suami', 'Istri', 'Anak', 'Bapak', 'Ibu', 'Saudara' ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
