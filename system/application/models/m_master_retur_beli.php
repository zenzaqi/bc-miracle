<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_retur_beli Model
	+ Description	: For record model process back-end
	+ Filename 		: c_master_retur_beli.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:43:32
	
*/

class M_master_retur_beli extends Model{
		
		//constructor
		function M_master_retur_beli() {
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
					$sql="SELECT * FROM vu_trans_retur_beli ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_trans_retur_beli WHERE tanggal like '".$tgl_awal."%' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_trans_retur_beli WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."' ".$order_by;
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT * FROM vu_detail_retur_beli ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_detail_retur_beli WHERE tanggal like '".$tgl_awal."%' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_detail_retur_beli WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."' ".$order_by;
			}
			//echo $sql;
			$query=$this->db->query($sql);
			return $query->result();
		}
		
		
		function get_terima_list($query,$start,$end){
			$sql="SELECT * from vu_trans_invoice";
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
		function get_produk_selected_list($selected_id,$query,$start,$end){
			$sql="SELECT distinct produk_id,produk_nama,produk_kode,kategori_nama,satuan_id,satuan_nama,dinvoice_harga, dinvoice_diskon FROM vu_detail_invoice";
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
				
		function get_produk_all_list($terima_id, $selected_id, $query,$start,$end){
			
			$sql="SELECT distinct produk_id,produk_nama,produk_kode,kategori_nama,satuan_id,satuan_nama,dinvoice_harga, dinvoice_diskon 
					FROM vu_detail_invoice 
					WHERE invoice_noterima='".$terima_id."'";
			
			
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
			$sql="SELECT distinct produk_id,produk_nama,produk_kode,kategori_nama,satuan_id,satuan_nama,drbeli_harga, drbeli_diskon FROM vu_detail_retur_beli";
			if($master_id<>"")
				$sql.=" WHERE drbeli_master='".$master_id."'";
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
			
			$sql="SELECT satuan_id,satuan_kode,satuan_nama FROM vu_satuan_konversi WHERE produk_aktif='Aktif'
					AND satuan_id in(SELECT distinct dterima_satuan FROM detail_terima_beli)";
			
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
			if($master_id<>"")
				$sql.=" WHERE satuan_id IN(SELECT drbeli_satuan FROM detail_retur_beli WHERE drbeli_master='".$master_id."')";
			
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
		
		function get_harga_on_order($dorder_master, $dorder_produk, $dorder_satuan){
			$sql="SELECT * FROM detail_order_beli WHERE dorder_master='".$dorder_master."' AND dorder_produk='".$dorder_produk."' AND dorder_satuan='".$dorder_satuan."'";
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
		
		function get_satuan_by_produkid($dterima_master, $dterima_produk){
			if($dterima_master=="" OR $dterima_produk==""){
				$sql="SELECT * FROM detail_terima_beli,satuan WHERE dterima_satuan=satuan_id";
			}else{
				$sql="SELECT * FROM detail_terima_beli,satuan WHERE dterima_satuan=satuan_id AND dterima_master='".$dterima_master."' AND dterima_produk='".$dterima_produk."'";
			}
			/*$sql="SELECT * FROM detail_order_beli,satuan WHERE dorder_satuan=satuan_id AND dterima_master='".$dterima_master."' AND dterima_produk='".$dterima_produk."' AND dorder_master='".$dorder_master."'";*/
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
		
		function get_drbeli_by_terimabeli($terima_id){
			$sql="SELECT * FROM detail_terima_beli,produk,satuan WHERE dterima_produk=produk_id AND dterima_satuan=satuan_id AND dterima_master='".$terima_id."'";
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
		
		function get_terima_beli_list(){
			$sql="SELECT * FROM master_terima_beli,supplier WHERE terima_supplier=supplier_id";
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
		function detail_detail_retur_beli_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM detail_retur_beli where drbeli_master='".$master_id."'";
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			if($end<=0) $end=15;
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
			$query = "SELECT max(rbeli_id) as master_id from master_retur_beli";
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
		function detail_detail_retur_beli_purge($master_id){
			$sql="DELETE from detail_retur_beli where drbeli_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_detail_retur_beli_insert($drbeli_id ,$drbeli_master ,$drbeli_produk ,$drbeli_satuan ,$drbeli_jumlah ,$drbeli_harga, $drbeli_diskon ){
			//if master id not capture from view then capture it from max pk from master table
			if($drbeli_master=="" || $drbeli_master==NULL){
				$drbeli_master=$this->get_master_id();
			}
			
			$data = array(
				"drbeli_master"=>$drbeli_master, 
				"drbeli_produk"=>$drbeli_produk, 
				"drbeli_satuan"=>$drbeli_satuan, 
				"drbeli_jumlah"=>$drbeli_jumlah, 
				"drbeli_harga"=>$drbeli_harga,
				"drbeli_diskon"=>$drbeli_diskon
			);
			$this->db->insert('detail_retur_beli', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function master_retur_beli_list($filter,$start,$end){
			$query = "SELECT * from vu_trans_retur_beli";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (no_bukti LIKE '%".addslashes($filter)."%' OR
							 no_order LIKE '%".addslashes($filter)."%' OR 
							 supplier_nama LIKE '%".addslashes($filter)."%' OR 
							 tanggal LIKE '%".addslashes($filter)."%' OR
							 no_terima LIKE '%".addslashes($filter)."%' OR
							 jumlah_barang LIKE '%".addslashes($filter)."%' OR
							 total_nilai LIKE '%".addslashes($filter)."%')";
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
		function master_retur_beli_update($rbeli_id ,$rbeli_nobukti ,$rbeli_terima ,$rbeli_supplier ,$rbeli_tanggal ,$rbeli_keterangan, $rbeli_status ){
			$data = array(
				"rbeli_id"=>$rbeli_id, 
				"rbeli_nobukti"=>$rbeli_nobukti, 
//				"rbeli_terima"=>$rbeli_terima, 
//				"rbeli_supplier"=>$rbeli_supplier, 
				"rbeli_tanggal"=>$rbeli_tanggal, 
				"rbeli_keterangan"=>$rbeli_keterangan,
				"rbeli_status"=>$rbeli_status
			);
			$sql="SELECT supplier_id FROM supplier,master_terima_beli 
					WHERE terima_supplier=supplier_id and terima_id='".$rbeli_terima."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$ds=$rs->row();
				$data["rbeli_supplier"]=$ds->supplier_id;
			}
			
			$sql="SELECT terima_id FROM master_terima_beli WHERE terima_id='".$rbeli_terima."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["rbeli_terima"]=$rbeli_terima;
			
			$this->db->where('rbeli_id', $rbeli_id);
			$this->db->update('master_retur_beli', $data);
			
			return $rbeli_id;;
		}
		
		//function for create new record
		function master_retur_beli_create($rbeli_nobukti ,$rbeli_terima ,$rbeli_supplier ,$rbeli_tanggal ,$rbeli_keterangan, $rbeli_status ){
			
			$pattern="RB/".date("y/m")."/";
			$rbeli_nobukti=$this->m_public_function->get_kode_1('master_retur_beli','rbeli_nobukti',$pattern,13);
			
			$data = array(
				"rbeli_nobukti"=>$rbeli_nobukti, 
				"rbeli_terima"=>$rbeli_terima, 
				"rbeli_tanggal"=>$rbeli_tanggal, 
				"rbeli_keterangan"=>$rbeli_keterangan,
				"rbeli_status"=>$rbeli_status
			);
			$sql="SELECT supplier_id FROM supplier,master_terima_beli 
					WHERE terima_supplier=supplier_id and terima_id='".$rbeli_terima."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$ds=$rs->row();
				$data["rbeli_supplier"]=$ds->supplier_id;
			}
			
			$this->db->insert('master_retur_beli', $data); 
			if($this->db->affected_rows())
				return $this->db->insert_id();
			else
				return '0';
		}
		
		//fcuntion for delete record
		function master_retur_beli_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_retur_belis at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM master_retur_beli WHERE rbeli_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM master_retur_beli WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "rbeli_id= ".$pkid[$i];
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
		function master_retur_beli_search($rbeli_id ,$rbeli_nobukti ,$rbeli_terima ,$rbeli_supplier ,$rbeli_tanggal ,$rbeli_keterangan ,$rbeli_status, $start,$end){
			//full query
			$query="select * from vu_trans_retur_beli";
			
			if($rbeli_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rbeli_id LIKE '%".$rbeli_id."%'";
			};
			if($rbeli_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " no_bukti = '".$rbeli_nobukti."'";
			};
			if($rbeli_terima!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rbeli_terima LIKE '%".$rbeli_terima."%'";
			};
			if($rbeli_supplier!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rbeli_supplier LIKE '%".$rbeli_supplier."%'";
			};
			if($rbeli_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " tanggal LIKE '%".$rbeli_tanggal."%'";
			};
			if($rbeli_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rbeli_keterangan LIKE '%".$rbeli_keterangan."%'";
			};
			
			if($rbeli_status!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rbeli_status LIKE '%".$rbeli_status."%'";
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
		function master_retur_beli_print($rbeli_id ,$rbeli_nobukti ,$rbeli_terima ,$rbeli_supplier ,$rbeli_tanggal ,$rbeli_keterangan ,$option,$filter){
			//full query
			$query="SELECT * FROM vu_trans_retur_beli";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (no_bukti LIKE '%".addslashes($filter)."%' OR
							 no_order LIKE '%".addslashes($filter)."%' OR 
							 supplier_nama LIKE '%".addslashes($filter)."%' OR 
							 tanggal LIKE '%".addslashes($filter)."%' OR
							 no_terima LIKE '%".addslashes($filter)."%' OR
							 jumlah_barang LIKE '%".addslashes($filter)."%' OR
							 total_nilai LIKE '%".addslashes($filter)."%')";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($rbeli_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rbeli_id LIKE '%".$rbeli_id."%'";
				};
				if($rbeli_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " no_bukti = '".$rbeli_nobukti."'";
				};
				if($rbeli_terima!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rbeli_terima LIKE '%".$rbeli_terima."%'";
				};
				if($rbeli_supplier!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rbeli_supplier LIKE '%".$rbeli_supplier."%'";
				};
				if($rbeli_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " tanggal LIKE '%".$rbeli_tanggal."%'";
				};
				if($rbeli_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rbeli_keterangan LIKE '%".$rbeli_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function master_retur_beli_export_excel($rbeli_id ,$rbeli_nobukti ,$rbeli_terima ,$rbeli_supplier ,$rbeli_tanggal ,$rbeli_keterangan ,$option,$filter){
			//full query
			$query="SELECT tanggal as Tanggal, no_bukti as 'No Order', no_terima as 'No Penerimaan', no_order as 'No Pesanan',
					supplier_nama as 'Supplier', jumlah_barang as 'Jumlah Item', total_nilai as 'Total Nilai', rbeli_keterangan as 'Keterangan' 
					FROM vu_trans_retur_beli";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (rbeli_id LIKE '%".addslashes($filter)."%' OR no_bukti LIKE '%".addslashes($filter)."%' OR rbeli_terima LIKE '%".addslashes($filter)."%' OR rbeli_supplier LIKE '%".addslashes($filter)."%' OR tanggal LIKE '%".addslashes($filter)."%' OR rbeli_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($rbeli_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rbeli_id LIKE '%".$rbeli_id."%'";
				};
				if($rbeli_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " no_bukti = '".$rbeli_nobukti."'";
				};
				if($rbeli_terima!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rbeli_terima LIKE '%".$rbeli_terima."%'";
				};
				if($rbeli_supplier!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rbeli_supplier LIKE '%".$rbeli_supplier."%'";
				};
				if($rbeli_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " tanggal LIKE '%".$rbeli_tanggal."%'";
				};
				if($rbeli_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rbeli_keterangan LIKE '%".$rbeli_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>