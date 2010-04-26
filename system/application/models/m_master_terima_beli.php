<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_terima_beli Model
	+ Description	: For record model process back-end
	+ Filename 		: c_master_terima_beli.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:44:15
	
*/

class M_master_terima_beli extends Model{
		
		//constructor
		function M_master_terima_beli() {
			parent::Model();
		}
		
		function get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi,$group){
			
			switch($group){
				case "Tanggal": $order_by=" ORDER BY tanggal";break;
				case "Supplier": $order_by=" ORDER BY supplier_id";break;
				case "No Faktur": $order_by=" ORDER BY no_bukti";break;
				case "Produk": $order_by=" ORDER BY produk_kode";break;
				default: $order_by=" ORDER BY no_bukti";break;
			}
			
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT * FROM vu_trans_terima ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_trans_terima WHERE tanggal like '".$tgl_awal."%' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_trans_terima WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."' ".$order_by;
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT * FROM vu_detail_terima_all ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_detail_terima_all WHERE tanggal like '".$tgl_awal."%' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_detail_terima_all WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."' ".$order_by;
			}
			
			//echo $sql;
			
			$query=$this->db->query($sql);
			return $query->result();
		}
		
		function get_produk_selected_list($selected_id,$query,$start,$end){
			$sql="SELECT produk_id,produk_nama,produk_kode,kategori_nama FROM vu_produk ";
			if($selected_id!==""&strlen($selected_id)>1)
			{
				$selected_id=substr($selected_id,0,strlen($selected_id)-1);
				$sql.=" WHERE produk_id IN(".$selected_id.")";
			}
			if($query!==""){
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." produk_nama like '%".$query."%' OR produk_kode like '%".$query."%'";
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
				
		function get_produk_all_list($query,$start,$end){
			
			$sql="SELECT produk_id,produk_nama,produk_kode,kategori_nama FROM vu_satuan_konversi WHERE produk_aktif='Aktif'";
			if($query!==""){
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." produk_nama like '%".$query."%' OR produk_kode like '%".$query."%'";
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
				
		function get_produk_detail_list($master_id,$query,$start,$end){
			$sql="SELECT produk_id,produk_nama,produk_kode,kategori_nama FROM vu_produk";
			if($master_id<>"")
					$sql.=" WHERE produk_id IN(SELECT dterima_produk FROM detail_terima_beli WHERE dterima_master='".$master_id."')";
			
			if($query!==""){
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." produk_nama like '%".$query."%' OR produk_kode like '%".$query."%'";
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
		
		function get_bonus_detail_list($master_id,$query,$start,$end){
			$sql="SELECT produk_id,produk_nama,produk_kode,kategori_nama FROM vu_satuan_konversi WHERE produk_aktif='Aktif'";
			if($master_id<>"")
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." produk_id IN(SELECT dtbonus_produk FROM detail_terima_bonus WHERE dtbonus_master='".$master_id."')";
			if($query!==""){
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." produk_nama like '%".$query."%' OR produk_kode like '%".$query."%'";
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
		
		function get_satuan_produk_list($selected_id){
			
			$sql="SELECT satuan_id,satuan_kode,satuan_nama FROM vu_satuan_konversi WHERE produk_aktif='Aktif'";
			
			if($selected_id!==""){
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." produk_id='".$selected_id."'";
			}
			
			$result = $this->db->query($sql);
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
		
		function get_satuan_selected_list($selected_id){
			$sql="SELECT satuan_id,satuan_kode,satuan_nama FROM satuan";
			if($selected_id!=="")
			{
				$selected_id=substr($selected_id,0,strlen($selected_id)-1);
				$sql.=" WHERE satuan_id IN(".$selected_id.")";
			}

			$result = $this->db->query($sql);
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
		
		function get_satuan_detail_list($master_id){
			$sql="SELECT satuan_id,satuan_kode,satuan_nama FROM satuan";
			if($master_id<>""){
				$sql.=" WHERE satuan_id IN(SELECT dterima_satuan FROM detail_terima_beli WHERE dterima_master='".$master_id."')";
				$sql.=" OR satuan_id IN(SELECT dtbonus_satuan FROM detail_terima_bonus WHERE dtbonus_master='".$master_id."')";
			}
			
			$result = $this->db->query($sql);
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
		
		
		function get_produk_order_list($order_id,$query,$start,$end){
			$sql="SELECT produk_id,produk_nama,produk_kode,kategori_nama FROM vu_produk";
			if($order_id<>"")
				$sql.=" WHERE produk_id IN(SELECT dorder_produk FROM detail_order_beli WHERE dorder_master='".$order_id."')";
			
			if($query!==""){
				$sql.=(eregi("WHERE",$sql)?" AND ":" WHERE ")." produk_nama like '%".$query."%' OR produk_kode like '%".$query."%'";
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
		
		
		function get_order_beli_search_list(){
			$sql=  "SELECT
						order_id, order_no, order_tanggal, supplier_nama, supplier_id
					FROM master_order_beli, supplier, master_terima_beli 
					WHERE order_supplier = supplier_id
					AND order_id=terima_order
					ORDER BY order_tanggal desc";
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
		
		
		function get_order_beli_list(){
			//$sql="SELECT * FROM master_order_beli,supplier WHERE order_supplier=supplier_id";
			$sql=  "SELECT
						order_id, order_no, order_tanggal, supplier_nama, supplier_id
					FROM master_order_beli, supplier 
					WHERE order_supplier = supplier_id
						AND order_status = 'Terbuka'
					ORDER BY order_tanggal desc";
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
		
		//function for detail
		//get record list
		function detail_detail_terima_bonus_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM vu_detail_terima_bonus where dtbonus_master='".$master_id."'";
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
		function detail_detail_terima_bonus_purge($master_id){
			$sql="DELETE from detail_terima_bonus where dtbonus_master='".$master_id."'";
			$result=$this->db->query($sql);
			echo '1';
		}
		//*eof
		
		//insert detail record
		function detail_detail_terima_bonus_insert($dtbonus_id ,$dtbonus_master ,$dtbonus_produk ,$dtbonus_satuan ,$dtbonus_jumlah ){
			//if master id not capture from view then capture it from max pk from master table
			if($dtbonus_master=="" || $dtbonus_master==NULL){
				$dtbonus_master=$this->get_master_id();
			}
			
			$data = array(
				"dtbonus_master"=>$dtbonus_master, 
				"dtbonus_produk"=>$dtbonus_produk, 
				"dtbonus_satuan"=>$dtbonus_satuan, 
				"dtbonus_jumlah"=>$dtbonus_jumlah 
			);
			$this->db->insert('detail_terima_bonus', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for detail
		//get record list
		function detail_detail_terima_beli_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM vu_detail_terima_produk where dterima_master='".$master_id."'";
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
			$query = "SELECT max(terima_id) as master_id from master_terima_beli";
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
		
		//check all order are receive
		function check_all_order_done($master_id){
			
			$is_done=true;
			
			$sql="SELECT terima_order FROM master_terima_beli WHERE terima_id='".$master_id."'";
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$row=$query->row();
				$no_order=$row->terima_order;
			}else
				$no_order="";
			
			if($no_order!==""){
				$sql="SELECT dorder_produk,dorder_jumlah FROM detail_order_beli WHERE dorder_master='".$no_order."'";
				$query=$this->db->query($sql);
				foreach($query->result() as $result){
					
					$sql_terima="SELECT jumlah_terima FROM vu_detail_terima_order 
									WHERE dorder_master='".$no_order."'
									AND dterima_produk='".$result->dorder_produk."'  
									AND jumlah_terima>=".$result->dorder_jumlah;
					$query_terima=$this->db->query($sql_terima);
					if($query_terima->num_rows()<1)
					{
						$is_done=false;
						break;
					}
				}
			}else{
				$is_done=false;
			}
			
			if($is_done==true){
				$sql="UPDATE master_order_beli SET order_status='Tertutup' WHERE order_id='".$no_order."'";
				$this->db->query($sql);
			}
			
		}
		
		//purge all detail from master
		function detail_detail_terima_beli_purge($master_id){
			$sql="DELETE from detail_terima_beli where dterima_master='".$master_id."'";
			$result=$this->db->query($sql);
			echo '1';
		}
		//*eof
		
		//insert detail record
		function detail_detail_terima_beli_insert($dterima_id ,$dterima_master ,$dterima_produk ,$dterima_satuan ,$dterima_jumlah ){
			//if master id not capture from view then capture it from max pk from master table
			if($dterima_master=="" || $dterima_master==NULL){
				$dterima_master=$this->get_master_id();
			}
			
			$data = array(
				"dterima_master"=>$dterima_master, 
				"dterima_produk"=>$dterima_produk, 
				"dterima_satuan"=>$dterima_satuan, 
				"dterima_jumlah"=>$dterima_jumlah 
			);
			$this->db->insert('detail_terima_beli', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function master_terima_beli_list($filter,$start,$end){
			$query = "SELECT *  FROM vu_trans_terima";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (no_bukti LIKE '%".addslashes($filter)."%' OR order_no LIKE '%".addslashes($filter)."%' OR 
							supplier_nama LIKE '%".addslashes($filter)."%' OR terima_surat_jalan LIKE '%".addslashes($filter)."%' 
							OR terima_pengirim LIKE '%".addslashes($filter)."%' OR tanggal LIKE '%".addslashes($filter)."%' )";
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
		function master_terima_beli_update($terima_id ,$terima_no ,$terima_order ,$terima_supplier ,$terima_surat_jalan ,$terima_pengirim ,$terima_tanggal ,$terima_keterangan ){
			$data = array(
				"terima_id"=>$terima_id, 
				"terima_no"=>$terima_no, 
//				"terima_order"=>$terima_order, 
//				"terima_supplier"=>$terima_supplier, 
				"terima_surat_jalan"=>$terima_surat_jalan, 
				"terima_pengirim"=>$terima_pengirim, 
				"terima_tanggal"=>$terima_tanggal, 
				"terima_keterangan"=>$terima_keterangan 
			);
			$sql="SELECT supplier_id FROM supplier WHERE supplier_id='".$terima_supplier."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["terima_supplier"]=$terima_supplier;
			
			$sql="SELECT order_id FROM master_order_beli WHERE order_id='".$terima_order."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["terima_order"]=$terima_order;
			
			$this->db->where('terima_id', $terima_id);
			$this->db->update('master_terima_beli', $data);
			
			return $terima_id;
		}
		
		//function for create new record
		function master_terima_beli_create($terima_no ,$terima_order ,$terima_supplier ,$terima_surat_jalan ,$terima_pengirim ,$terima_tanggal ,$terima_keterangan ){
//			$pattern="LPB/".date("y/m")."/";
//			$terima_no=$this->m_public_function->get_kode_1('master_terima_beli','terima_no',$pattern,14);
			$pattern="PB/".date("ym")."-";
			$terima_no=$this->m_public_function->get_kode_1('master_terima_beli','terima_no',$pattern,12);
			
			$data = array(
				"terima_no"=>$terima_no, 
				"terima_order"=>$terima_order, 
				"terima_supplier"=>$terima_supplier, 
				"terima_surat_jalan"=>$terima_surat_jalan, 
				"terima_pengirim"=>$terima_pengirim, 
				"terima_tanggal"=>$terima_tanggal, 
				"terima_keterangan"=>$terima_keterangan 
			);
			$this->db->insert('master_terima_beli', $data); 
			if($this->db->affected_rows())
				return $this->db->insert_id();
			else
				return '0';
		}
		
		//fcuntion for delete record
		function master_terima_beli_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_terima_belis at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM master_terima_beli WHERE terima_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM master_terima_beli WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "terima_id= ".$pkid[$i];
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
		function master_terima_beli_search($terima_id ,$terima_no ,$terima_order ,$terima_supplier ,$terima_surat_jalan ,$terima_pengirim ,$terima_tanggal ,$terima_keterangan ,$start,$end){
			//full query
			$query="SELECT *  FROM vu_trans_terima";
			
			if($terima_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " terima_id LIKE '%".$terima_id."%'";
			};
			if($terima_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " terima_no LIKE '%".$terima_no."%'";
			};
			if($terima_order!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " terima_order LIKE '%".$terima_order."%'";
			};
			if($terima_supplier!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " terima_supplier LIKE '%".$terima_supplier."%'";
			};
			if($terima_surat_jalan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " terima_surat_jalan LIKE '%".$terima_surat_jalan."%'";
			};
			if($terima_pengirim!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " terima_pengirim LIKE '%".$terima_pengirim."%'";
			};
			if($terima_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " terima_tanggal LIKE '%".$terima_tanggal."%'";
			};
			if($terima_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " terima_keterangan LIKE '%".$terima_keterangan."%'";
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
		function master_terima_beli_print($terima_id ,$terima_no ,$terima_order ,$terima_supplier ,$terima_surat_jalan ,$terima_pengirim ,$terima_tanggal ,$terima_keterangan ,$option,$filter){
			//full query
			$query="SELECT *  FROM vu_trans_terima";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (terima_id LIKE '%".addslashes($filter)."%' OR no_bukti LIKE '%".addslashes($filter)."%' OR terima_order LIKE '%".addslashes($filter)."%' OR terima_supplier LIKE '%".addslashes($filter)."%' OR terima_surat_jalan LIKE '%".addslashes($filter)."%' OR terima_pengirim LIKE '%".addslashes($filter)."%' OR tanggal LIKE '%".addslashes($filter)."%' OR terima_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($terima_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " terima_id LIKE '%".$terima_id."%'";
				};
				if($terima_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " no_bukti LIKE '%".$terima_no."%'";
				};
				if($terima_order!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " terima_order LIKE '%".$terima_order."%'";
				};
				if($terima_supplier!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " terima_supplier LIKE '%".$terima_supplier."%'";
				};
				if($terima_surat_jalan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " terima_surat_jalan LIKE '%".$terima_surat_jalan."%'";
				};
				if($terima_pengirim!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " terima_pengirim LIKE '%".$terima_pengirim."%'";
				};
				if($terima_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " tanggal LIKE '%".$terima_tanggal."%'";
				};
				if($terima_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " terima_keterangan LIKE '%".$terima_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function master_terima_beli_export_excel($terima_id ,$terima_no ,$terima_order ,$terima_supplier ,$terima_surat_jalan ,$terima_pengirim ,$terima_tanggal ,$terima_keterangan ,$option,$filter){
			//full query
			$query="SELECT tanggal as 'Tanggal', no_bukti as 'No Penerimaan', order_no as 'No Pesanan', supplier_nama as Supplier
					,jumlah_barang as 'Jumlah Item', jumlah_barang_bonus as 'Jumlah Item Bonus', terima_surat_jalan as 'No Surat Jalan',
					terima_pengirim as 'Pengirim' FROM vu_trans_terima";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (terima_id LIKE '%".addslashes($filter)."%' OR no_bukti LIKE '%".addslashes($filter)."%' OR terima_order LIKE '%".addslashes($filter)."%' OR terima_supplier LIKE '%".addslashes($filter)."%' OR terima_surat_jalan LIKE '%".addslashes($filter)."%' OR terima_pengirim LIKE '%".addslashes($filter)."%' OR tanggal LIKE '%".addslashes($filter)."%' OR terima_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($terima_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " terima_id LIKE '%".$terima_id."%'";
				};
				if($terima_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " no_bukti LIKE '%".$terima_no."%'";
				};
				if($terima_order!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " terima_order LIKE '%".$terima_order."%'";
				};
				if($terima_supplier!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " terima_supplier LIKE '%".$terima_supplier."%'";
				};
				if($terima_surat_jalan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " terima_surat_jalan LIKE '%".$terima_surat_jalan."%'";
				};
				if($terima_pengirim!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " terima_pengirim LIKE '%".$terima_pengirim."%'";
				};
				if($terima_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " tanggal LIKE '%".$terima_tanggal."%'";
				};
				if($terima_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " terima_keterangan LIKE '%".$terima_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>