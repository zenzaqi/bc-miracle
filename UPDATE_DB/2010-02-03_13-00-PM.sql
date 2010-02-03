ALTER TABLE `absensi` ADD `absensi_karyawan_id` INT( 11 ) NOT NULL AFTER `absensi_id`;

ALTER TABLE `miracledb`.`absensi` DROP PRIMARY KEY ,
ADD PRIMARY KEY ( `absensi_id` , `absensi_karyawan_id` , `absensi_tgl` );