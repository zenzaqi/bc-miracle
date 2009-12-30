<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: perawatan Model
	+ Description	: For record model process back-end
	+ Filename 		: c_perawatan.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 20/Aug/2009 10:26:32
	
*/

class M_perawatan extends Model{
		
		//constructor
		function M_perawatan() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_perawatan_konsumsi_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM perawatan_konsumsi where krawat_master='".$master_id."'";
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
		
		//get record list
		function detail_perawatan_alat_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM perawatan_alat where arawat_master='".$master_id."'";
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
			$query = "SELECT max(rawat_id) as master_id from perawatan";
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
		function detail_perawatan_konsumsi_purge($master_id){
			$sql="DELETE from perawatan_konsumsi where krawat_master='".$master_id."'";
			$result=$this->db->query($sql);
			return '1';
		}
		//*eof
		
		//purge all detail from master
		function detail_perawatan_alat_purge($master_id){
			$sql="DELETE from perawatan_alat where arawat_master='".$master_id."'";
			$result=$this->db->query($sql);
			return '1';
		}
		//*eof
		
		//insert detail record
		function detail_perawatan_konsumsi_insert($krawat_id ,$krawat_master ,$krawat_produk ,$krawat_satuan ,$krawat_jumlah ){
			//if master id not capture from view then capture it from max pk from master table
			if($krawat_master=="" || $krawat_master==NULL){
				$krawat_master=$this->get_master_id();
			}
			
			$data = array(
				"krawat_master"=>$krawat_master, 
				"krawat_produk"=>$krawat_produk, 
				"krawat_satuan"=>$krawat_satuan, 
				"krawat_jumlah"=>$krawat_jumlah 
			);
			$this->db->insert('perawatan_konsumsi', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//insert detail record
		function detail_perawatan_alat_insert($arawat_id ,$arawat_master ,$arawat_alat ,$arawat_jumlah ){
			//if master id not capture from view then capture it from max pk from master table
			if($arawat_master=="" || $arawat_master==NULL){
				$arawat_master=$this->get_master_id();
			}
			
			$data = array(
				"arawat_master"=>$arawat_master, 
				"arawat_alat"=>$arawat_alat, 
				"arawat_jumlah"=>$arawat_jumlah 
			);
			$this->db->insert('perawatan_alat', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		/*function get_kode($pattern_g,$pattern_j){
			$result=$this->m_public_function->get_kode_2("perawatan","rawat_kode",$pattern_g,$pattern_j,6);
			return $result;
		}
		*/
		
		function get_kontribusi_rawat_list(){
			$sql="SELECT kategori2_id,kategori2_nama FROM kategori2 LEFT JOIN kategori ON(kategori2.kategori2_jenis=kategori.kategori_id) WHERE kategori_jenis='perawatan' and kategori2_aktif='Aktif'";
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
		
		
		function get_kode($pattern){
			$result=$this->m_public_function->get_kode_1("perawatan","rawat_kode",$pattern,6);
			return $result;
		}
		
		//function for get list record
		function perawatan_list($filter,$start,$end){
			$query = "SELECT * from vu_perawatan";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (rawat_kode LIKE '%".addslashes($filter)."%' OR rawat_kodelama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR group_nama LIKE '%".addslashes($filter)."%' OR jenis_nama LIKE '%".addslashes($filter)."%' OR kategori_nama LIKE '%".addslashes($filter)."%')";
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
		function perawatan_update($rawat_id ,$rawat_kode ,$rawat_kodelama ,$rawat_nama ,$rawat_group ,$rawat_kategori,$rawat_kontribusi ,$rawat_jenis ,$rawat_keterangan ,$rawat_du ,$rawat_dm ,$rawat_point ,$rawat_harga ,$rawat_gudang ,$rawat_aktif ){
			if ($rawat_aktif=="")
				$rawat_aktif = "Aktif";
				
			$data = array(
				"rawat_id"=>$rawat_id, 
//				"rawat_kode"=>$rawat_kode, 
				"rawat_kodelama"=>$rawat_kodelama, 
				"rawat_nama"=>$rawat_nama, 
//				"rawat_group"=>$rawat_group, 
//				"rawat_kategori"=>$rawat_kategori, 
				"rawat_keterangan"=>$rawat_keterangan, 
//				"rawat_du"=>$rawat_du, 
//				"rawat_dm"=>$rawat_dm, 
				"rawat_point"=>$rawat_point, 
				"rawat_harga"=>$rawat_harga, 
//				"rawat_gudang"=>$rawat_gudang, 
				"rawat_aktif"=>$rawat_aktif 
			);
			$sql="SELECT group_id,group_durawat,group_dmrawat FROM produk_group WHERE group_id='".$rawat_group."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$data["rawat_group"]=$rawat_group;
				$rs_sql=$rs->row();
				$data["rawat_du"]=$rs_sql->group_durawat;
				$data["rawat_dm"]=$rs_sql->group_dmrawat;
			}
			
			$sql="SELECT kategori_id FROM kategori WHERE kategori_id='".$rawat_kategori."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["rawat_kategori"]=$rawat_kategori;
				
			$sql="SELECT kategori2_id FROM kategori2 WHERE kategori2_id='".$rawat_kontribusi."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["rawat_kontribusi"]=$rawat_kontribusi;
			
			$sql="SELECT jenis_id FROM jenis WHERE jenis_id='".$rawat_jenis."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["rawat_jenis"]=$rawat_jenis;
				
			$sql="SELECT gudang_id FROM gudang WHERE gudang_id='".$rawat_gudang."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["rawat_gudang"]=$rawat_gudang;
			
			/*$sql="SELECT * FROM perawatan WHERE rawat_id='".$rawat_id."' AND rawat_group='".$rawat_group."' AND rawat_jenis='".$rawat_jenis."'";
			$rs=$this->db->query($sql);
			if(!($rs->num_rows())){
				$sql_g="SELECT group_id,group_kode FROM produk_group WHERE group_id='".$rawat_group."'";
				$rs_g=$this->db->query($sql_g);
				if($rs_g->num_rows()){
					$rs_sql_g=$rs_g->row();
					$group_kode=$rs_sql_g->group_kode;
					$data["rawat_group"]=$rawat_group;
				}else{
					$sql_g="SELECT group_kode FROM perawatan,produk_group WHERE rawat_group=group_id AND rawat_id='".$rawat_id."'";
					$rs_g=$this->db->query($sql_g);
					if($rs_g->num_rows()){
						$rs_sql_g=$rs_g->row();
						$group_kode=$rs_sql_g->group_kode;
					}
				}
				
				$sql_j="SELECT jenis_id,jenis_kode FROM jenis WHERE jenis_id='".$rawat_jenis."'";
				$rs_j=$this->db->query($sql_j);
				if($rs_j->num_rows()){
					$rs_sql_j=$rs_j->row();
					$jenis_kode=$rs_sql_j->jenis_kode;
					$data["rawat_jenis"]=$rawat_jenis;
				}else{
					$sql_j="SELECT jenis_kode FROM perawatan,jenis WHERE rawat_jenis=jenis_id AND rawat_id='".$rawat_id."'";
					$rs_j=$this->db->query($sql_j);
					if($rs_j->num_rows()){
						$rs_sql_j=$rs_j->row();
						$jenis_kode=$rs_sql_j->jenis_kode;
					}
				}
				$data["rawat_kode"]=$this->get_kode($group_kode,$jenis_kode);
			}*/
			
			//generate rawat kode
			//get group kode
			$group_kode="";
			$jenis_kode="";
			
			$sql_g="SELECT group_id,group_kode FROM produk_group WHERE group_id='".$rawat_group."'";
			$rs_g=$this->db->query($sql_g);
			if($rs_g->num_rows()){
				$rs_sql_g=$rs_g->row();
				$group_kode=$rs_sql_g->group_kode;
				$data["rawat_group"]=$rawat_group;
			}else{
				$sql_q="select SUBSTRING(rawat_kode,1,2) as group_kode from perawatan where rawat_id='".$rawat_id."'";
				$rs_g=$this->db->query($sql_g);
				if($rs_g->num_rows()){
					$rs_sql_g=$rs_g->row();
					$group_kode=$rs_sql_g->group_kode;
				}
			}
			//get jenis kode
			$sql_j="SELECT jenis_id,jenis_kode FROM jenis WHERE jenis_id='".$rawat_jenis."'";
			$rs_j=$this->db->query($sql_j);
			if($rs_j->num_rows()){
				$rs_sql_j=$rs_j->row();
				$jenis_kode=$rs_sql_j->jenis_kode;
				$data["rawat_jenis"]=$rawat_jenis;
			}else{
				$sql_j="select SUBSTRING(rawat_kode,3,2) as jenis_kode from perawatan where rawat_id='".$rawat_id."'";
				$rs_j=$this->db->query($sql_j);
				if($rs_j->num_rows()){
					$rs_sql_j=$rs_j->row();
					$jenis_kode=$rs_sql_j->jenis_kode;
				}
			}
			
			$pattern=$group_kode.$jenis_kode;
			/*$rawat_kode=$this->get_kode($pattern);
			if($pattern!=="" && strlen($pattern)==4)
				$data["rawat_kode"]=$rawat_kode;*/
			//if rawat_kode!=""
			if($rawat_kode!=""){
				$data["rawat_kode"]=$rawat_kode;
			}
				
			$sql="SELECT rawat_du FROM perawatan WHERE rawat_du!='".$rawat_du."' AND rawat_id='".$rawat_id."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["rawat_du"]=$rawat_du;
			
			$sql="SELECT rawat_dm FROM perawatan WHERE rawat_dm!='".$rawat_dm."' AND rawat_id='".$rawat_id."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["rawat_dm"]=$rawat_dm;
			
			$this->db->where('rawat_id', $rawat_id);
			$this->db->update('perawatan', $data);
			
			return '1';
		}
		
		//function for create new record
		function perawatan_create($rawat_kode ,$rawat_kodelama ,$rawat_nama ,$rawat_group ,$rawat_kategori, $rawat_kontribusi ,$rawat_jenis ,$rawat_keterangan ,$rawat_du ,$rawat_dm ,$rawat_point ,$rawat_harga ,$rawat_gudang ,$rawat_aktif ){
		if ($rawat_aktif=="")
			$rawat_aktif = "Aktif";
			$data = array(
				"rawat_nama"=>$rawat_nama, 
				"rawat_group"=>$rawat_group, 
				"rawat_kategori"=>$rawat_kategori, 
				"rawat_jenis"=>$rawat_jenis, 
				"rawat_keterangan"=>$rawat_keterangan, 
				"rawat_du"=>$rawat_du, 
				"rawat_dm"=>$rawat_dm, 
				"rawat_point"=>$rawat_point, 
				"rawat_harga"=>$rawat_harga, 
				"rawat_gudang"=>$rawat_gudang, 
				"rawat_aktif"=>$rawat_aktif 
			);
			
			$sql="SELECT group_id,group_kode FROM produk_group WHERE group_id='".$rawat_group."' ";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$row=$rs->row();
				
				$sql_2="SELECT jenis_id,jenis_kode FROM jenis WHERE jenis_id='".$rawat_jenis."' ";
				$rs_2=$this->db->query($sql_2);
				if($rs_2->num_rows()){
					$row_2=$rs_2->row();
					$data["rawat_kode"]=$this->get_kode($row->group_kode,$row_2->jenis_kode);
				}
				
				
			}
			
			//generate rawat kode
			//get group kode
			$group_kode="";
			$jenis_kode="";
			
			$sql_g="SELECT group_id,group_kode FROM produk_group WHERE group_id='".$rawat_group."'";
			$rs_g=$this->db->query($sql_g);
			if($rs_g->num_rows()){
				$rs_sql_g=$rs_g->row();
				$group_kode=$rs_sql_g->group_kode;
				$data["rawat_group"]=$rawat_group;
			}
			//get jenis kode
			$sql_j="SELECT jenis_id,jenis_kode FROM jenis WHERE jenis_id='".$rawat_jenis."'";
			$rs_j=$this->db->query($sql_j);
			if($rs_j->num_rows()){
				$rs_sql_j=$rs_j->row();
				$jenis_kode=$rs_sql_j->jenis_kode;
				$data["rawat_jenis"]=$rawat_jenis;
			}
			
			$pattern=$group_kode.$jenis_kode;
			//echo $jenis_kode;
			$rawat_kode=$this->get_kode($pattern);
			if($pattern!=="" && strlen($pattern)==4)
				$data["rawat_kode"]=$rawat_kode;
				
			$this->db->insert('perawatan', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function perawatan_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the perawatans at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM perawatan WHERE rawat_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM perawatan WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "rawat_id= ".$pkid[$i];
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
		function perawatan_search($rawat_id ,$rawat_kode ,$rawat_kodelama ,$rawat_nama ,$rawat_group ,$rawat_kategori ,$rawat_jenis ,$rawat_keterangan ,$rawat_du ,$rawat_dm ,$rawat_point ,$rawat_harga ,$rawat_gudang ,$rawat_aktif ,$start,$end){
			//full query
			if($rawat_aktif==""){
				$rawat_aktif="Aktif";
			}
			$query="SELECT * FROM vu_perawatan";
			
			if($rawat_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rawat_id = '".$rawat_id."'";
			};
			if($rawat_kode!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rawat_kode LIKE '%".$rawat_kode."%'";
			};
			if($rawat_kodelama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rawat_kodelama LIKE '%".$rawat_kodelama."%'";
			};
			if($rawat_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rawat_nama LIKE '%".$rawat_nama."%'";
			};
			if($rawat_group!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rawat_group LIKE '%".$rawat_group."%'";
			};
			if($rawat_kategori!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rawat_jenis = '".$rawat_kategori."'";
			};
			if($rawat_jenis!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rawat_jenis = '".$rawat_jenis."'";
			};
			if($rawat_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rawat_keterangan LIKE '%".$rawat_keterangan."%'";
			};
			if($rawat_du!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rawat_du LIKE '%".$rawat_du."%'";
			};
			if($rawat_dm!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rawat_dm LIKE '%".$rawat_dm."%'";
			};
			if($rawat_point!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rawat_point LIKE '%".$rawat_point."%'";
			};
			if($rawat_harga!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rawat_harga LIKE '%".$rawat_harga."%'";
			};
			if($rawat_gudang!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rawat_gudang LIKE '%".$rawat_gudang."%'";
			};
			if($rawat_aktif!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rawat_aktif = '".$rawat_aktif."'";
			};
			//echo $query;
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
		function perawatan_print($rawat_id ,$rawat_kode ,$rawat_kodelama ,$rawat_nama ,$rawat_group ,$rawat_kategori ,$rawat_jenis ,$rawat_keterangan ,$rawat_du ,$rawat_dm ,$rawat_point ,$rawat_harga ,$rawat_gudang ,$rawat_aktif ,$option,$filter){
			//full query
			$query="select * from perawatan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (rawat_id LIKE '%".addslashes($filter)."%' OR rawat_kode LIKE '%".addslashes($filter)."%' OR rawat_kodelama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR rawat_group LIKE '%".addslashes($filter)."%' OR rawat_kategori LIKE '%".addslashes($filter)."%' OR rawat_jenis LIKE '%".addslashes($filter)."%' OR rawat_keterangan LIKE '%".addslashes($filter)."%' OR rawat_du LIKE '%".addslashes($filter)."%' OR rawat_dm LIKE '%".addslashes($filter)."%' OR rawat_point LIKE '%".addslashes($filter)."%' OR rawat_harga LIKE '%".addslashes($filter)."%' OR rawat_gudang LIKE '%".addslashes($filter)."%' OR rawat_aktif LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($rawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_id LIKE '%".$rawat_id."%'";
				};
				if($rawat_kode!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_kode LIKE '%".$rawat_kode."%'";
				};
				if($rawat_kodelama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_kodelama LIKE '%".$rawat_kodelama."%'";
				};
				if($rawat_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_nama LIKE '%".$rawat_nama."%'";
				};
				if($rawat_group!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_group LIKE '%".$rawat_group."%'";
				};
				if($rawat_kategori!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_kategori LIKE '%".$rawat_kategori."%'";
				};
				if($rawat_jenis!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_jenis LIKE '%".$rawat_jenis."%'";
				};
				if($rawat_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_keterangan LIKE '%".$rawat_keterangan."%'";
				};
				if($rawat_du!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_du LIKE '%".$rawat_du."%'";
				};
				if($rawat_dm!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_dm LIKE '%".$rawat_dm."%'";
				};
				if($rawat_point!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_point LIKE '%".$rawat_point."%'";
				};
				if($rawat_harga!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_harga LIKE '%".$rawat_harga."%'";
				};
				if($rawat_gudang!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_gudang LIKE '%".$rawat_gudang."%'";
				};
				if($rawat_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_aktif LIKE '%".$rawat_aktif."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function perawatan_export_excel($rawat_id ,$rawat_kode ,$rawat_kodelama ,$rawat_nama ,$rawat_group ,$rawat_kategori ,$rawat_jenis ,$rawat_keterangan ,$rawat_du ,$rawat_dm ,$rawat_point ,$rawat_harga ,$rawat_gudang ,$rawat_aktif ,$option,$filter){
			//full query
			$query="select * from perawatan";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (rawat_id LIKE '%".addslashes($filter)."%' OR rawat_kode LIKE '%".addslashes($filter)."%' OR rawat_kodelama LIKE '%".addslashes($filter)."%' OR rawat_nama LIKE '%".addslashes($filter)."%' OR rawat_group LIKE '%".addslashes($filter)."%' OR rawat_kategori LIKE '%".addslashes($filter)."%' OR rawat_jenis LIKE '%".addslashes($filter)."%' OR rawat_keterangan LIKE '%".addslashes($filter)."%' OR rawat_du LIKE '%".addslashes($filter)."%' OR rawat_dm LIKE '%".addslashes($filter)."%' OR rawat_point LIKE '%".addslashes($filter)."%' OR rawat_harga LIKE '%".addslashes($filter)."%' OR rawat_gudang LIKE '%".addslashes($filter)."%' OR rawat_aktif LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($rawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_id LIKE '%".$rawat_id."%'";
				};
				if($rawat_kode!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_kode LIKE '%".$rawat_kode."%'";
				};
				if($rawat_kodelama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_kodelama LIKE '%".$rawat_kodelama."%'";
				};
				if($rawat_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_nama LIKE '%".$rawat_nama."%'";
				};
				if($rawat_group!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_group LIKE '%".$rawat_group."%'";
				};
				if($rawat_kategori!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_kategori LIKE '%".$rawat_kategori."%'";
				};
				if($rawat_jenis!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_jenis LIKE '%".$rawat_jenis."%'";
				};
				if($rawat_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_keterangan LIKE '%".$rawat_keterangan."%'";
				};
				if($rawat_du!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_du LIKE '%".$rawat_du."%'";
				};
				if($rawat_dm!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_dm LIKE '%".$rawat_dm."%'";
				};
				if($rawat_point!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_point LIKE '%".$rawat_point."%'";
				};
				if($rawat_harga!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_harga LIKE '%".$rawat_harga."%'";
				};
				if($rawat_gudang!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_gudang LIKE '%".$rawat_gudang."%'";
				};
				if($rawat_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rawat_aktif LIKE '%".$rawat_aktif."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>