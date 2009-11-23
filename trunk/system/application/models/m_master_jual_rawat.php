<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_jual_rawat Model
	+ Description	: For record model process back-end
	+ Filename 		: c_master_jual_rawat.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 20/Aug/2009 10:59:01
	
*/

class M_master_jual_rawat extends Model{
		
		//constructor
		function M_master_jual_rawat() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_detail_jual_rawat_list($master_id,$query,$start,$end) {
			$query = "SELECT *,drawat_harga*drawat_jumlah as drawat_subtotal, drawat_harga*drawat_jumlah*(100-drawat_diskon)/100 as drawat_subtotal_net FROM detail_jual_rawat where drawat_master='".$master_id."'";
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
		
		function get_voucher_list($query,$start,$end){
			$query = "SELECT * FROM voucher,voucher_kupon where kvoucher_master=voucher_id";
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
			$query = "SELECT max(jrawat_id) as master_id from master_jual_rawat";
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
		function detail_detail_jual_rawat_purge($master_id){
			$sql="DELETE from detail_jual_rawat where drawat_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_detail_jual_rawat_insert($drawat_id ,$drawat_master ,$drawat_rawat ,$drawat_jumlah ,$drawat_harga ,$drawat_diskon,$drawat_diskon_jenis,$drawat_sales ){
			//if master id not capture from view then capture it from max pk from master table
			if($drawat_master=="" || $drawat_master==NULL){
				$drawat_master=$this->get_master_id();
			}
			
			
			$data = array(
				"drawat_master"=>$drawat_master, 
				"drawat_rawat"=>$drawat_rawat, 
				"drawat_jumlah"=>$drawat_jumlah, 
				"drawat_harga"=>$drawat_harga, 
				"drawat_diskon"=>$drawat_diskon,
				"drawat_diskon_jenis"=>$drawat_diskon_jenis,
				"drawat_sales"=>$drawat_sales 
			);
			$this->db->insert('detail_jual_rawat', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function master_jual_rawat_list($filter,$start,$end){
			$query = "SELECT * FROM master_jual_rawat,customer where jrawat_cust=cust_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jrawat_id LIKE '%".addslashes($filter)."%' OR jrawat_nobukti LIKE '%".addslashes($filter)."%' OR jrawat_cust LIKE '%".addslashes($filter)."%' OR jrawat_tanggal LIKE '%".addslashes($filter)."%' OR jrawat_diskon LIKE '%".addslashes($filter)."%' OR jrawat_cara LIKE '%".addslashes($filter)."%' OR jrawat_keterangan LIKE '%".addslashes($filter)."%' )";
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
		function master_jual_rawat_update($jrawat_id, $jrawat_nobukti ,$jrawat_cust ,$jrawat_tanggal ,$jrawat_diskon ,$jrawat_cara ,$jrawat_keterangan , $jrawat_cashback, $jrawat_voucher, $jrawat_voucher_no, $jrawat_bayar, $jrawat_total, $jrawat_total_bayar, $jrawat_kwitansi_no, $jrawat_card_nama, $jrawat_card_edc, $jrawat_cek_nama, $jrawat_cek_no, $jrawat_cek_valid, $jrawat_cek_bank, $jrawat_transfer_bank ){
			if($jrawat_voucher==true)
				$jrawat_voucher='Y';
			else
				$jrawat_voucher='T';
				
			$data = array(
				"jrawat_id"=>$jrawat_id, 
				"jrawat_nobukti"=>$jrawat_nobukti, 
				"jrawat_tanggal"=>$jrawat_tanggal, 
				"jrawat_diskon"=>$jrawat_diskon,
				"jrawat_voucher"=>$jrawat_voucher, 
				"jrawat_cashback"=>$jrawat_cashback,
				"jrawat_bayar"=>$jrawat_bayar,
				"jrawat_cara"=>$jrawat_cara, 
				"jrawat_keterangan"=>$jrawat_keterangan 
			);
			$sql="select cust_id from customer where cust_id='".$jrawat_cust."'";
			$query=$this->db->query($sql);
			if($query->num_rows())
				$data["jrawat_cust"]=$jrawat_cust;
				
			$this->db->where('jrawat_id', $jrawat_id);
			$this->db->update('master_jual_rawat', $data);
			
			//delete all transaksi
			$sql="delete from jual_kwitansi where jkwitansi_ref='".$jrawat_nobukti."'";
			$this->db->query($sql);
			$sql="delete from jual_card where jcard_ref='".$jrawat_nobukti."'";
			$this->db->query($sql);
			$sql="delete from jual_cek where jcek_ref='".$jrawat_nobukti."'";
			$this->db->query($sql);
			$sql="delete from jual_transfer where jtransfer_ref='".$jrawat_nobukti."'";
			$this->db->query($sql);
			$sql="delete from jual_kredit where jkredit_ref='".$jrawat_nobukti."'";
			$this->db->query($sql);
			
			//kwitansi
			if($jrawat_cara=='kwitansi'){
				$data=array(
					"jkwitansi_no"=>$jrawat_kwitansi_no,
					"jkwitansi_nilai"=>$jrawat_total_bayar,
					"jkwitansi_ref"=>$jrawat_nobukti
					);
				$this->db->insert('jual_kwitansi', $data); 
			
			}else if($jrawat_cara=='card'){
				
				$data=array(
					"jcard_nama"=>$jrawat_card_nama,
					"jcard_edc"=>$jrawat_card_edc,
					"jcard_nilai"=>$jrawat_total_bayar,
					"jcard_ref"=>$jrawat_nobukti
					);
				$this->db->insert('jual_card', $data); 
			
			}else if($jrawat_cara=='cek/giro'){
				
				if($jrawat_cek_nama=="" || $jrawat_cek_nama==NULL){
					if(is_int($jrawat_cek_nama)){
						$sql="select cust_nama from customer where cust_id='".$jrawat_cust."'";
						$query=$this->db->query($sql);
						if($query->num_rows()){
							$data=$query->row();
							$jrawat_cek_nama=$data->cust_nama;
						}
					}else{
							$jrawat_cek_nama=$jrawat_cust;
					}
				}
				$data=array(
					"jcek_nama"=>$jrawat_cek_nama,
					"jcek_no"=>$jrawat_cek_no,
					"jcek_valid"=>$jrawat_cek_valid,
					"jcek_bank"=>$jrawat_cek_bank,
					"jcek_nilai"=>$jrawat_total_bayar,
					"jcek_ref"=>$jrawat_nobukti
					);
				$this->db->insert('jual_cek', $data); 
			}else if($jrawat_cara=='transfer'){
				$data=array(
					"jtransfer_bank"=>$jrawat_transfer_bank,
					"jtransfer_nilai"=>$jrawat_total_bayar,
					"jtransfer_ref"=>$jrawat_nobukti
					);
				$this->db->insert('jual_transfer', $data); 
			}else if($jrawat_cara=='kredit'){
				$jrawat_kredit_cust=0;
				if(!is_int($jrawat_cust)){
					$sql="select jrawat_cust from master_jual_rawat where jrawat_id='".$jrawat_id."'";
					$query=$this->db->query($sql);
					if($query->num_rows()){
						$data=$query->row();
						$jrawat_kredit_cust=$data->jrawat_cust;
					}
				}else{
						$jrawat_kredit_cust=$jrawat_cust;
				}

				$data=array(
					"jkredit_cust"=>$jrawat_kredit_cust,
					"jkredit_nilai"=>$jrawat_total_bayar,
					"jkredit_ref"=>$jrawat_nobukti
					);
				$this->db->insert('jual_kredit', $data); 
			}
			
			return '1';
		}
		
		//function for create new record
		function master_jual_rawat_create($jrawat_nobukti ,$jrawat_cust ,$jrawat_tanggal ,$jrawat_diskon ,$jrawat_cara ,$jrawat_keterangan , $jrawat_cashback, $jrawat_voucher, $jrawat_voucher_no, $jrawat_bayar, $jrawat_total, $jrawat_total_bayar, $jrawat_kwitansi_no, $jrawat_card_nama, $jrawat_card_edc, $jrawat_cek_nama, $jrawat_cek_no, $jrawat_cek_valid, $jrawat_cek_bank, $jrawat_transfer_bank){
			if($jrawat_voucher==true)
				$jrawat_voucher='Y';
			else
				$jrawat_voucher='T';
				
			$data = array(
				"jrawat_nobukti"=>$jrawat_nobukti, 
				"jrawat_cust"=>$jrawat_cust, 
				"jrawat_tanggal"=>$jrawat_tanggal, 
				"jrawat_diskon"=>$jrawat_diskon, 
				"jrawat_voucher"=>$jrawat_voucher, 
				"jrawat_cashback"=>$jrawat_cashback,
				"jrawat_bayar"=>$jrawat_bayar,
				"jrawat_cara"=>$jrawat_cara, 
				"jrawat_keterangan"=>$jrawat_keterangan 
			);
			$this->db->insert('master_jual_rawat', $data); 
			if($this->db->affected_rows()){
				
				//delete all transaksi
				$sql="delete from jual_kwitansi where jkwitansi_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_card where jcard_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_cek where jcek_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_transfer where jtransfer_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_kredit where jkredit_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				
				//kwitansi
				if($jrawat_cara=='kwitansi'){
					if($jrawat_kwitansi_nama=="" || $jrawat_kwitansi_nama==NULL){
						if(is_int($jrawat_kwitansi_nama)){
							$sql="select cust_nama from customer where cust_id='".$jrawat_cust."'";
							$query=$this->db->query($sql);
							if($query->num_rows()){
								$data=$query->row();
								$jrawat_kwitansi_nama=$data->cust_nama;
							}
						}else{
								$jrawat_kwitansi_nama=$jrawat_cust;
						}
					}
					$data=array(
						"jkwitansi_no"=>$jrawat_kwitansi_no,
						"jkwitansi_nilai"=>$jrawat_total_bayar,
						"jkwitansi_ref"=>$jrawat_nobukti
						);
					$this->db->insert('jual_kwitansi', $data); 
				
				}else if($jrawat_cara=='card'){
					
					$data=array(
						"jcard_nama"=>$jrawat_card_nama,
						"jcard_edc"=>$jrawat_card_edc,
						"jcard_nilai"=>$jrawat_total_bayar,
						"jcard_ref"=>$jrawat_nobukti
						);
					$this->db->insert('jual_card', $data); 
				
				}else if($jrawat_cara=='cek/giro'){
					
					if($jrawat_cek_nama=="" || $jrawat_cek_nama==NULL){
						if(is_int($jrawat_cek_nama)){
							$sql="select cust_nama from customer where cust_id='".$jrawat_cust."'";
							$query=$this->db->query($sql);
							if($query->num_rows()){
								$data=$query->row();
								$jrawat_cek_nama=$data->cust_nama;
							}
						}else{
								$jrawat_cek_nama=$jrawat_cust;
						}
					}
					$data=array(
						"jcek_nama"=>$jrawat_cek_nama,
						"jcek_no"=>$jrawat_cek_no,
						"jcek_valid"=>$jrawat_cek_valid,
						"jcek_bank"=>$jrawat_cek_bank,
						"jcek_nilai"=>$jrawat_total_bayar,
						"jcek_ref"=>$jrawat_nobukti
						);
					$this->db->insert('jual_cek', $data); 
				}else if($jrawat_cara=='transfer'){
					

					$data=array(
						"jtransfer_bank"=>$jrawat_transfer_bank,
						"jtransfer_nilai"=>$jrawat_total_bayar,
						"jtransfer_ref"=>$jrawat_nobukti
						);
					$this->db->insert('jual_transfer', $data); 
				}else if($jrawat_cara=='kredit'){
					$jrawat_kredit_cust=0;
					if(!is_int($jrawat_cust)){
						$sql="select jrawat_cust from master_jual_rawat where jrawat_id='".$jrawat_id."'";
						$query=$this->db->query($sql);
						if($query->num_rows()){
							$data=$query->row();
							$jrawat_kredit_cust=$data->jrawat_cust;
						}
					}else{
							$jrawat_kredit_cust=$jrawat_cust;
					}
	
					$data=array(
						"jkredit_cust"=>$jrawat_kredit_cust,
						"jkredit_nilai"=>$jrawat_total_bayar,
						"jkredit_ref"=>$jrawat_nobukti
						);
					$this->db->insert('jual_kredit', $data); 
				}
				
				return '1';
			}
			else
				return '0';
		}
		
		//fcuntion for delete record
		function master_jual_rawat_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_jual_rawats at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM master_jual_rawat WHERE jrawat_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM master_jual_rawat WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "jrawat_id= ".$pkid[$i];
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
		function master_jual_rawat_search($jrawat_id ,$jrawat_nobukti ,$jrawat_cust ,$jrawat_tanggal ,$jrawat_diskon ,$jrawat_cara ,$jrawat_keterangan ,$start,$end){
			//full query
			$query="select * from master_jual_rawat";
			
			if($jrawat_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jrawat_id LIKE '%".$jrawat_id."%'";
			};
			if($jrawat_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jrawat_nobukti LIKE '%".$jrawat_nobukti."%'";
			};
			if($jrawat_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jrawat_cust LIKE '%".$jrawat_cust."%'";
			};
			if($jrawat_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jrawat_tanggal LIKE '%".$jrawat_tanggal."%'";
			};
			if($jrawat_diskon!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jrawat_diskon LIKE '%".$jrawat_diskon."%'";
			};
			if($jrawat_cara!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jrawat_cara LIKE '%".$jrawat_cara."%'";
			};
			if($jrawat_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jrawat_keterangan LIKE '%".$jrawat_keterangan."%'";
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
		function master_jual_rawat_print($jrawat_id ,$jrawat_nobukti ,$jrawat_cust ,$jrawat_tanggal ,$jrawat_diskon ,$jrawat_cara ,$jrawat_keterangan ,$option,$filter){
			//full query
			$query="select * from master_jual_rawat";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jrawat_id LIKE '%".addslashes($filter)."%' OR jrawat_nobukti LIKE '%".addslashes($filter)."%' OR jrawat_cust LIKE '%".addslashes($filter)."%' OR jrawat_tanggal LIKE '%".addslashes($filter)."%' OR jrawat_diskon LIKE '%".addslashes($filter)."%' OR jrawat_cara LIKE '%".addslashes($filter)."%' OR jrawat_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jrawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jrawat_id LIKE '%".$jrawat_id."%'";
				};
				if($jrawat_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jrawat_nobukti LIKE '%".$jrawat_nobukti."%'";
				};
				if($jrawat_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jrawat_cust LIKE '%".$jrawat_cust."%'";
				};
				if($jrawat_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jrawat_tanggal LIKE '%".$jrawat_tanggal."%'";
				};
				if($jrawat_diskon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jrawat_diskon LIKE '%".$jrawat_diskon."%'";
				};
				if($jrawat_cara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jrawat_cara LIKE '%".$jrawat_cara."%'";
				};
				if($jrawat_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jrawat_keterangan LIKE '%".$jrawat_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function master_jual_rawat_export_excel($jrawat_id ,$jrawat_nobukti ,$jrawat_cust ,$jrawat_tanggal ,$jrawat_diskon ,$jrawat_cara ,$jrawat_keterangan ,$option,$filter){
			//full query
			$query="select * from master_jual_rawat";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jrawat_id LIKE '%".addslashes($filter)."%' OR jrawat_nobukti LIKE '%".addslashes($filter)."%' OR jrawat_cust LIKE '%".addslashes($filter)."%' OR jrawat_tanggal LIKE '%".addslashes($filter)."%' OR jrawat_diskon LIKE '%".addslashes($filter)."%' OR jrawat_cara LIKE '%".addslashes($filter)."%' OR jrawat_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jrawat_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jrawat_id LIKE '%".$jrawat_id."%'";
				};
				if($jrawat_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jrawat_nobukti LIKE '%".$jrawat_nobukti."%'";
				};
				if($jrawat_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jrawat_cust LIKE '%".$jrawat_cust."%'";
				};
				if($jrawat_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jrawat_tanggal LIKE '%".$jrawat_tanggal."%'";
				};
				if($jrawat_diskon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jrawat_diskon LIKE '%".$jrawat_diskon."%'";
				};
				if($jrawat_cara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jrawat_cara LIKE '%".$jrawat_cara."%'";
				};
				if($jrawat_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jrawat_keterangan LIKE '%".$jrawat_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>