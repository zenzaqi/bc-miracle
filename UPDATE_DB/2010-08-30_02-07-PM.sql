update master_lunas_piutang
SET lpiutang_sisa=lpiutang_total
WHERE lpiutang_sisa is null;