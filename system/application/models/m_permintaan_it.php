<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: gudang Model
	+ Description	: For record model process back-end
	+ Filename 		: c_gudang.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

class m_permintaan_it extends Model{
		
		//constructor
		function m_permintaan_it() {
			parent::Model();
		}
		
		function get_cabang_list(){
			$sql="SELECT cabang_id,cabang_nama FROM cabang ";
			$query = $this->db->query($sql);
			$nbrows = $query->num_rows();
			if($nbrows>0){
				foreach($query->result() as $row){
					$arr[] = $row;
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
		function get_user_login(){
			$username = $_SESSION[SESSION_USERID];
			$sql="SELECT users.user_karyawan AS user_karyawan, karyawan.karyawan_nama AS karyawan_nama FROM users 
			LEFT JOIN karyawan ON karyawan.karyawan_id = users.user_karyawan
			WHERE user_name ='".$username."'";
			$query = $this->db->query($sql);
			$nbrows = $query->num_rows();
			if($nbrows>0){
				foreach($query->result() as $row){
					$arr[] = $row;
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
		//function for get list record
		function permintaan_list($filter,$start,$end){
			$username = $_SESSION[SESSION_USERID];
			$sql_id_cust= "SELECT user_karyawan FROM users WHERE user_name ='".$username."'";
			$query_id_cust= $this->db->query($sql_id_cust);
			$data_id_cust= $query_id_cust->row();
			$permintaan_client_id= $data_id_cust->user_karyawan;
			$query = "
			SELECT karyawan.karyawan_nama AS nama, 
				cabang.cabang_nama AS cabang, 
				permintaan_it.permintaan_cabang AS cabang_id,
				permintaan_it.permintaan_client AS client,
				permintaan_it.permintaan_id as permintaan_id,
				permintaan_it.permintaan_tanggal_masalah AS tanggal_masalah,
				permintaan_it.permintaan_type AS tipe, 
				permintaan_it.permintaan_judul AS judul, 
				permintaan_it.permintaan_masalah AS masalah,
				permintaan_it.permintaan_prioritas AS prioritas,
				permintaan_it.permintaan_penyelesaian AS penyelesaian, 
				permintaan_it.permintaan_tanggal_selesai AS tanggal_selesai, 
				permintaan_it.permintaan_status AS status
			FROM permintaan_it
				LEFT JOIN karyawan ON permintaan_it.permintaan_client = karyawan.karyawan_id
				LEFT JOIN cabang ON permintaan_it.permintaan_cabang = cabang.cabang_id";
			
			if ($permintaan_client_id<>"2" && $permintaan_client_id<>"11" && $permintaan_client_id<>"66" && $permintaan_client_id<>"79"){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (permintaan_it.permintaan_client ='".$permintaan_client_id."')";
			}
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (karyawan.karyawan_nama LIKE '%".addslashes($filter)."%' OR cabang.cabang_nama LIKE '%".addslashes($filter)."%' OR permintaan_it.permintaan_judul LIKE '%".addslashes($filter)."%' )";
			}
			$query.=" ORDER BY tanggal_masalah DESC";
			
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
		
		//function for update record
		function permintaan_update($permintaan_id, $permintaan_client, $permintaan_nama ,$permintaan_cabang ,$permintaan_tanggalmasalah ,$permintaan_tipe ,$permintaan_judul ,$permintaan_permintaan ,$permintaan_prioritas ,$permintaan_penyelesaian ,$permintaan_status, $permintaan_tanggalselesai ){
			if ($permintaan_tipe=="")
				$permintaan_tipe = "Miracle Information System";
			if ($permintaan_prioritas=="")
				$permintaan_prioritas = "Low";
			if ($permintaan_status=="")
				$permintaan_status = "Open";
			
			$data = array(
				"permintaan_id"=>$permintaan_id,
				"permintaan_client"=>$permintaan_client,
				//"permintaan_cabang"=>$permintaan_cabang,	
				"permintaan_tanggal_masalah"=>$permintaan_tanggalmasalah,	
				"permintaan_type"=>$permintaan_tipe,	
				"permintaan_judul"=>$permintaan_judul,	
				"permintaan_masalah"=>$permintaan_permintaan,	
				"permintaan_prioritas"=>$permintaan_prioritas,	
				"permintaan_penyelesaian"=>$permintaan_penyelesaian,
				"permintaan_status"=>$permintaan_status,
				"permintaan_tanggal_selesai"=>$permintaan_tanggalselesai					
			);
			
			
			$sql="SELECT cabang_id FROM cabang WHERE cabang_id='".$permintaan_cabang."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["permintaan_cabang"]=$permintaan_cabang;

			$this->db->where('permintaan_id', $permintaan_id);
			$this->db->update('permintaan_it', $data);
			
	
			//if($this->db->affected_rows()){
			//	$sql="UPDATE gudang set gudang_revised=(gudang_revised+1) WHERE gudang_id='".$gudang_id."'";
			//	$this->db->query($sql);
			//}
			return '1';

		}
		
		//function for create new record
		function permintaan_create($permintaan_nama ,$permintaan_cabang ,$permintaan_tanggalmasalah ,$permintaan_tipe ,$permintaan_judul ,$permintaan_permintaan ,$permintaan_prioritas ,$permintaan_penyelesaian ,$permintaan_status, $permintaan_tanggalselesai ){
			if ($permintaan_tipe=="")
				$permintaan_tipe = "Miracle Information System";
			if ($permintaan_prioritas=="")
				$permintaan_prioritas = "Low";
			if ($permintaan_status=="")
				$permintaan_status = "Open";
							
			$username = $_SESSION[SESSION_USERID];
			$sql_id_cust= "SELECT user_karyawan FROM users WHERE user_name ='".$username."'";
			$query_id_cust= $this->db->query($sql_id_cust);
			$data_id_cust= $query_id_cust->row();
			$permintaan_client_id= $data_id_cust->user_karyawan;
			
			$data = array(
				"permintaan_client"=>$permintaan_client_id,	
				"permintaan_cabang"=>$permintaan_cabang,	
				"permintaan_tanggal_masalah"=>$permintaan_tanggalmasalah,	
				"permintaan_type"=>$permintaan_tipe,	
				"permintaan_judul"=>$permintaan_judul,	
				"permintaan_masalah"=>$permintaan_permintaan,	
				"permintaan_prioritas"=>$permintaan_prioritas,	
				"permintaan_penyelesaian"=>$permintaan_penyelesaian,
				"permintaan_status"=>$permintaan_status,
				"permintaan_tanggal_selesai"=>$permintaan_tanggalselesai			
				//"gudang_revised"=>'0'	
			);
			$this->db->insert('permintaan_it', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function gudang_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the gudangs at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM gudang WHERE gudang_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM gudang WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "gudang_id= ".$pkid[$i];
					if($i<sizeof($pkid)-1){
						$query = $query . " OR ";
					}     
				}
				$this->db->query($query);
			}
			if($this->db->affected_rows()>0)
				return '1';
			else
				return '0';
		}
		
		//function for advanced search record
		function permintaan_search($permintaan_nama ,$permintaan_cabang ,$permintaan_tanggalmasalah ,$permintaan_tipe ,$permintaan_judul ,$permintaan_prioritas ,$permintaan_status, $permintaan_tanggalselesai, $start,$end){
			//if($gudang_aktif=="")
			//	$gudang_aktif="Aktif";
			//full query
			$username = $_SESSION[SESSION_USERID];
			$sql_id_cust= "SELECT user_karyawan FROM users WHERE user_name ='".$username."'";
			$query_id_cust= $this->db->query($sql_id_cust);
			$data_id_cust= $query_id_cust->row();
			$permintaan_client_id= $data_id_cust->user_karyawan;
			$query="
			SELECT karyawan.karyawan_nama AS nama, 
				cabang.cabang_nama AS cabang, 
				permintaan_it.permintaan_cabang AS cabang_id,
				permintaan_it.permintaan_client AS client,
				permintaan_it.permintaan_id as permintaan_id,
				permintaan_it.permintaan_tanggal_masalah AS tanggal_masalah,
				permintaan_it.permintaan_type AS tipe, 
				permintaan_it.permintaan_judul AS judul, 
				permintaan_it.permintaan_masalah AS masalah,
				permintaan_it.permintaan_prioritas AS prioritas,
				permintaan_it.permintaan_penyelesaian AS penyelesaian, 
				permintaan_it.permintaan_tanggal_selesai AS tanggal_selesai, 
				permintaan_it.permintaan_status AS status
			FROM permintaan_it
				LEFT JOIN karyawan ON permintaan_it.permintaan_client = karyawan.karyawan_id
				LEFT JOIN cabang ON permintaan_it.permintaan_cabang = cabang.cabang_id";
			
			if($permintaan_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan.karyawan_nama LIKE '%".$permintaan_nama."%'";
			};
			if($permintaan_cabang!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cabang.cabang_nama LIKE '%".$permintaan_cabang."%'";
			};
			if($permintaan_tanggalmasalah!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " permintaan_it.permintaan_tanggal_masalah LIKE '%".$permintaan_tanggalmasalah."%'";
			};
			if($permintaan_tipe!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " permintaan_it.permintaan_type LIKE '%".$permintaan_tipe."%'";
			};
			if($permintaan_judul!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " permintaan_it.permintaan_judul LIKE '%".$permintaan_judul."%'";
			};
			if($permintaan_prioritas!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " permintaan_it.permintaan_prioritas LIKE '%".$permintaan_prioritas."%'";
			};
			if($permintaan_status!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " permintaan_it.permintaan_status LIKE '%".$permintaan_status."%'";
			};
			if($permintaan_tanggalselesai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " permintaan_it.permintaan_tanggal_selesai LIKE '%".$permintaan_tanggalselesai."%'";
			};

			if ($permintaan_client_id<>"2" && $permintaan_client_id<>"11" && $permintaan_client_id<>"66" && $permintaan_client_id<>"79"){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (permintaan_it.permintaan_client ='".$permintaan_client_id."')";
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
		function gudang_print($gudang_id ,$gudang_nama ,$gudang_lokasi ,$gudang_keterangan ,$gudang_aktif ,$gudang_creator ,$gudang_date_create ,$gudang_update ,$gudang_date_update ,$gudang_revised ,$option,$filter){
			//full query
			$query="select * from gudang";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (gudang_id LIKE '%".addslashes($filter)."%' OR gudang_nama LIKE '%".addslashes($filter)."%' OR gudang_lokasi LIKE '%".addslashes($filter)."%' OR gudang_keterangan LIKE '%".addslashes($filter)."%' OR gudang_aktif LIKE '%".addslashes($filter)."%' OR gudang_creator LIKE '%".addslashes($filter)."%' OR gudang_date_create LIKE '%".addslashes($filter)."%' OR gudang_update LIKE '%".addslashes($filter)."%' OR gudang_date_update LIKE '%".addslashes($filter)."%' OR gudang_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($gudang_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_id LIKE '%".$gudang_id."%'";
				};
				if($gudang_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_nama LIKE '%".$gudang_nama."%'";
				};
				if($gudang_lokasi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_lokasi LIKE '%".$gudang_lokasi."%'";
				};
				if($gudang_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_keterangan LIKE '%".$gudang_keterangan."%'";
				};
				if($gudang_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_aktif LIKE '%".$gudang_aktif."%'";
				};
				if($gudang_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_creator LIKE '%".$gudang_creator."%'";
				};
				if($gudang_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_date_create LIKE '%".$gudang_date_create."%'";
				};
				if($gudang_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_update LIKE '%".$gudang_update."%'";
				};
				if($gudang_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_date_update LIKE '%".$gudang_date_update."%'";
				};
				if($gudang_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_revised LIKE '%".$gudang_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function gudang_export_excel($gudang_id ,$gudang_nama ,$gudang_lokasi ,$gudang_keterangan ,$gudang_aktif ,$gudang_creator ,$gudang_date_create ,$gudang_update ,$gudang_date_update ,$gudang_revised ,$option,$filter){
			//full query
			$query="select 	gudang_nama AS nama,
							gudang_lokasi AS lokasi,
							gudang_keterangan AS keterangan,
							gudang_aktif AS aktif

					from gudang";
					
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (gudang_id LIKE '%".addslashes($filter)."%' OR gudang_nama LIKE '%".addslashes($filter)."%' OR gudang_lokasi LIKE '%".addslashes($filter)."%' OR gudang_keterangan LIKE '%".addslashes($filter)."%' OR gudang_aktif LIKE '%".addslashes($filter)."%' OR gudang_creator LIKE '%".addslashes($filter)."%' OR gudang_date_create LIKE '%".addslashes($filter)."%' OR gudang_update LIKE '%".addslashes($filter)."%' OR gudang_date_update LIKE '%".addslashes($filter)."%' OR gudang_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($gudang_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_id LIKE '%".$gudang_id."%'";
				};
				if($gudang_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_nama LIKE '%".$gudang_nama."%'";
				};
				if($gudang_lokasi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_lokasi LIKE '%".$gudang_lokasi."%'";
				};
				if($gudang_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_keterangan LIKE '%".$gudang_keterangan."%'";
				};
				if($gudang_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_aktif LIKE '%".$gudang_aktif."%'";
				};
				if($gudang_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_creator LIKE '%".$gudang_creator."%'";
				};
				if($gudang_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_date_create LIKE '%".$gudang_date_create."%'";
				};
				if($gudang_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_update LIKE '%".$gudang_update."%'";
				};
				if($gudang_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_date_update LIKE '%".$gudang_date_update."%'";
				};
				if($gudang_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " gudang_revised LIKE '%".$gudang_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>