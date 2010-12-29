ALTER TABLE `customer`  ADD COLUMN `cust_referensilaintemp` VARCHAR(255) NULL DEFAULT NULL AFTER `cust_referensilain`,  CHANGE COLUMN `cust_profesi` `cust_profesi` ENUM('Pelajar / Mahasiswa','Ibu Rumah Tangga','Karyawan / Swasta','Wiraswasta','Profesional','Selebritis','Lain-lain') NULL DEFAULT NULL AFTER `cust_keterangan`;

update customer c
set c.cust_referensilaintemp = c.cust_referensilain;

ALTER TABLE `customer`  COMMENT='',  CHANGE COLUMN `cust_referensilain` `cust_referensilain` ENUM('Lewat', 'Billboard','Keluarga','Teman','Dokter klinik','Miracle cabang lain','Staff','Event','Koran','Brosur','Majalah','Senam','Radio') NULL DEFAULT NULL AFTER `cust_referensi`;
