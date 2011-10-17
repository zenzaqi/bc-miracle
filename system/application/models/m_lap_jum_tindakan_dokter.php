<? /* 
	+ Module  		: LAporan Tindakan Dokter Model
	+ Description	: For record model process back-end
	+ Filename 		: c_lap_jum_tindakan_dokter.php
 	+ Author  		: Fred

*/

class M_lap_jum_tindakan_dokter extends Model{
		
	//constructor
	function M_lap_jum_tindakan_dokter() {
		parent::Model();
	}

		
	//function for get list record
	function report_tindakan_list($filter,$start,$end){
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
		
	function report_tindakan_list2($filter,$start,$end){
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
	function report_tindakan_search($tgl_awal,$periode,$report_tindakan_id ,$trawat_tglapp_start ,$trawat_tglapp_end ,$trawat_dokter, $report_groupby, $start,$end){
			//full query
			if ($periode == 'bulan'){
				$isiperiode=" (date_format(jrawat_tanggal,'%Y-%m')='".$tgl_awal."') and " ;
				$tglpaket=" (date_format(dapaket_tgl_ambil,'%Y-%m')='".$tgl_awal."') and " ;
			}else if($periode == 'tanggal'){
				$isiperiode=" (jrawat_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."') and ";
				$tglpaket=" (dapaket_tgl_ambil BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."') and " ;
			}
			
			if ($report_groupby == 'Semua')
			{
			$query="select rawat_kode as rawat_kode, rawat_nama as rawat_nama, sum(Jumlah_rawat) as Jumlah_rawat, rawat_kredit as rawat_kredit, rawat_kreditrp as rawat_kreditrp, total_kredit as Total_Kredit, sum(Total_kredit) as Total_kredit, sum(Total_kreditrp) as Total_kreditrp
						from(
							(
							select ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
							perawatan.rawat_nama, 
							perawatan.rawat_kredit, 
							perawatan.rawat_kreditrp, 
							perawatan.rawat_kode,
							sum(detail_jual_rawat.drawat_jumlah) as Jumlah_rawat,
							perawatan.rawat_kredit * sum(detail_jual_rawat.drawat_jumlah) as Total_kredit,
							perawatan.rawat_kreditrp * sum(detail_jual_rawat.drawat_jumlah) as Total_kreditrp,
							'satuan' as status,
							master_jual_rawat.jrawat_tanggal as tanggal,
							perawatan.rawat_id as perawatan_id,
							master_jual_rawat.jrawat_stat_dok as stat_dok
							from detail_jual_rawat
							left join master_jual_rawat on (master_jual_rawat.jrawat_id=detail_jual_rawat.drawat_master)
							left join perawatan on (perawatan.rawat_id=detail_jual_rawat.drawat_rawat)
							left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_jual_rawat.drawat_dtrawat)
							left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
							left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
							left join karyawan as referal on (detail_jual_rawat.drawat_sales=referal.karyawan_id)			
							where ".$isiperiode." (rawat_id is not null and jrawat_stat_dok='Tertutup') and (detail_jual_rawat.drawat_sales = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas1 = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas2 = '".$trawat_dokter."')
							group by karyawan_username, rawat_nama
							)
							union
							(select ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
							perawatan.rawat_nama, perawatan.rawat_kredit, perawatan.rawat_kreditrp, perawatan.rawat_kode,
							sum(detail_ambil_paket.dapaket_jumlah) as Jumlah_rawat,
							perawatan.rawat_kredit * sum(detail_ambil_paket.dapaket_jumlah) as Total_kredit,
							perawatan.rawat_kreditrp * sum(detail_ambil_paket.dapaket_jumlah) as Total_kreditrp,
							'paket' as status,
							detail_ambil_paket.dapaket_tgl_ambil as tanggal,
							perawatan.rawat_id as perawatan_id,
							detail_ambil_paket.dapaket_stat_dok as stat_dok
							from detail_ambil_paket
							left join perawatan on (perawatan.rawat_id=detail_ambil_paket.dapaket_item)
							left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_ambil_paket.dapaket_dtrawat)
							left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
							left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
							left join karyawan as referal on (detail_ambil_paket.dapaket_referal=referal.karyawan_id)
							left join master_jual_paket on (master_jual_paket.jpaket_id = detail_ambil_paket.dapaket_jpaket)
							where ".$tglpaket." (detail_ambil_paket.dapaket_referal = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas1 = '".$trawat_dokter."') and (dapaket_item is not null and dapaket_stat_dok='Tertutup') and master_jual_paket.jpaket_stat_dok = 'Tertutup'
							group by karyawan_username,rawat_nama
							)
							) as table_union
							group by karyawan_username, rawat_nama
							";
							
			}
		
			else if ($report_groupby == 'Perawatan')
			{			
			$query ="select ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
							perawatan.rawat_nama, perawatan.rawat_kredit, perawatan.rawat_kreditrp, perawatan.rawat_kode,
							sum(detail_jual_rawat.drawat_jumlah) as Jumlah_rawat,
							perawatan.rawat_kredit * sum(detail_jual_rawat.drawat_jumlah) as Total_kredit,
							perawatan.rawat_kreditrp * sum(detail_jual_rawat.drawat_jumlah) as Total_kreditrp,
							'satuan' as status,
							master_jual_rawat.jrawat_tanggal as tanggal,
							perawatan.rawat_id as perawatan_id,
							master_jual_rawat.jrawat_stat_dok as stat_dok
							from detail_jual_rawat
							left join master_jual_rawat on (master_jual_rawat.jrawat_id=detail_jual_rawat.drawat_master)
							left join perawatan on (perawatan.rawat_id=detail_jual_rawat.drawat_rawat)
							left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_jual_rawat.drawat_dtrawat)
							left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
							left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
							left join karyawan as referal on (detail_jual_rawat.drawat_sales=referal.karyawan_id)			
							where ".$isiperiode." (rawat_id is not null and jrawat_stat_dok='Tertutup') and (detail_jual_rawat.drawat_sales = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas1 = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas2 = '".$trawat_dokter."')
							group by karyawan_username, rawat_nama	
						";
		
			}
		
			else if ($report_groupby == 'Pengambilan_Paket')
			{
				$query ="select ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
							perawatan.rawat_nama, perawatan.rawat_kredit, perawatan.rawat_kreditrp, perawatan.rawat_kode,
							sum(detail_ambil_paket.dapaket_jumlah) as Jumlah_rawat,
							perawatan.rawat_kredit * sum(detail_ambil_paket.dapaket_jumlah) as Total_kredit,
							perawatan.rawat_kreditrp * sum(detail_ambil_paket.dapaket_jumlah) as Total_kreditrp,
							'paket' as status,
							detail_ambil_paket.dapaket_tgl_ambil as tanggal,
							perawatan.rawat_id as perawatan_id,
							detail_ambil_paket.dapaket_stat_dok as stat_dok
							from detail_ambil_paket
							left join perawatan on (perawatan.rawat_id=detail_ambil_paket.dapaket_item)
							left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_ambil_paket.dapaket_dtrawat)
							left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
							left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
							left join karyawan as referal on (detail_ambil_paket.dapaket_referal=referal.karyawan_id)
							left join master_jual_paket on (master_jual_paket.jpaket_id = detail_ambil_paket.dapaket_jpaket)
							where ".$tglpaket." (detail_ambil_paket.dapaket_referal = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas1 = '".$trawat_dokter."') and (dapaket_item is not null and dapaket_stat_dok='Tertutup') and master_jual_paket.jpaket_stat_dok = 'Tertutup'
							group by karyawan_username,rawat_nama";
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
	function report_tindakan_search2($tgl_awal,$periode,$report_tindakan_id ,$trawat_tglapp_start ,$trawat_tglapp_end ,$trawat_dokter, $report_groupby, $start,$end){
			//full query
			
			if ($periode == 'bulan'){
				$isiperiode=" (date_format(jrawat_tanggal,'%Y-%m')='".$tgl_awal."') and " ;
				$tglpaket=" (date_format(dapaket_tgl_ambil,'%Y-%m')='".$tgl_awal."') and " ;
			}else if($periode == 'tanggal'){
				$isiperiode=" (jrawat_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."') and ";
				$tglpaket=" (dapaket_tgl_ambil BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."') and " ;
			}
		
			if ($report_groupby == 'Semua')
			{
			$query="select sum(table_union.Total_kredit) as grand_total, sum(table_union.Total_kreditrp) as grand_total_rp 
						from(
							(select ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
							perawatan.rawat_nama, perawatan.rawat_kredit, perawatan.rawat_kode,
							sum(detail_jual_rawat.drawat_jumlah) as Jumlah_rawat,
							perawatan.rawat_kredit * sum(detail_jual_rawat.drawat_jumlah) as Total_kredit,
							perawatan.rawat_kreditrp * sum(detail_jual_rawat.drawat_jumlah) as Total_kreditrp,
							'satuan' as status,
							master_jual_rawat.jrawat_tanggal as tanggal,
							perawatan.rawat_id as perawatan_id,
							master_jual_rawat.jrawat_stat_dok as stat_dok
							from detail_jual_rawat
							left join master_jual_rawat on (master_jual_rawat.jrawat_id=detail_jual_rawat.drawat_master)
							left join perawatan on (perawatan.rawat_id=detail_jual_rawat.drawat_rawat)
							left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_jual_rawat.drawat_dtrawat)
							left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
							left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
							left join karyawan as referal on (detail_jual_rawat.drawat_sales=referal.karyawan_id)			
							where ".$isiperiode."(rawat_id is not null and jrawat_stat_dok='Tertutup') and (detail_jual_rawat.drawat_sales = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas1 = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas2 = '".$trawat_dokter."')
							group by karyawan_username, rawat_nama
							)
							union
							(select ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
							perawatan.rawat_nama, perawatan.rawat_kredit, perawatan.rawat_kode,
							sum(detail_ambil_paket.dapaket_jumlah) as Jumlah_rawat,
							perawatan.rawat_kredit * sum(detail_ambil_paket.dapaket_jumlah) as Total_kredit,
							perawatan.rawat_kreditrp * sum(detail_ambil_paket.dapaket_jumlah) as Total_kreditrp,
							'paket' as status,
							detail_ambil_paket.dapaket_tgl_ambil as tanggal,
							perawatan.rawat_id as perawatan_id,
							detail_ambil_paket.dapaket_stat_dok as stat_dok
							from detail_ambil_paket
							left join perawatan on (perawatan.rawat_id=detail_ambil_paket.dapaket_item)
							left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_ambil_paket.dapaket_dtrawat)
							left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
							left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
							left join karyawan as referal on (detail_ambil_paket.dapaket_referal=referal.karyawan_id)
							left join master_jual_paket on (master_jual_paket.jpaket_id = detail_ambil_paket.dapaket_jpaket)
							where ".$tglpaket." (detail_ambil_paket.dapaket_referal = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas1 = '".$trawat_dokter."') and (dapaket_item is not null and dapaket_stat_dok='Tertutup') and master_jual_paket.jpaket_stat_dok = 'Tertutup'
							group by karyawan_username,rawat_nama
							)
							) as table_union
							";
							
			}
		
			/*if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " ";
			}else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " master_jual_rawat.jrawat_tanggal='".$trawat_tglapp_start."'";

			
			}*/

			else if ($report_groupby == 'Perawatan')
			{
			$query="select sum(vu_kredit.Total_kredit) as grand_total, sum(vu_kredit.Total_kreditrp) as grand_total_rp
						from(
							select ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
							perawatan.rawat_nama, perawatan.rawat_kredit, perawatan.rawat_kode,
							sum(detail_jual_rawat.drawat_jumlah) as Jumlah_rawat,
							perawatan.rawat_kredit * sum(detail_jual_rawat.drawat_jumlah) as Total_kredit,
							perawatan.rawat_kreditrp * sum(detail_jual_rawat.drawat_jumlah) as Total_kreditrp,
							'satuan' as status,
							master_jual_rawat.jrawat_tanggal as tanggal,
							perawatan.rawat_id as perawatan_id,
							master_jual_rawat.jrawat_stat_dok as stat_dok
							from detail_jual_rawat
							left join master_jual_rawat on (master_jual_rawat.jrawat_id=detail_jual_rawat.drawat_master)
							left join perawatan on (perawatan.rawat_id=detail_jual_rawat.drawat_rawat)
							left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_jual_rawat.drawat_dtrawat)
							left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
							left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
							left join karyawan as referal on (detail_jual_rawat.drawat_sales=referal.karyawan_id)			
							where ".$isiperiode." (rawat_id is not null and jrawat_stat_dok='Tertutup') and (detail_jual_rawat.drawat_sales = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas1 = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas2 = '".$trawat_dokter."')
							group by karyawan_username, rawat_nama) as vu_kredit
								";
			}
			
			else if ($report_groupby == 'Pengambilan_Paket')
			{
			$query="select sum(vu_kredit.Total_kredit) as grand_total, sum(vu_kredit.Total_kreditrp) as grand_total_rp
						from(
							select ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
							perawatan.rawat_nama, perawatan.rawat_kredit, perawatan.rawat_kode,
							sum(detail_ambil_paket.dapaket_jumlah) as Jumlah_rawat,
							perawatan.rawat_kredit * sum(detail_ambil_paket.dapaket_jumlah) as Total_kredit,
							perawatan.rawat_kreditrp * sum(detail_ambil_paket.dapaket_jumlah) as Total_kreditrp,
							'paket' as status,
							detail_ambil_paket.dapaket_tgl_ambil as tanggal,
							perawatan.rawat_id as perawatan_id,
							detail_ambil_paket.dapaket_stat_dok as stat_dok
							from detail_ambil_paket
							left join perawatan on (perawatan.rawat_id=detail_ambil_paket.dapaket_item)
							left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_ambil_paket.dapaket_dtrawat)
							left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
							left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
							left join karyawan as referal on (detail_ambil_paket.dapaket_referal=referal.karyawan_id)
							left join master_jual_paket on (master_jual_paket.jpaket_id = detail_ambil_paket.dapaket_jpaket)
							where ".$tglpaket." and (detail_ambil_paket.dapaket_referal = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas1 = '".$trawat_dokter."') and (dapaket_item is not null and dapaket_stat_dok='Tertutup') and master_jual_paket.jpaket_stat_dok = 'Tertutup'
							group by karyawan_username,rawat_nama) as vu_kredit";
	
		
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
	function report_tindakan_print($tgl_awal,$periode,$report_groupby,$trawat_dokter,$trawat_tglapp_start,$trawat_tglapp_end,$option,$filter){
			//full query
			//full query
			if ($periode == 'bulan'){
				$isiperiode=" (date_format(jrawat_tanggal,'%Y-%m')='".$tgl_awal."') and " ;
				$tglpaket=" (date_format(dapaket_tgl_ambil,'%Y-%m')='".$tgl_awal."') and " ;
			}else if($periode == 'tanggal'){
				$isiperiode=" (jrawat_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."') and ";
				$tglpaket=" (dapaket_tgl_ambil BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."') and " ;
			}
			
			if ($report_groupby == 'Semua')
			{
			$query="select karyawan_username, rawat_kode as rawat_kode, rawat_nama as rawat_nama, sum(Jumlah_rawat) as Jumlah_rawat, rawat_kredit as rawat_kredit, rawat_kreditrp as rawat_kreditrp, sum(Total_kredit) as Total_kredit, sum(Total_kreditrp) as Total_kreditrp  
						from(
							(
							select ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
							perawatan.rawat_nama, perawatan.rawat_kredit, perawatan.rawat_kreditrp, perawatan.rawat_kode,
							sum(detail_jual_rawat.drawat_jumlah) as Jumlah_rawat,
							perawatan.rawat_kredit * sum(detail_jual_rawat.drawat_jumlah) as Total_kredit,
							perawatan.rawat_kreditrp * sum(detail_jual_rawat.drawat_jumlah) as Total_kreditrp,
							'satuan' as status
							from detail_jual_rawat
							left join master_jual_rawat on (master_jual_rawat.jrawat_id=detail_jual_rawat.drawat_master)
							left join perawatan on (perawatan.rawat_id=detail_jual_rawat.drawat_rawat)
							left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_jual_rawat.drawat_dtrawat)
							left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
							left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
							left join karyawan as referal on (detail_jual_rawat.drawat_sales=referal.karyawan_id)			
							where ".$isiperiode." (rawat_id is not null and jrawat_stat_dok='Tertutup') and (detail_jual_rawat.drawat_sales = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas1 = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas2 = '".$trawat_dokter."')
							group by karyawan_username, rawat_nama
							)
							union
							(select ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
							perawatan.rawat_nama, perawatan.rawat_kredit, perawatan.rawat_kreditrp, perawatan.rawat_kode,
							sum(detail_ambil_paket.dapaket_jumlah) as Jumlah_rawat,
							perawatan.rawat_kredit * sum(detail_ambil_paket.dapaket_jumlah) as Total_kredit,
							perawatan.rawat_kreditrp * sum(detail_ambil_paket.dapaket_jumlah) as Total_kreditrp,
							'paket' as status
							from detail_ambil_paket
							left join perawatan on (perawatan.rawat_id=detail_ambil_paket.dapaket_item)
							left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_ambil_paket.dapaket_dtrawat)
							left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
							left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
							left join karyawan as referal on (detail_ambil_paket.dapaket_referal=referal.karyawan_id)
							left join master_jual_paket on (master_jual_paket.jpaket_id = detail_ambil_paket.dapaket_jpaket)
							where ".$tglpaket." (detail_ambil_paket.dapaket_referal = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas1 = '".$trawat_dokter."') and (dapaket_item is not null and dapaket_stat_dok='Tertutup') and master_jual_paket.jpaket_stat_dok = 'Tertutup'
							group by karyawan_username,rawat_nama
							)
							) as table_union
							group by karyawan_username, rawat_nama
							";
							
			}
		
			else if ($report_groupby == 'Perawatan')
			{
			$query ="select ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
							perawatan.rawat_nama, perawatan.rawat_kredit, perawatan.rawat_kreditrp, perawatan.rawat_kode,
							sum(detail_jual_rawat.drawat_jumlah) as Jumlah_rawat,
							perawatan.rawat_kredit * sum(detail_jual_rawat.drawat_jumlah) as Total_kredit,
							perawatan.rawat_kreditrp * sum(detail_jual_rawat.drawat_jumlah) as Total_kreditrp,
							'satuan' as status
							from detail_jual_rawat
							left join master_jual_rawat on (master_jual_rawat.jrawat_id=detail_jual_rawat.drawat_master)
							left join perawatan on (perawatan.rawat_id=detail_jual_rawat.drawat_rawat)
							left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_jual_rawat.drawat_dtrawat)
							left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
							left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
							left join karyawan as referal on (detail_jual_rawat.drawat_sales=referal.karyawan_id)			
							where ".$isiperiode." (rawat_id is not null and jrawat_stat_dok='Tertutup') and (detail_jual_rawat.drawat_sales = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas1 = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas2 = '".$trawat_dokter."')
							group by karyawan_username, rawat_nama	
						";
		
			}
		
			else if ($report_groupby == 'Pengambilan_Paket')
			{
				$query ="select ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
							perawatan.rawat_nama, perawatan.rawat_kredit, perawatan.rawat_kreditrp, perawatan.rawat_kode,
							sum(detail_ambil_paket.dapaket_jumlah) as Jumlah_rawat,
							perawatan.rawat_kredit * sum(detail_ambil_paket.dapaket_jumlah) as Total_kredit,
							perawatan.rawat_kreditrp * sum(detail_ambil_paket.dapaket_jumlah) as Total_kreditrp,
							'paket' as status
							from detail_ambil_paket
							left join perawatan on (perawatan.rawat_id=detail_ambil_paket.dapaket_item)
							left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_ambil_paket.dapaket_dtrawat)
							left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
							left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
							left join karyawan as referal on (detail_ambil_paket.dapaket_referal=referal.karyawan_id)
							left join master_jual_paket on (master_jual_paket.jpaket_id = detail_ambil_paket.dapaket_jpaket)
							where ".$tglpaket." (detail_ambil_paket.dapaket_referal = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas1 = '".$trawat_dokter."') and (dapaket_item is not null and dapaket_stat_dok='Tertutup') and master_jual_paket.jpaket_stat_dok = 'Tertutup'
							group by karyawan_username,rawat_nama";
			}
		 
			$result = $this->db->query($query);  
			return $result;
		}
		
	//function  for export to excel
	function report_tindakan_export_excel($tgl_awal,$periode,$trawat_id ,$trawat_tglapp_start , $trawat_tglapp_end, $trawat_dokter,
										$report_groupby, $option, $filter){
			//full query
			if ($periode == 'bulan'){
				$isiperiode=" (date_format(jrawat_tanggal,'%Y-%m')='".$tgl_awal."') and " ;
				$tglpaket=" (date_format(dapaket_tgl_ambil,'%Y-%m')='".$tgl_awal."') and " ;
			}else if($periode == 'tanggal'){
				$isiperiode=" (jrawat_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."') and ";
				$tglpaket=" (dapaket_tgl_ambil BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."') and " ;
			}
			
			if ($report_groupby == 'Semua')
			{
			$query="select karyawan_username, rawat_kode as rawat_kode, rawat_nama as rawat_nama, sum(Jumlah_rawat) as Jumlah_rawat, rawat_kredit as rawat_kredit, rawat_kreditrp as rawat_kreditrp, sum(Total_kredit) as Total_kredit, sum(Total_kreditrp) as Total_kreditrp  
						from(
							(
							select ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
							perawatan.rawat_nama, perawatan.rawat_kredit, perawatan.rawat_kreditrp, perawatan.rawat_kode,
							sum(detail_jual_rawat.drawat_jumlah) as Jumlah_rawat,
							perawatan.rawat_kredit * sum(detail_jual_rawat.drawat_jumlah) as Total_kredit,
							perawatan.rawat_kreditrp * sum(detail_jual_rawat.drawat_jumlah) as Total_kreditrp,
							'satuan' as status
							from detail_jual_rawat
							left join master_jual_rawat on (master_jual_rawat.jrawat_id=detail_jual_rawat.drawat_master)
							left join perawatan on (perawatan.rawat_id=detail_jual_rawat.drawat_rawat)
							left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_jual_rawat.drawat_dtrawat)
							left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
							left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
							left join karyawan as referal on (detail_jual_rawat.drawat_sales=referal.karyawan_id)			
							where ".$isiperiode." (rawat_id is not null and jrawat_stat_dok='Tertutup') and (detail_jual_rawat.drawat_sales = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas1 = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas2 = '".$trawat_dokter."')
							group by karyawan_username, rawat_nama
							)
							union
							(select ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
							perawatan.rawat_nama, perawatan.rawat_kredit, perawatan.rawat_kreditrp, perawatan.rawat_kode,
							sum(detail_ambil_paket.dapaket_jumlah) as Jumlah_rawat,
							perawatan.rawat_kredit * sum(detail_ambil_paket.dapaket_jumlah) as Total_kredit,
							perawatan.rawat_kreditrp * sum(detail_ambil_paket.dapaket_jumlah) as Total_kreditrp,
							'paket' as status
							from detail_ambil_paket
							left join perawatan on (perawatan.rawat_id=detail_ambil_paket.dapaket_item)
							left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_ambil_paket.dapaket_dtrawat)
							left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
							left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
							left join karyawan as referal on (detail_ambil_paket.dapaket_referal=referal.karyawan_id)
							left join master_jual_paket on (master_jual_paket.jpaket_id = detail_ambil_paket.dapaket_jpaket)
							where ".$tglpaket." (detail_ambil_paket.dapaket_referal = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas1 = '".$trawat_dokter."') and (dapaket_item is not null and dapaket_stat_dok='Tertutup') and master_jual_paket.jpaket_stat_dok = 'Tertutup'
							group by karyawan_username,rawat_nama
							)
							) as table_union
							group by karyawan_username, rawat_nama
							";
							
			}
		
			else if ($report_groupby == 'Perawatan')
			{
			$query ="select ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
							perawatan.rawat_nama, perawatan.rawat_kredit, perawatan.rawat_kreditrp, perawatan.rawat_kode,
							sum(detail_jual_rawat.drawat_jumlah) as Jumlah_rawat,
							perawatan.rawat_kredit * sum(detail_jual_rawat.drawat_jumlah) as Total_kredit,
							perawatan.rawat_kreditrp * sum(detail_jual_rawat.drawat_jumlah) as Total_kreditrp,
							'satuan' as status
							from detail_jual_rawat
							left join master_jual_rawat on (master_jual_rawat.jrawat_id=detail_jual_rawat.drawat_master)
							left join perawatan on (perawatan.rawat_id=detail_jual_rawat.drawat_rawat)
							left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_jual_rawat.drawat_dtrawat)
							left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
							left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
							left join karyawan as referal on (detail_jual_rawat.drawat_sales=referal.karyawan_id)			
							where ".$isiperiode." (rawat_id is not null and jrawat_stat_dok='Tertutup') and (detail_jual_rawat.drawat_sales = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas1 = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas2 = '".$trawat_dokter."')
							group by karyawan_username, rawat_nama	
						";
		
			}
		
			else if ($report_groupby == 'Pengambilan_Paket')
			{
				$query ="select ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
							perawatan.rawat_nama, perawatan.rawat_kredit, perawatan.rawat_kreditrp, perawatan.rawat_kode,
							sum(detail_ambil_paket.dapaket_jumlah) as Jumlah_rawat,
							perawatan.rawat_kredit * sum(detail_ambil_paket.dapaket_jumlah) as Total_kredit,
							perawatan.rawat_kreditrp * sum(detail_ambil_paket.dapaket_jumlah) as Total_kreditrp,
							'paket' as status
							from detail_ambil_paket
							left join perawatan on (perawatan.rawat_id=detail_ambil_paket.dapaket_item)
							left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_ambil_paket.dapaket_dtrawat)
							left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
							left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
							left join karyawan as referal on (detail_ambil_paket.dapaket_referal=referal.karyawan_id)
							left join master_jual_paket on (master_jual_paket.jpaket_id = detail_ambil_paket.dapaket_jpaket)
							where ".$tglpaket." (detail_ambil_paket.dapaket_referal = '".$trawat_dokter."' or tindakan_detail.dtrawat_petugas1 = '".$trawat_dokter."') and (dapaket_item is not null and dapaket_stat_dok='Tertutup') and master_jual_paket.jpaket_stat_dok = 'Tertutup'
							group by karyawan_username,rawat_nama";
			}
		 
			$result = $this->db->query($query);  
			return $result;
		}
		
}
?>