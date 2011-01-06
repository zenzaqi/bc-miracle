-- supaya di tindakan nantinya bisa memilih paket secara manual

ALTER TABLE `tindakan_detail` ADD `dtrawat_dpaket_id` INT( 11 ) NOT NULL AFTER `dtrawat_ambil_paket` 