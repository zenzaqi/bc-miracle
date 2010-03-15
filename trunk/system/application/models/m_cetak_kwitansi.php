<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: cetak_kwitansi Model
	+ Description	: For record model process back-end
	+ Filename 		: c_cetak_kwitansi.php
 	+ Author  		: masongbee
 	+ Created on 26/Jan/2010 12:21:55
	
*/

class M_cetak_kwitansi extends Model{
		
		//constructor
		function M_cetak_kwitansi() {
			parent::Model();
		}
		
		function get_customer_kwitansi_list($query,$start,$end){
			$sql="SELECT cust_id,cust_no,cust_nama,cust_tgllahir,cust_alamat,cust_telprumah
			FROM customer where cust_aktif='Aktif'";
			if($query<>""){
				$sql=$sql." and (cust_no like '%".$query."%' or cust_nama like '%".$query."%' or cust_telprumah like '%".$query."%' or cust_telprumah2 like '%".$query."%' or cust_telpkantor like '%".$query."%' or cust_hp like '%".$query."%' or cust_hp2 like '%".$query."%' or cust_hp3 like '%".$query."%') ";
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
		
		//function for detail
		//get record list
		function detail_jual_kwitansi_list($master_id,$query,$start,$end) {
			//$query = "SELECT * FROM jual_kwitansi WHERE jkwitansi_master='".$master_id."'";
			$query = "SELECT vu_catatan_kwitansi.jkwitansi_id, vu_catatan_kwitansi.jkwitansi_master, vu_catatan_kwitansi.jkwitansi_ref, vu_catatan_kwitansi.jkwitansi_nilai, vu_catatan_kwitansi.customer_id, customer.cust_nama AS customer_nama, customer.cust_no AS customer_no FROM (select jkwitansi_id, jkwitansi_master, jkwitansi_ref, jkwitansi_nilai, if(jproduk_cust!='null',jproduk_cust,if(jrawat_cust!='null',jrawat_cust,jpaket_cust)) AS customer_id FROM jual_kwitansi LEFT JOIN master_jual_produk on(jkwitansi_ref=jproduk_nobukti) LEFT JOIN master_jual_rawat on(jkwitansi_ref=jrawat_nobukti) LEFT JOIN master_jual_paket ON(jkwitansi_ref=jpaket_nobukti)) as vu_catatan_kwitansi LEFT JOIN customer ON(vu_catatan_kwitansi.customer_id=customer.cust_id) WHERE jkwitansi_master='$master_id'";
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
			$query = "SELECT max(kwitansi_id) as master_id from cetak_kwitansi";
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
		function detail_jual_kwitansi_purge($master_id){
			$sql="DELETE from jual_kwitansi where jkwitansi_no='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_jual_kwitansi_insert($jkwitansi_id ,$jkwitansi_master ,$jkwitansi_no ,$jkwitansi_nilai ,$jkwitansi_ref ,$jkwitansi_creator ,$jkwitansi_date_create ,$jkwitansi_update ,$jkwitansi_date_update ,$jkwitansi_revised ){
			//if master id not capture from view then capture it from max pk from master table
			if($jkwitansi_no=="" || $jkwitansi_no==NULL){
				$jkwitansi_no=$this->get_master_id();
			}
			
			$data = array(
				"jkwitansi_master"=>$jkwitansi_master, 
				"jkwitansi_no"=>$jkwitansi_no, 
				"jkwitansi_nilai"=>$jkwitansi_nilai, 
				"jkwitansi_ref"=>$jkwitansi_ref, 
				"jkwitansi_creator"=>$jkwitansi_creator, 
				"jkwitansi_date_create"=>$jkwitansi_date_create, 
				"jkwitansi_update"=>$jkwitansi_update, 
				"jkwitansi_date_update"=>$jkwitansi_date_update, 
				"jkwitansi_revised"=>$jkwitansi_revised 
			);
			$this->db->insert('jual_kwitansi', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function cetak_kwitansi_list($filter,$start,$end){
			$query = "SELECT kwitansi_id, kwitansi_no, kwitansi_cust, cust_nama, cust_no, kwitansi_cara, kwitansi_nilai, kwitansi_keterangan, kwitansi_status, kwitansi_creator, kwitansi_date_create, kwitansi_update, kwitansi_date_update, kwitansi_revised, sum(jkwitansi_nilai) AS total_terpakai, IF((kwitansi_nilai-(IF(sum(jkwitansi_nilai),sum(jkwitansi_nilai),0)))=0,kwitansi_nilai,(kwitansi_nilai-(IF(sum(jkwitansi_nilai),sum(jkwitansi_nilai),0)))) AS total_sisa FROM cetak_kwitansi LEFT JOIN jual_kwitansi ON(jkwitansi_master=kwitansi_id) LEFT JOIN customer ON(kwitansi_cust=cust_id) GROUP BY kwitansi_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (kwitansi_id LIKE '%".addslashes($filter)."%' OR kwitansi_no LIKE '%".addslashes($filter)."%' OR kwitansi_cust LIKE '%".addslashes($filter)."%' OR kwitansi_ref LIKE '%".addslashes($filter)."%' OR kwitansi_nilai LIKE '%".addslashes($filter)."%' OR kwitansi_keterangan LIKE '%".addslashes($filter)."%' OR kwitansi_status LIKE '%".addslashes($filter)."%' )";
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
		function cetak_kwitansi_update($kwitansi_id ,$kwitansi_no ,$kwitansi_cust ,$kwitansi_ref ,$kwitansi_nilai ,$kwitansi_keterangan ,$kwitansi_status ){
			$data = array(
				"kwitansi_id"=>$kwitansi_id, 
				"kwitansi_no"=>$kwitansi_no, 
				//"kwitansi_cust"=>$kwitansi_cust, 
				"kwitansi_ref"=>$kwitansi_ref, 
				"kwitansi_nilai"=>$kwitansi_nilai, 
				"kwitansi_keterangan"=>$kwitansi_keterangan, 
				"kwitansi_status"=>$kwitansi_status 
			);
			$sql="SELECT cust_id FROM customer WHERE cust_id='$kwitansi_cust'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["kwitansi_cust"]=$kwitansi_cust;
			$this->db->where('kwitansi_id', $kwitansi_id);
			$this->db->update('cetak_kwitansi', $data);
			
			return '1';
		}
		
		//function for create new record
		function cetak_kwitansi_create($kwitansi_no ,$kwitansi_cust ,$kwitansi_ref ,$kwitansi_nilai ,$kwitansi_keterangan ,$kwitansi_status ,$kwitansi_cara ,$kwitansi_tunai_nilai ,$kwitansi_card_nama ,$kwitansi_card_edc ,$kwitansi_card_no ,$kwitansi_card_nilai ,$kwitansi_cek_nama ,$kwitansi_cek_no ,$kwitansi_cek_valid ,$kwitansi_cek_bank ,$kwitansi_cek_nilai ,$kwitansi_transfer_bank ,$kwitansi_transfer_nama ,$kwitansi_transfer_nilai ){
			if($kwitansi_status=="")
				$kwitansi_status="Aktif";
			
			//$pattern="KW/".date('ym')."-";
			$pattern="KU/".date('ym')."-";
			$kwitansi_no=$this->m_public_function->get_kode_1("cetak_kwitansi","kwitansi_no",$pattern,12);
			$data = array(
				"kwitansi_no"=>$kwitansi_no, 
				"kwitansi_cust"=>$kwitansi_cust, 
				"kwitansi_ref"=>$kwitansi_ref, 
				"kwitansi_nilai"=>$kwitansi_nilai, 
				"kwitansi_keterangan"=>$kwitansi_keterangan, 
				"kwitansi_status"=>$kwitansi_status,
				"kwitansi_cara"=>$kwitansi_cara
			);
			$this->db->insert('cetak_kwitansi', $data); 
			if($this->db->affected_rows()){
				$id_cetak = $this->db->insert_id();
				
				if($kwitansi_cara!=null || $kwitansi_cara!=''){
					if($kwitansi_cara=='card'){
						
						$data=array(
							"jcard_nama"=>$kwitansi_card_nama,
							"jcard_edc"=>$kwitansi_card_edc,
							"jcard_no"=>$kwitansi_card_no,
							"jcard_nilai"=>$kwitansi_card_nilai,
							"jcard_ref"=>$kwitansi_no
							);
						$this->db->insert('jual_card', $data); 
					
					}else if($kwitansi_cara=='cek/giro'){
						
						if($kwitansi_cek_nama=="" || $kwitansi_cek_nama==NULL){
							if(is_int($kwitansi_cek_nama)){
								$sql="select cust_nama from customer where cust_id='".$kwitansi_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$kwitansi_cek_nama=$data->cust_nama;
								}
							}else{
									$kwitansi_cek_nama=$kwitansi_cust;
							}
						}
						$data=array(
							"jcek_nama"=>$kwitansi_cek_nama,
							"jcek_no"=>$kwitansi_cek_no,
							"jcek_valid"=>$kwitansi_cek_valid,
							"jcek_bank"=>$kwitansi_cek_bank,
							"jcek_nilai"=>$kwitansi_cek_nilai,
							"jcek_ref"=>$kwitansi_no
							);
						$this->db->insert('jual_cek', $data); 
					}else if($kwitansi_cara=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$kwitansi_transfer_bank,
							"jtransfer_nama"=>$kwitansi_transfer_nama,
							"jtransfer_nilai"=>$kwitansi_transfer_nilai,
							"jtransfer_ref"=>$kwitansi_no
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($kwitansi_cara=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$kwitansi_tunai_nilai,
							"jtunai_ref"=>$kwitansi_no
							);
						$this->db->insert('jual_tunai', $data); 
					}
				}
				return $id_cetak;
			}else
				return '0';
		}
		
		//fcuntion for delete record
		function cetak_kwitansi_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the cetak_kwitansis at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM cetak_kwitansi WHERE kwitansi_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM cetak_kwitansi WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "kwitansi_id= ".$pkid[$i];
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
		function cetak_kwitansi_search($kwitansi_id ,$kwitansi_no ,$kwitansi_cust ,$kwitansi_ref ,$kwitansi_nilai ,$kwitansi_keterangan ,$kwitansi_status ,$start,$end){
			//full query
			$query="select * from cetak_kwitansi";
			
			if($kwitansi_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kwitansi_id LIKE '%".$kwitansi_id."%'";
			};
			if($kwitansi_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kwitansi_no LIKE '%".$kwitansi_no."%'";
			};
			if($kwitansi_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kwitansi_cust LIKE '%".$kwitansi_cust."%'";
			};
			if($kwitansi_ref!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kwitansi_ref LIKE '%".$kwitansi_ref."%'";
			};
			if($kwitansi_nilai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kwitansi_nilai LIKE '%".$kwitansi_nilai."%'";
			};
			if($kwitansi_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kwitansi_keterangan LIKE '%".$kwitansi_keterangan."%'";
			};
			if($kwitansi_status!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " kwitansi_status LIKE '%".$kwitansi_status."%'";
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
		function cetak_kwitansi_print($kwitansi_id ,$kwitansi_no ,$kwitansi_cust ,$kwitansi_ref ,$kwitansi_nilai ,$kwitansi_keterangan ,$kwitansi_status ,$option,$filter){
			//full query
			$query="select * from cetak_kwitansi";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (kwitansi_id LIKE '%".addslashes($filter)."%' OR kwitansi_no LIKE '%".addslashes($filter)."%' OR kwitansi_cust LIKE '%".addslashes($filter)."%' OR kwitansi_ref LIKE '%".addslashes($filter)."%' OR kwitansi_nilai LIKE '%".addslashes($filter)."%' OR kwitansi_keterangan LIKE '%".addslashes($filter)."%' OR kwitansi_status LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($kwitansi_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_id LIKE '%".$kwitansi_id."%'";
				};
				if($kwitansi_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_no LIKE '%".$kwitansi_no."%'";
				};
				if($kwitansi_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_cust LIKE '%".$kwitansi_cust."%'";
				};
				if($kwitansi_ref!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_ref LIKE '%".$kwitansi_ref."%'";
				};
				if($kwitansi_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_nilai LIKE '%".$kwitansi_nilai."%'";
				};
				if($kwitansi_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_keterangan LIKE '%".$kwitansi_keterangan."%'";
				};
				if($kwitansi_status!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_status LIKE '%".$kwitansi_status."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function cetak_kwitansi_export_excel($kwitansi_id ,$kwitansi_no ,$kwitansi_cust ,$kwitansi_ref ,$kwitansi_nilai ,$kwitansi_keterangan ,$kwitansi_status ,$option,$filter){
			//full query
			$query="select * from cetak_kwitansi";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (kwitansi_id LIKE '%".addslashes($filter)."%' OR kwitansi_no LIKE '%".addslashes($filter)."%' OR kwitansi_cust LIKE '%".addslashes($filter)."%' OR kwitansi_ref LIKE '%".addslashes($filter)."%' OR kwitansi_nilai LIKE '%".addslashes($filter)."%' OR kwitansi_keterangan LIKE '%".addslashes($filter)."%' OR kwitansi_status LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($kwitansi_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_id LIKE '%".$kwitansi_id."%'";
				};
				if($kwitansi_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_no LIKE '%".$kwitansi_no."%'";
				};
				if($kwitansi_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_cust LIKE '%".$kwitansi_cust."%'";
				};
				if($kwitansi_ref!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_ref LIKE '%".$kwitansi_ref."%'";
				};
				if($kwitansi_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_nilai LIKE '%".$kwitansi_nilai."%'";
				};
				if($kwitansi_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_keterangan LIKE '%".$kwitansi_keterangan."%'";
				};
				if($kwitansi_status!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " kwitansi_status LIKE '%".$kwitansi_status."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		function print_paper($kwitansi_id){
			
			$sql="select kwitansi_id,kwitansi_no,kwitansi_date_create,
					cust_no,cust_nama,kwitansi_nilai,kwitansi_keterangan from cetak_kwitansi,customer
					where kwitansi_cust=cust_id AND kwitansi_id='".$kwitansi_id."'";
			$result = $this->db->query($sql);
			return $result;
		}
		
}
?>