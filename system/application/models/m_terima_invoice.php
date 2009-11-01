<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: terima_invoice Model
	+ Description	: For record model process back-end
	+ Filename 		: c_terima_invoice.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 15:49:52
	
*/

class M_terima_invoice extends Model{
		
		//constructor
		function M_terima_invoice() {
			parent::Model();
		}
		
		//function for get list record
		function terima_invoice_list($filter,$start,$end){
			$query = "SELECT * FROM terima_invoice,supplier WHERE invoice_supplier=supplier_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (invoice_id LIKE '%".addslashes($filter)."%' OR invoice_no LIKE '%".addslashes($filter)."%' OR invoice_supplier LIKE '%".addslashes($filter)."%' OR invoice_noorder LIKE '%".addslashes($filter)."%' OR invoice_suratjalan LIKE '%".addslashes($filter)."%' OR invoice_tanggal LIKE '%".addslashes($filter)."%' OR invoice_nilai LIKE '%".addslashes($filter)."%' OR invoice_jatuhtempo LIKE '%".addslashes($filter)."%' OR invoice_penagih LIKE '%".addslashes($filter)."%' )";
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
		function terima_invoice_update($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noorder ,$invoice_suratjalan ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih ){
			$data = array(
				"invoice_id"=>$invoice_id, 
				"invoice_no"=>$invoice_no, 
				"invoice_supplier"=>$invoice_supplier, 
				"invoice_noorder"=>$invoice_noorder, 
				"invoice_suratjalan"=>$invoice_suratjalan, 
				"invoice_tanggal"=>$invoice_tanggal, 
				"invoice_nilai"=>$invoice_nilai, 
				"invoice_jatuhtempo"=>$invoice_jatuhtempo,
				"invoice_penagih"=>$invoice_penagih
			);
			$sql="SELECT supplier_id FROM supplier WHERE supplier_id='".$invoice_supplier."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["invoice_supplier"]=$invoice_supplier;
			
			$this->db->where('invoice_id', $invoice_id);
			$this->db->update('terima_invoice', $data);
			
			return '1';
		}
		
		//function for create new record
		function terima_invoice_create($invoice_no ,$invoice_supplier ,$invoice_noorder ,$invoice_suratjalan ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih ){
			$data = array(
				"invoice_no"=>$invoice_no, 
				"invoice_supplier"=>$invoice_supplier, 
				"invoice_noorder"=>$invoice_noorder, 
				"invoice_suratjalan"=>$invoice_suratjalan, 
				"invoice_tanggal"=>$invoice_tanggal, 
				"invoice_nilai"=>$invoice_nilai, 
				"invoice_jatuhtempo"=>$invoice_jatuhtempo,
				"invoice_penagih"=>$invoice_penagih
			);
			$this->db->insert('terima_invoice', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function terima_invoice_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the terima_invoices at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM terima_invoice WHERE invoice_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM terima_invoice WHERE ";
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
		function terima_invoice_search($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noorder ,$invoice_suratjalan ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih ,$start,$end){
			//full query
			$query="select * from terima_invoice";
			
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
			if($invoice_noorder!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " invoice_noorder LIKE '%".$invoice_noorder."%'";
			};
			if($invoice_suratjalan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " invoice_suratjalan LIKE '%".$invoice_suratjalan."%'";
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
		function terima_invoice_print($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noorder ,$invoice_suratjalan ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih ,$option,$filter){
			//full query
			$query="select * from terima_invoice";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (invoice_id LIKE '%".addslashes($filter)."%' OR invoice_no LIKE '%".addslashes($filter)."%' OR invoice_supplier LIKE '%".addslashes($filter)."%' OR invoice_noorder LIKE '%".addslashes($filter)."%' OR invoice_suratjalan LIKE '%".addslashes($filter)."%' OR invoice_tanggal LIKE '%".addslashes($filter)."%' OR invoice_nilai LIKE '%".addslashes($filter)."%' OR invoice_jatuhtempo LIKE '%".addslashes($filter)."%' OR invoice_penagih LIKE '%".addslashes($filter)."%' )";
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
				if($invoice_noorder!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_noorder LIKE '%".$invoice_noorder."%'";
				};
				if($invoice_suratjalan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_suratjalan LIKE '%".$invoice_suratjalan."%'";
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
		function terima_invoice_export_excel($invoice_id ,$invoice_no ,$invoice_supplier ,$invoice_noorder ,$invoice_suratjalan ,$invoice_tanggal ,$invoice_nilai ,$invoice_jatuhtempo ,$invoice_penagih ,$option,$filter){
			//full query
			$query="select * from terima_invoice";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (invoice_id LIKE '%".addslashes($filter)."%' OR invoice_no LIKE '%".addslashes($filter)."%' OR invoice_supplier LIKE '%".addslashes($filter)."%' OR invoice_noorder LIKE '%".addslashes($filter)."%' OR invoice_suratjalan LIKE '%".addslashes($filter)."%' OR invoice_tanggal LIKE '%".addslashes($filter)."%' OR invoice_nilai LIKE '%".addslashes($filter)."%' OR invoice_jatuhtempo LIKE '%".addslashes($filter)."%' OR invoice_penagih LIKE '%".addslashes($filter)."%' )";
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
				if($invoice_noorder!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_noorder LIKE '%".$invoice_noorder."%'";
				};
				if($invoice_suratjalan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " invoice_suratjalan LIKE '%".$invoice_suratjalan."%'";
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