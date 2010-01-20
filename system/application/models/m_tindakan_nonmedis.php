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
		function detail_tindakan_nonmedis_detail_purge($master_id){
			$sql="DELETE from tindakan_detail where dtrawat_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_tindakan_nonmedis_detail_insert($dtrawat_id ,$dtrawat_master ,$dtrawat_perawatan ,$dtrawat_petugas1 ,$dtrawat_petugas2 ,$dtrawat_jam ,$dtrawat_kategori ,$dtrawat_status ,$dtrawat_keterangan ){
			//if master id not capture from view then capture it from max pk from master table
			if($dtrawat_master=="" || $dtrawat_master==NULL){
				$dtrawat_master=$this->get_master_id();
			}
			
			if(is_numeric($dtrawat_id)==false && is_numeric($dtrawat_perawatan)==true){
				$dt_now=date('Y-m-d');
				$data = array(
					"dtrawat_master"=>$dtrawat_master, 
					"dtrawat_perawatan"=>$dtrawat_perawatan, 
					"dtrawat_petugas1"=>$dtrawat_petugas1, 
					"dtrawat_petugas2"=>$dtrawat_petugas2, 
					"dtrawat_jam"=>$dtrawat_jam, 
					"dtrawat_kategori"=>$dtrawat_kategori,
					"dtrawat_tglapp"=>$dt_now,
					"dtrawat_status"=>$dtrawat_status,
					"dtrawat_keterangan"=>$dtrawat_keterangan
				);
				$this->db->insert('tindakan_detail', $data); 
				if($this->db->affected_rows())
					return '1';
				else
					return '0';
			}elseif(is_numeric($dtrawat_id)==true){
				$sql="SELECT dtrawat_id,dtrawat_perawatan,dtrawat_petugas1,dtrawat_jam FROM tindakan_detail WHERE dtrawat_perawatan='$dtrawat_perawatan' AND dtrawat_petugas1='$dtrawat_petugas1' AND dtrawat_jam='$dtrawat_jam' AND dtrawat_id='$dtrawat_id' AND dtrawat_keterangan='$dtrawat_keterangan'";
				$rs=$this->db->query($sql);
				if(!$rs->num_rows()){
					$data = array(
					"dtrawat_perawatan"=>$dtrawat_perawatan, 
					"dtrawat_petugas1"=>$dtrawat_petugas1, 
					"dtrawat_jam"=>$dtrawat_jam,
					"dtrawat_keterangan"=>$dtrawat_keterangan
					);
					$this->db->where('dtrawat_id',$dtrawat_id);
					$this->db->update('tindakan_detail',$data);
				}
			}

		}
		//end of function
		
		//function for get list record
		function tindakan_list($filter,$start,$end){
			//$query = "SELECT * FROM tindakan,customer WHERE trawat_cust=cust_id AND trawat_appointment='Non Medis'";
			$date_now=date('Y-m-d');
			$query = "SELECT trawat_id,trawat_cust,cust_nama,cust_no,trawat_keterangan,trawat_creator,trawat_date_create,trawat_update,trawat_date_update,trawat_revised,dtrawat_id,dtrawat_perawatan,rawat_nama,karyawan_nama,karyawan_no,dtrawat_jam,dtrawat_tglapp,dtrawat_status,karyawan_username,rawat_harga,rawat_du,rawat_dm,dtrawat_keterangan,dtrawat_dapp FROM tindakan INNER JOIN customer ON trawat_cust=cust_id INNER JOIN tindakan_detail ON dtrawat_master=trawat_id LEFT JOIN perawatan ON dtrawat_perawatan=rawat_id LEFT JOIN karyawan ON dtrawat_petugas2=karyawan_id LEFT JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_nama='Non Medis' AND trawat_date_create='$date_now'";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			$query.=" AND dtrawat_status='siap'";
			
			$query2 = "SELECT trawat_id,trawat_cust,cust_nama,cust_no,trawat_keterangan,trawat_creator,trawat_date_create,trawat_update,trawat_date_update,trawat_revised,dtrawat_id,dtrawat_perawatan,rawat_nama,karyawan_nama,karyawan_no,dtrawat_jam,dtrawat_tglapp,dtrawat_status,karyawan_username,rawat_harga,rawat_du,rawat_dm,dtrawat_keterangan,dtrawat_dapp FROM tindakan INNER JOIN customer ON trawat_cust=cust_id INNER JOIN tindakan_detail ON dtrawat_master=trawat_id LEFT JOIN perawatan ON dtrawat_perawatan=rawat_id LEFT JOIN karyawan ON dtrawat_petugas2=karyawan_id LEFT JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_nama='Non Medis' AND trawat_date_create='$date_now'";
			
			// For simple search
			if ($filter<>""){
				$query2 .=eregi("WHERE",$query2)? " AND ":" WHERE ";
				$query2 .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			$query2.=" AND dtrawat_status='datang'";
			
			$query3 = "SELECT trawat_id,trawat_cust,cust_nama,cust_no,trawat_keterangan,trawat_creator,trawat_date_create,trawat_update,trawat_date_update,trawat_revised,dtrawat_id,dtrawat_perawatan,rawat_nama,karyawan_nama,karyawan_no,dtrawat_jam,dtrawat_tglapp,dtrawat_status,karyawan_username,rawat_harga,rawat_du,rawat_dm,dtrawat_keterangan,dtrawat_dapp FROM tindakan INNER JOIN customer ON trawat_cust=cust_id INNER JOIN tindakan_detail ON dtrawat_master=trawat_id LEFT JOIN perawatan ON dtrawat_perawatan=rawat_id LEFT JOIN karyawan ON dtrawat_petugas2=karyawan_id LEFT JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_nama='Non Medis' AND trawat_date_create='$date_now'";
			
			// For simple search
			if ($filter<>""){
				$query3 .=eregi("WHERE",$query3)? " AND ":" WHERE ";
				$query3 .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			$query3.=" AND dtrawat_status='selesai'";
			
			$query4 = "SELECT trawat_id,trawat_cust,cust_nama,cust_no,trawat_keterangan,trawat_creator,trawat_date_create,trawat_update,trawat_date_update,trawat_revised,dtrawat_id,dtrawat_perawatan,rawat_nama,karyawan_nama,karyawan_no,dtrawat_jam,dtrawat_tglapp,dtrawat_status,karyawan_username,rawat_harga,rawat_du,rawat_dm,dtrawat_keterangan,dtrawat_dapp FROM tindakan INNER JOIN customer ON trawat_cust=cust_id INNER JOIN tindakan_detail ON dtrawat_master=trawat_id LEFT JOIN perawatan ON dtrawat_perawatan=rawat_id LEFT JOIN karyawan ON dtrawat_petugas2=karyawan_id LEFT JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_nama='Non Medis' AND trawat_date_create='$date_now'";
			
			// For simple search
			if ($filter<>""){
				$query4 .=eregi("WHERE",$query4)? " AND ":" WHERE ";
				$query4 .= " (cust_nama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR dtrawat_status LIKE '%".addslashes($filter)."%')";
			}
			$query4.=" AND dtrawat_status='batal'";
			
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			//$limit = $query." LIMIT ".$start.",".$end;		
			//$result = $this->db->query($limit);  
			$result2 = $this->db->query($query2);
			$nbrows2 = $result2->num_rows();
			
			$result3 = $this->db->query($query3);
			$nbrows3 = $result3->num_rows();
			
			$result4 = $this->db->query($query4);
			$nbrows4 = $result4->num_rows();
			
			if($nbrows>0 || $nbrows2>0 || $nbrows3>0 || $nbrows4>0){
			if($nbrows>0){
					foreach($result->result() as $row){
						$arr[] = $row;
					}
				}
				if($nbrows2>0){
					foreach($result2->result() as $row2){
						$arr[] = $row2;
					}
				}
				if($nbrows3>0){
					foreach($result3->result() as $row3){
						$arr[] = $row3;
					}
				}
				if($nbrows4>0){
					foreach($result4->result() as $row4){
						$arr[] = $row4;
					}
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
		//function for update record
		function tindakan_update($trawat_id ,$trawat_cust ,$trawat_keterangan ,$dtrawat_status ,$trawat_cust_id ,$dtrawat_perawatan_id ,$dtrawat_perawatan ,$dtrawat_id ,$rawat_harga ,$rawat_du ,$rawat_dm ,$cust_member ,$dtrawat_petugas2_no ,$dtrawat_keterangan ,$dtrawat_dapp){
			/*
			 * Karena untuk perawatan-tindakan ini yg diUPDATE hanya dtrawat_status maka yg diUPDATE adalah
			 * hanya table.tindakan_detail
			 */ 
			$date_now=date('Y-m-d');
			$sql="SELECT dtrawat_locked FROM tindakan_detail WHERE dtrawat_id='$dtrawat_id' AND dtrawat_locked=0";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$data_tindakan=array(
				"trawat_keterangan"=>$trawat_keterangan
				);
				$this->db->where("trawat_id", $trawat_id);
				$this->db->update("tindakan", $data_tindakan);
				
				$data_dtindakan=array(
				"dtrawat_status"=>$dtrawat_status,
				"dtrawat_keterangan"=>$dtrawat_keterangan
				);
				$sql="SELECT rawat_id FROM perawatan WHERE rawat_id='$dtrawat_perawatan'";
				$rs=$this->db->query($sql);
				if($rs->num_rows())
					$data_dtindakan["dtrawat_perawatan"]=$dtrawat_perawatan;
				
				$this->db->where("dtrawat_id", $dtrawat_id);
				$this->db->update("tindakan_detail", $data_dtindakan);
			}
			
			//Jika dtrawat_status=="selesai" --> INSERT to table.master_jual_rawat
			if($dtrawat_status=="selesai"){
				//$bln_now=date('Y-m');
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
						"drawat_dtrawat"=>$dtrawat_id,
						"drawat_rawat"=>$dtrawat_perawatan_id,
						"drawat_jumlah"=>1,
						"drawat_harga"=>$rawat_harga,
						"drawat_diskon"=>$rawat_dm,
						"drawat_diskon_jenis"=>$diskon_jenis
						);
						$this->db->insert('detail_jual_rawat', $data_djrawat);
						if($this->db->affected_rows()){
							$data_dapp_locked=array(
							"dapp_locked"=>1
							);
							$this->db->where('dapp_id', $dtrawat_dapp);
							$this->db->update('appointment_detail', $data_dapp_locked);
						}
					}else if($cust_member==""){
						$diskon_jenis="DU";
						
						$data_djrawat=array(
						"drawat_master"=>$jrawat_id,
						"drawat_dtrawat"=>$dtrawat_id,
						"drawat_rawat"=>$dtrawat_perawatan_id,
						"drawat_jumlah"=>1,
						"drawat_harga"=>$rawat_harga,
						"drawat_diskon"=>$rawat_du,
						"drawat_diskon_jenis"=>$diskon_jenis
						);
						$this->db->insert('detail_jual_rawat', $data_djrawat);
						if($this->db->affected_rows()){
							$data_dapp_locked=array(
							"dapp_locked"=>1
							);
							$this->db->where('dapp_id', $dtrawat_dapp);
							$this->db->update('appointment_detail', $data_dapp_locked);
						}
					}
				}else{
					//INSERT to table.master_jual_rawat AND table.detail_jual_rawat
					$pattern="PR/".date("ym")."-";
					$jrawat_nobukti=$this->m_public_function->get_kode_1('master_jual_rawat','jrawat_nobukti',$pattern,12);
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
							"drawat_dtrawat"=>$dtrawat_id,
							"drawat_rawat"=>$dtrawat_perawatan_id,
							"drawat_jumlah"=>1,
							"drawat_harga"=>$rawat_harga,
							"drawat_diskon"=>$rawat_dm,
							"drawat_diskon_jenis"=>$diskon_jenis
							);
							$this->db->insert('detail_jual_rawat', $data_djrawat);
							if($this->db->affected_rows()){
								$data_dapp_locked=array(
								"dapp_locked"=>1
								);
								$this->db->where('dapp_id', $dtrawat_dapp);
								$this->db->update('appointment_detail', $data_dapp_locked);
							}
						}else if($cust_member==""){
							$diskon_jenis="DU";
							
							$data_djrawat=array(
							"drawat_master"=>$jrawat_id,
							"drawat_dtrawat"=>$dtrawat_id,
							"drawat_rawat"=>$dtrawat_perawatan_id,
							"drawat_jumlah"=>1,
							"drawat_harga"=>$rawat_harga,
							"drawat_diskon"=>$rawat_du,
							"drawat_diskon_jenis"=>$diskon_jenis
							);
							$this->db->insert('detail_jual_rawat', $data_djrawat);
							if($this->db->affected_rows()){
								$data_dapp_locked=array(
								"dapp_locked"=>1
								);
								$this->db->where('dapp_id', $dtrawat_dapp);
								$this->db->update('appointment_detail', $data_dapp_locked);
							}
						}
					}
				}
			}else{
				$sql="SELECT dtrawat_locked FROM tindakan_detail WHERE dtrawat_id='$dtrawat_id' AND dtrawat_locked=0";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					//ambil trawat_cust,dtrawat_perawatan, dan tanggal_sekarang untuk ambil ID dr db.Master_Jual_Rawat
					$sql="SELECT jrawat_id FROM master_jual_rawat WHERE jrawat_cust='$trawat_cust_id' AND jrawat_tanggal='$date_now'";
					$rs=$this->db->query($sql);
					if($rs->num_rows()){
						$rs_record=$rs->row_array();
						$rs_record_jrawat_id=$rs_record['jrawat_id'];
						$sql="SELECT * FROM detail_jual_rawat WHERE drawat_master='$rs_record_jrawat_id' AND drawat_rawat='$dtrawat_perawatan_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$this->db->where('drawat_master',$rs_record_jrawat_id);
							$this->db->where('drawat_rawat',$dtrawat_perawatan_id);
							$this->db->like('drawat_date_create',$date_now,'after');
							$this->db->delete('detail_jual_rawat');
							if($this->db->affected_rows()){
								$data_dapp_locked=array(
								"dapp_locked"=>0
								);
								$this->db->where('dapp_id', $dtrawat_dapp);
								$this->db->update('appointment_detail', $data_dapp_locked);
							}
						}
						$sql="SELECT drawat_id FROM detail_jual_rawat WHERE drawat_master='$rs_record_jrawat_id'";
						$rs=$this->db->query($sql);
						if(!$rs->num_rows()){
							$this->db->where('jrawat_id',$rs_record_jrawat_id);
							$this->db->delete('master_jual_rawat');
							if($this->db->affected_rows()){
								$data_dapp_locked=array(
								"dapp_locked"=>0
								);
								$this->db->where('dapp_id', $dtrawat_dapp);
								$this->db->update('appointment_detail', $data_dapp_locked);
							}
						}
					}
				}
			}
			
			return '1';
		}
		
		//function for create new record
		function tindakan_create($trawat_cust ,$trawat_keterangan ){
			$time_now=date('H:i:s');
			$date_now=date('Y-m-d');
			$data = array(
				"trawat_cust"=>$trawat_cust, 
				"trawat_jamdatang"=>$time_now,
				"trawat_date_create"=>$date_now,
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
		function tindakan_search($trawat_id ,$trawat_cust ,$trawat_tglapp_start ,$trawat_tglapp_end ,$trawat_rawat ,$trawat_terapis ,$trawat_status ,$start,$end){
			//full query
			$query="SELECT trawat_id,trawat_cust,cust_nama,trawat_keterangan,trawat_creator,trawat_date_create,trawat_update,trawat_date_update,trawat_revised,dtrawat_id,dtrawat_perawatan,rawat_nama,karyawan_nama,karyawan_no,dtrawat_jam,dtrawat_tglapp,dtrawat_status,karyawan_username,rawat_harga,rawat_du,rawat_dm FROM tindakan INNER JOIN customer ON trawat_cust=cust_id INNER JOIN tindakan_detail ON dtrawat_master=trawat_id LEFT JOIN perawatan ON dtrawat_perawatan=rawat_id LEFT JOIN karyawan ON dtrawat_petugas2=karyawan_id LEFT JOIN kategori ON rawat_kategori=kategori_id WHERE kategori_nama='Non Medis'";
			
			if($trawat_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " trawat_id LIKE '%".$trawat_id."%'";
			};
			if($trawat_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " trawat_cust LIKE '%".$trawat_cust."%'";
			};
			if($trawat_rawat!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dtrawat_perawatan LIKE '%".$trawat_rawat."%'";
			};
			if($trawat_terapis!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dtrawat_petugas2 LIKE '%".$trawat_terapis."%'";
			};
			if($trawat_status!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dtrawat_status LIKE '%".$trawat_status."%'";
			};
			if($trawat_tglapp_start!='' && $trawat_tglapp_end!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dtrawat_tglapp BETWEEN '".$trawat_tglapp_start."' AND '".$trawat_tglapp_end."'";
			}else if($trawat_tglapp_start!='' && $trawat_tglapp_end==''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " dtrawat_tglapp='".$trawat_tglapp_start."'";
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
		function tindakan_print($trawat_id ,$trawat_cust ,$trawat_keterangan ,$option,$filter){
			//full query
			$query="select * from tindakan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (trawat_id LIKE '%".addslashes($filter)."%' OR trawat_cust LIKE '%".addslashes($filter)."%' OR trawat_keterangan LIKE '%".addslashes($filter)."%' )";
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
				if($trawat_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " trawat_keterangan LIKE '%".$trawat_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function tindakan_export_excel($trawat_id ,$trawat_cust ,$trawat_keterangan ,$option,$filter){
			//full query
			$query="select * from tindakan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (trawat_id LIKE '%".addslashes($filter)."%' OR trawat_cust LIKE '%".addslashes($filter)."%' OR trawat_keterangan LIKE '%".addslashes($filter)."%' )";
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