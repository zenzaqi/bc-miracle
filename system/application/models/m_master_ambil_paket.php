<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: paket Model
	+ Description	: For record model process back-end
	+ Filename 		: c_paket.php
 	+ Author  		: masongbee
 	+ Created on 28/Jan/2010 10:41:22
	
*/

class M_master_ambil_paket extends Model{
		
		//constructor
		function M_master_ambil_paket() {
			parent::Model();
		}
		
		function get_pengguna_paket_list($jpaket_id){
			$query = "SELECT sjpaket_id, sjpaket_cust, cust_nama, cust_no, cust_tgllahir, cust_alamat, cust_telprumah FROM submaster_jual_paket INNER JOIN customer ON(sjpaket_cust=cust_id) WHERE sjpaket_master='$jpaket_id'";
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			
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
		
		function get_history_ambil_paket($apaket_id,$start,$end){
			/* Ambil dari db.detail_ambil_paket */
			$query = "SELECT dapaket_id, dapaket_master, dapaket_dpaket, dapaket_item, dapaket_jumlah, dapaket_cust, cust_nama, rawat_nama, paket_nama, apaket_faktur FROM detail_ambil_paket INNER JOIN paket ON(dapaket_dpaket=paket_id) LEFT JOIN perawatan ON(dapaket_item=rawat_id) LEFT JOIN master_ambil_paket ON(dapaket_master=apaket_id) LEFT JOIN customer ON(dapaket_cust=cust_id) WHERE dapaket_master='$apaket_id'";
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
		
		//Ambil Perawatan berdasarkan db.paket_isi_perawatan.rpaket_perawatan yang dihasilkan dari (db.paket_isi_perawatan.rpaket_master = paket.paket_id)
		function get_isi_rawat_list($paket_id,$start,$end){
			$rs_rows=0;
			if(is_numeric($paket_id)==true){
				$sql_rpaket="SELECT distinct(rpaket_perawatan) FROM paket_isi_perawatan WHERE rpaket_master='$paket_id'";
				$rs=$this->db->query($sql_rpaket);
				$rs_rows=$rs->num_rows();
				
				/* CHeck di db.master_ambil_paket dan db.submaster_apaket_item => JIKA pada submaster masih kosong maka jumlah item mengambil dari db.paket_isi_perawatan */
				
				//$sql="SELECT rawat_id,rawat_kode,rawat_nama,rpaket_jumlah FROM perawatan INNER JOIN paket_isi_perawatan ON(perawatan.rawat_id=paket_isi_perawatan.rpaket_perawatan) WHERE rawat_aktif='Aktif'";//join dr tabel: perawatan,produk_group,kategori2,kategori,jenis,gudang
				//$sql="SELECT rawat_id,rawat_kode,rawat_nama,sapaket_sisa_item FROM perawatan INNER JOIN submaster_apaket_item ON(perawatan.rawat_id=submaster_apaket_item.sapaket_item) WHERE rawat_aktif='Aktif'";
				$sql="SELECT rawat_id,rawat_kode,rawat_nama,sapaket_sisa_item FROM perawatan INNER JOIN submaster_apaket_item ON(perawatan.rawat_id=submaster_apaket_item.sapaket_item) WHERE (rawat_aktif='Aktif' OR rawat_aktif='Tidak Aktif')";
				
				if($rs_rows){
					$filter="";
					$sql.=eregi("AND",$paket_id)? " OR ":" AND ";
					foreach($rs->result() as $row_rpaket){
						
						$filter.="OR rawat_id='".$row_rpaket->rpaket_perawatan."' ";
					}
					$sql=$sql."(".substr($filter,2,strlen($filter)).")";
				}
				
				//$sql="SELECT rawat_id,rawat_nama,rawat_kode FROM paket_isi_perawatan INNER JOIN perawatan ON(rpaket_perawatan=rawat_id) WHERE rpaket_master='$paket_id'";
				$result = $this->db->query($sql);
				$nbrows = $result->num_rows();
				$limit = $sql." LIMIT ".$start.",".$end;			
				//echo $limit;
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
		}
		
		//function for detail
		//get record list
		function detail_ambil_paket_isi_perawatan_list($master_id,$query,$start,$end) {
			$query = "SELECT rpaket_id,rpaket_perawatan,rpaket_jumlah FROM paket_isi_perawatan WHERE rpaket_master='".$master_id."'";
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
			$query = "SELECT max(paket_id) as master_id from paket";
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
		function detail_ambil_paket_isi_perawatan_purge($master_id){
			$sql="DELETE from paket_isi_perawatan where rpaket_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_ambil_paket_isi_perawatan_insert($rambil_paket_id ,$rambil_paket_master ,$rambil_paket_perawatan ,$rambil_paket_jumlah ,$rambil_paket_cust){
			//if master id not capture from view then capture it from max pk from master table
			/*if($rambil_paket_master=="" || $rambil_paket_master==NULL){
				$rambil_paket_master=$this->get_master_id();
			}*/
			if($rambil_paket_cust==""){
				$sql="SELECT jpaket_cust FROM master_ambil_paket INNER JOIN detail_jual_paket ON(dpaket_id=apaket_dpaket) INNER JOIN master_jual_paket ON(jpaket_id=dpaket_master) WHERE apaket_id='$rambil_paket_master'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$rs_record=$rs->row_array();
					$rambil_paket_cust=$rs_record["jpaket_cust"];
				}
			}
			
			/* INSERT ke db.detail_ambil sebagai History Pengambilan Paket, kemudian UPDATE db.submaster_apaket_item.sapaket_sisa_item u/ mengetahui sisa setelah dilakukan pengambilan, dan UPDATE db.master_ambil_paket.apaket_sisa_paket u/ mengetahui sisa isi paket */
			$data=array(
			"dapaket_master"=>$rambil_paket_master,
			"dapaket_dpaket"=>$rambil_paket_id,
			"dapaket_item"=>$rambil_paket_perawatan,
			"dapaket_jumlah"=>$rambil_paket_jumlah,
			"dapaket_cust"=>$rambil_paket_cust
			);
			$this->db->insert('detail_ambil_paket', $data);
			if($this->db->affected_rows()){
				/* UPDATE db.submaster_apaket_item.sapaket_sisa_item WHERE db.submaster_apaket_item.sapaket_master = $rambil_paket_master AND db.submaster_apaket_item.sapaket_item = $rambil_paket_perawatan */
				$sql_sapaket="SELECT sapaket_sisa_item FROM submaster_apaket_item WHERE sapaket_master='$rambil_paket_master' AND sapaket_item='$rambil_paket_perawatan'";
				$rs_sapaket=$this->db->query($sql_sapaket);
				$rs_sapaket_record=$rs_sapaket->row_array();
				
				$sapaket_sisa_item_temp=$rs_sapaket_record["sapaket_sisa_item"]-$rambil_paket_jumlah;
				$dtu_sapaket=array(
				"sapaket_sisa_item"=>$sapaket_sisa_item_temp
				);
				$this->db->where('sapaket_master', $rambil_paket_master);
				$this->db->where('sapaket_item', $rambil_paket_perawatan);
				$this->db->where('sapaket_jenis_item', 'perawatan');
				$this->db->update('submaster_apaket_item', $dtu_sapaket);
				
				/* UPDATE db.master_ambil_paket.apaket_sisa_paket */
				$sql_apaket="SELECT apaket_sisa_paket FROM master_ambil_paket WHERE apaket_id='$rambil_paket_master'";
				$rs_apaket=$this->db->query($sql_apaket);
				$rs_apaket_record=$rs_apaket->row_array();
				
				$dtu_apaket=array(
				"apaket_sisa_paket"=>$rs_apaket_record["apaket_sisa_paket"]-$rambil_paket_jumlah
				);
				$this->db->where('apaket_id', $rambil_paket_master);
				$this->db->update('master_ambil_paket', $dtu_apaket);
				
				return '1';
			}else
				return '0';

		}
		//end of function
		
		//function for get list record
		function ambil_paket_list($filter,$start,$end){
			/* Untuk menampilkan ke View.LIST = {Customer, No.Faktur Penjualan Paket, Tanggal Pembelian, Tanggal Expired Paket, Nama Paket } */
			//$query = "SELECT customer.cust_id, customer.cust_nama, customer.cust_no, master_jual_paket.jpaket_id, master_jual_paket.jpaket_nobukti, master_jual_paket.jpaket_tanggal, detail_jual_paket.dpaket_id, detail_jual_paket.dpaket_kadaluarsa, paket.paket_id, paket.paket_nama, paket.paket_kode, produk_group.group_nama, master_ambil_paket.apaket_sisa_paket, master_ambil_paket.apaket_id FROM master_ambil_paket INNER JOIN master_jual_paket ON(master_ambil_paket.apaket_faktur=master_jual_paket.jpaket_nobukti) LEFT JOIN detail_jual_paket ON(detail_jual_paket.dpaket_paket=master_ambil_paket.apaket_paket AND detail_jual_paket.dpaket_master=master_jual_paket.jpaket_id) LEFT JOIN paket ON(paket.paket_id=detail_jual_paket.dpaket_paket) LEFT JOIN customer ON(master_jual_paket.jpaket_cust=customer.cust_id) LEFT JOIN produk_group ON(paket.paket_group=produk_group.group_id)";
			$query = "SELECT customer.cust_id, customer.cust_nama, customer.cust_no, master_jual_paket.jpaket_id, master_jual_paket.jpaket_nobukti, master_jual_paket.jpaket_tanggal, detail_jual_paket.dpaket_id, detail_jual_paket.dpaket_kadaluarsa, paket.paket_id, paket.paket_nama, paket.paket_kode, master_ambil_paket.apaket_sisa_paket, master_ambil_paket.apaket_id FROM master_ambil_paket INNER JOIN detail_jual_paket ON(dpaket_id=apaket_dpaket) LEFT JOIN master_jual_paket ON(jpaket_id=dpaket_master) LEFT JOIN customer ON(cust_id=jpaket_cust) LEFT JOIN paket ON(paket_id=dpaket_paket)";

			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (cust_nama LIKE '%".addslashes($filter)."%')";
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
		function ambil_paket_update($paket_id ,$paket_kode ,$paket_nama ,$paket_group ,$paket_expired ){
			/* Check di db.master_ambil_paket apakah No.Faktur Penjualan Paket && Paket_ID telah ada di db.master_ambil_paket ? */
			$data = array(
				"paket_id"=>$paket_id, 
				"paket_kode"=>$paket_kode, 
				"paket_nama"=>$paket_nama, 
				"paket_group"=>$paket_group, 
				"paket_expired"=>$paket_expired
			);
			$this->db->where('paket_id', $paket_id);
			$this->db->update('paket', $data);
			
			return '1';
		}
		
		//function for create new record
		function ambil_paket_create($paket_kode ,$paket_nama ,$paket_group ,$paket_expired ){
			$data = array(
				"paket_kode"=>$paket_kode, 
				"paket_nama"=>$paket_nama, 
				"paket_group"=>$paket_group, 
				"paket_expired"=>$paket_expired
			);
			$this->db->insert('paket', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function ambil_paket_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the pakets at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM paket WHERE paket_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM paket WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "paket_id= ".$pkid[$i];
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
		function ambil_paket_search($paket_id ,$paket_kode ,$paket_nama ,$paket_group ,$paket_expired ,$start,$end){
			//full query
			$query="select * from paket";
			
			if($paket_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " paket_id LIKE '%".$paket_id."%'";
			};
			if($paket_kode!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " paket_kode LIKE '%".$paket_kode."%'";
			};
			if($paket_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " paket_nama LIKE '%".$paket_nama."%'";
			};
			if($paket_group!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " paket_group LIKE '%".$paket_group."%'";
			};
			if($paket_expired!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " paket_expired LIKE '%".$paket_expired."%'";
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
		function ambil_paket_print($paket_id ,$paket_kode ,$paket_nama ,$paket_group ,$paket_expired ,$option,$filter){
			//full query
			$query="select * from paket";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (paket_id LIKE '%".addslashes($filter)."%' OR paket_kode LIKE '%".addslashes($filter)."%' OR paket_nama LIKE '%".addslashes($filter)."%' OR paket_group LIKE '%".addslashes($filter)."%' OR paket_expired LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($paket_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_id LIKE '%".$paket_id."%'";
				};
				if($paket_kode!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_kode LIKE '%".$paket_kode."%'";
				};
				if($paket_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_nama LIKE '%".$paket_nama."%'";
				};
				if($paket_group!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_group LIKE '%".$paket_group."%'";
				};
				if($paket_expired!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_expired LIKE '%".$paket_expired."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function ambil_paket_export_excel($paket_id ,$paket_kode ,$paket_nama ,$paket_group ,$paket_expired ,$option,$filter){
			//full query
			$query="select * from paket";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (paket_id LIKE '%".addslashes($filter)."%' OR paket_kode LIKE '%".addslashes($filter)."%' OR paket_nama LIKE '%".addslashes($filter)."%' OR paket_group LIKE '%".addslashes($filter)."%' OR paket_expired LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($paket_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_id LIKE '%".$paket_id."%'";
				};
				if($paket_kode!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_kode LIKE '%".$paket_kode."%'";
				};
				if($paket_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_nama LIKE '%".$paket_nama."%'";
				};
				if($paket_group!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_group LIKE '%".$paket_group."%'";
				};
				if($paket_expired!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_expired LIKE '%".$paket_expired."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>