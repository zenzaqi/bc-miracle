/*menambah field inbox_status*/

ALTER TABLE `inbox`  ADD COLUMN `inbox_status` ENUM('Show','Hide','Replied') NULL DEFAULT 'Show' AFTER `inbox_revised`;

/*mengganti status yang kosong menjadi show*/

update inbox set inbox_status = 'Show' where inbox_status=''