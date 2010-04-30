<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: tindakan Model
	+ Description	: For record model process back-end
	+ Filename 		: c_tindakan.php
 	+ Author  		: masongbee
 	+ Created on 27/Oct/2009 14:21:34
	
*/

class M_lap_kunjungan extends Model{
		
	//constructor
	function M_lap_kunjungan() {
		parent::Model();
	}
			
	//get master id, note : not done yet
	function get_master_id() {
		$query = "SELECT max(trawat_id) as master_id from tindakan";
		$result = $this->db->query($query);
		if($result->num_rows()){
			$data=$result->row();
			$master_id=$data->master_id;
			return $master_id;
		}else{
			return '0';
		}
	}
	//eof

		
		//function for get list record
		function lap_kunjungan_list($filter,$start,$end){
			$date_now=date('Y-m-d');
			$query="select date_format(tgl_tindakan, '%Y-%m-%d') as tgl_tindakan,
sum(jum_cust_medis),
sum(jum_cust_nonmedis),
sum(jum_cust_produk), 
sum(jum_total)
from
(
	(
		select 
			count(distinct tindakan.trawat_cust) as jum_cust_medis,
			0 as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			tindakan_detail.dtrawat_tglapp as tgl_tindakan
		from tindakan_detail
		left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
		left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
		where perawatan.rawat_kategori = 2 and tindakan_detail.dtrawat_status='selesai' and perawatan.rawat_harga <> 0 and tindakan_detail.dtrawat_tglapp = '$date_now'
		group by tgl_tindakan
	)
	union
	(
		select 
			0 as jum_cust_medis,
			count(distinct tindakan.trawat_cust) as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			tindakan_detail.dtrawat_tglapp as tgl_tindakan
		from tindakan_detail
		left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
		left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
		where perawatan.rawat_kategori = 3 and tindakan_detail.dtrawat_status='selesai' and perawatan.rawat_harga <> 0 and tindakan_detail.dtrawat_tglapp = '$date_now'
		group by tgl_tindakan
	)
	union
	(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_nonmedis,
			count(distinct master_jual_produk.jproduk_cust) as jum_cust_produk,
			0 as jum_total,
			master_jual_produk.jproduk_tanggal as tgl_tindakan
		from master_jual_produk
		where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_tanggal = '$date_now'
		group by tgl_tindakan
	)
	union
	(
		
		select 
			jum_cust_medis,
			jum_cust_nonmedis,
			jum_cust_produk,
			count(distinct cust) as jum_total,
			tgl_tindakan
			from
			((	
				select 
					0 as jum_cust_medis,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					tindakan.trawat_cust as cust,
					tindakan_detail.dtrawat_tglapp as tgl_tindakan
				from tindakan_detail
				left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
				left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
				where tindakan_detail.dtrawat_status = 'selesai'
				and perawatan.rawat_harga <> 0 and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3)
			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_produk.jproduk_cust as cust,
					master_jual_produk.jproduk_tanggal as tgl_tindakan
				from master_jual_produk
				where master_jual_produk.jproduk_stat_dok <> 'Batal'
			))as table_union2
		where tgl_tindakan = '$date_now'
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
sum(jum_cust_nonmedis),
sum(jum_cust_produk), 
sum(jum_total)
from
(
	(
		select 
			count(distinct tindakan.trawat_cust) as jum_cust_medis,
			0 as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			tindakan_detail.dtrawat_tglapp as tgl_tindakan
		from tindakan_detail
		left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
		left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
		where perawatan.rawat_kategori = 2 and tindakan_detail.dtrawat_status='selesai' and perawatan.rawat_harga <> 0 and tindakan_detail.dtrawat_tglapp = '$date_now'
		group by tgl_tindakan
	)
	union
	(
		select 
			0 as jum_cust_medis,
			count(distinct tindakan.trawat_cust) as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			tindakan_detail.dtrawat_tglapp as tgl_tindakan
		from tindakan_detail
		left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
		left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
		where perawatan.rawat_kategori = 3 and tindakan_detail.dtrawat_status='selesai' and perawatan.rawat_harga <> 0 and tindakan_detail.dtrawat_tglapp = '$date_now'
		group by tgl_tindakan
	)
	union
	(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_nonmedis,
			count(distinct master_jual_produk.jproduk_cust) as jum_cust_produk,
			0 as jum_total,
			master_jual_produk.jproduk_tanggal as tgl_tindakan
		from master_jual_produk
		where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_tanggal = '$date_now'
		group by tgl_tindakan
	)
	union
	(
		
		select 
			jum_cust_medis,
			jum_cust_nonmedis,
			jum_cust_produk,
			count(distinct cust) as jum_total,
			tgl_tindakan
			from
			((	
				select 
					0 as jum_cust_medis,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					tindakan.trawat_cust as cust,
					tindakan_detail.dtrawat_tglapp as tgl_tindakan
				from tindakan_detail
				left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
				left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
				where tindakan_detail.dtrawat_status = 'selesai'
				and perawatan.rawat_harga <> 0 and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3)
			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_produk.jproduk_cust as cust,
					master_jual_produk.jproduk_tanggal as tgl_tindakan
				from master_jual_produk
				where master_jual_produk.jproduk_stat_dok <> 'Batal'
			))as table_union2
		where tgl_tindakan = '$date_now'
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
sum(jum_cust_nonmedis),
sum(jum_cust_produk), 
sum(jum_total)
from
(
	(
		select 
			count(distinct tindakan.trawat_cust) as jum_cust_medis,
			0 as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			tindakan_detail.dtrawat_tglapp as tgl_tindakan
		from tindakan_detail
		left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
		left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
		where perawatan.rawat_kategori = 2 and tindakan_detail.dtrawat_status='selesai' and perawatan.rawat_harga <> 0 and tindakan_detail.dtrawat_tglapp between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
		group by tgl_tindakan
	)
	union
	(
		select 
			0 as jum_cust_medis,
			count(distinct tindakan.trawat_cust) as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			tindakan_detail.dtrawat_tglapp as tgl_tindakan
		from tindakan_detail
		left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
		left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
		where perawatan.rawat_kategori = 3 and tindakan_detail.dtrawat_status='selesai' and perawatan.rawat_harga <> 0 and tindakan_detail.dtrawat_tglapp between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
		group by tgl_tindakan
	)
	union
	(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_nonmedis,
			count(distinct master_jual_produk.jproduk_cust) as jum_cust_produk,
			0 as jum_total,
			master_jual_produk.jproduk_tanggal as tgl_tindakan
		from master_jual_produk
		where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
		group by tgl_tindakan
	)
	union
	(
		
		select 
			jum_cust_medis,
			jum_cust_nonmedis,
			jum_cust_produk,
			count(distinct cust) as jum_total,
			tgl_tindakan
			from
			((	
				select 
					0 as jum_cust_medis,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					tindakan.trawat_cust as cust,
					tindakan_detail.dtrawat_tglapp as tgl_tindakan
				from tindakan_detail
				left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
				left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
				where tindakan_detail.dtrawat_status = 'selesai'
				and perawatan.rawat_harga <> 0 and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3)
			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_produk.jproduk_cust as cust,
					master_jual_produk.jproduk_tanggal as tgl_tindakan
				from master_jual_produk
				where master_jual_produk.jproduk_stat_dok <> 'Batal'
			))as table_union2
		where tgl_tindakan between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
		group by tgl_tindakan
	)
) as table_union";

}
			/*if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
				$query.=eregi("WHERE",$query)?" WHERE ":" WHERE ";
				$query.= " table_union.tgl_tindakan BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."'";
			}*/
			else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
				
			$query = "select date_format(tgl_tindakan, '%Y-%m-%d') as tgl_tindakan,
sum(jum_cust_medis),
sum(jum_cust_nonmedis),
sum(jum_cust_produk), 
sum(jum_total)
from
(
	(
		select 
			count(distinct tindakan.trawat_cust) as jum_cust_medis,
			0 as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			tindakan_detail.dtrawat_tglapp as tgl_tindakan
		from tindakan_detail
		left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
		left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
		where perawatan.rawat_kategori = 2 and tindakan_detail.dtrawat_status='selesai' and perawatan.rawat_harga <> 0 and tindakan_detail.dtrawat_tglapp = '".$trawat_tglapp_start."'
		group by tgl_tindakan
	)
	union
	(
		select 
			0 as jum_cust_medis,
			count(distinct tindakan.trawat_cust) as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			tindakan_detail.dtrawat_tglapp as tgl_tindakan
		from tindakan_detail
		left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
		left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
		where perawatan.rawat_kategori = 3 and tindakan_detail.dtrawat_status='selesai' and perawatan.rawat_harga <> 0 and tindakan_detail.dtrawat_tglapp = '".$trawat_tglapp_start."'
		group by tgl_tindakan
	)
	union
	(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_nonmedis,
			count(distinct master_jual_produk.jproduk_cust) as jum_cust_produk,
			0 as jum_total,
			master_jual_produk.jproduk_tanggal as tgl_tindakan
		from master_jual_produk
		where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_tanggal = '".$trawat_tglapp_start."'
		group by tgl_tindakan
	)
	union
	(
		
		select 
			jum_cust_medis,
			jum_cust_nonmedis,
			jum_cust_produk,
			count(distinct cust) as jum_total,
			tgl_tindakan
			from
			((	
				select 
					0 as jum_cust_medis,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					tindakan.trawat_cust as cust,
					tindakan_detail.dtrawat_tglapp as tgl_tindakan
				from tindakan_detail
				left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
				left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
				where tindakan_detail.dtrawat_status = 'selesai'
				and perawatan.rawat_harga <> 0 and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3)
			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_produk.jproduk_cust as cust,
					master_jual_produk.jproduk_tanggal as tgl_tindakan
				from master_jual_produk
				where master_jual_produk.jproduk_stat_dok <> 'Batal'
			))as table_union2
		where tgl_tindakan = '".$trawat_tglapp_start."'
		group by tgl_tindakan
	)
) as table_union";
			}
			//$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
			//$query.=" k.karyawan_id != 60 and p.rawat_id is not null"; //60 = Available . Dr
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
sum(jum_cust_nonmedis),
sum(jum_cust_produk), 
sum(jum_total)
from
(
	(
		select 
			count(distinct tindakan.trawat_cust) as jum_cust_medis,
			0 as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			tindakan_detail.dtrawat_tglapp as tgl_tindakan
		from tindakan_detail
		left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
		left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
		where perawatan.rawat_kategori = 2 and tindakan_detail.dtrawat_status='selesai' and perawatan.rawat_harga <> 0 and tindakan_detail.dtrawat_tglapp between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
		group by tgl_tindakan
	)
	union
	(
		select 
			0 as jum_cust_medis,
			count(distinct tindakan.trawat_cust) as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			tindakan_detail.dtrawat_tglapp as tgl_tindakan
		from tindakan_detail
		left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
		left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
		where perawatan.rawat_kategori = 3 and tindakan_detail.dtrawat_status='selesai' and perawatan.rawat_harga <> 0 and tindakan_detail.dtrawat_tglapp between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
		group by tgl_tindakan
	)
	union
	(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_nonmedis,
			count(distinct master_jual_produk.jproduk_cust) as jum_cust_produk,
			0 as jum_total,
			master_jual_produk.jproduk_tanggal as tgl_tindakan
		from master_jual_produk
		where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_tanggal between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
		group by tgl_tindakan
	)
	union
	(
		
		select 
			jum_cust_medis,
			jum_cust_nonmedis,
			jum_cust_produk,
			count(distinct cust) as jum_total,
			tgl_tindakan
			from
			((	
				select 
					0 as jum_cust_medis,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					tindakan.trawat_cust as cust,
					tindakan_detail.dtrawat_tglapp as tgl_tindakan
				from tindakan_detail
				left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
				left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
				where tindakan_detail.dtrawat_status = 'selesai'
				and perawatan.rawat_harga <> 0 and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3)
			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_produk.jproduk_cust as cust,
					master_jual_produk.jproduk_tanggal as tgl_tindakan
				from master_jual_produk
				where master_jual_produk.jproduk_stat_dok <> 'Batal'
			))as table_union2
		where tgl_tindakan between '".$trawat_tglapp_start."' and '".$trawat_tglapp_end."'
		group by tgl_tindakan
	)
) as table_union";

}
			/*if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
				$query.=eregi("WHERE",$query)?" WHERE ":" WHERE ";
				$query.= " table_union.tgl_tindakan BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."'";
			}*/
			else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
				
			$query = "select date_format(tgl_tindakan, '%Y-%m-%d') as tgl_tindakan,
sum(jum_cust_medis),
sum(jum_cust_nonmedis),
sum(jum_cust_produk), 
sum(jum_total)
from
(
	(
		select 
			count(distinct tindakan.trawat_cust) as jum_cust_medis,
			0 as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			tindakan_detail.dtrawat_tglapp as tgl_tindakan
		from tindakan_detail
		left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
		left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
		where perawatan.rawat_kategori = 2 and tindakan_detail.dtrawat_status='selesai' and perawatan.rawat_harga <> 0 and tindakan_detail.dtrawat_tglapp = '".$trawat_tglapp_start."'
		group by tgl_tindakan
	)
	union
	(
		select 
			0 as jum_cust_medis,
			count(distinct tindakan.trawat_cust) as jum_cust_nonmedis,
			0 as jum_cust_produk,
			0 as jum_total,
			tindakan_detail.dtrawat_tglapp as tgl_tindakan
		from tindakan_detail
		left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
		left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
		where perawatan.rawat_kategori = 3 and tindakan_detail.dtrawat_status='selesai' and perawatan.rawat_harga <> 0 and tindakan_detail.dtrawat_tglapp = '".$trawat_tglapp_start."'
		group by tgl_tindakan
	)
	union
	(
		select 
			0 as jum_cust_medis,
			0 as jum_cust_nonmedis,
			count(distinct master_jual_produk.jproduk_cust) as jum_cust_produk,
			0 as jum_total,
			master_jual_produk.jproduk_tanggal as tgl_tindakan
		from master_jual_produk
		where master_jual_produk.jproduk_stat_dok <> 'Batal' and master_jual_produk.jproduk_tanggal = '".$trawat_tglapp_start."'
		group by tgl_tindakan
	)
	union
	(
		
		select 
			jum_cust_medis,
			jum_cust_nonmedis,
			jum_cust_produk,
			count(distinct cust) as jum_total,
			tgl_tindakan
			from
			((	
				select 
					0 as jum_cust_medis,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					tindakan.trawat_cust as cust,
					tindakan_detail.dtrawat_tglapp as tgl_tindakan
				from tindakan_detail
				left join tindakan on (tindakan.trawat_id=tindakan_detail.dtrawat_master)
				left join perawatan on (tindakan_detail.dtrawat_perawatan=perawatan.rawat_id)
				where tindakan_detail.dtrawat_status = 'selesai'
				and perawatan.rawat_harga <> 0 and (perawatan.rawat_kategori = 2 or perawatan.rawat_kategori = 3)
			)
			union
			(
				select 
					0 as jum_cust_medis,
					0 as jum_cust_nonmedis,
					0 as jum_cust_produk,
					master_jual_produk.jproduk_cust as cust,
					master_jual_produk.jproduk_tanggal as tgl_tindakan
				from master_jual_produk
				where master_jual_produk.jproduk_stat_dok <> 'Batal'
			))as table_union2
		where tgl_tindakan = '".$trawat_tglapp_start."'
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
		function lap_kunjungan_print($trawat_id ,$trawat_cust ,$trawat_keterangan ,$option,$filter){
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
		}
		
		//function  for export to excel
		function lap_lunjungan_export_excel($trawat_id ,$trawat_dokter ,$option,$filter){
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
		}
		
}
?>