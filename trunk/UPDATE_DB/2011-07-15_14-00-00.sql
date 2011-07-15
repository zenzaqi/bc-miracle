ALTER TABLE `karyawan` ADD `karyawan_ktp` VARCHAR( 30 ) NOT NULL AFTER `karyawan_nama` ,
ADD `karyawan_alamat_ktp` VARCHAR( 250 ) NOT NULL AFTER `karyawan_ktp`;

ALTER TABLE `karyawan` ADD `karyawan_agama` ENUM( 'Kristen', 'Katholik', 'Islam', 'Budha', 'Hindu', 'Kong Hu Chu' ) NOT NULL AFTER `karyawan_kelamin`;

ALTER TABLE `karyawan` ADD `karyawan_jamsostek` VARCHAR( 30 ) NOT NULL AFTER `karyawan_atasan` ,
ADD `karyawan_bank` INT( 11 ) NOT NULL AFTER `karyawan_jamsostek` ,
ADD `karyawan_bank_cabang` VARCHAR( 50 ) NOT NULL AFTER `karyawan_bank` ,
ADD `karyawan_rekening` VARCHAR( 30 ) NOT NULL AFTER `karyawan_bank_cabang` ,
ADD `karyawan_atasnama` VARCHAR( 50 ) NOT NULL AFTER `karyawan_rekening` ;

ALTER TABLE `karyawan` ADD `karyawan_jmlanak` INT( 11 ) NOT NULL AFTER `karyawan_marriage` ;

CREATE TABLE IF NOT EXISTS `karyawan_cuti` (
  `kcuti_id` int(10) NOT NULL AUTO_INCREMENT,
  `kcuti_master` int(10) DEFAULT '0',
  `kcuti_jenis` varchar(50) DEFAULT NULL,
  `kcuti_tglawal` date DEFAULT NULL,
  `kcuti_tglakhir` date DEFAULT NULL,
  `kcuti_jmlhari` int(11) DEFAULT NULL,
  `kcuti_tglpengajuan` date DEFAULT NULL,
  `kcuti_keterangan` varchar(100) DEFAULT NULL,
  `kcuti_creator` varchar(30) DEFAULT NULL,
  `kcuti_date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `kcuti_update` varchar(30) DEFAULT NULL,
  `kcuti_date_update` datetime DEFAULT NULL,
  `kcuti_revised` int(11) DEFAULT '0',
  PRIMARY KEY (`kcuti_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `karyawan_fasilitas` (
  `kfasilitas_id` int(11) NOT NULL AUTO_INCREMENT,
  `kfasilitas_master` int(11) NOT NULL DEFAULT '0',
  `kfasilitas_item` varchar(50) DEFAULT NULL,
  `kfasilitas_tglserahterima` date DEFAULT NULL,
  `kfasilitas_keterangan` varchar(500) DEFAULT NULL,
  `kfasilitas_creator` varchar(30) DEFAULT NULL,
  `kfasilitas_date_creator` timestamp NULL DEFAULT NULL,
  `kfasilitas_update` varchar(30) DEFAULT NULL,
  `kfasilitas_date_update` datetime DEFAULT NULL,
  `kfasilitas_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`kfasilitas_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `karyawan_gantioff` (
  `kgantioff_id` int(11) NOT NULL AUTO_INCREMENT,
  `kgantioff_master` int(11) NOT NULL,
  `kgantioff_jenis` enum('Ganti Off') DEFAULT NULL,
  `kgantioff_tglawal` date DEFAULT NULL,
  `kgantioff_tglakhir` date DEFAULT NULL,
  `kgantioff_jmlhari` int(11) DEFAULT NULL,
  `kgantioff_tglgantiawal` date DEFAULT NULL,
  `kgantioff_tglgantiakhir` date DEFAULT NULL,
  `kgantioff_tglpengajuan` date DEFAULT NULL,
  `kgantioff_keterangan` varchar(500) DEFAULT NULL,
  `kgantioff_creator` varchar(30) DEFAULT NULL,
  `kgantioff_date_create` datetime DEFAULT NULL,
  `kgantioff_update` varchar(30) DEFAULT NULL,
  `kgantioff_date_update` datetime DEFAULT NULL,
  `kgantioff_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`kgantioff_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `karyawan_jabatan` (
  `kjabatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kjabatan_master` int(11) NOT NULL,
  `kjabatan_departemen` int(11) DEFAULT NULL,
  `kjabatan_jabatan` int(11) DEFAULT NULL,
  `kjabatan_golongan` varchar(45) DEFAULT NULL,
  `kjabatan_pph21` enum('TK','K','K/1','K/2','TK/1','TK/2','TK/3') DEFAULT NULL,
  `kjabatan_atasan` int(11) DEFAULT NULL,
  `kjabatan_tglawal` date DEFAULT NULL,
  `kjabatan_tglakhir` date DEFAULT NULL,
  `kjabatan_keterangan` varchar(500) DEFAULT NULL,
  `kjabatan_creator` varchar(30) DEFAULT NULL,
  `kjabatan_date_create` timestamp NULL DEFAULT NULL,
  `kjabatan_update` varchar(30) DEFAULT NULL,
  `kjabatan_date_update` datetime DEFAULT NULL,
  `kjabatan_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`kjabatan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `karyawan_keluarga` (
  `kkeluarga_id` int(11) NOT NULL AUTO_INCREMENT,
  `kkeluarga_master` int(11) NOT NULL,
  `kkeluarga_nama` varchar(50) DEFAULT NULL,
  `kkeluarga_hubungan` enum('Suami/Istri','Anak') DEFAULT NULL,
  `kkeluarga_keterangan` varchar(500) DEFAULT NULL,
  `kkeluarga_creator` varchar(30) DEFAULT NULL,
  `kkeluarga_date_create` timestamp NULL DEFAULT NULL,
  `kkeluarga_update` varchar(30) DEFAULT NULL,
  `kkeluarga_date_update` datetime DEFAULT NULL,
  `kkeluarga_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`kkeluarga_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `karyawan_medical` (
  `kmedical_id` int(11) NOT NULL AUTO_INCREMENT,
  `kmedical_master` int(11) NOT NULL DEFAULT '0',
  `kmedical_tujuan` enum('Diri Sendiri','Istri','Anak') DEFAULT NULL,
  `kmedical_jenis_rawat` enum('Rawat Jalan','Rawat Inap') DEFAULT NULL,
  `kmedical_jenis_klaim` enum('Umum','Spesialis','Frame','Lensa','Lain-lain') DEFAULT NULL,
  `kmedical_jumlah` int(11) DEFAULT NULL,
  `kmedical_total` float DEFAULT NULL,
  `kmedical_tglpengajuan` date DEFAULT NULL,
  `kmedical_keterangan` varchar(500) DEFAULT NULL,
  `kmedical_creator` varchar(30) DEFAULT NULL,
  `kmedical_date_create` timestamp NULL DEFAULT NULL,
  `kmedical_update` varchar(30) DEFAULT NULL,
  `kmedical_date_update` datetime DEFAULT NULL,
  `kmedical_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`kmedical_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `karyawan_pendidikan` (
  `kpendidikan_id` int(11) NOT NULL AUTO_INCREMENT,
  `kpendidikan_master` int(11) NOT NULL,
  `kpendidikan_pendidikan` varchar(45) DEFAULT NULL,
  `kpendidikan_sekolah` varchar(100) DEFAULT NULL,
  `kpendidikan_jurusan` varchar(50) DEFAULT NULL,
  `kpendidikan_thnmasuk` int(4) DEFAULT NULL,
  `kpendidikan_thnselesai` int(4) DEFAULT NULL,
  `kpendidikan_wisuda` int(4) DEFAULT NULL,
  `kpendidikan_keterangan` varchar(500) DEFAULT NULL,
  `kpendidikan_creator` varchar(30) DEFAULT NULL,
  `kpendidikan_date_create` timestamp NULL DEFAULT NULL,
  `kpendidikan_update` varchar(30) DEFAULT NULL,
  `kpendidikan_date_update` datetime DEFAULT NULL,
  `kpendidikan_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`kpendidikan_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `karyawan_status` (
  `kstatus_id` int(11) NOT NULL AUTO_INCREMENT,
  `kstatus_master` int(11) NOT NULL,
  `kstatus_karyawan` enum('Percobaan','Kontrak I','Kontrak II','Tetap','Lain-lain','Tidak Aktif') DEFAULT NULL,
  `kstatus_tglawal` date DEFAULT NULL,
  `kstatus_tglakhir` date DEFAULT NULL,
  `kstatus_keterangan` varchar(500) DEFAULT NULL,
  `kstatus_creator` varchar(30) DEFAULT NULL,
  `kstatus_date_create` timestamp NULL DEFAULT NULL,
  `kstatus_update` varchar(30) DEFAULT NULL,
  `kstatus_date_update` datetime DEFAULT NULL,
  `kstatus_revised` int(11) DEFAULT NULL,
  PRIMARY KEY (`kstatus_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


