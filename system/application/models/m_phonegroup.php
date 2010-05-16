<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: phonegroup Model
	+ Description	: For record model process back-end
	+ Filename 		: c_phonegroup.php
 	+ Author  		: 
 	+ Created on 01/Feb/2010 14:30:05
	
*/

class M_phonegroup extends Model{
		
		//constructor
		function M_phonegroup() {
			parent::Model();
			$this->sms = $this->load->database('smsd', TRUE);
		}
		
		function sms_save($isms_dest,$isms_isi,$isms_opsi,$isms_task){
			$sql="";
			if($isms_task=='draft'){
				$sql="insert into draft(
						draft_jenis,
						draft_destination,
						draft_message,
						draft_date,
						draft_creator,
						draft_date_create)
					 values(
						'".$isms_opsi."',
						'".$isms_dest."',
						'".$isms_isi."',
						'".date('Y/m/d H:i:s')."',
						'".$_SESSION[SESSION_USERID]."',
						'".date('Y/m/d H:i:s')."')";
				$this->db->query($sql);
				//echo $sql;
			}else{
				if($isms_opsi=="semua"){
					$class=-1;
					$sql="select cust_hp from customer WHERE cust_hp<>'' AND cust_hp is not null";
					$query=$this->db->query($sql);
					foreach($query->result() as $row){
						$sql="insert into outbox(
								UpdatedInDB,
								InsertIntoDB,
								Class,
								DestinationNumber,
								TextDecoded,
								RelativeValidity,
								SenderID,
								DeliveryReport,
								Coding)
							values(
								'".date('Y-m-d H:i:s')."',
								'".date('Y-m-d H:i:s')."',
								'".$class."',
								'".$row->cust_hp."',
								'".$isms_isi."',
								'".$class."',
								'',
								'no',
								'Default_No_Compression')";
						
						$this->sms->query($sql);
						$sql="";
					}
				}elseif($isms_opsi=="number"){
					$dest=split(",",$isms_dest);
					$class=-1;
					foreach($dest as $listdest=>$value){
						//$sql="insert into outbox(UpdatedInDB,InsertIntoDB,Class,DestinationNumber,TextDecoded,SendingDateTime,RelativeValidity ,SenderID,DeliveryReport,Coding) VALUES(now(),now(),'-1','085231460022','hello world yak opo kabare',now(),'-1','','yes','Default_No_Compression')";
						$sql="insert into outbox(
								UpdatedInDB,
								InsertIntoDB,
								Class,
								DestinationNumber,
								TextDecoded,
								RelativeValidity,
								SenderID,
								DeliveryReport,
								Coding)
							values(
								'".date('Y-m-d H:i:s')."',
								'".date('Y-m-d H:i:s')."',
								'".$class."',
								'".$value."',
								'".$isms_isi."',
								'".$class."',
								'',
								'no',
								'Default_No_Compression')";
						$this->sms->query($sql);
						$sql="";
					}
				}elseif($isms_opsi=="group"){
					$sql="select phonegrouped_number from phonegrouped where phonegrouped_group='".$isms_dest."'";
					$query=$this->db->query($sql);
					$class=-1;
					foreach($query->result() as $row){
						$sql_sms="insert into outbox(
								UpdatedInDB,
								InsertIntoDB,
								Class,
								DestinationNumber,
								TextDecoded,
								RelativeValidity,
								SenderID,
								DeliveryReport,
								Coding)
							values(
								'".date('Y-m-d H:i:s')."',
								'".date('Y-m-d H:i:s')."',
								'".$class."',
								'".$row->phonegrouped_number."',
								'".$isms_isi."',
								'".$class."',
								'',
								'no',
								'Default_No_Compression')";
						$this->sms->query($sql_sms);
					}
				}elseif($isms_opsi=='kelamin'){
					$class=-1;
					$sql="select cust_hp from customer where cust_kelamin='".$isms_dest."' AND cust_hp<>'' AND cust_hp is not null";
					$query=$this->db->query($sql);
					foreach($query->result() as $row){
						$sql="insert into outbox(
								UpdatedInDB,
								InsertIntoDB,
								Class,
								DestinationNumber,
								TextDecoded,
								RelativeValidity,
								SenderID,
								DeliveryReport,
								Coding)
							values(
								'".date('Y-m-d H:i:s')."',
								'".date('Y-m-d H:i:s')."',
								'".$class."',
								'".$row->cust_hp."',
								'".$isms_isi."',
								'".$class."',
								'',
								'no',
								'Default_No_Compression')";
						
						$this->sms->query($sql);
						$sql="";
					}
				}elseif($isms_opsi=='ultah'){
					$class=-1;
					$tgl_start=substr($isms_dest,1,5);
					$tgl_end=substr($isms_dest,8,5);
					
					$sql="select cust_hp from customer where date_format(cust_tgllahir,'%m-%d') >= '".$tgl_start."' AND 
															 date_format(cust_tgllahir,'%m-%d') <= '".$tgl_end."' AND
															 cust_hp<>'' AND cust_hp is not null" ;
					$query=$this->db->query($sql);
					foreach($query->result() as $row){
						$sql="insert into outbox(
								UpdatedInDB,
								InsertIntoDB,
								Class,
								DestinationNumber,
								TextDecoded,
								RelativeValidity,
								SenderID,
								DeliveryReport,
								Coding)
							values(
								'".date('Y-m-d H:i:s')."',
								'".date('Y-m-d H:i:s')."',
								'".$class."',
								'".$row->cust_hp."',
								'".$isms_isi."',
								'".$class."',
								'',
								'no',
								'Default_No_Compression')";
						
						$this->sms->query($sql);
						$sql="";
					}
				}elseif($isms_opsi=='member'){
					$sms_opsi=split(":",$isms_dest);
					$membership=$sms_opsi[0];
					$expired=$sms_opsi[1];
					if($expired!=="")
					{
						$tgl_start=substr($expired,1,10);
						$tgl_end=substr($expired,13,10);
					}
					$sql="select cust_hp from vu_member_cust WHERE cust_hp<>'' AND cust_hp is not null";
					if($membership=="Expired"){
						$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
						$sql .=" date_format(member_valid,'%Y-%m-%d') >='".$tgl_start."' AND 
								 date_format(member_valid,'%Y-%m-%d') <='".$tgl_end."'";
					}else if($membership!=="Semua"){
						$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
						$sql .=" member_status='".$membership."'";
					}
					
					$class=-1;
					
					$query=$this->db->query($sql);
					foreach($query->result() as $row){
						$sql="insert into outbox(
								UpdatedInDB,
								InsertIntoDB,
								Class,
								DestinationNumber,
								TextDecoded,
								RelativeValidity,
								SenderID,
								DeliveryReport,
								Coding)
							values(
								'".date('Y-m-d H:i:s')."',
								'".date('Y-m-d H:i:s')."',
								'".$class."',
								'".$row->cust_hp."',
								'".$isms_isi."',
								'".$class."',
								'',
								'no',
								'Default_No_Compression')";
						
						$this->sms->query($sql);
						$sql="";
					}
					
				}
			}
			
			return '1';
		}
		
		function get_available($query,$start,$end){
			$sql="select concat(cust_nama,' (',cust_no,')') as cust_nama, cust_no,cust_hp from customer where cust_hp not in(select phonegrouped_number from phonegrouped) and cust_hp<>''";
			if($query!==""){
				$sql.=" and cust_nama like '%".$query."%' or cust_hp like '%".$query."%'";
			}
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			$limit = $sql." LIMIT ".$start.",".$end;		
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
		
		function get_phonegrouped($id,$query,$start,$end){
			$sql="select concat(cust_nama,' (',cust_no,')') as cust_nama, cust_no,cust_hp from customer where cust_hp in(select phonegrouped_number from phonegrouped where phonegrouped_group='".$id."')";
			if($query!==""){
				$sql.=" and cust_nama like '%".$query."%' or cust_hp like '%".$query."%'";
			}
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			$limit = $sql." LIMIT ".$start.",".$end;		
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
		
		//function for get list record
		function get_phonegroup_list($filter,$start,$end){
			$query = "SELECT * FROM vu_phonegroup";
			
			// For simple search
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (phonegroup_nama LIKE '%".addslashes($filter)."%' OR phonegroup_jumlah)";
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
		
		//function for get list record
		function phonegroup_list($filter,$start,$end){
			$query = "SELECT * FROM phonegroup";
			
			// For simple search
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (phonegroup_id LIKE '%".addslashes($filter)."%' OR phonegroup_nama LIKE '%".addslashes($filter)."%' OR phonegroup_detail LIKE '%".addslashes($filter)."%' OR phonegroup_creator LIKE '%".addslashes($filter)."%' OR phonegroup_date_create LIKE '%".addslashes($filter)."%' OR phonegroup_update LIKE '%".addslashes($filter)."%' OR phonegroup_date_update LIKE '%".addslashes($filter)."%' OR phonegroup_revised LIKE '%".addslashes($filter)."%' )";
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
		function phonegroup_create($phonegroup_nama ,$phonegroup_detail ,$phonegroup_creator ,$phonegroup_date_create, $phonegroup_data ){
			$data = array(
				"phonegroup_nama"=>$phonegroup_nama, 
				"phonegroup_detail"=>$phonegroup_detail, 
				"phonegroup_creator"=>$phonegroup_creator, 
				"phonegroup_date_create"=>$phonegroup_date_create 
			);
			$this->db->insert('phonegroup', $data); 
			if($this->db->affected_rows()){
				if($phonegroup_data!=""){
					$phonegrouped_group=$this->db->insert_id();
					$phonegrouped_number=split(",",$phonegroup_data);
					if(count($phonegrouped_number)>0){
						$sql="delete from phonegrouped where phonegrouped_group='".$phonegrouped_group."'";
						$this->db->query($sql);
						foreach($phonegrouped_number as $pnumber=>$value){
							$sql="insert into phonegrouped(phonegrouped_group,phonegrouped_number)
									values('".$phonegrouped_group."','".$value."')";
							$this->db->query($sql);
							$sql="";
						}
					}
				}
				return '1';
			}else
				return '0';
		}
		
		//function for update record
		function phonegroup_update($phonegroup_id,$phonegroup_nama,$phonegroup_detail,$phonegroup_update,$phonegroup_date_update,$phonegroup_data){
			$data = array(
				"phonegroup_nama"=>$phonegroup_nama, 
				"phonegroup_detail"=>$phonegroup_detail, 
				"phonegroup_update"=>$phonegroup_update, 
				"phonegroup_date_update"=>$phonegroup_date_update 
			);
			$phonegrouped_group=$phonegroup_id;
			$this->db->where('phonegroup_id', $phonegroup_id);
			$this->db->update('phonegroup', $data);
			$sql="UPDATE phonegroup set phonegroup_revised=(phonegroup_revised+1) where phonegroup_id='".$phonegroup_id."'";
			$this->db->query($sql);
			$sql="delete from phonegrouped where phonegrouped_group='".$phonegrouped_group."'";
			$this->db->query($sql);
				
			if($phonegroup_data!=""){
				$phonegrouped_number=split(",",$phonegroup_data);
				if(count($phonegrouped_number)>0){
					foreach($phonegrouped_number as $pnumber=>$value){
						$sql="insert into phonegrouped(phonegrouped_group,phonegrouped_number)
								values('".$phonegrouped_group."','".$value."')";
						$this->db->query($sql);
						$sql="";
					}
				}
			}
			return '1';
		}
		
		//fcuntion for delete record
		function phonegroup_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the phonegroups at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM phonegroup WHERE phonegroup_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM phonegroup WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "phonegroup_id= ".$pkid[$i];
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
		function phonegroup_search($phonegroup_id ,$phonegroup_nama ,$phonegroup_detail ,$phonegroup_creator ,$phonegroup_date_create ,$phonegroup_update ,$phonegroup_date_update ,$phonegroup_revised ,$start,$end){
			//full query
			$query="select * from phonegroup";
			
			if($phonegroup_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " phonegroup_id LIKE '%".$phonegroup_id."%'";
			};
			if($phonegroup_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " phonegroup_nama LIKE '%".$phonegroup_nama."%'";
			};
			if($phonegroup_detail!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " phonegroup_detail LIKE '%".$phonegroup_detail."%'";
			};
			if($phonegroup_creator!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " phonegroup_creator LIKE '%".$phonegroup_creator."%'";
			};
			if($phonegroup_date_create!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " phonegroup_date_create LIKE '%".$phonegroup_date_create."%'";
			};
			if($phonegroup_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " phonegroup_update LIKE '%".$phonegroup_update."%'";
			};
			if($phonegroup_date_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " phonegroup_date_update LIKE '%".$phonegroup_date_update."%'";
			};
			if($phonegroup_revised!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " phonegroup_revised LIKE '%".$phonegroup_revised."%'";
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
		function phonegroup_print($phonegroup_id ,$phonegroup_nama ,$phonegroup_detail ,$phonegroup_creator ,$phonegroup_date_create ,$phonegroup_update ,$phonegroup_date_update ,$phonegroup_revised ,$option,$filter){
			//full query
			$sql="select * from phonegroup";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (phonegroup_id LIKE '%".addslashes($filter)."%' OR phonegroup_nama LIKE '%".addslashes($filter)."%' OR phonegroup_detail LIKE '%".addslashes($filter)."%' OR phonegroup_creator LIKE '%".addslashes($filter)."%' OR phonegroup_date_create LIKE '%".addslashes($filter)."%' OR phonegroup_update LIKE '%".addslashes($filter)."%' OR phonegroup_date_update LIKE '%".addslashes($filter)."%' OR phonegroup_revised LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($phonegroup_id!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " phonegroup_id LIKE '%".$phonegroup_id."%'";
				};
				if($phonegroup_nama!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " phonegroup_nama LIKE '%".$phonegroup_nama."%'";
				};
				if($phonegroup_detail!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " phonegroup_detail LIKE '%".$phonegroup_detail."%'";
				};
				if($phonegroup_creator!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " phonegroup_creator LIKE '%".$phonegroup_creator."%'";
				};
				if($phonegroup_date_create!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " phonegroup_date_create LIKE '%".$phonegroup_date_create."%'";
				};
				if($phonegroup_update!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " phonegroup_update LIKE '%".$phonegroup_update."%'";
				};
				if($phonegroup_date_update!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " phonegroup_date_update LIKE '%".$phonegroup_date_update."%'";
				};
				if($phonegroup_revised!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " phonegroup_revised LIKE '%".$phonegroup_revised."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query->result();
		}
		
		//function  for export to excel
		function phonegroup_export_excel($phonegroup_id ,$phonegroup_nama ,$phonegroup_detail ,$phonegroup_creator ,$phonegroup_date_create ,$phonegroup_update ,$phonegroup_date_update ,$phonegroup_revised ,$option,$filter){
			//full query
			$sql="select * from phonegroup";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (phonegroup_id LIKE '%".addslashes($filter)."%' OR phonegroup_nama LIKE '%".addslashes($filter)."%' OR phonegroup_detail LIKE '%".addslashes($filter)."%' OR phonegroup_creator LIKE '%".addslashes($filter)."%' OR phonegroup_date_create LIKE '%".addslashes($filter)."%' OR phonegroup_update LIKE '%".addslashes($filter)."%' OR phonegroup_date_update LIKE '%".addslashes($filter)."%' OR phonegroup_revised LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($phonegroup_id!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " phonegroup_id LIKE '%".$phonegroup_id."%'";
				};
				if($phonegroup_nama!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " phonegroup_nama LIKE '%".$phonegroup_nama."%'";
				};
				if($phonegroup_detail!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " phonegroup_detail LIKE '%".$phonegroup_detail."%'";
				};
				if($phonegroup_creator!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " phonegroup_creator LIKE '%".$phonegroup_creator."%'";
				};
				if($phonegroup_date_create!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " phonegroup_date_create LIKE '%".$phonegroup_date_create."%'";
				};
				if($phonegroup_update!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " phonegroup_update LIKE '%".$phonegroup_update."%'";
				};
				if($phonegroup_date_update!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " phonegroup_date_update LIKE '%".$phonegroup_date_update."%'";
				};
				if($phonegroup_revised!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " phonegroup_revised LIKE '%".$phonegroup_revised."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query;
		}
		
}
?>