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
		
		function get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi,$group){
			$order_by="";
			switch($group){
				case "Tanggal": $order_by=" ORDER BY tanggal";break;
				case "Customer": $order_by=" ORDER BY cust_id";break;
				case "No Faktur": $order_by=" ORDER BY no_bukti";break;
				case "Paket": $order_by=" ORDER BY produk_kode";break;
				case "Sales": $order_by=" ORDER BY sales";break;
				case "Jenis Diskon": $order_by=" ORDER BY diskon_jenis";break;
				default: $order_by=" ORDER BY no_bukti";break;
			}
			
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT * FROM vu_trans_paket ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_trans_paket WHERE tanggal like '".$tgl_awal."%' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_trans_paket WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."' ".$order_by;
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT * FROM vu_detail_jual_paket ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_detail_jual_paket WHERE tanggal like '".$tgl_awal."%' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_detail_jual_paket WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."' ".$order_by;
			}
			
			$query=$this->db->query($sql);
			return $query->result();
		}
		
		function get_total_item($tgl_awal,$tgl_akhir,$periode,$opsi){
			$sql="";
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_trans_paket";
				else if($periode=='bulan')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_trans_paket WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_trans_paket WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_detail_jual_paket";
				else if($periode=='bulan')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_detail_jual_paket WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_detail_jual_paket WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(cashback) as total_diskon FROM vu_trans_paket";
				else if($periode=='bulan')
					$sql="SELECT SUM(cashback) as total_diskon FROM vu_trans_paket WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(cashback) as total_diskon FROM vu_trans_paket WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT SUM(diskon_nilai) as total_diskon FROM vu_detail_jual_paket";
				else if($periode=='bulan')
					$sql="SELECT SUM(diskon_nilai) as total_diskon FROM vu_detail_jual_paket WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(diskon_nilai) as total_diskon FROM vu_detail_jual_paket WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(total_nilai) as total_nilai FROM vu_trans_paket";
				else if($periode=='bulan')
					$sql="SELECT SUM(total_nilai) as total_nilai FROM vu_trans_paket WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(total_nilai) as total_nilai FROM vu_trans_paket WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT SUM(subtotal) as total_nilai FROM vu_detail_jual_paket";
				else if($periode=='bulan')
					$sql="SELECT SUM(subtotal) as total_nilai FROM vu_detail_jual_paket WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(subtotal) as total_nilai FROM vu_detail_jual_paket WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(cek) as total_cek FROM vu_trans_paket";
				else if($periode=='bulan')
					$sql="SELECT SUM(cek) as total_cek FROM vu_trans_paket WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(cek) as total_cek FROM vu_trans_paket WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(tunai) as total_tunai FROM vu_trans_paket";
				else if($periode=='bulan')
					$sql="SELECT SUM(tunai) as total_tunai FROM vu_trans_paket WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(tunai) as total_tunai FROM vu_trans_paket WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(transfer) as total_transfer FROM vu_trans_paket";
				else if($periode=='bulan')
					$sql="SELECT SUM(transfer) as total_transfer FROM vu_trans_paket WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(transfer) as total_transfer FROM vu_trans_paket WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(card) as total_card FROM vu_trans_paket";
				else if($periode=='bulan')
					$sql="SELECT SUM(card) as total_card FROM vu_trans_paket WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(card) as total_card FROM vu_trans_paket WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(kredit) as total_kredit FROM vu_trans_paket";
				else if($periode=='bulan')
					$sql="SELECT SUM(kredit) as total_kredit FROM vu_trans_paket WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(kredit) as total_kredit FROM vu_trans_paket WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(kuintansi) as total_kuintansi FROM vu_trans_paket";
				else if($periode=='bulan')
					$sql="SELECT SUM(kuintansi) as total_kuintansi FROM vu_trans_paket WHERE tanggal like '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(kuintansi) as total_kuintansi FROM vu_trans_paket WHERE tanggal>='".$tgl_awal."' AND tanggal<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_kuintansi;
			}else
				return "";
		}
		
		function get_customer_list($query,$start,$end){
			/*$rs_rows=0;
			if(is_numeric($query)==true){
				$sql_cust="SELECT distinct(sjpaket_cust) FROM submaster_jual_paket WHERE sjpaket_master='$query'";
				$rs=$this->db->query($sql_cust);
				$rs_rows=$rs->num_rows();
			}*/
			
			$sql="SELECT cust_id,cust_no,cust_nama,cust_tgllahir,cust_alamat,cust_telprumah FROM customer where cust_aktif='Aktif'";
			if($query<>"" && is_numeric($query)==false){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.=" (cust_nama like '%".$query."%' ) ";
			}/*else{
				if($rs_rows){
					$filter="";
					$sql.=eregi("AND",$query)? " OR ":" AND ";
					foreach($rs->result() as $row_cust){
						
						$filter.="OR cust_id='".$row_cust->sjpaket_cust."' ";
					}
					$sql=$sql."(".substr($filter,2,strlen($filter)).")";
				}
			}*/
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			if($end!=0){
				$limit = $sql." LIMIT ".$start.",".$end;			
				$result = $this->db->query($limit);
			}
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
		
		function get_customer_pengguna_list($query,$start,$end){
			$rs_rows=0;
			if(is_numeric($query)==true){
				$sql_cust="SELECT distinct(ppaket_cust) FROM pengguna_paket WHERE ppaket_master='$query'";
				$rs=$this->db->query($sql_cust);
				$rs_rows=$rs->num_rows();
			}
			
			$sql="SELECT cust_id,cust_no,cust_nama,cust_tgllahir,cust_alamat,cust_telprumah FROM customer where cust_aktif='Aktif'";
			if($query<>"" && is_numeric($query)==false){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.=" (cust_nama like '%".$query."%' ) ";
			}else{
				if($rs_rows){
					$filter="";
					$sql.=eregi("AND",$query)? " OR ":" AND ";
					foreach($rs->result() as $row_cust){
						
						$filter.="OR cust_id='".$row_cust->ppaket_cust."' ";
					}
					$sql=$sql."(".substr($filter,2,strlen($filter)).")";
				}
			}
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			if($end!=0){
				$limit = $sql." LIMIT ".$start.",".$end;			
				$result = $this->db->query($limit);
			}
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
		
		function detail_pengguna_paket_list($master_id,$start,$end){
			$query="SELECT ppaket_cust FROM pengguna_paket INNER JOIN master_jual_paket ON(ppaket_master=jpaket_id) WHERE ppaket_master='$master_id' AND ppaket_cust!=jpaket_cust";
			
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
		
		function detail_pengguna_paket_insert($ppaket_master, $ppaket_cust){
			//if master id not capture from view then capture it from max pk from master table
			if($ppaket_master=="" || $ppaket_master==NULL){
				$ppaket_master=$this->get_master_id();
			}
			$data = array(
				"ppaket_master"=>$ppaket_master, 
				"ppaket_cust"=>$ppaket_cust
			);
			$sql="SELECT ppaket_id FROM pengguna_paket WHERE ppaket_master='$ppaket_master' AND ppaket_cust='$ppaket_cust'";
			$rs=$this->db->query($sql);
			if(!$rs->num_rows()){
				$this->db->insert('pengguna_paket', $data); 
				if($this->db->affected_rows()){
					return '1';
				}else
					return '0';
			}

		}
		
		function get_paket_list($query,$start,$end){
			$rs_rows=0;
			if(is_numeric($query)==true){
				$sql_paket="SELECT distinct(dpaket_paket) FROM detail_jual_paket WHERE dpaket_master='$query'";
				$rs=$this->db->query($sql_paket);
				$rs_rows=$rs->num_rows();
			}
			
			$sql="SELECT paket_id, paket_harga, paket_kode, group_nama, kategori_nama, paket_du, paket_dm, paket_nama, paket_expired FROM paket INNER JOIN produk_group ON paket.paket_group=produk_group.group_id INNER JOIN kategori ON produk_group.group_kelompok=kategori.kategori_id WHERE kategori.kategori_jenis='paket' AND paket_aktif='Aktif'";
			if($query<>"" && is_numeric($query)==false){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.=" (paket_kode LIKE '%".addslashes($query)."%' OR paket_nama LIKE '%".addslashes($query)."%' ) ";
			}else{
				if($rs_rows){
					$filter="";
					$sql.=eregi("AND",$query)? " OR ":" AND ";
					foreach($rs->result() as $row_paket){
						
						$filter.="OR paket_id='".$row_paket->dpaket_paket."' ";
					}
					$sql=$sql."(".substr($filter,2,strlen($filter)).")";
				}
			}
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			if($end!=0){
				$limit = $sql." LIMIT ".$start.",".$end;			
				$result = $this->db->query($limit);
			}
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
			$sql = "SELECT * FROM voucher,voucher_kupon where kvoucher_master=voucher_id";
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
			$query = "SELECT max(jpaket_id) as master_id FROM master_jual_paket WHERE jpaket_creator='".$_SESSION[SESSION_USERID]."'";
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
		
		function catatan_piutang_update($jpaket_id){
			if($jpaket_id=="" || $jpaket_id==NULL || $jpaket_id==0){
				$jpaket_id=$this->get_master_id();
			}
			$sql="SELECT * FROM vu_piutang_jpaket WHERE jpaket_id='$jpaket_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$lpiutang_faktur=$rs_record["jpaket_nobukti"];
				$lpiutang_cust=$rs_record["jpaket_cust"];
				$lpiutang_faktur_tanggal=$rs_record["jpaket_tanggal"];
				$lpiutang_total=$rs_record["piutang_total"];
				/* ini artinya: No.Faktur Penjualan Produk ini masih BELUM LUNAS */
				/* untuk itu, No.Faktur ini akan dimasukkan ke db.master_lunas_piutang sebagai daftar yang harus ditagihkan ke Customer */
				
				/* Checking terlebih dahulu ke db.master_lunas_piutang WHERE =$lpiutang_faktur:
				* JIKA 'ada' ==> Lakukan UPDATE db.master_lunas_piutang
				* JIKA 'tidak ada' ==> Lakukan INSERT db.master_lunas_piutang
				*/
				$sql="SELECT * FROM master_lunas_piutang WHERE lpiutang_faktur='$lpiutang_faktur'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					/* UPDATE db.master_lunas_piutang */
					$dtu_lpiutang=array(
					"lpiutang_cust"=>$lpiutang_cust,
					"lpiutang_total"=>lpiutang_total,
					"lpiutang_sisa"=>lpiutang_total
					);
					$this->db->where('lpiutang_faktur', $lpiutang_faktur);
					$this->db->update('master_lunas_piutang', $dtu_lpiutang);
				}else{
					/* INSERT db.master_lunas_piutang */
					$dti_lpiutang=array(
					"lpiutang_faktur"=>$lpiutang_faktur,
					"lpiutang_cust"=>$lpiutang_cust,
					"lpiutang_faktur_tanggal"=>$lpiutang_faktur_tanggal,
					"lpiutang_total"=>$lpiutang_total,
					"lpiutang_sisa"=>$lpiutang_total
					);
					$this->db->insert('master_lunas_piutang', $dti_lpiutang);
				}
			}
		}
		
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
		
		function detail_pengguna_paket_purge($master_id){
			$sql="DELETE FROM pengguna_paket WHERE ppaket_master='".$master_id."'";
			$result=$this->db->query($sql);
			return '1';
		}
		
		/*function master_ambil_paket_insert($jpaket_id, $paket_id, $paket_jumlah, $jpaket_kadaluarsa){
			$apaket_faktur="";
			$apaket_faktur_tanggal="";
			$cust_no="";
			$cust_nama="";
			$paket_nama="";
			$sql_jpaket="SELECT jpaket_nobukti, jpaket_tanggal, jpaket_cust, cust_no, cust_nama FROM master_jual_paket LEFT JOIN customer ON(jpaket_cust=cust_id) WHERE jpaket_id='$jpaket_id'";
			$rs_jpaket=$this->db->query($sql_jpaket);
			if($rs_jpaket->num_rows()){
				$rs_jpaket_record=$rs_jpaket->row_array();
				$apaket_faktur=$rs_jpaket_record["jpaket_nobukti"];
				$apaket_faktur_tanggal=$rs_jpaket_record["jpaket_tanggal"];
				$apaket_cust=$rs_jpaket_record["jpaket_cust"];
				$apaket_cust_no=$rs_jpaket_record["cust_no"];
				$apaket_cust_nama=$rs_jpaket_record["cust_nama"];
			}
			$sql_paket="SELECT paket_kode, paket_nama, if(sum(rpaket_jumlah)!='null',sum(rpaket_jumlah),0) as total_isi_rpaket, if(sum(ipaket_jumlah)!='null',sum(ipaket_jumlah),0) as total_isi_ipaket FROM paket LEFT JOIN paket_isi_perawatan ON(rpaket_master=paket_id) LEFT JOIN paket_isi_produk ON(ipaket_master=paket_id) WHERE paket_id='$paket_id' GROUP BY paket_id";
			$rs_paket=$this->db->query($sql_paket);
			if($rs_paket->num_rows()){
				$rs_paket_record=$rs_paket->row_array();
				$apaket_paket_kode=$rs_paket_record["paket_kode"];
				$apaket_paket_nama=$rs_paket_record["paket_nama"];
				//$apaket_sisa_paket=$rs_paket_record["total_isi_rpaket"]+$rs_paket_record["total_isi_ipaket"];
				$apaket_sisa_paket=$rs_paket_record["total_isi_rpaket"];
			}
			
			//* INSERT ke db.master_ambil_paket 
			$dti_apaket=array(
			"apaket_jpaket"=>$jpaket_id,
			"apaket_faktur"=>$apaket_faktur,
			"apaket_faktur_tanggal"=>$apaket_faktur_tanggal,
			"apaket_kadaluarsa"=>$jpaket_kadaluarsa,
			"apaket_cust"=>$apaket_cust,
			"apaket_cust_no"=>$apaket_cust_no,
			"apaket_cust_nama"=>$apaket_cust_nama,
			"apaket_paket"=>$paket_id,
			"apaket_paket_kode"=>$apaket_paket_kode,
			"apaket_paket_nama"=>$apaket_paket_nama,
			"apaket_paket_jumlah"=>$paket_jumlah,
			"apaket_sisa_paket"=>$apaket_sisa_paket
			);
			$this->db->insert('master_ambil_paket',$dti_apaket);
			if($this->db->affected_rows()){
				$sql_apaket="SELECT apaket_id FROM master_ambil_paket WHERE apaket_jpaket='$jpaket_id' AND apaket_paket='$paket_id'";
				$rs_apaket=$this->db->query($sql_apaket);
				if($rs_apaket->num_rows()){
					$rs_apaket_record=$rs_apaket->row_array();
					$apaket_id=$rs_apaket_record["apaket_id"];
				}
				//* INSERT ke submaster_apaket_item (per isi paket) <== db.paket_isi_perawatan 
				$sql_rpaket="SELECT rpaket_perawatan, rpaket_jumlah, rawat_nama FROM paket_isi_perawatan LEFT JOIN perawatan ON(rpaket_perawatan=rawat_id) WHERE rpaket_master='$paket_id'";
				$rs_rpaket=$this->db->query($sql_rpaket);
				$rpaket_num_rows=$rs_rpaket->num_rows();
				if($rpaket_num_rows>0){
					foreach($rs_rpaket->result_array() as $row){
						$sapaket_item=$row['rpaket_perawatan'];
						$sapaket_item_nama=$row['rawat_nama'];
						$rpaket_jumlah=$row['rpaket_jumlah'];
						$dti_sapaket=array(
						"sapaket_master"=>$apaket_id,
						"sapaket_item"=>$sapaket_item,
						"sapaket_item_nama"=>$sapaket_item_nama,
						"sapaket_jenis_item"=>'perawatan',
						"sapaket_jmlisi_item"=>$rpaket_jumlah,
						"sapaket_sisa_item"=>$rpaket_jumlah
						);
						$this->db->insert('submaster_apaket_item',$dti_sapaket);
					}
				}
				
				//* INSERT ke submaster_apaket_item (per isi paket) <== db.paket_isi_perawatan 
				$sql_ipaket="SELECT ipaket_produk, ipaket_jumlah, produk_nama FROM paket_isi_produk LEFT JOIN produk ON(ipaket_produk=produk_id) WHERE ipaket_master='$paket_id'";
				$rs_ipaket=$this->db->query($sql_ipaket);
				$ipaket_num_rows=$rs_ipaket->num_rows();
				if($ipaket_num_rows>0){
					foreach($rs_ipaket->result_array() as $row){
						$sapaket_item=$row['ipaket_produk'];
						$sapaket_item_nama=$row['produk_nama'];
						$rpaket_jumlah=$row['ipaket_jumlah'];
						$dti_sapaket=array(
						"sapaket_master"=>$apaket_id,
						"sapaket_item"=>$sapaket_item,
						"sapaket_item_nama"=>$sapaket_item_nama,
						"sapaket_jenis_item"=>'produk',
						"sapaket_jmlisi_item"=>$rpaket_jumlah,
						"sapaket_sisa_item"=>$rpaket_jumlah
						);
						$this->db->insert('submaster_apaket_item',$dti_sapaket);
					}
				}
				
			}
		}*/
		
		/*function master_ambil_paket_insert($jpaket_id, $dpaket_paket, $dpaket_jumlah, $dpaket_kadaluarsa){
			//* INSERT ke db.master_ambil_paket (per isi paket) <== db.paket_isi_perawatan /
			$sql_rpaket="SELECT rpaket_perawatan, rpaket_jumlah FROM paket_isi_perawatan WHERE rpaket_master='$dpaket_paket'";
			$rs_rpaket=$this->db->query($sql_rpaket);
			if($rs_rpaket->num_rows()){
				foreach($rs_rpaket->result_array() as $row){
					$apaket_item=$row["rpaket_perawatan"];
					$apaket_sisa_item=$row["rpaket_jumlah"]*$dpaket_jumlah;
					$dti_rpaket_toapaket=array(
					"apaket_jpaket"=>$jpaket_id,
					"apaket_paket"=>$dpaket_paket,
					"apaket_item"=>$apaket_item,
					"apaket_jenis_item"=>'perawatan',
					"apaket_sisa_item"=>$apaket_sisa_item
					);
					$this->db->insert('master_ambil_paket', $dti_rpaket_toapaket);
				}
			}
			
			//* INSERT ke db.master_ambil_paket (per isi paket) <== db.paket_isi_produk /
			$sql_rpaket="SELECT ipaket_produk, ipaket_jumlah FROM paket_isi_produk WHERE ipaket_master='$dpaket_paket'";
			$rs_rpaket=$this->db->query($sql_rpaket);
			if($rs_rpaket->num_rows()){
				foreach($rs_rpaket->result_array() as $row){
					$apaket_item=$row["ipaket_produk"];
					$apaket_sisa_item=$row["ipaket_jumlah"]*$dpaket_jumlah;
					$dti_ipaket_toapaket=array(
					"apaket_jpaket"=>$jpaket_id,
					"apaket_paket"=>$dpaket_paket,
					"apaket_item"=>$apaket_item,
					"apaket_jenis_item"=>'produk',
					"apaket_sisa_item"=>$apaket_sisa_item
					);
					$this->db->insert('master_ambil_paket', $dti_ipaket_toapaket);
				}
			}
		}*/
		
		//insert detail record
		function detail_detail_jual_paket_insert($dpaket_id ,$dpaket_master ,$dpaket_paket, $dpaket_kadaluarsa ,$dpaket_jumlah ,$dpaket_harga ,$dpaket_diskon,$dpaket_diskon_jenis,$dpaket_sales, $cetak, $count, $dcount){
			//if master id not capture from view then capture it from max pk from master table
			if($dpaket_master=="" || $dpaket_master==NULL || $dpaket_master==0){
				$dpaket_master=$this->get_master_id();
			}
			if($dpaket_kadaluarsa=="")
				$dpaket_kadaluarsa=NULL;
			
			$dpaket_sisa_paket=0;
			$rpaket_jumlah_total=0;
			$ipaket_jumlah_total=0;
			
			$sql_rpaket="SELECT sum(rpaket_jumlah) AS rpaket_jumlah_total FROM paket_isi_perawatan WHERE rpaket_master='$dpaket_paket' ORDER BY rpaket_master";
			$rs_rpaket=$this->db->query($sql_rpaket);
			if($rs_rpaket->num_rows()){
				$rs_rpaket_record=$rs_rpaket->row_array();
				$rpaket_jumlah_total=$rs_rpaket_record["rpaket_jumlah_total"];
			}
			$sql_ipaket="SELECT sum(ipaket_jumlah) AS ipaket_jumlah_total FROM paket_isi_produk WHERE ipaket_master='$dpaket_paket' ORDER BY ipaket_master";
			$rs_ipaket=$this->db->query($sql_ipaket);
			if($rs_ipaket->num_rows()){
				$rs_ipaket_record=$rs_ipaket->row_array();
				$ipaket_jumlah_total=$rs_ipaket_record["ipaket_jumlah_total"];
			}
			$dpaket_sisa_paket=$rpaket_jumlah_total+$ipaket_jumlah_total;
			
			$data = array(
				"dpaket_master"=>$dpaket_master, 
				"dpaket_paket"=>$dpaket_paket,
				"dpaket_kadaluarsa"=>$dpaket_kadaluarsa, 
				"dpaket_jumlah"=>$dpaket_jumlah, 
				"dpaket_harga"=>$dpaket_harga, 
				"dpaket_diskon"=>$dpaket_diskon,
				"dpaket_diskon_jenis"=>$dpaket_diskon_jenis,
				"dpaket_sales"=>$dpaket_sales,
				"dpaket_sisa_paket"=>$dpaket_sisa_paket
			);
			$this->db->insert('detail_jual_paket', $data); 
			if($this->db->affected_rows()){
				if($cetak==1 && ($count==($dcount-1))){
					return $dpaket_master;
				}else if($cetak!==1 && ($count==($dcount-1))){
					return '0';
				}else if($count!==($dcount-1)){
					return '-3';
				}
			}else
				return '-1';

		}
		//end of function
		
		//function for get list record
		function master_jual_paket_list($filter,$start,$end){
			$date_now=date('Y-m-d');
		
			$query = "SELECT jpaket_id, jpaket_nobukti, cust_nama, cust_no, cust_member, jpaket_cust, jpaket_tanggal, jpaket_diskon, jpaket_cashback, jpaket_cara, jpaket_cara2, jpaket_cara3, jpaket_bayar, IF(vu_jpaket.jpaket_totalbiaya!=0,vu_jpaket.jpaket_totalbiaya,vu_jpaket_totalbiaya.jpaket_totalbiaya) AS jpaket_totalbiaya, jpaket_keterangan, jpaket_stat_dok, jpaket_creator, jpaket_date_create, jpaket_update, jpaket_date_update, jpaket_revised FROM vu_jpaket LEFT JOIN vu_jpaket_totalbiaya ON(vu_jpaket_totalbiaya.dpaket_master=vu_jpaket.jpaket_id)";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jpaket_nobukti LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%'  )";
			}
			//normal LIST by Hendri
			else {
				$query .= eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " date_format(jpaket_date_create,'%Y-%m-%d')='$date_now'";
			}	
			
			$query .= " ORDER BY jpaket_nobukti DESC ";
			
			$query_nbrows="SELECT jpaket_id FROM master_jual_paket LEFT JOIN customer ON(jpaket_cust=cust_id)";
			if ($filter<>""){
				$query_nbrows .=eregi("WHERE",$query_nbrows)? " AND ":" WHERE ";
				$query_nbrows .= " (jpaket_nobukti LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%'  )";
			}
			else {
				$query_nbrows .= eregi("WHERE",$query_nbrows)? " AND ":" WHERE ";
				$query_nbrows .= " date_format(jpaket_date_create,'%Y-%m-%d')='$date_now'";
			}	
			
			$result = $this->db->query($query_nbrows);
			$nbrows = $result->num_rows();
			//$result = $this->db->query($query);
			//$nbrows = $result->num_rows();
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
		function master_jual_paket_update($jpaket_id ,$jpaket_nobukti ,$jpaket_cust ,$jpaket_tanggal ,$jpaket_stat_dok, $jpaket_diskon ,$jpaket_cara ,$jpaket_cara2 ,$jpaket_cara3 ,$jpaket_keterangan , $jpaket_cashback, $jpaket_tunai_nilai, $jpaket_tunai_nilai2, $jpaket_tunai_nilai3, $jpaket_voucher_no, $jpaket_voucher_cashback, $jpaket_voucher_no2, $jpaket_voucher_cashback2, $jpaket_voucher_no3, $jpaket_voucher_cashback3, $jpaket_bayar, $jpaket_subtotal, $jpaket_hutang, $jpaket_kwitansi_no, $jpaket_kwitansi_nama, $jpaket_kwitansi_nilai, $jpaket_kwitansi_no2, $jpaket_kwitansi_nama2, $jpaket_kwitansi_nilai2, $jpaket_kwitansi_no3, $jpaket_kwitansi_nama3, $jpaket_kwitansi_nilai3, $jpaket_card_nama, $jpaket_card_edc, $jpaket_card_no, $jpaket_card_nilai, $jpaket_card_nama2, $jpaket_card_edc2, $jpaket_card_no2, $jpaket_card_nilai2, $jpaket_card_nama3, $jpaket_card_edc3, $jpaket_card_no3, $jpaket_card_nilai3, $jpaket_cek_nama, $jpaket_cek_no, $jpaket_cek_valid, $jpaket_cek_bank, $jpaket_cek_nilai, $jpaket_cek_nama2, $jpaket_cek_no2, $jpaket_cek_valid2, $jpaket_cek_bank2, $jpaket_cek_nilai2, $jpaket_cek_nama3, $jpaket_cek_no3, $jpaket_cek_valid3, $jpaket_cek_bank3, $jpaket_cek_nilai3, $jpaket_transfer_bank, $jpaket_transfer_nama, $jpaket_transfer_nilai, $jpaket_transfer_bank2, $jpaket_transfer_nama2, $jpaket_transfer_nilai2, $jpaket_transfer_bank3, $jpaket_transfer_nama3, $jpaket_transfer_nilai3){
			if ($jpaket_stat_dok=="")
				$jpaket_stat_dok = "Terbuka";
			
			$sql="SELECT jpaket_cara, jpaket_cara2, jpaket_cara3 FROM master_jual_paket WHERE jpaket_id='$jpaket_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$jpaket_cara_awal=$rs_record["jpaket_cara"];
				$jpaket_cara2_awal=$rs_record["jpaket_cara2"];
				$jpaket_cara3_awal=$rs_record["jpaket_cara3"];
				if($jpaket_cara_awal<>$jpaket_cara){
					if($jpaket_cara_awal=="tunai"){
						$sql="delete from jual_tunai where jtunai_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
					}
					if($jpaket_cara_awal=="kwitansi"){
						$sql="delete from jual_kwitansi where jkwitansi_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
					}
					if($jpaket_cara_awal=="card"){
						$sql="delete from jual_card where jcard_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
					}
					if($jpaket_cara_awal=="cek/giro"){
						$sql="delete from jual_cek where jcek_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
					}
					if($jpaket_cara_awal=="transfer"){
						$sql="delete from jual_transfer where jtransfer_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
					}
				}
				
				if($jpaket_cara2_awal<>$jpaket_cara2){
					if($jpaket_cara2_awal=="tunai"){
						$sql="delete from jual_tunai where jtunai_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
					}
					if($jpaket_cara2_awal=="kwitansi"){
						$sql="delete from jual_kwitansi where jkwitansi_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
					}
					if($jpaket_cara2_awal=="card"){
						$sql="delete from jual_card where jcard_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
					}
					if($jpaket_cara2_awal=="cek/giro"){
						$sql="delete from jual_cek where jcek_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
					}
					if($jpaket_cara2_awal=="transfer"){
						$sql="delete from jual_transfer where jtransfer_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
					}
				}
				
				if($jpaket_cara3_awal<>$jpaket_cara3){
					if($jpaket_cara3_awal=="tunai"){
						$sql="delete from jual_tunai where jtunai_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
					}
					if($jpaket_cara3_awal=="kwitansi"){
						$sql="delete from jual_kwitansi where jkwitansi_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
					}
					if($jpaket_cara3_awal=="card"){
						$sql="delete from jual_card where jcard_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
					}
					if($jpaket_cara3_awal=="cek/giro"){
						$sql="delete from jual_cek where jcek_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
					}
					if($jpaket_cara3_awal=="transfer"){
						$sql="delete from jual_transfer where jtransfer_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
					}
				}
			}
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
				"jpaket_keterangan"=>$jpaket_keterangan,
				"jpaket_stat_dok"=>$jpaket_stat_dok
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
						
						$sql="SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jkwitansi_master"=>$jpaket_kwitansi_no,
								"jkwitansi_nilai"=>$jpaket_kwitansi_nilai
							);
							$this->db->where('jkwitansi_ref', $jpaket_nobukti);
							$this->db->update('jual_kwitansi', $data);
						}else{
							$data=array(
								"jkwitansi_ref"=>$jpaket_nobukti,
								"jkwitansi_master"=>$jpaket_kwitansi_no,
								"jkwitansi_nilai"=>$jpaket_kwitansi_nilai,
								"jkwitansi_transaksi"=>"jual_paket"
							);
							$this->db->insert('jual_kwitansi', $data);
						}
					
					}else if($jpaket_cara=='card'){
						$sql="SELECT jcard_id FROM jual_card WHERE jcard_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcard_nama"=>$jpaket_card_nama,
								"jcard_edc"=>$jpaket_card_edc,
								"jcard_no"=>$jpaket_card_no,
								"jcard_nilai"=>$jpaket_card_nilai
								);
							$this->db->where('jcard_ref', $jpaket_nobukti);
							$this->db->update('jual_card', $data);
						}else{
							$data=array(
								"jcard_ref"=>$jpaket_nobukti,
								"jcard_nama"=>$jpaket_card_nama,
								"jcard_edc"=>$jpaket_card_edc,
								"jcard_no"=>$jpaket_card_no,
								"jcard_nilai"=>$jpaket_card_nilai,
								"jcard_transaksi"=>"jual_paket"
								);
							$this->db->insert('jual_card', $data);
						}
					
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
						
						$sql="SELECT jcek_id FROM jual_cek WHERE jcek_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcek_nama"=>$jpaket_cek_nama,
								"jcek_no"=>$jpaket_cek_no,
								"jcek_valid"=>$jpaket_cek_valid,
								"jcek_bank"=>$jpaket_cek_bank,
								"jcek_nilai"=>$jpaket_cek_nilai
								);
							$this->db->where('jcek_ref', $jpaket_nobukti);
							$this->db->update('jual_cek', $data);
						}else{
							$data=array(
								"jcek_ref"=>$jpaket_nobukti,
								"jcek_nama"=>$jpaket_cek_nama,
								"jcek_no"=>$jpaket_cek_no,
								"jcek_valid"=>$jpaket_cek_valid,
								"jcek_bank"=>$jpaket_cek_bank,
								"jcek_nilai"=>$jpaket_cek_nilai,
								"jcek_transaksi"=>"jual_paket"
								);
							$this->db->insert('jual_cek', $data);
						}
						
					}else if($jpaket_cara=='transfer'){
						$sql="SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtransfer_bank"=>$jpaket_transfer_bank,
								"jtransfer_nama"=>$jpaket_transfer_nama,
								"jtransfer_nilai"=>$jpaket_transfer_nilai
								);
							$this->db->where('jtransfer_ref', $jpaket_nobukti);
							$this->db->update('jual_transfer', $data);
						}else{
							$data=array(
								"jtransfer_ref"=>$jpaket_nobukti,
								"jtransfer_bank"=>$jpaket_transfer_bank,
								"jtransfer_nama"=>$jpaket_transfer_nama,
								"jtransfer_nilai"=>$jpaket_transfer_nilai,
								"jtransfer_transaksi"=>"jual_paket"
								);
							$this->db->insert('jual_transfer', $data);
						}
						
					}else if($jpaket_cara=='tunai'){
						$sql="SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtunai_nilai"=>$jpaket_tunai_nilai
								);
							$this->db->where('jtunai_ref', $jpaket_nobukti);
							$this->db->update('jual_tunai', $data);
						}else{
							$data=array(
								"jtunai_nilai"=>$jpaket_tunai_nilai,
								"jtunai_ref"=>$jpaket_nobukti,
								"jtunai_transaksi"=>"jual_paket"
								);
							$this->db->insert('jual_tunai', $data);
						}
						
					}else if($jpaket_cara=='voucher'){
						$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jpaket_voucher_no'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jpaket_voucher_no,
								"tvoucher_nilai"=>$jpaket_voucher_cashback
								);
							$this->db->where('tvoucher_ref', $jpaket_nobukti);
							$this->db->update('voucher_terima', $data);
						}else{
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jpaket_voucher_no'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jpaket_voucher_no,
								"tvoucher_ref"=>$jpaket_nobukti,
								"tvoucher_nilai"=>$jpaket_voucher_cashback,
								"tvoucher_transaksi"=>"jual_paket"
								);
							$this->db->insert('voucher_terima', $data);
						}
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
						
						$sql="SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jkwitansi_master"=>$jpaket_kwitansi_no2,
								"jkwitansi_nilai"=>$jpaket_kwitansi_nilai2
							);
							$this->db->where('jkwitansi_ref', $jpaket_nobukti);
							$this->db->update('jual_kwitansi', $data);
						}else{
							$data=array(
								"jkwitansi_ref"=>$jpaket_nobukti,
								"jkwitansi_master"=>$jpaket_kwitansi_no2,
								"jkwitansi_nilai"=>$jpaket_kwitansi_nilai2,
								"jkwitansi_transaksi"=>"jual_paket"
							);
							$this->db->insert('jual_kwitansi', $data);
						}
					
					}else if($jpaket_cara2=='card'){
						$sql="SELECT jcard_id FROM jual_card WHERE jcard_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcard_nama"=>$jpaket_card_nama2,
								"jcard_edc"=>$jpaket_card_edc2,
								"jcard_no"=>$jpaket_card_no2,
								"jcard_nilai"=>$jpaket_card_nilai2
								);
							$this->db->where('jcard_ref', $jpaket_nobukti);
							$this->db->update('jual_card', $data);
						}else{
							$data=array(
								"jcard_ref"=>$jpaket_nobukti,
								"jcard_nama"=>$jpaket_card_nama2,
								"jcard_edc"=>$jpaket_card_edc2,
								"jcard_no"=>$jpaket_card_no2,
								"jcard_nilai"=>$jpaket_card_nilai2,
								"jcard_transaksi"=>"jual_paket"
								);
							$this->db->insert('jual_card', $data);
						}
					
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
						
						$sql="SELECT jcek_id FROM jual_cek WHERE jcek_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcek_nama"=>$jpaket_cek_nama2,
								"jcek_no"=>$jpaket_cek_no2,
								"jcek_valid"=>$jpaket_cek_valid2,
								"jcek_bank"=>$jpaket_cek_bank2,
								"jcek_nilai"=>$jpaket_cek_nilai2
								);
							$this->db->where('jcek_ref', $jpaket_nobukti);
							$this->db->update('jual_cek', $data);
						}else{
							$data=array(
								"jcek_ref"=>$jpaket_nobukti,
								"jcek_nama"=>$jpaket_cek_nama2,
								"jcek_no"=>$jpaket_cek_no2,
								"jcek_valid"=>$jpaket_cek_valid2,
								"jcek_bank"=>$jpaket_cek_bank2,
								"jcek_nilai"=>$jpaket_cek_nilai2,
								"jcek_transaksi"=>"jual_paket"
								);
							$this->db->insert('jual_cek', $data);
						}
						
					}else if($jpaket_cara2=='transfer'){
						$sql="SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtransfer_bank"=>$jpaket_transfer_bank2,
								"jtransfer_nama"=>$jpaket_transfer_nama2,
								"jtransfer_nilai"=>$jpaket_transfer_nilai2
								);
							$this->db->where('jtransfer_ref', $jpaket_nobukti);
							$this->db->update('jual_transfer', $data);
						}else{
							$data=array(
								"jtransfer_ref"=>$jpaket_nobukti,
								"jtransfer_bank"=>$jpaket_transfer_bank2,
								"jtransfer_nama"=>$jpaket_transfer_nama2,
								"jtransfer_nilai"=>$jpaket_transfer_nilai2,
								"jtransfer_transaksi"=>"jual_paket"
								);
							$this->db->insert('jual_transfer', $data);
						}
						
					}else if($jpaket_cara2=='tunai'){
						$sql="SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtunai_nilai"=>$jpaket_tunai_nilai2
								);
							$this->db->where('jtunai_ref', $jpaket_nobukti);
							$this->db->update('jual_tunai', $data);
						}else{
							$data=array(
								"jtunai_nilai"=>$jpaket_tunai_nilai2,
								"jtunai_ref"=>$jpaket_nobukti,
								"jtunai_transaksi"=>"jual_paket"
								);
							$this->db->insert('jual_tunai', $data);
						}
						
					}else if($jpaket_cara=='voucher'){
						$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jpaket_voucher_no'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jpaket_voucher_no2,
								"tvoucher_nilai"=>$jpaket_voucher_cashback2
								);
							$this->db->where('tvoucher_ref', $jpaket_nobukti);
							$this->db->update('voucher_terima', $data);
						}else{
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jpaket_voucher_no'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jpaket_voucher_no2,
								"tvoucher_ref"=>$jpaket_nobukti,
								"tvoucher_nilai"=>$jpaket_voucher_cashback2,
								"tvoucher_transaksi"=>"jual_paket"
								);
							$this->db->insert('voucher_terima', $data);
						}
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
						
						$sql="SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jkwitansi_master"=>$jpaket_kwitansi_no3,
								"jkwitansi_nilai"=>$jpaket_kwitansi_nilai3
							);
							$this->db->where('jkwitansi_ref', $jpaket_nobukti);
							$this->db->update('jual_kwitansi', $data);
						}else{
							$data=array(
								"jkwitansi_ref"=>$jpaket_nobukti,
								"jkwitansi_master"=>$jpaket_kwitansi_no3,
								"jkwitansi_nilai"=>$jpaket_kwitansi_nilai3,
								"jkwitansi_transaksi"=>"jual_paket"
							);
							$this->db->insert('jual_kwitansi', $data);
						}
					
					}else if($jpaket_cara3=='card'){
						$sql="SELECT jcard_id FROM jual_card WHERE jcard_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcard_nama"=>$jpaket_card_nama3,
								"jcard_edc"=>$jpaket_card_edc3,
								"jcard_no"=>$jpaket_card_no3,
								"jcard_nilai"=>$jpaket_card_nilai3
								);
							$this->db->where('jcard_ref', $jpaket_nobukti);
							$this->db->update('jual_card', $data);
						}else{
							$data=array(
								"jcard_ref"=>$jpaket_nobukti,
								"jcard_nama"=>$jpaket_card_nama3,
								"jcard_edc"=>$jpaket_card_edc3,
								"jcard_no"=>$jpaket_card_no3,
								"jcard_nilai"=>$jpaket_card_nilai3,
								"jcard_transaksi"=>"jual_paket"
								);
							$this->db->insert('jual_card', $data);
						}
					
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
						
						$sql="SELECT jcek_id FROM jual_cek WHERE jcek_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jcek_nama"=>$jpaket_cek_nama3,
								"jcek_no"=>$jpaket_cek_no3,
								"jcek_valid"=>$jpaket_cek_valid3,
								"jcek_bank"=>$jpaket_cek_bank3,
								"jcek_nilai"=>$jpaket_cek_nilai3
								);
							$this->db->where('jcek_ref', $jpaket_nobukti);
							$this->db->update('jual_cek', $data);
						}else{
							$data=array(
								"jcek_ref"=>$jpaket_nobukti,
								"jcek_nama"=>$jpaket_cek_nama3,
								"jcek_no"=>$jpaket_cek_no3,
								"jcek_valid"=>$jpaket_cek_valid3,
								"jcek_bank"=>$jpaket_cek_bank3,
								"jcek_nilai"=>$jpaket_cek_nilai3,
								"jcek_transaksi"=>"jual_paket"
								);
							$this->db->insert('jual_cek', $data);
						}
						
					}else if($jpaket_cara3=='transfer'){
						$sql="SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtransfer_bank"=>$jpaket_transfer_bank3,
								"jtransfer_nama"=>$jpaket_transfer_nama3,
								"jtransfer_nilai"=>$jpaket_transfer_nilai3
								);
							$this->db->where('jtransfer_ref', $jpaket_nobukti);
							$this->db->update('jual_transfer', $data);
						}else{
							$data=array(
								"jtransfer_ref"=>$jpaket_nobukti,
								"jtransfer_bank"=>$jpaket_transfer_bank3,
								"jtransfer_nama"=>$jpaket_transfer_nama3,
								"jtransfer_nilai"=>$jpaket_transfer_nilai3,
								"jtransfer_transaksi"=>"jual_paket"
								);
							$this->db->insert('jual_transfer', $data);
						}
						
					}else if($jpaket_cara3=='tunai'){
						$sql="SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$data=array(
								"jtunai_nilai"=>$jpaket_tunai_nilai3
								);
							$this->db->where('jtunai_ref', $jpaket_nobukti);
							$this->db->update('jual_tunai', $data);
						}else{
							$data=array(
								"jtunai_nilai"=>$jpaket_tunai_nilai3,
								"jtunai_ref"=>$jpaket_nobukti,
								"jtunai_transaksi"=>"jual_paket"
								);
							$this->db->insert('jual_tunai', $data);
						}
						
					}else if($jpaket_cara=='voucher'){
						$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jpaket_nobukti'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jpaket_voucher_no'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jpaket_voucher_no3,
								"tvoucher_nilai"=>$jpaket_voucher_cashback3
								);
							$this->db->where('tvoucher_ref', $jpaket_nobukti);
							$this->db->update('voucher_terima', $data);
						}else{
							/*$get_voucher_cashback=0;
							$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jpaket_voucher_no'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								$rs_record=$rs->row_array();
								$get_voucher_cashback=$rs_record["voucher_cashback"];
							}*/
							$data=array(
								"tvoucher_novoucher"=>$jpaket_voucher_no3,
								"tvoucher_ref"=>$jpaket_nobukti,
								"tvoucher_nilai"=>$jpaket_voucher_cashback3,
								"tvoucher_transaksi"=>"jual_paket"
								);
							$this->db->insert('voucher_terima', $data);
						}
					}
				}
				
				return '1';
			}
			else{
				return '0';
			}
		}
		
		//function for create new record
		function master_jual_paket_create($jpaket_nobukti ,$jpaket_cust ,$jpaket_tanggal ,$jpaket_diskon ,$jpaket_stat_dok, $jpaket_cara ,$jpaket_cara2 ,$jpaket_cara3 ,$jpaket_keterangan , $jpaket_cashback, $jpaket_tunai_nilai, $jpaket_tunai_nilai2, $jpaket_tunai_nilai3, $jpaket_voucher_no, $jpaket_voucher_cashback, $jpaket_voucher_no2, $jpaket_voucher_cashback2, $jpaket_voucher_no3, $jpaket_voucher_cashback3, $jpaket_bayar, $jpaket_subtotal, $jpaket_total, $jpaket_hutang, $jpaket_kwitansi_no, $jpaket_kwitansi_nama, $jpaket_kwitansi_nilai, $jpaket_kwitansi_no2, $jpaket_kwitansi_nama2, $jpaket_kwitansi_nilai2, $jpaket_kwitansi_no3, $jpaket_kwitansi_nama3, $jpaket_kwitansi_nilai3, $jpaket_card_nama, $jpaket_card_edc, $jpaket_card_no, $jpaket_card_nilai, $jpaket_card_nama2, $jpaket_card_edc2, $jpaket_card_no2, $jpaket_card_nilai2, $jpaket_card_nama3, $jpaket_card_edc3, $jpaket_card_no3, $jpaket_card_nilai3, $jpaket_cek_nama, $jpaket_cek_no, $jpaket_cek_valid, $jpaket_cek_bank, $jpaket_cek_nilai, $jpaket_cek_nama2, $jpaket_cek_no2, $jpaket_cek_valid2, $jpaket_cek_bank2, $jpaket_cek_nilai2, $jpaket_cek_nama3, $jpaket_cek_no3, $jpaket_cek_valid3, $jpaket_cek_bank3, $jpaket_cek_nilai3, $jpaket_transfer_bank, $jpaket_transfer_nama, $jpaket_transfer_nilai, $jpaket_transfer_bank2, $jpaket_transfer_nama2, $jpaket_transfer_nilai2, $jpaket_transfer_bank3, $jpaket_transfer_nama3, $jpaket_transfer_nilai3){
			$pattern="PK/".date("ym")."-";
			
			$jpaket_nobukti=$this->m_public_function->get_kode_1('master_jual_paket','jpaket_nobukti',$pattern,12);	//sementara, utk input manual
			if ($jpaket_stat_dok=="")
				$jpaket_stat_dok = "Terbuka";
			
			
			$data = array(
				"jpaket_nobukti"=>$jpaket_nobukti, 
				"jpaket_cust"=>$jpaket_cust, 
				"jpaket_tanggal"=>$jpaket_tanggal, 
				"jpaket_diskon"=>$jpaket_diskon, 
				"jpaket_cashback"=>$jpaket_cashback,
				"jpaket_bayar"=>$jpaket_bayar,
				"jpaket_totalbiaya"=>$jpaket_total,
				"jpaket_cara"=>$jpaket_cara, 
				//"jpaket_cara2"=>$jpaket_cara2, 
				//"jpaket_cara3"=>$jpaket_cara3, 
				"jpaket_keterangan"=>$jpaket_keterangan,
				"jpaket_stat_dok"=>$jpaket_stat_dok,
				"jpaket_creator"=>$_SESSION[SESSION_USERID]
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
							"jkwitansi_master"=>$jpaket_kwitansi_no,
							"jkwitansi_nilai"=>$jpaket_kwitansi_nilai,
							"jkwitansi_ref"=>$jpaket_nobukti,
							"jkwitansi_transaksi"=>"jual_paket"
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jpaket_cara=='card'){
						
						$data=array(
							"jcard_nama"=>$jpaket_card_nama,
							"jcard_edc"=>$jpaket_card_edc,
							"jcard_no"=>$jpaket_card_no,
							"jcard_nilai"=>$jpaket_card_nilai,
							"jcard_ref"=>$jpaket_nobukti,
							"jcard_transaksi"=>"jual_paket"
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
							"jcek_ref"=>$jpaket_nobukti,
							"jcek_transaksi"=>"jual_paket"
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jpaket_cara=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jpaket_transfer_bank,
							"jtransfer_nama"=>$jpaket_transfer_nama,
							"jtransfer_nilai"=>$jpaket_transfer_nilai,
							"jtransfer_ref"=>$jpaket_nobukti,
							"jtransfer_transaksi"=>"jual_paket"
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jpaket_cara=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jpaket_tunai_nilai,
							"jtunai_ref"=>$jpaket_nobukti,
							"jtunai_transaksi"=>"jual_paket"
							);
						$this->db->insert('jual_tunai', $data); 
					}else if($jpaket_cara=='voucher'){
						$data=array(
							"tvoucher_novoucher"=>$jpaket_voucher_no,
							"tvoucher_ref"=>$jpaket_nobukti,
							"tvoucher_nilai"=>$jpaket_voucher_cashback,
							"tvoucher_transaksi"=>"jual_paket"
							);
						$this->db->insert('voucher_terima', $data); 
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
							"jkwitansi_master"=>$jpaket_kwitansi_no2,
							"jkwitansi_nilai"=>$jpaket_kwitansi_nilai2,
							"jkwitansi_ref"=>$jpaket_nobukti,
							"jkwitansi_transaksi"=>"jual_paket"
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jpaket_cara2=='card'){
						$data=array(
							"jcard_nama"=>$jpaket_card_nama2,
							"jcard_edc"=>$jpaket_card_edc2,
							"jcard_no"=>$jpaket_card_no2,
							"jcard_nilai"=>$jpaket_card_nilai2,
							"jcard_ref"=>$jpaket_nobukti,
							"jcard_transaksi"=>"jual_paket"
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
							"jcek_nilai"=>$jpaket_cek_nilai2,
							"jcek_ref"=>$jpaket_nobukti,
							"jcek_transaksi"=>"jual_paket"
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jpaket_cara2=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jpaket_transfer_bank2,
							"jtransfer_nama"=>$jpaket_transfer_nama2,
							"jtransfer_nilai"=>$jpaket_transfer_nilai2,
							"jtransfer_ref"=>$jpaket_nobukti,
							"jtransfer_transaksi"=>"jual_paket"
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jpaket_cara2=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jpaket_tunai_nilai2,
							"jtunai_ref"=>$jpaket_nobukti,
							"jtunai_transaksi"=>"jual_paket"
							);
						$this->db->insert('jual_tunai', $data); 
					}else if($jpaket_cara2=='voucher'){
						$data=array(
							"tvoucher_novoucher"=>$jpaket_voucher_no2,
							"tvoucher_ref"=>$jpaket_nobukti,
							"tvoucher_nilai"=>$jpaket_voucher_cashback2,
							"tvoucher_transaksi"=>"jual_paket"
							);
						$this->db->insert('voucher_terima', $data); 
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
							"jkwitansi_master"=>$jpaket_kwitansi_no3,
							"jkwitansi_nilai"=>$jpaket_kwitansi_nilai3,
							"jkwitansi_ref"=>$jpaket_nobukti,
							"jkwitansi_transaksi"=>"jual_paket"
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jpaket_cara3=='card'){
						
						$data=array(
							"jcard_nama"=>$jpaket_card_nama3,
							"jcard_edc"=>$jpaket_card_edc3,
							"jcard_no"=>$jpaket_card_no3,
							"jcard_nilai"=>$jpaket_card_nilai3,
							"jcard_ref"=>$jpaket_nobukti,
							"jcard_transaksi"=>"jual_paket"
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
							"jcek_nilai"=>$jpaket_cek_nilai3,
							"jcek_ref"=>$jpaket_nobukti,
							"jcek_transaksi"=>"jual_paket"
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jpaket_cara3=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jpaket_transfer_bank3,
							"jtransfer_nama"=>$jpaket_transfer_nama3,
							"jtransfer_nilai"=>$jpaket_transfer_nilai3,
							"jtransfer_ref"=>$jpaket_nobukti,
							"jtransfer_transaksi"=>"jual_paket"
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jpaket_cara3=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jpaket_tunai_nilai3,
							"jtunai_ref"=>$jpaket_nobukti,
							"jtunai_transaksi"=>"jual_paket"
							);
						$this->db->insert('jual_tunai', $data); 
					}else if($jpaket_cara3=='voucher'){
						$data=array(
							"tvoucher_novoucher"=>$jpaket_voucher_no3,
							"tvoucher_ref"=>$jpaket_nobukti,
							"tvoucher_nilai"=>$jpaket_voucher_cashback3,
							"tvoucher_transaksi"=>"jual_paket"
							);
						$this->db->insert('voucher_terima', $data); 
					}
				}
				
				/* Ambil db.master_jual_paket.jpaket_id ==> untuk memasukkan Customer yang membeli Paket ke db.submaster_jual_paket sebagai daftar pengguna Faktur Penjualan Paket */
				$sql="SELECT jpaket_id FROM master_jual_paket WHERE jpaket_nobukti='$jpaket_nobukti'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$rs_record=$rs->row_array();
					$data_sjpaket=array(
					"ppaket_master"=>$rs_record["jpaket_id"],
					"ppaket_cust"=>$jpaket_cust
					);
					$this->db->insert('pengguna_paket', $data_sjpaket);
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
				echo "q1 = ".$query;
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
				echo "q2 = ".$query;
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
		
		function print_paper($jpaket_id){
			//$this->firephp->log($jpaket_id, "jpaket_id");
			$sql="SELECT jpaket_tanggal, cust_no, cust_nama, cust_alamat, jpaket_nobukti, paket_nama, dpaket_jumlah, dpaket_harga, dpaket_diskon, (dpaket_harga*((100-dpaket_diskon)/100)) AS jumlah_subtotal, jpaket_creator, jtunai_nilai, jpaket_diskon, jpaket_cashback FROM detail_jual_paket LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id) LEFT JOIN customer ON(jpaket_cust=cust_id) LEFT JOIN paket ON(dpaket_paket=paket_id) LEFT JOIN jual_tunai ON(jtunai_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
			$result = $this->db->query($sql);
			return $result;
		}
		
			function iklan(){
			//$this->firephp->log($jproduk_id, "jproduk_id");
			$sql="SELECT * from iklan_today";
			$result = $this->db->query($sql);
			return $result;
		}
		
		
		
}
?>