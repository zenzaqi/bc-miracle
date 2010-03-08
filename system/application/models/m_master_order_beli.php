<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_order_beli Model
	+ Description	: For record model process back-end
	+ Filename 		: c_master_order_beli.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:43:12
	
*/

class M_master_order_beli extends Model{
		
		//constructor
		function M_master_order_beli() {
			parent::Model();
		}
		
		
		function get_produk_selected_list($selected_id,$query,$start,$end){
			$sql="SELECT produk_id,produk_nama,produk_kode,kategori_nama FROM vu_produk";
			if($selected_id!=="")
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
			
			$sql="SELECT produk_id,produk_nama,produk_kode,kategori_nama FROM vu_produk";
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
				$sql.=" WHERE produk_id IN(SELECT dorder_produk FROM detail_order_beli WHERE dorder_master='".$master_id."')";
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
		
		//function for detail
		//get record list
		function detail_detail_order_beli_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM vu_detail_order_beli where dorder_master='".$master_id."'";
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
			$query = "SELECT max(order_id) as master_id from master_order_beli";
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
		function detail_detail_order_beli_purge($master_id){
			$sql="DELETE from detail_order_beli where dorder_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_detail_order_beli_insert($dorder_id ,$dorder_master ,$dorder_produk ,$dorder_satuan ,$dorder_jumlah ,$dorder_harga ,$dorder_diskon ){
			//if master id not capture from view then capture it from max pk from master table
			if($dorder_master=="" || $dorder_master==NULL){
				$dorder_master=$this->get_master_id();
			}
			
			$data = array(
				"dorder_master"=>$dorder_master, 
				"dorder_produk"=>$dorder_produk, 
				"dorder_satuan"=>$dorder_satuan, 
				"dorder_jumlah"=>$dorder_jumlah, 
				"dorder_harga"=>$dorder_harga, 
				"dorder_diskon"=>$dorder_diskon 
			);
			$this->db->insert('detail_order_beli', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function master_order_beli_list($filter,$start,$end){
			$query = "SELECT * FROM master_order_beli,supplier,vu_total_order_group where supplier_id=order_supplier AND dorder_master=order_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (order_id LIKE '%".addslashes($filter)."%' OR order_no LIKE '%".addslashes($filter)."%' OR order_supplier LIKE '%".addslashes($filter)."%' OR order_tanggal LIKE '%".addslashes($filter)."%' OR order_carabayar LIKE '%".addslashes($filter)."%' OR order_diskon LIKE '%".addslashes($filter)."%' OR order_biaya LIKE '%".addslashes($filter)."%' OR order_bayar LIKE '%".addslashes($filter)."%' OR order_keterangan LIKE '%".addslashes($filter)."%' )";
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
		function master_order_beli_update($order_id ,$order_no ,$order_supplier ,$order_tanggal ,$order_carabayar ,$order_diskon ,$order_biaya ,$order_bayar ,$order_keterangan ){
			$data = array(
				"order_id"=>$order_id, 
				"order_no"=>$order_no, 
				"order_tanggal"=>$order_tanggal, 
				"order_carabayar"=>$order_carabayar, 
				"order_diskon"=>$order_diskon, 
				"order_biaya"=>$order_biaya, 
				"order_bayar"=>$order_bayar, 
				"order_keterangan"=>$order_keterangan 
			);
			$sql="select supplier_id from supplier where supplier_id='".$order_supplier."'";
			$query=$this->db->query($sql);
			if($query->num_rows())
				$data["order_supplier"]=$order_supplier;
				
			$this->db->where('order_id', $order_id);
			$this->db->update('master_order_beli', $data);
			
			return $order_id;
		}
		
		//function for create new record
		function master_order_beli_create($order_no ,$order_supplier ,$order_tanggal ,$order_carabayar ,$order_diskon ,$order_biaya ,$order_bayar ,$order_keterangan ){
			$date_now=date('Y-m-d');
			if($order_tanggal==""){
				$order_tanggal=$date_now;
			}
			//$pattern="OP/".date("ym")."-";
			$pattern="PP/".date("ym")."-";
			$order_no=$this->m_public_function->get_kode_1('master_order_beli','order_no',$pattern,12);
			
			$data = array(
				"order_no"=>$order_no, 
				"order_supplier"=>$order_supplier, 
				"order_tanggal"=>$order_tanggal, 
				"order_carabayar"=>$order_carabayar, 
				"order_diskon"=>$order_diskon, 
				"order_biaya"=>$order_biaya, 
				"order_bayar"=>$order_bayar, 
				"order_keterangan"=>$order_keterangan 
			);
			
			$this->db->insert('master_order_beli', $data); 
			if($this->db->affected_rows())
				return $this->db->insert_id();
			else
				return '0';
		}
		
		//fcuntion for delete record
		function master_order_beli_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_order_belis at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM master_order_beli WHERE order_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM master_order_beli WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "order_id= ".$pkid[$i];
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
		function master_order_beli_search($order_id ,$order_no ,$order_supplier ,$order_tanggal ,$order_carabayar ,$order_diskon ,$order_biaya ,$order_bayar ,$order_keterangan ,$start,$end){
			//full query
			$query = "SELECT * FROM master_order_beli,supplier where supplier_id=order_supplier";
			
			
			if($order_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " order_id LIKE '%".$order_id."%'";
			};
			if($order_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " order_no LIKE '%".$order_no."%'";
			};
			if($order_supplier!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " order_supplier LIKE '%".$order_supplier."%'";
			};
			if($order_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " order_tanggal LIKE '%".$order_tanggal."%'";
			};
			if($order_carabayar!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " order_carabayar LIKE '%".$order_carabayar."%'";
			};
			if($order_diskon!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " order_diskon LIKE '%".$order_diskon."%'";
			};
			if($order_biaya!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " order_biaya LIKE '%".$order_biaya."%'";
			};
			if($order_bayar!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " order_bayar LIKE '%".$order_bayar."%'";
			};
			if($order_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " order_keterangan LIKE '%".$order_keterangan."%'";
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
		function master_order_beli_print($order_id ,$order_no ,$order_supplier ,$order_tanggal ,$order_carabayar ,$order_diskon ,$order_biaya ,$order_bayar ,$order_keterangan ,$option,$filter){
			//full query
			$query = "SELECT * FROM master_order_beli,supplier where supplier_id=order_supplier";
			
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (order_id LIKE '%".addslashes($filter)."%' OR order_no LIKE '%".addslashes($filter)."%' OR order_supplier LIKE '%".addslashes($filter)."%' OR order_tanggal LIKE '%".addslashes($filter)."%' OR order_carabayar LIKE '%".addslashes($filter)."%' OR order_diskon LIKE '%".addslashes($filter)."%' OR order_biaya LIKE '%".addslashes($filter)."%' OR order_bayar LIKE '%".addslashes($filter)."%' OR order_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($order_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_id LIKE '%".$order_id."%'";
				};
				if($order_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_no LIKE '%".$order_no."%'";
				};
				if($order_supplier!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_supplier LIKE '%".$order_supplier."%'";
				};
				if($order_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_tanggal LIKE '%".$order_tanggal."%'";
				};
				if($order_carabayar!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_carabayar LIKE '%".$order_carabayar."%'";
				};
				if($order_diskon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_diskon LIKE '%".$order_diskon."%'";
				};
				if($order_biaya!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_biaya LIKE '%".$order_biaya."%'";
				};
				if($order_bayar!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_bayar LIKE '%".$order_bayar."%'";
				};
				if($order_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_keterangan LIKE '%".$order_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function master_order_beli_export_excel($order_id ,$order_no ,$order_supplier ,$order_tanggal ,$order_carabayar ,$order_diskon ,$order_biaya ,$order_bayar ,$order_keterangan ,$option,$filter){
			//full query
			$query = "SELECT * FROM master_order_beli,supplier where supplier_id=order_supplier";
			
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (order_id LIKE '%".addslashes($filter)."%' OR order_no LIKE '%".addslashes($filter)."%' OR order_supplier LIKE '%".addslashes($filter)."%' OR order_tanggal LIKE '%".addslashes($filter)."%' OR order_carabayar LIKE '%".addslashes($filter)."%' OR order_diskon LIKE '%".addslashes($filter)."%' OR order_biaya LIKE '%".addslashes($filter)."%' OR order_bayar LIKE '%".addslashes($filter)."%' OR order_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($order_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_id LIKE '%".$order_id."%'";
				};
				if($order_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_no LIKE '%".$order_no."%'";
				};
				if($order_supplier!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_supplier LIKE '%".$order_supplier."%'";
				};
				if($order_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_tanggal LIKE '%".$order_tanggal."%'";
				};
				if($order_carabayar!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_carabayar LIKE '%".$order_carabayar."%'";
				};
				if($order_diskon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_diskon LIKE '%".$order_diskon."%'";
				};
				if($order_biaya!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_biaya LIKE '%".$order_biaya."%'";
				};
				if($order_bayar!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_bayar LIKE '%".$order_bayar."%'";
				};
				if($order_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " order_keterangan LIKE '%".$order_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>