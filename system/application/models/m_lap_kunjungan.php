<? /* 
	+ Description	: For record model process back-end
	+ Filename 		: c_lap_kunjungan.php
 	+ Author  		: Freddy
*/

class M_lap_kunjungan extends Model{
		
	//constructor
	function M_lap_kunjungan() {
		parent::Model();
	}
		
	//function for get list record
	function lap_kunjungan_list($filter,$start,$end){
			$date_now=date('Y-m-d');
			
			//jika ada penggantian di query ini, sesuaikan juga query di m_crm_generator, bagian Frequency
			$query="select date_format(tgl_tindakan, '%Y-%m-%d') as tgl_tindakan,
sum(jum_cust_medis),
sum(jum_cust_surgery),
sum(jum_cust_antiaging),
sum(jum_cust_nonmedis),
sum(jum_cust_produk), 
sum(jum_total)
from
(
	(
		/* MEDIS */
		select 
			count(distinct temp_jum_cust_medis) as jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					master_jual_rawat.jrawat_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
					from detail_jual_rawat
					left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
					left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal = '$date_now'
			)
			union
			(
				select 
					detail_ambil_paket.dapaket_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
			)) as table_sum_medis
		group by tgl_tindakan
	)
	
	/* SURGERY */
	union
	(
		select 
			jum_cust_medis,
			count(distinct temp_jum_cust_surgery) as jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					master_jual_rawat.jrawat_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal  = '$date_now'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
			)) as table_sum_surgery
		group by tgl_tindakan

	)

	/* ANTI AGING */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			count(distinct temp_jum_cust_antiaging) as jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					master_jual_rawat.jrawat_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal  = '$date_now'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
			)) as table_sum_antiaging
		group by tgl_tindakan

	)

	
	/*  NON-MEDIS */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			count(distinct temp_jum_cust_nonmedis) as jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					master_jual_rawat.jrawat_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal  = '$date_now'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
			)) as table_sum_nonmedis
		group by tgl_tindakan
	)

	/* PRODUK*/
	union
	(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_surgery,
			0 as jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			count(distinct master_jual_produk.jproduk_cust) as jum_cust_produk,
			0 as jum_total,
			master_jual_produk.jproduk_tanggal as tgl_tindakan
		from master_jual_produk
		where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal = '$date_now' 
		group by tgl_tindakan
	)

	/* TOTAL*/
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			count(distinct cust) as jum_total,
			tgl_tindakan
			from
			((	
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_rawat.jrawat_cust as cust,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where master_jual_rawat.jrawat_stat_dok <> 'Batal'
				and master_jual_rawat.jrawat_bayar <> 0 and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal = '$date_now'
			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_produk.jproduk_cust as cust,
					master_jual_produk.jproduk_tanggal as tgl_tindakan
				from master_jual_produk
				where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal = '$date_now'
			)
			
			union
			(
			select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					detail_ambil_paket.dapaket_cust as cust,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
			)	
		)as table_union2
		group by tgl_tindakan
	)

) as table_union
group by tgl_tindakan";
			
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			
			if($nbrows>0){
				if($nbrows>0){
					foreach($result->result() as $row){
						$arr[] = $row;
					}
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
	function lap_kunjungan_non_list($filter,$start,$end){
			$date_now=date('Y-m-d');
			$query="select
sum(jum_cust_medis),
sum(jum_cust_surgery),
sum(jum_cust_antiaging),
sum(jum_cust_nonmedis),
sum(jum_cust_produk), 
sum(jum_total)
from
(
	(
		/* MEDIS */
		select 
			count(distinct temp_jum_cust_medis) as jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					master_jual_rawat.jrawat_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
					from detail_jual_rawat
					left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
					left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal = '$date_now'
			)
			union
			(
				select 
					detail_ambil_paket.dapaket_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
			)) as table_sum_medis
		group by tgl_tindakan
	)
	
	/* SURGERY */
	union
	(
		select 
			jum_cust_medis,
			count(distinct temp_jum_cust_surgery) as jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					master_jual_rawat.jrawat_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal  = '$date_now'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
			)) as table_sum_surgery
		group by tgl_tindakan

	)

	/* ANTI AGING */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			count(distinct temp_jum_cust_antiaging) as jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					master_jual_rawat.jrawat_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal  = '$date_now'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
			)) as table_sum_antiaging
		group by tgl_tindakan

	)

	
	/*  NON-MEDIS */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			count(distinct temp_jum_cust_nonmedis) as jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					master_jual_rawat.jrawat_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal  = '$date_now'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
			)) as table_sum_nonmedis
		group by tgl_tindakan
	)

	/* PRODUK*/
	union
	(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_surgery,
			0 as jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			count(distinct master_jual_produk.jproduk_cust) as jum_cust_produk,
			0 as jum_total,
			master_jual_produk.jproduk_tanggal as tgl_tindakan
		from master_jual_produk
		where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal = '$date_now'
		group by tgl_tindakan
	)

	/* TOTAL*/
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			count(distinct cust) as jum_total,
			tgl_tindakan
			from
			((	
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_rawat.jrawat_cust as cust,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where master_jual_rawat.jrawat_stat_dok <> 'Batal'
				and master_jual_rawat.jrawat_bayar <> 0 and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal = '$date_now'
			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_produk.jproduk_cust as cust,
					master_jual_produk.jproduk_tanggal as tgl_tindakan
				from master_jual_produk
				where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal = '$date_now'
			)
			
			union
			(
			select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					detail_ambil_paket.dapaket_cust as cust,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
			)
			
			)as table_union2
		group by tgl_tindakan
	)

) as table_union";
			
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			
			if($nbrows>0 || $nbrows2>0){
				if($nbrows>0){
					foreach($result->result() as $row){
						$arr[] = $row;
					}
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}	
		
	function lap_average_list($filter,$start,$end){
			$date_now=date('Y-m-d');
			$query="
select
sum(jum_cust_medis)/count(distinct tgl_tindakan),
sum(jum_cust_surgery)/count(distinct tgl_tindakan),
sum(jum_cust_antiaging)/count(distinct tgl_tindakan),
sum(jum_cust_nonmedis)/count(distinct tgl_tindakan),
sum(jum_cust_produk)/count(distinct tgl_tindakan),
sum(jum_total)/count(distinct tgl_tindakan)
from
(
	(
		/* MEDIS */
		select 
			count(distinct temp_jum_cust_medis) as jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					master_jual_rawat.jrawat_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
					from detail_jual_rawat
					left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
					left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal = '$date_now'
			)
			union
			(
				select 
					detail_ambil_paket.dapaket_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
			)) as table_sum_medis
		group by tgl_tindakan
	)
	
	/* SURGERY */
	union
	(
		select 
			jum_cust_medis,
			count(distinct temp_jum_cust_surgery) as jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					master_jual_rawat.jrawat_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal  = '$date_now'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
			)) as table_sum_surgery
		group by tgl_tindakan

	)

	/* ANTI AGING */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			count(distinct temp_jum_cust_antiaging) as jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					master_jual_rawat.jrawat_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal  = '$date_now'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
			)) as table_sum_antiaging
		group by tgl_tindakan

	)

	
	/*  NON-MEDIS */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			count(distinct temp_jum_cust_nonmedis) as jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					master_jual_rawat.jrawat_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal  = '$date_now'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
			)) as table_sum_nonmedis
		group by tgl_tindakan
	)

	/* PRODUK*/
	union
	(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_surgery,
			0 as jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			count(distinct master_jual_produk.jproduk_cust) as jum_cust_produk,
			0 as jum_total,
			master_jual_produk.jproduk_tanggal as tgl_tindakan
		from master_jual_produk
		where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal = '$date_now'
		group by tgl_tindakan
	)

	/* TOTAL*/
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			count(distinct cust) as jum_total,
			tgl_tindakan
			from
			((	
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_rawat.jrawat_cust as cust,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where master_jual_rawat.jrawat_stat_dok <> 'Batal'
				and master_jual_rawat.jrawat_bayar <> 0 and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal = '$date_now'
			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_produk.jproduk_cust as cust,
					master_jual_produk.jproduk_tanggal as tgl_tindakan
				from master_jual_produk
				where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal = '$date_now'
			)
			
			union
			(
			select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					detail_ambil_paket.dapaket_cust as cust,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
			)
			
			)as table_union2
		group by tgl_tindakan
	)

) as table_union";
			
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			
			if($nbrows>0 || $nbrows2>0){
				if($nbrows>0){
					foreach($result->result() as $row){
						$arr[] = $row;
					}
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}		
	
		
		
	//function for advanced search record
	function lap_kunjungan_search($lap_kunjungan_id ,$trawat_tglapp_start ,$trawat_tglapp_end, $start,$end){
			//full query
			if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
			$query = "select date_format(tgl_tindakan, '%Y-%m-%d') as tgl_tindakan,
sum(jum_cust_medis),
sum(jum_cust_surgery),
sum(jum_cust_antiaging),
sum(jum_cust_nonmedis),
sum(jum_cust_produk), 
sum(jum_total)
from
(
	(
		/* MEDIS */
		select 
			count(distinct temp_jum_cust_medis) as jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					master_jual_rawat.jrawat_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
					from detail_jual_rawat
					left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
					left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)
			union
			(
				select 
					detail_ambil_paket.dapaket_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)) as table_sum_medis
		group by tgl_tindakan
	)
	
	/* SURGERY */
	union
	(
		select 
			jum_cust_medis,
			count(distinct temp_jum_cust_surgery) as jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					master_jual_rawat.jrawat_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)) as table_sum_surgery
		group by tgl_tindakan

	)

	/* ANTI AGING */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			count(distinct temp_jum_cust_antiaging) as jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					master_jual_rawat.jrawat_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)) as table_sum_antiaging
		group by tgl_tindakan

	)

	
	/*  NON-MEDIS */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			count(distinct temp_jum_cust_nonmedis) as jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					master_jual_rawat.jrawat_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)) as table_sum_nonmedis
		group by tgl_tindakan
	)

	/* PRODUK*/
	union
	(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_surgery,
			0 as jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			count(distinct master_jual_produk.jproduk_cust) as jum_cust_produk,
			0 as jum_total,
			master_jual_produk.jproduk_tanggal as tgl_tindakan
		from master_jual_produk
		where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
		group by tgl_tindakan
	)

	/* TOTAL*/
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			count(distinct cust) as jum_total,
			tgl_tindakan
			from
			((	
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_rawat.jrawat_cust as cust,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where master_jual_rawat.jrawat_stat_dok <> 'Batal'
				and master_jual_rawat.jrawat_bayar <> 0 and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_produk.jproduk_cust as cust,
					master_jual_produk.jproduk_tanggal as tgl_tindakan
				from master_jual_produk
				where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)
			
			union
			(
			select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					detail_ambil_paket.dapaket_cust as cust,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)
			
			)as table_union2
		group by tgl_tindakan
	)

) as table_union";

}
		else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
				
		$query = "select date_format(tgl_tindakan, '%Y-%m-%d') as tgl_tindakan,
sum(jum_cust_medis),
sum(jum_cust_surgery),
sum(jum_cust_antiaging),
sum(jum_cust_nonmedis),
sum(jum_cust_produk), 
sum(jum_total)
from
(
	(
		/* MEDIS */
		select 
			count(distinct temp_jum_cust_medis) as jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					master_jual_rawat.jrawat_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
					from detail_jual_rawat
					left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
					left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'
			)
			union
			(
				select 
					detail_ambil_paket.dapaket_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'
			)) as table_sum_medis
		group by tgl_tindakan
	)
	
	/* SURGERY */
	union
	(
		select 
			jum_cust_medis,
			count(distinct temp_jum_cust_surgery) as jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					master_jual_rawat.jrawat_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'
			)) as table_sum_surgery
		group by tgl_tindakan

	)

	/* ANTI AGING */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			count(distinct temp_jum_cust_antiaging) as jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					master_jual_rawat.jrawat_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'
			)) as table_sum_antiaging
		group by tgl_tindakan

	)

	
	/*  NON-MEDIS */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			count(distinct temp_jum_cust_nonmedis) as jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					master_jual_rawat.jrawat_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'
			)) as table_sum_nonmedis
		group by tgl_tindakan
	)

	/* PRODUK*/
	union
	(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_surgery,
			0 as jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			count(distinct master_jual_produk.jproduk_cust) as jum_cust_produk,
			0 as jum_total,
			master_jual_produk.jproduk_tanggal as tgl_tindakan
		from master_jual_produk
		where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal = '".$trawat_tglapp_start."'
		group by tgl_tindakan
	)

	/* TOTAL*/
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			count(distinct cust) as jum_total,
			tgl_tindakan
			from
			((	
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_rawat.jrawat_cust as cust,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where master_jual_rawat.jrawat_stat_dok <> 'Batal'
				and master_jual_rawat.jrawat_bayar <> 0 and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'
			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_produk.jproduk_cust as cust,
					master_jual_produk.jproduk_tanggal as tgl_tindakan
				from master_jual_produk
				where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal = '".$trawat_tglapp_start."'
			)
			
			union
			(
			select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					detail_ambil_paket.dapaket_cust as cust,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'
			)
			
			)as table_union2
		group by tgl_tindakan
	)
) as table_union";
			}
			$query.=" group by tgl_tindakan";
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			
			$limit = $query." LIMIT ".$start.",".$end;		
			$result = $this->db->query($limit);    
			
			if($nbrows>0){
				foreach($result->result() as $row){
					$arr[] = $row;
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
	//function for advanced search record
	function lap_kunjungan_search2($lap_kunjungan_id ,$trawat_tglapp_start ,$trawat_tglapp_end ,$trawat_dokter,$start,$end){
			//full query
		if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
	
			$query = "select
sum(jum_cust_medis),
sum(jum_cust_surgery),
sum(jum_cust_antiaging),
sum(jum_cust_nonmedis),
sum(jum_cust_produk), 
sum(jum_total)
from
(
	(
		/* MEDIS */
		select 
			count(distinct temp_jum_cust_medis) as jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					master_jual_rawat.jrawat_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
					from detail_jual_rawat
					left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
					left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)
			union
			(
				select 
					detail_ambil_paket.dapaket_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)) as table_sum_medis
		group by tgl_tindakan
	)
	
	/* SURGERY */
	union
	(
		select 
			jum_cust_medis,
			count(distinct temp_jum_cust_surgery) as jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					master_jual_rawat.jrawat_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)) as table_sum_surgery
		group by tgl_tindakan

	)

	/* ANTI AGING */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			count(distinct temp_jum_cust_antiaging) as jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					master_jual_rawat.jrawat_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)) as table_sum_antiaging
		group by tgl_tindakan

	)

	
	/*  NON-MEDIS */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			count(distinct temp_jum_cust_nonmedis) as jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					master_jual_rawat.jrawat_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)) as table_sum_nonmedis
		group by tgl_tindakan
	)

	/* PRODUK*/
	union
	(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_surgery,
			0 as jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			count(distinct master_jual_produk.jproduk_cust) as jum_cust_produk,
			0 as jum_total,
			master_jual_produk.jproduk_tanggal as tgl_tindakan
		from master_jual_produk
		where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
		group by tgl_tindakan
	)

	/* TOTAL*/
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			count(distinct cust) as jum_total,
			tgl_tindakan
			from
			((	
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_rawat.jrawat_cust as cust,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where master_jual_rawat.jrawat_stat_dok <> 'Batal'
				and master_jual_rawat.jrawat_bayar <> 0 and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_produk.jproduk_cust as cust,
					master_jual_produk.jproduk_tanggal as tgl_tindakan
				from master_jual_produk
				where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)
			
			union
			(
			select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					detail_ambil_paket.dapaket_cust as cust,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)
			)as table_union2
		group by tgl_tindakan
	)

) as table_union";

}
	
			else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
				
			$query = "select date_format(tgl_tindakan, '%Y-%m-%d') as tgl_tindakan,
sum(jum_cust_medis),
sum(jum_cust_surgery),
sum(jum_cust_antiaging),
sum(jum_cust_nonmedis),
sum(jum_cust_produk), 
sum(jum_total)
from
(
	(
		/* MEDIS */
		select 
			count(distinct temp_jum_cust_medis) as jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					master_jual_rawat.jrawat_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
					from detail_jual_rawat
					left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
					left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'
			)
			union
			(
				select 
					detail_ambil_paket.dapaket_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'
			)) as table_sum_medis
		group by tgl_tindakan
	)
	
	/* SURGERY */
	union
	(
		select 
			jum_cust_medis,
			count(distinct temp_jum_cust_surgery) as jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					master_jual_rawat.jrawat_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'
			)) as table_sum_surgery
		group by tgl_tindakan

	)

	/* ANTI AGING */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			count(distinct temp_jum_cust_antiaging) as jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					master_jual_rawat.jrawat_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'
			)) as table_sum_antiaging
		group by tgl_tindakan

	)

	
	/*  NON-MEDIS */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			count(distinct temp_jum_cust_nonmedis) as jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					master_jual_rawat.jrawat_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'
			)) as table_sum_nonmedis
		group by tgl_tindakan
	)

	/* PRODUK*/
	union
	(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_surgery,
			0 as jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			count(distinct master_jual_produk.jproduk_cust) as jum_cust_produk,
			0 as jum_total,
			master_jual_produk.jproduk_tanggal as tgl_tindakan
		from master_jual_produk
		where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal = '".$trawat_tglapp_start."'
		group by tgl_tindakan
	)

	/* TOTAL*/
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			count(distinct cust) as jum_total,
			tgl_tindakan
			from
			((	
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_rawat.jrawat_cust as cust,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where master_jual_rawat.jrawat_stat_dok <> 'Batal'
				and master_jual_rawat.jrawat_bayar <> 0 and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'
			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_produk.jproduk_cust as cust,
					master_jual_produk.jproduk_tanggal as tgl_tindakan
				from master_jual_produk
				where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal = '".$trawat_tglapp_start."'
			)
			
			union
			(
			select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					detail_ambil_paket.dapaket_cust as cust,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'
			)
			
			)as table_union2
		group by tgl_tindakan
	)
) as table_union";
	}
			//$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
			//$query.=" k.karyawan_id != 60 and p.rawat_id is not null"; //60 = Available . Dr
			//$query.=" group by k.karyawan_username, p.rawat_nama)as vu_kredit";
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			
			$limit = $query." LIMIT ".$start.",".$end;		
			$result = $this->db->query($limit);    
			
			if($nbrows>0){
				foreach($result->result() as $row){
					$arr[] = $row;
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}

	function lap_kunjungan_search3($lap_kunjungan_id ,$trawat_tglapp_start ,$trawat_tglapp_end ,$trawat_dokter,$start,$end){
			//full query
		if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
	
			$query = "select
sum(jum_cust_medis)/count(distinct tgl_tindakan),
sum(jum_cust_surgery)/count(distinct tgl_tindakan),
sum(jum_cust_antiaging)/count(distinct tgl_tindakan),
sum(jum_cust_nonmedis)/count(distinct tgl_tindakan),
sum(jum_cust_produk)/count(distinct tgl_tindakan), 
sum(jum_total)/count(distinct tgl_tindakan)
from
(
	(
		/* MEDIS */
		select 
			count(distinct temp_jum_cust_medis) as jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					master_jual_rawat.jrawat_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
					from detail_jual_rawat
					left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
					left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)
			union
			(
				select 
					detail_ambil_paket.dapaket_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)) as table_sum_medis
		group by tgl_tindakan
	)
	
	/* SURGERY */
	union
	(
		select 
			jum_cust_medis,
			count(distinct temp_jum_cust_surgery) as jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					master_jual_rawat.jrawat_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)) as table_sum_surgery
		group by tgl_tindakan

	)

	/* ANTI AGING */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			count(distinct temp_jum_cust_antiaging) as jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					master_jual_rawat.jrawat_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)) as table_sum_antiaging
		group by tgl_tindakan

	)

	
	/*  NON-MEDIS */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			count(distinct temp_jum_cust_nonmedis) as jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					master_jual_rawat.jrawat_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)) as table_sum_nonmedis
		group by tgl_tindakan
	)

	/* PRODUK*/
	union
	(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_surgery,
			0 as jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			count(distinct master_jual_produk.jproduk_cust) as jum_cust_produk,
			0 as jum_total,
			master_jual_produk.jproduk_tanggal as tgl_tindakan
		from master_jual_produk
		where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
		group by tgl_tindakan
	)

	/* TOTAL*/
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			count(distinct cust) as jum_total,
			tgl_tindakan
			from
			((	
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_rawat.jrawat_cust as cust,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where master_jual_rawat.jrawat_stat_dok <> 'Batal'
				and master_jual_rawat.jrawat_bayar <> 0 and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_produk.jproduk_cust as cust,
					master_jual_produk.jproduk_tanggal as tgl_tindakan
				from master_jual_produk
				where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)
			
			union
			(
			select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					detail_ambil_paket.dapaket_cust as cust,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
			)
			)as table_union2
		group by tgl_tindakan
	)

) as table_union";

}
	
			else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
				
			$query = "select date_format(tgl_tindakan, '%Y-%m-%d') as tgl_tindakan,
sum(jum_cust_medis)/count(distinct tgl_tindakan),
sum(jum_cust_surgery)/count(distinct tgl_tindakan),
sum(jum_cust_antiaging)/count(distinct tgl_tindakan),
sum(jum_cust_nonmedis)/count(distinct tgl_tindakan),
sum(jum_cust_produk)/count(distinct tgl_tindakan), 
sum(jum_total)/count(distinct tgl_tindakan)
from
(
	(
		/* MEDIS */
		select 
			count(distinct temp_jum_cust_medis) as jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					master_jual_rawat.jrawat_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
					from detail_jual_rawat
					left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
					left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'
			)
			union
			(
				select 
					detail_ambil_paket.dapaket_cust as temp_jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'
			)) as table_sum_medis
		group by tgl_tindakan
	)
	
	/* SURGERY */
	union
	(
		select 
			jum_cust_medis,
			count(distinct temp_jum_cust_surgery) as jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					master_jual_rawat.jrawat_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'
			)) as table_sum_surgery
		group by tgl_tindakan

	)

	/* ANTI AGING */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			count(distinct temp_jum_cust_antiaging) as jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					master_jual_rawat.jrawat_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'
			)) as table_sum_antiaging
		group by tgl_tindakan

	)

	
	/*  NON-MEDIS */
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			count(distinct temp_jum_cust_nonmedis) as jum_cust_nonmedis,
			jum_cust_produk,
			jum_total,
			tgl_tindakan
			from
			((
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					master_jual_rawat.jrawat_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok<> 'Batal' and master_jual_rawat.jrawat_bayar <> 0 and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'

			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					detail_ambil_paket.dapaket_cust as temp_jum_cust_nonmedis,
					0 as jum_cust_produk,
					0 as jum_total,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'
			)) as table_sum_nonmedis
		group by tgl_tindakan
	)

	/* PRODUK*/
	union
	(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_surgery,
			0 as jum_cust_antiaging,
			0 as jum_cust_nonmedis,
			count(distinct master_jual_produk.jproduk_cust) as jum_cust_produk,
			0 as jum_total,
			master_jual_produk.jproduk_tanggal as tgl_tindakan
		from master_jual_produk
		where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal = '".$trawat_tglapp_start."'
		group by tgl_tindakan
	)

	/* TOTAL*/
	union
	(
		select 
			jum_cust_medis,
			jum_cust_surgery,
			jum_cust_antiaging,
			jum_cust_nonmedis,
			jum_cust_produk,
			count(distinct cust) as jum_total,
			tgl_tindakan
			from
			((	
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_rawat.jrawat_cust as cust,
					master_jual_rawat.jrawat_tanggal as tgl_tindakan
				from detail_jual_rawat
				left join master_jual_rawat on (detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where master_jual_rawat.jrawat_stat_dok <> 'Batal'
				and master_jual_rawat.jrawat_bayar <> 0 and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'
			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_produk.jproduk_cust as cust,
					master_jual_produk.jproduk_tanggal as tgl_tindakan
				from master_jual_produk
				where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_bayar <> 0 and master_jual_produk.jproduk_tanggal = '".$trawat_tglapp_start."'
			)
			
			union
			(
			select 
					0 as jum_cust_medis,
					0 as jum_cust_surgery,
					0 as jum_cust_antiaging,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					detail_ambil_paket.dapaket_cust as cust,
					detail_ambil_paket.dapaket_tgl_ambil as tgl_tindakan
				from detail_ambil_paket
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok <> 'Batal' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'
			)
			
			)as table_union2
		group by tgl_tindakan
	)
) as table_union";
	}
			//$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
			//$query.=" k.karyawan_id != 60 and p.rawat_id is not null"; //60 = Available . Dr
			//$query.=" group by k.karyawan_username, p.rawat_nama)as vu_kredit";
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			
			$limit = $query." LIMIT ".$start.",".$end;		
			$result = $this->db->query($limit);    
			
			if($nbrows>0){
				foreach($result->result() as $row){
					$arr[] = $row;
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
		
		
	//function for print record
	/*function lap_kunjungan_print($trawat_id ,$trawat_cust ,$trawat_keterangan ,$option,$filter){
			//full query
			$query="select * from tindakan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (trawat_id LIKE '%".addslashes($filter)."%' OR trawat_cust LIKE '%".addslashes($filter)."%' OR trawat_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($trawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_id LIKE '%".$trawat_id."%'";
				};
				if($trawat_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_cust LIKE '%".$trawat_cust."%'";
				};
				if($trawat_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_keterangan LIKE '%".$trawat_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}*/
		
	//function  for export to excel
	/*function lap_lunjungan_export_excel($trawat_id ,$trawat_dokter ,$option,$filter){
			//full query
			$query="select k.karyawan_username, p.rawat_nama, count(p.rawat_nama) as Jumlah_rawat, p.rawat_kredit, p.rawat_kredit*count(p.rawat_nama) as Total_kredit from tindakan_detail d left outer join karyawan k on k.karyawan_id=d.dtrawat_petugas1 left outer join perawatan p on p.rawat_id = d.dtrawat_perawatan";
			
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (trawat_id LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($trawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_id LIKE '%".$trawat_id."%'";
				};
				if($trawat_dokter!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_username LIKE '%".$trawat_dokter."%'";
				};
				$query.=" group by k.karyawan_username, p.rawat_nama";
				$result = $this->db->query($query);	
			}
			return $result;
		}*/
		
}
?>