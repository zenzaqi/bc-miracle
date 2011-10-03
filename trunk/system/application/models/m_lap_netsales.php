<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
		
	+ Module  		: Laporan Net Sales Model
	+ Description	: For record model process back-end
	+ Filename 		: m_lap_netsales.php
 	+ Author  		: Miracle Corporate IT Dept
 	+ Created on 2011-10-03
	
*/

class M_lap_netsales extends Model{
		
		//constructor
		function M_lap_netsales() {
			parent::Model();
		}
		
	// net sales
	function get_laporan_netsales_recalc($tgl_awal, $tgl_akhir, $periode, $bulan, $tahun){

		if ($periode == 'bulan'){
			$tgl_awal	= $tahun.'-'.$bulan.'-01';
			$tgl_akhir	= $tahun.'-'.$bulan.'-'.cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); //mengetahui jumlah hari dlm bulan itu
		}									   
	
		//bersihkan tabel temporary sesuai tgl ybs
		$sql_del	=  "delete t from temp_netsales t
						where t.tns_tanggal between '".$tgl_awal."' and '".$tgl_akhir."'";
		$this->db->query($sql_del);
		
		//mendapatkan list tanggal transaksi
		$sql_get_tanggal = "select distinct m1.jproduk_tanggal as tgl
							from master_jual_produk m1
							where 
								m1.jproduk_stat_dok = 'Tertutup'
								and m1.jproduk_tanggal between '".$tgl_awal."' and '".$tgl_akhir."'

							union

							select distinct m2.jrawat_tanggal as tgl
							from master_jual_rawat m2
							where
								m2.jrawat_stat_dok = 'Tertutup'
								and m2.jrawat_tanggal between '".$tgl_awal."' and '".$tgl_akhir."'

							union
								
							select distinct d.dapaket_tgl_ambil as tgl
							from detail_ambil_paket d
							where
								d.dapaket_stat_dok = 'Tertutup'
								and d.dapaket_tgl_ambil  between '".$tgl_awal."' and '".$tgl_akhir."'";
								
		$list_tgl = $this->db->query($sql_get_tanggal);	
		
		//insert ke tabel temp
		$i = 0;
		foreach($list_tgl->result() as $row){
			$record = $list_tgl->row_array($i);
			
			$sql_pr		=  "call pr_netsales('".$record['tgl']."', '".$record['tgl']."', 'Rekap', 
							@SalesMedis, @SalesNonMedis, @SalesSurgery, @SalesAntiAging, @SalesProduk, @SalesLainLain, @SalesTotal)";		
			$this->db->query($sql_pr);							
					
			$sql_ins	=  "insert into temp_netsales (tns_tanggal, tns_medis, tns_nonmedis, tns_surgery, tns_antiaging, tns_produk, tns_lainlain, tns_total)
							select '".$record['tgl']."',@SalesMedis, @SalesNonMedis, @SalesSurgery, @SalesAntiAging, @SalesProduk, @SalesLainLain, @SalesTotal;";
			$this->db->query($sql_ins);				
							
			//print_r($record);
			$i++;
		}
		
		//select dari tabel temp / hasilnya
		$sql		=  "select *
						from temp_netsales t
						where t.tns_tanggal between '".$tgl_awal."' and '".$tgl_akhir."'
						order by t.tns_tanggal asc";
				
		$result = $this->db->query($sql);
		$nbrows = $result->num_rows();
		//return $query->result();
		
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

	function get_laporan_netsales($tgl_awal, $tgl_akhir, $periode, $bulan, $tahun){

		if ($periode == 'bulan'){
			$tgl_awal	= $tahun.'-'.$bulan.'-01';
			$tgl_akhir	= $tahun.'-'.$bulan.'-'.cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); //mengetahui jumlah hari dlm bulan itu
		}									   
	
		//select dari tabel temp / hasilnya
		$sql		=  "select *
						from temp_netsales t
						where t.tns_tanggal between '".$tgl_awal."' and '".$tgl_akhir."'
						order by t.tns_tanggal asc";
				
		$result = $this->db->query($sql);
		$nbrows = $result->num_rows();
		//return $query->result();
		
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
	// eof net sales
	
	function get_laporan_netsalestotal($tgl_awal, $tgl_akhir, $periode, $bulan, $tahun){

		if ($periode == 'bulan'){
			$tgl_awal	= $tahun.'-'.$bulan.'-01';
			$tgl_akhir	= $tahun.'-'.$bulan.'-'.cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun); //mengetahui jumlah hari dlm bulan itu
		}									   	
			
		$sql		=  "select 
							sum(tns_medis) as tns_medis_total,
							sum(tns_nonmedis) as tns_nonmedis_total,
							sum(tns_surgery) as tns_surgery_total,
							sum(tns_antiaging) as tns_antiaging_total,
							sum(tns_produk) as tns_produk_total,
							sum(tns_lainlain) as tns_lainlain_total,
							sum(tns_total) as tns_grand_total
						from temp_netsales t
						where t.tns_tanggal between '".$tgl_awal."' and '".$tgl_akhir."'";
				
		$result = $this->db->query($sql);
		$nbrows = $result->num_rows();
		//return $query->result();
		
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

}
?>