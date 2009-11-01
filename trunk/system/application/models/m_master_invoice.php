<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_invoice Model
	+ Description	: For record model process back-end
	+ Filename 		: c_master_invoice.php
 	+ Author  		: 
 	+ Created on 13/Oct/2009 15:51:36
	
*/

class M_master_invoice extends Model{
		
		//constructor
		function M_master_invoice() {
			parent::Model();
		}
		
		function get_dtbeli_list($dterima_master){
			//$sql="SELECT * FROM detail_terima_beli WHERE dterima_master=$dterima_master";
			$sql="SELECT * FROM detail_terima_beli,master_terima_beli,detail_order_beli WHERE dterima_master=terima_id AND dorder_master=terima_order AND dterima_master=$dterima_master AND dterima_produk=dorder_produk";
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
		
		function get_tbeli_list(){
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
		function detail_detail_invoice_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM detail_invoice where dinvoice_master='".$master_id."'";
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
			$query = "SELECT max(invoice_id) as master_id from master_invoice";
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
		function detail_detail_invoice_purge($master_id){
			$sql="DELETE from detail_invoice where dinvoice_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_detail_invoice_insert($dinvoice_id ,$dinvoice_master ,$dinvoice_produk ,$dinvoice_satuan ,$dinvoice_jumlah ,$dinvoice_harga ,$dinvoice_diskon ){
			//if master id not capture from view then capture it from max pk from master table
			if($dinvoice_master=="" || $dinvoice_master==NULL){
				$dinvoice_master=$this->get_master_id();
			}
			
			$data = array(
				"dinvoice_master"=>$dinvoice_master, 
				"dinvoice_produk"=>$dinvoice_produk, 
				"dinvoice_satuan"=>$dinvoice_satuan, 
				"dinvoice_jumlah"=>$dinvoice_jumlah, 
				"dinvoice_harga"=>$dinvoice_harga, 
				"dinvoice_diskon"=>$dinvoice_diskon 
			);
			$this->db->insert('detail_invoice', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function master_invoice_list($filter,$start,$end){
			$query = "SELECT master_invoice.*,supplier.supplier_nama,master_terima_beli.terima_no,vu_total_invoice_group.*  
						FROM master_invoice,supplier,master_terima_beli,vu_total_invoice_group
						WHERE master_invoice.invoice_supplier=supplier_id and master_invoice.invoice_noterima=master_terima_beli.terima_id
						AND dinvoice_master=invoice_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (invoice_id LIKE '%".addslashes($filter)."%' OR invoice_no LIKE '%".addslashes($filter)."%' OR invoice_supplier LIKE '%".addslashes($filter)."%' OR invoice_noterima LIKE '%".addslashes($filter)."%' OR invoice_tanggal LIKE '%".addslashes($filter)."%' OR invoice_nilai LIKE '%".addslashes($filter)."%' OR invoice_jatuhtempo LIKE '%".addslashes($filter)."%' OR invoice_penagih LIKE '%".addslashes($filter)."%' )";
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
		function master_invoice_update($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noterima ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih ){
			$data = array(
				"invoice_id"=>$invoice_id, 
				"invoice_no"=>$invoice_no, 
				"invoice_supplier"=>$invoice_supplier, 
				"invoice_noterima"=>$invoice_noterima, 
				"invoice_tanggal"=>$invoice_tanggal, 
				"invoice_nilai"=>$invoice_nilai, 
				"invoice_jatuhtempo"=>$invoice_jatuhtempo, 
				"invoice_penagih"=>$invoice_penagih 
			);
			$this->db->where('invoice_id', $invoice_id);
			$this->db->update('master_invoice', $data);
			
			return '1';
		}
		
		//function for create new record
		function master_invoice_create($invoice_no ,$invoice_supplier ,$invoice_noterima ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih ){
			$pattern="INV/".date("y/m")."/";
			$invoice_no=$this->m_public_function->get_kode_1('master_invoice','invoice_no',$pattern,14);
			
			$data = array(
				"invoice_no"=>$invoice_no, 
				"invoice_supplier"=>$invoice_supplier, 
				"invoice_noterima"=>$invoice_noterima, 
				"invoice_tanggal"=>$invoice_tanggal, 
				"invoice_nilai"=>$invoice_nilai, 
				"invoice_jatuhtempo"=>$invoice_jatuhtempo, 
				"invoice_penagih"=>$invoice_penagih 
			);
			$this->db->insert('master_invoice', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function master_invoice_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_invoices at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM master_invoice WHERE invoice_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM master_invoice WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "invoice_id= ".$pkid[$i];
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
		function master_invoice_search($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noterima ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih ,$start,$end){
			//full query
			$query="select * from master_invoice";
			
			if($invoice_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " invoice_id LIKE '%".$invoice_id."%'";
			};
			if($invoice_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " invoice_no LIKE '%".$invoice_no."%'";
			};
			if($invoice_supplier!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " invoice_supplier LIKE '%".$invoice_supplier."%'";
			};
			if($invoice_noterima!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " invoice_noterima LIKE '%".$invoice_noterima."%'";
			};
			if($invoice_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " invoice_tanggal LIKE '%".$invoice_tanggal."%'";
			};
			if($invoice_nilai!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " invoice_nilai LIKE '%".$invoice_nilai."%'";
			};
			if($invoice_jatuhtempo!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " invoice_jatuhtempo LIKE '%".$invoice_jatuhtempo."%'";
			};
			if($invoice_penagih!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " invoice_penagih LIKE '%".$invoice_penagih."%'";
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
		function master_invoice_print($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noterima ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih ,$option,$filter){
			//full query
			$query="select * from master_invoice";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (invoice_id LIKE '%".addslashes($filter)."%' OR invoice_no LIKE '%".addslashes($filter)."%' OR invoice_supplier LIKE '%".addslashes($filter)."%' OR invoice_noterima LIKE '%".addslashes($filter)."%' OR invoice_tanggal LIKE '%".addslashes($filter)."%' OR invoice_nilai LIKE '%".addslashes($filter)."%' OR invoice_jatuhtempo LIKE '%".addslashes($filter)."%' OR invoice_penagih LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($invoice_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_id LIKE '%".$invoice_id."%'";
				};
				if($invoice_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_no LIKE '%".$invoice_no."%'";
				};
				if($invoice_supplier!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_supplier LIKE '%".$invoice_supplier."%'";
				};
				if($invoice_noterima!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_noterima LIKE '%".$invoice_noterima."%'";
				};
				if($invoice_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_tanggal LIKE '%".$invoice_tanggal."%'";
				};
				if($invoice_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_nilai LIKE '%".$invoice_nilai."%'";
				};
				if($invoice_jatuhtempo!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_jatuhtempo LIKE '%".$invoice_jatuhtempo."%'";
				};
				if($invoice_penagih!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_penagih LIKE '%".$invoice_penagih."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function master_invoice_export_excel($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noterima ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih ,$option,$filter){
			//full query
			$query="select * from master_invoice";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (invoice_id LIKE '%".addslashes($filter)."%' OR invoice_no LIKE '%".addslashes($filter)."%' OR invoice_supplier LIKE '%".addslashes($filter)."%' OR invoice_noterima LIKE '%".addslashes($filter)."%' OR invoice_tanggal LIKE '%".addslashes($filter)."%' OR invoice_nilai LIKE '%".addslashes($filter)."%' OR invoice_jatuhtempo LIKE '%".addslashes($filter)."%' OR invoice_penagih LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($invoice_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_id LIKE '%".$invoice_id."%'";
				};
				if($invoice_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_no LIKE '%".$invoice_no."%'";
				};
				if($invoice_supplier!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_supplier LIKE '%".$invoice_supplier."%'";
				};
				if($invoice_noterima!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_noterima LIKE '%".$invoice_noterima."%'";
				};
				if($invoice_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_tanggal LIKE '%".$invoice_tanggal."%'";
				};
				if($invoice_nilai!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_nilai LIKE '%".$invoice_nilai."%'";
				};
				if($invoice_jatuhtempo!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_jatuhtempo LIKE '%".$invoice_jatuhtempo."%'";
				};
				if($invoice_penagih!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_penagih LIKE '%".$invoice_penagih."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>