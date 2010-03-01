<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: master_retur_jual_produk Model
	+ Description	: For record model process back-end
	+ Filename 		: c_master_retur_jual_produk.php
 	+ Author  		: 
 	+ Created on 20/Aug/2009 14:53:25
	
*/

class M_master_retur_jual_produk extends Model{
		
		//constructor
		function M_master_retur_jual_produk() {
			parent::Model();
		}
		
		function get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT * FROM vu_trans_retur_produk";
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_trans_retur_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_trans_retur_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT * FROM vu_detail_retur_jual_produk";
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_detail_retur_jual_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_detail_retur_jual_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			
			$query=$this->db->query($sql);
			return $query->result();
		}
		
		function get_total_item($tgl_awal,$tgl_akhir,$periode,$opsi){
			$sql="";
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_trans_retur_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_trans_retur_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_trans_retur_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_detail_retur_jual_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_detail_retur_jual_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_detail_retur_jual_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_item;
			}else
				return "";
		}
		
		function get_total_diskon($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(cashback) as total_diskon FROM vu_trans_retur_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(cashback) as total_diskon FROM vu_trans_retur_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(cashback) as total_diskon FROM vu_trans_retur_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT SUM(diskon_nilai) as total_diskon FROM vu_detail_retur_jual_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(diskon_nilai) as total_diskon FROM vu_detail_retur_jual_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(diskon_nilai) as total_diskon FROM vu_detail_retur_jual_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_diskon;
			}else
				return "";
		}
		
		function get_total_nilai($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(total_nilai) as total_nilai FROM vu_trans_retur_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(total_nilai) as total_nilai FROM vu_trans_retur_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(total_nilai) as total_nilai FROM vu_trans_retur_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT SUM(subtotal) as total_nilai FROM vu_detail_retur_jual_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(subtotal) as total_nilai FROM vu_detail_retur_jual_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(subtotal) as total_nilai FROM vu_detail_retur_jual_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_nilai;
			}else
				return "";
		}
		
		function get_total_cek($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(cek) as total_cek FROM vu_trans_retur_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(cek) as total_cek FROM vu_trans_retur_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(cek) as total_cek FROM vu_trans_retur_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_cek;
			}else
				return "";
		}
		
		function get_total_tunai($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(tunai) as total_tunai FROM vu_trans_retur_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(tunai) as total_tunai FROM vu_trans_retur_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(tunai) as total_tunai FROM vu_trans_retur_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_tunai;
			}else
				return "";
		}
		
		function get_total_transfer($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(transfer) as total_transfer FROM vu_trans_retur_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(transfer) as total_transfer FROM vu_trans_retur_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(transfer) as total_transfer FROM vu_trans_retur_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_transfer;
			}else
				return "";
		}
		
		function get_total_card($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(card) as total_card FROM vu_trans_retur_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(card) as total_card FROM vu_trans_retur_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(card) as total_card FROM vu_trans_retur_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_card;
			}else
				return "";
		}
		
		function get_total_kredit($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(kredit) as total_kredit FROM vu_trans_retur_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(kredit) as total_kredit FROM vu_trans_retur_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(kredit) as total_kredit FROM vu_trans_retur_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_kredit;
			}else
				return "";
		}
		
		function get_total_kuintansi($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(kuintansi) as total_kuintansi FROM vu_trans_retur_produk";
				else if($periode=='bulan')
					$sql="SELECT SUM(kuintansi) as total_kuintansi FROM vu_trans_retur_produk WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(kuintansi) as total_kuintansi FROM vu_trans_retur_produk WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_kuintansi;
			}else
				return "";
		}
	
		function get_jual_produk_list($query,$start,$end){
			$sql="SELECT jproduk_id,jproduk_nobukti,jproduk_tanggal,cust_nama,cust_alamat,cust_id FROM master_jual_produk,customer WHERE jproduk_cust=cust_id";
			if($query<>"")
				$sql.=" and (jproduk_nobukti like '%".$query."%' or jproduk_tanggal like '%".$query."%' or cust_nama like '%".$query."%' or cust_alamat like '%".$query."%' or jproduk_nobukti like '%".$query."%') "; 
			$query = $this->db->query($sql);
			$nbrows = $query->num_rows();
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
		
		//function for detail
		//get record list
		function detail_detail_retur_jual_produk_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM detail_retur_jual_produk where drproduk_master='".$master_id."'";
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
			$query = "SELECT max(rproduk_id) as master_id from master_retur_jual_produk";
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
		function detail_detail_retur_jual_produk_purge($master_id){
			$sql="DELETE from detail_retur_jual_produk where drproduk_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_detail_retur_jual_produk_insert($drproduk_id ,$drproduk_master ,$drproduk_produk ,$drproduk_satuan ,$drproduk_jumlah ,$drproduk_harga ){
			//if master id not capture from view then capture it from max pk from master table
			if($drproduk_master=="" || $drproduk_master==NULL){
				$drproduk_master=$this->get_master_id();
			}
			
			$data = array(
				"drproduk_master"=>$drproduk_master, 
				"drproduk_produk"=>$drproduk_produk, 
				"drproduk_satuan"=>$drproduk_satuan, 
				"drproduk_jumlah"=>$drproduk_jumlah, 
				"drproduk_harga"=>$drproduk_harga 
			);
			$this->db->insert('detail_retur_jual_produk', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		//function for get list record
		function master_retur_jual_produk_list($filter,$start,$end){
			$query = "SELECT * FROM master_retur_jual_produk,customer,master_jual_produk WHERE rproduk_cust=cust_id AND rproduk_nobuktijual=jproduk_id";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (rproduk_id LIKE '%".addslashes($filter)."%' OR rproduk_nobukti LIKE '%".addslashes($filter)."%' OR rproduk_nobuktijual LIKE '%".addslashes($filter)."%' OR rproduk_cust LIKE '%".addslashes($filter)."%' OR rproduk_tanggal LIKE '%".addslashes($filter)."%' OR rproduk_keterangan LIKE '%".addslashes($filter)."%' )";
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
		function master_retur_jual_produk_update($rproduk_id ,$rproduk_nobukti ,$rproduk_nobuktijual ,$rproduk_cust ,$rproduk_tanggal ,$rproduk_keterangan ){
			$data = array(
				"rproduk_id"=>$rproduk_id, 
				"rproduk_nobukti"=>$rproduk_nobukti, 
				"rproduk_nobuktijual"=>$rproduk_nobuktijual, 
				"rproduk_cust"=>$rproduk_cust, 
				"rproduk_tanggal"=>$rproduk_tanggal, 
				"rproduk_keterangan"=>$rproduk_keterangan 
			);
			$this->db->where('rproduk_id', $rproduk_id);
			$this->db->update('master_retur_jual_produk', $data);
			
			return '1';
		}
		
		//function for create new record
		function master_retur_jual_produk_create($rproduk_nobukti ,$rproduk_nobuktijual ,$rproduk_cust ,$rproduk_tanggal ,$rproduk_keterangan ){
			$data = array(
				"rproduk_nobukti"=>$rproduk_nobukti, 
				"rproduk_nobuktijual"=>$rproduk_nobuktijual, 
				"rproduk_cust"=>$rproduk_cust, 
				"rproduk_tanggal"=>$rproduk_tanggal, 
				"rproduk_keterangan"=>$rproduk_keterangan 
			);
			$this->db->insert('master_retur_jual_produk', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function master_retur_jual_produk_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_retur_jual_produks at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM master_retur_jual_produk WHERE rproduk_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM master_retur_jual_produk WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "rproduk_id= ".$pkid[$i];
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
		function master_retur_jual_produk_search($rproduk_id ,$rproduk_nobukti ,$rproduk_nobuktijual ,$rproduk_cust ,$rproduk_tanggal ,$rproduk_keterangan ,$start,$end){
			//full query
			$query="select * from master_retur_jual_produk";
			
			if($rproduk_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rproduk_id LIKE '%".$rproduk_id."%'";
			};
			if($rproduk_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rproduk_nobukti LIKE '%".$rproduk_nobukti."%'";
			};
			if($rproduk_nobuktijual!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rproduk_nobuktijual LIKE '%".$rproduk_nobuktijual."%'";
			};
			if($rproduk_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rproduk_cust LIKE '%".$rproduk_cust."%'";
			};
			if($rproduk_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rproduk_tanggal LIKE '%".$rproduk_tanggal."%'";
			};
			if($rproduk_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rproduk_keterangan LIKE '%".$rproduk_keterangan."%'";
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
		function master_retur_jual_produk_print($rproduk_id ,$rproduk_nobukti ,$rproduk_nobuktijual ,$rproduk_cust ,$rproduk_tanggal ,$rproduk_keterangan ,$option,$filter){
			//full query
			$query="select * from master_retur_jual_produk";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (rproduk_id LIKE '%".addslashes($filter)."%' OR rproduk_nobukti LIKE '%".addslashes($filter)."%' OR rproduk_nobuktijual LIKE '%".addslashes($filter)."%' OR rproduk_cust LIKE '%".addslashes($filter)."%' OR rproduk_tanggal LIKE '%".addslashes($filter)."%' OR rproduk_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($rproduk_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rproduk_id LIKE '%".$rproduk_id."%'";
				};
				if($rproduk_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rproduk_nobukti LIKE '%".$rproduk_nobukti."%'";
				};
				if($rproduk_nobuktijual!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rproduk_nobuktijual LIKE '%".$rproduk_nobuktijual."%'";
				};
				if($rproduk_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rproduk_cust LIKE '%".$rproduk_cust."%'";
				};
				if($rproduk_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rproduk_tanggal LIKE '%".$rproduk_tanggal."%'";
				};
				if($rproduk_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rproduk_keterangan LIKE '%".$rproduk_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function master_retur_jual_produk_export_excel($rproduk_id ,$rproduk_nobukti ,$rproduk_nobuktijual ,$rproduk_cust ,$rproduk_tanggal ,$rproduk_keterangan ,$option,$filter){
			//full query
			$query="select * from master_retur_jual_produk";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (rproduk_id LIKE '%".addslashes($filter)."%' OR rproduk_nobukti LIKE '%".addslashes($filter)."%' OR rproduk_nobuktijual LIKE '%".addslashes($filter)."%' OR rproduk_cust LIKE '%".addslashes($filter)."%' OR rproduk_tanggal LIKE '%".addslashes($filter)."%' OR rproduk_keterangan LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($rproduk_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rproduk_id LIKE '%".$rproduk_id."%'";
				};
				if($rproduk_nobukti!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rproduk_nobukti LIKE '%".$rproduk_nobukti."%'";
				};
				if($rproduk_nobuktijual!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rproduk_nobuktijual LIKE '%".$rproduk_nobuktijual."%'";
				};
				if($rproduk_cust!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rproduk_cust LIKE '%".$rproduk_cust."%'";
				};
				if($rproduk_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rproduk_tanggal LIKE '%".$rproduk_tanggal."%'";
				};
				if($rproduk_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " rproduk_keterangan LIKE '%".$rproduk_keterangan."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>