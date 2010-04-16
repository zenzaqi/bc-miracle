<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: vu_stok_all_saldo Model
	+ Description	: For record model process back-end
	+ Filename 		: c_vu_stok_all_saldo.php
 	+ creator 		: 
 	+ Created on 09/Apr/2010 10:47:15
	
*/

class M_vu_stok_all_saldo extends Model{
		
		//constructor
		function M_vu_stok_all_saldo() {
			parent::Model();
		}
		
		function get_detail_stok($produk_id,$query,$start,$end){
			$sql="select * from gudang";
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			
			$limit = $sql." LIMIT ".$start.",".$end;		
			$result = $this->db->query($limit);  
			$i=0;
			foreach($result->result() as $row){
				if($row->gudang_id==1)
				{
					$data[$i]["gudang_id"]=$row->gudang_id;
					$data[$i]["gudang_nama"]=$row->gudang_nama;
						
					$sql="SELECT * FROM vu_stok_gudang_besar_saldo WHERE produk_id='".$produk_id."'";
					$rs_gb=$this->db->query($sql);
					if($rs_gb->num_rows())
					{
						$ds=$rs_gb->row();
						$data[$i]["jumlah_stok"]=$ds->jumlah_stok;
					}else
						$data[$i]["jumlah_stok"]=0;
				}elseif($row->gudang_id==2)
				{
					$data[$i]["gudang_id"]=$row->gudang_id;
					$data[$i]["gudang_nama"]=$row->gudang_nama;
						
					$sql="SELECT * FROM vu_stok_gudang_produk_saldo WHERE produk_id='".$produk_id."'";
					$rs_gb=$this->db->query($sql);
					if($rs_gb->num_rows())
					{
						$ds=$rs_gb->row();
						$data[$i]["jumlah_stok"]=$ds->jumlah_stok;
					}else
						$data[$i]["jumlah_stok"]=0;
				}else{
					$data[$i]["gudang_id"]=$row->gudang_id;
					$data[$i]["gudang_nama"]=$row->gudang_nama;
						
					$sql="SELECT * FROM vu_stok_gudang_all WHERE produk_id='".$produk_id."' AND gudang_id='".$row->gudang_id."'";
					$rs_gb=$this->db->query($sql);
					if($rs_gb->num_rows())
					{
						$ds=$rs_gb->row();
						$data[$i]["jumlah_stok"]=$ds->jumlah_stok;
					}else
						$data[$i]["jumlah_stok"]=0;
				}
				$i++;
			}
			
			if($nbrows>0){
				
				$jsonresult = json_encode($data);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
			
		}
		
		//function for get list record
		function vu_stok_all_saldo_list($filter,$start,$end){
			$query = "SELECT * FROM vu_stok_all_saldo";
		
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (produk_id LIKE '%".addslashes($filter)."%' OR produk_nama LIKE '%".addslashes($filter)."%' OR satuan_id LIKE '%".addslashes($filter)."%' OR satuan_nama LIKE '%".addslashes($filter)."%' OR stok_saldo LIKE '%".addslashes($filter)."%'  OR produk_kode LIKE '%".addslashes($filter)."%')";
			}
			//echo $query;
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			if($end<=0) $end=15;
			$limit = $query." LIMIT ".$start.",".$end;		
			$result = $this->db->query($limit);  
			//echo $limit;
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
		
		
	
		//function for advanced search record
		function vu_stok_all_saldo_search($produk_kode ,$produk_nama,$satuan_nama ,$stok_saldo ,$start,$end){
			//full query
			$query="select * from vu_stok_all_saldo";
			
			if($produk_kode!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_id LIKE '%".$produk_kode."%'";
			};
			if($produk_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_nama LIKE '%".$produk_nama."%'";
			};
			if($satuan_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " satuan_nama LIKE '%".$satuan_nama."%'";
			};
			if($stok_saldo!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " stok_saldo LIKE '%".$stok_saldo."%'";
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
		function vu_stok_all_saldo_print($produk_id ,$produk_nama ,$satuan_id ,$satuan_nama ,$stok_saldo ,$option,$filter){
			//full query
			$sql="select * from vu_stok_all_saldo";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (produk_id LIKE '%".addslashes($filter)."%' OR produk_nama LIKE '%".addslashes($filter)."%' OR satuan_id LIKE '%".addslashes($filter)."%' OR satuan_nama LIKE '%".addslashes($filter)."%' OR stok_saldo LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($produk_id!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " produk_id LIKE '%".$produk_id."%'";
				};
				if($produk_nama!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " produk_nama LIKE '%".$produk_nama."%'";
				};
				if($satuan_id!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " satuan_id LIKE '%".$satuan_id."%'";
				};
				if($satuan_nama!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " satuan_nama LIKE '%".$satuan_nama."%'";
				};
				if($stok_saldo!=''){
					$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$sql.= " stok_saldo LIKE '%".$stok_saldo."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query->result();
		}
		
		//function  for export to excel
		function vu_stok_all_saldo_export_excel($produk_id ,$produk_nama ,$satuan_id ,$satuan_nama ,$stok_saldo ,$option,$filter){
			//full query
			$sql="select * from vu_stok_all_saldo";
			if($option=='LIST'){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (produk_id LIKE '%".addslashes($filter)."%' OR produk_nama LIKE '%".addslashes($filter)."%' OR satuan_id LIKE '%".addslashes($filter)."%' OR satuan_nama LIKE '%".addslashes($filter)."%' OR stok_saldo LIKE '%".addslashes($filter)."%' )";
				$query = $this->db->query($sql);
			} else if($option=='SEARCH'){
				if($produk_id!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " produk_id LIKE '%".$produk_id."%'";
				};
				if($produk_nama!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " produk_nama LIKE '%".$produk_nama."%'";
				};
				if($satuan_id!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " satuan_id LIKE '%".$satuan_id."%'";
				};
				if($satuan_nama!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " satuan_nama LIKE '%".$satuan_nama."%'";
				};
				if($stok_saldo!=''){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.= " stok_saldo LIKE '%".$stok_saldo."%'";
				};
				$query = $this->db->query($sql);
			}
			return $query;
		}
		
}
?>