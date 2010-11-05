<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: akun Model
	+ Description	: For record model process back-end
	+ Filename 		: c_akun.php
 	+ creator 		: 
 	+ Created on 12/Mar/2010 10:42:59
	
*/

class M_akun extends Model{
		
		//constructor
		function M_akun() {
			parent::Model();
		}
		
		//function for get list record
		function akun_list($filter,$start,$end){
			$query = "SELECT * FROM akun ";

			// For simple search
			if ($filter<>"" && $query !=""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (akun_kode LIKE '%".addslashes($filter)."%' OR 
							 akun_jenis LIKE '%".addslashes($filter)."%' OR
							 akun_nama LIKE '%".addslashes($filter)."%' OR 
							 akun_saldo LIKE '%".addslashes($filter)."%' )";
				$limit = $query;
			}
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			if($end=="") $end=15;
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

		function get_akun_list($filter,$start,$end){
			$query = "SELECT * FROM akun WHERE akun_level<5 AND akun_aktif='Y'";

			// For simple search
			if ($filter<>"" && $query !=""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (akun_kode LIKE '%".addslashes($filter)."%' OR 
							 akun_jenis LIKE '%".addslashes($filter)."%' OR 
							 akun_nama LIKE '%".addslashes($filter)."%' OR 
							 akun_saldo LIKE '%".addslashes($filter)."%' )";
				$limit = $query;
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
		
		//function for create new record
		function akun_create($akun_kode ,$akun_jenis ,$akun_parent ,$akun_level ,$akun_nama ,$akun_debet ,$akun_kredit ,$akun_saldo ,$akun_aktif ,
							 $akun_creator ,$akun_date_create ){
			$data = array(
				"akun_kode"=>$akun_kode, 
				"akun_jenis"=>$akun_jenis, 
				"akun_parent"=>$akun_parent, 
				"akun_level"=>$akun_level, 
				"akun_nama"=>$akun_nama, 
				"akun_debet"=>$akun_debet, 
				"akun_kredit"=>$akun_kredit, 
				"akun_saldo"=>$akun_saldo, 
				"akun_aktif"=>$akun_aktif, 
				"akun_creator"=>$akun_creator, 
				"akun_date_create"=>$akun_date_create 
			);
			
			if($akun_parent!==""){
				$sql="SELECT akun_kode,akun_level FROM akun WHERE akun_id='".$akun_parent."'";
				$result=$this->db->query($sql);
				if($result->num_rows()){
					$row=$result->row();
					$data["akun_parent_kode"]=$row->akun_kode;
					$data["akun_level"]=$row->akun_level+1;
				}
			}else{
				$data["akun_level"]=0;
			}
			
			$this->db->insert('akun', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}

		//function for update record
		function akun_update($akun_id,$akun_kode,$akun_jenis,$akun_parent,$akun_level,$akun_nama,$akun_debet,$akun_kredit,$akun_saldo,$akun_aktif,
							 $akun_update,$akun_date_update){
			$data = array(
				"akun_kode"=>$akun_kode, 
				"akun_jenis"=>$akun_jenis, 
				"akun_parent"=>$akun_parent, 
				"akun_level"=>$akun_level, 
				"akun_nama"=>$akun_nama, 
				"akun_debet"=>$akun_debet, 
				"akun_kredit"=>$akun_kredit, 
				"akun_saldo"=>$akun_saldo, 
				"akun_aktif"=>$akun_aktif, 
				"akun_update"=>$akun_update, 
				"akun_date_update"=>$akun_date_update 
			);
			
			if($akun_parent!==""){
				$sql="SELECT akun_kode,akun_level, akun_jenis FROM akun WHERE akun_id='".$akun_parent."'";
				$result=$this->db->query($sql);
				if($result->num_rows()){
					$row=$result->row();
					$data["akun_parent_kode"]=$row->akun_kode;
					$data["akun_level"]=$row->akun_level+1;
					$data["akun_jenis"]=$row->akun_jenis;
				}
			}else{
				$data["akun_parent_kode"]=0;
				$data["akun_level"]=1;
				$data["akun_jenis"]=$akun_jenis;
			}
			
			
			$this->db->where('akun_id', $akun_id);
			$this->db->update('akun', $data);
			$sql="UPDATE akun set akun_revised=(akun_revised+1) where akun_id='".$akun_id."'";
			$this->db->query($sql);
			/*
			$sql="SELECT akun_parent_kode,akun_level FROM akun WHERE akun_id='".$akun_id."'";
			$result=$this->db->query($sql);
			if($result->num_rows()){
				$row=$result->row();
				$data["akun_parent_kode"]=$row->akun_parent_kode;
				$data["akun_level"]=$row->akun_level;
			}
			
			$this->db->insert('akun', $data);*/
			
			return '1';
		}

		//fcuntion for delete record
		function akun_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the akuns at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "UPDATE akun set akun_aktif='T' WHERE akun_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "UPDATE akun set akun_aktif='T' WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "akun_id= ".$pkid[$i];
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
		function akun_search($akun_id ,$akun_kode ,$akun_jenis ,$akun_parent ,$akun_level ,$akun_nama ,$akun_debet ,$akun_kredit ,$akun_saldo ,
							 $akun_aktif ,$akun_creator ,$akun_date_create ,$akun_update ,$akun_date_update ,$akun_revised ,$start,$end){
			//full query
			$query = "SELECT * FROM akun ";
			
			if($akun_kode!=''){
				$query.=" AND ";
				$query.= " akun_kode LIKE '%".$akun_kode."%'";
			};
			if($akun_jenis!=''){
				$query.=" AND ";
				$query.= " akun_jenis = '".$akun_jenis."'";
			};
			if($akun_parent!=''){
				$query.=" AND ";
				$query.= " akun_parent = '".$akun_parent."'";
			};
			if($akun_level!=''){
				$query.=" AND ";
				$query.= " akun_level = '".$akun_level."'";
			};
			if($akun_nama!=''){
				$query.=" AND ";
				$query.= " akun_nama LIKE '%".$akun_nama."%'";
			};
			if($akun_saldo!=''){
				$query.=" AND ";
				$query.= " akun_saldo LIKE '%".$akun_saldo."%'";
			};
			
			//$this->firephp->log($query);
			
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
		function akun_print($akun_id ,$akun_kode ,$akun_jenis ,$akun_parent ,$akun_level ,$akun_nama ,$akun_debet ,$akun_kredit ,$akun_saldo ,
							$akun_aktif ,$akun_creator ,$akun_date_create ,$akun_update ,$akun_date_update ,$akun_revised ,$option,$filter){
			//full query
			$sql = "SELECT * FROM akun ";
						
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (akun_kode LIKE '%".addslashes($filter)."%' OR 
						   akun_jenis LIKE '%".addslashes($filter)."%' OR 
						   akun_nama LIKE '%".addslashes($filter)."%' OR 
						   akun_saldo LIKE '%".addslashes($filter)."%' )";																																																																					

			} else if($option=='SEARCH'){
				if($akun_kode!=''){
					$query.=" AND ";
					$query.= " akun_kode LIKE '%".$akun_kode."%'";
				};
				if($akun_jenis!=''){
					$query.=" AND ";
					$query.= " akun_jenis = '".$akun_jenis."'";
				};
				if($akun_parent!=''){
					$query.=" AND ";
					$query.= " akun_parent = '".$akun_parent."'";
				};
				if($akun_level!=''){
					$query.=" AND ";
					$query.= " akun_level = '".$akun_level."'";
				};
				if($akun_nama!=''){
					$query.=" AND ";
					$query.= " akun_nama LIKE '%".$akun_nama."%'";
				};
				if($akun_saldo!=''){
					$query.=" AND ";
					$query.= " akun_saldo LIKE '%".$akun_saldo."%'";
				};
			}
			$this->firephp->log($sql);
			$query = $this->db->query($sql);
			return $query->result();
		}
		
		//function  for export to excel
		function akun_export_excel($akun_id ,$akun_kode ,$akun_jenis ,$akun_parent ,$akun_level ,$akun_nama ,$akun_debet ,$akun_kredit ,$akun_saldo ,
								   $akun_aktif ,$akun_creator ,$akun_date_create ,$akun_update ,$akun_date_update ,$akun_revised ,$option,$filter){
			//full query
			$sql = "SELECT akun_kode as Kode, akun_nama as 'Nama Akun', akun_debet as Debet, akun_kredit as Kredit, 
							akun_saldo as Saldo, akun_jenis as Jenis, akun_aktif as Aktif FROM akun";
						
			if($option=='LIST'){
					$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
					$sql .= " (akun_kode LIKE '%".addslashes($filter)."%' OR 
						   		akun_jenis LIKE '%".addslashes($filter)."%' OR  
								akun_nama LIKE '%".addslashes($filter)."%' OR 
							     akun_saldo LIKE '%".addslashes($filter)."%'  )";	
			} else if($option=='SEARCH'){
				if($akun_kode!=''){
					$query.=" AND ";
					$query.= " akun_kode LIKE '%".$akun_kode."%'";
				};
				if($akun_jenis!=''){
					$query.=" AND ";
					$query.= " akun_jenis = '".$akun_jenis."'";
				};
				if($akun_parent!=''){
					$query.=" AND ";
					$query.= " akun_parent ='".$akun_parent."'";
				};
				if($akun_level!=''){
					$query.=" AND ";
					$query.= " akun_level = '".$akun_level."'";
				};
				if($akun_nama!=''){
					$query.=" AND ";
					$query.= " akun_nama LIKE '%".$akun_nama."%'";
				};
				if($akun_saldo!=''){
					$query.=" AND ";
					$query.= " akun_saldo LIKE '%".$akun_saldo."%'";
				};

			}
			$query = $this->db->query($sql);
			return $query;
		}
		
}
?>