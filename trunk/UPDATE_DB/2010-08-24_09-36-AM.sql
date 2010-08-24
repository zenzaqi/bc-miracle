/*validasi sisa paket setelah diambil*/
UPDATE detail_jual_paket, vu_total_sisa_paket
SET detail_jual_paket.dpaket_sisa_paket = vu_total_sisa_paket.total_sisa_paket
WHERE detail_jual_paket.dpaket_id=vu_total_sisa_paket.dpaket_id;