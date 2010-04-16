ALTER TABLE `miracledb`.`detail_pakai_cabin` DROP PRIMARY KEY ,
ADD PRIMARY KEY ( `cabin_rawat` , `cabin_produk` , `cabin_dtrawat` ) ;