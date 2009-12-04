<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: tindakan Model
	+ Description	: For record model process back-end
	+ Filename 		: m_tindakan_nonmedis.php
 	+ Author  		: masongbee
 	+ Created on 22/Oct/2009 19:16:47
	
*/

class M_tindakan_nonmedis extends Model{
		
		//constructor
		function M_tindakan_nonmedis() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_tindakan_detail_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM tindakan_detail where dtrawat_master='".$master_id."'";
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
			$query = "SELECT max(trawat_id) as master_id from tindakan";
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
		function detail_tindakan_detail_purge($master_id){
			$sql="DELETE from tindakan_detail where dtrawat_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_tindakan_detail_insert($dtrawat_id ,$dtrawat_master ,$dtrawat_perawatan ,$dtrawat_petugas1 ,$dtrawat_petugas2 ,$dtrawat_jam ,$dtrawat_kategori ,$dtrawat_status ){
			//if master id not capture from view then capture it from max pk from master table
			if($dtrawat_master=="" || $dtrawat_master==NULL){
				$dtrawat_master=$this->get_master_id();
			}
			
			$data = array(
				"dtrawat_master"=>$dtrawat_master, 
				"dtrawat_perawatan"=>$dtrawat_perawatan, 
				"dtrawat_petugas1"=>$dtrawat_petugas1, 
				"dtrawat_petugas2"=>$dtrawat_petugas2, 
				"dtrawat_jam"=>$dtrawat_jam, 
				"dtrawat_kategori"=>$dtrawat_kategori, 
				"dtrawat_status"=>$dtrawat_status 
			);
			$this->db->insert('tindakan_detail', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function tindakan_list($filter,$start,$end){
			//$query = "SELECT * FROM tindakan,customer WHERE trawat_cust=cust_id AND trawat_appointment='Non Medis'";
			$date_now=date('Y-m-d');
			$query = "SELECT * FROM tindakan INNER JOIN customer ON trawat_cust=cust_id INNER JOIN tindakan_detail ON dtrawat_master=trawat_id LEFT JOIN perawatan ON dtrawat_perawatan=rawat_id LEFT JOIN karyawan ON dtrawat_petugas2=karyawan_id LEFT JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_nama='Non Medis' AND trawat_date_create='$date_now'";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (trawat_id LIKE '%".addslashes($filter)."%' OR trawat_cust LIKE '%".addslashes($filter)."%' OR trawat_jamdatang LIKE '%".addslashes($filter)."%' OR trawat_appointment LIKE '%".addslashes($filter)."%' OR trawat_keterangan LIKE '%".addslashes($filter)."%' )";
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
		function tindakan_update($trawat_id ,$trawat_cust ,$trawat_keterangan ,$dtrawat_status ,$trawat_cust_id ,$dtrawat_perawatan_id ,$dtrawat_perawatan ,$dtrawat_id ,$rawat_harga ,$rawat_du ,$rawat_dm ,$cust_member ,$dtrawat_petugas2_no){
			/*$data = array(
				"trawat_id"=>$trawat_id, 
				//"trawat_cust"=>$trawat_cust, 
				"trawat_keterangan"=>$trawat_keterangan 
			);
			$this->db->where('trawat_id', $trawat_id);
			$this->db->update('tindakan', $data);*/
			/*
			 * Karena untuk perawatan-tindakan ini yg diUPDATE hanya dtrawat_status maka yg diUPDATE adalah
			 * hanya table.tindakan_detail
			 */ 
			$data_dtindakan=array(
			"dtrawat_status"=>$dtrawat_status
			);
			$this->db->where("dtrawat_id", $dtrawat_id);
			$this->db->update("tindakan_detail", $data_dtindakan);
			
			//Jika dtrawat_status=="selesai" --> INSERT to table.master_jual_rawat
			if($dtrawat_status=="selesai"){
				$date_now=date('Y-m-d');
				//Checking di table.master_jual_rawat WHERE jrawat_cust=$trawat_cust_id AND jrawat_tanggal=$date_now
				//Jika SUDAH ADA maka INSERT hanya ke table.detail_jual_rawat
				//Jika TIDAK ADA maka INSERT ke table.master_jual_rawat AND table.detail_jual_rawat
				
				$sql="SELECT jrawat_id FROM master_jual_rawat WHERE jrawat_cust='$trawat_cust_id' AND jrawat_tanggal='$date_now'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					//Hanya INSERT to table.detail_jual_rawat
					$rs_record=$rs->row_array();
					$jrawat_id=$rs_record["jrawat_id"];
					if($cust_member!=""){
						$diskon_jenis="DM";
						
						$data_djrawat=array(
						"drawat_master"=>$jrawat_id,
						"drawat_rawat"=>$dtrawat_perawatan_id,
						"drawat_harga"=>$rawat_harga,
						"drawat_diskon"=>$rawat_dm,
						"drawat_diskon_jenis"=>$diskon_jenis
						);
						$this->db->insert('detail_jual_rawat', $data_djrawat);
					}else if($cust_member==""){
						$diskon_jenis="DU";
						
						$data_djrawat=array(
						"drawat_master"=>$jrawat_id,
						"drawat_rawat"=>$dtrawat_perawatan_id,
						"drawat_harga"=>$rawat_harga,
						"drawat_diskon"=>$rawat_du,
						"drawat_diskon_jenis"=>$diskon_jenis
						);
						$this->db->insert('detail_jual_rawat', $data_djrawat);
					}
					//Check AND INSERT history jumlah tindakan oleh Dokter
					/*$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_nik='$dtrawat_petugas2_no' AND reportt_bln LIKE '$bln_now%'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$rs_record=$rs->row_array();
						$reportt_jmltindakan=$rs_record["reportt_jmltindakan"];
						//UPDATE jumlah_tindakan
						$data_report_tindakan=array(
						"reportt_jmltindakan"=>$reportt_jmltindakan+1
						);
						$this->db->where('reportt_nik', $dtrawat_petugas2_no);
						$this->db->like('reportt_bln', $bln_now, 'after');
						$this->db->update('report_tindakan', $data_report_tindakan);
					}else{
						$data_report_tindakan=array(
						"reportt_nik"=>$dtrawat_petugas2_no,
						"reportt_bln"=>$date_now,
						"reportt_jmltindakan"=>1
						);
						$this->db->insert('report_tindakan', $data_report_tindakan);
					}*/
				}else{
					//INSERT to table.master_jual_rawat AND table.detail_jual_rawat
					$pattern="PR/".date("y/m")."/";
					$jrawat_nobukti=$this->m_public_function->get_kode_1('master_jual_rawat','jrawat_nobukti',$pattern,13);
					$data_jrawat=array(
					"jrawat_nobukti"=>$jrawat_nobukti,
					"jrawat_cust"=>$trawat_cust_id,
					"jrawat_tanggal"=>$date_now
					);
					$this->db->insert('master_jual_rawat', $data_jrawat);
					if($this->db->affected_rows()){
						//INSERT to table.detail_jual_rawat
						$sql="SELECT jrawat_id FROM master_jual_rawat WHERE jrawat_cust='$trawat_cust_id' AND jrawat_tanggal='$date_now'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$rs_record=$rs->row_array();
							$jrawat_id=$rs_record["jrawat_id"];
						}
						
						if($cust_member!=""){
							$diskon_jenis="DM";
							
							$data_djrawat=array(
							"drawat_master"=>$jrawat_id,
							"drawat_rawat"=>$dtrawat_perawatan_id,
							"drawat_harga"=>$rawat_harga,
							"drawat_diskon"=>$rawat_dm,
							"drawat_diskon_jenis"=>$diskon_jenis
							);
							$this->db->insert('detail_jual_rawat', $data_djrawat);
						}else if($cust_member==""){
							$diskon_jenis="DU";
							
							$data_djrawat=array(
							"drawat_master"=>$jrawat_id,
							"drawat_rawat"=>$dtrawat_perawatan_id,
							"drawat_harga"=>$rawat_harga,
							"drawat_diskon"=>$rawat_du,
							"drawat_diskon_jenis"=>$diskon_jenis
							);
							$this->db->insert('detail_jual_rawat', $data_djrawat);
						}
					}
					//Check AND INSERT history jumlah tindakan oleh Dokter
					/*$sql="SELECT reportt_jmltindakan FROM report_tindakan WHERE reportt_nik='$dtrawat_petugas2_no' AND reportt_bln LIKE '$bln_now%'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$rs_record=$rs->row_array();
						$reportt_jmltindakan=$rs_record["reportt_jmltindakan"];
						//UPDATE jumlah_tindakan
						$data_report_tindakan=array(
						"reportt_jmltindakan"=>$reportt_jmltindakan+1
						);
						$this->db->where('reportt_nik', $dtrawat_petugas2_no);
						$this->db->like('reportt_bln', $bln_now, 'after');
						$this->db->update('report_tindakan', $data_report_tindakan);
					}else{
						$data_report_tindakan=array(
						"reportt_nik"=>$dtrawat_petugas2_no,
						"reportt_bln"=>$date_now,
						"reportt_jmltindakan"=>1
						);
						$this->db->insert('report_tindakan', $data_report_tindakan);
					}*/
				}
			}
			
			return '1';
		}
		
		//function for create new record
		function tindakan_create($trawat_cust ,$trawat_jamdatang ,$trawat_appointment ,$trawat_keterangan ){
			$data = array(
				"trawat_cust"=>$trawat_cust, 
				"trawat_jamdatang"=>$trawat_jamdatang, 
				"trawat_appointment"=>$trawat_appointment, 
				"trawat_keterangan"=>$trawat_keterangan 
			);
			$this->db->insert('tindakan', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function tindakan_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the tindakans at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM tindakan WHERE trawat_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM tindakan WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "trawat_id= ".$pkid[$i];
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
		function tindakan_search($trawat_id ,$trawat_cust ,$trawat_jamdatang ,$trawat_appointment ,$trawat_keterangan ,$start,$end){
			//full query
			$query="select * from tindakan";
			
			if($trawat_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " trawat_id LIKE '%".$trawat_id."%'";
			};
			if($trawat_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " trawat_cust LIKE '%".$trawat_cust."%'";
			};
			if($trawat_jamdatang!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " trawat_jamdatang LIKE '%".$trawat_jamdatang."%'";
			};
			if($trawat_appointment!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " trawat_appointment LIKE '%".$trawat_appointment."%'";
			};
			if($trawat_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " trawat_keterangan LIKE '%".$trawat_keterangan."%'";
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
		function tindakan_print($trawat_id ,$trawat_cust ,$trawat_jamdatang ,$trawat_appointment ,$trawat_keterangan ,$option,$filter){
			//full query
			$query="select * from tindakan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (trawat_id LIKE '%".addslashes($filter)."%' OR trawat_cust LIKE '%".addslashes($filter)."%' OR trawat_jamdatang LIKE '%".addslashes($filter)."%' OR trawat_appointment LIKE '%".addslashes($filter)."%' OR trawat_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($trawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_id LIKE '%".$trawat_id."%'";
				};
				if($trawat_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_cust LIKE '%".$trawat_cust."%'";
				};
				if($trawat_jamdatang!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_jamdatang LIKE '%".$trawat_jamdatang."%'";
				};
				if($trawat_appointment!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_appointment LIKE '%".$trawat_appointment."%'";
				};
				if($trawat_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_keterangan LIKE '%".$trawat_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function tindakan_export_excel($trawat_id ,$trawat_cust ,$trawat_jamdatang ,$trawat_appointment ,$trawat_keterangan ,$option,$filter){
			//full query
			$query="select * from tindakan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (trawat_id LIKE '%".addslashes($filter)."%' OR trawat_cust LIKE '%".addslashes($filter)."%' OR trawat_jamdatang LIKE '%".addslashes($filter)."%' OR trawat_appointment LIKE '%".addslashes($filter)."%' OR trawat_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($trawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_id LIKE '%".$trawat_id."%'";
				};
				if($trawat_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_cust LIKE '%".$trawat_cust."%'";
				};
				if($trawat_jamdatang!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_jamdatang LIKE '%".$trawat_jamdatang."%'";
				};
				if($trawat_appointment!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_appointment LIKE '%".$trawat_appointment."%'";
				};
				if($trawat_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_keterangan LIKE '%".$trawat_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>