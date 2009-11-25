<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: appointment Model
	+ Description	: For record model process back-end
	+ Filename 		: c_appointment.php
 	+ Author  		: masongbee
 	+ Created on 29/Oct/2009 13:33:53
	
*/

class M_appointment extends Model{
		
		//constructor
		function M_appointment() {
			parent::Model();
		}
		
		//function for detail
		//get record list detail medis
		function detail_appointment_detail_medis_list($master_id,$query,$start,$end) {
			//$query = "SELECT * FROM appointment_detail WHERE dapp_master='".$master_id."'";
			$query="SELECT * FROM appointment_detail INNER JOIN perawatan ON dapp_perawatan=rawat_id INNER JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_id='2' AND dapp_master='$master_id'";
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
		//get record list detail nonmedis
		function detail_appointment_detail_nonmedis_list($master_id,$query,$start,$end) {
			//$query = "SELECT * FROM appointment_detail WHERE dapp_master='".$master_id."'";
			$query="SELECT * FROM appointment_detail INNER JOIN perawatan ON dapp_perawatan=rawat_id INNER JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_id='3' AND dapp_master='$master_id'";
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
			$sql="DELETE FROM appointment_detail WHERE dapp_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_appointment_detail_medis_insert($dapp_medis_id ,$dapp_medis_master ,$dapp_medis_perawatan ,$dapp_medis_tglreservasi ,$dapp_medis_jamreservasi ,$dapp_medis_petugas ,$dapp_medis_status ,$dapp_medis_tgldatang ,$dapp_medis_jamdatang ,$dapp_medis_keterangan){
			//if master id not capture from view then capture it from max pk from master table
			if($dapp_medis_master=="" || $dapp_medis_master==NULL){
				$dapp_medis_master=$this->get_master_id();
			}
			if($dapp_medis_status=="datang"){
				$dapp_medis_tgldatang=date('Y-m-d');
				$dapp_medis_jamdatang=date('H:i:s');
			}
			$this->firephp->log($dapp_medis_keterangan, "Medis-Keternagan");
			
			$data = array(
				"dapp_master"=>$dapp_medis_master, 
				"dapp_perawatan"=>$dapp_medis_perawatan, 
				"dapp_tglreservasi"=>$dapp_medis_tglreservasi, 
				"dapp_jamreservasi"=>$dapp_medis_jamreservasi, 
				"dapp_petugas"=>$dapp_medis_petugas, 
//				"dapp_petugas2"=>$dapp_medis_petugas2, 
				"dapp_status"=>$dapp_medis_status, 
				"dapp_tgldatang"=>$dapp_medis_tgldatang, 
				"dapp_jamdatang"=>$dapp_medis_jamdatang,
				"dapp_keterangan"=>$dapp_medis_keterangan
			);
			$this->db->insert('appointment_detail', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		
		function detail_appointment_detail_nonmedis_insert($dapp_nonmedis_id ,$dapp_nonmedis_master ,$dapp_nonmedis_perawatan ,$dapp_nonmedis_tglreservasi ,$dapp_nonmedis_jamreservasi ,$dapp_nonmedis_petugas2 ,$dapp_nonmedis_status ,$dapp_nonmedis_tgldatang ,$dapp_nonmedis_jamdatang ,$dapp_nonmedis_keterangan){
			//if master id not capture from view then capture it from max pk from master table
			if($dapp_nonmedis_master=="" || $dapp_nonmedis_master==NULL){
				$dapp_nonmedis_master=$this->get_master_id();
			}
			
			$data = array(
				"dapp_master"=>$dapp_nonmedis_master, 
				"dapp_perawatan"=>$dapp_nonmedis_perawatan, 
				"dapp_tglreservasi"=>$dapp_nonmedis_tglreservasi, 
				"dapp_jamreservasi"=>$dapp_nonmedis_jamreservasi, 
//				"dapp_petugas"=>$dapp_nonmedis_petugas, 
				"dapp_petugas2"=>$dapp_nonmedis_petugas2, 
				"dapp_status"=>$dapp_nonmedis_status, 
				"dapp_tgldatang"=>$dapp_nonmedis_tgldatang, 
				"dapp_jamdatang"=>$dapp_nonmedis_jamdatang,
				"dapp_keterangan"=>$dapp_nonmedis_keterangan
			);
			$this->db->insert('appointment_detail', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function appointment_list($filter,$start,$end){
			//$query = "SELECT * FROM appointment";
			$dt=date('Y-m-d');
			$query="SELECT app_id,cust_nama,cust_id,karyawan_dokter.karyawan_nama as dokter_nama,karyawan_dokter.karyawan_id as dokter_id,karyawan_terapis.karyawan_nama as terapis_nama,karyawan_terapis.karyawan_id as terapis_id,rawat_id,rawat_nama,kategori_nama,dapp_id,dapp_status,dapp_tglreservasi,dapp_jamdatang,app_tanggal,app_cara,app_keterangan,dapp_jamreservasi,app_creator,app_date_create,app_update,app_date_update,app_revised 
FROM (((appointment inner join appointment_detail on appointment.app_id=appointment_detail.dapp_master inner join perawatan on appointment_detail.dapp_perawatan=perawatan.rawat_id 
inner join customer on appointment.app_customer=customer.cust_id inner join kategori on perawatan.rawat_kategori=kategori.kategori_id) 
left join karyawan as karyawan_dokter on appointment_detail.dapp_petugas=karyawan_dokter.karyawan_id) left join karyawan as karyawan_terapis on appointment_detail.dapp_petugas2=karyawan_terapis.karyawan_id)
WHERE dapp_tglreservasi='$dt'";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (cust_nama LIKE '%".addslashes($filter)."%' OR app_tanggal LIKE '%".addslashes($filter)."%' OR app_cara LIKE '%".addslashes($filter)."%' OR app_keterangan LIKE '%".addslashes($filter)."%' )";
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
		function appointment_update($app_id ,$app_customer ,$app_tanggal ,$app_cara ,$app_keterangan,$dapp_id, $dapp_status, $dokter_nama, $terapis_nama, $kategori_nama, $rawat_id, $dokter_id, $terapis_id, $dapp_jamreservasi, $cust_id){
			//INSERT to Appointment-Detail
			$data_dapp=array();
			if($dapp_status=="datang"){
				$date_now=date('Y-m-d');
				$time_now=date('H:i:s');
				$data_dapp["dapp_tgldatang"]=$date_now;
				$data_dapp["dapp_jamdatang"]=$time_now;
				$data_dapp["dapp_status"]=$dapp_status;
			}else{
				$data_dapp["dapp_tgldatang"]="0000-00-00";
				$data_dapp["dapp_jamdatang"]="";
				$data_dapp["dapp_status"]=$dapp_status;
				
				//Menghapus Tindakan-DEtail WHERE 
				$this->db->where('dtrawat_dapp', $dapp_id);
				$this->db->delete('tindakan_detail');
			}
			$sql="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$dokter_nama'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data_dapp["dapp_petugas"]=$dokter_nama;
			$this->db->where('dapp_id',$dapp_id);
			$this->db->where('dapp_master',$app_id);
			$this->db->update('appointment_detail',$data_dapp);
			
			//INSERT to Appointment
			$data = array(
				"app_id"=>$app_id, 
				//"app_customer"=>$app_customer, 
				"app_tanggal"=>$app_tanggal, 
				"app_cara"=>$app_cara, 
				"app_keterangan"=>$app_keterangan,
			);
			$sql_cust="SELECT cust_id FROM customer WHERE cust_id='$app_customer'";
			$rs_cust=$this->db->query($sql_cust);
			if($rs_cust->num_rows()){
				$customer_id=$app_customer;
				$data["app_customer"]=$app_customer;
			}else{
				$customer_id=$cust_id;
			}
			$this->db->where('app_id', $app_id);
			$this->db->update('appointment', $data);
			
			//INSERT to Perawatan-Tindakan
			if($dapp_status=="datang"){
				$sql="SELECT * FROM tindakan WHERE trawat_cust='$customer_id' AND trawat_date_create='$date_now'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$rs_record=$rs->row_array();
					$dtrawat_master=$rs_record["trawat_id"]; //ambil ID dr tabel tindakan
					//Hanya INSERT to Tindakan-Detail
					$data_dtindakan=array(
					"dtrawat_master"=>$dtrawat_master,
					"dtrawat_dapp"=>$dapp_id,
					"dtrawat_perawatan"=>$rawat_id,
					"dtrawat_jam"=>$dapp_jamreservasi,
					"dtrawat_status"=>$dapp_status
					);
					$sql_petugas1="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$dokter_nama'";
					$rs_petugas1=$this->db->query($sql_petugas1);
					if($rs_petugas1->num_rows())
						$data_dtindakan["dtrawat_petugas1"]=$dokter_nama;
					else
						$data_dtindakan["dtrawat_petugas1"]=$dokter_id;
					
					$sql_petugas2="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$terapis_nama'";
					$rs_petugas2=$this->db->query($sql_petugas2);
					if($rs_petugas2->num_rows())
						$data_dtindakan["dtrawat_petugas2"]=$terapis_nama;
					else
						$data_dtindakan["dtrawat_petugas2"]=$terapis_id;
					$this->db->insert('tindakan_detail', $data_dtindakan);
				}else{
					$data_tindakan=array(
					"trawat_cust"=>$customer_id,
					"trawat_jamdatang"=>$time_now,
					//"trawat_appointment"=>$kategori_nama,
					"trawat_keterangan"=>$app_keterangan,
					"trawat_date_create"=>$date_now
					);
					$this->db->insert('tindakan', $data_tindakan);
					if($this->db->affected_rows()){
						$sql="SELECT * FROM tindakan WHERE trawat_cust='$customer_id' AND trawat_date_create='$date_now'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$rs_record=$rs->row_array();
							$dtrawat_master=$rs_record["trawat_id"];
						}
						$data_dtindakan=array(
						"dtrawat_master"=>$dtrawat_master,
						"dtrawat_dapp"=>$dapp_id,
						"dtrawat_perawatan"=>$rawat_id,
						"dtrawat_jam"=>$dapp_jamreservasi,
						"dtrawat_status"=>$dapp_status
						);
						$sql_petugas1="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$dokter_nama'";
						$rs_petugas1=$this->db->query($sql_petugas1);
						if($rs_petugas1->num_rows())
							$data_dtindakan["dtrawat_petugas1"]=$dokter_nama;
						else
							$data_dtindakan["dtrawat_petugas1"]=$dokter_id;
						
						$sql_petugas2="SELECT karyawan_id FROM karyawan WHERE karyawan_id='$terapis_nama'";
						$rs_petugas2=$this->db->query($sql_petugas2);
						if($rs_petugas2->num_rows())
							$data_dtindakan["dtrawat_petugas2"]=$terapis_nama;
						else
							$data_dtindakan["dtrawat_petugas2"]=$terapis_id;
						$this->db->insert('tindakan_detail', $data_dtindakan);
					}
				}
			}
			
			return '1';
		}
		
		//function for create new record
		function appointment_create($app_customer ,$app_tanggal ,$app_cara ,$app_keterangan ,$app_cust_nama_baru ,$app_cust_telp_baru ,$app_cust_hp_baru ,$app_cust_keterangan_baru ){
			if($app_cust_nama_baru!=""){
				$sql="SELECT * FROM customer WHERE cust_telprumah='$app_cust_telp_baru' OR cust_hp='$app_cust_hp_baru'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					return '2';
				}else{
					$data_cust_baru=array(
					"cust_nama"=>$app_cust_nama_baru,
					"cust_telprumah"=>$app_cust_telp_baru,
					"cust_hp"=>$app_cust_hp_baru,
					"cust_keterangan"=>$app_cust_keterangan_baru,
					"cust_aktif"=>'Aktif'
					);
					$this->db->insert('customer', $data_cust_baru);
					if($this->db->affected_rows()){
						$sql="SELECT cust_id FROM customer WHERE cust_telprumah='$app_cust_telp_baru' OR cust_hp='$app_cust_hp_baru'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$rs_record=$rs->row_array();
							$app_customer=$rs_record["cust_id"];
						}
						
						$data = array(
							"app_customer"=>$app_customer, 
							"app_tanggal"=>$app_tanggal, 
							"app_cara"=>$app_cara, 
							"app_keterangan"=>$app_keterangan 
						);
						$this->db->insert('appointment', $data);
					}
				}
			}else{
				$data = array(
					"app_customer"=>$app_customer, 
					"app_tanggal"=>$app_tanggal, 
					"app_cara"=>$app_cara, 
					"app_keterangan"=>$app_keterangan 
				);
				$this->db->insert('appointment', $data);
			} 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
			
		}
		
		//fcuntion for delete record
		/*function appointment_delete($pkid){
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
		}*/
		
		/* Delete appointment_detail */
		function appointment_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the appointments at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM appointment_detail WHERE dapp_id = ".$pkid[0];
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
		function appointment_search($app_id ,$app_customer ,$app_cara ,$app_kategori ,$app_dokter ,$app_terapis ,$app_tgl_start_reservasi, $app_tgl_end_reservasi, $app_tgl_start_app, $app_tgl_end_app, $start,$end){
			//full query
			//$query="select * from appointment";
			$query="SELECT app_id,app_customer,cust_nama,karyawan_dokter.karyawan_nama as dokter_nama,karyawan_terapis.karyawan_nama as terapis_nama,rawat_nama,kategori_nama,dapp_id,dapp_status,dapp_tglreservasi,dapp_jamdatang,app_tanggal,app_cara,app_keterangan,dapp_jamreservasi,app_creator,app_date_create,app_update,app_date_update,app_revised 
FROM (((appointment inner join appointment_detail on appointment.app_id=appointment_detail.dapp_master inner join perawatan on appointment_detail.dapp_perawatan=perawatan.rawat_id 
inner join customer on appointment.app_customer=customer.cust_id inner join kategori on perawatan.rawat_kategori=kategori.kategori_id) 
left join karyawan as karyawan_dokter on appointment_detail.dapp_petugas=karyawan_dokter.karyawan_id) left join karyawan as karyawan_terapis on appointment_detail.dapp_petugas2=karyawan_terapis.karyawan_id)";
			
			if($app_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_id LIKE '%".$app_id."%'";
			};
			if($app_customer!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_customer='".$app_customer."'";
			};
			if($app_tgl_start_reservasi!='' && $app_tgl_end_reservasi!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_tanggal BETWEEN '".$app_tgl_start_reservasi."' AND '".$app_tgl_end_reservasi."'";
			}else if($app_tgl_start_reservasi!='' && $app_tgl_end_reservasi==''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_tanggal='".$app_tgl_start_reservasi."'";
			}
			if($app_tgl_start_app!='' && $app_tgl_end_app!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dapp_tglreservasi BETWEEN '".$app_tgl_start_app."' AND '".$app_tgl_end_app."'";
			}else if($app_tgl_start_app!='' && $app_tgl_end_app==''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dapp_tglreservasi='".$app_tgl_start_app."'";
			}
			if($app_cara!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_cara LIKE '%".$app_cara."%'";
			};
			if($app_kategori!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kategori_nama='".$app_kategori."'";
			};
			if($app_dokter!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_dokter.karyawan_id='".$app_dokter."'";
			};
			if($app_terapis!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_terapis.karyawan_id='".$app_terapis."'";
			};
			/*if($app_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " app_keterangan LIKE '%".$app_keterangan."%'";
			};*/
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