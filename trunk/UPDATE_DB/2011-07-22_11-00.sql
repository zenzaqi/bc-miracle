CREATE OR REPLACE VIEW `vu_karyawan` AS
select
	karyawan.karyawan_id as karyawan_id, karyawan.karyawan_no as karyawan_no, 
	karyawan.karyawan_npwp as karyawan_npwp, karyawan.karyawan_sip as karyawan_sip,
	karyawan.karyawan_username as karyawan_username, karyawan.karyawan_nama as karyawan_nama,
	karyawan.karyawan_ktp as karyawan_ktp, karyawan.karyawan_alamat_ktp as karyawan_alamat_ktp,
	karyawan.karyawan_kelamin as karyawan_kelamin, karyawan.karyawan_agama as karyawan_agama,
	karyawan.karyawan_pph21 as karyawan_pph21, karyawan.karyawan_marriage as karyawan_marriage,
	karyawan.karyawan_jmlanak as karyawan_jmlanak, karyawan.karyawan_tgl_batas as karyawan_tgl_batas,
	karyawan.karyawan_tgllahir as karyawan_tgllahir, karyawan.karyawan_tmplahir as karyawan_tmplahir,
	karyawan.karyawan_alamat as karyawan_alamat, karyawan.karyawan_kota as karyawan_kota,
	karyawan.karyawan_kodepos as karyawan_kodepos, karyawan.karyawan_email as karyawan_email,
	karyawan.karyawan_emiracle as karyawan_emiracle, karyawan.karyawan_keterangan as karyawan_keterangan,
	karyawan.karyawan_notelp as karyawan_notelp, karyawan.karyawan_notelp2 as karyawan_notelp2,
	karyawan.karyawan_notelp3 as karyawan_notelp3, karyawan.karyawan_notelp4 as karyawan_notelp4,
	karyawan.karyawan_cabang as karyawan_cabang, 
	(select kjabatan_jabatan from karyawan_jabatan where kjabatan_master = karyawan_id order by kjabatan_tglakhir desc LIMIT 0,1) as karyawan_jabatan,
	(select kjabatan_departemen from karyawan_jabatan where kjabatan_master = karyawan_id order by kjabatan_tglakhir desc LIMIT 0,1) as karyawan_departemen,
	karyawan.karyawan_idgolongan as karyawan_idgolongan,
	karyawan.karyawan_tglmasuk as karyawan_tglmasuk, karyawan.karyawan_atasan as karyawan_atasan,
	karyawan.karyawan_jamsostek as karyawan_jamsostek, karyawan.karyawan_bank as karyawan_bank,
	karyawan.karyawan_bank_cabang as karyawan_bank_cabang, karyawan.karyawan_rekening as karyawan_rekening,
	karyawan.karyawan_atasnama as karyawan_atasnama, karyawan.karyawan_aktif as karyawan_aktif,
	karyawan.karyawan_creator as karyawan_creator, karyawan.karyawan_date_create as karyawan_date_create,
	karyawan.karyawan_update as karyawan_update, karyawan.karyawan_date_update as karyawan_date_update,
	karyawan.karyawan_revised as karyawan_revised, karyawan.karyawan_cabang2 as karyawan_cabang2
from karyawan;

INSERT into karyawan_jabatan (kjabatan_master, kjabatan_departemen, kjabatan_jabatan, kjabatan_golongan, kjabatan_pph21, kjabatan_atasan, kjabatan_tglawal, kjabatan_tglakhir, kjabatan_keterangan, kjabatan_creator, kjabatan_date_create)
select karyawan_id, karyawan_departemen, karyawan_jabatan, karyawan_idgolongan, karyawan_pph21, karyawan_atasan, '2011-07-22', '2011-07-22', 'Import dr Karyawan', 'IT', '2011-07-22' from karyawan;