/*menambah field untuk kredit pada grup*/

ALTER TABLE `produk_group`  ADD COLUMN `group_kredit` INT(11) NOT NULL AFTER `group_aktif`