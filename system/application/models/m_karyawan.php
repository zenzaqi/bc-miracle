<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: karyawan Model
	+ Description	: For record model process back-end
	+ Filename 		: c_karyawan.php
 	+ Author  		: Mukhlison
 	+ Created on 06/Aug/2009 17:08:43
	
*/

class M_karyawan extends Model{
		
		//constructor
		function M_karyawan() {
			parent::Model();
		}
		
		function get_karyawan_atasan_list($karyawan_id){
			$sql="SELECT karyawan_id,karyawan_nama FROM karyawan where karyawan_aktif='Aktif'";
			
			if($karyawan_id<>0){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (karyawan_id!='".addslashes($karyawan_id)."')";
			}
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
		
		function get_karyawan_jabatan_list(){
			$sql="SELECT jabatan_id,jabatan_nama FROM jabatan where jabatan_aktif='Aktif';";
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
		
		function get_karyawan_cabang_list(){
			$sql="SELECT cabang_id,cabang_nama FROM cabang where cabang_aktif='Aktif'";
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
		
		function get_karyawan_departemen_list(){
			$sql="SELECT departemen_id,departemen_nama FROM departemen where departemen_aktif='Aktif'";
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
		
		function get_karyawan_golongan_list(){
			$sql="SELECT distinct karyawan_golongan FROM karyawan WHERE karyawan_golongan<>''";
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
		function karyawan_list($filter,$start,$end){
			$query = "SELECT * FROM karyawan,departemen,cabang,jabatan where karyawan_departemen=departemen_id and karyawan_cabang=cabang_id and karyawan_jabatan=jabatan_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (karyawan_id LIKE '%".addslashes($filter)."%' OR karyawan_no LIKE '%".addslashes($filter)."%' OR karyawan_npwp LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR karyawan_kelamin LIKE '%".addslashes($filter)."%' OR karyawan_tgllahir LIKE '%".addslashes($filter)."%' OR karyawan_alamat LIKE '%".addslashes($filter)."%' OR karyawan_kota LIKE '%".addslashes($filter)."%' OR karyawan_kodepos LIKE '%".addslashes($filter)."%' OR karyawan_email LIKE '%".addslashes($filter)."%' OR karyawan_emiracle LIKE '%".addslashes($filter)."%' OR karyawan_keterangan LIKE '%".addslashes($filter)."%' OR karyawan_notelp LIKE '%".addslashes($filter)."%' OR karyawan_notelp2 LIKE '%".addslashes($filter)."%' OR karyawan_notelp3 LIKE '%".addslashes($filter)."%' OR karyawan_notelp4 LIKE '%".addslashes($filter)."%' OR karyawan_cabang LIKE '%".addslashes($filter)."%' OR karyawan_jabatan LIKE '%".addslashes($filter)."%' OR karyawan_departemen LIKE '%".addslashes($filter)."%' OR karyawan_golongan LIKE '%".addslashes($filter)."%' OR karyawan_tglmasuk LIKE '%".addslashes($filter)."%' OR karyawan_atasan LIKE '%".addslashes($filter)."%' OR karyawan_aktif LIKE '%".addslashes($filter)."%' OR karyawan_creator LIKE '%".addslashes($filter)."%' OR karyawan_date_create LIKE '%".addslashes($filter)."%' OR karyawan_update LIKE '%".addslashes($filter)."%' OR karyawan_date_update LIKE '%".addslashes($filter)."%' OR karyawan_revised LIKE '%".addslashes($filter)."%' )";
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
		function karyawan_update($karyawan_id ,$karyawan_no ,$karyawan_npwp ,$karyawan_username ,$karyawan_nama ,$karyawan_kelamin ,$karyawan_tgllahir ,$karyawan_alamat ,$karyawan_kota ,$karyawan_kodepos ,$karyawan_email ,$karyawan_emiracle ,$karyawan_keterangan ,$karyawan_notelp ,$karyawan_notelp2 ,$karyawan_notelp3, $karyawan_notelp4 ,$karyawan_cabang ,$karyawan_jabatan ,$karyawan_departemen ,$karyawan_golongan ,$karyawan_tglmasuk ,$karyawan_atasan ,$karyawan_aktif ,$karyawan_creator ,$karyawan_date_create ,$karyawan_update ,$karyawan_date_update ,$karyawan_revised ){
		if ($karyawan_aktif=="")
			$karyawan_aktif = "Aktif";
			$data = array(
				"karyawan_id"=>$karyawan_id,			
				"karyawan_no"=>$karyawan_no,			
				"karyawan_npwp"=>$karyawan_npwp,			
				"karyawan_username"=>$karyawan_username,			
				"karyawan_nama"=>$karyawan_nama,			
				"karyawan_kelamin"=>$karyawan_kelamin,			
				"karyawan_tgllahir"=>$karyawan_tgllahir,			
				"karyawan_alamat"=>$karyawan_alamat,			
				"karyawan_kota"=>$karyawan_kota,			
				"karyawan_kodepos"=>$karyawan_kodepos,			
				"karyawan_email"=>$karyawan_email,
				"karyawan_emiracle"=>$karyawan_emiracle,
				"karyawan_keterangan"=>$karyawan_keterangan,
				"karyawan_notelp"=>$karyawan_notelp,			
				"karyawan_notelp2"=>$karyawan_notelp2,			
				"karyawan_notelp3"=>$karyawan_notelp3,
				"karyawan_notelp4"=>$karyawan_notelp4,
				"karyawan_golongan"=>$karyawan_golongan,
				"karyawan_tglmasuk"=>$karyawan_tglmasuk,			
				"karyawan_atasan"=>$karyawan_atasan,			
				"karyawan_aktif"=>$karyawan_aktif,			
				"karyawan_creator"=>$karyawan_creator,			
				"karyawan_date_create"=>$karyawan_date_create,			
				"karyawan_update"=>$karyawan_update,			
				"karyawan_date_update"=>$karyawan_date_update,			
				"karyawan_revised"=>$karyawan_revised			
			);
			
			$sql="SELECT cabang_id FROM cabang WHERE cabang_id='".$karyawan_cabang."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["karyawan_cabang"]=$karyawan_cabang;
			
			$sql="SELECT jabatan_id FROM jabatan WHERE jabatan_id='".$karyawan_jabatan."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["karyawan_jabatan"]=$karyawan_jabatan;
			
			$sql="SELECT departemen_id FROM departemen WHERE departemen_id='".$karyawan_departemen."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["karyawan_departemen"]=$karyawan_departemen;
			
			$sql="SELECT karyawan_id FROM karyawan WHERE karyawan_id='".$karyawan_atasan."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["karyawan_atasan"]=$karyawan_atasan;
			
			$this->db->where('karyawan_id', $karyawan_id);
			$this->db->update('karyawan', $data);
			//die($this->db->last_query());
			return '1';
		}
		
		//function for create new record
		function karyawan_create($karyawan_no ,$karyawan_npwp ,$karyawan_username ,$karyawan_nama ,$karyawan_kelamin ,$karyawan_tgllahir ,$karyawan_alamat ,$karyawan_kota ,$karyawan_kodepos ,$karyawan_email ,$karyawan_emiracle ,$karyawan_keterangan ,$karyawan_notelp ,$karyawan_notelp2 ,$karyawan_notelp3, $karyawan_notelp4 ,$karyawan_cabang ,$karyawan_jabatan ,$karyawan_departemen ,$karyawan_golongan ,$karyawan_tglmasuk ,$karyawan_atasan ,$karyawan_aktif ,$karyawan_creator ,$karyawan_date_create ,$karyawan_update ,$karyawan_date_update ,$karyawan_revised ){
		if ($karyawan_aktif=="")
			$karyawan_aktif = "Aktif";
			$data = array(
	
				"karyawan_no"=>$karyawan_no,	
				"karyawan_npwp"=>$karyawan_npwp,	
				"karyawan_username"=>$karyawan_username,	
				"karyawan_nama"=>$karyawan_nama,	
				"karyawan_kelamin"=>$karyawan_kelamin,	
				"karyawan_tgllahir"=>$karyawan_tgllahir,	
				"karyawan_alamat"=>$karyawan_alamat,	
				"karyawan_kota"=>$karyawan_kota,	
				"karyawan_kodepos"=>$karyawan_kodepos,	
				"karyawan_email"=>$karyawan_email,	
				"karyawan_emiracle"=>$karyawan_emiracle,	
				"karyawan_keterangan"=>$karyawan_keterangan,	
				"karyawan_notelp"=>$karyawan_notelp,	
				"karyawan_notelp2"=>$karyawan_notelp2,	
				"karyawan_notelp3"=>$karyawan_notelp3,	
				"karyawan_notelp4"=>$karyawan_notelp4,
				"karyawan_cabang"=>$karyawan_cabang,	
				"karyawan_jabatan"=>$karyawan_jabatan,	
				"karyawan_departemen"=>$karyawan_departemen,	
				"karyawan_golongan"=>$karyawan_golongan,	
				"karyawan_tglmasuk"=>$karyawan_tglmasuk,	
				"karyawan_atasan"=>$karyawan_atasan,	
				"karyawan_aktif"=>$karyawan_aktif,	
				"karyawan_creator"=>$karyawan_creator,	
				"karyawan_date_create"=>$karyawan_date_create,	
				"karyawan_update"=>$karyawan_update,	
				"karyawan_date_update"=>$karyawan_date_update,	
				"karyawan_revised"=>$karyawan_revised	
			);
			$this->db->insert('karyawan', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function karyawan_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the karyawans at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM karyawan WHERE karyawan_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM karyawan WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "karyawan_id= ".$pkid[$i];
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
		function karyawan_search($karyawan_id ,$karyawan_no ,$karyawan_npwp ,$karyawan_username ,$karyawan_nama ,$karyawan_kelamin ,$karyawan_tgllahir ,$karyawan_alamat ,$karyawan_kota ,$karyawan_kodepos ,$karyawan_email ,$karyawan_emiracle ,$karyawan_keterangan ,$karyawan_notelp ,$karyawan_notelp2 ,$karyawan_notelp3, $karyawan_notelp4 ,$karyawan_cabang ,$karyawan_jabatan ,$karyawan_departemen ,$karyawan_golongan ,$karyawan_tglmasuk ,$karyawan_atasan ,$karyawan_aktif ,$karyawan_creator ,$karyawan_date_create ,$karyawan_update ,$karyawan_date_update ,$karyawan_revised ,$start,$end){
			//full query
			if($karyawan_aktif=="")
				$karyawan_aktif="Aktif";
			$query="select * from karyawan";
			
			if($karyawan_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_id LIKE '%".$karyawan_id."%'";
			};
			if($karyawan_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_no LIKE '%".$karyawan_no."%'";
			};
			if($karyawan_npwp!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_npwp LIKE '%".$karyawan_npwp."%'";
			};
			if($karyawan_username!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_username LIKE '%".$karyawan_username."%'";
			};
			if($karyawan_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_nama LIKE '%".$karyawan_nama."%'";
			};
			if($karyawan_kelamin!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_kelamin LIKE '%".$karyawan_kelamin."%'";
			};
			if($karyawan_tgllahir!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_tgllahir LIKE '%".$karyawan_tgllahir."%'";
			};
			if($karyawan_alamat!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_alamat LIKE '%".$karyawan_alamat."%'";
			};
			if($karyawan_kota!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_kota LIKE '%".$karyawan_kota."%'";
			};
			if($karyawan_kodepos!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_kodepos LIKE '%".$karyawan_kodepos."%'";
			};
			if($karyawan_email!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_email LIKE '%".$karyawan_email."%'";
			};
			if($karyawan_emiracle!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_emiracle LIKE '%".$karyawan_emiracle."%'";
			};
			if($karyawan_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_keterangan LIKE '%".$karyawan_keterangan."%'";
			};
			if($karyawan_notelp!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_notelp LIKE '%".$karyawan_notelp."%'";
			};
			if($karyawan_notelp2!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_notelp2 LIKE '%".$karyawan_notelp2."%'";
			};
			if($karyawan_notelp3!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_notelp3 LIKE '%".$karyawan_notelp3."%'";
			};
			if($karyawan_notelp4!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_notelp4 LIKE '%".$karyawan_notelp4."%'";
			};
			if($karyawan_cabang!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_cabang LIKE '%".$karyawan_cabang."%'";
			};
			if($karyawan_jabatan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_jabatan LIKE '%".$karyawan_jabatan."%'";
			};
			if($karyawan_departemen!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_departemen LIKE '%".$karyawan_departemen."%'";
			};
			if($karyawan_golongan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_golongan LIKE '%".$karyawan_golongan."%'";
			};
			if($karyawan_tglmasuk!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_tglmasuk LIKE '%".$karyawan_tglmasuk."%'";
			};
			if($karyawan_atasan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_atasan LIKE '%".$karyawan_atasan."%'";
			};
			if($karyawan_aktif!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_aktif='".$karyawan_aktif."'";
			};
			if($karyawan_creator!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_creator LIKE '%".$karyawan_creator."%'";
			};
			if($karyawan_date_create!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_date_create LIKE '%".$karyawan_date_create."%'";
			};
			if($karyawan_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_update LIKE '%".$karyawan_update."%'";
			};
			if($karyawan_date_update!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_date_update LIKE '%".$karyawan_date_update."%'";
			};
			if($karyawan_revised!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " karyawan_revised LIKE '%".$karyawan_revised."%'";
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
		function karyawan_print($karyawan_id ,$karyawan_no ,$karyawan_npwp ,$karyawan_username ,$karyawan_nama ,$karyawan_kelamin ,$karyawan_tgllahir ,$karyawan_alamat ,$karyawan_kota ,$karyawan_kodepos ,$karyawan_email ,$karyawan_emiracle ,$karyawan_keterangan ,$karyawan_notelp ,$karyawan_notelp2 ,$karyawan_notelp3, $karyawan_notelp4 ,$karyawan_cabang ,$karyawan_jabatan ,$karyawan_departemen ,$karyawan_golongan ,$karyawan_tglmasuk ,$karyawan_atasan ,$karyawan_aktif ,$karyawan_creator ,$karyawan_date_create ,$karyawan_update ,$karyawan_date_update ,$karyawan_revised ,$option,$filter){
			//full query
			$query="select * from karyawan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (karyawan_id LIKE '%".addslashes($filter)."%' OR karyawan_no LIKE '%".addslashes($filter)."%' OR karyawan_npwp LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR karyawan_kelamin LIKE '%".addslashes($filter)."%' OR karyawan_tgllahir LIKE '%".addslashes($filter)."%' OR karyawan_alamat LIKE '%".addslashes($filter)."%' OR karyawan_kota LIKE '%".addslashes($filter)."%' OR karyawan_kodepos LIKE '%".addslashes($filter)."%' OR karyawan_email LIKE '%".addslashes($filter)."%' OR karyawan_emiracle LIKE '%".addslashes($filter)."%' OR karyawan_keterangan LIKE '%".addslashes($filter)."%' OR karyawan_notelp LIKE '%".addslashes($filter)."%' OR karyawan_notelp2 LIKE '%".addslashes($filter)."%' OR karyawan_notelp3 LIKE '%".addslashes($filter)."%' OR karyawan_notelp4 LIKE '%".addslashes($filter)."%' OR karyawan_cabang LIKE '%".addslashes($filter)."%' OR karyawan_jabatan LIKE '%".addslashes($filter)."%' OR karyawan_departemen LIKE '%".addslashes($filter)."%' OR karyawan_golongan LIKE '%".addslashes($filter)."%' OR karyawan_tglmasuk LIKE '%".addslashes($filter)."%' OR karyawan_atasan LIKE '%".addslashes($filter)."%' OR karyawan_aktif LIKE '%".addslashes($filter)."%' OR karyawan_creator LIKE '%".addslashes($filter)."%' OR karyawan_date_create LIKE '%".addslashes($filter)."%' OR karyawan_update LIKE '%".addslashes($filter)."%' OR karyawan_date_update LIKE '%".addslashes($filter)."%' OR karyawan_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($karyawan_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_id LIKE '%".$karyawan_id."%'";
				};
				if($karyawan_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_no LIKE '%".$karyawan_no."%'";
				};
				if($karyawan_npwp!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_npwp LIKE '%".$karyawan_npwp."%'";
				};
				if($karyawan_username!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_username LIKE '%".$karyawan_username."%'";
				};
				if($karyawan_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_nama LIKE '%".$karyawan_nama."%'";
				};
				if($karyawan_kelamin!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_kelamin LIKE '%".$karyawan_kelamin."%'";
				};
				if($karyawan_tgllahir!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_tgllahir LIKE '%".$karyawan_tgllahir."%'";
				};
				if($karyawan_alamat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_alamat LIKE '%".$karyawan_alamat."%'";
				};
				if($karyawan_kota!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_kota LIKE '%".$karyawan_kota."%'";
				};
				if($karyawan_kodepos!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_kodepos LIKE '%".$karyawan_kodepos."%'";
				};
				if($karyawan_email!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_email LIKE '%".$karyawan_email."%'";
				};
				if($karyawan_emiracle!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_emiracle LIKE '%".$karyawan_emiracle."%'";
				};
				if($karyawan_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_keterangan LIKE '%".$karyawan_keterangan."%'";
				};
				if($karyawan_notelp!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_notelp LIKE '%".$karyawan_notelp."%'";
				};
				if($karyawan_notelp2!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_notelp2 LIKE '%".$karyawan_notelp2."%'";
				};
				if($karyawan_notelp3!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_notelp3 LIKE '%".$karyawan_notelp3."%'";
				};
				if($karyawan_notelp4!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_notelp4 LIKE '%".$karyawan_notelp4."%'";
				};
				if($karyawan_cabang!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_cabang LIKE '%".$karyawan_cabang."%'";
				};
				if($karyawan_jabatan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_jabatan LIKE '%".$karyawan_jabatan."%'";
				};
				if($karyawan_departemen!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_departemen LIKE '%".$karyawan_departemen."%'";
				};
				if($karyawan_golongan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_golongan LIKE '%".$karyawan_golongan."%'";
				};
				if($karyawan_tglmasuk!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_tglmasuk LIKE '%".$karyawan_tglmasuk."%'";
				};
				if($karyawan_atasan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_atasan LIKE '%".$karyawan_atasan."%'";
				};
				if($karyawan_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_aktif LIKE '%".$karyawan_aktif."%'";
				};
				if($karyawan_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_creator LIKE '%".$karyawan_creator."%'";
				};
				if($karyawan_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_date_create LIKE '%".$karyawan_date_create."%'";
				};
				if($karyawan_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_update LIKE '%".$karyawan_update."%'";
				};
				if($karyawan_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_date_update LIKE '%".$karyawan_date_update."%'";
				};
				if($karyawan_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_revised LIKE '%".$karyawan_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function karyawan_export_excel($karyawan_id ,$karyawan_no ,$karyawan_npwp ,$karyawan_username ,$karyawan_nama ,$karyawan_kelamin ,$karyawan_tgllahir ,$karyawan_alamat ,$karyawan_kota ,$karyawan_kodepos ,$karyawan_email ,$karyawan_emiracle ,$karyawan_keterangan ,$karyawan_notelp ,$karyawan_notelp2 ,$karyawan_notelp3, $karyawan_notelp4 ,$karyawan_cabang ,$karyawan_jabatan ,$karyawan_departemen ,$karyawan_golongan ,$karyawan_tglmasuk ,$karyawan_atasan ,$karyawan_aktif ,$karyawan_creator ,$karyawan_date_create ,$karyawan_update ,$karyawan_date_update ,$karyawan_revised ,$option,$filter){
			//full query
			$query="select * from karyawan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (karyawan_id LIKE '%".addslashes($filter)."%' OR karyawan_no LIKE '%".addslashes($filter)."%' OR karyawan_npwp LIKE '%".addslashes($filter)."%' OR karyawan_username LIKE '%".addslashes($filter)."%' OR karyawan_nama LIKE '%".addslashes($filter)."%' OR karyawan_kelamin LIKE '%".addslashes($filter)."%' OR karyawan_tgllahir LIKE '%".addslashes($filter)."%' OR karyawan_alamat LIKE '%".addslashes($filter)."%' OR karyawan_kota LIKE '%".addslashes($filter)."%' OR karyawan_kodepos LIKE '%".addslashes($filter)."%' OR karyawan_email LIKE '%".addslashes($filter)."%' OR karyawan_emiracle LIKE '%".addslashes($filter)."%' OR karyawan_keterangan LIKE '%".addslashes($filter)."%' OR karyawan_notelp LIKE '%".addslashes($filter)."%' OR karyawan_notelp2 LIKE '%".addslashes($filter)."%' OR karyawan_notelp3 LIKE '%".addslashes($filter)."%' OR karyawan_notelp4 LIKE '%".addslashes($filter)."%' OR karyawan_cabang LIKE '%".addslashes($filter)."%' OR karyawan_jabatan LIKE '%".addslashes($filter)."%' OR karyawan_departemen LIKE '%".addslashes($filter)."%' OR karyawan_golongan LIKE '%".addslashes($filter)."%' OR karyawan_tglmasuk LIKE '%".addslashes($filter)."%' OR karyawan_atasan LIKE '%".addslashes($filter)."%' OR karyawan_aktif LIKE '%".addslashes($filter)."%' OR karyawan_creator LIKE '%".addslashes($filter)."%' OR karyawan_date_create LIKE '%".addslashes($filter)."%' OR karyawan_update LIKE '%".addslashes($filter)."%' OR karyawan_date_update LIKE '%".addslashes($filter)."%' OR karyawan_revised LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($karyawan_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_id LIKE '%".$karyawan_id."%'";
				};
				if($karyawan_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_no LIKE '%".$karyawan_no."%'";
				};
				if($karyawan_npwp!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_npwp LIKE '%".$karyawan_npwp."%'";
				};
				if($karyawan_username!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_username LIKE '%".$karyawan_username."%'";
				};
				if($karyawan_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_nama LIKE '%".$karyawan_nama."%'";
				};
				if($karyawan_kelamin!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_kelamin LIKE '%".$karyawan_kelamin."%'";
				};
				if($karyawan_tgllahir!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_tgllahir LIKE '%".$karyawan_tgllahir."%'";
				};
				if($karyawan_alamat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_alamat LIKE '%".$karyawan_alamat."%'";
				};
				if($karyawan_kota!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_kota LIKE '%".$karyawan_kota."%'";
				};
				if($karyawan_kodepos!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_kodepos LIKE '%".$karyawan_kodepos."%'";
				};
				if($karyawan_email!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_email LIKE '%".$karyawan_email."%'";
				};
				if($karyawan_emiracle!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_emiracle LIKE '%".$karyawan_emiracle."%'";
				};
				if($karyawan_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_keterangan LIKE '%".$karyawan_keterangan."%'";
				};
				if($karyawan_notelp!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_notelp LIKE '%".$karyawan_notelp."%'";
				};
				if($karyawan_notelp2!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_notelp2 LIKE '%".$karyawan_notelp2."%'";
				};
				if($karyawan_notelp3!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_notelp3 LIKE '%".$karyawan_notelp3."%'";
				};
				if($karyawan_notelp4!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_notelp4 LIKE '%".$karyawan_notelp4."%'";
				};
				if($karyawan_cabang!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_cabang LIKE '%".$karyawan_cabang."%'";
				};
				if($karyawan_jabatan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_jabatan LIKE '%".$karyawan_jabatan."%'";
				};
				if($karyawan_departemen!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_departemen LIKE '%".$karyawan_departemen."%'";
				};
				if($karyawan_golongan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_golongan LIKE '%".$karyawan_golongan."%'";
				};
				if($karyawan_tglmasuk!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_tglmasuk LIKE '%".$karyawan_tglmasuk."%'";
				};
				if($karyawan_atasan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_atasan LIKE '%".$karyawan_atasan."%'";
				};
				if($karyawan_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_aktif LIKE '%".$karyawan_aktif."%'";
				};
				if($karyawan_creator!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_creator LIKE '%".$karyawan_creator."%'";
				};
				if($karyawan_date_create!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_date_create LIKE '%".$karyawan_date_create."%'";
				};
				if($karyawan_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_update LIKE '%".$karyawan_update."%'";
				};
				if($karyawan_date_update!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_date_update LIKE '%".$karyawan_date_update."%'";
				};
				if($karyawan_revised!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " karyawan_revised LIKE '%".$karyawan_revised."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		

}
?>