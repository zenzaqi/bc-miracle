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
		
	
		//function for get list record
		function crm_generator_list($filter,$start,$end){
		
			$query = 
			   "SELECT 
					crmvalue_id, crmvalue_date, c1.cust_nama as crmvalue_cust, c1.cust_no as crmvalue_cust_no ,crmvalue_frequency, crmvalue_recency, 
					crmvalue_spending, crmvalue_highmargin, crmvalue_referal, crmvalue_kerewelan, crmvalue_disiplin, crmvalue_treatment,
					(crmvalue_frequency + crmvalue_recency + crmvalue_spending + crmvalue_highmargin + crmvalue_referal + crmvalue_kerewelan +
					crmvalue_disiplin + crmvalue_treatment) as crmvalue_total,
					crmvalue_priority
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
		
		
		//function for generate value CRM
		function crm_generator_create($query, $crmvalue_id, $crmvalue_cust, $crmvalue_date, $crmvalue_frequency, $crmvalue_recency, $crmvalue_spending, $crmvalue_highmargin, $crmvalue_referal, $crmvalue_kerewelan, $crmvalue_disiplin, $crmvalue_treatment, $crmvalue_author){
			$datetime_now=date('Y-m-d H:i:s');
			
			//untuk mendapatkan parameter di crm_setup
			$sql_parameter = 
			   "select max(setcrm_id) as setcrm_id, 
					c.setcrm_recency_days, c.setcrm_recency_value_morethan, c.setcrm_recency_value_lessthan, 
					c.setcrm_referal_person, c.setcrm_referal_days, c.setcrm_referal_morethan, c.setcrm_referal_equal, c.setcrm_referal_lessthan
				from crm_setup c";
			
			$query_parameter				= $this->db->query($sql_parameter);
			$data_parameter 				= $query_parameter->row();
			
			$setcrm_recency_days 			= $data_parameter->setcrm_recency_days;
			$setcrm_recency_value_lessthan 	= $data_parameter->setcrm_recency_value_lessthan;
			$setcrm_recency_value_morethan 	= $data_parameter->setcrm_recency_value_morethan;
			
			$setcrm_referal_person			= $data_parameter->setcrm_referal_person;
			$setcrm_referal_days			= $data_parameter->setcrm_referal_days;
			$setcrm_referal_morethan		= $data_parameter->setcrm_referal_morethan;
			$setcrm_referal_equal			= $data_parameter->setcrm_referal_equal;
			$setcrm_referal_lessthan		= $data_parameter->setcrm_referal_lessthan;
			
	
			//untuk menghitung Recency
			
			$sql_value_recency = 
			   "select dapaket_id as id
				from detail_ambil_paket d
				where date_add(d.dapaket_tgl_ambil, interval '$setcrm_recency_days' day) >= now() and dapaket_cust = '$crmvalue_cust'
				
				union
				
				select d2.drawat_id as id
				from detail_jual_rawat d2
				left join master_jual_rawat m2 on m2.jrawat_id = d2.drawat_master
				where date_add(m2.jrawat_tanggal, interval '$setcrm_recency_days' day) >= now() and m2.jrawat_cust = '$crmvalue_cust'

				union
				
				select d3.dproduk_id as id
				from detail_jual_produk d3
				left join master_jual_produk m3 on m3.jproduk_id = d3.dproduk_master
				where date_add(m3.jproduk_tanggal, interval '$setcrm_recency_days' day) >= now() and m3.jproduk_cust = '$crmvalue_cust'
				";
			$query_recency	= $this->db->query($sql_value_recency);
			$recency_row 	= $query_recency->num_rows();
			
			if($recency_row==0){
				$crmvalue_recency = $setcrm_recency_value_lessthan;
			}
			else if($recency_row>=1){
				$crmvalue_recency = $setcrm_recency_value_morethan;
			}
			
			
			//untuk menghitung referal rate
			
			$sql_value_referal = 
			   "select count(c.cust_id) as jum_referal
			    from customer c
				where date_add(c.cust_terdaftar, interval $setcrm_referal_days day) >= now() and c.cust_referensi = '$crmvalue_cust'
				";
			$query_referal	= $this->db->query($sql_value_referal);
			$data_referal	= $query_referal->row();
			$jum_referal	= $data_referal->jum_referal;
			
			
			if ($jum_referal > $setcrm_referal_person) {
				$crmvalue_referal = $setcrm_referal_morethan;
			}
			else if ($jum_referal == $setcrm_referal_person) {
				$crmvalue_referal = $setcrm_referal_equal;
			}
			else if ($jum_referal < $setcrm_referal_person) {
				$crmvalue_referal = $setcrm_referal_lessthan;
			}
			
				
			$data=array(
				"crmvalue_recency"	=> $crmvalue_recency,
				"crmvalue_referal"	=> $crmvalue_referal,
				"crmvalue_cust"		=> $crmvalue_cust,	
				"crmvalue_date"		=> $crmvalue_date,
				"crmvalue_author"	=> $_SESSION[SESSION_USERID]
			);
			$this->db->insert('crm_value',$data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		
		
}
?>