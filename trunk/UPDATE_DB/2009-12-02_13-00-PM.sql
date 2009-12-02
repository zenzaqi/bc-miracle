CREATE TABLE `miracledb`.`absensi` (
`absensi_id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
`absensi_nik` VARCHAR( 25 ) NOT NULL ,
`absensi_tgl` DATE NOT NULL ,
`absensi_shift` ENUM( 'P', 'S', 'M', 'OFF' ) NOT NULL DEFAULT 'OFF',
`absensi_creator` VARCHAR( 50 ) NULL ,
`absensi_date_create` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ,
PRIMARY KEY ( `absensi_id` )
) ENGINE = MYISAM ;

CREATE TABLE `miracledb`.`report_tindakan` (
`reportt_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`reportt_nik` VARCHAR( 25 ) NOT NULL ,
`reportt_bln` DATE NULL ,
`reportt_jmltindakan` INT( 11 ) NULL
) ENGINE = MYISAM ;