<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: customer Model
	+ Description	: For record model process back-end
	+ Filename 		: c_customer.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 16/Jul/2009 17:02:19
	
*/

class M_customer extends Model{
		
		//constructor
		function M_customer() {
			parent::Model();
		}
		
		function get_profesi_list($query){
			$sql="SELECT distinct(cust_profesi) FROM customer WHERE (cust_profesi!=null OR cust_profesi!='')";
			if($query<>""){
				$sql=$sql." AND (cust_profesi like '%".$query."%') ";
			}
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			$result = $this->db->query($sql);  
			
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
		
		//get master id, note : not done yet
		function get_master_id() {
			$query = "SELECT max(cust_id) as master_id from customer";
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
		
		function get_cabang_list(){
		$sql="SELECT cabang_id,cabang_nama
FROM cabang 
LEFT JOIN info on (info.info_cabang = cabang.cabang_id)
where cabang.cabang_id = info.info_cabang";
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
		
		
		
		//purge all detail from master
		function cust_note_purge($master_id){
			$sql="DELETE from customer_note where note_customer='".$master_id."'";
			$result=$this->db->query($sql);
			return $result;
		}
		//*eof
		
		//insert detail record
		function cust_note_insert($note_cust, $note_detail){
			//if master id not capture from view then capture it from max pk from master table
			if($note_cust=="" || $note_cust==NULL){
				$note_cust=$this->get_master_id();
			}
			
			$data = array(
				"note_customer"=>$note_cust, 
				"note_tanggal"=>date('Y-m-d'), 
				"note_detail"=>$note_detail
			);
			$this->db->insert('customer_note', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		
		function get_cust_member($cust_id,$start,$end){
			$sql = "SELECT member.* FROM customer,member where member_cust=cust_id and cust_id='".$cust_id."'";
			
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
		
		function get_cust_note($cust_id,$start,$end){
			$sql = "SELECT customer_note.* FROM customer,customer_note where note_customer=cust_id and cust_id='".$cust_id."'";
			
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
		
		function get_hobi_list($query){
			$sql="SELECT distinct(cust_hobi) FROM customer WHERE (cust_hobi!=null OR cust_hobi!='')";
			if($query<>""){
				$sql=$sql." AND (cust_hobi LIKE '%".$query."%') ";
			}
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			$result = $this->db->query($sql);  
			
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
		
				
		function get_reflain_list(){
			$sql="select distinct(cust_referensilain) from customer where cust_referensilain!=null or cust_referensilain!=''";
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			$result = $this->db->query($sql);  
			
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
		function customer_list($filter,$start,$end){
			$query =   "SELECT * FROM vu_customer";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (cust_no LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR cust_alamat LIKE '%".addslashes($filter)."%' OR cust_alamat2 LIKE '%".addslashes($filter)."%' OR cust_telprumah LIKE '%".addslashes($filter)."%' OR cust_telprumah2 LIKE '%".addslashes($filter)."%' OR cust_telpkantor LIKE '%".addslashes($filter)."%' OR cust_hp LIKE '%".addslashes($filter)."%' OR cust_hp2 LIKE '%".addslashes($filter)."%' OR cust_hp3 LIKE '%".addslashes($filter)."%' OR cust_member LIKE '%".addslashes($filter)."%' )";
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
		function customer_update($cust_id, $cust_no ,$cust_nolama ,$cust_nama, $cust_panggilan ,$cust_kelamin ,$cust_alamat ,$cust_kota ,$cust_kodepos ,$cust_propinsi ,$cust_negara,$cust_alamat2 ,$cust_kota2 ,$cust_kodepos2 ,$cust_propinsi2 ,$cust_negara2 ,$cust_telprumah ,$cust_telprumah2 ,$cust_telpkantor ,$cust_hp ,$cust_hp2 ,$cust_hp3 ,$cust_email ,$cust_fb ,$cust_tweeter , $cust_email2 ,$cust_fb2 ,$cust_tweeter2 ,$cust_agama ,$cust_pendidikan ,$cust_profesi ,$cust_tmptlahir ,$cust_tgllahir ,$cust_hobi ,$cust_referensi,$cust_referensilain ,$cust_keterangan ,$cust_member ,$cust_terdaftar ,$cust_statusnikah ,$cust_priority , $cust_jmlanak ,$cust_unit ,$cust_aktif ,$cust_creator ,$cust_date_create ,$cust_update ,$cust_date_update ,$cust_revised ,$cust_cp ,$cust_cptelp ){
			if ($cust_aktif=="")
				$cust_aktif = "Aktif";
			if ($cust_unit=="Miracle Thamrin")
				$cust_unit = 1;
			if ($cust_unit=="Miracle HR Muhammad")
				$cust_unit = 2;
			if ($cust_unit=="Corporate")
				$cust_unit = 7;
			if ($cust_unit=="Miracle Kertajaya Indah")
				$cust_unit = 8;
			if ($cust_unit=="Miracle Tunjungan Plaza")
				$cust_unit = 9;
			if ($cust_unit=="Miracle Malang")
				$cust_unit = 10;
			if ($cust_unit=="Miracle Denpasar")
				$cust_unit = 11;
			if ($cust_unit=="Miracle Kuta")
				$cust_unit = 12;
			if ($cust_unit=="Miracle Jakarta")
				$cust_unit = 13;
			if ($cust_unit=="Miracle Makassar")
				$cust_unit = 14;
			if ($cust_unit=="Miracle Balikpapan")
				$cust_unit = 15;
			if ($cust_unit=="Miracle Batam")
				$cust_unit = 16;
			if ($cust_unit=="Manyar Garden")
				$cust_unit = 17;
			if ($cust_unit=="Miracle Medan")
				$cust_unit = 18;
			$date_now = date('Y-m-d H:i:s');
/*			if($cust_kota=="" || $cust_kota==NULL)
				$cust_kota="Surabaya";
			if($cust_propinsi=="" || $cust_kota==NULL)
				$cust_propinsi="Jawa Timur";
			if($cust_negara=="" || $cust_kota==NULL)
				$cust_negara="Indonesia";*/
			$data = array(
				"cust_id"=>$cust_id,			
				"cust_no"=>$cust_no,
				"cust_nolama"=>$cust_nolama,
				"cust_nama"=>$cust_nama,
				"cust_panggilan"=>$cust_panggilan,
				"cust_kelamin"=>$cust_kelamin,			
				"cust_alamat"=>$cust_alamat,			
				"cust_kota"=>$cust_kota,			
				"cust_kodepos"=>$cust_kodepos,			
				"cust_propinsi"=>$cust_propinsi,			
				"cust_negara"=>$cust_negara,
				"cust_alamat2"=>$cust_alamat2,
				"cust_kota2"=>$cust_kota2,			
				"cust_kodepos2"=>$cust_kodepos2,			
				"cust_propinsi2"=>$cust_propinsi2,			
				"cust_negara2"=>$cust_negara2,
				"cust_telprumah"=>$cust_telprumah,			
				"cust_telprumah2"=>$cust_telprumah2,			
				"cust_telpkantor"=>$cust_telpkantor,			
				"cust_hp"=>$cust_hp,			
				"cust_hp2"=>$cust_hp2,			
				"cust_hp3"=>$cust_hp3,			
				"cust_email"=>$cust_email,
				"cust_email2"=>$cust_email2,
				"cust_agama"=>$cust_agama,			
				"cust_pendidikan"=>$cust_pendidikan,			
				"cust_profesi"=>$cust_profesi,			
				"cust_tmptlahir"=>$cust_tmptlahir,
				"cust_tgllahir"=>$cust_tgllahir,			
				"cust_hobi"=>$cust_hobi,			
				"cust_referensi"=>$cust_referensi,			
				"cust_referensilain"=>$cust_referensilain,			
				"cust_keterangan"=>$cust_keterangan,			
				"cust_terdaftar"=>$cust_terdaftar,			
				"cust_statusnikah"=>$cust_statusnikah,
				"cust_priority"=>$cust_priority,
				"cust_jmlanak"=>$cust_jmlanak,
				"cust_aktif"=>$cust_aktif,
				"cust_update"=>$_SESSION[SESSION_USERID],
				"cust_date_update"=>$date_now,			
				//"cust_revised"=>"(cust_revised+1)",
				"cust_cp"=>$cust_cp,
				"cust_cptelp"=>$cust_cptelp
			);
			if($cust_fb=='true')
				$data["cust_fb"]=1;
			if($cust_fb=='false')
				$data["cust_fb"]=0;
			if($cust_tweeter=='true')
				$data["cust_tweeter"]=1;
			if($cust_tweeter=='false')
				$data["cust_tweeter"]=0;
			if($cust_fb2=='true')
				$data["cust_fb2"]=1;
			if($cust_fb2=='false')
				$data["cust_fb2"]=0;
			if($cust_tweeter2=='true')
				$data["cust_tweeter2"]=1;
			if($cust_tweeter2=='false')
				$data["cust_tweeter2"]=0;
			
			$sql="select cabang_id from cabang where cabang_id='".$cust_unit."'";
			$result=$this->db->query($sql);
			if($result->num_rows())
				$data["cust_unit"]=$cust_unit;
				
			$this->db->where('cust_id', $cust_id);
			$this->db->update('customer', $data);
			$sql="UPDATE customer SET cust_revised=(cust_revised+1) WHERE cust_id='$cust_id'";
			$this->db->query($sql);
			
			return '1';
		
		}
		
		//function for create new record
		function customer_create($cust_no ,$cust_nolama ,$cust_nama, $cust_panggilan ,$cust_kelamin ,$cust_alamat ,$cust_kota ,$cust_kodepos ,$cust_propinsi ,$cust_negara,$cust_alamat2 ,$cust_kota2 ,$cust_kodepos2 ,$cust_propinsi2 ,$cust_negara2 ,$cust_telprumah ,$cust_telprumah2 ,$cust_telpkantor ,$cust_hp ,$cust_hp2 ,$cust_hp3 ,$cust_email ,$cust_fb ,$cust_tweeter , $cust_email2 ,$cust_fb2 ,$cust_tweeter2 ,$cust_agama ,$cust_pendidikan ,$cust_profesi ,$cust_tmptlahir ,$cust_tgllahir ,$cust_hobi ,$cust_referensi,$cust_referensilain ,$cust_keterangan ,$cust_member ,$cust_terdaftar ,$cust_statusnikah , $cust_priority , $cust_jmlanak ,$cust_unit ,$cust_aktif ,$cust_creator ,$cust_date_create ,$cust_update ,$cust_date_update ,$cust_revised ,$cust_cp ,$cust_cptelp ){
			if($cust_no==''){
				//Generate Nomor Customer
				$cust_no = $this->m_public_function->get_custno_gen('customer','cust_no','',6);
			}
			
			$query =   "SELECT * FROM info";
			
			if ($cust_aktif=="")
				$cust_aktif = "Aktif";
			if ($cust_unit=="Miracle Thamrin")
				$cust_unit = 1;
			if ($cust_unit=="Miracle HR Muhammad")
				$cust_unit = 2;
			if ($cust_unit=="Corporate")
				$cust_unit = 7;
			if ($cust_unit=="Miracle Kertajaya Indah")
				$cust_unit = 8;
			if ($cust_unit=="Miracle Tunjungan Plaza")
				$cust_unit = 9;
			if ($cust_unit=="Miracle Malang")
				$cust_unit = 10;
			if ($cust_unit=="Miracle Denpasar")
				$cust_unit = 11;
			if ($cust_unit=="Miracle Kuta")
				$cust_unit = 12;
			if ($cust_unit=="Miracle Jakarta")
				$cust_unit = 13;
			if ($cust_unit=="Miracle Makassar")
				$cust_unit = 14;
			if ($cust_unit=="Miracle Balikpapan")
				$cust_unit = 15;
			if ($cust_unit=="Miracle Batam")
				$cust_unit = 16;
			if ($cust_unit=="Manyar Garden")
				$cust_unit = 17;
			if ($cust_unit=="Miracle Medan")
				$cust_unit = 18;
				
			$date_now = date('Y-m-d H:i:s');
/*			if($cust_kota=="" || $cust_kota==NULL)
				$cust_kota="Surabaya";
			if($cust_propinsi=="" || $cust_kota==NULL)
				$cust_propinsi="Jawa Timur";
			if($cust_negara=="" || $cust_kota==NULL)
				$cust_negara="Indonesia";*/
			$data = array(
				"cust_no"=>$cust_no,
				"cust_nolama"=>$cust_nolama,
				"cust_nama"=>$cust_nama,
				"cust_panggilan"=>$cust_panggilan,
				"cust_kelamin"=>$cust_kelamin,			
				"cust_alamat"=>$cust_alamat,			
				"cust_kota"=>$cust_kota,			
				"cust_kodepos"=>$cust_kodepos,			
				"cust_propinsi"=>$cust_propinsi,			
				"cust_negara"=>$cust_negara,
				"cust_alamat2"=>$cust_alamat2,
				"cust_kota2"=>$cust_kota2,			
				"cust_kodepos2"=>$cust_kodepos2,			
				"cust_propinsi2"=>$cust_propinsi2,			
				"cust_negara2"=>$cust_negara2,
				"cust_telprumah"=>$cust_telprumah,			
				"cust_telprumah2"=>$cust_telprumah2,			
				"cust_telpkantor"=>$cust_telpkantor,			
				"cust_hp"=>$cust_hp,			
				"cust_hp2"=>$cust_hp2,			
				"cust_hp3"=>$cust_hp3,			
				"cust_email"=>$cust_email,
				"cust_email2"=>$cust_email2,
				"cust_agama"=>$cust_agama,			
				"cust_pendidikan"=>$cust_pendidikan,			
				"cust_profesi"=>$cust_profesi,
				"cust_tmptlahir"=>$cust_tmptlahir,
				"cust_tgllahir"=>$cust_tgllahir,			
				"cust_hobi"=>$cust_hobi,			
				"cust_referensi"=>$cust_referensi,			
				"cust_referensilain"=>$cust_referensilain,			
				"cust_keterangan"=>$cust_keterangan,			
				"cust_terdaftar"=>$cust_terdaftar,			
				"cust_statusnikah"=>$cust_statusnikah,
				"cust_priority"=>$cust_priority,
				"cust_jmlanak"=>$cust_jmlanak,
				"cust_unit"=>$cust_unit,
				"cust_aktif"=>$cust_aktif,			
				"cust_creator"=>$_SESSION[SESSION_USERID],
				"cust_date_create"=>$date_now,
				"cust_update"=>$_SESSION[SESSION_USERID],
				"cust_date_update"=>$date_now,
				"cust_revised"=>0,
				"cust_cp"=>$cust_cp,
				"cust_cptelp"=>$cust_cptelp
			);
			if($cust_fb=='true')
				$data["cust_fb"]=1;
			if($cust_fb=='false')
				$data["cust_fb"]=0;
			if($cust_tweeter=='true')
				$data["cust_tweeter"]=1;
			if($cust_tweeter=='false')
				$data["cust_tweeter"]=0;
			if($cust_fb2=='true')
				$data["cust_fb2"]=1;
			if($cust_fb2=='false')
				$data["cust_fb2"]=0;
			if($cust_tweeter2=='true')
				$data["cust_tweeter2"]=1;
			if($cust_tweeter2=='false')
				$data["cust_tweeter2"]=0;
			$this->db->insert('customer', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function customer_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the customers at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM customer WHERE cust_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM customer WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "cust_id= ".$pkid[$i];
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
		function customer_search($cust_id ,$cust_no ,$cust_nama ,$cust_kelamin ,$cust_alamat ,$cust_alamat2 ,$cust_kota ,$cust_kodepos ,$cust_propinsi ,$cust_negara ,$cust_telprumah ,$cust_telprumah2 ,$cust_telpkantor ,$cust_hp ,$cust_hp2 ,$cust_hp3 ,$cust_email ,$cust_agama ,$cust_pendidikan ,$cust_profesi ,$cust_tgllahir ,$cust_hobi ,$cust_referensi ,$cust_keterangan ,$cust_member ,$cust_terdaftar ,$cust_statusnikah , $cust_priority , $cust_jmlanak ,$cust_unit ,$cust_aktif ,$cust_creator ,$cust_date_create ,$cust_update ,$cust_date_update ,$cust_revised ,$start,$end){
			if ($cust_aktif=="")
				$cust_aktif = "Aktif";
			//full query
			$query="SELECT * FROM vu_customer";
			
			if($cust_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_id LIKE '%".$cust_id."%'";
			};
			if($cust_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_no LIKE '%".$cust_no."%'";
			};
			if($cust_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_nama LIKE '%".$cust_nama."%'";
			};
			if($cust_kelamin!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_kelamin LIKE '%".$cust_kelamin."%'";
			};
			if($cust_alamat!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_alamat LIKE '%".$cust_alamat."%'";
			};
			if($cust_alamat2!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_alamat2 LIKE '%".$cust_alamat2."%'";
			};
			if($cust_kota!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_kota LIKE '%".$cust_kota."%'";
			};
			if($cust_kodepos!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_kodepos LIKE '%".$cust_kodepos."%'";
			};
			if($cust_propinsi!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_propinsi LIKE '%".$cust_propinsi."%'";
			};
			if($cust_negara!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_negara LIKE '%".$cust_negara."%'";
			};
			if($cust_telprumah!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_telprumah LIKE '%".$cust_telprumah."%'";
			};
			if($cust_telprumah2!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_telprumah2 LIKE '%".$cust_telprumah2."%'";
			};
			if($cust_telpkantor!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_telpkantor LIKE '%".$cust_telpkantor."%'";
			};
			if($cust_hp!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_hp LIKE '%".$cust_hp."%'";
			};
			if($cust_hp2!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_hp2 LIKE '%".$cust_hp2."%'";
			};
			if($cust_hp3!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_hp3 LIKE '%".$cust_hp3."%'";
			};
			if($cust_email!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_email LIKE '%".$cust_email."%'";
			};
			if($cust_agama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_agama LIKE '%".$cust_agama."%'";
			};
			if($cust_pendidikan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_pendidikan LIKE '%".$cust_pendidikan."%'";
			};
			if($cust_profesi!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_profesi LIKE '%".$cust_profesi."%'";
			};
			if($cust_tgllahir!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_tgllahir LIKE '%".$cust_tgllahir."%'";
			};
			if($cust_hobi!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_hobi LIKE '%".$cust_hobi."%'";
			};
			if($cust_referensi!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_referensi LIKE '%".$cust_referensi."%'";
			};
			if($cust_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_keterangan LIKE '%".$cust_keterangan."%'";
			};
			if($cust_member!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_member LIKE '%".$cust_member."%'";
			};
			if($cust_terdaftar!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_terdaftar LIKE '%".$cust_terdaftar."%'";
			};
			if($cust_statusnikah!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_statusnikah='".$cust_statusnikah."'";
			};
			if($cust_priority!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_priority='".$cust_priority."'";
			};
			if($cust_jmlanak!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_jmlanak LIKE '%".$cust_jmlanak."%'";
			};
			if($cust_unit!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_unit LIKE '%".$cust_unit."%'";
			};
			if($cust_aktif!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_aktif LIKE '%".$cust_aktif."%'";
			};
			if($cust_creator!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_creator LIKE '%".$cust_creator."%'";
			};
			if($cust_date_create!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_date_create LIKE '%".$cust_date_create."%'";
			};
			if($cust_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_update LIKE '%".$cust_update."%'";
			};
			if($cust_date_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_date_update LIKE '%".$cust_date_update."%'";
			};
			if($cust_revised!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_revised LIKE '%".$cust_revised."%'";
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
		function customer_print($cust_id ,$cust_no ,$cust_nama ,$cust_kelamin ,$cust_alamat ,$cust_alamat2 ,$cust_kota ,$cust_kodepos ,$cust_propinsi ,$cust_negara ,$cust_telprumah ,$cust_telprumah2 ,$cust_telpkantor ,$cust_hp ,$cust_hp2 ,$cust_hp3 ,$cust_email ,$cust_agama ,$cust_pendidikan ,$cust_profesi ,$cust_tgllahir ,$cust_hobi ,$cust_referensi ,$cust_keterangan ,$cust_member ,$cust_terdaftar ,$cust_statusnikah , $cust_priority , $cust_jmlanak ,$cust_unit ,$cust_aktif ,$cust_creator ,$cust_date_create ,$cust_update ,$cust_date_update ,$cust_revised ,$option,$filter){
			//full query
			$query="select * from customer";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (cust_id LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR cust_kelamin LIKE '%".addslashes($filter)."%' OR cust_alamat LIKE '%".addslashes($filter)."%' OR cust_alamat2 LIKE '%".addslashes($filter)."%' OR cust_kota LIKE '%".addslashes($filter)."%' OR cust_kodepos LIKE '%".addslashes($filter)."%' OR cust_propinsi LIKE '%".addslashes($filter)."%' OR cust_negara LIKE '%".addslashes($filter)."%' OR cust_telprumah LIKE '%".addslashes($filter)."%' OR cust_telprumah2 LIKE '%".addslashes($filter)."%' OR cust_telpkantor LIKE '%".addslashes($filter)."%' OR cust_hp LIKE '%".addslashes($filter)."%' OR cust_hp2 LIKE '%".addslashes($filter)."%' OR cust_hp3 LIKE '%".addslashes($filter)."%' OR cust_email LIKE '%".addslashes($filter)."%' OR cust_agama LIKE '%".addslashes($filter)."%' OR cust_pendidikan LIKE '%".addslashes($filter)."%' OR cust_profesi LIKE '%".addslashes($filter)."%' OR cust_tgllahir LIKE '%".addslashes($filter)."%' OR cust_hobi LIKE '%".addslashes($filter)."%' OR cust_referensi LIKE '%".addslashes($filter)."%' OR cust_keterangan LIKE '%".addslashes($filter)."%' OR cust_member LIKE '%".addslashes($filter)."%' OR cust_terdaftar LIKE '%".addslashes($filter)."%' OR cust_statusnikah LIKE '%".addslashes($filter)."%' OR cust_priority LIKE '%".addslashes($filter)."%' OR cust_jmlanak LIKE '%".addslashes($filter)."%' OR cust_unit LIKE '%".addslashes($filter)."%' OR cust_aktif LIKE '%".addslashes($filter)."%' OR cust_creator LIKE '%".addslashes($filter)."%' OR cust_date_create LIKE '%".addslashes($filter)."%' OR cust_update LIKE '%".addslashes($filter)."%' OR cust_date_update LIKE '%".addslashes($filter)."%' OR cust_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($cust_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_id LIKE '%".$cust_id."%'";
				};
				if($cust_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_no LIKE '%".$cust_no."%'";
				};
				if($cust_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_nama LIKE '%".$cust_nama."%'";
				};
				if($cust_kelamin!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_kelamin LIKE '%".$cust_kelamin."%'";
				};
				if($cust_alamat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_alamat LIKE '%".$cust_alamat."%'";
				};
				if($cust_alamat2!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_alamat2 LIKE '%".$cust_alamat2."%'";
				};
				if($cust_kota!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_kota LIKE '%".$cust_kota."%'";
				};
				if($cust_kodepos!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_kodepos LIKE '%".$cust_kodepos."%'";
				};
				if($cust_propinsi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_propinsi LIKE '%".$cust_propinsi."%'";
				};
				if($cust_negara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_negara LIKE '%".$cust_negara."%'";
				};
				if($cust_telprumah!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_telprumah LIKE '%".$cust_telprumah."%'";
				};
				if($cust_telprumah2!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_telprumah2 LIKE '%".$cust_telprumah2."%'";
				};
				if($cust_telpkantor!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_telpkantor LIKE '%".$cust_telpkantor."%'";
				};
				if($cust_hp!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_hp LIKE '%".$cust_hp."%'";
				};
				if($cust_hp2!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_hp2 LIKE '%".$cust_hp2."%'";
				};
				if($cust_hp3!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_hp3 LIKE '%".$cust_hp3."%'";
				};
				if($cust_email!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_email LIKE '%".$cust_email."%'";
				};
				if($cust_agama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_agama LIKE '%".$cust_agama."%'";
				};
				if($cust_pendidikan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_pendidikan LIKE '%".$cust_pendidikan."%'";
				};
				if($cust_profesi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_profesi LIKE '%".$cust_profesi."%'";
				};
				if($cust_tgllahir!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_tgllahir LIKE '%".$cust_tgllahir."%'";
				};
				if($cust_hobi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_hobi LIKE '%".$cust_hobi."%'";
				};
				if($cust_referensi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_referensi LIKE '%".$cust_referensi."%'";
				};
				if($cust_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_keterangan LIKE '%".$cust_keterangan."%'";
				};
				if($cust_member!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_member LIKE '%".$cust_member."%'";
				};
				if($cust_terdaftar!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_terdaftar LIKE '%".$cust_terdaftar."%'";
				};
				if($cust_statusnikah!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_statusnikah LIKE '%".$cust_statusnikah."%'";
				};
				if($cust_priority!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_priority LIKE '%".$cust_priority."%'";
				};
				if($cust_jmlanak!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_jmlanak LIKE '%".$cust_jmlanak."%'";
				};
				if($cust_unit!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_unit LIKE '%".$cust_unit."%'";
				};
				if($cust_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_aktif LIKE '%".$cust_aktif."%'";
				};
				if($cust_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_creator LIKE '%".$cust_creator."%'";
				};
				if($cust_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_date_create LIKE '%".$cust_date_create."%'";
				};
				if($cust_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_update LIKE '%".$cust_update."%'";
				};
				if($cust_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_date_update LIKE '%".$cust_date_update."%'";
				};
				if($cust_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_revised LIKE '%".$cust_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function customer_export_excel($cust_id ,$cust_no ,$cust_nama ,$cust_kelamin ,$cust_alamat ,$cust_alamat2 ,$cust_kota ,$cust_kodepos ,$cust_propinsi ,$cust_negara ,$cust_telprumah ,$cust_telprumah2 ,$cust_telpkantor ,$cust_hp ,$cust_hp2 ,$cust_hp3 ,$cust_email ,$cust_agama ,$cust_pendidikan ,$cust_profesi ,$cust_tgllahir ,$cust_hobi ,$cust_referensi ,$cust_keterangan ,$cust_member ,$cust_terdaftar ,$cust_statusnikah , $cust_priority , $cust_jmlanak ,$cust_unit ,$cust_aktif ,$cust_creator ,$cust_date_create ,$cust_update ,$cust_date_update ,$cust_revised ,$option,$filter){
			//full query
			$query="select * from customer";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (cust_id LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR cust_kelamin LIKE '%".addslashes($filter)."%' OR cust_alamat LIKE '%".addslashes($filter)."%' OR cust_alamat2 LIKE '%".addslashes($filter)."%' OR cust_kota LIKE '%".addslashes($filter)."%' OR cust_kodepos LIKE '%".addslashes($filter)."%' OR cust_propinsi LIKE '%".addslashes($filter)."%' OR cust_negara LIKE '%".addslashes($filter)."%' OR cust_telprumah LIKE '%".addslashes($filter)."%' OR cust_telprumah2 LIKE '%".addslashes($filter)."%' OR cust_telpkantor LIKE '%".addslashes($filter)."%' OR cust_hp LIKE '%".addslashes($filter)."%' OR cust_hp2 LIKE '%".addslashes($filter)."%' OR cust_hp3 LIKE '%".addslashes($filter)."%' OR cust_email LIKE '%".addslashes($filter)."%' OR cust_agama LIKE '%".addslashes($filter)."%' OR cust_pendidikan LIKE '%".addslashes($filter)."%' OR cust_profesi LIKE '%".addslashes($filter)."%' OR cust_tgllahir LIKE '%".addslashes($filter)."%' OR cust_hobi LIKE '%".addslashes($filter)."%' OR cust_referensi LIKE '%".addslashes($filter)."%' OR cust_keterangan LIKE '%".addslashes($filter)."%' OR cust_member LIKE '%".addslashes($filter)."%' OR cust_terdaftar LIKE '%".addslashes($filter)."%' OR cust_statusnikah LIKE '%".addslashes($filter)."%' OR cust_priority LIKE '%".addslashes($filter)."%' OR cust_jmlanak LIKE '%".addslashes($filter)."%'  OR cust_unit LIKE '%".addslashes($filter)."%' OR cust_aktif LIKE '%".addslashes($filter)."%' OR cust_creator LIKE '%".addslashes($filter)."%' OR cust_date_create LIKE '%".addslashes($filter)."%' OR cust_update LIKE '%".addslashes($filter)."%' OR cust_date_update LIKE '%".addslashes($filter)."%' OR cust_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($cust_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_id LIKE '%".$cust_id."%'";
				};
				if($cust_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_no LIKE '%".$cust_no."%'";
				};
				if($cust_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_nama LIKE '%".$cust_nama."%'";
				};
				if($cust_kelamin!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_kelamin LIKE '%".$cust_kelamin."%'";
				};
				if($cust_alamat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_alamat LIKE '%".$cust_alamat."%'";
				};
				if($cust_alamat2!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_alamat2 LIKE '%".$cust_alamat2."%'";
				};
				if($cust_kota!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_kota LIKE '%".$cust_kota."%'";
				};
				if($cust_kodepos!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_kodepos LIKE '%".$cust_kodepos."%'";
				};
				if($cust_propinsi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_propinsi LIKE '%".$cust_propinsi."%'";
				};
				if($cust_negara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_negara LIKE '%".$cust_negara."%'";
				};
				if($cust_telprumah!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_telprumah LIKE '%".$cust_telprumah."%'";
				};
				if($cust_telprumah2!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_telprumah2 LIKE '%".$cust_telprumah2."%'";
				};
				if($cust_telpkantor!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_telpkantor LIKE '%".$cust_telpkantor."%'";
				};
				if($cust_hp!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_hp LIKE '%".$cust_hp."%'";
				};
				if($cust_hp2!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_hp2 LIKE '%".$cust_hp2."%'";
				};
				if($cust_hp3!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_hp3 LIKE '%".$cust_hp3."%'";
				};
				if($cust_email!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_email LIKE '%".$cust_email."%'";
				};
				if($cust_agama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_agama LIKE '%".$cust_agama."%'";
				};
				if($cust_pendidikan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_pendidikan LIKE '%".$cust_pendidikan."%'";
				};
				if($cust_profesi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_profesi LIKE '%".$cust_profesi."%'";
				};
				if($cust_tgllahir!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_tgllahir LIKE '%".$cust_tgllahir."%'";
				};
				if($cust_hobi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_hobi LIKE '%".$cust_hobi."%'";
				};
				if($cust_referensi!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_referensi LIKE '%".$cust_referensi."%'";
				};
				if($cust_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_keterangan LIKE '%".$cust_keterangan."%'";
				};
				if($cust_member!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_member LIKE '%".$cust_member."%'";
				};
				if($cust_terdaftar!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_terdaftar LIKE '%".$cust_terdaftar."%'";
				};
				if($cust_statusnikah!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_statusnikah LIKE '%".$cust_statusnikah."%'";
				};
				if($cust_priority!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_priority LIKE '%".$cust_priority."%'";
				};
				if($cust_jmlanak!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_jmlanak LIKE '%".$cust_jmlanak."%'";
				};
				if($cust_unit!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_unit LIKE '%".$cust_unit."%'";
				};
				if($cust_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_aktif LIKE '%".$cust_aktif."%'";
				};
				if($cust_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_creator LIKE '%".$cust_creator."%'";
				};
				if($cust_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_date_create LIKE '%".$cust_date_create."%'";
				};
				if($cust_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_update LIKE '%".$cust_update."%'";
				};
				if($cust_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_date_update LIKE '%".$cust_date_update."%'";
				};
				if($cust_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " cust_revised LIKE '%".$cust_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>