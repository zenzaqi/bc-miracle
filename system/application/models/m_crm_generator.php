<? /* 
	+ Module  		: Crm Generator Model
	+ Description	: For record model process back-end
	+ Filename 		: c_crm_generator.php
 	+ creator 		: Fred
	
*/

class M_crm_generator extends Model{
		
		//constructor
		function M_crm_generator() {
			parent::Model();
		}
		
		
	function get_customer_list2($query,$start,$end){
		$sql="SELECT cust_id,cust_no,cust_nama,cust_tgllahir,cust_alamat,cust_telprumah,cust_point FROM customer WHERE cust_aktif='Aktif'";
		if($query<>""){
			$sql=$sql." and (cust_id = '".$query."' or cust_no like '%".$query."%' or cust_alamat like '%".$query."%' or cust_nama like '%".$query."%' or cust_telprumah like '%".$query."%' or cust_telprumah2 like '%".$query."%' or cust_telpkantor like '%".$query."%' or cust_hp like '%".$query."%' or cust_hp2 like '%".$query."%' or cust_hp3 like '%".$query."%') ";
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
		
	function set_cust_point($cust_id){
		$sql = "SELECT cust_point from customer where cust_id='".$cust_id."' and cust_aktif!='Tidak Aktif' order by cust_id desc limit 1";
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
		function crm_generator_list($filter,$start,$end){
		
			$query = "SELECT crmvalue_id, crmvalue_date, c1.cust_nama as crmvalue_cust , crmvalue_frequency, crmvalue_recency, crmvalue_spending, crmvalue_highmargin, crmvalue_referal, crmvalue_kerewelan, crmvalue_disiplin, crmvalue_treatment 
						FROM crm_value
						left join customer c1 on (c1.cust_id = crm_value.crmvalue_cust)";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (crmvalue_id LIKE '%".addslashes($filter)."%' OR crmvalue_date LIKE '%".addslashes($filter)."%' OR crmvalue_cust LIKE '%".addslashes($filter)."%' OR crmvalue_frequency LIKE '%".addslashes($filter)."%' )";
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
		function crm_generator_create($query, $crmvalue_id, $crmvalue_cust, $crmvalue_date, $crmvalue_frequency, $crmvalue_recency, $crmvalue_spending, $crmvalue_highmargin, $crmvalue_referal, $crmvalue_kerewelan, $crmvalue_disiplin, $crmvalue_treatment, $crmvalue_author){
			$datetime_now=date('Y-m-d H:i:s');
			
			$sql_parameter_recency = "select max(setcrm_id) as setcrm_id, setcrm_recency_bulan, setcrm_recency_value_morethan, setcrm_recency_value_equal, setcrm_recency_value_lessthan from crm_setup";
			$query_parameter_recency = $this->db->query($sql_parameter_recency);
			$data_parameter_recency=$query_parameter_recency->row();
			$day_recency=$data_parameter_recency->setcrm_recency_bulan;
			$setcrm_recency_value_lessthan=$data_parameter_recency->setcrm_recency_value_lessthan;
			$setcrm_recency_value_morethan=$data_parameter_recency->setcrm_recency_value_morethan;
	
			$sql_value_recency = "select dapaket_id 
				from detail_ambil_paket d
					where date_add(d.dapaket_tgl_ambil, interval '$day_recency' day) > now() and dapaket_cust = '$crmvalue_cust'";
			$query = $this->db->query($sql_value_recency);
			$recency_row = $query->num_rows();
			
			if($recency_row==0){
				$recency = $setcrm_recency_value_lessthan;
			}
			else if($recency_row>=1){
				$recency = $setcrm_recency_value_morethan;
			}
			
			$data=array(
				"crmvalue_recency" => $recency,
				"crmvalue_cust"=>$crmvalue_cust,	
				"crmvalue_date"=>$crmvalue_date,
				"crmvalue_author"=>$_SESSION[SESSION_USERID]
			);
			$this->db->insert('crm_value',$data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		
		
}
?>