<? /* 
	+ Description	: For record model process back-end
	+ Filename 		: m_summary_report.php
 	+ Author  		: Freddy
*/

class m_summary_report extends Model{
		
	//constructor
	function m_summary_report() {
		parent::Model();
	}
		
	//function for get list record
	function lap_kunjungan_list($filter,$start,$end){
			$date_now=date('Y-m-d');
			
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
					left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
					left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok ='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal = '$date_now'
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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
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
				left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)	
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal  = '$date_now'

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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
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
				left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal  = '$date_now'

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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
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
				left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal  = '$date_now'

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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
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
		left join customer on (master_jual_produk.jproduk_cust = customer.cust_id)
		where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and master_jual_produk.jproduk_tanggal = '$date_now' 
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
				left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
				where master_jual_rawat.jrawat_stat_dok ='Tertutup'
				and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal = '$date_now'
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
				left join customer on (master_jual_produk.jproduk_cust = customer.cust_id)
				where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and master_jual_produk.jproduk_tanggal = '$date_now'
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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
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
					left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal = '$date_now'
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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
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
				left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal  = '$date_now'

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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
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
				left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal  = '$date_now'

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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
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
				left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal  = '$date_now'

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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
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
		left join customer on (master_jual_produk.jproduk_cust = customer.cust_id)
		where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and master_jual_produk.jproduk_tanggal = '$date_now'
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
				left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where master_jual_rawat.jrawat_stat_dok ='Tertutup'
				and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal = '$date_now'
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
				left join customer on (master_jual_produk.jproduk_cust = customer.cust_id)
				where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and master_jual_produk.jproduk_tanggal = '$date_now'
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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
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
					left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
					left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal = '$date_now'
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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
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
				left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal  = '$date_now'

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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
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
				left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal  = '$date_now'

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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
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
				left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal  = '$date_now'

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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
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
		left join customer on (master_jual_produk.jproduk_cust = customer.cust_id)
		where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and master_jual_produk.jproduk_tanggal = '$date_now'
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
				left join customer on (master_jual_rawat.jrawat_cust = customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where master_jual_rawat.jrawat_stat_dok ='Tertutup'
				and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal = '$date_now'
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
				left join customer on (master_jual_produk.jproduk_cust = customer.cust_id)
				where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and master_jual_produk.jproduk_tanggal = '$date_now'
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
				left join customer on (detail_ambil_paket.dapaket_cust = customer.cust_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '$date_now'
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
	function summary_report_search($bulan_tujuan, $tahun_tujuan, $bulan_pembanding1, $tahun_pembanding1, $bulan_pembanding2, $tahun_pembanding2, $start,$end){
			//full query
		/*
		if ($lap_kunjungan_kelamin == '' or $lap_kunjungan_kelamin == 'S')
		{
			$cust_kelamin = "";
		}			
		else if ($lap_kunjungan_kelamin == 'P')
		{
			$cust_kelamin = " and vu_customer.cust_kelamin = '$lap_kunjungan_kelamin'";
		}
		else if($lap_kunjungan_kelamin == 'L')
		{
			$cust_kelamin = " and vu_customer.cust_kelamin = '$lap_kunjungan_kelamin'";			
		}
		
		if ($lap_kunjungan_cust == '' or $lap_kunjungan_cust == 'Semua')
		{
			$cust_daftar = "";
		}
		else if ($lap_kunjungan_cust == 'Lama')
		{
			$cust_daftar = " and vu_customer.cust_terdaftar not between '$trawat_tglapp_start' and '$trawat_tglapp_end'";
		}
		else if($lap_kunjungan_cust == 'Baru')
		{
			$cust_daftar = " and vu_customer.cust_terdaftar between '$trawat_tglapp_start' and '$trawat_tglapp_end'";			
		}			
		
		if ($lap_kunjungan_member == '' or $lap_kunjungan_member == 'Semua')
		{
			$stat_member = "";
		}
		else if ($lap_kunjungan_member == 'Lama')
		{
			$stat_member = " and vu_customer.member_register not between '$trawat_tglapp_start' and '$trawat_tglapp_end'";
		}
		else if($lap_kunjungan_member == 'Baru')
		{
			$stat_member = " and vu_customer.member_register between '$trawat_tglapp_start' and '$trawat_tglapp_end'";
		}
		else if($lap_kunjungan_member == 'Non Member')
		{
			$stat_member = " and vu_customer.cust_member = 0";
		}
			
		if($lap_kunjungan_tgllahir!='' and $lap_kunjungan_tgllahirend!=''){
			$tgllahir= " and cust_tgllahir BETWEEN '$lap_kunjungan_tgllahir' AND '$lap_kunjungan_tgllahirend'";
		}else if ($lap_kunjungan_tgllahir!='' and $lap_kunjungan_tgllahirend==''){
			$tgllahir= " and cust_tgllahir BETWEEN '$lap_kunjungan_tgllahir' AND now()";
		}else if ($lap_kunjungan_tgllahir=='' and $lap_kunjungan_tgllahirend!=''){
			$tgllahir= " and cust_tgllahir < '$lap_kunjungan_tgllahirend'";
		}else if ($lap_kunjungan_tgllahir=='' and $lap_kunjungan_tgllahirend==''){
			$tgllahir= "";
		}

		if($lap_kunjungan_umurstart!='' and $lap_kunjungan_umurend!=''){
			$umur= " and (year(now())-year(cust_tgllahir)) BETWEEN '$lap_kunjungan_umurstart' AND '$lap_kunjungan_umurend'";
		}else if ($lap_kunjungan_umurstart!='' and $lap_kunjungan_umurend==''){
			$umur= " and (year(now())-year(cust_tgllahir)) > '$lap_kunjungan_umurstart'";
		}else if ($lap_kunjungan_umurstart=='' and $lap_kunjungan_umurend!=''){
			$umur= " and (year(now())-year(cust_tgllahir)) < '$lap_kunjungan_umurend'";
		}else if ($lap_kunjungan_umurstart=='' and $lap_kunjungan_umurend==''){
			$umur= "";
		}
		*/

		
		if($bulan_tujuan!='' && $tahun_tujuan!=''){
		// TUJUAN
		$jum_hari_tujuan = cal_days_in_month(CAL_GREGORIAN, $bulan_tujuan, $tahun_tujuan);
		$tanggal_daftar_awal = $tahun_tujuan.'-'.$bulan_tujuan.'-01';
		$tanggal_daftar_akhir = $tahun_tujuan.'-'.$bulan_tujuan.'-'.$jum_hari_tujuan;
		
		// PEMBANDING 1
		$jum_hari_pembanding1 = cal_days_in_month(CAL_GREGORIAN, $bulan_pembanding1, $tahun_pembanding1);
		$tanggal_awal_pembanding1 = $tahun_pembanding1.'-'.$bulan_pembanding1.'-01';
		$tanggal_akhir_pembanding1 = $tahun_pembanding1.'-'.$bulan_pembanding1.'-'.$jum_hari_pembanding1;
		
		// PEMBANDING 2
		$jum_hari_pembanding2 = cal_days_in_month(CAL_GREGORIAN, $bulan_pembanding2, $tahun_pembanding2);
		$tanggal_awal_pembanding2 = $tahun_pembanding2.'-'.$bulan_pembanding2.'-01';
		$tanggal_akhir_pembanding2 = $tahun_pembanding2.'-'.$bulan_pembanding2.'-'.$jum_hari_pembanding2;
		$sr_cabang = 1;
		$username = $_SESSION[SESSION_USERID];
		
		// POSISI INSERT KE SR
		
		
		// ===== PERBANDINGAN BULAN TUJUAN DENGAN TARGET =====
		if ($bulan_tujuan == 01)
			$bulan = 'setsr_jan';
		else if ($bulan_tujuan == 02)
			$bulan = 'setsr_feb';
		else if ($bulan_tujuan == 03)
			$bulan = 'setsr_mar';
		else if ($bulan_tujuan == 04)
			$bulan = 'setsr_apr';
		else if ($bulan_tujuan == 05)
			$bulan = 'setsr_may';
		else if ($bulan_tujuan == 06)
			$bulan = 'setsr_jun';
		else if ($bulan_tujuan == 07)
			$bulan = 'setsr_jul';
		else if ($bulan_tujuan == 08)
			$bulan = 'setsr_aug';
		else if ($bulan_tujuan == 09)
			$bulan = 'setsr_sep';
		else if ($bulan_tujuan == 10)
			$bulan = 'setsr_oct';
		else if ($bulan_tujuan == 11)
			$bulan = 'setsr_nov';
		else if ($bulan_tujuan == 12)
			$bulan = 'setsr_dec';
		
		$query_perhitungan_summary = "
		SELECT
			sr.sr_jenis AS jenis,
			sr.sr_nilai AS nilai_tujuan,
			sr_setup.setsr_jan AS target,
			(sr.sr_nilai / DAYOFMONTH ('".$tanggal_daftar_akhir."')) AS rata_rata,
			(sr.sr_nilai / sr_setup.setsr_jan *100) AS pencapaian_target,
			/* pembanding 1 */
			(SELECT sr.sr_nilai FROM sr WHERE  sr.sr_bulan = '".$bulan_pembanding1."' AND sr.sr_tahun = '".$tahun_pembanding1."' AND sr.sr_jenis = jenis) AS nilai_pembanding1,
			sr.sr_nilai-(SELECT sr.sr_nilai FROM sr WHERE  sr.sr_bulan = '".$bulan_pembanding1."' AND sr.sr_tahun = '".$tahun_pembanding1."' AND sr.sr_jenis = jenis) AS naik_turun1,
			(sr.sr_nilai-(SELECT sr.sr_nilai FROM sr WHERE  sr.sr_bulan = '".$bulan_pembanding1."' AND sr.sr_tahun = '".$tahun_pembanding1."' AND sr.sr_jenis = jenis)) / sr.sr_nilai AS prosentase_naik_turun1,
			/* pembanding 2 */
			(SELECT sr.sr_nilai FROM sr WHERE  sr.sr_bulan = '".$bulan_pembanding2."' AND sr.sr_tahun = '".$tahun_pembanding2."' AND sr.sr_jenis = jenis) AS nilai_pembanding2,
			sr.sr_nilai-(SELECT sr.sr_nilai FROM sr WHERE  sr.sr_bulan = '".$bulan_pembanding2."' AND sr.sr_tahun = '".$tahun_pembanding2."' AND sr.sr_jenis = jenis) AS naik_turun2,
			(sr.sr_nilai-(SELECT sr.sr_nilai FROM sr WHERE  sr.sr_bulan = '".$bulan_pembanding2."' AND sr.sr_tahun = '".$tahun_pembanding2."' AND sr.sr_jenis = jenis)) / sr.sr_nilai AS prosentase_naik_turun2
		FROM 
			sr
		LEFT JOIN sr_setup ON (sr.sr_tahun = sr_setup.setsr_tahun AND sr.sr_jenis = sr_setup.setsr_jenis)
		WHERE sr.sr_bulan = '".$bulan_tujuan."' AND sr.sr_tahun = '".$tahun_tujuan."'";
		//$result_perhitungan_summary = $this->db->query($query_perhitungan_summary);
		//$data_perhitungan_summary= $result_perhitungan_summary->row();
		//$target_tujuan= $data_target_tujuan->nilai;
				
		$result = $this->db->query($query_perhitungan_summary);
		$nbrows = $result->num_rows();
			
		$limit = $query_perhitungan_summary." LIMIT ".$start.",".$end;		
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
		
		/*
			$query2 = "elect date_format(tgl_tindakan, '%Y-%m-%d') as tgl_tindakan,
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
		/*
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
					left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and MONTH(master_jual_rawat.jrawat_tanggal) = ".$bulan_tujuan." and YEAR(master_jual_rawat.jrawat_tanggal) = ".$tahun_tujuan."
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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and MONTH(detail_ambil_paket.dapaket_tgl_ambil) = ".$bulan_tujuan." and YEAR(detail_ambil_paket.dapaket_tgl_ambil) = ".$tahun_tujuan."
			)) as table_sum_medis
		group by tgl_tindakan
	)
	
	/* SURGERY */
	/*
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and MONTH(master_jual_rawat.jrawat_tanggal) = ".$bulan_tujuan." and YEAR(master_jual_rawat.jrawat_tanggal) = ".$tahun_tujuan."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and MONTH(detail_ambil_paket.dapaket_tgl_ambil) = ".$bulan_tujuan." and YEAR(detail_ambil_paket.dapaket_tgl_ambil) = ".$tahun_tujuan."
			)) as table_sum_surgery
		group by tgl_tindakan

	)

	/* ANTI AGING */
	/*
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and MONTH(master_jual_rawat.jrawat_tanggal) = ".$bulan_tujuan." and YEAR(master_jual_rawat.jrawat_tanggal) = ".$tahun_tujuan."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and MONTH(detail_ambil_paket.dapaket_tgl_ambil) = ".$bulan_tujuan." and YEAR(detail_ambil_paket.dapaket_tgl_ambil) = ".$tahun_tujuan."
			)) as table_sum_antiaging 
		group by tgl_tindakan

	)

	
	/*  NON-MEDIS */
	/*
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and MONTH(master_jual_rawat.jrawat_tanggal) = ".$bulan_tujuan." and YEAR(master_jual_rawat.jrawat_tanggal) = ".$tahun_tujuan."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and MONTH(detail_ambil_paket.dapaket_tgl_ambil) = ".$bulan_tujuan." and YEAR(detail_ambil_paket.dapaket_tgl_ambil) = ".$tahun_tujuan."
			)) as table_sum_nonmedis
		group by tgl_tindakan
	)

	/* PRODUK*/
	/*
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
		left join vu_customer on (master_jual_produk.jproduk_cust = vu_customer.cust_id)
		where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and MONTH(master_jual_produk.jproduk_tanggal) = ".$bulan_tujuan." and YEAR(master_jual_produk.jproduk_tanggal) = ".$tahun_tujuan."
		group by tgl_tindakan
	)

	/* TOTAL*/
	/*
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				where master_jual_rawat.jrawat_stat_dok ='Tertutup'
				and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and MONTH(master_jual_rawat.jrawat_tanggal) = ".$bulan_tujuan." and YEAR(master_jual_rawat.jrawat_tanggal) = ".$tahun_tujuan."
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
				left join vu_customer on (master_jual_produk.jproduk_cust = vu_customer.cust_id)
				where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and MONTH(master_jual_produk.jproduk_tanggal) = ".$bulan_tujuan." and YEAR(master_jual_produk.jproduk_tanggal) = ".$tahun_tujuan."
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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and MONTH(detail_ambil_paket.dapaket_tgl_ambil) = ".$bulan_tujuan." and YEAR(detail_ambil_paket.dapaket_tgl_ambil) = ".$tahun_tujuan."
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
		/*
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
					left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
					left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."
			)) as table_sum_medis
		group by tgl_tindakan
	)
	
	/* SURGERY */
	/*
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."
			)) as table_sum_surgery
		group by tgl_tindakan

	)

	/* ANTI AGING */
	/*
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."
			)) as table_sum_antiaging
		group by tgl_tindakan

	)

	
	/*  NON-MEDIS */
	/*
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."
			)) as table_sum_nonmedis
		group by tgl_tindakan
	)

	/* PRODUK*/
	/*
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
		left join vu_customer on (master_jual_produk.fproduk_cust = vu_customer.cust_id)
		where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and master_jual_produk.jproduk_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
		group by tgl_tindakan
	)

	/* TOTAL*/
	/*
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				where master_jual_rawat.jrawat_stat_dok ='Tertutup'
				and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (master_jual_produk.jproduk_cust = vu_customer.cust_id)
				where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and master_jual_produk.jproduk_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
			)
			
			)as table_union2
		group by tgl_tindakan
	)
) as table_union";
			}
		*/	
		}
	}
		
	//function for advanced search record
	function lap_kunjungan_search2($lap_kunjungan_id  ,$lap_kunjungan_tgllahir, $lap_kunjungan_tgllahirend,$lap_kunjungan_umurstart, $lap_kunjungan_umurend,$trawat_tglapp_start ,$trawat_tglapp_end ,$lap_kunjungan_kelamin, $lap_kunjungan_member,$lap_kunjungan_cust, $start,$end){
			//full query

		
		if ($lap_kunjungan_kelamin == '' or $lap_kunjungan_kelamin == 'S')
		{
			$cust_kelamin = "";
		}			
		else if ($lap_kunjungan_kelamin == 'P')
		{
			$cust_kelamin = " and vu_customer.cust_kelamin = '$lap_kunjungan_kelamin'";
		}
		else if($lap_kunjungan_kelamin == 'L')
		{
			$cust_kelamin = " and vu_customer.cust_kelamin = '$lap_kunjungan_kelamin'";			
		}
		
		if ($lap_kunjungan_cust == '' or $lap_kunjungan_cust == 'Semua')
		{
			$cust_daftar = "";
		}
		else if ($lap_kunjungan_cust == 'Lama')
		{
			$cust_daftar = " and vu_customer.cust_terdaftar not between '$trawat_tglapp_start' and '$trawat_tglapp_end'";
		}
		else if($lap_kunjungan_cust == 'Baru')
		{
			$cust_daftar = " and vu_customer.cust_terdaftar between '$trawat_tglapp_start' and '$trawat_tglapp_end'";			
		}			
		
		if ($lap_kunjungan_member == '' or $lap_kunjungan_member == 'Semua')
		{
			$stat_member = "";
		}
		else if ($lap_kunjungan_member == 'Lama')
		{
			$stat_member = " and vu_customer.member_register not between '$trawat_tglapp_start' and '$trawat_tglapp_end'";
		}
		else if($lap_kunjungan_member == 'Baru')
		{
			$stat_member = " and vu_customer.member_register between '$trawat_tglapp_start' and '$trawat_tglapp_end'";
		}
		else if($lap_kunjungan_member == 'Non Member')
		{
			$stat_member = " and vu_customer.cust_member = 0";
		}
		
			
		if($lap_kunjungan_tgllahir!='' and $lap_kunjungan_tgllahirend!=''){
			$tgllahir= " and cust_tgllahir BETWEEN '$lap_kunjungan_tgllahir' AND '$lap_kunjungan_tgllahirend'";
		}else if ($lap_kunjungan_tgllahir!='' and $lap_kunjungan_tgllahirend==''){
			$tgllahir= " and cust_tgllahir BETWEEN '$lap_kunjungan_tgllahir' AND now()";
		}else if ($lap_kunjungan_tgllahir=='' and $lap_kunjungan_tgllahirend!=''){
			$tgllahir= " and cust_tgllahir < '$lap_kunjungan_tgllahirend'";
		}else if ($lap_kunjungan_tgllahir=='' and $lap_kunjungan_tgllahirend==''){
			$tgllahir= "";
		}


		if($lap_kunjungan_umurstart!='' and $lap_kunjungan_umurend!=''){
			$umur= " and (year(now())-year(cust_tgllahir)) BETWEEN '$lap_kunjungan_umurstart' AND '$lap_kunjungan_umurend'";
		}else if ($lap_kunjungan_umurstart!='' and $lap_kunjungan_umurend==''){
			$umur= " and (year(now())-year(cust_tgllahir)) > '$lap_kunjungan_umurstart'";
		}else if ($lap_kunjungan_umurstart=='' and $lap_kunjungan_umurend!=''){
			$umur= " and (year(now())-year(cust_tgllahir)) < '$lap_kunjungan_umurend'";
		}else if ($lap_kunjungan_umurstart=='' and $lap_kunjungan_umurend==''){
			$umur= "";
		}

		
		//jika ada penggantian di query ini, sesuaikan juga query di m_crm_generator, bagian FREQUENCY, SPENDING, JUMLAH TX UTAMA
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
					left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'and vu_customer.cust_kelamin = '".$lap_kunjungan_kelamin."'".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
		left join vu_customer on (master_jual_produk.jproduk_cust = vu_customer.cust_id)
		where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and master_jual_produk.jproduk_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				where master_jual_rawat.jrawat_stat_dok ='Tertutup'
				and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (master_jual_produk.jproduk_cust = vu_customer.cust_id)
				where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and master_jual_produk.jproduk_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
					left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
					left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."
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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."
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
		left join vu_customer on (master_jual_produk.jproduk_cust = vu_customer.cust_id)
		where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and master_jual_produk.jproduk_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				where master_jual_rawat.jrawat_stat_dok ='Tertutup'
				and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (master_jual_produk.jproduk_cust = vu_customer.cust_id)
				where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and master_jual_produk.jproduk_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."
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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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

	function lap_kunjungan_search3($lap_kunjungan_id  ,$lap_kunjungan_tgllahir, $lap_kunjungan_tgllahirend,$lap_kunjungan_umurstart, $lap_kunjungan_umurend,$trawat_tglapp_start ,$trawat_tglapp_end ,$lap_kunjungan_kelamin, $lap_kunjungan_member,$lap_kunjungan_cust, $start,$end){
			//full query
		
		
		if ($lap_kunjungan_kelamin == '' or $lap_kunjungan_kelamin == 'S')
		{
			$cust_kelamin = "";
		}			
		else if ($lap_kunjungan_kelamin == 'P')
		{
			$cust_kelamin = " and vu_customer.cust_kelamin = '$lap_kunjungan_kelamin'";
		}
		else if($lap_kunjungan_kelamin == 'L')
		{
			$cust_kelamin = " and vu_customer.cust_kelamin = '$lap_kunjungan_kelamin'";			
		}
		
		if ($lap_kunjungan_cust == '' or $lap_kunjungan_cust == 'Semua')
		{
			$cust_daftar = "";
		}
		else if ($lap_kunjungan_cust == 'Lama')
		{
			$cust_daftar = " and vu_customer.cust_terdaftar not between '$trawat_tglapp_start' and '$trawat_tglapp_end'";
		}
		else if($lap_kunjungan_cust == 'Baru')
		{
			$cust_daftar = " and vu_customer.cust_terdaftar between '$trawat_tglapp_start' and '$trawat_tglapp_end'";			
		}	
	
		if ($lap_kunjungan_member == '' or $lap_kunjungan_member == 'Semua')
		{
			$stat_member = "";
		}
		else if ($lap_kunjungan_member == 'Lama')
		{
			$stat_member = " and vu_customer.member_register not between '$trawat_tglapp_start' and '$trawat_tglapp_end'";
		}
		else if($lap_kunjungan_member == 'Baru')
		{
			$stat_member = " and vu_customer.member_register between '$trawat_tglapp_start' and '$trawat_tglapp_end'";
		}
		else if($lap_kunjungan_member == 'Non Member')
		{
			$stat_member = " and vu_customer.cust_member = 0";
		}
		
		
		if($lap_kunjungan_tgllahir!='' and $lap_kunjungan_tgllahirend!=''){
			$tgllahir= " and cust_tgllahir BETWEEN '$lap_kunjungan_tgllahir' AND '$lap_kunjungan_tgllahirend'";
		}else if ($lap_kunjungan_tgllahir!='' and $lap_kunjungan_tgllahirend==''){
			$tgllahir= " and cust_tgllahir BETWEEN '$lap_kunjungan_tgllahir' AND now()";
		}else if ($lap_kunjungan_tgllahir=='' and $lap_kunjungan_tgllahirend!=''){
			$tgllahir= " and cust_tgllahir < '$lap_kunjungan_tgllahirend'";
		}else if ($lap_kunjungan_tgllahir=='' and $lap_kunjungan_tgllahirend==''){
			$tgllahir= "";
		}
	
		if($lap_kunjungan_umurstart!='' and $lap_kunjungan_umurend!=''){
			$umur= " and (year(now())-year(cust_tgllahir)) BETWEEN '$lap_kunjungan_umurstart' AND '$lap_kunjungan_umurend'";
		}else if ($lap_kunjungan_umurstart!='' and $lap_kunjungan_umurend==''){
			$umur= " and (year(now())-year(cust_tgllahir)) > '$lap_kunjungan_umurstart'";
		}else if ($lap_kunjungan_umurstart=='' and $lap_kunjungan_umurend!=''){
			$umur= " and (year(now())-year(cust_tgllahir)) < '$lap_kunjungan_umurend'";
		}else if ($lap_kunjungan_umurstart=='' and $lap_kunjungan_umurend==''){
			$umur= "";
		}

			
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
					left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
					left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
		left join vu_customer on (master_jual_produk.jproduk_cust = vu_customer.cust_id)
		where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and master_jual_produk.jproduk_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				where master_jual_rawat.jrawat_stat_dok ='Tertutup'
				and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (master_jual_produk.jproduk_cust = vu_customer.cust_id)
				where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and master_jual_produk.jproduk_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
					left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
					left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
					where perawatan.rawat_kategori = 2 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 2 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 4 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 4 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				left join perawatan on (detail_ambil_paket.dapaket_item = perawatan.rawat_id)
				where perawatan.rawat_kategori = 16 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where perawatan.rawat_kategori = 3 and master_jual_rawat.jrawat_stat_dok='Tertutup' and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."

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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where perawatan.rawat_kategori = 3 and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
		left join vu_customer on (master_jual_produk.jproduk_cust = vu_customer.cust_id)
		where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and master_jual_produk.jproduk_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (master_jual_rawat.jrawat_cust = vu_customer.cust_id)
				left join perawatan on (detail_jual_rawat.drawat_rawat=perawatan.rawat_id)
				where master_jual_rawat.jrawat_stat_dok ='Tertutup'
				and (master_jual_rawat.jrawat_totalbiaya <> 0 or master_jual_rawat.jrawat_cashback <> 0) and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and master_jual_rawat.jrawat_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				where master_jual_produk.jproduk_stat_dok ='Tertutup' and (master_jual_produk.jproduk_totalbiaya <> 0 or master_jual_produk.jproduk_cashback <> 0) and master_jual_produk.jproduk_tanggal = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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
				left join vu_customer on (detail_ambil_paket.dapaket_cust = vu_customer.cust_id)
				where (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3 or perawatan.rawat_kategori = 4 or perawatan.rawat_kategori = 16) and detail_ambil_paket.dapaket_stat_dok ='Tertutup' and detail_ambil_paket.dapaket_tgl_ambil = '".$trawat_tglapp_start."'".$cust_kelamin."".$cust_daftar."".$stat_member."".$umur."".$tgllahir."
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