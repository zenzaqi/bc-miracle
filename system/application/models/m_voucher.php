<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: voucher Model
	+ Description	: For record model process back-end
	+ Filename 		: c_voucher.php
 	+ Author  		: 
 	+ Created on 27/Aug/2009 06:40:41
	
*/

class M_voucher extends Model{
		
		//constructor
		function M_voucher() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_voucher_berlaku_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM voucher_berlaku where bvoucher_master='".$master_id."'";
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
		
		function get_promo_list(){
			$query = "SELECT * from promo";
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
		
		function get_voucher_kupon_list($master_id,$query,$start,$end) {
			$query = "SELECT * from voucher_kupon where kvoucher_master='".$master_id."'";
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
		
		//get master id, note : not done yet
		function get_master_id() {
			$query = "SELECT max(voucher_id) as master_id from voucher";
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
		
		function get_voucher_nomor($pattern){
			$result=$this->m_public_function->get_kode_1("voucher_kupon","kvoucher_nomor",$pattern,10);
			return $result;
		}
		
		//purge all detail from master
		function detail_voucher_berlaku_purge($master_id){
			$sql="DELETE from voucher_berlaku where bvoucher_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_voucher_berlaku_insert($bvoucher_id ,$bvoucher_master ,$bvoucher_produk ){
			//if master id not capture from view then capture it from max pk from master table
			if($bvoucher_master=="" || $bvoucher_master==NULL){
				$bvoucher_master=$this->get_master_id();
			}
			
			$data = array(
				"bvoucher_master"=>$bvoucher_master, 
				"bvoucher_produk"=>$bvoucher_produk 
			);
			$this->db->insert('voucher_berlaku', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0'.mysql_error();

		}
		//end of function
		
		//function for get list record
		function voucher_list($filter,$start,$end){
			$query = "SELECT * FROM voucher";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (voucher_id LIKE '%".addslashes($filter)."%' OR voucher_nama LIKE '%".addslashes($filter)."%' OR voucher_jenis LIKE '%".addslashes($filter)."%' OR voucher_point LIKE '%".addslashes($filter)."%' OR voucher_jumlah LIKE '%".addslashes($filter)."%' OR voucher_kadaluarsa LIKE '%".addslashes($filter)."%' OR voucher_cashback LIKE '%".addslashes($filter)."%' OR voucher_mincash LIKE '%".addslashes($filter)."%' OR voucher_diskon LIKE '%".addslashes($filter)."%' OR voucher_promo LIKE '%".addslashes($filter)."%' OR voucher_allproduk LIKE '%".addslashes($filter)."%' OR voucher_allrawat LIKE '%".addslashes($filter)."%' )";
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
		function voucher_update($voucher_id ,$voucher_nama ,$voucher_jenis ,$voucher_point ,$voucher_jumlah ,$voucher_kadaluarsa ,$voucher_cashback ,$voucher_mincash ,$voucher_diskon ,$voucher_promo ,$voucher_allproduk ,$voucher_allrawat ){
			$data = array(
				"voucher_id"=>$voucher_id, 
				"voucher_nama"=>$voucher_nama, 
				"voucher_jenis"=>$voucher_jenis, 
				"voucher_point"=>$voucher_point, 
				"voucher_jumlah"=>$voucher_jumlah, 
				"voucher_kadaluarsa"=>$voucher_kadaluarsa, 
				"voucher_cashback"=>$voucher_cashback, 
				"voucher_mincash"=>$voucher_mincash, 
				"voucher_diskon"=>$voucher_diskon, 
				"voucher_promo"=>$voucher_promo, 
				"voucher_allproduk"=>$voucher_allproduk, 
				"voucher_allrawat"=>$voucher_allrawat 
			);
			$this->db->where('voucher_id', $voucher_id);
			$this->db->update('voucher', $data);
			
			return '1';
		}
		
		//function for create new record
		function voucher_create($voucher_nama ,$voucher_jenis ,$voucher_point ,$voucher_jumlah ,$voucher_kadaluarsa ,$voucher_cashback ,$voucher_mincash ,$voucher_diskon ,$voucher_promo ,$voucher_allproduk ,$voucher_allrawat ){
			$data = array(
				"voucher_nama"=>$voucher_nama, 
				"voucher_jenis"=>$voucher_jenis, 
				"voucher_point"=>$voucher_point, 
				"voucher_jumlah"=>$voucher_jumlah, 
				"voucher_kadaluarsa"=>$voucher_kadaluarsa, 
				"voucher_cashback"=>$voucher_cashback, 
				"voucher_mincash"=>$voucher_mincash, 
				"voucher_diskon"=>$voucher_diskon, 
				"voucher_promo"=>$voucher_promo, 
				"voucher_allproduk"=>$voucher_allproduk, 
				"voucher_allrawat"=>$voucher_allrawat 
			);
			$this->db->insert('voucher', $data); 
			if($this->db->affected_rows()){
				$this->db->trans_start();
				for($i=0;$i<$voucher_jumlah;$i++){
					$sql="insert into voucher_kupon(kvoucher_master,kvoucher_nomor) values('".$this->get_master_id()."','".$this->get_voucher_nomor('MVO')."')";
					$this->db->query($sql);
				}
				$this->db->trans_complete(); 
				
				return '1';
			}else
				return '0';
		}
		
		//fcuntion for delete record
		function voucher_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the vouchers at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM voucher WHERE voucher_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM voucher WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "voucher_id= ".$pkid[$i];
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
		function voucher_search($voucher_id ,$voucher_nama ,$voucher_jenis ,$voucher_point ,$voucher_jumlah ,$voucher_kadaluarsa ,$voucher_cashback ,$voucher_mincash ,$voucher_diskon ,$voucher_promo ,$voucher_allproduk ,$voucher_allrawat ,$start,$end){
			//full query
			$query="select * from voucher";
			
			if($voucher_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_id LIKE '%".$voucher_id."%'";
			};
			if($voucher_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_nama LIKE '%".$voucher_nama."%'";
			};
			if($voucher_jenis!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_jenis LIKE '%".$voucher_jenis."%'";
			};
			if($voucher_point!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_point LIKE '%".$voucher_point."%'";
			};
			if($voucher_jumlah!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_jumlah LIKE '%".$voucher_jumlah."%'";
			};
			if($voucher_kadaluarsa!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_kadaluarsa LIKE '%".$voucher_kadaluarsa."%'";
			};
			if($voucher_cashback!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_cashback LIKE '%".$voucher_cashback."%'";
			};
			if($voucher_mincash!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_mincash LIKE '%".$voucher_mincash."%'";
			};
			if($voucher_diskon!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_diskon LIKE '%".$voucher_diskon."%'";
			};
			if($voucher_promo!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_promo LIKE '%".$voucher_promo."%'";
			};
			if($voucher_allproduk!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_allproduk LIKE '%".$voucher_allproduk."%'";
			};
			if($voucher_allrawat!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_allrawat LIKE '%".$voucher_allrawat."%'";
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
		function voucher_print($voucher_id ,$voucher_nama ,$voucher_jenis ,$voucher_point ,$voucher_jumlah ,$voucher_kadaluarsa ,$voucher_cashback ,$voucher_mincash ,$voucher_diskon ,$voucher_promo ,$voucher_allproduk ,$voucher_allrawat ,$option,$filter){
			//full query
			$query="select * from voucher";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (voucher_id LIKE '%".addslashes($filter)."%' OR voucher_nama LIKE '%".addslashes($filter)."%' OR voucher_jenis LIKE '%".addslashes($filter)."%' OR voucher_point LIKE '%".addslashes($filter)."%' OR voucher_jumlah LIKE '%".addslashes($filter)."%' OR voucher_kadaluarsa LIKE '%".addslashes($filter)."%' OR voucher_cashback LIKE '%".addslashes($filter)."%' OR voucher_mincash LIKE '%".addslashes($filter)."%' OR voucher_diskon LIKE '%".addslashes($filter)."%' OR voucher_promo LIKE '%".addslashes($filter)."%' OR voucher_allproduk LIKE '%".addslashes($filter)."%' OR voucher_allrawat LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($voucher_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_id LIKE '%".$voucher_id."%'";
				};
				if($voucher_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_nama LIKE '%".$voucher_nama."%'";
				};
				if($voucher_jenis!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_jenis LIKE '%".$voucher_jenis."%'";
				};
				if($voucher_point!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_point LIKE '%".$voucher_point."%'";
				};
				if($voucher_jumlah!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_jumlah LIKE '%".$voucher_jumlah."%'";
				};
				if($voucher_kadaluarsa!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_kadaluarsa LIKE '%".$voucher_kadaluarsa."%'";
				};
				if($voucher_cashback!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_cashback LIKE '%".$voucher_cashback."%'";
				};
				if($voucher_mincash!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_mincash LIKE '%".$voucher_mincash."%'";
				};
				if($voucher_diskon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_diskon LIKE '%".$voucher_diskon."%'";
				};
				if($voucher_promo!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_promo LIKE '%".$voucher_promo."%'";
				};
				if($voucher_allproduk!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_allproduk LIKE '%".$voucher_allproduk."%'";
				};
				if($voucher_allrawat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_allrawat LIKE '%".$voucher_allrawat."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function voucher_export_excel($voucher_id ,$voucher_nama ,$voucher_jenis ,$voucher_point ,$voucher_jumlah ,$voucher_kadaluarsa ,$voucher_cashback ,$voucher_mincash ,$voucher_diskon ,$voucher_promo ,$voucher_allproduk ,$voucher_allrawat ,$option,$filter){
			//full query
			$query="select * from voucher";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (voucher_id LIKE '%".addslashes($filter)."%' OR voucher_nama LIKE '%".addslashes($filter)."%' OR voucher_jenis LIKE '%".addslashes($filter)."%' OR voucher_point LIKE '%".addslashes($filter)."%' OR voucher_jumlah LIKE '%".addslashes($filter)."%' OR voucher_kadaluarsa LIKE '%".addslashes($filter)."%' OR voucher_cashback LIKE '%".addslashes($filter)."%' OR voucher_mincash LIKE '%".addslashes($filter)."%' OR voucher_diskon LIKE '%".addslashes($filter)."%' OR voucher_promo LIKE '%".addslashes($filter)."%' OR voucher_allproduk LIKE '%".addslashes($filter)."%' OR voucher_allrawat LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($voucher_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_id LIKE '%".$voucher_id."%'";
				};
				if($voucher_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_nama LIKE '%".$voucher_nama."%'";
				};
				if($voucher_jenis!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_jenis LIKE '%".$voucher_jenis."%'";
				};
				if($voucher_point!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_point LIKE '%".$voucher_point."%'";
				};
				if($voucher_jumlah!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_jumlah LIKE '%".$voucher_jumlah."%'";
				};
				if($voucher_kadaluarsa!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_kadaluarsa LIKE '%".$voucher_kadaluarsa."%'";
				};
				if($voucher_cashback!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_cashback LIKE '%".$voucher_cashback."%'";
				};
				if($voucher_mincash!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_mincash LIKE '%".$voucher_mincash."%'";
				};
				if($voucher_diskon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_diskon LIKE '%".$voucher_diskon."%'";
				};
				if($voucher_promo!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_promo LIKE '%".$voucher_promo."%'";
				};
				if($voucher_allproduk!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_allproduk LIKE '%".$voucher_allproduk."%'";
				};
				if($voucher_allrawat!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " voucher_allrawat LIKE '%".$voucher_allrawat."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>