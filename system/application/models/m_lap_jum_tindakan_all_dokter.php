<? /* 
	+ Module  		: LAporan Tindakan Dokter Model
	+ Description	: For record model process back-end
	+ Filename 		: c_lap_jum_tindakan_all_dokter.php
 	+ Author  		: Fred

*/

class m_lap_jum_tindakan_all_dokter extends Model{
		
	//constructor
	function m_lap_jum_tindakan_all_dokter() {
		parent::Model();
	}		

	function report_tindakan_update_temp($isiperiode, $tglpaket, $dokter_id, $report_groupby, $urutan){
	
					if ($report_groupby == 'Semua')
					{
			
						$query =   "select 
										
										sum(Jumlah_rawat) as Jumlah_rawat, perawatan_id
										from(
											(
											select 
												ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
												sum(detail_jual_rawat.drawat_jumlah) as Jumlah_rawat,
												perawatan.rawat_id as perawatan_id						
											from detail_jual_rawat
											left join master_jual_rawat on (master_jual_rawat.jrawat_id=detail_jual_rawat.drawat_master)
											left join perawatan on (perawatan.rawat_id=detail_jual_rawat.drawat_rawat)
											left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_jual_rawat.drawat_dtrawat)
											left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
											left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
											left join karyawan as referal on (detail_jual_rawat.drawat_sales=referal.karyawan_id)			
											where 
												".$isiperiode." 
												(rawat_id is not null and jrawat_stat_dok='Tertutup') 
												and (detail_jual_rawat.drawat_sales = '".$dokter_id."' or tindakan_detail.dtrawat_petugas1 = '".$dokter_id."' or tindakan_detail.dtrawat_petugas2 = '".$dokter_id."')
											group by karyawan_username, perawatan_id
											)
											union
											(
											select
												ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
												sum(detail_ambil_paket.dapaket_jumlah) as Jumlah_rawat,
												perawatan.rawat_id as perawatan_id
											from detail_ambil_paket
											left join perawatan on (perawatan.rawat_id=detail_ambil_paket.dapaket_item)
											left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_ambil_paket.dapaket_dtrawat)
											left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
											left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
											left join karyawan as referal on (detail_ambil_paket.dapaket_referal=referal.karyawan_id)
											left join master_jual_paket on (master_jual_paket.jpaket_id = detail_ambil_paket.dapaket_jpaket)
											where 
												".$tglpaket." 
												(detail_ambil_paket.dapaket_referal = '".$dokter_id."' or tindakan_detail.dtrawat_petugas1 = '".$dokter_id."') 
												and (dapaket_item is not null and dapaket_stat_dok='Tertutup') and master_jual_paket.jpaket_stat_dok = 'Tertutup'
											group by karyawan_username, perawatan_id
											)
											) as table_union
											group by karyawan_username, perawatan_id";
							
					}
		
					else if ($report_groupby == 'Perawatan')
					{			
						$query =   "select 
										ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
										sum(detail_jual_rawat.drawat_jumlah) as Jumlah_rawat,
										perawatan.rawat_id as perawatan_id,
									from detail_jual_rawat
									left join master_jual_rawat on (master_jual_rawat.jrawat_id=detail_jual_rawat.drawat_master)
									left join perawatan on (perawatan.rawat_id=detail_jual_rawat.drawat_rawat)
									left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_jual_rawat.drawat_dtrawat)
									left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
									left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
									left join karyawan as referal on (detail_jual_rawat.drawat_sales=referal.karyawan_id)			
									where 
										".$isiperiode." 
										(rawat_id is not null and jrawat_stat_dok='Tertutup') 
										and (detail_jual_rawat.drawat_sales = '".$dokter_id."' or tindakan_detail.dtrawat_petugas1 = '".$dokter_id."' or tindakan_detail.dtrawat_petugas2 = '".$dokter_id."')
									group by karyawan_username, perawatan_id	
						";
		
					}
		
					else if ($report_groupby == 'Pengambilan_Paket')
					{
						$query =   "select 
										ifnull(if((tindakan_detail.dtrawat_petugas1 = 0),if((tindakan_detail.dtrawat_petugas2 = 0),NULL,terapis.karyawan_username),dokter.karyawan_username),referal.karyawan_username) AS karyawan_username,
										sum(detail_ambil_paket.dapaket_jumlah) as Jumlah_rawat,
										perawatan.rawat_id as perawatan_id,
										from detail_ambil_paket
										left join perawatan on (perawatan.rawat_id=detail_ambil_paket.dapaket_item)
										left join tindakan_detail on (tindakan_detail.dtrawat_id=detail_ambil_paket.dapaket_dtrawat)
										left join karyawan as dokter on (tindakan_detail.dtrawat_petugas1=dokter.karyawan_id)
										left join karyawan as terapis on (tindakan_detail.dtrawat_petugas2=terapis.karyawan_id)
										left join karyawan as referal on (detail_ambil_paket.dapaket_referal=referal.karyawan_id)
										left join master_jual_paket on (master_jual_paket.jpaket_id = detail_ambil_paket.dapaket_jpaket)
										where 
											".$tglpaket." 
											(detail_ambil_paket.dapaket_referal = '".$dokter_id."' or tindakan_detail.dtrawat_petugas1 = '".$dokter_id."') 
											and (dapaket_item is not null and dapaket_stat_dok='Tertutup') and master_jual_paket.jpaket_stat_dok = 'Tertutup'
										group by karyawan_username, perawatan_id";
					}	
					
					$result_query = $this->db->query($query);
					
					switch ($urutan){
						case 0	: 	foreach($result_query->result() as $row_query){
										$sql_update =  "update temp_jml_tindakan t
														set t.tjt_ref0 = ".$row_query->Jumlah_rawat."
														where t.tjt_rawat = ".$row_query->perawatan_id;
										$this->db->query($sql_update);											
									};
									break;
						case 1	: 	foreach($result_query->result() as $row_query){
										$sql_update =  "update temp_jml_tindakan t
														set t.tjt_ref1 = ".$row_query->Jumlah_rawat."
														where t.tjt_rawat = ".$row_query->perawatan_id;
										$this->db->query($sql_update);											
									};
									break;
						case 2	: 	foreach($result_query->result() as $row_query){
										$sql_update =  "update temp_jml_tindakan t
														set t.tjt_ref2 = ".$row_query->Jumlah_rawat."
														where t.tjt_rawat = ".$row_query->perawatan_id;
										$this->db->query($sql_update);											
									};
									break;
						case 3	: 	foreach($result_query->result() as $row_query){
										$sql_update =  "update temp_jml_tindakan t
														set t.tjt_ref3 = ".$row_query->Jumlah_rawat."
														where t.tjt_rawat = ".$row_query->perawatan_id;
										$this->db->query($sql_update);											
									};
									break;
						case 4	: 	foreach($result_query->result() as $row_query){
										$sql_update =  "update temp_jml_tindakan t
														set t.tjt_ref4 = ".$row_query->Jumlah_rawat."
														where t.tjt_rawat = ".$row_query->perawatan_id;
										$this->db->query($sql_update);											
									};
									break;
						case 5	: 	foreach($result_query->result() as $row_query){
										$sql_update =  "update temp_jml_tindakan t
														set t.tjt_ref5 = ".$row_query->Jumlah_rawat."
														where t.tjt_rawat = ".$row_query->perawatan_id;
										$this->db->query($sql_update);											
									};
									break;
						case 6	: 	foreach($result_query->result() as $row_query){
										$sql_update =  "update temp_jml_tindakan t
														set t.tjt_ref6 = ".$row_query->Jumlah_rawat."
														where t.tjt_rawat = ".$row_query->perawatan_id;
										$this->db->query($sql_update);											
									};
									break;
						case 7	: 	foreach($result_query->result() as $row_query){
										$sql_update =  "update temp_jml_tindakan t
														set t.tjt_ref7 = ".$row_query->Jumlah_rawat."
														where t.tjt_rawat = ".$row_query->perawatan_id;
										$this->db->query($sql_update);											
									};
									break;
						case 8	: 	foreach($result_query->result() as $row_query){
										$sql_update =  "update temp_jml_tindakan t
														set t.tjt_ref8 = ".$row_query->Jumlah_rawat."
														where t.tjt_rawat = ".$row_query->perawatan_id;
										$this->db->query($sql_update);											
									};
									break;
						case 9	: 	foreach($result_query->result() as $row_query){
										$sql_update =  "update temp_jml_tindakan t
														set t.tjt_ref9 = ".$row_query->Jumlah_rawat."
														where t.tjt_rawat = ".$row_query->perawatan_id;
										$this->db->query($sql_update);											
									};
									break;
						case 10	: 	foreach($result_query->result() as $row_query){
										$sql_update =  "update temp_jml_tindakan t
														set t.tjt_ref10 = ".$row_query->Jumlah_rawat."
														where t.tjt_rawat = ".$row_query->perawatan_id;
										$this->db->query($sql_update);											
									};
									break;
						case 11	: 	foreach($result_query->result() as $row_query){
										$sql_update =  "update temp_jml_tindakan t
														set t.tjt_ref11 = ".$row_query->Jumlah_rawat."
														where t.tjt_rawat = ".$row_query->perawatan_id;
										$this->db->query($sql_update);											
									};
									break;
						case 12	: 	foreach($result_query->result() as $row_query){
										$sql_update =  "update temp_jml_tindakan t
														set t.tjt_ref12 = ".$row_query->Jumlah_rawat."
														where t.tjt_rawat = ".$row_query->perawatan_id;
										$this->db->query($sql_update);											
									};
									break;
						case 13	: 	foreach($result_query->result() as $row_query){
										$sql_update =  "update temp_jml_tindakan t
														set t.tjt_ref13 = ".$row_query->Jumlah_rawat."
														where t.tjt_rawat = ".$row_query->perawatan_id;
										$this->db->query($sql_update);											
									};
									break;
						
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
			
			if ($report_groupby == '')
				$report_groupby = 'Semua';
			
				$sql_del = "delete from temp_jml_tindakan";
				$this->db->query($sql_del);
				
				$sql_rawat =   "insert into temp_jml_tindakan (tjt_rawat)
								select * from
								(
									select d1.drawat_rawat
									from detail_jual_rawat d1
									left join perawatan r1 on r1.rawat_id = d1.drawat_rawat
									left join master_jual_rawat m1 on m1.jrawat_id = d1.drawat_master
									where 
										".$isiperiode."
										m1.jrawat_stat_dok = 'Tertutup'
										and (r1.rawat_kategori = 2 or r1.rawat_kategori = 4 or r1.rawat_kategori = 16)
										
									union

									select d2.dapaket_item
									from detail_ambil_paket d2
									left join perawatan r2 on r2.rawat_id = d2.dapaket_item
									where 
										".$tglpaket."
										d2.dapaket_stat_dok = 'Tertutup'
										and (r2.rawat_kategori = 2 or r2.rawat_kategori = 4 or r2.rawat_kategori = 16)	
										and d2.dapaket_referal <> 0
								)
								as tb_union";
				$this->db->query($sql_rawat);
			
				$sql_dokter =  "select t.dokter_id, k.karyawan_nama
								from
								(
								select 
									ifnull(t1.dtrawat_petugas1, d1.drawat_sales) as dokter_id
								from detail_jual_rawat d1
								left join master_jual_rawat m1 on m1.jrawat_id = d1.drawat_master
								left join tindakan_detail t1 on t1.dtrawat_id = d1.drawat_dtrawat
								left join karyawan as dokter on t1.dtrawat_petugas1 = dokter.karyawan_id
								left join karyawan as referal on d1.drawat_sales = referal.karyawan_id
								where 
									".$isiperiode."
									m1.jrawat_stat_dok = 'Tertutup'
									and t1.dtrawat_petugas1 <> 0 and t1.dtrawat_petugas1 <> 5 /*suster*/ and t1.dtrawat_petugas1 <> 60 /*available dr*/
									
								union

								select
									ifnull(t2.dtrawat_petugas1, d2.dapaket_referal) as dokter_id
								from detail_ambil_paket d2
								left join tindakan_detail t2 on t2.dtrawat_id = d2.dapaket_dtrawat
								left join karyawan as dokter on t2.dtrawat_petugas1 = dokter.karyawan_id
								left join karyawan as referal on d2.dapaket_referal = referal.karyawan_id
								where 
									".$tglpaket."
									d2.dapaket_stat_dok = 'Tertutup'
									and t2.dtrawat_petugas1 <> 0 and t2.dtrawat_petugas1 <> 5 /*suster*/ and t2.dtrawat_petugas1 <> 60 /*available dr*/
								)
								as t
								left join karyawan k on k.karyawan_id = t.dokter_id
								order by k.karyawan_nama
								";
				$res_dokter = $this->db->query($sql_dokter);
				
				$i = 0;
				foreach($res_dokter->result() as $row_dokter){
					$row = $res_dokter->row($i);		
					$this->report_tindakan_update_temp($isiperiode, $tglpaket, $row->dokter_id, $report_groupby, $i);
					$i++;
				}
								
			$query_temp =  "select t.*, r.rawat_kode, r.rawat_nama
							from temp_jml_tindakan t
							left join perawatan r on r.rawat_id = t.tjt_rawat
							order by rawat_kode";
			
			$result_temp = $this->db->query($query_temp);
			$nbrows = $result_temp->num_rows();
			
			$limit = $query_temp." LIMIT ".$start.",".$end;		
			
			$result_temp = $this->db->query($limit);    
			
			if($nbrows>0){
				foreach($result_temp->result() as $row){
					$arr[] = $row;
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
	//function for advanced search record
	function report_daftar_dokter($tgl_awal,$periode,$report_tindakan_id ,$trawat_tglapp_start ,$trawat_tglapp_end ,$trawat_dokter, $report_groupby, $start,$end){
			//full query
			if ($periode == 'bulan'){
				$isiperiode=" (date_format(jrawat_tanggal,'%Y-%m')='".$tgl_awal."') and " ;
				$tglpaket=" (date_format(dapaket_tgl_ambil,'%Y-%m')='".$tgl_awal."') and " ;
			}else if($periode == 'tanggal'){
				$isiperiode=" (jrawat_tanggal BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."') and ";
				$tglpaket=" (dapaket_tgl_ambil BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."') and " ;
			}
			
			// testing lap format all dokter
			
				//$sql_del = "delete from temp_jml_tindakan";
				//$this->db->query($sql_del);
				
			
				$sql_dokter =  "select t.dokter_id, k.karyawan_nama, karyawan_username
								from
								(
								select 
									ifnull(t1.dtrawat_petugas1, d1.drawat_sales) as dokter_id
								from detail_jual_rawat d1
								left join master_jual_rawat m1 on m1.jrawat_id = d1.drawat_master
								left join tindakan_detail t1 on t1.dtrawat_id = d1.drawat_dtrawat
								left join karyawan as dokter on t1.dtrawat_petugas1 = dokter.karyawan_id
								left join karyawan as referal on d1.drawat_sales = referal.karyawan_id
								where 
									".$isiperiode."
									m1.jrawat_stat_dok = 'Tertutup'
									and t1.dtrawat_petugas1 <> 0 and t1.dtrawat_petugas1 <> 5 /*suster*/ and t1.dtrawat_petugas1 <> 60 /*available dr*/
									
								union

								select
									ifnull(t2.dtrawat_petugas1, d2.dapaket_referal) as dokter_id
								from detail_ambil_paket d2
								left join tindakan_detail t2 on t2.dtrawat_id = d2.dapaket_dtrawat
								left join karyawan as dokter on t2.dtrawat_petugas1 = dokter.karyawan_id
								left join karyawan as referal on d2.dapaket_referal = referal.karyawan_id
								where 
									".$tglpaket."
									d2.dapaket_stat_dok = 'Tertutup'
									and t2.dtrawat_petugas1 <> 0 and t2.dtrawat_petugas1 <> 5 /*suster*/ and t2.dtrawat_petugas1 <> 60 /*available dr*/
								)
								as t
								left join karyawan k on k.karyawan_id = t.dokter_id
								order by k.karyawan_nama
								";
				$res_dokter = $this->db->query($sql_dokter);
				//echo $sql_dokter;
				
				
			$nbrows = $res_dokter->num_rows();
			
			$limit = $sql_dokter." LIMIT ".$start.",".$end;		
			
			$res_dokter = $this->db->query($limit);    
			
			if($nbrows>0){
				foreach($res_dokter->result() as $row){
					$arr[] = $row;
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
				//return $jsonresult;
			} else {
				return '({"total":"0", "results":""})';
			}
		}
	//function for advanced search record
	function report_tindakan_search2($tgl_awal,$periode ,$trawat_tglapp_start ,$trawat_tglapp_end ,$trawat_dokter, $report_groupby, $start,$end){
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
		
		//function for advanced search record
	function report_tindakan_print2($tgl_awal,$periode ,$trawat_tglapp_start ,$trawat_tglapp_end ,$trawat_dokter, $report_groupby){
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
			
			/*$result = $this->db->query($query);
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
			}*/
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