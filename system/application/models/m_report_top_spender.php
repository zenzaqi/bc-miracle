<? /* 	
	
	+ Module  		: Top Spender Model
	+ Description	: For record model process back-end
	+ Filename 		: c_report_top_spender.php
 	+ Author  		: Isaac
	Edited by		: Fred

*/

class M_report_top_spender extends Model{
		
	//constructor
	function M_report_top_spender() {
		parent::Model();
	}


	/* INSERT ke db.history_ambil_paket */
	function history_ambil_paket_insert($dpaket_id, $rpaket_perawatan, $trawat_cust, $dtrawat_id, $dtrawat_dapp){
		$dti_hapaket=array(
		"hapaket_dpaket"=>$dpaket_id,
		"hapaket_rawat"=>$rpaket_perawatan,
		"hapaket_jumlah"=>1,
		"hapaket_cust"=>$trawat_cust,
		"hapaket_dtrawat"=>$dtrawat_id
		);
		$this->db->insert('history_ambil_paket', $dti_hapaket);
		if($this->db->affected_rows()){
			/* me-LOCKED db.appointment_detail */
			$dtu_dapp=array(
			"dapp_locked"=>1
			);
			$this->db->where('dapp_id', $dtrawat_dapp);
			$this->db->update('appointment_detail', $dtu_dapp);
			
			/* UPDATE db.tindakan_detail.dtrawat_ambil_paket = 'true' */
			$dtu_dtrawat=array(
			"dtrawat_ambil_paket"=>'true'
			);
			$this->db->where('dtrawat_id', $dtrawat_id);
			$this->db->update('tindakan_detail', $dtu_dtrawat);
		}
	}
	/* eof history_ambil_paket_insert */
	
	/* INSERT ke db.history_ambil_paket */
	function history_ambil_paket_delete($dtrawat_id, $dtrawat_dapp){
		$this->db->where('hapaket_dtrawat', $dtrawat_id);
		$this->db->delete('history_ambil_paket');
		if($this->db->affected_rows()){
			/* meng-UNLOCK db.appointment_detail */
			$dtu_dapp=array(
			"dapp_locked"=>0
			);
			$this->db->where('dapp_id', $dtrawat_dapp);
			$this->db->update('appointment_detail', $dtu_dapp);
		}
	}
	/* eof history_ambil_paket_insert */

		//function for advanced search record
		function top_spender_search($trawat_id ,$trawat_tglapp_start ,$trawat_tglapp_end ,$top_jenis,$top_jumlah,$start,$end){
			//full query
			
			if ($top_jenis == 'Perawatan')
			{
				$query = "SELECT customer.cust_no, customer.cust_nama,customer.cust_member, SUM(master_jual_rawat.jrawat_bayar) as total 
						FROM master_jual_rawat LEFT OUTER JOIN customer
						ON master_jual_rawat.jrawat_cust = customer.cust_id";
			
				if($trawat_id!='')
				{
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_rawat.jrawat_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."'";
				};
			
				if($trawat_tglapp_start!='' && $trawat_tglapp_end!='')
				{
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_rawat.jrawat_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."'";
				}else if($trawat_tglapp_start!='' && $trawat_tglapp_end=='')
				{
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_rawat.jrawat_tanggal='".$trawat_tglapp_start."'";
				}
				$query.=" GROUP BY master_jual_rawat.jrawat_cust ORDER BY SUM(master_jual_rawat.jrawat_bayar) DESC";
			}
			else if ($top_jenis == 'Produk')
			{
				$query = "SELECT customer.cust_no, customer.cust_nama,customer.cust_member, SUM(master_jual_produk.jproduk_bayar) as total 
						FROM master_jual_produk LEFT OUTER JOIN customer
						ON master_jual_produk.jproduk_cust = customer.cust_id";
			
				if($trawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_produk.jproduk_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."'";
				};
			
				if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_produk.jproduk_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."'";
				}else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_produk.jproduk_tanggal='".$trawat_tglapp_start."'";
				}
				$query.=" GROUP BY master_jual_produk.jproduk_cust ORDER BY SUM(master_jual_produk.jproduk_bayar) DESC";
			}
			else if ($top_jenis == 'Paket')
			{
				$query = "SELECT customer.cust_no, customer.cust_nama,customer.cust_member, SUM(master_jual_paket.jpaket_bayar) as total 
						FROM master_jual_paket LEFT OUTER JOIN customer
						ON master_jual_paket.jpaket_cust = customer.cust_id";
			
				if($trawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_paket.jpaket_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."'";
				};
			
				if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_paket.jpaket_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."'";
				}else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_paket.jpaket_tanggal='".$trawat_tglapp_start."'";
				}
				$query.=" GROUP BY master_jual_paket.jpaket_cust ORDER BY SUM(master_jual_paket.jpaket_bayar) DESC";
			}
			else if ($top_jenis == 'Semua')
			{
				$query = "SELECT  customer.cust_no,customer.cust_nama,customer.cust_member,SUM(total) as total
					FROM
					(
						(	
							SELECT paket.jpaket_cust AS customer, paket.jpaket_bayar AS total  FROM master_jual_paket AS paket WHERE paket.jpaket_bayar IS NOT NULL AND (paket.jpaket_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."') ORDER BY paket.jpaket_bayar DESC 
						) 
						UNION
						(
							SELECT produk.jproduk_cust AS customer, produk.jproduk_bayar AS total  FROM master_jual_produk AS produk WHERE produk.jproduk_bayar IS NOT NULL AND (produk.jproduk_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."')  ORDER BY produk.jproduk_bayar DESC
						) 
						UNION	
						(
							SELECT rawat.jrawat_cust AS customer, rawat.jrawat_bayar AS total  FROM master_jual_rawat AS rawat WHERE rawat.jrawat_bayar IS NOT NULL AND (rawat.jrawat_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."' ) ORDER BY rawat.jrawat_bayar DESC
						)
					)AS table_union
					LEFT OUTER JOIN customer
					ON customer.cust_id = customer
					GROUP BY customer.cust_nama
					ORDER BY SUM(total) DESC";
		
			}
			$start = 0;
			$end = $top_jumlah;
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
		function tindakan_print($trawat_id ,$trawat_cust ,$trawat_keterangan ,$option,$filter){
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
		function tindakan_export_excel($trawat_id ,$trawat_dokter ,$option,$filter){
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
				/*if($rawat_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_nama LIKE '%".$rawat_nama."%'";
				};*/
				//$query.=" p.rawat_id is not null";
				$query.=" group by k.karyawan_username, p.rawat_nama";
				$result = $this->db->query($query);
				
				
				
			}
			return $result;
		}
		
}
?>