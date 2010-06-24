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
					$sql="SELECT * FROM vu_trans_invoice ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_trans_invoice WHERE tanggal like '".$tgl_awal."%' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_trans_invoice WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."' ".$order_by;
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT * FROM vu_detail_invoice ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_detail_invoice WHERE tanggal like '".$tgl_awal."%' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_detail_invoice WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."' ".$order_by;
			}
			//echo $sql;
			$query=$this->db->query($sql);
			return $query->result();
		}
		
		function get_invoice_order($terima_id){
			$sql="SELECT order_diskon,order_cashback,order_biaya,order_bayar as order_uangmuka 
					FROM master_order_beli,master_terima_beli WHERE terima_order=order_id
					AND terima_id='".$terima_id."'";
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
		
		function get_produk_terima_list($terima_id,$query,$start,$end){
			/*$sql="SELECT distinct produk_id,produk_nama from produk 
					WHERE produk_id IN (SELECT dterima_produk FROM detail_terima_beli WHERE dterima_master='".$terima_id."')";*/
			$sql="SELECT produk_id,produk_nama
					FROM detail_terima_beli,produk
					WHERE dterima_produk=produk_id AND dterima_master='".$terima_id."'";
					
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			/*$limit = $sql." LIMIT ".$start.",".$end;			
			$result = $this->db->query($limit);  */
			
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
		
		function get_produk_invoice_list($master_id,$query,$start,$end){
			/*$sql="SELECT distinct produk_id,produk_nama from produk 
					WHERE produk_id IN (SELECT dinvoice_produk FROM detail_invoice WHERE dinvoice_master='".$master_id."')";*/
			$sql="SELECT produk_id,produk_nama
					FROM detail_invoice,produk
					WHERE dinvoice_produk=produk_id AND dinvoice_master='".$master_id."'";
					
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			/*$limit = $sql." LIMIT ".$start.",".$end;			
			$result = $this->db->query($limit);  */
			
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
		
		function get_dtbeli_list($dterima_master){
			//$sql="SELECT * FROM detail_terima_beli WHERE dterima_master=$dterima_master";
			/*$sql="SELECT * FROM detail_terima_beli,master_terima_beli,detail_order_beli WHERE dterima_master=terima_id AND dorder_master=terima_order AND dterima_master=$dterima_master AND dterima_produk=dorder_produk";*/
			$sql="SELECT * FROM vu_detail_terima_order WHERE master_terima=$dterima_master";
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
		
		function get_tbeli_list($filter,$start,$end){
			$sql="SELECT * FROM master_terima_beli,supplier WHERE terima_supplier=supplier_id 
					AND terima_id NOT IN(SELECT invoice_noterima FROM master_invoice)
					AND terima_status<>'Batal'";
			
			if ($filter<>""){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (terima_no LIKE '%".addslashes($filter)."%' OR supplier_nama LIKE '%".addslashes($filter)."%')";
			}
			
			$start=($start==""?0:$start);
			$end=($end==""?15:$end);
			
			$query = $this->db->query($sql);
			$nbrows = $query->num_rows();
			$limit = $sql." LIMIT ".$start.",".$end;		
			$result = $this->db->query($limit);  
			
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
/*			$limit = $query." LIMIT ".$start.",".$end;			
			$result = $this->db->query($limit);  */
			
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
			$query = "SELECT * FROM vu_trans_invoice";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (invoice_id LIKE '%".addslashes($filter)."%' OR no_bukti LIKE '%".addslashes($filter)."%' OR invoice_supplier LIKE '%".addslashes($filter)."%' OR invoice_noterima LIKE '%".addslashes($filter)."%' OR tanggal LIKE '%".addslashes($filter)."%' OR invoice_jatuhtempo LIKE '%".addslashes($filter)."%' OR invoice_penagih LIKE '%".addslashes($filter)."%' )";
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
		function master_invoice_update($invoice_id ,$invoice_no ,$invoice_no_auto, $invoice_supplier ,$invoice_noterima ,$invoice_tanggal ,$invoice_diskon, $invoice_cashback, $invoice_uangmuka, $invoice_biaya,$invoice_jatuhtempo ,$invoice_penagih, $invoice_keterangan, $invoice_status ){
			$data = array(
				"invoice_id"=>$invoice_id, 
				"invoice_no"=>$invoice_no, 
				"invoice_no_auto"=>$invoice_no_auto,
				"invoice_tanggal"=>$invoice_tanggal, 
				"invoice_diskon"=>$invoice_diskon,
				"invoice_cashback"=>$invoice_cashback,
				"invoice_uangmuka"=>$invoice_uangmuka,
				"invoice_biaya"=>$invoice_biaya,
				"invoice_jatuhtempo"=>$invoice_jatuhtempo, 
				"invoice_penagih"=>$invoice_penagih,
				"invoice_keterangan"=>$invoice_keterangan,
				"invoice_status"=>$invoice_status
			);
			$sql="SELECT terima_supplier,terima_id FROM master_terima_beli WHERE terima_id='".$invoice_noterima."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$ds=$this->db->row();
				$data["invoice_noterima"]=$invoice_noterima;
				$data["invoice_supplier"]=$ds["terima_supplier"];
			}
			$this->db->where('invoice_id', $invoice_id);
			$this->db->update('master_invoice', $data);
			
			return $invoice_id;
		}
		
		//function for create new record
		function master_invoice_create($invoice_no ,$invoice_no_auto, $invoice_supplier ,$invoice_noterima ,$invoice_tanggal ,$invoice_diskon, $invoice_cashback, $invoice_uangmuka, $invoice_biaya, $invoice_jatuhtempo ,$invoice_penagih, $invoice_keterangan, $invoice_status){
			/*$pattern="INV/".date("y/m")."/";
			$invoice_no=$this->m_public_function->get_kode_1('master_invoice','invoice_no',$pattern,14);
	*/		
			$pattern="PT/".date("ym")."-";
			$invoice_no_auto=$this->m_public_function->get_kode_1('master_invoice','invoice_no_auto',$pattern,12);
	
			$data = array(
				"invoice_no"=>$invoice_no, 
				"invoice_no_auto"=>$invoice_no_auto,
				"invoice_supplier"=>$invoice_supplier, 
				"invoice_noterima"=>$invoice_noterima, 
				"invoice_tanggal"=>$invoice_tanggal, 
				"invoice_diskon"=>$invoice_diskon,
				"invoice_cashback"=>$invoice_cashback,
				"invoice_uangmuka"=>$invoice_uangmuka,
				"invoice_biaya"=>$invoice_biaya,
				"invoice_jatuhtempo"=>$invoice_jatuhtempo, 
				"invoice_penagih"=>$invoice_penagih,
				"invoice_keterangan"=>$invoice_keterangan,
				"invoice_status"=>$invoice_status
				
			);
			$this->db->insert('master_invoice', $data); 
			if($this->db->affected_rows())
				return $this->db->insert_id();
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
		function master_invoice_search($invoice_id ,$invoice_no ,$invoice_no_auto, $invoice_supplier ,$invoice_noterima ,$invoice_tanggal ,$invoice_diskon, $invoice_cashback, $invoice_uangmuka, $invoice_biaya,$invoice_jatuhtempo ,$invoice_penagih , $invoice_keterangan, $invoice_status, $start,$end){
			//full query
			$query="SELECT * FROM vu_trans_invoice";
			
			if($invoice_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " invoice_id LIKE '%".$invoice_id."%'";
			};
			if($invoice_no!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " no_bukti LIKE '%".$invoice_no."%'";
			};
			
			if($invoice_no_auto!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " no_bukti_auto LIKE '%".$invoice_no_auto."%'";
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
				$query.= " tanggal LIKE '%".$invoice_tanggal."%'";
			};
			if($invoice_jatuhtempo!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " invoice_jatuhtempo LIKE '%".$invoice_jatuhtempo."%'";
			};
			if($invoice_penagih!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " invoice_penagih LIKE '%".$invoice_penagih."%'";
			};
			
			if($invoice_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " invoice_keterangan LIKE '%".$invoice_keterangan."%'";
			};
			
			if($invoice_status!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " invoice_status LIKE '%".$invoice_status."%'";
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
		function master_invoice_print($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noterima ,$invoice_tanggal ,$invoice_diskon, $invoice_cashback, $invoice_uangmuka, $invoice_biaya, $invoice_jatuhtempo ,$invoice_penagih ,$option,$filter){
			//full query
			$query="SELECT * FROM vu_trans_invoice";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (invoice_id LIKE '%".addslashes($filter)."%' OR no_bukti LIKE '%".addslashes($filter)."%' OR invoice_supplier LIKE '%".addslashes($filter)."%' OR invoice_noterima LIKE '%".addslashes($filter)."%' OR tanggal LIKE '%".addslashes($filter)."%' OR invoice_jatuhtempo LIKE '%".addslashes($filter)."%' OR invoice_penagih LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($invoice_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_id LIKE '%".$invoice_id."%'";
				};
				if($invoice_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " no_bukti LIKE '%".$invoice_no."%'";
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
					$query.= " tanggal LIKE '%".$invoice_tanggal."%'";
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
		function master_invoice_export_excel($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noterima ,$invoice_tanggal,$invoice_diskon, $invoice_cashback, $invoice_uangmuka, $invoice_biaya, $invoice_jatuhtempo ,$invoice_penagih ,$option,$filter){
			//full query
			$query="SELECT tanggal as Tanggal, no_bukti as 'No Tagihan', terima_no as 'No Penerimaan', supplier_nama as 'Supplier'
					,jumlah_barang as 'Jumlah Item', total_nilai as 'Sub Total', invoice_diskon as 'Diskon (%)', invoice_cashback
					as 'Diskon (Rp)', invoice_biaya 'Biaya', total_nilai+invoice_biaya-invoice_cashback-(total_nilai*invoice_diskon/100) as
					'Total Nilai', invoice_uangmuka as 'Uang Muka',  total_nilai+invoice_biaya-invoice_cashback-(total_nilai*invoice_diskon/100)-invoice_uangmuka as 'Sisa tagihan', invoice_jatuhtempo as 'Jatuh Tempo' 
					FROM vu_trans_invoice";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (invoice_id LIKE '%".addslashes($filter)."%' OR no_bukti LIKE '%".addslashes($filter)."%' OR invoice_supplier LIKE '%".addslashes($filter)."%' OR invoice_noterima LIKE '%".addslashes($filter)."%' OR tanggal LIKE '%".addslashes($filter)."%' OR invoice_jatuhtempo LIKE '%".addslashes($filter)."%' OR invoice_penagih LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($invoice_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_id LIKE '%".$invoice_id."%'";
				};
				if($invoice_no!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " no_bukti LIKE '%".$invoice_no."%'";
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
					$query.= " tanggal LIKE '%".$invoice_tanggal."%'";
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