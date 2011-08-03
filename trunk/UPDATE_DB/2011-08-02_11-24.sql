# --------------------------------------------------------
# Host:                         127.0.0.1
# Database:                     miracledbyyy
# Server version:               5.1.33-community
# Server OS:                    Win32
# HeidiSQL version:             5.0.0.3272
# Date/time:                    2011-08-02 11:02:42
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping structure for trigger miracledbyyy.cust_generate_id2
SET SESSION SQL_MODE='';
DELIMITER //
CREATE TRIGGER `cust_generate_id2` BEFORE INSERT ON `customer` FOR EACH ROW BEGIN
	DECLARE digit_cabang varchar(15);	
	DECLARE pattern varchar(15);
	DECLARE max_keys varchar(50);
	DECLARE pad varchar(15);
	DECLARE kode varchar(15);
	declare i tinyint default 0;
	DECLARE digit_cabang_q varchar(15);
	
	set digit_cabang = (select cabang.cabang_value from info join cabang on cabang.cabang_id=info.info_cabang) + '.';
	if length(digit_cabang) = 1 then 
		set digit_cabang = concat('0',digit_cabang); 
	end if;
	
	set digit_cabang_q = concat(digit_cabang,'%');
	
	set max_keys=(select concat(left(max(cust_id2),3),LPAD((right(max(cust_id2),6)+1),6,0)) from customer where cust_id2 like digit_cabang_q);
		
	if max_keys is not null then
		begin
		set kode = max_keys;
		if kode is null then
			set pad = "";
	
			while (i < 5) do 
				set pad= concat(pad,'0');
				set i = i + 1;
			end while;
				set kode=concat(digit_cabang ,'.' , pad ,1);
		end if;
		end;
	else 
		begin
			set pad = "";
	
			while (i < 5) do 
				set pad=concat(pad,'0');
				set i = i + 1;
			end while;
				set kode=concat(digit_cabang ,'.' , pad ,1);
		end;
	end if;
	
		set new.cust_id2 = kode;
END//
DELIMITER ;
SET SESSION SQL_MODE=@OLD_SQL_MODE;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
