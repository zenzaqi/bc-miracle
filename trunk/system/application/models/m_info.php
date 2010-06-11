<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: info Model
	+ Description	: For record model process back-end
	+ Filename 		: c_info.php
 	+ Author  		: Zainal, Mukhlison
 	+ Created on 11/Jul/2009 06:46:58
	
*/

class M_info extends Model{
		
		//constructor
		function M_info() {
			parent::Model();
		}
		
		function get_detail_info(){
			$sql="select * from info";
			$result=$this->db->query($sql);
			$nbrows = $result->num_rows();
			
			if($nbrows>0){
				foreach($result->result() as $row){
					$arr[] = $row;
				}
				$jsonresult = json_encode($arr);
				return '({"total":"1","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
		
		//auto cabang
		function get_auto_cabang ($cabang_id){
		$sql = "SELECT * from cabang where cabang_id='".$cabang_id."' and cabang_aktif!='Tidak Aktif' order by cabang_id desc limit 1";
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
		function info_list($filter,$start,$end){
			$query = "SELECT * FROM info";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (info_id LIKE '%".addslashes($filter)."%' OR info_nama LIKE '%".addslashes($filter)."%' OR info_alamat LIKE '%".addslashes($filter)."%' OR info_notelp LIKE '%".addslashes($filter)."%' OR info_nofax LIKE '%".addslashes($filter)."%' OR info_email LIKE '%".addslashes($filter)."%' OR info_website LIKE '%".addslashes($filter)."%' OR info_slogan LIKE '%".addslashes($filter)."%' OR info_logo LIKE '%".addslashes($filter)."%' OR info_icon LIKE '%".addslashes($filter)."%' OR info_background LIKE '%".addslashes($filter)."%' OR info_theme LIKE '%".addslashes($filter)."%' )";
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
		
		//function for update record
		function info_update($info_id ,$info_nama ,$info_alamat ,$info_notelp ,$info_nofax ,$info_email ,$info_website ,$info_slogan, $info_cabang){
			$data = array(
				"info_id"=>$info_id,			
				"info_nama"=>$info_nama,			
				"info_alamat"=>$info_alamat,			
				"info_notelp"=>$info_notelp,			
				"info_nofax"=>$info_nofax,			
				"info_email"=>$info_email,			
				"info_website"=>$info_website,			
				"info_slogan"=>$info_slogan,
				"info_cabang"=>$info_cabang
			);
			$this->db->where('info_id', $info_id);
			$this->db->update('info', $data);
			
			if($this->db->affected_rows())
				return "{success:true}";
			else
				return "{failure:true}";
		}
		
		//function for create new record
		function info_create($info_nama ,$info_alamat ,$info_notelp ,$info_nofax ,$info_email ,$info_website ,$info_slogan ,$info_logo ,$info_icon ,$info_background ,$info_theme ){
			$data = array(
	
				"info_nama"=>$info_nama,	
				"info_alamat"=>$info_alamat,	
				"info_notelp"=>$info_notelp,	
				"info_nofax"=>$info_nofax,	
				"info_email"=>$info_email,	
				"info_website"=>$info_website,	
				"info_slogan"=>$info_slogan,	
				"info_logo"=>$info_logo,	
				"info_icon"=>$info_icon,	
				"info_background"=>$info_background,	
				"info_theme"=>$info_theme	
			);
			$this->db->insert('info', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function info_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the infos at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM info WHERE info_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM info WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "info_id= ".$pkid[$i];
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
		function info_search($info_id ,$info_nama ,$info_alamat ,$info_notelp ,$info_nofax ,$info_email ,$info_website ,$info_slogan ,$info_logo ,$info_icon ,$info_background ,$info_theme ,$start,$end){
			//full query
			$query="select * from info";
			
			if($info_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " info_id LIKE '%".$info_id."%'";
			};
			if($info_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " info_nama LIKE '%".$info_nama."%'";
			};
			if($info_alamat!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " info_alamat LIKE '%".$info_alamat."%'";
			};
			if($info_notelp!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " info_notelp LIKE '%".$info_notelp."%'";
			};
			if($info_nofax!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " info_nofax LIKE '%".$info_nofax."%'";
			};
			if($info_email!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " info_email LIKE '%".$info_email."%'";
			};
			if($info_website!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " info_website LIKE '%".$info_website."%'";
			};
			if($info_slogan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " info_slogan LIKE '%".$info_slogan."%'";
			};
			if($info_logo!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " info_logo LIKE '%".$info_logo."%'";
			};
			if($info_icon!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " info_icon LIKE '%".$info_icon."%'";
			};
			if($info_background!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " info_background LIKE '%".$info_background."%'";
			};
			if($info_theme!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " info_theme LIKE '%".$info_theme."%'";
			};
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
		function info_print($info_id ,$info_nama ,$info_alamat ,$info_notelp ,$info_nofax ,$info_email ,$info_website ,$info_slogan ,$info_logo ,$info_icon ,$info_background ,$info_theme ,$option,$filter){
			//full query
			$query="select * from info";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (info_id LIKE '%".addslashes($filter)."%' OR info_nama LIKE '%".addslashes($filter)."%' OR info_alamat LIKE '%".addslashes($filter)."%' OR info_notelp LIKE '%".addslashes($filter)."%' OR info_nofax LIKE '%".addslashes($filter)."%' OR info_email LIKE '%".addslashes($filter)."%' OR info_website LIKE '%".addslashes($filter)."%' OR info_slogan LIKE '%".addslashes($filter)."%' OR info_logo LIKE '%".addslashes($filter)."%' OR info_icon LIKE '%".addslashes($filter)."%' OR info_background LIKE '%".addslashes($filter)."%' OR info_theme LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($info_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_id LIKE '%".$info_id."%'";
				};
				if($info_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_nama LIKE '%".$info_nama."%'";
				};
				if($info_alamat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_alamat LIKE '%".$info_alamat."%'";
				};
				if($info_notelp!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_notelp LIKE '%".$info_notelp."%'";
				};
				if($info_nofax!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_nofax LIKE '%".$info_nofax."%'";
				};
				if($info_email!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_email LIKE '%".$info_email."%'";
				};
				if($info_website!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_website LIKE '%".$info_website."%'";
				};
				if($info_slogan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_slogan LIKE '%".$info_slogan."%'";
				};
				if($info_logo!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_logo LIKE '%".$info_logo."%'";
				};
				if($info_icon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_icon LIKE '%".$info_icon."%'";
				};
				if($info_background!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_background LIKE '%".$info_background."%'";
				};
				if($info_theme!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_theme LIKE '%".$info_theme."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function info_export_excel($info_id ,$info_nama ,$info_alamat ,$info_notelp ,$info_nofax ,$info_email ,$info_website ,$info_slogan ,$info_logo ,$info_icon ,$info_background ,$info_theme ,$option,$filter){
			//full query
			$query="select * from info";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (info_id LIKE '%".addslashes($filter)."%' OR info_nama LIKE '%".addslashes($filter)."%' OR info_alamat LIKE '%".addslashes($filter)."%' OR info_notelp LIKE '%".addslashes($filter)."%' OR info_nofax LIKE '%".addslashes($filter)."%' OR info_email LIKE '%".addslashes($filter)."%' OR info_website LIKE '%".addslashes($filter)."%' OR info_slogan LIKE '%".addslashes($filter)."%' OR info_logo LIKE '%".addslashes($filter)."%' OR info_icon LIKE '%".addslashes($filter)."%' OR info_background LIKE '%".addslashes($filter)."%' OR info_theme LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($info_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_id LIKE '%".$info_id."%'";
				};
				if($info_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_nama LIKE '%".$info_nama."%'";
				};
				if($info_alamat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_alamat LIKE '%".$info_alamat."%'";
				};
				if($info_notelp!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_notelp LIKE '%".$info_notelp."%'";
				};
				if($info_nofax!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_nofax LIKE '%".$info_nofax."%'";
				};
				if($info_email!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_email LIKE '%".$info_email."%'";
				};
				if($info_website!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_website LIKE '%".$info_website."%'";
				};
				if($info_slogan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_slogan LIKE '%".$info_slogan."%'";
				};
				if($info_logo!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_logo LIKE '%".$info_logo."%'";
				};
				if($info_icon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_icon LIKE '%".$info_icon."%'";
				};
				if($info_background!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_background LIKE '%".$info_background."%'";
				};
				if($info_theme!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " info_theme LIKE '%".$info_theme."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>