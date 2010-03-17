<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_retur_jual_paket Model
	+ Description	: For record model process back-end
	+ Filename 		: c_master_retur_jual_paket.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 14:53:56
	
*/

class M_master_retur_jual_paket extends Model{
		
	//constructor
	function M_master_retur_jual_paket() {
		parent::Model();
	}
	
	function get_rawat_list($query,$start,$end){
		$rs_rows=0;
		if(is_numeric($query)==true){
			$sql_dproduk="SELECT dpaket_paket FROM detail_jual_paket WHERE dpaket_master='$query'";
			$rs=$this->db->query($sql_dproduk);
			$rs_rows=$rs->num_rows();
		}/*elseif(is_string($query)==true){
			$sql_dproduk="SELECT dpaket_master FROM detail_jual_paket LEFT JOIN master_jual_paket ON(dpaket_master=jproduk_id) WHERE jpaket_nobukti='$query'";
			$rs=$this->db->query($sql_dproduk);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$query=$rs_record["dpaket_master"];
			}
		}*/
		
		$sql="SELECT rawat_id, rawat_nama, rawat_kode, ((dpaket_harga*((100-dpaket_diskon)/100))*((100-jpaket_diskon)/100)) AS rawat_harga FROM paket_isi_perawatan LEFT JOIN paket ON(rpaket_master=paket_id) LEFT JOIN detail_jual_paket ON(dpaket_paket=paket_id) LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id) LEFT JOIN perawatan ON(rpaket_perawatan=rawat_id) WHERE jpaket_id='$query'";
		/*if($query<>"" && is_numeric($query)==false){
			$sql.=eregi("WHERE",$sql)? " AND ":" WHERE ";
			$sql.=" (produk_kode like '%".$query."%' or produk_nama like '%".$query."%' or satuan_nama like '%".$query."%' or kategori_nama like '%".$query."%' or group_nama like '%".$query."%') ";
		}else{*/
			if($rs_rows){
				$filter="";
				$sql.=eregi("AND",$sql)? " OR ":" AND ";
				foreach($rs->result() as $row_dpaket){
					
					$filter.="OR dpaket_paket='".$row_dpaket->dpaket_paket."' ";
				}
				$sql=$sql."(".substr($filter,2,strlen($filter)).")";
			}
		/*}*/
		
		$result = $this->db->query($sql);
		$nbrows = $result->num_rows();
		if($end!=0){
			$limit = $sql." LIMIT ".$start.",".$end;			
			$result = $this->db->query($limit);
		}
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
	
	function get_retur_rawat_list($query,$start,$end){
		//$query = harga perawatan
		/*$rs_rows=0;
		if(is_numeric($query)==true){
			$sql_dproduk="SELECT dpaket_paket FROM detail_jual_paket WHERE dpaket_master='$query'";
			$rs=$this->db->query($sql_dproduk);
			$rs_rows=$rs->num_rows();
		}elseif(is_string($query)==true){
			$sql_dproduk="SELECT dpaket_master FROM detail_jual_paket LEFT JOIN master_jual_paket ON(dpaket_master=jproduk_id) WHERE jpaket_nobukti='$query'";
			$rs=$this->db->query($sql_dproduk);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$query=$rs_record["dpaket_master"];
			}
		}*/
		
		$sql="SELECT rawat_id, rawat_nama, rawat_kode, rawat_harga FROM perawatan WHERE rawat_harga<='$query'";
		/*if($query<>"" && is_numeric($query)==false){
			$sql.=eregi("WHERE",$sql)? " AND ":" WHERE ";
			$sql.=" (produk_kode like '%".$query."%' or produk_nama like '%".$query."%' or satuan_nama like '%".$query."%' or kategori_nama like '%".$query."%' or group_nama like '%".$query."%') ";
		}else{
			if($rs_rows){
				$filter="";
				$sql.=eregi("AND",$sql)? " OR ":" AND ";
				foreach($rs->result() as $row_dpaket){
					
					$filter.="OR dpaket_paket='".$row_dpaket->dpaket_paket."' ";
				}
				$sql=$sql."(".substr($filter,2,strlen($filter)).")";
			}
		}*/
		
		$result = $this->db->query($sql);
		$nbrows = $result->num_rows();
		if($end!=0){
			$limit = $sql." LIMIT ".$start.",".$end;			
			$result = $this->db->query($limit);
		}
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
	
	function get_jual_paket_list($query,$start,$end){
		$sql="SELECT master_jual_paket.jpaket_id, jpaket_nobukti, jpaket_tanggal, cust_id, cust_nama, cust_alamat, vu_jpaket_total_bayar.jpaket_total_bayar, vu_jpaket_total_pakai.jpaket_total_pakai, (vu_jpaket_total_bayar.jpaket_total_bayar-vu_jpaket_total_pakai.jpaket_total_pakai) AS jpaket_total_retur FROM master_jual_paket LEFT JOIN customer ON(jpaket_cust=cust_id) LEFT JOIN vu_jpaket_total_bayar ON(vu_jpaket_total_bayar.jpaket_id=master_jual_paket.jpaket_id) LEFT JOIN vu_jpaket_total_pakai ON(vu_jpaket_total_pakai.jpaket_id=master_jual_paket.jpaket_id) WHERE jpaket_cust=cust_id";
		if($query<>"")
			$sql.=" and (jpaket_nobukti like '%".$query."%' or jpaket_tanggal like '%".$query."%' or cust_nama like '%".$query."%' or cust_alamat like '%".$query."%') "; 
		$query = $this->db->query($sql);
		$nbrows = $query->num_rows();
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
	
	/* START Detail Retur tokwitansi */
	//get record list
	function detail_retur_paket_tokwitansi_list($master_id,$query,$start,$end) {
		/* Menampilkan detail paket yang terpakai dari No.Faktur Jual yang terpilih + harga asli dari isi paket*/
		//$query = "SELECT * FROM detail_retur_paket_rawat where drpaket_master='".$master_id."'";
		$query = "SELECT * FROM (SELECT apaket_jpaket, sapaket_master, sapaket_item, sapaket_item_nama, (sapaket_jmlisi_item-sapaket_sisa_item) As jumlah_terpakai, rawat_harga FROM submaster_apaket_item LEFT JOIN perawatan ON(sapaket_item=rawat_id) LEFT JOIN master_ambil_paket ON(sapaket_master=apaket_id)) AS vu_retur_paket WHERE vu_retur_paket.apaket_jpaket='".$master_id."' AND vu_retur_paket.jumlah_terpakai!='0'";
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
	//purge all detail from master
	function detail_retur_paket_tokwitansi_purge($master_id){
		$sql="DELETE from detail_retur_paket_rawat where drpaket_master='".$master_id."'";
		$result=$this->db->query($sql);
	}
	//*eof
	
	//insert detail record
	function detail_retur_paket_tokwitansi_insert($drpaket_id ,$drpaket_master ,$drpaket_rawat ,$drpaket_jumlah ,$drpaket_harga ){
		//if master id not capture from view then capture it from max pk from master table
		if($drpaket_master=="" || $drpaket_master==NULL){
			$drpaket_master=$this->get_master_id();
		}
		
		$data = array(
			"drpaket_master"=>$drpaket_master, 
			"drpaket_rawat"=>$drpaket_rawat, 
			"drpaket_jumlah"=>$drpaket_jumlah, 
			"drpaket_harga"=>$drpaket_harga 
		);
		$this->db->insert('detail_retur_paket_rawat', $data); 
		if($this->db->affected_rows())
			return '1';
		else
			return '0';

	}
	//end of function
	/* END Detail Retur tokwitansi */
	
	/* START Detail Retur torawat */
	//get record list
	/*function detail_detail_retur_paket_rawat_list($master_id,$query,$start,$end) {
		$query = "SELECT * FROM detail_retur_paket_rawat where drpaket_master='".$master_id."'";
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
	
	//purge all detail from master
	function detail_detail_retur_paket_rawat_purge($master_id){
		$sql="DELETE from detail_retur_paket_rawat where drpaket_master='".$master_id."'";
		$result=$this->db->query($sql);
	}
	//eof
	
	//insert detail record
	function detail_detail_retur_paket_rawat_insert($drpaket_id ,$drpaket_master ,$drpaket_rawat ,$drpaket_jumlah ,$drpaket_harga ){
		//if master id not capture from view then capture it from max pk from master table
		if($drpaket_master=="" || $drpaket_master==NULL){
			$drpaket_master=$this->get_master_id();
		}
		
		$data = array(
			"drpaket_master"=>$drpaket_master, 
			"drpaket_rawat"=>$drpaket_rawat, 
			"drpaket_jumlah"=>$drpaket_jumlah, 
			"drpaket_harga"=>$drpaket_harga 
		);
		$this->db->insert('detail_retur_paket_rawat', $data); 
		if($this->db->affected_rows())
			return '1';
		else
			return '0';

	}
	//end of function*/
	/* END Detail Retur torawat */
	
	//get master id, note : not done yet
	function get_master_id() {
		$query = "SELECT max(rpaket_id) as master_id from master_retur_jual_paket";
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
	
	//function for get list record
	function master_retur_jual_paket_list($filter,$start,$end){
		$query = "SELECT * FROM master_retur_jual_paket,customer,master_jual_paket WHERE rpaket_cust=cust_id AND rpaket_nobuktijual=jpaket_id";
		
		// For simple search
		if ($filter<>""){
			$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
			$query .= " (rpaket_id LIKE '%".addslashes($filter)."%' OR rpaket_nobukti LIKE '%".addslashes($filter)."%' OR rpaket_nobuktijual LIKE '%".addslashes($filter)."%' OR rpaket_cust LIKE '%".addslashes($filter)."%' OR rpaket_tanggal LIKE '%".addslashes($filter)."%' OR rpaket_keterangan LIKE '%".addslashes($filter)."%' )";
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
	function master_retur_jual_paket_update($rpaket_id ,$rpaket_nobukti ,$rpaket_nobuktijual ,$rpaket_cust ,$rpaket_tanggal ,$rpaket_keterangan ){
		$data = array(
			"rpaket_id"=>$rpaket_id, 
			"rpaket_nobukti"=>$rpaket_nobukti, 
			//"rpaket_nobuktijual"=>$rpaket_nobuktijual, 
			"rpaket_cust"=>$rpaket_cust, 
			"rpaket_tanggal"=>$rpaket_tanggal, 
			"rpaket_keterangan"=>$rpaket_keterangan 
		);
		$sql="SELECT jpaket_id FROM master_jual_paket WHERE jpaket_id='".$rpaket_nobuktijual."'";
		$rs=$this->db->query($sql);
		if($rs->num_rows())
			$data["rpaket_nobuktijual"]=$rpaket_nobuktijual;
		
		$this->db->where('rpaket_id', $rpaket_id);
		$this->db->update('master_retur_jual_paket', $data);
		
		return '1';
	}
	
	//function for create new record
	function master_retur_jual_paket_create($rpaket_nobukti ,$rpaket_nobuktijual ,$rpaket_cust ,$rpaket_tanggal ,$rpaket_keterangan ,$rpaket_kwitansi_nilai ,$rpaket_kwitansi_keterangan ){
		$pattern="RPK/".date("ym")."-";
		$rpaket_nobukti=$this->m_public_function->get_kode_1('master_retur_jual_paket','rpaket_nobukti',$pattern,12);
		
		$data = array(
			"rpaket_nobukti"=>$rpaket_nobukti, 
			"rpaket_nobuktijual"=>$rpaket_nobuktijual, 
			"rpaket_cust"=>$rpaket_cust, 
			"rpaket_tanggal"=>$rpaket_tanggal, 
			"rpaket_keterangan"=>$rpaket_keterangan 
		);
		$this->db->insert('master_retur_jual_paket', $data); 
		if($this->db->affected_rows()){
			$pattern="KU/".date('ym')."-";
			$kwitansi_no=$this->m_public_function->get_kode_1("cetak_kwitansi","kwitansi_no",$pattern,12);
			$dti_kwitansi=array(
			"kwitansi_no"=>$kwitansi_no, 
			"kwitansi_cust"=>$rpaket_cust, 
			"kwitansi_ref"=>$rpaket_nobukti, 
			"kwitansi_nilai"=>$rpaket_kwitansi_nilai, 
			"kwitansi_keterangan"=>$rpaket_kwitansi_keterangan, 
			"kwitansi_status"=>'Aktif'
			);
			$this->db->insert('cetak_kwitansi', $dti_kwitansi);
			return '1';
		}else
			return '0';
	}
	
	//fcuntion for delete record
	function master_retur_jual_paket_delete($pkid){
		// You could do some checkups here and return '0' or other error consts.
		// Make a single query to delete all of the master_retur_jual_pakets at the same time :
		if(sizeof($pkid)<1){
			return '0';
		} else if (sizeof($pkid) == 1){
			$query = "DELETE FROM master_retur_jual_paket WHERE rpaket_id = ".$pkid[0];
			$this->db->query($query);
		} else {
			$query = "DELETE FROM master_retur_jual_paket WHERE ";
			for($i = 0; $i < sizeof($pkid); $i++){
				$query = $query . "rpaket_id= ".$pkid[$i];
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
	function master_retur_jual_paket_search($rpaket_id ,$rpaket_nobukti ,$rpaket_nobuktijual ,$rpaket_cust ,$rpaket_tanggal ,$rpaket_keterangan ,$start,$end){
		//full query
		$query="select * from master_retur_jual_paket";
		
		if($rpaket_id!=''){
			$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
			$query.= " rpaket_id LIKE '%".$rpaket_id."%'";
		};
		if($rpaket_nobukti!=''){
			$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
			$query.= " rpaket_nobukti LIKE '%".$rpaket_nobukti."%'";
		};
		if($rpaket_nobuktijual!=''){
			$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
			$query.= " rpaket_nobuktijual LIKE '%".$rpaket_nobuktijual."%'";
		};
		if($rpaket_cust!=''){
			$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
			$query.= " rpaket_cust LIKE '%".$rpaket_cust."%'";
		};
		if($rpaket_tanggal!=''){
			$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
			$query.= " rpaket_tanggal LIKE '%".$rpaket_tanggal."%'";
		};
		if($rpaket_keterangan!=''){
			$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
			$query.= " rpaket_keterangan LIKE '%".$rpaket_keterangan."%'";
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
	function master_retur_jual_paket_print($rpaket_id ,$rpaket_nobukti ,$rpaket_nobuktijual ,$rpaket_cust ,$rpaket_tanggal ,$rpaket_keterangan ,$option,$filter){
		//full query
		$query="select * from master_retur_jual_paket";
		if($option=='LIST'){
			$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
			$query .= " (rpaket_id LIKE '%".addslashes($filter)."%' OR rpaket_nobukti LIKE '%".addslashes($filter)."%' OR rpaket_nobuktijual LIKE '%".addslashes($filter)."%' OR rpaket_cust LIKE '%".addslashes($filter)."%' OR rpaket_tanggal LIKE '%".addslashes($filter)."%' OR rpaket_keterangan LIKE '%".addslashes($filter)."%' )";
			$result = $this->db->query($query);
		} else if($option=='SEARCH'){
			if($rpaket_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rpaket_id LIKE '%".$rpaket_id."%'";
			};
			if($rpaket_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rpaket_nobukti LIKE '%".$rpaket_nobukti."%'";
			};
			if($rpaket_nobuktijual!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rpaket_nobuktijual LIKE '%".$rpaket_nobuktijual."%'";
			};
			if($rpaket_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rpaket_cust LIKE '%".$rpaket_cust."%'";
			};
			if($rpaket_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rpaket_tanggal LIKE '%".$rpaket_tanggal."%'";
			};
			if($rpaket_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rpaket_keterangan LIKE '%".$rpaket_keterangan."%'";
			};
			$result = $this->db->query($query);
		}
		return $result;
	}
	
	//function  for export to excel
	function master_retur_jual_paket_export_excel($rpaket_id ,$rpaket_nobukti ,$rpaket_nobuktijual ,$rpaket_cust ,$rpaket_tanggal ,$rpaket_keterangan ,$option,$filter){
		//full query
		$query="select * from master_retur_jual_paket";
		if($option=='LIST'){
			$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
			$query .= " (rpaket_id LIKE '%".addslashes($filter)."%' OR rpaket_nobukti LIKE '%".addslashes($filter)."%' OR rpaket_nobuktijual LIKE '%".addslashes($filter)."%' OR rpaket_cust LIKE '%".addslashes($filter)."%' OR rpaket_tanggal LIKE '%".addslashes($filter)."%' OR rpaket_keterangan LIKE '%".addslashes($filter)."%' )";
			$result = $this->db->query($query);
		} else if($option=='SEARCH'){
			if($rpaket_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rpaket_id LIKE '%".$rpaket_id."%'";
			};
			if($rpaket_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rpaket_nobukti LIKE '%".$rpaket_nobukti."%'";
			};
			if($rpaket_nobuktijual!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rpaket_nobuktijual LIKE '%".$rpaket_nobuktijual."%'";
			};
			if($rpaket_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rpaket_cust LIKE '%".$rpaket_cust."%'";
			};
			if($rpaket_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rpaket_tanggal LIKE '%".$rpaket_tanggal."%'";
			};
			if($rpaket_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rpaket_keterangan LIKE '%".$rpaket_keterangan."%'";
			};
			$result = $this->db->query($query);
		}
		return $result;
	}
		
}
?>