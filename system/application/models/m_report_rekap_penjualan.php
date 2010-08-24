<? /* 	
	
	+ Module  		: Top Spender Model
	+ Description	: For record model process back-end
	+ Filename 		: c_report_rekap_penjuualan.php
 	+ Author  		: Isaac
	Edited by		: Fred

*/

class M_report_rekap_penjualan extends Model{
		
	//constructor
	function M_report_rekap_penjualan() {
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
		function rekap_penjualan_search($rekap_penjualan_tglapp_start ,$rekap_penjualan_tglapp_end ,$rekap_penjualan_jenis,$start,$end){
			//full query
			if ($rekap_penjualan_jenis == '')
				$rekap_penjualan_jenis = 'Produk';
			
			//if ($top_jumlah == '')
			//	$top_jumlah = '10';
			
			if ($rekap_penjualan_jenis == 'Perawatan')
			{
				$query = "SELECT perawatan.rawat_kode AS kode, perawatan.rawat_nama AS nama, 
					SUM(detail_jual_rawat.drawat_jumlah) AS total_jumlah,
					SUM((detail_jual_rawat.drawat_jumlah * detail_jual_rawat.drawat_harga)-((detail_jual_rawat.drawat_jumlah * detail_jual_rawat.drawat_harga)*detail_jual_rawat.drawat_diskon/100)) AS subtotal,
					SUM((master_jual_rawat.jrawat_diskon * ((detail_jual_rawat.drawat_jumlah * detail_jual_rawat.drawat_harga)-((detail_jual_rawat.drawat_jumlah * detail_jual_rawat.drawat_harga)*detail_jual_rawat.drawat_diskon/100))) /100) AS diskon_tambahan,
					(SUM((detail_jual_rawat.drawat_jumlah * detail_jual_rawat.drawat_harga)-((detail_jual_rawat.drawat_jumlah * detail_jual_rawat.drawat_harga)*detail_jual_rawat.drawat_diskon/100)) - 
					SUM((master_jual_rawat.jrawat_diskon *((detail_jual_rawat.drawat_jumlah * detail_jual_rawat.drawat_harga)-((detail_jual_rawat.drawat_jumlah * detail_jual_rawat.drawat_harga)*detail_jual_rawat.drawat_diskon/100))) /100)) AS grand_total
					FROM detail_jual_rawat
					LEFT JOIN master_jual_rawat ON detail_jual_rawat.drawat_master = master_jual_rawat.jrawat_id
					LEFT JOIN perawatan ON detail_jual_rawat.drawat_rawat = perawatan.rawat_id";
				if($rekap_penjualan_tglapp_start!='' && $rekap_penjualan_tglapp_end!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_rawat.jrawat_tanggal BETWEEN '".$rekap_penjualan_tglapp_start."' AND '".$rekap_penjualan_tglapp_end."' AND master_jual_rawat.jrawat_stat_dok <> 'Batal'";
				}else if($rekap_penjualan_tglapp_start!='' && $rekap_penjualan_tglapp_end==''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_rawat.jrawat_tanggal='".$rekap_penjualan_tglapp_start."' AND master_jual_rawat.jrawat_stat_dok <> 'Batal'";
				}
				$query.="GROUP BY detail_jual_rawat.drawat_rawat ORDER BY grand_total DESC";
				
				/*
				$query = "SELECT vu_customer.cust_no, vu_customer.cust_nama, vu_customer.member_no, SUM(master_jual_rawat.jrawat_bayar) as total 
						FROM master_jual_rawat LEFT OUTER JOIN vu_customer
						ON master_jual_rawat.jrawat_cust = vu_customer.cust_id";
			
				if($trawat_id!='')
				{
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_rawat.jrawat_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."' AND master_jual_rawat.jrawat_stat_dok <> 'Batal'";
				};
			
				if($trawat_tglapp_start!='' && $trawat_tglapp_end!='')
				{
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_rawat.jrawat_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."' AND master_jual_rawat.jrawat_stat_dok <> 'Batal'";
				}else if($trawat_tglapp_start!='' && $trawat_tglapp_end=='')
				{
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_rawat.jrawat_tanggal='".$trawat_tglapp_start."' AND master_jual_rawat.jrawat_stat_dok <> 'Batal'";
				}
				$query.=" GROUP BY master_jual_rawat.jrawat_cust ORDER BY SUM(master_jual_rawat.jrawat_bayar) DESC";
				*/
			}
			else if ($rekap_penjualan_jenis == 'Produk')
			{
				$query = "SELECT produk.produk_kode AS kode, produk.produk_nama AS nama, 
						SUM(detail_jual_produk.dproduk_jumlah) AS total_jumlah,
						SUM((detail_jual_produk.dproduk_jumlah * detail_jual_produk.dproduk_harga)-((detail_jual_produk.dproduk_jumlah * detail_jual_produk.dproduk_harga)*detail_jual_produk.dproduk_diskon/100)) AS subtotal,
						SUM((master_jual_produk.jproduk_diskon * ((detail_jual_produk.dproduk_jumlah * detail_jual_produk.dproduk_harga)-((detail_jual_produk.dproduk_jumlah * detail_jual_produk.dproduk_harga)*detail_jual_produk.dproduk_diskon/100))) /100) AS diskon_tambahan,
						(SUM((detail_jual_produk.dproduk_jumlah * detail_jual_produk.dproduk_harga)-((detail_jual_produk.dproduk_jumlah * detail_jual_produk.dproduk_harga)*detail_jual_produk.dproduk_diskon/100)) - 
						SUM((master_jual_produk.jproduk_diskon *((detail_jual_produk.dproduk_jumlah * detail_jual_produk.dproduk_harga)-((detail_jual_produk.dproduk_jumlah * detail_jual_produk.dproduk_harga)*detail_jual_produk.dproduk_diskon/100))) /100)) AS grand_total
						FROM detail_jual_produk
						LEFT JOIN master_jual_produk ON detail_jual_produk.dproduk_master = master_jual_produk.jproduk_id
						LEFT JOIN produk ON detail_jual_produk.dproduk_produk = produk.produk_id";
				if($rekap_penjualan_tglapp_start!='' && $rekap_penjualan_tglapp_end!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_produk.jproduk_tanggal BETWEEN '".$rekap_penjualan_tglapp_start."' AND '".$rekap_penjualan_tglapp_end."' AND master_jual_produk.jproduk_stat_dok <> 'Batal'";
				}else if($rekap_penjualan_tglapp_start!='' && $rekap_penjualan_tglapp_end==''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_produk.jproduk_tanggal='".$rekap_penjualan_tglapp_start."' AND master_jual_produk.jproduk_stat_dok <> 'Batal'";
				}
				$query.="GROUP BY detail_jual_produk.dproduk_produk ORDER BY Grand_Total DESC";
				/*
				$query = "SELECT vu_customer.cust_no, vu_customer.cust_nama, vu_customer.member_no, SUM(master_jual_produk.jproduk_bayar) as total 
						FROM master_jual_produk LEFT OUTER JOIN vu_customer
						ON master_jual_produk.jproduk_cust = vu_customer.cust_id";
			
				if($trawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_produk.jproduk_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."' AND master_jual_produk.jproduk_stat_dok <> 'Batal'";
				};
			
				if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_produk.jproduk_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."' AND master_jual_produk.jproduk_stat_dok <> 'Batal'";
				}else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_produk.jproduk_tanggal='".$trawat_tglapp_start."' AND master_jual_produk.jproduk_stat_dok <> 'Batal'";
				}
				$query.=" GROUP BY master_jual_produk.jproduk_cust ORDER BY SUM(master_jual_produk.jproduk_bayar) DESC";
				*/
			}
			else if ($rekap_penjualan_jenis == 'Paket')
			{
				$query = "SELECT paket.paket_kode AS kode, paket.paket_nama AS nama, 
					SUM(detail_jual_paket.dpaket_jumlah) AS total_jumlah,
					SUM((detail_jual_paket.dpaket_jumlah * detail_jual_paket.dpaket_harga)-((detail_jual_paket.dpaket_jumlah * detail_jual_paket.dpaket_harga)*detail_jual_paket.dpaket_diskon/100)) AS subtotal,
					SUM((master_jual_paket.jpaket_diskon * ((detail_jual_paket.dpaket_jumlah * detail_jual_paket.dpaket_harga)-((detail_jual_paket.dpaket_jumlah * detail_jual_paket.dpaket_harga)*detail_jual_paket.dpaket_diskon/100))) /100) AS diskon_tambahan,
					(SUM((detail_jual_paket.dpaket_jumlah * detail_jual_paket.dpaket_harga)-((detail_jual_paket.dpaket_jumlah * detail_jual_paket.dpaket_harga)*detail_jual_paket.dpaket_diskon/100)) - 
					SUM((master_jual_paket.jpaket_diskon *((detail_jual_paket.dpaket_jumlah * detail_jual_paket.dpaket_harga)-((detail_jual_paket.dpaket_jumlah * detail_jual_paket.dpaket_harga)*detail_jual_paket.dpaket_diskon/100))) /100)) AS grand_total
					FROM detail_jual_paket
					LEFT JOIN master_jual_paket ON detail_jual_paket.dpaket_master = master_jual_paket.jpaket_id
					LEFT JOIN paket ON detail_jual_paket.dpaket_paket = paket.paket_id";
				if($rekap_penjualan_tglapp_start!='' && $rekap_penjualan_tglapp_end!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_paket.jpaket_tanggal BETWEEN '".$rekap_penjualan_tglapp_start."' AND '".$rekap_penjualan_tglapp_end."' AND master_jual_paket.jpaket_stat_dok <> 'Batal'";
				}else if($rekap_penjualan_tglapp_start!='' && $rekap_penjualan_tglapp_end==''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_paket.jpaket_tanggal='".$rekap_penjualan_tglapp_start."' AND master_jual_paket.jpaket_stat_dok <> 'Batal'";
				}
				$query.="GROUP BY detail_jual_paket.dpaket_paket ORDER BY Grand_Total DESC";
				
				
				/*$query = "SELECT vu_customer.cust_no, vu_customer.cust_nama, vu_customer.member_no, SUM(master_jual_paket.jpaket_bayar) as total 
						FROM master_jual_paket LEFT OUTER JOIN vu_customer
						ON master_jual_paket.jpaket_cust = vu_customer.cust_id";
			
				if($trawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_paket.jpaket_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."' AND master_jual_paket.jpaket_stat_dok <> 'Batal'";
				};
			
				if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_paket.jpaket_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."' AND master_jual_paket.jpaket_stat_dok <> 'Batal'";
				}else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " master_jual_paket.jpaket_tanggal='".$trawat_tglapp_start."' AND master_jual_paket.jpaket_stat_dok <> 'Batal'";
				}
				$query.=" GROUP BY master_jual_paket.jpaket_cust ORDER BY SUM(master_jual_paket.jpaket_bayar) DESC";
				*/
			}
			else if ($rekap_penjualan_jenis == 'Kuitansi')
			{
				$query = "SELECT vu_customer.cust_no, vu_customer.cust_nama, vu_customer.member_no, SUM(cetak_kwitansi.kwitansi_nilai) as total 
						FROM cetak_kwitansi LEFT OUTER JOIN vu_customer
						ON cetak_kwitansi.kwitansi_cust = vu_customer.cust_id";
			
				if($trawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cetak_kwitansi.kwitansi_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."' AND cetak_kwitansi.kwitansi_status <> 'Batal' AND cetak_kwitansi.kwitansi_cara <> 'Retur' ";
				};
			
				if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cetak_kwitansi.kwitansi_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."' AND cetak_kwitansi.kwitansi_status <> 'Batal' AND cetak_kwitansi.kwitansi_cara <> 'Retur'";
				}else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cetak_kwitansi.kwitansi_tanggal ='".$trawat_tglapp_start."' AND cetak_kwitansi.kwitansi_status <> 'Batal' AND cetak_kwitansi.kwitansi_cara <> 'Retur'";
				}
				$query.=" GROUP BY cetak_kwitansi.kwitansi_cust ORDER BY SUM(cetak_kwitansi.kwitansi_nilai) DESC";
			}
			else if ($rekap_penjualan_jenis == 'Semua')
			{
				$query = "SELECT  vu_customer.cust_no,vu_customer.cust_nama,vu_customer.member_no,SUM(total) as total
					FROM
					(
						(	
							SELECT paket.jpaket_cust AS customer, paket.jpaket_bayar AS total  FROM master_jual_paket AS paket WHERE paket.jpaket_bayar IS NOT NULL AND (paket.jpaket_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."') AND paket.jpaket_stat_dok <> 'Batal' ORDER BY paket.jpaket_bayar DESC 
						) 
						UNION
						(
							SELECT produk.jproduk_cust AS customer, produk.jproduk_bayar AS total  FROM master_jual_produk AS produk WHERE produk.jproduk_bayar IS NOT NULL AND (produk.jproduk_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."') AND produk.jproduk_stat_dok <> 'Batal' ORDER BY produk.jproduk_bayar DESC
						) 
						UNION	
						(
							SELECT rawat.jrawat_cust AS customer, rawat.jrawat_bayar AS total  FROM master_jual_rawat AS rawat WHERE rawat.jrawat_bayar IS NOT NULL AND (rawat.jrawat_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."') AND rawat.jrawat_stat_dok <> 'Batal' ORDER BY rawat.jrawat_bayar DESC
						)
						UNION	
						(
							SELECT kwitansi.kwitansi_cust AS customer, kwitansi.kwitansi_nilai AS total  FROM cetak_kwitansi AS kwitansi WHERE kwitansi.kwitansi_nilai IS NOT NULL AND (kwitansi.kwitansi_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."') AND kwitansi.kwitansi_status <> 'Batal' AND kwitansi.kwitansi_cara <> 'Retur' ORDER BY kwitansi.kwitansi_nilai DESC
						)
					)AS table_union
					LEFT OUTER JOIN vu_customer
					ON vu_customer.cust_id = customer
					GROUP BY vu_customer.cust_nama
					ORDER BY SUM(total) DESC";
		
			}
			$start = 0;
			$end = 10000;
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