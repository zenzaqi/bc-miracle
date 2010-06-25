<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: users Model
	+ Description	: For record model process back-end
	+ Filename 		: c_users.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 16/Jul/2009 15:35:27
	
*/

class M_jadwal_terapis extends Model{
		
		//constructor
		function M_jadwal_terapis() {
			parent::Model();
		}
		
		//function for get list record
		function jadwal_terapis_list($filter,$start,$end,$tgl_app){
			
			//$query = "SELECT * FROM users,karyawan,usergroups WHERE user_karyawan=karyawan_id AND user_groups=group_id";
			//$dt=date('Y-m-d');
			$month=date('Y-m');
			
			if($tgl_app<>''){
				$dt=date('Y-m-d', strtotime($tgl_app));
			}else{
				$dt=date('Y-m-d');
			}
			
			$query = "select distinct
						karyawan.karyawan_username,
						ifnull(vu_report_tindakan_terapis.terapis_count,0) as terapis_count,
						absensi.absensi_shift,
						absensi.absensi_tgl,
						ifnull(vu_jterapis.terapis_count_day,0) as terapis_count_day,
						absensi.absensi_keterangan
					from absensi
						left join vu_report_tindakan_terapis on (vu_report_tindakan_terapis.terapis_id=absensi.absensi_karyawan_id and vu_report_tindakan_terapis.terapis_bulan = '$month')
						left join karyawan on (absensi.absensi_karyawan_id = karyawan.karyawan_id)
						left join vu_jterapis on (absensi.absensi_karyawan_id = vu_jterapis.terapis_id and vu_jterapis.terapis_bulan = '$dt')
					where absensi.absensi_tgl = '$dt' and absensi.absensi_shift = 'P'
					order by terapis_count_day desc";
		
		$query2 = "select distinct
						karyawan.karyawan_username,
						ifnull(vu_report_tindakan_terapis.terapis_count,0) as terapis_count,
						absensi.absensi_shift,
						absensi.absensi_tgl,
						ifnull(vu_jterapis.terapis_count_day,0) as terapis_count_day,
						absensi.absensi_keterangan
					from absensi
						left join vu_report_tindakan_terapis on (vu_report_tindakan_terapis.terapis_id=absensi.absensi_karyawan_id and vu_report_tindakan_terapis.terapis_bulan = '$month')
						left join karyawan on (absensi.absensi_karyawan_id = karyawan.karyawan_id)
						left join vu_jterapis on (absensi.absensi_karyawan_id = vu_jterapis.terapis_id and vu_jterapis.terapis_bulan = '$dt')
					where absensi.absensi_tgl = '$dt' and absensi.absensi_shift = 'S'
					order by terapis_count_day desc";
		
		$query3 = "select distinct
						karyawan.karyawan_username,
						ifnull(vu_report_tindakan_terapis.terapis_count,0) as terapis_count,
						absensi.absensi_shift,
						absensi.absensi_tgl,
						ifnull(vu_jterapis.terapis_count_day,0) as terapis_count_day,
						absensi.absensi_keterangan
					from absensi
						left join vu_report_tindakan_terapis on (vu_report_tindakan_terapis.terapis_id=absensi.absensi_karyawan_id and vu_report_tindakan_terapis.terapis_bulan = '$month')
						left join karyawan on (absensi.absensi_karyawan_id = karyawan.karyawan_id)
						left join vu_jterapis on (absensi.absensi_karyawan_id = vu_jterapis.terapis_id and vu_jterapis.terapis_bulan = '$dt')
					where absensi.absensi_tgl = '$dt' and absensi.absensi_shift = 'M'
					order by terapis_count_day desc";
	
		$query4 = "select distinct
						karyawan.karyawan_username,
						ifnull(vu_report_tindakan_terapis.terapis_count,0) as terapis_count,
						absensi.absensi_shift,
						absensi.absensi_tgl,
						ifnull(vu_jterapis.terapis_count_day,0) as terapis_count_day,
						absensi.absensi_keterangan
					from absensi
						left join vu_report_tindakan_terapis on (vu_report_tindakan_terapis.terapis_id=absensi.absensi_karyawan_id and vu_report_tindakan_terapis.terapis_bulan = '$month')
						left join karyawan on (absensi.absensi_karyawan_id = karyawan.karyawan_id)
						left join vu_jterapis on (absensi.absensi_karyawan_id = vu_jterapis.terapis_id and vu_jterapis.terapis_bulan = '$dt')
					where absensi.absensi_tgl = '$dt' and absensi.absensi_shift = 'OFF'
					order by terapis_count_day desc";
		
		$nbrows = 0;
		$nbrows2 = 0;
		$nbrows3 = 0;
		$nbrows4 = 0;
		
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
		
		$nbrows = $nbrows + $nbrows2 + $nbrows3 + $nbrows4;
		
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
			/*$query="select distinct
						karyawan.karyawan_username,
						ifnull(vu_report_tindakan_terapis.terapis_count,0) as terapis_count,
						absensi.absensi_shift,
						absensi.absensi_tgl,
						ifnull(vu_jterapis.terapis_count_day,0) as terapis_count_day
					from absensi
						left join vu_report_tindakan_terapis on (vu_report_tindakan_terapis.terapis_id=absensi.absensi_karyawan_id and vu_report_tindakan_terapis.terapis_bulan = '$month')
						left join karyawan on (absensi.absensi_karyawan_id = karyawan.karyawan_id)
						left join vu_jterapis on (absensi.absensi_karyawan_id = vu_jterapis.terapis_id and vu_jterapis.terapis_bulan = '$dt')
					where absensi.absensi_tgl = '$dt'
					group by karyawan.karyawan_username";
			// For simple search
			/*if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (user_id LIKE '%".addslashes($filter)."%' OR user_name LIKE '%".addslashes($filter)."%' OR user_passwd LIKE '%".addslashes($filter)."%' OR user_karyawan LIKE '%".addslashes($filter)."%' OR user_log LIKE '%".addslashes($filter)."%' OR user_groups LIKE '%".addslashes($filter)."%' OR user_aktif LIKE '%".addslashes($filter)."%' )";
			}
			
				if ($filter<>"" && is_numeric($filter)==true){
				if($tgl_app!=""){
					$dt=date('Y-m-d', strtotime($tgl_app));
					$query="select distinct
	karyawan.karyawan_username,
	vu_report_tindakan_terapis.*,
	absensi.absensi_shift,
	absensi.absensi_tgl,
	vu_jterapis.terapis_count_day
from vu_report_tindakan_terapis
left join absensi on (vu_report_tindakan_terapis.terapis_id=absensi.absensi_karyawan_id)
left join karyawan on (vu_report_tindakan_terapis.terapis_id = karyawan.karyawan_id)
left join vu_jterapis on (vu_report_tindakan_terapis.terapis_id = vu_jterapis.terapis_id)
where vu_report_tindakan_terapis.terapis_bulan = date_format('$tgl_app','%Y-%m') and absensi.absensi_tgl = '$tgl_app' and vu_jterapis.terapis_bulan = '$tgl_app'
group by karyawan.karyawan_username";
				}else{
					$query="select distinct
	karyawan.karyawan_username,
	vu_report_tindakan_terapis.*,
	absensi.absensi_shift,
	absensi.absensi_tgl,
	vu_jterapis.terapis_count_day
from vu_report_tindakan_terapis
left join absensi on (vu_report_tindakan_terapis.terapis_id=absensi.absensi_karyawan_id)
left join karyawan on (vu_report_tindakan_terapis.terapis_id = karyawan.karyawan_id)
left join vu_jterapis on (vu_report_tindakan_terapis.terapis_id = vu_jterapis.terapis_id)
where vu_report_tindakan_terapis.terapis_bulan = date_format('$tgl_app','%Y-%m') and absensi.absensi_tgl = '$tgl_app' and vu_jterapis.terapis_bulan = '$tgl_app'
group by karyawan.karyawan_username";
				}
				
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
		}*/
		
		
			function jadwal_terapis_search($lap_kunjungan_id ,$trawat_tglapp_start, $start,$end){
			//full query
			$dt=date('Y-m-d');
			$month=date('Y-m');
			if($trawat_tglapp_start!='')
			{
			$query = "select distinct
						karyawan.karyawan_username,
						ifnull(vu_report_tindakan_terapis.terapis_count,0) as terapis_count,
						absensi.absensi_shift,
						absensi.absensi_tgl,
						ifnull(vu_jterapis.terapis_count_day,0) as terapis_count_day,
						absensi.absensi_keterangan
					from absensi
						left join vu_report_tindakan_terapis on (vu_report_tindakan_terapis.terapis_id=absensi.absensi_karyawan_id and vu_report_tindakan_terapis.terapis_bulan = date_format('$trawat_tglapp_start','%Y-%m'))
						left join karyawan on (absensi.absensi_karyawan_id = karyawan.karyawan_id)
						left join vu_jterapis on (absensi.absensi_karyawan_id = vu_jterapis.terapis_id and vu_jterapis.terapis_bulan = '$trawat_tglapp_start')
					where absensi.absensi_tgl = '$trawat_tglapp_start' and absensi.absensi_shift = 'P'";
		
			$query2 = "select distinct
						karyawan.karyawan_username,
						ifnull(vu_report_tindakan_terapis.terapis_count,0) as terapis_count,
						absensi.absensi_shift,
						absensi.absensi_tgl,
						ifnull(vu_jterapis.terapis_count_day,0) as terapis_count_day,
						absensi.absensi_keterangan
					from absensi
						left join vu_report_tindakan_terapis on (vu_report_tindakan_terapis.terapis_id=absensi.absensi_karyawan_id and vu_report_tindakan_terapis.terapis_bulan = date_format('$trawat_tglapp_start','%Y-%m'))
						left join karyawan on (absensi.absensi_karyawan_id = karyawan.karyawan_id)
						left join vu_jterapis on (absensi.absensi_karyawan_id = vu_jterapis.terapis_id and vu_jterapis.terapis_bulan = '$trawat_tglapp_start')
					where absensi.absensi_tgl = '$trawat_tglapp_start' and absensi.absensi_shift = 'S'";
		
			$query3 = "select distinct
						karyawan.karyawan_username,
						ifnull(vu_report_tindakan_terapis.terapis_count,0) as terapis_count,
						absensi.absensi_shift,
						absensi.absensi_tgl,
						ifnull(vu_jterapis.terapis_count_day,0) as terapis_count_day,
						absensi.absensi_keterangan
					from absensi
						left join vu_report_tindakan_terapis on (vu_report_tindakan_terapis.terapis_id=absensi.absensi_karyawan_id and vu_report_tindakan_terapis.terapis_bulan = date_format('$trawat_tglapp_start','%Y-%m'))
						left join karyawan on (absensi.absensi_karyawan_id = karyawan.karyawan_id)
						left join vu_jterapis on (absensi.absensi_karyawan_id = vu_jterapis.terapis_id and vu_jterapis.terapis_bulan = '$trawat_tglapp_start')
					where absensi.absensi_tgl = '$trawat_tglapp_start' and absensi.absensi_shift = 'M'";
	
			$query4 = "select distinct
						karyawan.karyawan_username,
						ifnull(vu_report_tindakan_terapis.terapis_count,0) as terapis_count,
						absensi.absensi_shift,
						absensi.absensi_tgl,
						ifnull(vu_jterapis.terapis_count_day,0) as terapis_count_day,
						absensi.absensi_keterangan
					from absensi
						left join vu_report_tindakan_terapis on (vu_report_tindakan_terapis.terapis_id=absensi.absensi_karyawan_id and vu_report_tindakan_terapis.terapis_bulan = date_format('$trawat_tglapp_start','%Y-%m'))
						left join karyawan on (absensi.absensi_karyawan_id = karyawan.karyawan_id)
						left join vu_jterapis on (absensi.absensi_karyawan_id = vu_jterapis.terapis_id and vu_jterapis.terapis_bulan = '$trawat_tglapp_start')
					where absensi.absensi_tgl = '$trawat_tglapp_start' and absensi.absensi_shift = 'OFF'";
			}
			
			
			/*{
	$query = "select distinct
						karyawan.karyawan_username,
						ifnull(vu_report_tindakan_terapis.terapis_count,0) as terapis_count,
						absensi.absensi_shift,
						absensi.absensi_tgl,
						ifnull(vu_jterapis.terapis_count_day,0) as terapis_count_day
					from absensi
						left join vu_report_tindakan_terapis on (vu_report_tindakan_terapis.terapis_id=absensi.absensi_karyawan_id and vu_report_tindakan_terapis.terapis_bulan = date_format('$trawat_tglapp_start','%Y-%m'))
						left join karyawan on (absensi.absensi_karyawan_id = karyawan.karyawan_id)
						left join vu_jterapis on (absensi.absensi_karyawan_id = vu_jterapis.terapis_id and vu_jterapis.terapis_bulan = '$trawat_tglapp_start')
					where absensi.absensi_tgl = '$trawat_tglapp_start'"; 
	}*/

	
			
			//$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
			//$query.=" k.karyawan_id != 60 and p.rawat_id is not null"; //60 = Available . Dr
			//$query.=" group by karyawan.karyawan_username";
		
		$result = $this->db->query($query);
		$nbrows = $result->num_rows();

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
			}
		}*/
		
		
		
		//function for update record
		function penyesuaian_update($adj_id, $adj_count){
	
		$sql="select * from tindakan_adjust where adj_id = '$adj_id'";
	
	$rs=$this->db->query($sql);
		if($rs->num_rows()){
		$data = array(
		
				"adj_count"=>$adj_count
			);
			$this->db->where('adj_id', $adj_id);
			$this->db->update('tindakan_adjust', $data);
		}
	
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		
		//function for print record
		/*function users_print($user_id ,$user_name ,$user_passwd ,$user_karyawan ,$user_log ,$user_groups ,$user_aktif ,$option,$filter){
			//full query
			$query="select * from users";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (user_id LIKE '%".addslashes($filter)."%' OR user_name LIKE '%".addslashes($filter)."%' OR user_passwd LIKE '%".addslashes($filter)."%' OR user_karyawan LIKE '%".addslashes($filter)."%' OR user_log LIKE '%".addslashes($filter)."%' OR user_groups LIKE '%".addslashes($filter)."%' OR user_aktif LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($user_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " user_id LIKE '%".$user_id."%'";
				};
				if($user_name!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " user_name LIKE '%".$user_name."%'";
				};
				if($user_passwd!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " user_passwd LIKE '%".$user_passwd."%'";
				};
				if($user_karyawan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " user_karyawan LIKE '%".$user_karyawan."%'";
				};
				if($user_log!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " user_log LIKE '%".$user_log."%'";
				};
				if($user_groups!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " user_groups LIKE '%".$user_groups."%'";
				};
				if($user_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " user_aktif LIKE '%".$user_aktif."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}*/
		
		//function  for export to excel
		/*function users_export_excel($user_id ,$user_name ,$user_passwd ,$user_karyawan ,$user_log ,$user_groups ,$user_aktif ,$option,$filter){
			//full query
			$query="select * from users";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (user_id LIKE '%".addslashes($filter)."%' OR user_name LIKE '%".addslashes($filter)."%' OR user_passwd LIKE '%".addslashes($filter)."%' OR user_karyawan LIKE '%".addslashes($filter)."%' OR user_log LIKE '%".addslashes($filter)."%' OR user_groups LIKE '%".addslashes($filter)."%' OR user_aktif LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($user_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " user_id LIKE '%".$user_id."%'";
				};
				if($user_name!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " user_name LIKE '%".$user_name."%'";
				};
				if($user_passwd!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " user_passwd LIKE '%".$user_passwd."%'";
				};
				if($user_karyawan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " user_karyawan LIKE '%".$user_karyawan."%'";
				};
				if($user_log!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " user_log LIKE '%".$user_log."%'";
				};
				if($user_groups!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " user_groups LIKE '%".$user_groups."%'";
				};
				if($user_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " user_aktif LIKE '%".$user_aktif."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}*/
		

}
?>