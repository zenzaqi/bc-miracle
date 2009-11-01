<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: appointment Model
	+ Description	: For record model process back-end
	+ Filename 		: c_appointment.php
 	+ Author  		: masongbee
 	+ Created on 27/Oct/2009 12:41:17
	
*/

class M_appointment_nonmedis extends Model{
		
		//constructor
		function M_appointment_nonmedis() {
			parent::Model();
		}
		
		function get_kategori_string(){
			return "Non Medis";
		}
		
		function get_kategori_id(){
			return 3;
		}
		
		//function for detail
		//get record list
		function detail_appointment_detail_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM appointment_detail,perawatan WHERE dapp_perawatan=rawat_id AND rawat_kategori='".$this->get_kategori_id()."' AND dapp_master='".$master_id."'";
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
		//end of function
		
		//get master id, note : not done yet
		function get_master_id() {
			$query = "SELECT max(app_id) as master_id from appointment";
			$result = $this->db->query($query);
			if($result->num_rows()){
				$data=$result->row();
				$master_id=$data->master_id;
				return $master_id;
			}else{
				return '0';
			}
		}
		//eof
		
		//purge all detail from master
		function detail_appointment_detail_purge($master_id){
			$sql="DELETE from appointment_detail where dapp_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_appointment_detail_insert($dapp_id ,$dapp_master ,$dapp_perawatan ,$dapp_tglreservasi ,$dapp_jamreservasi ,$dapp_petugas ,$dapp_petugas2 ,$dapp_status ,$dapp_tgldatang ,$dapp_jamdatang ){
			//if master id not capture from view then capture it from max pk from master table
			if($dapp_master=="" || $dapp_master==NULL){
				$dapp_master=$this->get_master_id();
			}
			
			if($dapp_status=="datang"){
				$dapp_tgldatang=date('Y-m-d');
				$dapp_jamdatang=date('H:i:s');
			}
			
			$data = array(
				"dapp_master"=>$dapp_master, 
				"dapp_perawatan"=>$dapp_perawatan, 
				"dapp_tglreservasi"=>$dapp_tglreservasi, 
				"dapp_jamreservasi"=>$dapp_jamreservasi, 
				"dapp_petugas"=>$dapp_petugas, 
				"dapp_petugas2"=>$dapp_petugas2, 
				"dapp_status"=>$dapp_status, 
				"dapp_tgldatang"=>$dapp_tgldatang, 
				"dapp_jamdatang"=>$dapp_jamdatang 
			);
			$this->db->insert('appointment_detail', $data); 
			
			if($dapp_status=="datang"){
				//ambil customer dr appointment u/ di-insert-kan ke tabel "tindakan"
				$sql="SELECT * FROM appointment,appointment_detail WHERE app_id=dapp_master AND dapp_master='$dapp_master'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$rs_record=$rs->row_array();
					$tindakanrawat_cust=$rs_record["app_customer"];
					$tindakanrawat_ket=$rs_record["app_keterangan"];
				}
					
				$sql="SELECT * FROM tindakan WHERE trawat_cust='$tindakanrawat_cust' AND trawat_date_create='$dapp_tgldatang'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$rs_record=$rs->row_array();
					$data_dtindak=array(
						"dtrawat_master"=>$rs_record["trawat_id"],
						"dtrawat_perawatan"=>$dapp_perawatan,
						"dtrawat_petugas1"=>$dapp_petugas,
						"dtrawat_petugas2"=>$dapp_petugas2,
						"dtrawat_jamreservasi"=>$dapp_jamreservasi,
						"dtrawat_kategori"=>$this->get_kategori_string(),
						"dtrawat_status"=>$dapp_status
					);
					$this->db->insert('tindakan_detail', $data_dtindak);
				}else{
					//insert tindakkan
					$data_tindak=array(
						"trawat_cust"=>$tindakanrawat_cust,
						"trawat_keterangan"=>$tindakanrawat_ket,
						"trawat_date_create"=>$dapp_tgldatang
					);
					$this->db->insert('tindakan', $data_tindak);
					
					//jika insert ke tabel tindakan selesai dilakukan
					if($this->db->affected_rows()){
						$sql="SELECT * FROM tindakan WHERE trawat_cust='$tindakanrawat_cust' AND trawat_date_create='$dapp_tgldatang'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$rs_record=$rs->row_array();
							$trawat_id=$rs_record["trawat_id"];
						}
						
						$data_dtindak=array(
							"dtrawat_master"=>$trawat_id,
							"dtrawat_perawatan"=>$dapp_perawatan,
							"dtrawat_petugas1"=>$dapp_petugas,
							"dtrawat_petugas2"=>$dapp_petugas2,
							"dtrawat_jamreservasi"=>$dapp_jamreservasi,
							"dtrawat_kategori"=>$this->get_kategori_string(),
							"dtrawat_status"=>$dapp_status
						);
						$this->db->insert('tindakan_detail', $data_dtindak);
					}
				}
			}
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		//end of function
		
		//function for get list record
		function appointment_list($filter,$start,$end){
			$query = "SELECT * FROM appointment,customer WHERE app_customer=cust_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (app_id LIKE '%".addslashes($filter)."%' OR app_customer LIKE '%".addslashes($filter)."%' OR app_tanggal LIKE '%".addslashes($filter)."%' OR app_cara LIKE '%".addslashes($filter)."%' OR app_keterangan LIKE '%".addslashes($filter)."%' )";
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
		function appointment_update($app_id ,$app_customer ,$app_tanggal ,$app_cara ,$app_keterangan ){
			$data = array(
				"app_id"=>$app_id, 
				"app_customer"=>$app_customer, 
				"app_tanggal"=>$app_tanggal, 
				"app_cara"=>$app_cara, 
				"app_keterangan"=>$app_keterangan 
			);
			$this->db->where('app_id', $app_id);
			$this->db->update('appointment', $data);
			
			return '1';
		}
		
		//function for create new record
		function appointment_create($app_customer ,$app_tanggal ,$app_cara ,$app_keterangan ){
			$data = array(
				"app_customer"=>$app_customer, 
				"app_tanggal"=>$app_tanggal, 
				"app_cara"=>$app_cara, 
				"app_keterangan"=>$app_keterangan 
			);
			$this->db->insert('appointment', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function appointment_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the appointments at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM appointment WHERE app_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM appointment WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "app_id= ".$pkid[$i];
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
		function appointment_search($app_id ,$app_customer ,$app_tanggal ,$app_cara ,$app_keterangan ,$start,$end){
			//full query
			$query="SELECT * FROM appointment,customer WHERE app_customer=cust_id";
			
			if($app_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_id LIKE '%".$app_id."%'";
			};
			if($app_customer!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_customer LIKE '%".$app_customer."%'";
			};
			if($app_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_tanggal LIKE '%".$app_tanggal."%'";
			};
			if($app_cara!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_cara LIKE '%".$app_cara."%'";
			};
			if($app_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_keterangan LIKE '%".$app_keterangan."%'";
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
		function appointment_print($app_id ,$app_customer ,$app_tanggal ,$app_cara ,$app_keterangan ,$option,$filter){
			//full query
			$query="select * from appointment";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (app_id LIKE '%".addslashes($filter)."%' OR app_customer LIKE '%".addslashes($filter)."%' OR app_tanggal LIKE '%".addslashes($filter)."%' OR app_cara LIKE '%".addslashes($filter)."%' OR app_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($app_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_id LIKE '%".$app_id."%'";
				};
				if($app_customer!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_customer LIKE '%".$app_customer."%'";
				};
				if($app_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_tanggal LIKE '%".$app_tanggal."%'";
				};
				if($app_cara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_cara LIKE '%".$app_cara."%'";
				};
				if($app_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_keterangan LIKE '%".$app_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function appointment_export_excel($app_id ,$app_customer ,$app_tanggal ,$app_cara ,$app_keterangan ,$option,$filter){
			//full query
			$query="select * from appointment";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (app_id LIKE '%".addslashes($filter)."%' OR app_customer LIKE '%".addslashes($filter)."%' OR app_tanggal LIKE '%".addslashes($filter)."%' OR app_cara LIKE '%".addslashes($filter)."%' OR app_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($app_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_id LIKE '%".$app_id."%'";
				};
				if($app_customer!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_customer LIKE '%".$app_customer."%'";
				};
				if($app_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_tanggal LIKE '%".$app_tanggal."%'";
				};
				if($app_cara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_cara LIKE '%".$app_cara."%'";
				};
				if($app_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " app_keterangan LIKE '%".$app_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>