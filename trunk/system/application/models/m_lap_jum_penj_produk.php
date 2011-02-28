<? /* 
	+ Module  		: LAporan Jumlah Penjualan Produk Model
	+ Description	: For record model process back-end
	+ Filename 		: c_lap_jum_penj_produk.php
 	+ Author  		: Fred

*/

class M_lap_jum_penj_produk extends Model{
		
	//constructor
	function M_lap_jum_penj_produk() {
		parent::Model();
	}

		
	//function for get list record
	function lap_jum_penj_produk_list($filter,$start,$end){
			$date_now=date('Y-m-d');
			//$query = "SELECT d.dtrawat_date_create, k.karyawan_username, p.rawat_nama from tindakan_detail d left outer join karyawan k on k.karyawan_id=d.dtrawat_petugas1 left outer join perawatan p on p.rawat_id = d.dtrawat_perawatan where d.dtrawat_date_create > '2010-01-31'";
			$query = "";
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			//$query.=" order by k.karyawan_id";
			
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
		
	function lap_jum_penj_produk_list2($filter,$start,$end){
			$date_now=date('Y-m-d');
			//$query = "SELECT d.dtrawat_date_create, k.karyawan_username, p.rawat_nama from tindakan_detail d left outer join karyawan k on k.karyawan_id=d.dtrawat_petugas1 left outer join perawatan p on p.rawat_id = d.dtrawat_perawatan where d.dtrawat_date_create > '2010-01-31'";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			$query.=" order by k.karyawan_id";
			
			//$query2 = "SELECT * FROM vu_tindakan WHERE kategori_nama='Medis' AND dtrawat_tglapp='$date_now'"; //TAMPILAN MEDIS SAJA
			//$query2 = "SELECT medis.* FROM vu_tindakan medis WHERE (medis.kategori_nama='Medis' OR medis.dtrawat_master IN(SELECT nonmedis.dtrawat_master FROM vu_tindakan nonmedis WHERE nonmedis.kategori_nama='Non Medis' AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND nonmedis.dtrawat_dapp='0')) AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d')";
			$query2 = "SELECT * FROM vu_tindakan WHERE date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND (kategori_nama='Medis' OR dtrawat_petugas2='0')";
			
			// For simple search
			if ($filter<>""){
				$query2 .=eregi("WHERE",$query2)? " AND ":" WHERE ";
				$query2 .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			$query2.=" AND dtrawat_status='datang'";
			
			//$query3 = "SELECT * FROM vu_tindakan WHERE kategori_nama='Medis' AND dtrawat_tglapp='$date_now'"; //TAMPILAN MEDIS SAJA
			//$query3 = "SELECT medis.* FROM vu_tindakan medis WHERE (medis.kategori_nama='Medis' OR medis.dtrawat_master IN(SELECT nonmedis.dtrawat_master FROM vu_tindakan nonmedis WHERE nonmedis.kategori_nama='Non Medis' AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND nonmedis.dtrawat_dapp='0')) AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d')";
			$query3 = "SELECT * FROM vu_tindakan WHERE date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND (kategori_nama='Medis' OR dtrawat_petugas2='0')";
			
			// For simple search
			if ($filter<>""){
				$query3 .=eregi("WHERE",$query3)? " AND ":" WHERE ";
				$query3 .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			$query3.=" AND dtrawat_status='selesai'";
			
			//$query4 = "SELECT * FROM vu_tindakan WHERE kategori_nama='Medis' AND dtrawat_tglapp='$date_now'"; //TAMPILAN MEDIS SAJA
			//$query4 = "SELECT medis.* FROM vu_tindakan medis WHERE (medis.kategori_nama='Medis' OR medis.dtrawat_master IN(SELECT nonmedis.dtrawat_master FROM vu_tindakan nonmedis WHERE nonmedis.kategori_nama='Non Medis' AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND nonmedis.dtrawat_dapp='0')) AND date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d')";
			$query4 = "SELECT * FROM vu_tindakan WHERE date_format(dtrawat_tglapp,'%Y-%m-%d') = date_format('$date_now','%Y-%m-%d') AND (kategori_nama='Medis' OR dtrawat_petugas2='0')";
			
			// For simple search
			if ($filter<>""){
				$query4 .=eregi("WHERE",$query4)? " AND ":" WHERE ";
				$query4 .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			$query4.=" AND dtrawat_status='batal'";
			
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			//$limit = $query." LIMIT ".$start.",".$end;		
			//$result = $this->db->query($limit);  
			$result2 = $this->db->query($query2);
			$nbrows2 = $result2->num_rows();
			
			$result3 = $this->db->query($query3);
			$nbrows3 = $result3->num_rows();
			
			$result4 = $this->db->query($query4);
			$nbrows4 = $result4->num_rows();
			
			if($nbrows>0 || $nbrows2>0 || $nbrows3>0 || $nbrows4>0){
				if($nbrows>0){
					foreach($result->result() as $row){
						$arr[] = $row;
					}
				}
				if($nbrows2>0){
					foreach($result2->result() as $row2){
						$arr[] = $row2;
					}
				}
				if($nbrows3>0){
					foreach($result3->result() as $row3){
						$arr[] = $row3;
					}
				}
				if($nbrows4>0){
					foreach($result4->result() as $row4){
						$arr[] = $row4;
					}
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}	
		
	//function for advanced search record
	function lap_jum_penj_produk_search($ljpp_id ,$ljpp_tgl_start ,$ljpp_tgl_end ,$ljpp_karyawan_id, $ljpp_groupby, $start,$end){
			//full query	
			if ($ljpp_groupby == 'Semua')
			{
			$query="select karyawan.karyawan_username, produk.produk_kode, produk.produk_nama,
						master_jual_produk.jproduk_tanggal as tanggal,
						sum(detail_jual_produk.dproduk_jumlah) as Jumlah_produk
					from detail_jual_produk
					left join master_jual_produk on (detail_jual_produk.dproduk_master=master_jual_produk.jproduk_id)
					left join karyawan on (detail_jual_produk.dproduk_karyawan=karyawan.karyawan_id)
					left join produk on (detail_jual_produk.dproduk_produk=produk.produk_id)
						where master_jual_produk.jproduk_stat_dok = 'Tertutup'
						and (master_jual_produk.jproduk_tanggal between '".$ljpp_tgl_start."' and '".$ljpp_tgl_end."')
						and detail_jual_produk.dproduk_karyawan = '".$ljpp_karyawan_id."'
						group by karyawan.karyawan_username, produk.produk_nama
							";		
			}
		
			else if ($ljpp_groupby == 'Perawatan')
			{
	
			}
		
			else if ($ljpp_groupby == 'Pengambilan_Paket')
			{

			}
		
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
	function lap_jum_penj_produk_search2($ljpp_id ,$ljpp_tgl_start ,$ljpp_tgl_end ,$ljpp_karyawan_id, $ljpp_groupby, $start,$end){
			//full query
			if ($ljpp_groupby == 'Semua')
			{
			$query="select sum(vu_lap_jml_produk.Jumlah_produk) as Total_jumlah
				from
				(	
					select karyawan.karyawan_username, produk.produk_kode, produk.produk_nama,
						master_jual_produk.jproduk_tanggal as tanggal,
						sum(detail_jual_produk.dproduk_jumlah) as Jumlah_produk
					from detail_jual_produk
					left join master_jual_produk on (detail_jual_produk.dproduk_master=master_jual_produk.jproduk_id)
					left join karyawan on (detail_jual_produk.dproduk_karyawan=karyawan.karyawan_id)
					left join produk on (detail_jual_produk.dproduk_produk=produk.produk_id)
						where master_jual_produk.jproduk_stat_dok = 'Tertutup'
						and (master_jual_produk.jproduk_tanggal between '".$ljpp_tgl_start."' and '".$ljpp_tgl_end."')
						and detail_jual_produk.dproduk_karyawan = '".$ljpp_karyawan_id."'
						group by karyawan.karyawan_username, produk.produk_nama
				) as vu_lap_jml_produk
							";
							
			}
		
			/*if($ljpp_tgl_start!='' && $ljpp_tgl_end!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " ";
			}else if($ljpp_tgl_start!='' && $ljpp_tgl_end==''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " master_jual_rawat.jrawat_tanggal='".$ljpp_tgl_start."'";

			
			}*/

			else if ($ljpp_groupby == 'Perawatan')
			{

			}
			
			else if ($ljpp_groupby == 'Pengambilan_Paket')
			{
	
			}
			
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
	function report_tindakan_print($trawat_id ,$trawat_cust ,$trawat_keterangan ,$option,$filter){
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
	function lap_jum_penj_produk_exportExcel($trawat_id ,$ljpp_tgl_start , $ljpp_tgl_end, $ljpp_karyawan_id,
										$ljpp_groupby, $option, $filter){
			//full query
				
			if ($ljpp_groupby == 'Semua')
			{
			$query="select karyawan.karyawan_username, produk.produk_kode, produk.produk_nama,
						master_jual_produk.jproduk_tanggal as tanggal,
						sum(detail_jual_produk.dproduk_jumlah) as Jumlah_produk
					from detail_jual_produk
					left join master_jual_produk on (detail_jual_produk.dproduk_master=master_jual_produk.jproduk_id)
					left join karyawan on (detail_jual_produk.dproduk_karyawan=karyawan.karyawan_id)
					left join produk on (detail_jual_produk.dproduk_produk=produk.produk_id)
						where master_jual_produk.jproduk_stat_dok = 'Tertutup'
						and (master_jual_produk.jproduk_tanggal between '".$ljpp_tgl_start."' and '".$ljpp_tgl_end."')
						and detail_jual_produk.dproduk_karyawan = '".$ljpp_karyawan_id."'
						group by karyawan.karyawan_username, produk.produk_nama
							";
							
			}
		
			else if ($ljpp_groupby == 'Perawatan')
			{

			}
		
			else if ($ljpp_groupby == 'Pengambilan_Paket')
			{

			}
		 
			$result = $this->db->query($query);  
			return $result;
		}
		
}
?>