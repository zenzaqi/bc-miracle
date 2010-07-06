ALTER TABLE `jual_cek` CHANGE `jcek_date_create` `jcek_date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `jual_kredit` CHANGE `jkredit_date_create` `jkredit_date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `jual_kwitansi` CHANGE `jkwitansi_date_create` `jkwitansi_date_create`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `jual_transfer` CHANGE `jtransfer_date_create` `jtransfer_date_create`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

ALTER TABLE `jual_tunai` CHANGE `jtunai_date_create` `jtunai_date_create` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ;

