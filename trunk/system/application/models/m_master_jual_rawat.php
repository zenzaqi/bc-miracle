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
		
		//fungsi untuk pengambilan paket
		//get record list
		function detail_ambil_paket_list($master_id,$query,$start,$end) {
			$date_now=date('Y-m-d');
			/* ambil history pengambilan paket dari $master_id===customer_id untuk transaksi hari ini */
			//$query = "SELECT jpaket_nobukti, paket_nama, rawat_nama, hapaket_jumlah, cust_nama FROM history_ambil_paket LEFT JOIN detail_jual_paket ON(hapaket_dpaket=dpaket_id) LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id) LEFT JOIN perawatan ON(hapaket_rawat=rawat_id) LEFT JOIN paket ON(dpaket_paket=paket_id) LEFT JOIN customer ON(hapaket_cust=cust_id) WHERE hapaket_cust='$master_id' AND date_format(hapaket_date_create, '%Y-%m-%d') = '$date_now'";
			$query = "SELECT jpaket_nobukti, paket_nama, rawat_nama, hapaket_jumlah, cust_nama FROM history_ambil_paket LEFT JOIN detail_jual_paket ON(hapaket_dpaket=dpaket_id) LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id) LEFT JOIN perawatan ON(hapaket_rawat=rawat_id) LEFT JOIN paket ON(dpaket_paket=paket_id) LEFT JOIN customer ON(hapaket_cust=cust_id) WHERE hapaket_cust='$master_id'";
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
		
		//function for detail
		//get record list
		function detail_detail_jual_rawat_list($master_id,$query,$start,$end) {
			//$query = "SELECT *,drawat_harga*drawat_jumlah as drawat_subtotal, drawat_harga*drawat_jumlah*(100-drawat_diskon)/100 as drawat_subtotal_net FROM detail_jual_rawat where drawat_master='".$master_id."'";
			$query = "SELECT drawat_id,drawat_master,drawat_rawat,drawat_jumlah,perawatan.rawat_harga as drawat_harga,drawat_diskon,drawat_sales,drawat_diskon_jenis,drawat_harga*drawat_jumlah as drawat_subtotal, drawat_harga*drawat_jumlah*(100-drawat_diskon)/100 as drawat_subtotal_net FROM detail_jual_rawat LEFT JOIN perawatan ON(rawat_id=drawat_rawat) WHERE drawat_master='".$master_id."'";
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
			$sql = "SELECT * FROM voucher,voucher_kupon WHERE kvoucher_master=voucher_id";
			if ($query<>""){
				$sql .=eregi("WHERE",$sql)? " AND ":" WHERE ";
				$sql .= " (kvoucher_nomor LIKE '%".addslashes($query)."%')";
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
		function detail_detail_jual_rawat_insert($drawat_id ,$drawat_master ,$drawat_rawat ,$drawat_jumlah ,$drawat_harga ,$drawat_diskon,$drawat_diskon_jenis,$drawat_sales ,$jrawat_id){
			//if master id not capture from view then capture it from max pk from master table
			if($drawat_master=="" || $drawat_master==NULL){
				$drawat_master=$this->get_master_id();
			}else{
				$drawat_master=$jrawat_id;
			}
			
			$sql="SELECT drawat_id FROM detail_jual_rawat WHERE drawat_id='$drawat_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$data = array(
					//"drawat_master"=>$drawat_master, 
					"drawat_rawat"=>$drawat_rawat, 
					"drawat_jumlah"=>$drawat_jumlah, 
					"drawat_harga"=>$drawat_harga, 
					"drawat_diskon"=>$drawat_diskon,
					"drawat_diskon_jenis"=>$drawat_diskon_jenis,
					"drawat_sales"=>$drawat_sales 
				);
				$this->db->where('drawat_id', $drawat_id);
				$this->db->update('detail_jual_rawat', $data);
			}else{
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
			} 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function master_jual_rawat_list($filter,$start,$end){
			$dt_now=date('Y-m-d');
			$query = "SELECT jrawat_id, jrawat_nobukti, cust_nama, jrawat_cust, cust_no, cust_member, jrawat_tanggal, jrawat_diskon, jrawat_cashback, jrawat_cara, jrawat_cara2, jrawat_cara3, jrawat_totalbiaya, jrawat_bayar, jrawat_keterangan, jrawat_creator, jrawat_date_create, jrawat_update, jrawat_date_update, jrawat_revised, IF(substring(jrawat_nobukti,1,2)='PK', 'paket', '') as keterangan_paket FROM master_jual_rawat,customer WHERE jrawat_cust=cust_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jrawat_nobukti LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR cust_member LIKE '%".addslashes($filter)."%')";
			}
//			$query.=" AND jrawat_date_create LIKE '$dt_now%' ORDER BY jrawat_date_create DESC";
			$query.=" AND jrawat_date_create LIKE '$dt_now%' ORDER BY jrawat_date_create DESC";
			
			$query2 = "SELECT `master_jual_paket`.`jpaket_id` AS `jrawat_id`,`master_jual_paket`.`jpaket_nobukti` AS `jrawat_nobukti`,`customer`.`cust_nama` AS `cust_nama`, `customer`.`cust_id` AS `jrawat_cust`, `customer`.`cust_no` AS `cust_no`, `customer`.`cust_member` AS `cust_member`, `master_jual_paket`.`jpaket_tanggal` AS `jrawat_tanggal`, `master_jual_paket`.`jpaket_diskon` AS `jrawat_diskon`, `master_jual_paket`.`jpaket_cashback` AS `jrawat_cashback`, `master_jual_paket`.`jpaket_cara` AS `jrawat_cara`, `master_jual_paket`.`jpaket_cara2` AS `jrawat_cara2`, `master_jual_paket`.`jpaket_cara3` AS `jrawat_cara3`, IF(substring(jpaket_nobukti,1,2)='PK', 0, 0) AS jrawat_totalbiaya, `master_jual_paket`.`jpaket_bayar` AS `jrawat_bayar`, `master_jual_paket`.`jpaket_keterangan` AS `jrawat_keterangan`, `master_jual_paket`.`jpaket_creator` AS `jrawat_creator`, `master_jual_paket`.`jpaket_date_create` AS `jrawat_date_create`, `master_jual_paket`.`jpaket_update` AS `jrawat_update`, `master_jual_paket`.`jpaket_date_update` AS `jrawat_date_update`, `master_jual_paket`.`jpaket_revised` AS `jrawat_revised`, IF(substring(jpaket_nobukti,1,2)='PK', 'paket', '') as keterangan_paket FROM (((((`detail_jual_paket` left join `master_jual_paket` on((`detail_jual_paket`.`dpaket_master` = `master_jual_paket`.`jpaket_id`))) LEFT JOIN `customer` on((`master_jual_paket`.`jpaket_cust` = `customer`.`cust_id`))) LEFT JOIN `paket` on((`detail_jual_paket`.`dpaket_paket` = `paket`.`paket_id`))) LEFT JOIN `history_ambil_paket` on((`history_ambil_paket`.`hapaket_dpaket` = `detail_jual_paket`.`dpaket_id`))) LEFT JOIN `vu_total_isi_dpaket` on((`vu_total_isi_dpaket`.`dpaket_id` = `detail_jual_paket`.`dpaket_id`))) group by `detail_jual_paket`.`dpaket_id`";
			
			// For simple search
			if ($filter<>""){
				$query2 .=eregi("WHERE",$query2)? " AND ":" WHERE ";
				$query2 .= " (jrawat_nobukti LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR cust_member LIKE '%".addslashes($filter)."%')";
			}
//			$query.=" AND jrawat_date_create LIKE '$dt_now%' ORDER BY jrawat_date_create DESC";
			$query2.=" AND jrawat_date_create LIKE '$dt_now%' AND (jrawat_bayar is null OR jrawat_bayar = 0) ORDER BY jrawat_date_create DESC";
			
			$nbrows=0;
			$nbrows2=0;
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			//$limit = $query." LIMIT ".$start.",".$end;		
			//$result = $this->db->query($limit);  
			$result2 = $this->db->query($query2);
			$nbrows2 = $result2->num_rows();
			
			if($nbrows>0 || $nbrows2>0){
				if($nbrows>0){
					foreach($result->result() as $row){
						$arr[] = $row;
					}
				}
				if($nbrows2>0){
					foreach($result2->result() as $row2){
						$arr[] = $row2;
					}
				}
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
		//function for update record
		function master_jual_rawat_update($jrawat_id ,$jrawat_nobukti ,$jrawat_cust ,$jrawat_tanggal ,$jrawat_diskon ,$jrawat_cara ,$jrawat_cara2 ,$jrawat_cara3 ,$jrawat_keterangan , $jrawat_cashback, $jrawat_tunai_nilai, $jrawat_tunai_nilai2, $jrawat_tunai_nilai3, $jrawat_voucher_no, $jrawat_voucher_cashback, $jrawat_voucher_no2, $jrawat_voucher_cashback2, $jrawat_voucher_no3, $jrawat_voucher_cashback3, $jrawat_total, $jrawat_bayar, $jrawat_subtotal, $jrawat_hutang, $jrawat_kwitansi_no, $jrawat_kwitansi_nama, $jrawat_kwitansi_nilai, $jrawat_kwitansi_no2, $jrawat_kwitansi_nama2, $jrawat_kwitansi_nilai2, $jrawat_kwitansi_no3, $jrawat_kwitansi_nama3, $jrawat_kwitansi_nilai3, $jrawat_card_nama, $jrawat_card_edc, $jrawat_card_no, $jrawat_card_nilai, $jrawat_card_nama2, $jrawat_card_edc2, $jrawat_card_no2, $jrawat_card_nilai2, $jrawat_card_nama3, $jrawat_card_edc3, $jrawat_card_no3, $jrawat_card_nilai3, $jrawat_cek_nama, $jrawat_cek_no, $jrawat_cek_valid, $jrawat_cek_bank, $jrawat_cek_nilai, $jrawat_cek_nama2, $jrawat_cek_no2, $jrawat_cek_valid2, $jrawat_cek_bank2, $jrawat_cek_nilai2, $jrawat_cek_nama3, $jrawat_cek_no3, $jrawat_cek_valid3, $jrawat_cek_bank3, $jrawat_cek_nilai3, $jrawat_transfer_bank, $jrawat_transfer_nama, $jrawat_transfer_nilai, $jrawat_transfer_bank2, $jrawat_transfer_nama2, $jrawat_transfer_nilai2, $jrawat_transfer_bank3, $jrawat_transfer_nama3, $jrawat_transfer_nilai3 ,$printed){
			//UPDATE table.master_jual_rawat
			$data = array(
				"jrawat_id"=>$jrawat_id, 
				//"jrawat_nobukti"=>$jrawat_nobukti, 
				"jrawat_tanggal"=>$jrawat_tanggal, 
				"jrawat_diskon"=>$jrawat_diskon,
				"jrawat_cashback"=>$jrawat_cashback,
				"jrawat_bayar"=>$jrawat_bayar,
				"jrawat_totalbiaya"=>$jrawat_total,
				"jrawat_cara"=>$jrawat_cara, 
				//"jrawat_cara2"=>$jrawat_cara2, 
				//"jrawat_cara3"=>$jrawat_cara3,
				"jrawat_keterangan"=>$jrawat_keterangan 
			);
			if($jrawat_cara2!=null)
				$data["jrawat_cara2"]=$jrawat_cara2;
			if($jrawat_cara3!=null)
				$data["jrawat_cara3"]=$jrawat_cara3;
			$sql="select cust_id from customer where cust_id='".$jrawat_cust."'";
			$query=$this->db->query($sql);
			if($query->num_rows())
				$data["jrawat_cust"]=$jrawat_cust;
				
			$this->db->where('jrawat_id', $jrawat_id);
			$this->db->update('master_jual_rawat', $data);
			
			//if($printed==1){
				$sql="SELECT drawat_dtrawat FROM detail_jual_rawat WHERE drawat_master='$jrawat_id'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$sql="UPDATE tindakan_detail SET dtrawat_locked=1 ";
					//$sql.=eregi("WHERE",$sql)?" OR ":" WHERE ";
					foreach($rs->result() as $row_drawat){
						$sql.=eregi("WHERE",$sql)?" OR ":" WHERE ";
						$sql.="dtrawat_id='".$row_drawat->drawat_dtrawat."' ";
					}
					$this->db->query($sql);
				}
			//}
			
			if($this->db->affected_rows() || $this->db->affected_rows()==0){
				//delete all transaksi
				/*$sql="delete from jual_kwitansi where jkwitansi_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_card where jcard_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_cek where jcek_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_transfer where jtransfer_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_kredit where jkredit_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_tunai where jtunai_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);*/
				if($jrawat_cara!=null || $jrawat_cara!=''){
					//kwitansi
					if($jrawat_cara=='kwitansi'){
						/*if($jrawat_kwitansi_nama=="" || $jrawat_kwitansi_nama==NULL){
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
						}*/
						
						$sql="SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jkwitansi_no"=>$jrawat_kwitansi_no,
								"jkwitansi_nilai"=>$jrawat_kwitansi_nilai
							);
							$this->db->where('jkwitansi_ref', $jrawat_nobukti);
							$this->db->update('jual_kwitansi', $data);
						}else{
							$data=array(
								"jkwitansi_ref"=>$jrawat_nobukti,
								"jkwitansi_no"=>$jrawat_kwitansi_no,
								"jkwitansi_nilai"=>$jrawat_kwitansi_nilai
							);
							$this->db->insert('jual_kwitansi', $data);
						}
					
					}else if($jrawat_cara=='card'){
						$sql="SELECT jcard_id FROM jual_card WHERE jcard_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcard_nama"=>$jrawat_card_nama,
								"jcard_edc"=>$jrawat_card_edc,
								"jcard_no"=>$jrawat_card_no,
								"jcard_nilai"=>$jrawat_card_nilai
								);
							$this->db->where('jcard_ref', $jrawat_nobukti);
							$this->db->update('jual_card', $data);
						}else{
							$data=array(
								"jcard_ref"=>$jrawat_nobukti,
								"jcard_nama"=>$jrawat_card_nama,
								"jcard_edc"=>$jrawat_card_edc,
								"jcard_no"=>$jrawat_card_no,
								"jcard_nilai"=>$jrawat_card_nilai
								);
							$this->db->insert('jual_card', $data);
						}
					
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
						
						$sql="SELECT jcek_id FROM jual_cek WHERE jcek_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcek_nama"=>$jrawat_cek_nama,
								"jcek_no"=>$jrawat_cek_no,
								"jcek_valid"=>$jrawat_cek_valid,
								"jcek_bank"=>$jrawat_cek_bank,
								"jcek_nilai"=>$jrawat_cek_nilai
								);
							$this->db->where('jcek_ref', $jrawat_nobukti);
							$this->db->update('jual_cek', $data);
						}else{
							$data=array(
								"jcek_ref"=>$jrawat_nobukti,
								"jcek_nama"=>$jrawat_cek_nama,
								"jcek_no"=>$jrawat_cek_no,
								"jcek_valid"=>$jrawat_cek_valid,
								"jcek_bank"=>$jrawat_cek_bank,
								"jcek_nilai"=>$jrawat_cek_nilai
								);
							$this->db->insert('jual_cek', $data);
						}
						 
					}else if($jrawat_cara=='transfer'){
						$sql="SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtransfer_bank"=>$jrawat_transfer_bank,
								"jtransfer_nama"=>$jrawat_transfer_nama,
								"jtransfer_nilai"=>$jrawat_transfer_nilai
								);
							$this->db->where('jtransfer_ref', $jrawat_nobukti);
							$this->db->update('jual_transfer', $data);
						}else{
							$data=array(
								"jtransfer_ref"=>$jrawat_nobukti,
								"jtransfer_bank"=>$jrawat_transfer_bank,
								"jtransfer_nama"=>$jrawat_transfer_nama,
								"jtransfer_nilai"=>$jrawat_transfer_nilai
								);
							$this->db->insert('jual_transfer', $data);
						}
					}else if($jrawat_cara=='tunai'){
						$sql="SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtunai_nilai"=>$jrawat_tunai_nilai
								);
							$this->db->where('jtunai_ref', $jrawat_nobukti);
							$this->db->update('jual_tunai', $data);
						}else{
							$data=array(
								"jtunai_nilai"=>$jrawat_tunai_nilai,
								"jtunai_ref"=>$jrawat_nobukti
								);
							$this->db->insert('jual_tunai', $data);
						}
					}else if($jrawat_cara=='voucher'){
						$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"tvoucher_novoucher"=>$jrawat_voucher_no
								);
							$this->db->where('tvoucher_ref', $jrawat_nobukti);
							$this->db->update('voucher_terima', $data);
						}else{
							$data=array(
								"tvoucher_novoucher"=>$jrawat_voucher_no,
								"tvoucher_ref"=>$jrawat_nobukti
								);
							$this->db->insert('voucher_terima', $data);
						}
					}
				}
				if($jrawat_cara2!=null || $jrawat_cara2!=''){
					//kwitansi
					if($jrawat_cara2=='kwitansi'){
						/*if($jrawat_kwitansi_nama2=="" || $jrawat_kwitansi_nama2==NULL){
							if(is_int($jrawat_kwitansi_nama2)){
								$sql="select cust_nama from customer where cust_id='".$jrawat_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jrawat_kwitansi_nama2=$data->cust_nama;
								}
							}else{
									$jrawat_kwitansi_nama2=$jrawat_cust;
							}
						}*/
						
						$sql="SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jkwitansi_no"=>$jrawat_kwitansi_no2,
								"jkwitansi_nilai"=>$jrawat_kwitansi_nilai2
							);
							$this->db->where('jkwitansi_ref', $jrawat_nobukti);
							$this->db->update('jual_kwitansi', $data);
						}else{
							$data=array(
								"jkwitansi_ref"=>$jrawat_nobukti,
								"jkwitansi_no"=>$jrawat_kwitansi_no2,
								"jkwitansi_nilai"=>$jrawat_kwitansi_nilai2
							);
							$this->db->insert('jual_kwitansi', $data);
						}
					
					}else if($jrawat_cara2=='card'){
						$sql="SELECT jcard_id FROM jual_card WHERE jcard_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcard_nama"=>$jrawat_card_nama2,
								"jcard_edc"=>$jrawat_card_edc2,
								"jcard_no"=>$jrawat_card_no2,
								"jcard_nilai"=>$jrawat_card_nilai2
								);
							$this->db->where('jcard_ref', $jrawat_nobukti);
							$this->db->update('jual_card', $data);
						}else{
							$data=array(
								"jcard_ref"=>$jrawat_nobukti,
								"jcard_nama"=>$jrawat_card_nama2,
								"jcard_edc"=>$jrawat_card_edc2,
								"jcard_no"=>$jrawat_card_no2,
								"jcard_nilai"=>$jrawat_card_nilai2
								);
							$this->db->insert('jual_card', $data);
						}
					
					}else if($jrawat_cara2=='cek/giro'){
						
						if($jrawat_cek_nama2=="" || $jrawat_cek_nama2==NULL){
							if(is_int($jrawat_cek_nama2)){
								$sql="select cust_nama from customer where cust_id='".$jrawat_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jrawat_cek_nama2=$data->cust_nama;
								}
							}else{
									$jrawat_cek_nama2=$jrawat_cust;
							}
						}
						
						$sql="SELECT jcek_id FROM jual_cek WHERE jcek_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcek_nama"=>$jrawat_cek_nama2,
								"jcek_no"=>$jrawat_cek_no2,
								"jcek_valid"=>$jrawat_cek_valid2,
								"jcek_bank"=>$jrawat_cek_bank2,
								"jcek_nilai"=>$jrawat_cek_nilai
								);
							$this->db->where('jcek_ref', $jrawat_nobukti);
							$this->db->update('jual_cek', $data);
						}else{
							$data=array(
								"jcek_ref"=>$jrawat_nobukti,
								"jcek_nama"=>$jrawat_cek_nama2,
								"jcek_no"=>$jrawat_cek_no2,
								"jcek_valid"=>$jrawat_cek_valid2,
								"jcek_bank"=>$jrawat_cek_bank2,
								"jcek_nilai"=>$jrawat_cek_nilai
								);
							$this->db->insert('jual_cek', $data);
						}
						 
					}else if($jrawat_cara2=='transfer'){
						$sql="SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtransfer_bank"=>$jrawat_transfer_bank2,
								"jtransfer_nama"=>$jrawat_transfer_nama2,
								"jtransfer_nilai"=>$jrawat_transfer_nilai2
								);
							$this->db->where('jtransfer_ref', $jrawat_nobukti);
							$this->db->update('jual_transfer', $data);
						}else{
							$data=array(
								"jtransfer_ref"=>$jrawat_nobukti,
								"jtransfer_bank"=>$jrawat_transfer_bank2,
								"jtransfer_nama"=>$jrawat_transfer_nama2,
								"jtransfer_nilai"=>$jrawat_transfer_nilai2
								);
							$this->db->insert('jual_transfer', $data);
						}
						 
					}else if($jrawat_cara2=='tunai'){
						$sql="SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtunai_nilai"=>$jrawat_tunai_nilai2
								);
							$this->db->where('jtunai_ref', $jrawat_nobukti);
							$this->db->update('jual_tunai', $data); 
						}else{
							$data=array(
								"jtunai_ref"=>$jrawat_nobukti,
								"jtunai_nilai"=>$jrawat_tunai_nilai2
								);
							$this->db->insert('jual_tunai', $data);
						}
					}else if($jrawat_cara2=='voucher'){
						$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"tvoucher_novoucher"=>$jrawat_voucher_no2
								);
							$this->db->where('tvoucher_ref', $jrawat_nobukti);
							$this->db->update('voucher_terima', $data);
						}else{
							$data=array(
								"tvoucher_novoucher"=>$jrawat_voucher_no2,
								"tvoucher_ref"=>$jrawat_nobukti
								);
							$this->db->insert('voucher_terima', $data);
						}
					}
				}
				if($jrawat_cara3!=null || $jrawat_cara3!=''){
					//kwitansi
					if($jrawat_cara3=='kwitansi'){
						/*if($jrawat_kwitansi_nama3=="" || $jrawat_kwitansi_nama3==NULL){
							if(is_int($jrawat_kwitansi_nama3)){
								$sql="select cust_nama from customer where cust_id='".$jrawat_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jrawat_kwitansi_nama3=$data->cust_nama;
								}
							}else{
									$jrawat_kwitansi_nama3=$jrawat_cust;
							}
						}*/
						
						$sql="SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jkwitansi_no"=>$jrawat_kwitansi_no3,
								"jkwitansi_nilai"=>$jrawat_kwitansi_nilai3
							);
							$this->db->where('jkwitansi_ref', $jrawat_nobukti);
							$this->db->update('jual_kwitansi', $data);
						}else{
							$data=array(
								"jkwitansi_ref"=>$jrawat_nobukti,
								"jkwitansi_no"=>$jrawat_kwitansi_no3,
								"jkwitansi_nilai"=>$jrawat_kwitansi_nilai3
							);
							$this->db->insert('jual_kwitansi', $data);
						}
					
					}else if($jrawat_cara3=='card'){
						$sql="SELECT jcard_id FROM jual_card WHERE jcard_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcard_nama"=>$jrawat_card_nama3,
								"jcard_edc"=>$jrawat_card_edc3,
								"jcard_no"=>$jrawat_card_no3,
								"jcard_nilai"=>$jrawat_hutang
								);
							$this->db->where('jcard_ref', $jrawat_nobukti);
							$this->db->update('jual_card', $data); 
						}else{
							$data=array(
								"jcard_ref"=>$jrawat_nobukti,
								"jcard_nama"=>$jrawat_card_nama3,
								"jcard_edc"=>$jrawat_card_edc3,
								"jcard_no"=>$jrawat_card_no3,
								"jcard_nilai"=>$jrawat_hutang
								);
							$this->db->insert('jual_card', $data); 
						}
					
					}else if($jrawat_cara3=='cek/giro'){
						
						if($jrawat_cek_nama3=="" || $jrawat_cek_nama3==NULL){
							if(is_int($jrawat_cek_nama3)){
								$sql="select cust_nama from customer where cust_id='".$jrawat_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jrawat_cek_nama3=$data->cust_nama;
								}
							}else{
									$jrawat_cek_nama3=$jrawat_cust;
							}
						}
						
						$sql="SELECT jcek_id FROM jual_cek WHERE jcek_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcek_nama"=>$jrawat_cek_nama3,
								"jcek_no"=>$jrawat_cek_no3,
								"jcek_valid"=>$jrawat_cek_valid3,
								"jcek_bank"=>$jrawat_cek_bank3,
								"jcek_nilai"=>$jrawat_cek_nilai
								);
							$this->db->where('jcek_ref', $jrawat_nobukti);
							$this->db->update('jual_cek', $data); 
						}else{
							$data=array(
								"jcek_ref"=>$jrawat_nobukti,
								"jcek_nama"=>$jrawat_cek_nama3,
								"jcek_no"=>$jrawat_cek_no3,
								"jcek_valid"=>$jrawat_cek_valid3,
								"jcek_bank"=>$jrawat_cek_bank3,
								"jcek_nilai"=>$jrawat_cek_nilai
								);
							$this->db->insert('jual_cek', $data); 
						}
						
					}else if($jrawat_cara3=='transfer'){
						$sql="SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtransfer_bank"=>$jrawat_transfer_bank3,
								"jtransfer_nama"=>$jrawat_transfer_nama3,
								"jtransfer_nilai"=>$jrawat_transfer_nilai3
								);
							$this->db->where('jtransfer_ref', $jrawat_nobukti);
							$this->db->update('jual_transfer', $data); 
						}else{
							$data=array(
								"jtransfer_ref"=>$jrawat_nobukti,
								"jtransfer_bank"=>$jrawat_transfer_bank3,
								"jtransfer_nama"=>$jrawat_transfer_nama3,
								"jtransfer_nilai"=>$jrawat_transfer_nilai3
								);
							$this->db->insert('jual_transfer', $data);
						}
						
					}else if($jrawat_cara3=='tunai'){
						$sql="SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtunai_nilai"=>$jrawat_tunai_nilai3
								);
							$this->db->where('jtunai_ref', $jrawat_nobukti);
							$this->db->update('jual_tunai', $data); 
						}else{
							$data=array(
								"jtunai_ref"=>$jrawat_nobukti,
								"jtunai_nilai"=>$jrawat_tunai_nilai3
								);
							$this->db->where('jtunai_ref', $jrawat_nobukti);
							$this->db->update('jual_tunai', $data);
						}
					}else if($jrawat_cara3=='voucher'){
						$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jrawat_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"tvoucher_novoucher"=>$jrawat_voucher_no3
								);
							$this->db->where('tvoucher_ref', $jrawat_nobukti);
							$this->db->update('voucher_terima', $data);
						}else{
							$data=array(
								"tvoucher_novoucher"=>$jrawat_voucher_no3,
								"tvoucher_ref"=>$jrawat_nobukti
								);
							$this->db->insert('voucher_terima', $data);
						}
					}
				}
				if($printed==1){
					return $jrawat_id;
				}else{
					return '1';
				}
			}
			else
				return '0';
		}
		
		//function for create new record
		function master_jual_rawat_create($jrawat_cust ,$jrawat_tanggal ,$jrawat_diskon ,$jrawat_cara ,$jrawat_cara2 ,$jrawat_cara3 ,$jrawat_keterangan , $jrawat_cashback, $jrawat_tunai_nilai, $jrawat_tunai_nilai2, $jrawat_tunai_nilai3, $jrawat_voucher_no, $jrawat_voucher_cashback, $jrawat_voucher_no2, $jrawat_voucher_cashback2, $jrawat_voucher_no3, $jrawat_voucher_cashback3, $jrawat_bayar, $jrawat_subtotal, $jrawat_hutang, $jrawat_kwitansi_no, $jrawat_kwitansi_nama, $jrawat_kwitansi_nilai, $jrawat_kwitansi_no2, $jrawat_kwitansi_nama2, $jrawat_kwitansi_nilai2, $jrawat_kwitansi_no3, $jrawat_kwitansi_nama3, $jrawat_kwitansi_nilai3, $jrawat_card_nama, $jrawat_card_edc, $jrawat_card_no, $jrawat_card_nilai, $jrawat_card_nama2, $jrawat_card_edc2, $jrawat_card_no2, $jrawat_card_nilai2, $jrawat_card_nama3, $jrawat_card_edc3, $jrawat_card_no3, $jrawat_card_nilai3, $jrawat_cek_nama, $jrawat_cek_no, $jrawat_cek_valid, $jrawat_cek_bank, $jrawat_cek_nilai, $jrawat_cek_nama2, $jrawat_cek_no2, $jrawat_cek_valid2, $jrawat_cek_bank2, $jrawat_cek_nilai2, $jrawat_cek_nama3, $jrawat_cek_no3, $jrawat_cek_valid3, $jrawat_cek_bank3, $jrawat_cek_nilai3, $jrawat_transfer_bank, $jrawat_transfer_nama, $jrawat_transfer_nilai, $jrawat_transfer_bank2, $jrawat_transfer_nama2, $jrawat_transfer_nilai2, $jrawat_transfer_bank3, $jrawat_transfer_nama3, $jrawat_transfer_nilai3){
			$pattern="PR/".date("ym")."-";
			$jrawat_nobukti=$this->m_public_function->get_kode_1('master_jual_rawat','jrawat_nobukti',$pattern,12);
				
			$data = array(
				"jrawat_nobukti"=>$jrawat_nobukti, 
				"jrawat_cust"=>$jrawat_cust, 
				"jrawat_tanggal"=>$jrawat_tanggal, 
				"jrawat_diskon"=>$jrawat_diskon, 
				"jrawat_cashback"=>$jrawat_cashback,
				"jrawat_bayar"=>$jrawat_bayar,
				"jrawat_cara"=>$jrawat_cara, 
				//"jrawat_cara2"=>$jrawat_cara2, 
				//"jrawat_cara3"=>$jrawat_cara3, 
				"jrawat_keterangan"=>$jrawat_keterangan 
			);
			if($jrawat_cara2!=null)
				$data["jrawat_cara2"]=$jrawat_cara2;
			if($jrawat_cara3!=null)
				$data["jrawat_cara3"]=$jrawat_cara3;
			$this->db->insert('master_jual_rawat', $data); 
			if($this->db->affected_rows()){
				
				//delete all transaksi
				/*$sql="delete from jual_kwitansi where jkwitansi_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_card where jcard_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_cek where jcek_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_transfer where jtransfer_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_kredit where jkredit_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_tunai where jtunai_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);*/
				
				if($jrawat_cara!=null || $jrawat_cara!=''){
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
							"jkwitansi_nilai"=>$jrawat_hutang,
							"jkwitansi_ref"=>$jrawat_nobukti
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jrawat_cara=='card'){
						
						$data=array(
							"jcard_nama"=>$jrawat_card_nama,
							"jcard_edc"=>$jrawat_card_edc,
							"jcard_no"=>$jrawat_card_no,
							"jcard_nilai"=>$jrawat_card_nilai,
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
							"jcek_nilai"=>$jrawat_cek_nilai,
							"jcek_ref"=>$jrawat_nobukti
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jrawat_cara=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jrawat_transfer_bank,
							"jtransfer_nama"=>$jrawat_transfer_nama,
							"jtransfer_nilai"=>$jrawat_transfer_nilai,
							"jtransfer_ref"=>$jrawat_nobukti
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jrawat_cara=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jrawat_tunai_nilai,
							"jtunai_ref"=>$jrawat_nobukti
							);
						$this->db->insert('jual_tunai', $data); 
					}
				}
				if($jrawat_cara2!=null || $jrawat_cara2!=''){
					//kwitansi
					if($jrawat_cara2=='kwitansi'){
						if($jrawat_kwitansi_nama2=="" || $jrawat_kwitansi_nama2==NULL){
							if(is_int($jrawat_kwitansi_nama2)){
								$sql="select cust_nama from customer where cust_id='".$jrawat_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jrawat_kwitansi_nama2=$data->cust_nama;
								}
							}else{
									$jrawat_kwitansi_nama2=$jrawat_cust;
							}
						}
						$data=array(
							"jkwitansi_no"=>$jrawat_kwitansi_no2,
							"jkwitansi_nilai"=>$jrawat_hutang,
							"jkwitansi_ref"=>$jrawat_nobukti
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jrawat_cara2=='card'){
						$data=array(
							"jcard_nama"=>$jrawat_card_nama2,
							"jcard_edc"=>$jrawat_card_edc2,
							"jcard_no"=>$jrawat_card_no2,
							"jcard_nilai"=>$jrawat_card_nilai2,
							"jcard_ref"=>$jrawat_nobukti
							);
						$this->db->insert('jual_card', $data); 
					
					}else if($jrawat_cara2=='cek/giro'){
						
						if($jrawat_cek_nama2=="" || $jrawat_cek_nama2==NULL){
							if(is_int($jrawat_cek_nama2)){
								$sql="select cust_nama from customer where cust_id='".$jrawat_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jrawat_cek_nama2=$data->cust_nama;
								}
							}else{
									$jrawat_cek_nama2=$jrawat_cust;
							}
						}
						$data=array(
							"jcek_nama"=>$jrawat_cek_nama2,
							"jcek_no"=>$jrawat_cek_no2,
							"jcek_valid"=>$jrawat_cek_valid2,
							"jcek_bank"=>$jrawat_cek_bank2,
							"jcek_nilai"=>$jrawat_cek_nilai,
							"jcek_ref"=>$jrawat_nobukti
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jrawat_cara2=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jrawat_transfer_bank2,
							"jtransfer_nama"=>$jrawat_transfer_nama2,
							"jtransfer_nilai"=>$jrawat_transfer_nilai2,
							"jtransfer_ref"=>$jrawat_nobukti
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jrawat_cara2=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jrawat_tunai_nilai2,
							"jtunai_ref"=>$jrawat_nobukti
							);
						$this->db->insert('jual_tunai', $data); 
					}
				}
				if($jrawat_cara3!=null || $jrawat_cara3!=''){
					//kwitansi
					if($jrawat_cara3=='kwitansi'){
						if($jrawat_kwitansi_nama3=="" || $jrawat_kwitansi_nama3==NULL){
							if(is_int($jrawat_kwitansi_nama3)){
								$sql="select cust_nama from customer where cust_id='".$jrawat_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jrawat_kwitansi_nama3=$data->cust_nama;
								}
							}else{
									$jrawat_kwitansi_nama3=$jrawat_cust;
							}
						}
						$data=array(
							"jkwitansi_no"=>$jrawat_kwitansi_no3,
							"jkwitansi_nilai"=>$jrawat_hutang,
							"jkwitansi_ref"=>$jrawat_nobukti
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jrawat_cara3=='card'){
						
						$data=array(
							"jcard_nama"=>$jrawat_card_nama3,
							"jcard_edc"=>$jrawat_card_edc3,
							"jcard_no"=>$jrawat_card_no3,
							"jcard_nilai"=>$jrawat_hutang,
							"jcard_ref"=>$jrawat_nobukti
							);
						$this->db->insert('jual_card', $data); 
					
					}else if($jrawat_cara3=='cek/giro'){
						
						if($jrawat_cek_nama3=="" || $jrawat_cek_nama3==NULL){
							if(is_int($jrawat_cek_nama3)){
								$sql="select cust_nama from customer where cust_id='".$jrawat_cust."'";
								$query=$this->db->query($sql);
								if($query->num_rows()){
									$data=$query->row();
									$jrawat_cek_nama3=$data->cust_nama;
								}
							}else{
									$jrawat_cek_nama3=$jrawat_cust;
							}
						}
						$data=array(
							"jcek_nama"=>$jrawat_cek_nama3,
							"jcek_no"=>$jrawat_cek_no3,
							"jcek_valid"=>$jrawat_cek_valid3,
							"jcek_bank"=>$jrawat_cek_bank3,
							"jcek_nilai"=>$jrawat_cek_nilai,
							"jcek_ref"=>$jrawat_nobukti
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jrawat_cara3=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jrawat_transfer_bank3,
							"jtransfer_nama"=>$jrawat_transfer_nama3,
							"jtransfer_nilai"=>$jrawat_transfer_nilai3,
							"jtransfer_ref"=>$jrawat_nobukti
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jrawat_cara3=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jrawat_tunai_nilai3,
							"jtunai_ref"=>$jrawat_nobukti
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
		function master_jual_rawat_search($jrawat_id ,$jrawat_nobukti ,$jrawat_cust ,$jrawat_diskon ,$jrawat_cashback ,$jrawat_voucher ,$jrawat_cara ,$jrawat_bayar ,$jrawat_keterangan ,$jrawat_tgl_start ,$jrawat_tgl_end ,$start,$end){
			//full query
			$query="SELECT * FROM master_jual_rawat,customer WHERE jrawat_cust=cust_id";
			
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
				$query.= " jrawat_cust = '".$jrawat_cust."'";
			};
			if($jrawat_tgl_start!='' && $jrawat_tgl_end!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jrawat_tanggal BETWEEN '".$jrawat_tgl_start."' AND '".$jrawat_tgl_end."'";
			}else if($jrawat_tgl_start!='' && $jrawat_tgl_end==''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jrawat_tanggal='".$jrawat_tgl_start."'";
			}
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
		function master_jual_rawat_print($jrawat_id ,$jrawat_nobukti ,$jrawat_cust ,$jrawat_tanggal ,$jrawat_diskon ,$jrawat_cashback ,$jrawat_voucher ,$jrawat_cara ,$jrawat_bayar ,$jrawat_keterangan ,$option,$filter){
			//full query
			$query="select * from master_jual_rawat";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jrawat_id LIKE '%".addslashes($filter)."%' OR jrawat_nobukti LIKE '%".addslashes($filter)."%' OR jrawat_cust LIKE '%".addslashes($filter)."%' OR jrawat_tanggal LIKE '%".addslashes($filter)."%' OR jrawat_diskon LIKE '%".addslashes($filter)."%' OR jrawat_cara LIKE '%".addslashes($filter)."%' OR jrawat_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
				//return $result;
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
				//return $result;
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
		
		function print_paper($jrawat_id){
			
			$sql="SELECT * FROM master_jual_rawat WHERE jrawat_id='".$jrawat_id."'";
			$result = $this->db->query($sql);
			return $result;
		}
		
		function print_paper_detail($jrawat_id){
			
			$sql="SELECT * FROM detail_jual_rawat INNER JOIN perawatan ON(drawat_rawat=rawat_id) WHERE drawat_master='".$jrawat_id."'";
			$result = $this->db->query($sql);
			return $result;
		}
		
}
?>