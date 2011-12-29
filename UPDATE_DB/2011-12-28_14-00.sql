ALTER TABLE `detail_jual_paket`  ADD COLUMN `dpaket_isi_paket` SMALLINT(3) NOT NULL DEFAULT '0' AFTER `dpaket_jumlah`;

update detail_jual_paket dj
left join vu_jumlah_isi_paket v on v.paket_id = dj.dpaket_paket
set dj.dpaket_isi_paket = v.isi_paket;