<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_jual_paket Model
	+ Description	: For record model process back-end
	+ Filename 		: c_master_jual_paket.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 20/Aug/2009 10:59:01
	
*/

class M_master_jual_paket extends Model{
		
		//constructor
		function M_master_jual_paket() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_detail_jual_paket_list($master_id,$query,$start,$end) {
			$query = "SELECT detail_jual_paket.*,master_jual_paket.jpaket_bayar,master_jual_paket.jpaket_diskon,dpaket_harga*dpaket_jumlah as dpaket_subtotal,dpaket_harga*dpaket_jumlah*((100-dpaket_diskon)/100) as dpaket_subtotal_net FROM detail_jual_paket LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id) WHERE dpaket_master='".$master_id."'";
			
			//$query = "SELECT *,dpaket_harga*dpaket_jumlah as dpaket_subtotal, dpaket_harga*dpaket_jumlah*(100-dpaket_diskon)/100 as dpaket_subtotal_net FROM detail_jual_paket where dpaket_master='".$master_id."'";
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
			$query = "SELECT max(jpaket_id) as master_id from master_jual_paket";
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
		function detail_detail_jual_paket_purge($master_id){
			$sql="DELETE from detail_jual_paket where dpaket_master='".$master_id."'";
			$result=$this->db->query($sql);
			
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_jual_pakets at the same time :
			/*if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM detail_jual_paket WHERE dpaket_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM detail_jual_paket WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "dpaket_id= ".$pkid[$i];
					if($i<sizeof($pkid)-1){
						$query = $query . " OR ";
					}     
				}
				$this->db->query($query);
			}
			if($this->db->affected_rows()>0)
				return '1';
			else
				return '0';*/
			
		}
		//*eof
		
		//insert detail record
		function detail_detail_jual_paket_insert($dpaket_id ,$dpaket_master ,$dpaket_paket, $dpaket_kadaluarsa ,$dpaket_jumlah ,$dpaket_harga ,$dpaket_diskon,$dpaket_diskon_jenis,$dpaket_sales ){
			//if master id not capture from view then capture it from max pk from master table
			if($dpaket_master=="" || $dpaket_master==NULL){
				$dpaket_master=$this->get_master_id();
			}
			if($dpaket_kadaluarsa=="")
				$dpaket_kadaluarsa=NULL;
			
			/*$sql="SELECT dpaket_id FROM detail_jual_paket WHERE dpaket_id='$dpaket_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$data = array(
					"dpaket_paket"=>$dpaket_paket,
					"dpaket_kadaluarsa"=>$dpaket_kadaluarsa, 
					"dpaket_jumlah"=>$dpaket_jumlah, 
					"dpaket_harga"=>$dpaket_harga, 
					"dpaket_diskon"=>$dpaket_diskon,
					"dpaket_diskon_jenis"=>$dpaket_diskon_jenis,
					"dpaket_sales"=>$dpaket_sales 
				);
				$this->db->where('dpaket_id', $dpaket_id);
				$this->db->update('detail_jual_paket', $data);
				if($this->db->affected_rows())
					return '1';
				else
					return '0';
			}else{*/
				$data = array(
					"dpaket_master"=>$dpaket_master, 
					"dpaket_paket"=>$dpaket_paket,
					"dpaket_kadaluarsa"=>$dpaket_kadaluarsa, 
					"dpaket_jumlah"=>$dpaket_jumlah, 
					"dpaket_harga"=>$dpaket_harga, 
					"dpaket_diskon"=>$dpaket_diskon,
					"dpaket_diskon_jenis"=>$dpaket_diskon_jenis,
					"dpaket_sales"=>$dpaket_sales 
				);
				$this->db->insert('detail_jual_paket', $data); 
				if($this->db->affected_rows())
					return '1';
				else
					return '0';
			//}

		}
		//end of function
		
		//function for get list record
		function master_jual_paket_list($filter,$start,$end){
			$query = "SELECT * FROM master_jual_paket,customer where jpaket_cust=cust_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jpaket_id LIKE '%".addslashes($filter)."%' OR jpaket_nobukti LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR jpaket_tanggal LIKE '%".addslashes($filter)."%' OR jpaket_diskon LIKE '%".addslashes($filter)."%' OR jpaket_cara LIKE '%".addslashes($filter)."%' OR jpaket_keterangan LIKE '%".addslashes($filter)."%' )";
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
		function master_jual_paket_update($jpaket_id ,$jpaket_nobukti ,$jpaket_cust ,$jpaket_tanggal ,$jpaket_diskon ,$jpaket_cara ,$jpaket_cara2 ,$jpaket_cara3 ,$jpaket_keterangan , $jpaket_cashback, $jpaket_tunai_nilai, $jpaket_tunai_nilai2, $jpaket_tunai_nilai3, $jpaket_voucher_no, $jpaket_voucher_cashback, $jpaket_voucher_no2, $jpaket_voucher_cashback2, $jpaket_voucher_no3, $jpaket_voucher_cashback3, $jpaket_bayar, $jpaket_subtotal, $jpaket_hutang, $jpaket_kwitansi_no, $jpaket_kwitansi_nama, $jpaket_kwitansi_nilai, $jpaket_kwitansi_no2, $jpaket_kwitansi_nama2, $jpaket_kwitansi_nilai2, $jpaket_kwitansi_no3, $jpaket_kwitansi_nama3, $jpaket_kwitansi_nilai3, $jpaket_card_nama, $jpaket_card_edc, $jpaket_card_no, $jpaket_card_nilai, $jpaket_card_nama2, $jpaket_card_edc2, $jpaket_card_no2, $jpaket_card_nilai2, $jpaket_card_nama3, $jpaket_card_edc3, $jpaket_card_no3, $jpaket_card_nilai3, $jpaket_cek_nama, $jpaket_cek_no, $jpaket_cek_valid, $jpaket_cek_bank, $jpaket_cek_nilai, $jpaket_cek_nama2, $jpaket_cek_no2, $jpaket_cek_valid2, $jpaket_cek_bank2, $jpaket_cek_nilai2, $jpaket_cek_nama3, $jpaket_cek_no3, $jpaket_cek_valid3, $jpaket_cek_bank3, $jpaket_cek_nilai3, $jpaket_transfer_bank, $jpaket_transfer_nama, $jpaket_transfer_nilai, $jpaket_transfer_bank2, $jpaket_transfer_nama2, $jpaket_transfer_nilai2, $jpaket_transfer_bank3, $jpaket_transfer_nama3, $jpaket_transfer_nilai3){
			if($jpaket_diskon=="")
				$jpaket_diskon=0;
			$data = array(
				"jpaket_nobukti"=>$jpaket_nobukti, 
				"jpaket_tanggal"=>$jpaket_tanggal, 
				"jpaket_diskon"=>$jpaket_diskon,
				"jpaket_cashback"=>$jpaket_cashback,
				"jpaket_bayar"=>$jpaket_bayar,
				"jpaket_cara"=>$jpaket_cara, 
				//"jpaket_cara2"=>$jpaket_cara2, 
				//"jpaket_cara3"=>$jpaket_cara3,
				"jpaket_keterangan"=>$jpaket_keterangan 
			);
			if($jpaket_cara2!=null)
				$data["jpaket_cara2"]=$jpaket_cara2;
			if($jpaket_cara3!=null)
				$data["jpaket_cara3"]=$jpaket_cara3;
			$sql="select cust_id from customer where cust_id='".$jpaket_cust."'";
			$query=$this->db->query($sql);
			if($query->num_rows())
				$data["jpaket_cust"]=$jpaket_cust;
			
			$this->db->where('jpaket_id', $jpaket_id);
			$this->db->update('master_jual_paket', $data);
			if($this->db->affected_rows() || $this->db->affected_rows()==0){
				
				//delete all transaksi
				$sql="delete from jual_kwitansi where jkwitansi_ref='".$jpaket_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_card where jcard_ref='".$jpaket_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_cek where jcek_ref='".$jpaket_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_transfer where jtransfer_ref='".$jpaket_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_kredit where jkredit_ref='".$jpaket_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_tunai where jtunai_ref='".$jpaket_nobukti."'";
				$this->db->query($sql);
				
				if($jpaket_cara!=null || $jpaket_cara!=''){
					//kwitansi
					if($jpaket_cara=='kwitansi'){
						if($jpaket_kwitansi_nama=="" || $jpaket_kwitansi_nama==NULL){
							if(is_int($jpaket_kwitansi_nama)){
								$sql="select cust_nama from customer where cust_id='".$jpaket_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpaket_kwitansi_nama=$data->cust_nama;
								}
							}else{
									$jpaket_kwitansi_nama=$jpaket_cust;
							}
						}
						$data=array(
							"jkwitansi_no"=>$jpaket_kwitansi_no,
							"jkwitansi_nilai"=>$jpaket_hutang,
							"jkwitansi_ref"=>$jpaket_nobukti
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jpaket_cara=='card'){
						
						$data=array(
							"jcard_nama"=>$jpaket_card_nama,
							"jcard_edc"=>$jpaket_card_edc,
							"jcard_no"=>$jpaket_card_no,
							"jcard_nilai"=>$jpaket_card_nilai,
							"jcard_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_card', $data); 
					
					}else if($jpaket_cara=='cek/giro'){
						
						if($jpaket_cek_nama=="" || $jpaket_cek_nama==NULL){
							if(is_int($jpaket_cek_nama)){
								$sql="select cust_nama from customer where cust_id='".$jpaket_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpaket_cek_nama=$data->cust_nama;
								}
							}else{
									$jpaket_cek_nama=$jpaket_cust;
							}
						}
						$data=array(
							"jcek_nama"=>$jpaket_cek_nama,
							"jcek_no"=>$jpaket_cek_no,
							"jcek_valid"=>$jpaket_cek_valid,
							"jcek_bank"=>$jpaket_cek_bank,
							"jcek_nilai"=>$jpaket_cek_nilai,
							"jcek_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jpaket_cara=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jpaket_transfer_bank,
							"jtransfer_nama"=>$jpaket_transfer_nama,
							"jtransfer_nilai"=>$jpaket_transfer_nilai,
							"jtransfer_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jpaket_cara=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jpaket_tunai_nilai,
							"jtunai_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_tunai', $data); 
					}
				}
				if($jpaket_cara2!=null || $jpaket_cara2!=''){
					//kwitansi
					if($jpaket_cara2=='kwitansi'){
						if($jpaket_kwitansi_nama2=="" || $jpaket_kwitansi_nama2==NULL){
							if(is_int($jpaket_kwitansi_nama2)){
								$sql="select cust_nama from customer where cust_id='".$jpaket_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpaket_kwitansi_nama2=$data->cust_nama;
								}
							}else{
									$jpaket_kwitansi_nama2=$jpaket_cust;
							}
						}
						$data=array(
							"jkwitansi_no"=>$jpaket_kwitansi_no2,
							"jkwitansi_nilai"=>$jpaket_hutang,
							"jkwitansi_ref"=>$jpaket_nobukti
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jpaket_cara2=='card'){
						$data=array(
							"jcard_nama"=>$jpaket_card_nama2,
							"jcard_edc"=>$jpaket_card_edc2,
							"jcard_no"=>$jpaket_card_no2,
							"jcard_nilai"=>$jpaket_card_nilai2,
							"jcard_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_card', $data); 
					
					}else if($jpaket_cara2=='cek/giro'){
						
						if($jpaket_cek_nama2=="" || $jpaket_cek_nama2==NULL){
							if(is_int($jpaket_cek_nama2)){
								$sql="select cust_nama from customer where cust_id='".$jpaket_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpaket_cek_nama2=$data->cust_nama;
								}
							}else{
									$jpaket_cek_nama2=$jpaket_cust;
							}
						}
						$data=array(
							"jcek_nama"=>$jpaket_cek_nama2,
							"jcek_no"=>$jpaket_cek_no2,
							"jcek_valid"=>$jpaket_cek_valid2,
							"jcek_bank"=>$jpaket_cek_bank2,
							"jcek_nilai"=>$jpaket_cek_nilai,
							"jcek_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jpaket_cara2=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jpaket_transfer_bank2,
							"jtransfer_nama"=>$jpaket_transfer_nama2,
							"jtransfer_nilai"=>$jpaket_transfer_nilai2,
							"jtransfer_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jpaket_cara2=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jpaket_tunai_nilai2,
							"jtunai_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_tunai', $data); 
					}
				}
				if($jpaket_cara3!=null || $jpaket_cara3!=''){
					//kwitansi
					if($jpaket_cara3=='kwitansi'){
						if($jpaket_kwitansi_nama3=="" || $jpaket_kwitansi_nama3==NULL){
							if(is_int($jpaket_kwitansi_nama3)){
								$sql="select cust_nama from customer where cust_id='".$jpaket_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpaket_kwitansi_nama3=$data->cust_nama;
								}
							}else{
									$jpaket_kwitansi_nama3=$jpaket_cust;
							}
						}
						$data=array(
							"jkwitansi_no"=>$jpaket_kwitansi_no3,
							"jkwitansi_nilai"=>$jpaket_hutang,
							"jkwitansi_ref"=>$jpaket_nobukti
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jpaket_cara3=='card'){
						
						$data=array(
							"jcard_nama"=>$jpaket_card_nama3,
							"jcard_edc"=>$jpaket_card_edc3,
							"jcard_no"=>$jpaket_card_no3,
							"jcard_nilai"=>$jpaket_hutang,
							"jcard_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_card', $data); 
					
					}else if($jpaket_cara3=='cek/giro'){
						
						if($jpaket_cek_nama3=="" || $jpaket_cek_nama3==NULL){
							if(is_int($jpaket_cek_nama3)){
								$sql="select cust_nama from customer where cust_id='".$jpaket_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpaket_cek_nama3=$data->cust_nama;
								}
							}else{
									$jpaket_cek_nama3=$jpaket_cust;
							}
						}
						$data=array(
							"jcek_nama"=>$jpaket_cek_nama3,
							"jcek_no"=>$jpaket_cek_no3,
							"jcek_valid"=>$jpaket_cek_valid3,
							"jcek_bank"=>$jpaket_cek_bank3,
							"jcek_nilai"=>$jpaket_cek_nilai,
							"jcek_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jpaket_cara3=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jpaket_transfer_bank3,
							"jtransfer_nama"=>$jpaket_transfer_nama3,
							"jtransfer_nilai"=>$jpaket_transfer_nilai3,
							"jtransfer_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jpaket_cara3=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jpaket_tunai_nilai3,
							"jtunai_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_tunai', $data); 
					}
				}
				
				return '1';
			}
			else{
				return '0';
			}
		}
		
		//function for create new record
		function master_jual_paket_create($jpaket_nobukti ,$jpaket_cust ,$jpaket_tanggal ,$jpaket_diskon ,$jpaket_cara ,$jpaket_cara2 ,$jpaket_cara3 ,$jpaket_keterangan , $jpaket_cashback, $jpaket_tunai_nilai, $jpaket_tunai_nilai2, $jpaket_tunai_nilai3, $jpaket_voucher_no, $jpaket_voucher_cashback, $jpaket_voucher_no2, $jpaket_voucher_cashback2, $jpaket_voucher_no3, $jpaket_voucher_cashback3, $jpaket_bayar, $jpaket_subtotal, $jpaket_hutang, $jpaket_kwitansi_no, $jpaket_kwitansi_nama, $jpaket_kwitansi_nilai, $jpaket_kwitansi_no2, $jpaket_kwitansi_nama2, $jpaket_kwitansi_nilai2, $jpaket_kwitansi_no3, $jpaket_kwitansi_nama3, $jpaket_kwitansi_nilai3, $jpaket_card_nama, $jpaket_card_edc, $jpaket_card_no, $jpaket_card_nilai, $jpaket_card_nama2, $jpaket_card_edc2, $jpaket_card_no2, $jpaket_card_nilai2, $jpaket_card_nama3, $jpaket_card_edc3, $jpaket_card_no3, $jpaket_card_nilai3, $jpaket_cek_nama, $jpaket_cek_no, $jpaket_cek_valid, $jpaket_cek_bank, $jpaket_cek_nilai, $jpaket_cek_nama2, $jpaket_cek_no2, $jpaket_cek_valid2, $jpaket_cek_bank2, $jpaket_cek_nilai2, $jpaket_cek_nama3, $jpaket_cek_no3, $jpaket_cek_valid3, $jpaket_cek_bank3, $jpaket_cek_nilai3, $jpaket_transfer_bank, $jpaket_transfer_nama, $jpaket_transfer_nilai, $jpaket_transfer_bank2, $jpaket_transfer_nama2, $jpaket_transfer_nilai2, $jpaket_transfer_bank3, $jpaket_transfer_nama3, $jpaket_transfer_nilai3){
			$pattern="FK/".date("ym")."-";
			$jpaket_nobukti=$this->m_public_function->get_kode_1('master_jual_paket','jpaket_nobukti',$pattern,13);
			
			$data = array(
				"jpaket_nobukti"=>$jpaket_nobukti, 
				"jpaket_cust"=>$jpaket_cust, 
				"jpaket_tanggal"=>$jpaket_tanggal, 
				"jpaket_diskon"=>$jpaket_diskon, 
				"jpaket_cashback"=>$jpaket_cashback,
				"jpaket_bayar"=>$jpaket_bayar,
				"jpaket_cara"=>$jpaket_cara, 
				//"jpaket_cara2"=>$jpaket_cara2, 
				//"jpaket_cara3"=>$jpaket_cara3, 
				"jpaket_keterangan"=>$jpaket_keterangan 
			);
			if($jpaket_cara2!=null)
				$data["jpaket_cara2"]=$jpaket_cara2;
			if($jpaket_cara3!=null)
				$data["jpaket_cara3"]=$jpaket_cara3;
			$this->db->insert('master_jual_paket', $data); 
			if($this->db->affected_rows()){
				
				//delete all transaksi
				/*$sql="delete from jual_kwitansi where jkwitansi_ref='".$jpaket_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_card where jcard_ref='".$jpaket_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_cek where jcek_ref='".$jpaket_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_transfer where jtransfer_ref='".$jpaket_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_kredit where jkredit_ref='".$jpaket_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_tunai where jtunai_ref='".$jpaket_nobukti."'";
				$this->db->query($sql);*/
				
				if($jpaket_cara!=null || $jpaket_cara!=''){
					//kwitansi
					if($jpaket_cara=='kwitansi'){
						if($jpaket_kwitansi_nama=="" || $jpaket_kwitansi_nama==NULL){
							if(is_int($jpaket_kwitansi_nama)){
								$sql="select cust_nama from customer where cust_id='".$jpaket_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpaket_kwitansi_nama=$data->cust_nama;
								}
							}else{
									$jpaket_kwitansi_nama=$jpaket_cust;
							}
						}
						$data=array(
							"jkwitansi_no"=>$jpaket_kwitansi_no,
							"jkwitansi_nilai"=>$jpaket_hutang,
							"jkwitansi_ref"=>$jpaket_nobukti
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jpaket_cara=='card'){
						
						$data=array(
							"jcard_nama"=>$jpaket_card_nama,
							"jcard_edc"=>$jpaket_card_edc,
							"jcard_no"=>$jpaket_card_no,
							"jcard_nilai"=>$jpaket_card_nilai,
							"jcard_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_card', $data); 
					
					}else if($jpaket_cara=='cek/giro'){
						
						if($jpaket_cek_nama=="" || $jpaket_cek_nama==NULL){
							if(is_int($jpaket_cek_nama)){
								$sql="select cust_nama from customer where cust_id='".$jpaket_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpaket_cek_nama=$data->cust_nama;
								}
							}else{
									$jpaket_cek_nama=$jpaket_cust;
							}
						}
						$data=array(
							"jcek_nama"=>$jpaket_cek_nama,
							"jcek_no"=>$jpaket_cek_no,
							"jcek_valid"=>$jpaket_cek_valid,
							"jcek_bank"=>$jpaket_cek_bank,
							"jcek_nilai"=>$jpaket_cek_nilai,
							"jcek_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jpaket_cara=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jpaket_transfer_bank,
							"jtransfer_nama"=>$jpaket_transfer_nama,
							"jtransfer_nilai"=>$jpaket_transfer_nilai,
							"jtransfer_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jpaket_cara=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jpaket_tunai_nilai,
							"jtunai_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_tunai', $data); 
					}
				}
				if($jpaket_cara2!=null || $jpaket_cara2!=''){
					//kwitansi
					if($jpaket_cara2=='kwitansi'){
						if($jpaket_kwitansi_nama2=="" || $jpaket_kwitansi_nama2==NULL){
							if(is_int($jpaket_kwitansi_nama2)){
								$sql="select cust_nama from customer where cust_id='".$jpaket_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpaket_kwitansi_nama2=$data->cust_nama;
								}
							}else{
									$jpaket_kwitansi_nama2=$jpaket_cust;
							}
						}
						$data=array(
							"jkwitansi_no"=>$jpaket_kwitansi_no2,
							"jkwitansi_nilai"=>$jpaket_hutang,
							"jkwitansi_ref"=>$jpaket_nobukti
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jpaket_cara2=='card'){
						$data=array(
							"jcard_nama"=>$jpaket_card_nama2,
							"jcard_edc"=>$jpaket_card_edc2,
							"jcard_no"=>$jpaket_card_no2,
							"jcard_nilai"=>$jpaket_card_nilai2,
							"jcard_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_card', $data); 
					
					}else if($jpaket_cara2=='cek/giro'){
						
						if($jpaket_cek_nama2=="" || $jpaket_cek_nama2==NULL){
							if(is_int($jpaket_cek_nama2)){
								$sql="select cust_nama from customer where cust_id='".$jpaket_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpaket_cek_nama2=$data->cust_nama;
								}
							}else{
									$jpaket_cek_nama2=$jpaket_cust;
							}
						}
						$data=array(
							"jcek_nama"=>$jpaket_cek_nama2,
							"jcek_no"=>$jpaket_cek_no2,
							"jcek_valid"=>$jpaket_cek_valid2,
							"jcek_bank"=>$jpaket_cek_bank2,
							"jcek_nilai"=>$jpaket_cek_nilai,
							"jcek_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jpaket_cara2=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jpaket_transfer_bank2,
							"jtransfer_nama"=>$jpaket_transfer_nama2,
							"jtransfer_nilai"=>$jpaket_transfer_nilai2,
							"jtransfer_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jpaket_cara2=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jpaket_tunai_nilai2,
							"jtunai_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_tunai', $data); 
					}
				}
				if($jpaket_cara3!=null || $jpaket_cara3!=''){
					//kwitansi
					if($jpaket_cara3=='kwitansi'){
						if($jpaket_kwitansi_nama3=="" || $jpaket_kwitansi_nama3==NULL){
							if(is_int($jpaket_kwitansi_nama3)){
								$sql="select cust_nama from customer where cust_id='".$jpaket_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpaket_kwitansi_nama3=$data->cust_nama;
								}
							}else{
									$jpaket_kwitansi_nama3=$jpaket_cust;
							}
						}
						$data=array(
							"jkwitansi_no"=>$jpaket_kwitansi_no3,
							"jkwitansi_nilai"=>$jpaket_hutang,
							"jkwitansi_ref"=>$jpaket_nobukti
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jpaket_cara3=='card'){
						
						$data=array(
							"jcard_nama"=>$jpaket_card_nama3,
							"jcard_edc"=>$jpaket_card_edc3,
							"jcard_no"=>$jpaket_card_no3,
							"jcard_nilai"=>$jpaket_hutang,
							"jcard_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_card', $data); 
					
					}else if($jpaket_cara3=='cek/giro'){
						
						if($jpaket_cek_nama3=="" || $jpaket_cek_nama3==NULL){
							if(is_int($jpaket_cek_nama3)){
								$sql="select cust_nama from customer where cust_id='".$jpaket_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jpaket_cek_nama3=$data->cust_nama;
								}
							}else{
									$jpaket_cek_nama3=$jpaket_cust;
							}
						}
						$data=array(
							"jcek_nama"=>$jpaket_cek_nama3,
							"jcek_no"=>$jpaket_cek_no3,
							"jcek_valid"=>$jpaket_cek_valid3,
							"jcek_bank"=>$jpaket_cek_bank3,
							"jcek_nilai"=>$jpaket_cek_nilai,
							"jcek_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jpaket_cara3=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jpaket_transfer_bank3,
							"jtransfer_nama"=>$jpaket_transfer_nama3,
							"jtransfer_nilai"=>$jpaket_transfer_nilai3,
							"jtransfer_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jpaket_cara3=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jpaket_tunai_nilai3,
							"jtunai_ref"=>$jpaket_nobukti
							);
						$this->db->insert('jual_tunai', $data); 
					}
				}
				
				return '1';
			}
			else
				return '0';
		}
		
		//fcuntion for delete record
		function master_jual_paket_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_jual_pakets at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM master_jual_paket WHERE jpaket_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM master_jual_paket WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "jpaket_id= ".$pkid[$i];
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
		function master_jual_paket_search($jpaket_id ,$jpaket_nobukti ,$jpaket_cust ,$jpaket_tanggal ,$jpaket_diskon ,$jpaket_cashback ,$jpaket_voucher ,$jpaket_cara ,$jpaket_bayar ,$jpaket_keterangan ,$start,$end){
			//full query
			$query="SELECT * FROM master_jual_paket,customer WHERE jpaket_cust=cust_id";
			
			if($jpaket_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpaket_id LIKE '%".$jpaket_id."%'";
			};
			if($jpaket_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpaket_nobukti LIKE '%".$jpaket_nobukti."%'";
			};
			if($jpaket_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_nama LIKE '%".$jpaket_cust."%'";
			};
			if($jpaket_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpaket_tanggal LIKE '%".$jpaket_tanggal."%'";
			};
			if($jpaket_diskon!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpaket_diskon LIKE '%".$jpaket_diskon."%'";
			};
			if($jpaket_cara!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpaket_cara LIKE '%".$jpaket_cara."%'";
			};
			if($jpaket_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpaket_keterangan LIKE '%".$jpaket_keterangan."%'";
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
		function master_jual_paket_print($jpaket_id ,$jpaket_nobukti ,$jpaket_cust ,$jpaket_tanggal ,$jpaket_diskon ,$jpaket_cara ,$jpaket_keterangan ,$option,$filter){
			//full query
			$query="select * from master_jual_paket";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jpaket_id LIKE '%".addslashes($filter)."%' OR jpaket_nobukti LIKE '%".addslashes($filter)."%' OR jpaket_cust LIKE '%".addslashes($filter)."%' OR jpaket_tanggal LIKE '%".addslashes($filter)."%' OR jpaket_diskon LIKE '%".addslashes($filter)."%' OR jpaket_cara LIKE '%".addslashes($filter)."%' OR jpaket_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jpaket_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpaket_id LIKE '%".$jpaket_id."%'";
				};
				if($jpaket_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpaket_nobukti LIKE '%".$jpaket_nobukti."%'";
				};
				if($jpaket_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpaket_cust LIKE '%".$jpaket_cust."%'";
				};
				if($jpaket_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpaket_tanggal LIKE '%".$jpaket_tanggal."%'";
				};
				if($jpaket_diskon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpaket_diskon LIKE '%".$jpaket_diskon."%'";
				};
				if($jpaket_cara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpaket_cara LIKE '%".$jpaket_cara."%'";
				};
				if($jpaket_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpaket_keterangan LIKE '%".$jpaket_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function master_jual_paket_export_excel($jpaket_id ,$jpaket_nobukti ,$jpaket_cust ,$jpaket_tanggal ,$jpaket_diskon ,$jpaket_cara ,$jpaket_keterangan ,$option,$filter){
			//full query
			$query="select * from master_jual_paket";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jpaket_id LIKE '%".addslashes($filter)."%' OR jpaket_nobukti LIKE '%".addslashes($filter)."%' OR jpaket_cust LIKE '%".addslashes($filter)."%' OR jpaket_tanggal LIKE '%".addslashes($filter)."%' OR jpaket_diskon LIKE '%".addslashes($filter)."%' OR jpaket_cara LIKE '%".addslashes($filter)."%' OR jpaket_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($jpaket_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpaket_id LIKE '%".$jpaket_id."%'";
				};
				if($jpaket_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpaket_nobukti LIKE '%".$jpaket_nobukti."%'";
				};
				if($jpaket_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpaket_cust LIKE '%".$jpaket_cust."%'";
				};
				if($jpaket_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpaket_tanggal LIKE '%".$jpaket_tanggal."%'";
				};
				if($jpaket_diskon!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpaket_diskon LIKE '%".$jpaket_diskon."%'";
				};
				if($jpaket_cara!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpaket_cara LIKE '%".$jpaket_cara."%'";
				};
				if($jpaket_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " jpaket_keterangan LIKE '%".$jpaket_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>