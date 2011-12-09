CREATE OR REPLACE VIEW `vu_detail_piutang_card` AS 
(select `detail_lunas_piutang`.`dpiutang_master` AS `dpiutang_master`,sum(`detail_lunas_piutang`.`dpiutang_nilai`) AS `piutang_card` 
from `detail_lunas_piutang` 
left join master_faktur_lunas_piutang on (fpiutang_nobukti=dpiutang_nobukti)
where (`detail_lunas_piutang`.`dpiutang_cara` = _latin1'card') and master_faktur_lunas_piutang.fpiutang_stat_dok <> 'Batal'
group by `detail_lunas_piutang`.`dpiutang_master`);

CREATE OR REPLACE VIEW `vu_detail_piutang_cek` AS 
(select `detail_lunas_piutang`.`dpiutang_master` AS `dpiutang_master`,sum(`detail_lunas_piutang`.`dpiutang_nilai`) AS `piutang_cek` 
from `detail_lunas_piutang` 
left join master_faktur_lunas_piutang on (fpiutang_nobukti=dpiutang_nobukti)
where (`detail_lunas_piutang`.`dpiutang_cara` = _latin1'cek/giro') 
and master_faktur_lunas_piutang.fpiutang_stat_dok <> 'Batal'
group by `detail_lunas_piutang`.`dpiutang_master`);

CREATE OR REPLACE VIEW `vu_detail_piutang_transfer` AS 
(select `detail_lunas_piutang`.`dpiutang_master` AS `dpiutang_master`,sum(`detail_lunas_piutang`.`dpiutang_nilai`) AS `piutang_transfer` 
from `detail_lunas_piutang` 
left join master_faktur_lunas_piutang on (fpiutang_nobukti=dpiutang_nobukti)
where (`detail_lunas_piutang`.`dpiutang_cara` = _latin1'transfer') 
and master_faktur_lunas_piutang.fpiutang_stat_dok <> 'Batal'
group by `detail_lunas_piutang`.`dpiutang_master`);

CREATE OR REPLACE VIEW `vu_detail_piutang_tunai` AS 
(select `detail_lunas_piutang`.`dpiutang_master` AS `dpiutang_master`,sum(`detail_lunas_piutang`.`dpiutang_nilai`) AS `piutang_tunai` 
from `detail_lunas_piutang` 
left join master_faktur_lunas_piutang on (fpiutang_nobukti=dpiutang_nobukti)
where (`detail_lunas_piutang`.`dpiutang_cara` = _latin1'tunai') 
and master_faktur_lunas_piutang.fpiutang_stat_dok <> 'Batal'
group by `detail_lunas_piutang`.`dpiutang_master`);