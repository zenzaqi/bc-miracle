<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_jual_produk Model
	+ Description	: For record model process back-end
	+ Filename 		: c_master_jual_produk.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 20/Aug/2009 10:59:01
	
*/

class M_master_jual_produk extends Model{
		
		//constructor
		function M_master_jual_produk() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_detail_jual_produk_list($master_id,$query,$start,$end) {
			$query = "SELECT *,dproduk_harga*dproduk_jumlah as dproduk_subtotal, dproduk_harga*dproduk_jumlah*(100-dproduk_diskon)/100 as dproduk_subtotal_net FROM detail_jual_produk WHERE dproduk_master='".$master_id."'";
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
			$query = "SELECT max(jproduk_id) as master_id from master_jual_produk";
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
		function detail_detail_jual_produk_purge($master_id){
			$sql="DELETE from detail_jual_produk where dproduk_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_detail_jual_produk_insert($dproduk_id ,$dproduk_master ,$dproduk_produk ,$dproduk_jumlah ,$dproduk_harga ,$dproduk_diskon,$dproduk_diskon_jenis,$dproduk_sales ){
			//if master id not capture from view then capture it from max pk from master table
			if($dproduk_master=="" || $dproduk_master==NULL){
				$dproduk_master=$this->get_master_id();
			}
			
			$sql="select produk_satuan from produk where produk_id='".$dproduk_produk."'";
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				$dproduk_satuan=$data->produk_satuan;
			}else
				$dproduk_satuan=0;
				
			$data = array(
				"dproduk_master"=>$dproduk_master, 
				"dproduk_produk"=>$dproduk_produk, 
				"dproduk_satuan"=>$dproduk_satuan, 
				"dproduk_jumlah"=>$dproduk_jumlah, 
				"dproduk_harga"=>$dproduk_harga, 
				"dproduk_diskon"=>$dproduk_diskon,
				"dproduk_diskon_jenis"=>$dproduk_diskon_jenis,
				"dproduk_sales"=>$dproduk_sales 
			);
			$this->db->insert('detail_jual_produk', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function master_jual_produk_list($filter,$start,$end){
			$query = "SELECT * FROM master_jual_produk,customer where jproduk_cust=cust_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jproduk_id LIKE '%".addslashes($filter)."%' OR jproduk_nobukti LIKE '%".addslashes($filter)."%' OR jproduk_cust LIKE '%".addslashes($filter)."%' OR jproduk_tanggal LIKE '%".addslashes($filter)."%' OR jproduk_diskon LIKE '%".addslashes($filter)."%' OR jproduk_cara LIKE '%".addslashes($filter)."%' OR jproduk_cara2 LIKE '%".addslashes($filter)."%' OR jproduk_cara3 LIKE '%".addslashes($filter)."%' OR jproduk_keterangan LIKE '%".addslashes($filter)."%' )";
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
		function master_jual_produk_update($jproduk_id ,$jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal ,$jproduk_diskon ,$jproduk_cara ,$jproduk_cara2 ,$jproduk_cara3 ,$jproduk_keterangan , $jproduk_cashback, $jproduk_voucher_no, $jproduk_voucher_cashback, $jproduk_voucher_no2, $jproduk_voucher_cashback2, $jproduk_voucher_no3, $jproduk_voucher_cashback3, $jproduk_bayar, $jproduk_total, $jproduk_total_bayar, $jproduk_kwitansi_no, $jproduk_kwitansi_nama, $jproduk_kwitansi_nilai, $jproduk_kwitansi_no2, $jproduk_kwitansi_nama2, $jproduk_kwitansi_nilai2, $jproduk_kwitansi_no3, $jproduk_kwitansi_nama3, $jproduk_kwitansi_nilai3, $jproduk_card_nama, $jproduk_card_edc, $jproduk_card_nilai, $jproduk_card_nama2, $jproduk_card_edc2, $jproduk_card_nilai2, $jproduk_card_nama3, $jproduk_card_edc3, $jproduk_card_nilai3, $jproduk_cek_nama, $jproduk_cek_no, $jproduk_cek_valid, $jproduk_cek_bank, $jproduk_cek_nilai, $jproduk_cek_nama2, $jproduk_cek_no2, $jproduk_cek_valid2, $jproduk_cek_bank2, $jproduk_cek_nilai2, $jproduk_cek_nama3, $jproduk_cek_no3, $jproduk_cek_valid3, $jproduk_cek_bank3, $jproduk_cek_nilai3, $jproduk_transfer_bank, $jproduk_transfer_nilai, $jproduk_transfer_bank2, $jproduk_transfer_nilai2, $jproduk_transfer_bank3, $jproduk_transfer_nilai3){
			$data = array(
				"jproduk_id"=>$jproduk_id, 
				"jproduk_nobukti"=>$jproduk_nobukti, 
				"jproduk_tanggal"=>$jproduk_tanggal, 
				"jproduk_diskon"=>$jproduk_diskon,
				"jproduk_cashback"=>$jproduk_cashback,
				"jproduk_bayar"=>$jproduk_bayar,
				"jproduk_cara"=>$jproduk_cara, 
				"jproduk_cara2"=>$jproduk_cara2, 
				"jproduk_cara3"=>$jproduk_cara3,
				"jproduk_keterangan"=>$jproduk_keterangan 
			);
			$sql="select cust_id from customer where cust_id='".$jproduk_cust."'";
			$query=$this->db->query($sql);
			if($query->num_rows())
				$data["jproduk_cust"]=$jproduk_cust;
				
			$this->db->where('jproduk_id', $jproduk_id);
			$this->db->update('master_jual_produk', $data);
			
			//delete all transaksi
			$sql="delete from jual_kwitansi where jkwitansi_ref='".$jproduk_nobukti."'";
			$this->db->query($sql);
			$sql="delete from jual_card where jcard_ref='".$jproduk_nobukti."'";
			$this->db->query($sql);
			$sql="delete from jual_cek where jcek_ref='".$jproduk_nobukti."'";
			$this->db->query($sql);
			$sql="delete from jual_transfer where jtransfer_ref='".$jproduk_nobukti."'";
			$this->db->query($sql);
			$sql="delete from jual_kredit where jkredit_ref='".$jproduk_nobukti."'";
			$this->db->query($sql);
			
			//kwitansi
			if($jproduk_cara=='kwitansi'){
				$data=array(
					"jkwitansi_no"=>$jproduk_kwitansi_no,
					"jkwitansi_nilai"=>$jproduk_total_bayar,
					"jkwitansi_ref"=>$jproduk_nobukti
					);
				$this->db->insert('jual_kwitansi', $data); 
			
			}else if($jproduk_cara=='card'){
				
				$data=array(
					"jcard_nama"=>$jproduk_card_nama,
					"jcard_edc"=>$jproduk_card_edc,
					"jcard_nilai"=>$jproduk_total_bayar,
					"jcard_ref"=>$jproduk_nobukti
					);
				$this->db->insert('jual_card', $data); 
			
			}else if($jproduk_cara=='cek/giro'){
				
				if($jproduk_cek_nama=="" || $jproduk_cek_nama==NULL){
					if(is_int($jproduk_cek_nama)){
						$sql="select cust_nama from customer where cust_id='".$jproduk_cust."'";
						$query=$this->db->query($sql);
						if($query->num_rows()){
							$data=$query->row();
							$jproduk_cek_nama=$data->cust_nama;
						}
					}else{
							$jproduk_cek_nama=$jproduk_cust;
					}
				}
				$data=array(
					"jcek_nama"=>$jproduk_cek_nama,
					"jcek_no"=>$jproduk_cek_no,
					"jcek_valid"=>$jproduk_cek_valid,
					"jcek_bank"=>$jproduk_cek_bank,
					"jcek_nilai"=>$jproduk_total_bayar,
					"jcek_ref"=>$jproduk_nobukti
					);
				$this->db->insert('jual_cek', $data); 
			}else if($jproduk_cara=='transfer'){
				$data=array(
					"jtransfer_bank"=>$jproduk_transfer_bank,
					"jtransfer_nilai"=>$jproduk_total_bayar,
					"jtransfer_ref"=>$jproduk_nobukti
					);
				$this->db->insert('jual_transfer', $data); 
			}else if($jproduk_cara=='kredit'){
				$jproduk_kredit_cust=0;
				if(!is_int($jproduk_cust)){
					$sql="select jproduk_cust from master_jual_produk where jproduk_id='".$jproduk_id."'";
					$query=$this->db->query($sql);
					if($query->num_rows()){
						$data=$query->row();
						$jproduk_kredit_cust=$data->jproduk_cust;
					}
				}else{
						$jproduk_kredit_cust=$jproduk_cust;
				}

				$data=array(
					"jkredit_cust"=>$jproduk_kredit_cust,
					"jkredit_nilai"=>$jproduk_total_bayar,
					"jkredit_ref"=>$jproduk_nobukti
					);
				$this->db->insert('jual_kredit', $data); 
			}
			
			return '1';
		}
		
		//function for create new record
		function master_jual_produk_create($jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal ,$jproduk_diskon ,$jproduk_cara ,$jproduk_cara2 ,$jproduk_cara3 ,$jproduk_keterangan , $jproduk_cashback, $jproduk_voucher_no, $jproduk_voucher_cashback, $jproduk_voucher_no2, $jproduk_voucher_cashback2, $jproduk_voucher_no3, $jproduk_voucher_cashback3, $jproduk_bayar, $jproduk_total, $jproduk_total_bayar, $jproduk_kwitansi_no, $jproduk_kwitansi_nama, $jproduk_kwitansi_nilai, $jproduk_kwitansi_no2, $jproduk_kwitansi_nama2, $jproduk_kwitansi_nilai2, $jproduk_kwitansi_no3, $jproduk_kwitansi_nama3, $jproduk_kwitansi_nilai3, $jproduk_card_nama, $jproduk_card_edc, $jproduk_card_nilai, $jproduk_card_nama2, $jproduk_card_edc2, $jproduk_card_nilai2, $jproduk_card_nama3, $jproduk_card_edc3, $jproduk_card_nilai3, $jproduk_cek_nama, $jproduk_cek_no, $jproduk_cek_valid, $jproduk_cek_bank, $jproduk_cek_nilai, $jproduk_cek_nama2, $jproduk_cek_no2, $jproduk_cek_valid2, $jproduk_cek_bank2, $jproduk_cek_nilai2, $jproduk_cek_nama3, $jproduk_cek_no3, $jproduk_cek_valid3, $jproduk_cek_bank3, $jproduk_cek_nilai3, $jproduk_transfer_bank, $jproduk_transfer_nilai, $jproduk_transfer_bank2, $jproduk_transfer_nilai2, $jproduk_transfer_bank3, $jproduk_transfer_nilai3){
			
			$pattern="FT/".date("y/m")."/";
			$jproduk_nobukti=$this->m_public_function->get_kode_1('master_jual_produk','jproduk_nobukti',$pattern,13);
			
			$data = array(
				"jproduk_nobukti"=>$jproduk_nobukti, 
				"jproduk_cust"=>$jproduk_cust, 
				"jproduk_tanggal"=>$jproduk_tanggal, 
				"jproduk_diskon"=>$jproduk_diskon, 
				"jproduk_cashback"=>$jproduk_cashback,
				"jproduk_bayar"=>$jproduk_bayar,
				"jproduk_cara"=>$jproduk_cara, 
				"jproduk_cara2"=>$jproduk_cara2, 
				"jproduk_cara3"=>$jproduk_cara3, 
				"jproduk_keterangan"=>$jproduk_keterangan 
			);
			$this->db->insert('master_jual_produk', $data); 
			if($this->db->affected_rows()){
				
				//delete all transaksi
				$sql="delete from jual_kwitansi where jkwitansi_ref='".$jproduk_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_card where jcard_ref='".$jproduk_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_cek where jcek_ref='".$jproduk_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_transfer where jtransfer_ref='".$jproduk_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_kredit where jkredit_ref='".$jproduk_nobukti."'";
				$this->db->query($sql);
				
				//kwitansi
				if($jproduk_cara=='kwitansi'){
					if($jproduk_kwitansi_nama=="" || $jproduk_kwitansi_nama==NULL){
						if(is_int($jproduk_kwitansi_nama)){
							$sql="select cust_nama from customer where cust_id='".$jproduk_cust."'";
							$query=$this->db->query($sql);
							if($query->num_rows()){
								$data=$query->row();
								$jproduk_kwitansi_nama=$data->cust_nama;
							}
						}else{
								$jproduk_kwitansi_nama=$jproduk_cust;
						}
					}
					$data=array(
						"jkwitansi_no"=>$jproduk_kwitansi_no,
						"jkwitansi_nilai"=>$jproduk_total_bayar,
						"jkwitansi_ref"=>$jproduk_nobukti
					);
					$this->db->insert('jual_kwitansi', $data); 
				
				}else if($jproduk_cara=='card'){
					
					$data=array(
						"jcard_nama"=>$jproduk_card_nama,
						"jcard_edc"=>$jproduk_card_edc,
						"jcard_nilai"=>$jproduk_total_bayar,
						"jcard_ref"=>$jproduk_nobukti
						);
					$this->db->insert('jual_card', $data); 
				
				}else if($jproduk_cara=='cek/giro'){
					
					if($jproduk_cek_nama=="" || $jproduk_cek_nama==NULL){
						if(is_int($jproduk_cek_nama)){
							$sql="select cust_nama from customer where cust_id='".$jproduk_cust."'";
							$query=$this->db->query($sql);
							if($query->num_rows()){
								$data=$query->row();
								$jproduk_cek_nama=$data->cust_nama;
							}
						}else{
								$jproduk_cek_nama=$jproduk_cust;
						}
					}
					$data=array(
						"jcek_nama"=>$jproduk_cek_nama,
						"jcek_no"=>$jproduk_cek_no,
						"jcek_valid"=>$jproduk_cek_valid,
						"jcek_bank"=>$jproduk_cek_bank,
						"jcek_nilai"=>$jproduk_total_bayar,
						"jcek_ref"=>$jproduk_nobukti
						);
					$this->db->insert('jual_cek', $data); 
				}else if($jproduk_cara=='transfer'){
					
					$data=array(
						"jtransfer_bank"=>$jproduk_transfer_bank,
						"jtransfer_nilai"=>$jproduk_total_bayar,
						"jtransfer_ref"=>$jproduk_nobukti
						);
					$this->db->insert('jual_transfer', $data); 
				}
				return '1';
			}
			else
				return '0';
		}
		
		//fcuntion for delete record
		function master_jual_produk_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_jual_produks at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM master_jual_produk WHERE jproduk_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM master_jual_produk WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "jproduk_id= ".$pkid[$i];
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
		function master_jual_produk_search($jproduk_id ,$jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal ,$jproduk_diskon ,$jproduk_cara ,$jproduk_keterangan ,$start,$end){
			//full query
			$query="select * from master_jual_produk";
			
			if($jproduk_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jproduk_id LIKE '%".$jproduk_id."%'";
			};
			if($jproduk_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jproduk_nobukti LIKE '%".$jproduk_nobukti."%'";
			};
			if($jproduk_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jproduk_cust LIKE '%".$jproduk_cust."%'";
			};
			if($jproduk_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jproduk_tanggal LIKE '%".$jproduk_tanggal."%'";
			};
			if($jproduk_diskon!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jproduk_diskon LIKE '%".$jproduk_diskon."%'";
			};
			if($jproduk_cara!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jproduk_cara LIKE '%".$jproduk_cara."%'";
			};
			if($jproduk_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jproduk_keterangan LIKE '%".$jproduk_keterangan."%'";
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
		function master_jual_produk_print($jproduk_id ,$jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal ,$jproduk_diskon ,$jproduk_cara ,$jproduk_keterangan ,$option,$filter){
			//full query
			$query="select * from master_jual_produk";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jproduk_id LIKE '%".addslashes($filter)."%' OR jproduk_nobukti LIKE '%".addslashes($filter)."%' OR jproduk_cust LIKE '%".addslashes($filter)."%' OR jproduk_tanggal LIKE '%".addslashes($filter)."%' OR jproduk_diskon LIKE '%".addslashes($filter)."%' OR jproduk_cara LIKE '%".addslashes($filter)."%' OR jproduk_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jproduk_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_id LIKE '%".$jproduk_id."%'";
				};
				if($jproduk_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_nobukti LIKE '%".$jproduk_nobukti."%'";
				};
				if($jproduk_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_cust LIKE '%".$jproduk_cust."%'";
				};
				if($jproduk_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_tanggal LIKE '%".$jproduk_tanggal."%'";
				};
				if($jproduk_diskon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_diskon LIKE '%".$jproduk_diskon."%'";
				};
				if($jproduk_cara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_cara LIKE '%".$jproduk_cara."%'";
				};
				if($jproduk_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_keterangan LIKE '%".$jproduk_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function master_jual_produk_export_excel($jproduk_id ,$jproduk_nobukti ,$jproduk_cust ,$jproduk_tanggal ,$jproduk_diskon ,$jproduk_cara ,$jproduk_keterangan ,$option,$filter){
			//full query
			$query="select * from master_jual_produk";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jproduk_id LIKE '%".addslashes($filter)."%' OR jproduk_nobukti LIKE '%".addslashes($filter)."%' OR jproduk_cust LIKE '%".addslashes($filter)."%' OR jproduk_tanggal LIKE '%".addslashes($filter)."%' OR jproduk_diskon LIKE '%".addslashes($filter)."%' OR jproduk_cara LIKE '%".addslashes($filter)."%' OR jproduk_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jproduk_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_id LIKE '%".$jproduk_id."%'";
				};
				if($jproduk_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_nobukti LIKE '%".$jproduk_nobukti."%'";
				};
				if($jproduk_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_cust LIKE '%".$jproduk_cust."%'";
				};
				if($jproduk_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_tanggal LIKE '%".$jproduk_tanggal."%'";
				};
				if($jproduk_diskon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_diskon LIKE '%".$jproduk_diskon."%'";
				};
				if($jproduk_cara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_cara LIKE '%".$jproduk_cara."%'";
				};
				if($jproduk_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jproduk_keterangan LIKE '%".$jproduk_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>