<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: member Model
	+ Description	: For record model process back-end
	+ Filename 		: c_member.php
 	+ Author  		: 
 	+ Created on 01/Sep/2009 10:36:44
	
*/

class M_member extends Model{
		
		//constructor
		function M_member() {
			parent::Model();
		}
		
		function member_cetak(){
			
			//$query = "UPDATE member set member_status='print' where member_status='register'";
			$query = "UPDATE member set member_status='Cetak', member_tglserahterima=NULL where member_status='Daftar'";
			$this->db->query($query);
			//$query = "SELECT member.*,cust_nama as member_nama FROM member,customer where member_cust=cust_id and member_status='print'";
			$query = "SELECT member.*,cust_nama as member_nama FROM member,customer where member_cust=cust_id and member_status='Cetak'";
			$row=$this->db->query($query);
			return $row->result();
		}
		
		function member_aktivasi(){
			$date_now=date('Y-m-d');
			//$query = "UPDATE member set member_status='aktif' where member_status='print'";
			$query = "UPDATE member set member_status='Serah Terima', member_tglserahterima='$date_now' where member_status='Cetak'";
			$this->db->query($query);
			return '1';
		}
		
		//function for get list record
		function member_list($filter,$start,$end){
			$query =   "SELECT 
							member.*,
							cust_nama, cust_no 
						FROM member, customer 
						where member_cust=cust_id and member_status <> 'Serah Terima'";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (cust_nama LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%' OR member_no LIKE '%".addslashes($filter)."%' OR member_register LIKE '%".addslashes($filter)."%' OR member_valid LIKE '%".addslashes($filter)."%' OR member_nota_ref LIKE '%".addslashes($filter)."%' OR member_point LIKE '%".addslashes($filter)."%' OR member_jenis LIKE '%".addslashes($filter)."%' OR member_status LIKE '%".addslashes($filter)."%' OR member_tglserahterima LIKE '%".addslashes($filter)."%' )";
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
		function member_update($member_id ,$member_cust ,$member_no ,$member_register ,$member_valid ,$member_nota_ref ,$member_point ,$member_jenis ,$member_status ){
			$date_now=date('Y-m-d');
			$data = array(
				"member_id"=>$member_id, 
			//	"member_cust"=>$member_cust, 
				"member_no"=>$member_no, 
				"member_register"=>$member_register, 
				"member_valid"=>$member_valid, 
				"member_nota_ref"=>$member_nota_ref, 
				"member_point"=>$member_point, 
				"member_jenis"=>$member_jenis, 
				"member_status"=>$member_status//, 
				//"member_tglserahterima"=>$member_tglserahterima 
			);
			
			if($member_status=='Serah Terima'){
				$data['member_tglserahterima']=$date_now;
			}else{
				$data['member_tglserahterima']=NULL;
			}
			
			$this->db->where('member_id', $member_id);
			$this->db->update('member', $data);
			
			return '1';
		}
		
		//function for create new record
		function member_create($member_cust ,$member_no ,$member_register ,$member_valid ,$member_nota_ref ,$member_point ,$member_jenis ,$member_status ,$member_tglserahterima ){
			$data = array(
				"member_cust"=>$member_cust, 
				"member_no"=>$member_no, 
				"member_register"=>$member_register, 
				"member_valid"=>$member_valid, 
				"member_nota_ref"=>$member_nota_ref, 
				"member_point"=>$member_point, 
				"member_jenis"=>$member_jenis, 
				"member_status"=>$member_status, 
				"member_tglserahterima"=>$member_tglserahterima 
			);
			$this->db->insert('member', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//Adding Member Tanpa-Transaksi
		function member_add($member_cust ){
			$date_now=date('Y-m-d');
			
			$sql="SELECT setmember_transhari, setmember_periodeaktif, setmember_periodetenggang, setmember_transtenggang FROM member_setup LIMIT 1";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$min_trans_member_baru=$rs_record['setmember_transhari'];
				$periode_tenggang=$rs_record['setmember_periodetenggang'];
				$min_trans_tenggang=$rs_record['setmember_transtenggang'];
				$periode_aktif=$rs_record['setmember_periodeaktif'];
			}
			
			$sql = "SELECT cust_no FROM customer WHERE cust_id='$member_cust'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$pattern=date("ymd").substr($rs_record['cust_no'],2);
				$member_no=$this->m_public_function->get_nomor_member('member','member_no',$pattern,16);
			}
			
			$member_valid = date('Y-m-d', strtotime("$date_now +$periode_aktif days"));
			$data = array(
				"member_cust"=>$member_cust, 
				"member_no"=>$member_no, 
				"member_register"=>$date_now, 
				"member_valid"=>$member_valid, 
				"member_jenis"=>'baru', 
				"member_status"=>'Daftar', 
				"member_tglserahterima"=>NULL,
				"member_creator"=>@$_SESSION[SESSION_USERID]
			);
			$this->db->insert('member', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function member_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the members at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM member WHERE member_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM member WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "member_id= ".$pkid[$i];
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
		function member_search($member_id ,$member_cust ,$member_no ,$member_register ,$member_valid ,$member_nota_ref ,$member_point ,$member_jenis ,$member_status ,$member_tglserahterima ,$start,$end){
			//full query
			$query="select * from member";
			
			if($member_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " member_id LIKE '%".$member_id."%'";
			};
			if($member_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " member_cust LIKE '%".$member_cust."%'";
			};
			if($member_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " member_no LIKE '%".$member_no."%'";
			};
			if($member_register!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " member_register LIKE '%".$member_register."%'";
			};
			if($member_valid!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " member_valid LIKE '%".$member_valid."%'";
			};
			if($member_nota_ref!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " member_nota_ref LIKE '%".$member_nota_ref."%'";
			};
			if($member_point!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " member_point LIKE '%".$member_point."%'";
			};
			if($member_jenis!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " member_jenis LIKE '%".$member_jenis."%'";
			};
			if($member_status!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " member_status LIKE '%".$member_status."%'";
			};
			if($member_tglserahterima!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " member_tglserahterima LIKE '%".$member_tglserahterima."%'";
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
		function member_print($member_id ,$member_cust ,$member_no ,$member_register ,$member_valid ,$member_nota_ref ,$member_point ,$member_jenis ,$member_status ,$member_tglserahterima ,$option,$filter){
			//full query
			$query="select * from member";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (member_id LIKE '%".addslashes($filter)."%' OR member_cust LIKE '%".addslashes($filter)."%' OR member_no LIKE '%".addslashes($filter)."%' OR member_register LIKE '%".addslashes($filter)."%' OR member_valid LIKE '%".addslashes($filter)."%' OR member_nota_ref LIKE '%".addslashes($filter)."%' OR member_point LIKE '%".addslashes($filter)."%' OR member_jenis LIKE '%".addslashes($filter)."%' OR member_status LIKE '%".addslashes($filter)."%' OR member_tglserahterima LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($member_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_id LIKE '%".$member_id."%'";
				};
				if($member_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_cust LIKE '%".$member_cust."%'";
				};
				if($member_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_no LIKE '%".$member_no."%'";
				};
				if($member_register!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_register LIKE '%".$member_register."%'";
				};
				if($member_valid!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_valid LIKE '%".$member_valid."%'";
				};
				if($member_nota_ref!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_nota_ref LIKE '%".$member_nota_ref."%'";
				};
				if($member_point!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_point LIKE '%".$member_point."%'";
				};
				if($member_jenis!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_jenis LIKE '%".$member_jenis."%'";
				};
				if($member_status!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_status LIKE '%".$member_status."%'";
				};
				if($member_tglserahterima!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_tglserahterima LIKE '%".$member_tglserahterima."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function member_export_excel($member_id ,$member_cust ,$member_no ,$member_register ,$member_valid ,$member_nota_ref ,$member_point ,$member_jenis ,$member_status ,$member_tglserahterima ,$option,$filter){
			//full query
			$query="select * from member";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (member_id LIKE '%".addslashes($filter)."%' OR member_cust LIKE '%".addslashes($filter)."%' OR member_no LIKE '%".addslashes($filter)."%' OR member_register LIKE '%".addslashes($filter)."%' OR member_valid LIKE '%".addslashes($filter)."%' OR member_nota_ref LIKE '%".addslashes($filter)."%' OR member_point LIKE '%".addslashes($filter)."%' OR member_jenis LIKE '%".addslashes($filter)."%' OR member_status LIKE '%".addslashes($filter)."%' OR member_tglserahterima LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($member_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_id LIKE '%".$member_id."%'";
				};
				if($member_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_cust LIKE '%".$member_cust."%'";
				};
				if($member_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_no LIKE '%".$member_no."%'";
				};
				if($member_register!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_register LIKE '%".$member_register."%'";
				};
				if($member_valid!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_valid LIKE '%".$member_valid."%'";
				};
				if($member_nota_ref!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_nota_ref LIKE '%".$member_nota_ref."%'";
				};
				if($member_point!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_point LIKE '%".$member_point."%'";
				};
				if($member_jenis!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_jenis LIKE '%".$member_jenis."%'";
				};
				if($member_status!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_status LIKE '%".$member_status."%'";
				};
				if($member_tglserahterima!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " member_tglserahterima LIKE '%".$member_tglserahterima."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>