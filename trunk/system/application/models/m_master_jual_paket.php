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
				case "Tanggal": $order_by=" ORDER BY tanggal ASC";break;
				case "Customer": $order_by=" ORDER BY cust_id ASC";break;
				case "No Faktur": $order_by=" ORDER BY no_bukti ASC";break;
				case "Paket": $order_by=" ORDER BY produk_id ASC";break;
				case "Sales": $order_by=" ORDER BY sales ASC";break;
				case "Jenis Diskon": $order_by=" ORDER BY diskon_jenis ASC";break;
				default: $order_by=" ORDER BY no_bukti ASC";break;
			}
			
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT distinct * FROM vu_trans_paket WHERE jpaket_stat_dok<>'Batal' ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT distinct * FROM vu_trans_paket WHERE jpaket_stat_dok<>'Batal' AND  date_format(tanggal, '%Y-%m')='".$tgl_awal."' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT distinct * FROM vu_trans_paket WHERE jpaket_stat_dok<>'Batal' AND date_format(tanggal, '%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal, '%Y-%m-%d')<='".$tgl_akhir."' ".$order_by;
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT * FROM vu_detail_jual_paket WHERE jpaket_stat_dok<>'Batal' ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_detail_jual_paket WHERE jpaket_stat_dok<>'Batal' AND  date_format(tanggal, '%Y-%m')='".$tgl_awal."' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_detail_jual_paket WHERE jpaket_stat_dok<>'Batal' AND date_format(tanggal, '%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal, '%Y-%m-%d')<='".$tgl_akhir."' ".$order_by;
			}
			
			//echo $sql;
			
			$query=$this->db->query($sql);
			return $query->result();
		}
		
		function get_reveral_list($query,$start,$end){
			$sql="SELECT karyawan_id,karyawan_no,karyawan_username,karyawan_nama,karyawan_tgllahir,karyawan_alamat
			FROM karyawan where karyawan_aktif='Aktif'";
			if($query<>""){
				$sql=$sql." and (karyawan_no like '%".$query."%' or karyawan_nama like '%".$query."%') ";
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
			
			$sql="SELECT cust_id,cust_no,cust_nama,cust_tgllahir,cust_alamat,cust_telprumah FROM customer WHERE cust_aktif='Aktif'";
			if($query<>"" && is_numeric($query)==false){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.=" (cust_nama like '%".$query."%' OR cust_no like '%".$query."%' ) ";
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
		
		function detail_pengguna_paket_insert($ppaket_id, $ppaket_master, $ppaket_cust){
			//if master id not capture from view then capture it from max pk from master table
			if($ppaket_master=="" || $ppaket_master==NULL || $ppaket_master==0){
				$ppaket_master=$this->get_master_id();
			}
			
			if($ppaket_id==''){
				//* Adding Pemakai Paket /
				$dti_ppaket = array(
				"ppaket_master"=>$ppaket_master, 
				"ppaket_cust"=>$ppaket_cust
				);
				$sql="SELECT ppaket_id FROM pengguna_paket WHERE ppaket_master='$ppaket_master' AND ppaket_cust='$ppaket_cust'";
				$rs=$this->db->query($sql);
				if(!$rs->num_rows()){
					//* Customer ini belum masuk ke dalam Daftar Pemakai Paket dari Faktur ppaket_master /
					$this->db->insert('pengguna_paket', $dti_ppaket); 
					if($this->db->affected_rows()){
						return '1';
					}else
						return '0';
				}
			}/*elseif(is_numeric($ppaket_id)==true){
				//* Editing Pemakai Paket /
				$dtu_ppaket = array(
				"ppaket_cust"=>$ppaket_cust
				);
				$this->db->where('ppaket_id', $ppaket_id);
				$this->db->update('pengguna_paket', $dtu_ppaket);
				if($this->db->affected_rows()){
					return '1';
				}else
					return '0';
			}*/
			
		}
		
		function get_paket_list($query,$start,$end){
			$rs_rows=0;
			if(is_numeric($query)==true){
				$sql_paket="SELECT distinct(dpaket_paket) FROM detail_jual_paket WHERE dpaket_master='$query'";
				$rs=$this->db->query($sql_paket);
				$rs_rows=$rs->num_rows();
			}
			
//			$sql="SELECT paket_id, paket_harga, paket_kode, group_nama, kategori_nama, paket_du, paket_dm, paket_nama, paket_expired FROM paket INNER JOIN produk_group ON paket.paket_group=produk_group.group_id INNER JOIN kategori ON produk_group.group_kelompok=kategori.kategori_id WHERE kategori.kategori_jenis='paket' AND paket_aktif='Aktif'";
			$sql=  "SELECT 
						paket_id, paket_harga, paket_kode, paket_du, paket_dm, paket_nama, paket_expired 
					FROM paket 
					WHERE paket_aktif='Aktif'";

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
		
		function get_point_per_rupiah(){
			$query = "SELECT setmember_point_perrp FROM member_setup LIMIT 1";
			$result = $this->db->query($query);
			if($result->num_rows()){
				$data=$result->row();
				$setmember_point_perrp=$data->setmember_point_perrp;
				return $setmember_point_perrp;
			}else{
				return 0;
			}
		}
		
		function catatan_piutang_update($jpaket_id){
			/*if($jpaket_id=="" || $jpaket_id==NULL || $jpaket_id==0){
				$jpaket_id=$this->get_master_id();
			}*/
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
					/* 1. DELETE db.master_lunas_piutang AND db.detail_jual_piutang
					 * 2. INSERT to db.master_lunas_piutang
					*/
					$sql = "DELETE detail_lunas_piutang, master_lunas_piutang
						FROM master_lunas_piutang
						LEFT JOIN detail_lunas_piutang ON(dpiutang_master=lpiutang_id)
						WHERE lpiutang_faktur='".$lpiutang_faktur."'";
					$this->db->query($sql);
					if($this->db->affected_rows()){
						//INSERT to db.master_lunas_piutang
						$dti_lpiutang=array(
						"lpiutang_faktur"=>$lpiutang_faktur,
						"lpiutang_cust"=>$lpiutang_cust,
						"lpiutang_faktur_tanggal"=>$lpiutang_faktur_tanggal,
						"lpiutang_total"=>$lpiutang_total,
						"lpiutang_sisa"=>$lpiutang_total,
						"lpiutang_jenis_transaksi"=>'jual_paket',
						"lpiutang_stat_dok"=>'Terbuka'
						);
						$this->db->insert('master_lunas_piutang', $dti_lpiutang);
					}
				}else{
					/* INSERT db.master_lunas_piutang */
					$dti_lpiutang=array(
					"lpiutang_faktur"=>$lpiutang_faktur,
					"lpiutang_cust"=>$lpiutang_cust,
					"lpiutang_faktur_tanggal"=>$lpiutang_faktur_tanggal,
					"lpiutang_total"=>$lpiutang_total,
					"lpiutang_sisa"=>$lpiutang_total,
					"lpiutang_jenis_transaksi"=>'jual_paket',
					"lpiutang_stat_dok"=>'Terbuka'
					);
					$this->db->insert('master_lunas_piutang', $dti_lpiutang);
				}
			}
		}
		
		function catatan_piutang_batal($jpaket_id){
			/* 1. Cari jpaket_nobukti
			 * 2. UPDATE db.master_lunas_piutang.lpiutang_stat_dok = 'Batal'
			*/
			$datetime_now = date('Y-m-d H:i:s');
			
			$sql = "SELECT jpaket_nobukti FROM master_jual_paket WHERE jpaket_id='".$jpaket_id."'";
			$rs = $this->db->query($sql);
			if($rs->num_rows()){
				$record = $rs->row_array();
				$jpaket_nobukti = $record['jpaket_nobukti'];
				
				//UPDATE db.master_lunas_piutang.lpiutang_stat_dok = 'Batal'
				$sqlu = "UPDATE master_lunas_piutang
					SET lpiutang_stat_dok='Batal'
						,lpiutang_update='".@$_SESSION[SESSION_USERID]."'
						,lpiutang_date_update='".$datetime_now."'
						,lpiutang_revised=(lpiutang_revised+1)
					WHERE lpiutang_faktur='".$jpaket_nobukti."'";
				$this->db->query($sqlu);
				if($this->db->affected_rows()>-1){
					return 1;
				}else{
					return 1;
				}
			}else{
				return 1;
			}
			
		}
		
		function member_point_update($dpaket_master){
			$date_now=date('Y-m-d');
			$sql="SELECT jpaket_cust FROM master_jual_paket WHERE jpaket_id='$dpaket_master'";
			$rs=$this->db->query($sql);
			$record=$rs->row_array();
			$jpaket_cust=$record['jpaket_cust'];
			
			$sql="SELECT member_id FROM member WHERE member_cust='$jpaket_cust' AND (member_valid >= '$date_now')";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$sql="SELECT dpaket_jumlah
						,dpaket_harga
						,paket_point
						,dpaket_diskon
						,jpaket_diskon
						,jpaket_cashback
					FROM detail_jual_paket
					LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id)
					LEFT JOIN paket ON(dpaket_paket=paket_id)
					WHERE dpaket_master='$dpaket_master'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$one_record = $rs->row();
					$jpaket_cashback = $one_record->jpaket_cashback;
					$jpaket_diskon = $one_record->jpaket_diskon;
					$jumlah_rupiah_detail = 0;
					$jumlah_rupiah_total = 0;
					$jumlah_point = 0;
					foreach($rs->result() as $row){
						$dpaket_jumlah = $row->dpaket_jumlah;
						$dpaket_harga = $row->dpaket_harga;
						$dpaket_diskon = $row->dpaket_diskon;
						$paket_point = $row->paket_point;
						$jumlah_rupiah_detail += (($dpaket_jumlah * $dpaket_harga) * ((100 - $dpaket_diskon)/100)) * $paket_point;
					}
					if($jpaket_diskon>0){
						//memprioritaskan diskon_total_persen daripada diskon_total_cashback
						$jumlah_rupiah_total =  $jumlah_rupiah_detail * ((100 - $jpaket_diskon)/100);
					}else if($jpaket_diskon<=0 && $jpaket_cashback>0){
						$jumlah_rupiah_total = $jumlah_rupiah_detail - $jpaket_cashback;
					}else{
						$jumlah_rupiah_total = $jumlah_rupiah_detail;
					}
					
					//ambil dari db.member_setup
					$setmember_point_perrp = $this->get_point_per_rupiah();
					
					if($setmember_point_perrp>0){
						$jumlah_point = floor($jumlah_rupiah_total/$setmember_point_perrp);
					}
					$sql_cust_u="UPDATE customer SET cust_point = (cust_point + $jumlah_point) WHERE cust_id='$jpaket_cust'";
					$this->db->query($sql_cust_u);
					
					$dtu_jpaket=array(
					"jpaket_point"=>$jumlah_point
					);
					$this->db->where('jpaket_id', $dpaket_master);
					$this->db->update('master_jual_paket', $dtu_jpaket);
				}
			}
		}
		
		function member_point_delete($dpaket_master){
			$date_now=date('Y-m-d');
			
			$sql="SELECT jpaket_cust FROM master_jual_paket WHERE jpaket_id='$dpaket_master'";
			$rs=$this->db->query($sql);
			$record=$rs->row_array();
			$jpaket_cust=$record['jpaket_cust'];
			
			$sql="SELECT member_id FROM member WHERE member_cust='$jpaket_cust' AND (member_valid >= '$date_now')";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$sql="SELECT setmember_point_perrp FROM member_setup LIMIT 1";
				$rs=$this->db->query($sql);
				$record=$rs->row_array();
				$setmember_point_perrp=$record['setmember_point_perrp'];
				
				$sql="SELECT dpaket_jumlah, dpaket_harga, paket_point, dpaket_diskon, jpaket_diskon, jpaket_cashback FROM detail_jual_paket LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id) LEFT JOIN paket ON(dpaket_paket=paket_id) WHERE dpaket_master='$dpaket_master'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$one_record = $rs->row();
					$jpaket_cashback = $one_record->jpaket_cashback;
					$jpaket_diskon = $one_record->jpaket_diskon;
					$jumlah_rupiah = 0;
					$jumlah_point = 0;
					foreach($rs->result() as $row){
						//$jumlah_point += ($row->dpaket_jumlah) * ($row->paket_point) * (floor(($row->dpaket_harga)/$setmember_point_perrp));
						$jumlah_rupiah += ($row->dpaket_jumlah) * ($row->paket_point) * ($row->dpaket_harga) * ((100 - $row->dpaket_diskon)/100);
					}
					$jumlah_rupiah -= $jpaket_cashback;
					if($setmember_point_perrp<>0){
						$jumlah_point = floor($jumlah_rupiah/$setmember_point_perrp);
					}
					$sql="UPDATE customer SET cust_point = (cust_point - $jumlah_point) WHERE cust_id='$jpaket_cust'";
					$this->db->query($sql);
					return 1;
				}else{
					return 1;
				}
			}else{
				return 1;
			}
		}
		
		function member_point_batal($jpaket_id){
			$sql = "SELECT jpaket_point, jpaket_cust FROM master_jual_paket WHERE jpaket_id='$jpaket_id'";
			$rs = $this->db->query($sql);
			if($rs->num_rows()){
				$record = $rs->row_array();
				$jpaket_point = $record['jpaket_point'];
				$jpaket_cust = $record['jpaket_cust'];
				$sql="UPDATE customer SET cust_point = (cust_point - $jpaket_point) WHERE cust_id='$jpaket_cust'";
				$this->db->query($sql);
				if($this->db->affected_rows()>-1){
					return 1;
				}else{
					return 1;
				}
			}else{
				return 1;
			}
		}
		
		function cara_bayar_batal($jpaket_id){
			//updating db.jual_card ==> pembatalan
			$sqlu_jcard = "UPDATE jual_card JOIN master_jual_paket ON(jual_card.jcard_ref=master_jual_paket.jpaket_nobukti)
				SET jual_card.jcard_stat_dok = master_jual_paket.jpaket_stat_dok
				WHERE master_jual_paket.jpaket_id='$jpaket_id'";
			$this->db->query($sqlu_jcard);
			if($this->db->affected_rows()>-1){
				//updating db.jual_cek ==> pembatalan
				$sqlu_jcek = "UPDATE jual_cek JOIN master_jual_paket ON(jual_cek.jcek_ref=master_jual_paket.jpaket_nobukti)
					SET jual_cek.jcek_stat_dok = master_jual_paket.jpaket_stat_dok
					WHERE master_jual_paket.jpaket_id='$jpaket_id'";
				$this->db->query($sqlu_jcek);
				if($this->db->affected_rows()>-1){
					//updating db.jual_kwitansi ==> pembatalan
					$sqlu_jkwitansi = "UPDATE jual_kwitansi JOIN master_jual_paket ON(jual_kwitansi.jkwitansi_ref=master_jual_paket.jpaket_nobukti)
						SET jual_kwitansi.jkwitansi_stat_dok = master_jual_paket.jpaket_stat_dok
						WHERE master_jual_paket.jpaket_id='$jpaket_id'";
					$this->db->query($sqlu_jkwitansi);
					if($this->db->affected_rows()>-1){
						$sql = "SELECT jkwitansi_master
							FROM jual_kwitansi
							JOIN master_jual_paket ON(jkwitansi_ref=jpaket_nobukti)
							WHERE jpaket_id='".$jpaket_id."'";
						$rs = $this->db->query($sql);
						if($rs->num_rows()){
							$record = $rs->row_array();
							$jkwitansi_master = $record['jkwitansi_master'];
						}
						//updating sisa kwitansi
						$sqlu = "UPDATE cetak_kwitansi,
									(SELECT sum(jkwitansi_nilai) AS total_kwitansi
										,jkwitansi_master 
									FROM jual_kwitansi
									WHERE jkwitansi_master<>0
										AND jkwitansi_stat_dok<>'Batal'
										AND jkwitansi_master='".$jkwitansi_master."'
									GROUP BY jkwitansi_master) AS vu_kw
								SET kwitansi_sisa=(kwitansi_nilai - vu_kw.total_kwitansi)
								WHERE vu_kw.jkwitansi_master=kwitansi_id
									AND kwitansi_id='".$jkwitansi_master."'";
						$this->db->query($sqlu);
						
						//updating db.jual_transfer ==> pembatalan
						$sqlu_jtransfer = "UPDATE jual_transfer JOIN master_jual_paket ON(jual_transfer.jtransfer_ref=master_jual_paket.jpaket_nobukti)
							SET jual_transfer.jtransfer_stat_dok = master_jual_paket.jpaket_stat_dok
							WHERE master_jual_paket.jpaket_id='$jpaket_id'";
						$this->db->query($sqlu_jtransfer);
						if($this->db->affected_rows()>-1){
							//updating db.jual_tunai ==> pembatalan
							$sqlu_jtunai = "UPDATE jual_tunai JOIN master_jual_paket ON(jual_tunai.jtunai_ref=master_jual_paket.jpaket_nobukti)
								SET jual_tunai.jtunai_stat_dok = master_jual_paket.jpaket_stat_dok
								WHERE master_jual_paket.jpaket_id='$jpaket_id'";
							$this->db->query($sqlu_jtunai);
							if($this->db->affected_rows()>-1){
								//updating db.voucher_terima ==> pembatalan
								$sqlu_tvoucher = "UPDATE voucher_terima JOIN master_jual_paket ON(voucher_terima.tvoucher_ref=master_jual_paket.jpaket_nobukti)
									SET voucher_terima.tvoucher_stat_dok = master_jual_paket.jpaket_stat_dok
									WHERE master_jual_paket.jpaket_id='$jpaket_id'";
								$this->db->query($sqlu_tvoucher);
								if($this->db->affected_rows()>-1){
									return 1;
								}
							}
						}
					}
				}
			}
			
		}
		
		function membership_insert($jpaket_id){
			$date_now=date('Y-m-d');
			$this->db->where('membert_register <', $date_now);
			$this->db->delete('member_temp');
			
			$sql="SELECT setmember_transhari, setmember_periodeaktif, setmember_periodetenggang, setmember_transtenggang FROM member_setup LIMIT 1";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$min_trans_member_baru=$rs_record['setmember_transhari'];
				$periode_tenggang=$rs_record['setmember_periodetenggang'];
				$min_trans_tenggang=$rs_record['setmember_transtenggang'];
				$periode_aktif=$rs_record['setmember_periodeaktif'];
			}
			
			$sql="SELECT jpaket_cust FROM master_jual_paket WHERE jpaket_id='$jpaket_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$cust_id = $rs_record['jpaket_cust'];
				
				$jproduk_total_trans=0;
				$jpaket_total_trans=0;
				$jrawat_total_trans=0;
				$cust_total_trans_now=0;
				
				$trans_jproduk = "SELECT sum(jproduk_totalbiaya) AS jproduk_total_trans FROM master_jual_produk WHERE jproduk_cust='$cust_id' AND jproduk_tanggal='$date_now' AND jproduk_stat_dok='Tertutup' GROUP BY jproduk_cust";
				$rs_trans_jproduk=$this->db->query($trans_jproduk);
				if($rs_trans_jproduk->num_rows()){
					$rs_trans_jproduk_record=$rs_trans_jproduk->row_array();
					$jproduk_total_trans=$rs_trans_jproduk_record['jproduk_total_trans'];
				}
				
				$trans_jpaket = "SELECT sum(jpaket_totalbiaya) AS jpaket_total_trans FROM master_jual_paket WHERE jpaket_cust='$cust_id' AND jpaket_tanggal='$date_now' AND jpaket_stat_dok='Tertutup' GROUP BY jpaket_cust";
				$rs_trans_jpaket=$this->db->query($trans_jpaket);
				if($rs_trans_jpaket->num_rows()){
					$rs_trans_jpaket_record=$rs_trans_jpaket->row_array();
					$jpaket_total_trans=$rs_trans_jpaket_record['jpaket_total_trans'];
				}
				
				$trans_jrawat = "SELECT sum(jrawat_totalbiaya) AS jrawat_total_trans FROM master_jual_rawat WHERE jrawat_cust='$cust_id' AND jrawat_tanggal='$date_now' AND jrawat_stat_dok='Tertutup' GROUP BY jrawat_cust";
				$rs_trans_jrawat=$this->db->query($trans_jrawat);
				if($rs_trans_jrawat->num_rows()){
					$rs_trans_jrawat_record=$rs_trans_jrawat->row_array();
					$jrawat_total_trans=$rs_trans_jrawat_record['jrawat_total_trans'];
				}
				
				$cust_total_trans_now = $jproduk_total_trans + $jpaket_total_trans + $jrawat_total_trans;
				
				$sql="SELECT member_cust, member_valid, member_no FROM member WHERE member_cust='$cust_id'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					//* artinya: customer sudah menjadi MEMBER.
					//* untuk itu: check tanggal member_valid /
					$rs_record=$rs->row_array();
					$member_cust=$rs_record['member_cust'];
					$member_valid=$rs_record['member_valid'];
					$member_no=$rs_record['member_no'];
					
					$akhir_tenggang=date('Y-m-d', strtotime("$member_valid +$periode_tenggang days"));
					
					if(($member_valid < $date_now) && ($member_valid < $akhir_tenggang)){
						//* kartu member masuk masa tenggang /
						//* untuk itu: check total_transaksi si customer di hari ini /
						
						$set_member_valid = date('Y-m-d', strtotime("$date_now +$periode_aktif days"));
						
						if($cust_total_trans_now >= $min_trans_tenggang){
							//* Perpanjangan kartu member /
							$sql = "SELECT membert_id FROM member_temp WHERE membert_cust='$cust_id'";
							$rs = $this->db->query($sql);
							if(!($rs->num_rows())){
								$dti_membert=array(
								"membert_cust"=>$cust_id,
								"membert_no"=>$member_no,
								"membert_register"=>$date_now,
								"membert_valid"=>$set_member_valid,
								"membert_jenis"=>'perpanjangan',
								"membert_status"=>'Daftar'
								);
								$this->db->insert('member_temp', $dti_membert);
								if($this->db->affected_rows()>-1){
									return 1;
								}else{
									return 1;
								}
							}else{
								return 1;
							}
						}else{
							//* message: kartu member customer ini sementara tidak bisa digunakan, karena sudah masuk masa tenggang /
							//* deleting customer pada db.member_temp (yang mungkin sebelumnya dimasukkan), dikarenakan ada pembatalan transaksi sehingga $cust_total_trans_now tidak memenuhi syarat /
							$this->db->where('membert_cust', $cust_id);
							$this->db->delete('member_temp');
							if($this->db->affected_rows()>-1){
								return 1;
							}else{
								return 1;
							}
						}
					}else{
						//* check tanggal member_valid, apakah member_valid > $date_now ? /
						//* JIKA 'YA': kartu member customer ini masih Aktif ==> NO ACTION/
						//* JIKA 'TIDAK': kartu member sudah hangus ==> message: kartu member customer ini sudah tidak bisa digunakan lagi karena kartu sudah hangus.
						if($member_valid > $date_now){
							//* NO ACTION /
						}else{
							//* message: kartu member customer ini sudah tidak bisa digunakan lagi karena kartu sudah hangus.
						}
						return 1;
					}
				}else{
					//* artinya: customer belum pernah menjadi MEMBER (belum masuk ke db.member). /
					//* untuk itu: check total_transaksi si customer di hari ini dan bandingkan dengan db.member_setup.setmember_transhari /
					if($cust_total_trans_now >= $min_trans_member_baru){
						//* Pendaftaran MEMBER BARU /
						$set_member_valid = date('Y-m-d', strtotime("$date_now +$periode_aktif days"));
						
						$sql = "SELECT membert_id FROM member_temp WHERE membert_cust='$cust_id'";
						$rs = $this->db->query($sql);
						if(!($rs->num_rows())){
							$dti_membert=array(
							"membert_cust"=>$cust_id,
							"membert_register"=>$date_now,
							"membert_valid"=>$set_member_valid,
							"membert_jenis"=>'baru',
							"membert_status"=>'Daftar'
							);
							$this->db->insert('member_temp', $dti_membert);
							if($this->db->affected_rows()>-1){
								return 1;
							}else{
								return 1;
							}
						}else{
							return 1;
						}
					}else{
						//* Syarat menjadi MEMBER belum terpenuhi /
						//* deleting di db.member_temp (jika sebelumnya sudah diinsert), karena melakukan pembatalan transaksi sehingga total transaksi hari ini tidak memenuhi syarat menjadi member /
						$this->db->where('membert_cust', $cust_id);
						$this->db->delete('member_temp');
						if($this->db->affected_rows()>-1){
							return 1;
						}else{
							return 1;
						}
					}
				}
			}
		}
		
		//purge all detail from master
		function detail_detail_jual_paket_purge($master_id){
			$result_point_delete = $this->member_point_delete($master_id);
			if($result_point_delete==1){
				$sql="DELETE FROM detail_jual_paket WHERE dpaket_master='".$master_id."'";
				$result=$this->db->query($sql);
			}
			
		}
		//*eof
		
		function detail_pengguna_paket_purge($master_id){
			$sql="DELETE pengguna_paket
				FROM pengguna_paket LEFT JOIN master_jual_paket ON(ppaket_master=jpaket_id)
				WHERE ppaket_master='".$master_id."'
					AND ppaket_cust<>jpaket_cust";
			$result=$this->db->query($sql);
			return '1';
		}
		
		//insert detail record
		function detail_detail_jual_paket_insert($array_dpaket_id ,$dpaket_master ,$array_dpaket_paket, $array_dpaket_karyawan, $array_dpaket_kadaluarsa ,$array_dpaket_jumlah ,$array_dpaket_harga ,$array_dpaket_diskon ,$array_dpaket_diskon_jenis ,$array_dpaket_sales, $cetak){
			$datetime_now = date('Y-m-d H:i:s');
			//if master id not capture from view then capture it from max pk from master table
			if($dpaket_master=="" || $dpaket_master==NULL || $dpaket_master==0){
				$dpaket_master=$this->get_master_id();
			}
			
			$size_array = sizeof($array_dpaket_paket) - 1;
			
			for($i = 0; $i < sizeof($array_dpaket_paket); $i++){
				$dpaket_id = $array_dpaket_id[$i];
				$dpaket_paket = $array_dpaket_paket[$i];
				$dpaket_karyawan = $array_dpaket_karyawan[$i];
				$dpaket_kadaluarsa = $array_dpaket_kadaluarsa[$i];
				$dpaket_jumlah = $array_dpaket_jumlah[$i];
				$dpaket_harga = $array_dpaket_harga[$i];
				$dpaket_diskon = $array_dpaket_diskon[$i];
				$dpaket_diskon_jenis = $array_dpaket_diskon_jenis[$i];
				$dpaket_sales = $array_dpaket_sales[$i];
				
				if($dpaket_kadaluarsa==""){
					$dpaket_kadaluarsa=NULL;
				}
				
				$dpaket_sisa_paket=0;
				$rpaket_jumlah_total=0;
				$ipaket_jumlah_total=0;
				
				//* mendapatkan jumlah_total_perawatan dalam paket /
				$sql_rpaket="SELECT sum(rpaket_jumlah) AS rpaket_jumlah_total
					FROM paket_isi_perawatan
					WHERE rpaket_master='$dpaket_paket'
					ORDER BY rpaket_master";
				$rs_rpaket=$this->db->query($sql_rpaket);
				if($rs_rpaket->num_rows()){
					$rs_rpaket_record=$rs_rpaket->row_array();
					$rpaket_jumlah_total=$rs_rpaket_record["rpaket_jumlah_total"];
				}
				
				//* mendapatkan jumlah_total_produk dalam paket /
				$sql_ipaket="SELECT sum(ipaket_jumlah) AS ipaket_jumlah_total
					FROM paket_isi_produk
					WHERE ipaket_master='$dpaket_paket'
					ORDER BY ipaket_master";
				$rs_ipaket=$this->db->query($sql_ipaket);
				if($rs_ipaket->num_rows()){
					$rs_ipaket_record=$rs_ipaket->row_array();
					$ipaket_jumlah_total=$rs_ipaket_record["ipaket_jumlah_total"];
				}
				
				//* jumlah total yang masuk ke detail_jual_paket.dpaket_sisa_paket = jumlah paket yang dibeli * (jumlah isi paket) /
				$dpaket_sisa_paket=$dpaket_jumlah*($rpaket_jumlah_total+$ipaket_jumlah_total);
				
				//* checking $dpaket_id ==> apakah is_numeric AND sudah ada di db.detail_jual_paket.dpaket_id ?? /
				$sql = "SELECT dpaket_id FROM detail_jual_paket WHERE dpaket_id='".$dpaket_id."'";
				$rs = $this->db->query($sql);
				if($rs->num_rows()){
					$dpaket_revised=0;
					$sql = "SELECT dpaket_revised FROM detail_jual_paket WHERE dpaket_id=".$dpaket_id;
					$rs = $this->db->query($sql);
					if($rs->num_rows()){
						$record = $rs->row_array();
						$dpaket_revised = $record['dpaket_revised'];
					}
					//* detail ini sudah ada dalam db.detail_jual_paket ==> updating /
					//* checking lagi, apakah $dpaket_master(identik = db.master_jual_paket.jpaket_id) AND $dpaket_id sudah diambil ataukah belum di db.detail_ambil_paket,
					//* JIKA sudah pernah diambil ==> maka $dpaket_id ini tidak boleh dilakukan updating atau penghapusan /
					$sql = "SELECT dapaket_id FROM detail_ambil_paket WHERE dapaket_jpaket='$dpaket_master' AND dapaket_dpaket='$dpaket_id'";
					$rs = $this->db->query($sql);
					if($rs->num_rows()){
						//* artinya: isi paket sudah pernah diambil, sehingga tidak boleh di-edit ==> tidak ada action /
						if($cetak==1 && $i==$size_array){
							//* proses cetak /
							$this->master_jual_paket_status_update($dpaket_master);
							$this->member_point_update($dpaket_master);
							$this->membership_insert($dpaket_master);
							$this->catatan_piutang_update($dpaket_master);
							return $dpaket_master;
						}else if($cetak<>1 && $i==$size_array){
							return '0';
						}
					}else{
						//* artinya: isi paket belum pernah diambil, sehingga masih boleh di-edit /
						$dtu_dpaket = array(
							//"dpaket_master"=>$dpaket_master, 
							"dpaket_paket"=>$dpaket_paket,
							"dpaket_karyawan"=>$dpaket_karyawan,
							"dpaket_kadaluarsa"=>$dpaket_kadaluarsa, 
							"dpaket_jumlah"=>$dpaket_jumlah, 
							"dpaket_harga"=>$dpaket_harga, 
							"dpaket_diskon"=>$dpaket_diskon,
							"dpaket_diskon_jenis"=>$dpaket_diskon_jenis,
							"dpaket_sales"=>$dpaket_sales,
							"dpaket_sisa_paket"=>$dpaket_sisa_paket,
							"dpaket_update"=>@$_SESSION[SESSION_USERID],
							"dpaket_date_update"=>$datetime_now,
							"dpaket_revised"=>$dpaket_revised+1
						);
						$this->db->where('dpaket_id', $dpaket_id);
						$this->db->update('detail_jual_paket', $dtu_dpaket); 
						if($this->db->affected_rows()){
							if($cetak==1 && $i==$size_array){
								//* proses cetak /
								$this->master_jual_paket_status_update($dpaket_master);
								$this->member_point_update($dpaket_master);
								$this->membership_insert($dpaket_master);
								$this->catatan_piutang_update($dpaket_master);
								return $dpaket_master;
							}else if($cetak<>1 && $i==$size_array){
								return '0';
							}
						}else{
							//return '-1';
							if($cetak==1 && $i==$size_array){
								//* proses cetak /
								$this->master_jual_paket_status_update($dpaket_master);
								$this->member_point_update($dpaket_master);
								$this->membership_insert($dpaket_master);
								$this->catatan_piutang_update($dpaket_master);
								return $dpaket_master;
							}else if($cetak<>1 && $i==$size_array){
								return '0';
							}
						}
					}
				}else{
					//* Adding detail baru /
					$data = array(
						"dpaket_master"=>$dpaket_master, 
						"dpaket_paket"=>$dpaket_paket,
						"dpaket_karyawan"=>$dpaket_karyawan,
						"dpaket_kadaluarsa"=>$dpaket_kadaluarsa, 
						"dpaket_jumlah"=>$dpaket_jumlah, 
						"dpaket_harga"=>$dpaket_harga, 
						"dpaket_diskon"=>$dpaket_diskon,
						"dpaket_diskon_jenis"=>$dpaket_diskon_jenis,
						"dpaket_sales"=>$dpaket_sales,
						"dpaket_sisa_paket"=>$dpaket_sisa_paket,
						"dpaket_creator"=>@$_SESSION[SESSION_USERID]
					);
					$this->db->insert('detail_jual_paket', $data); 
					if($this->db->affected_rows()){
						if($cetak==1 && $i==$size_array){
							//* proses cetak /
							$this->master_jual_paket_status_update($dpaket_master);
							$this->member_point_update($dpaket_master);
							$this->membership_insert($dpaket_master);
							$this->catatan_piutang_update($dpaket_master);
							return $dpaket_master;
						}else if($cetak<>1 && $i==$size_array){
							return '0';
						}
					}else{
						//return '-1';
						if($cetak==1 && $i==$size_array){
							//* proses cetak /
							$this->master_jual_paket_status_update($dpaket_master);
							$this->member_point_update($dpaket_master);
							$this->membership_insert($dpaket_master);
							$this->catatan_piutang_update($dpaket_master);
							return $dpaket_master;
						}else if($cetak<>1 && $i==$size_array){
							return '0';
						}
					}
				}
				
			}
			
		}
		//end of function
		
		//function for get list record
		function master_jual_paket_list($filter,$start,$end){
			$date_now=date('Y-m-d');
		
			//backup: 2010-05-19 ==> $query = "SELECT jpaket_id, jpaket_nobukti, cust_nama, cust_no, cust_member, jpaket_cust, jpaket_tanggal, jpaket_diskon, jpaket_cashback, jpaket_cara, jpaket_cara2, jpaket_cara3, jpaket_bayar, IF(vu_jpaket.jpaket_totalbiaya!=0,vu_jpaket.jpaket_totalbiaya,vu_jpaket_totalbiaya.jpaket_totalbiaya) AS jpaket_totalbiaya, jpaket_keterangan, jpaket_stat_dok, jpaket_creator, jpaket_date_create, jpaket_update, jpaket_date_update, jpaket_revised FROM vu_jpaket LEFT JOIN vu_jpaket_totalbiaya ON(vu_jpaket_totalbiaya.dpaket_master=vu_jpaket.jpaket_id)";
			$query = "SELECT jpaket_id
					,jpaket_nobukti
					,cust_nama
					,cust_no
					,member_no
					,jpaket_cust
					,jpaket_tanggal
					,jpaket_diskon
					,jpaket_cashback
					,jpaket_cara
					,jpaket_cara2
					,jpaket_cara3
					,jpaket_bayar
					,IF(vu_jpaket.jpaket_totalbiaya!=0,vu_jpaket.jpaket_totalbiaya,vu_jpaket_totalbiaya.jpaket_totalbiaya) AS jpaket_totalbiaya
					,jpaket_keterangan
					,jpaket_stat_dok
					,jpaket_creator
					,jpaket_date_create
					,jpaket_update
					,jpaket_date_update
					,jpaket_revised
				FROM vu_jpaket
				LEFT JOIN vu_jpaket_totalbiaya ON(vu_jpaket_totalbiaya.dpaket_master=vu_jpaket.jpaket_id)";
			
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
		function master_jual_paket_update($jpaket_id
										  ,$jpaket_nobukti
										  ,$jpaket_cust
										  ,$jpaket_tanggal
										  ,$jpaket_stat_dok
										  ,$jpaket_diskon
										  ,$jpaket_cara
										  ,$jpaket_cara2
										  ,$jpaket_cara3
										  ,$jpaket_keterangan
										  ,$jpaket_cashback
										  ,$jpaket_tunai_nilai
										  ,$jpaket_tunai_nilai2
										  ,$jpaket_tunai_nilai3
										  ,$jpaket_voucher_no
										  ,$jpaket_voucher_cashback
										  ,$jpaket_voucher_no2
										  ,$jpaket_voucher_cashback2
										  ,$jpaket_voucher_no3
										  ,$jpaket_voucher_cashback3
										  ,$jpaket_bayar
										  ,$jpaket_subtotal
										  ,$jpaket_total
										  ,$jpaket_hutang
										  ,$jpaket_kwitansi_no
										  ,$jpaket_kwitansi_nama
										  ,$jpaket_kwitansi_nilai
										  ,$jpaket_kwitansi_no2
										  ,$jpaket_kwitansi_nama2
										  ,$jpaket_kwitansi_nilai2
										  ,$jpaket_kwitansi_no3
										  ,$jpaket_kwitansi_nama3
										  ,$jpaket_kwitansi_nilai3
										  ,$jpaket_card_nama
										  ,$jpaket_card_edc
										  ,$jpaket_card_no
										  ,$jpaket_card_nilai
										  ,$jpaket_card_nama2
										  ,$jpaket_card_edc2
										  ,$jpaket_card_no2
										  ,$jpaket_card_nilai2
										  ,$jpaket_card_nama3
										  ,$jpaket_card_edc3
										  ,$jpaket_card_no3
										  ,$jpaket_card_nilai3
										  ,$jpaket_cek_nama
										  ,$jpaket_cek_no
										  ,$jpaket_cek_valid
										  ,$jpaket_cek_bank
										  ,$jpaket_cek_nilai
										  ,$jpaket_cek_nama2
										  ,$jpaket_cek_no2
										  ,$jpaket_cek_valid2
										  ,$jpaket_cek_bank2
										  ,$jpaket_cek_nilai2
										  ,$jpaket_cek_nama3
										  ,$jpaket_cek_no3
										  ,$jpaket_cek_valid3
										  ,$jpaket_cek_bank3
										  ,$jpaket_cek_nilai3
										  ,$jpaket_transfer_bank
										  ,$jpaket_transfer_nama
										  ,$jpaket_transfer_nilai
										  ,$jpaket_transfer_bank2
										  ,$jpaket_transfer_nama2
										  ,$jpaket_transfer_nilai2
										  ,$jpaket_transfer_bank3
										  ,$jpaket_transfer_nama3
										  ,$jpaket_transfer_nilai3
										  ,$cetak){
			$date_now = date('Y-m-d');
			
			$jenis_transaksi = 'jual_paket';
			
			$datetime_now=date('Y-m-d H:i:s');
			if ($jpaket_stat_dok=="")
				$jpaket_stat_dok = "Terbuka";
			$jpaket_revised=0;
			
			$sql="SELECT jpaket_cara, jpaket_cara2, jpaket_cara3, jpaket_date_create, jpaket_revised FROM master_jual_paket WHERE jpaket_id='$jpaket_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$jpaket_revised=$rs_record["jpaket_revised"];
			}
			if($jpaket_diskon=="")
				$jpaket_diskon=0;
			$data = array(
				"jpaket_nobukti"=>$jpaket_nobukti, 
				"jpaket_tanggal"=>$jpaket_tanggal, 
				"jpaket_diskon"=>$jpaket_diskon,
				"jpaket_cashback"=>$jpaket_cashback,
				"jpaket_bayar"=>$jpaket_bayar,
				"jpaket_totalbiaya"=>$jpaket_total,
				"jpaket_cara"=>$jpaket_cara,
				"jpaket_keterangan"=>$jpaket_keterangan,
				"jpaket_stat_dok"=>$jpaket_stat_dok,
				"jpaket_update"=>@$_SESSION[SESSION_USERID],
				"jpaket_date_update"=>$datetime_now,
				"jpaket_revised"=>$jpaket_revised+1
			);
			if($jpaket_tanggal<>$date_now){
				$data["jpaket_date_update"] = $jpaket_tanggal;
				//$bayar_date_create = $jpaket_tanggal;
			}else{
				$data["jpaket_date_update"] = $datetime_now;
				//$bayar_date_create = $datetime_now;
			}
			if($jpaket_cara2!=null){
				if(($jpaket_kwitansi_nilai2<>'' && $jpaket_kwitansi_nilai2<>0)
				   || ($jpaket_card_nilai2<>'' && $jpaket_card_nilai2<>0)
				   || ($jpaket_cek_nilai2<>'' && $jpaket_cek_nilai2<>0)
				   || ($jpaket_transfer_nilai2<>'' && $jpaket_transfer_nilai2<>0)
				   || ($jpaket_tunai_nilai2<>'' && $jpaket_tunai_nilai2<>0)
				   || ($jpaket_voucher_cashback2<>'' && $jpaket_voucher_cashback2<>0)){
					$data["jpaket_cara2"]=$jpaket_cara2;
				}else{
					$data["jpaket_cara2"]=NULL;
				}
			}
			if($jpaket_cara3!=null){
				if(($jpaket_kwitansi_nilai3<>'' && $jpaket_kwitansi_nilai3<>0)
				   || ($jpaket_card_nilai3<>'' && $jpaket_card_nilai3<>0)
				   || ($jpaket_cek_nilai3<>'' && $jpaket_cek_nilai3<>0)
				   || ($jpaket_transfer_nilai3<>'' && $jpaket_transfer_nilai3<>0)
				   || ($jpaket_tunai_nilai3<>'' && $jpaket_tunai_nilai3<>0)
				   || ($jpaket_voucher_cashback3<>'' && $jpaket_voucher_cashback3<>0)){
					$data["jpaket_cara3"]=$jpaket_cara3;
				}
			}
			$sql="select cust_id from customer where cust_id='".$jpaket_cust."'";
			$query=$this->db->query($sql);
			if($query->num_rows())
				$data["jpaket_cust"]=$jpaket_cust;
			
			$this->db->where('jpaket_id', $jpaket_id);
			$this->db->update('master_jual_paket', $data);
			if($this->db->affected_rows()>-1){
				$time_now = date('H:i:s');
				$bayar_date_create_temp = $jpaket_tanggal.' '.$time_now;
				$bayar_date_create = date('Y-m-d H:i:s', strtotime($bayar_date_create_temp));
				
				//delete all transaksi
				$sql="delete from jual_kwitansi where jkwitansi_ref='".$jpaket_nobukti."'";
				$this->db->query($sql);
				if($this->db->affected_rows()>-1){
					$sql="delete from jual_card where jcard_ref='".$jpaket_nobukti."'";
					$this->db->query($sql);
					if($this->db->affected_rows()>-1){
						$sql="delete from jual_cek where jcek_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
						if($this->db->affected_rows()>-1){
							$sql="delete from jual_transfer where jtransfer_ref='".$jpaket_nobukti."'";
							$this->db->query($sql);
							if($this->db->affected_rows()>-1){
								$sql="delete from jual_tunai where jtunai_ref='".$jpaket_nobukti."'";
								$this->db->query($sql);
								if($this->db->affected_rows()>-1){
									$sql="delete from voucher_terima where tvoucher_ref='".$jpaket_nobukti."'";
									$this->db->query($sql);
									if($this->db->affected_rows()>-1){
										if($jpaket_cara!=null || $jpaket_cara!=''){
											if($jpaket_kwitansi_nilai<>'' && $jpaket_kwitansi_nilai<>0){
												$result_bayar = $this->m_public_function->cara_bayar_kwitansi_insert($jpaket_kwitansi_no
																								  ,$jpaket_kwitansi_nilai
																								  ,$jpaket_nobukti
																								  ,$bayar_date_create
																								  ,$jenis_transaksi
																								  ,$cetak);
												
											}elseif($jpaket_card_nilai<>'' && $jpaket_card_nilai<>0){
												$result_bayar = $this->m_public_function->cara_bayar_card_insert($jpaket_card_nama
																							  ,$jpaket_card_edc
																							  ,$jpaket_card_no
																							  ,$jpaket_card_nilai
																							  ,$jpaket_nobukti
																							  ,$bayar_date_create
																							  ,$jenis_transaksi
																							  ,$cetak);
											}elseif($jpaket_cek_nilai<>'' && $jpaket_cek_nilai<>0){
												$result_bayar = $this->m_public_function->cara_bayar_cek_insert($jpaket_cek_nama
																							 ,$jpaket_cek_no
																							 ,$jpaket_cek_valid
																							 ,$jpaket_cek_bank
																							 ,$jpaket_cek_nilai
																							 ,$jpaket_nobukti
																							 ,$bayar_date_create
																							 ,$jenis_transaksi
																							 ,$cetak);
											}elseif($jpaket_transfer_nilai<>'' && $jpaket_transfer_nilai<>0){
												$result_bayar = $this->m_public_function->cara_bayar_transfer_insert($jpaket_transfer_bank
																								  ,$jpaket_transfer_nama
																								  ,$jpaket_transfer_nilai
																								  ,$jpaket_nobukti
																								  ,$bayar_date_create
																								  ,$jenis_transaksi
																								  ,$cetak);
											}elseif($jpaket_tunai_nilai<>'' && $jpaket_tunai_nilai<>0){
												$result_bayar = $this->m_public_function->cara_bayar_tunai_insert($jpaket_tunai_nilai
																							   ,$jpaket_nobukti
																							   ,$bayar_date_create
																							   ,$jenis_transaksi
																							   ,$cetak);
											}elseif($jpaket_voucher_cashback<>'' && $jpaket_voucher_cashback<>0){
												$result_bayar = $this->m_public_function->cara_bayar_voucher_insert($jpaket_voucher_no
																								 ,$jpaket_nobukti
																								 ,$jpaket_voucher_cashback
																								 ,$bayar_date_create
																								 ,$jenis_transaksi
																								 ,$cetak);
											}
										}
										if($jpaket_cara2!=null || $jpaket_cara2!=''){
											if($jpaket_kwitansi_nilai2<>'' && $jpaket_kwitansi_nilai2<>0){
												$result_bayar2 = $this->m_public_function->cara_bayar_kwitansi_insert($jpaket_kwitansi_no2
																								  ,$jpaket_kwitansi_nilai2
																								  ,$jpaket_nobukti
																								  ,$bayar_date_create
																								  ,$jenis_transaksi
																								  ,$cetak);
												
											}elseif($jpaket_card_nilai2<>'' && $jpaket_card_nilai2<>0){
												$result_bayar2 = $this->m_public_function->cara_bayar_card_insert($jpaket_card_nama2
																							  ,$jpaket_card_edc2
																							  ,$jpaket_card_no2
																							  ,$jpaket_card_nilai2
																							  ,$jpaket_nobukti
																							  ,$bayar_date_create
																							  ,$jenis_transaksi
																							  ,$cetak);
											}elseif($jpaket_cek_nilai2<>'' && $jpaket_cek_nilai2<>0){
												$result_bayar2 = $this->m_public_function->cara_bayar_cek_insert($jpaket_cek_nama2
																							 ,$jpaket_cek_no2
																							 ,$jpaket_cek_valid2
																							 ,$jpaket_cek_bank2
																							 ,$jpaket_cek_nilai2
																							 ,$jpaket_nobukti
																							 ,$bayar_date_create
																							 ,$jenis_transaksi
																							 ,$cetak);
											}elseif($jpaket_transfer_nilai2<>'' && $jpaket_transfer_nilai2<>0){
												$result_bayar2 = $this->m_public_function->cara_bayar_transfer_insert($jpaket_transfer_bank2
																								  ,$jpaket_transfer_nama2
																								  ,$jpaket_transfer_nilai2
																								  ,$jpaket_nobukti
																								  ,$bayar_date_create
																								  ,$jenis_transaksi
																								  ,$cetak);
											}elseif($jpaket_tunai_nilai2<>'' && $jpaket_tunai_nilai2<>0){
												$result_bayar2 = $this->m_public_function->cara_bayar_tunai_insert($jpaket_tunai_nilai2
																							   ,$jpaket_nobukti
																							   ,$bayar_date_create
																							   ,$jenis_transaksi
																							   ,$cetak);
											}elseif($jpaket_voucher_cashback2<>'' && $jpaket_voucher_cashback2<>0){
												$result_bayar2 = $this->m_public_function->cara_bayar_voucher_insert($jpaket_voucher_no2
																								 ,$jpaket_nobukti
																								 ,$jpaket_voucher_cashback2
																								 ,$bayar_date_create
																								 ,$jenis_transaksi
																								 ,$cetak);
											}
										}
										if($jpaket_cara3!=null || $jpaket_cara3!=''){
											if($jpaket_kwitansi_nilai3<>'' && $jpaket_kwitansi_nilai3<>0){
												$result_bayar3 = $this->m_public_function->cara_bayar_kwitansi_insert($jpaket_kwitansi_no3
																								  ,$jpaket_kwitansi_nilai3
																								  ,$jpaket_nobukti
																								  ,$bayar_date_create
																								  ,$jenis_transaksi
																								  ,$cetak);
												
											}elseif($jpaket_card_nilai3<>'' && $jpaket_card_nilai3<>0){
												$result_bayar3 = $this->m_public_function->cara_bayar_card_insert($jpaket_card_nama3
																							  ,$jpaket_card_edc3
																							  ,$jpaket_card_no3
																							  ,$jpaket_card_nilai3
																							  ,$jpaket_nobukti
																							  ,$bayar_date_create
																							  ,$jenis_transaksi
																							  ,$cetak);
											}elseif($jpaket_cek_nilai3<>'' && $jpaket_cek_nilai3<>0){
												$result_bayar3 = $this->m_public_function->cara_bayar_cek_insert($jpaket_cek_nama3
																							 ,$jpaket_cek_no3
																							 ,$jpaket_cek_valid3
																							 ,$jpaket_cek_bank3
																							 ,$jpaket_cek_nilai3
																							 ,$jpaket_nobukti
																							 ,$bayar_date_create
																							 ,$jenis_transaksi
																							 ,$cetak);
											}elseif($jpaket_transfer_nilai3<>'' && $jpaket_transfer_nilai3<>0){
												$result_bayar3 = $this->m_public_function->cara_bayar_transfer_insert($jpaket_transfer_bank3
																								  ,$jpaket_transfer_nama3
																								  ,$jpaket_transfer_nilai3
																								  ,$jpaket_nobukti
																								  ,$bayar_date_create
																								  ,$jenis_transaksi
																								  ,$cetak);
											}elseif($jpaket_tunai_nilai3<>'' && $jpaket_tunai_nilai3<>0){
												$result_bayar3 = $this->m_public_function->cara_bayar_tunai_insert($jpaket_tunai_nilai3
																							   ,$jpaket_nobukti
																							   ,$bayar_date_create
																							   ,$jenis_transaksi
																							   ,$cetak);
											}elseif($jpaket_voucher_cashback3<>'' && $jpaket_voucher_cashback3<>0){
												$result_bayar3 = $this->m_public_function->cara_bayar_voucher_insert($jpaket_voucher_no3
																								 ,$jpaket_nobukti
																								 ,$jpaket_voucher_cashback3
																								 ,$bayar_date_create
																								 ,$jenis_transaksi
																								 ,$cetak);
											}
										}
									}
								}
							}
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
		function master_jual_paket_create($jpaket_nobukti ,$jpaket_cust ,$jpaket_tanggal ,$jpaket_diskon ,$jpaket_stat_dok, $jpaket_cara ,$jpaket_cara2 ,$jpaket_cara3 ,$jpaket_keterangan , $jpaket_cashback, $jpaket_tunai_nilai, $jpaket_tunai_nilai2, $jpaket_tunai_nilai3, $jpaket_voucher_no, $jpaket_voucher_cashback, $jpaket_voucher_no2, $jpaket_voucher_cashback2, $jpaket_voucher_no3, $jpaket_voucher_cashback3, $jpaket_bayar, $jpaket_subtotal, $jpaket_total, $jpaket_hutang, $jpaket_kwitansi_no, $jpaket_kwitansi_nama, $jpaket_kwitansi_nilai, $jpaket_kwitansi_no2, $jpaket_kwitansi_nama2, $jpaket_kwitansi_nilai2, $jpaket_kwitansi_no3, $jpaket_kwitansi_nama3, $jpaket_kwitansi_nilai3, $jpaket_card_nama, $jpaket_card_edc, $jpaket_card_no, $jpaket_card_nilai, $jpaket_card_nama2, $jpaket_card_edc2, $jpaket_card_no2, $jpaket_card_nilai2, $jpaket_card_nama3, $jpaket_card_edc3, $jpaket_card_no3, $jpaket_card_nilai3, $jpaket_cek_nama, $jpaket_cek_no, $jpaket_cek_valid, $jpaket_cek_bank, $jpaket_cek_nilai, $jpaket_cek_nama2, $jpaket_cek_no2, $jpaket_cek_valid2, $jpaket_cek_bank2, $jpaket_cek_nilai2, $jpaket_cek_nama3, $jpaket_cek_no3, $jpaket_cek_valid3, $jpaket_cek_bank3, $jpaket_cek_nilai3, $jpaket_transfer_bank, $jpaket_transfer_nama, $jpaket_transfer_nilai, $jpaket_transfer_bank2, $jpaket_transfer_nama2, $jpaket_transfer_nilai2, $jpaket_transfer_bank3, $jpaket_transfer_nama3, $jpaket_transfer_nilai3, $cetak){
			$date_now = date('Y-m-d');
			
			$jenis_transaksi = 'jual_paket';
			
			$jpaket_tanggal_pattern=strtotime($jpaket_tanggal);
			$pattern="PK/".date("ym",$jpaket_tanggal_pattern)."-";
			//$pattern="PK/".date("ym")."-";
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
				"jpaket_keterangan"=>$jpaket_keterangan,
				"jpaket_stat_dok"=>$jpaket_stat_dok,
				"jpaket_creator"=>$_SESSION[SESSION_USERID]
			);
			if($jpaket_tanggal<>$date_now){
				$data["jpaket_date_create"] = $jpaket_tanggal;
			}
			if($jpaket_cara2!=null){
				if(($jpaket_kwitansi_nilai2<>'' && $jpaket_kwitansi_nilai2<>0)
				   || ($jpaket_card_nilai2<>'' && $jpaket_card_nilai2<>0)
				   || ($jpaket_cek_nilai2<>'' && $jpaket_cek_nilai2<>0)
				   || ($jpaket_transfer_nilai2<>'' && $jpaket_transfer_nilai2<>0)
				   || ($jpaket_tunai_nilai2<>'' && $jpaket_tunai_nilai2<>0)
				   || ($jpaket_voucher_cashback2<>'' && $jpaket_voucher_cashback2<>0)){
					$data["jpaket_cara2"]=$jpaket_cara2;
				}else{
					$data["jpaket_cara2"]=NULL;
				}
			}
			if($jpaket_cara3!=null){
				if(($jpaket_kwitansi_nilai3<>'' && $jpaket_kwitansi_nilai3<>0)
				   || ($jpaket_card_nilai3<>'' && $jpaket_card_nilai3<>0)
				   || ($jpaket_cek_nilai3<>'' && $jpaket_cek_nilai3<>0)
				   || ($jpaket_transfer_nilai3<>'' && $jpaket_transfer_nilai3<>0)
				   || ($jpaket_tunai_nilai3<>'' && $jpaket_tunai_nilai3<>0)
				   || ($jpaket_voucher_cashback3<>'' && $jpaket_voucher_cashback3<>0)){
					$data["jpaket_cara3"]=$jpaket_cara3;
				}
			}
			$this->db->insert('master_jual_paket', $data); 
			if($this->db->affected_rows()){
				$time_now = date('H:i:s');
				$bayar_date_create_temp = $jpaket_tanggal.' '.$time_now;
				$bayar_date_create = date('Y-m-d H:i:s', strtotime($bayar_date_create_temp));
				
				//delete all transaksi
				$sql="delete from jual_kwitansi where jkwitansi_ref='".$jpaket_nobukti."'";
				$this->db->query($sql);
				if($this->db->affected_rows()>-1){
					$sql="delete from jual_card where jcard_ref='".$jpaket_nobukti."'";
					$this->db->query($sql);
					if($this->db->affected_rows()>-1){
						$sql="delete from jual_cek where jcek_ref='".$jpaket_nobukti."'";
						$this->db->query($sql);
						if($this->db->affected_rows()>-1){
							$sql="delete from jual_transfer where jtransfer_ref='".$jpaket_nobukti."'";
							$this->db->query($sql);
							if($this->db->affected_rows()>-1){
								$sql="delete from jual_tunai where jtunai_ref='".$jpaket_nobukti."'";
								$this->db->query($sql);
								if($this->db->affected_rows()>-1){
									$sql="delete from voucher_terima where tvoucher_ref='".$jpaket_nobukti."'";
									$this->db->query($sql);
									if($this->db->affected_rows()>-1){
										if($jpaket_cara!=null || $jpaket_cara!=''){
											if($jpaket_kwitansi_nilai<>'' && $jpaket_kwitansi_nilai<>0){
												$result_bayar = $this->m_public_function->cara_bayar_kwitansi_insert($jpaket_kwitansi_no
																								  ,$jpaket_kwitansi_nilai
																								  ,$jpaket_nobukti
																								  ,$bayar_date_create
																								  ,$jenis_transaksi
																								  ,$cetak);
												
											}elseif($jpaket_card_nilai<>'' && $jpaket_card_nilai<>0){
												$result_bayar = $this->m_public_function->cara_bayar_card_insert($jpaket_card_nama
																							  ,$jpaket_card_edc
																							  ,$jpaket_card_no
																							  ,$jpaket_card_nilai
																							  ,$jpaket_nobukti
																							  ,$bayar_date_create
																							  ,$jenis_transaksi
																							  ,$cetak);
											}elseif($jpaket_cek_nilai<>'' && $jpaket_cek_nilai<>0){
												$result_bayar = $this->m_public_function->cara_bayar_cek_insert($jpaket_cek_nama
																							 ,$jpaket_cek_no
																							 ,$jpaket_cek_valid
																							 ,$jpaket_cek_bank
																							 ,$jpaket_cek_nilai
																							 ,$jpaket_nobukti
																							 ,$bayar_date_create
																							 ,$jenis_transaksi
																							 ,$cetak);
											}elseif($jpaket_transfer_nilai<>'' && $jpaket_transfer_nilai<>0){
												$result_bayar = $this->m_public_function->cara_bayar_transfer_insert($jpaket_transfer_bank
																								  ,$jpaket_transfer_nama
																								  ,$jpaket_transfer_nilai
																								  ,$jpaket_nobukti
																								  ,$bayar_date_create
																								  ,$jenis_transaksi
																								  ,$cetak);
											}elseif($jpaket_tunai_nilai<>'' && $jpaket_tunai_nilai<>0){
												$result_bayar = $this->m_public_function->cara_bayar_tunai_insert($jpaket_tunai_nilai
																							   ,$jpaket_nobukti
																							   ,$bayar_date_create
																							   ,$jenis_transaksi
																							   ,$cetak);
											}elseif($jpaket_voucher_cashback<>'' && $jpaket_voucher_cashback<>0){
												$result_bayar = $this->m_public_function->cara_bayar_voucher_insert($jpaket_voucher_no
																								 ,$jpaket_nobukti
																								 ,$jpaket_voucher_cashback
																								 ,$bayar_date_create
																								 ,$jenis_transaksi
																								 ,$cetak);
											}
										}
										if($jpaket_cara2!=null || $jpaket_cara2!=''){
											if($jpaket_kwitansi_nilai2<>'' && $jpaket_kwitansi_nilai2<>0){
												$result_bayar2 = $this->m_public_function->cara_bayar_kwitansi_insert($jpaket_kwitansi_no2
																								  ,$jpaket_kwitansi_nilai2
																								  ,$jpaket_nobukti
																								  ,$bayar_date_create
																								  ,$jenis_transaksi
																								  ,$cetak);
												
											}elseif($jpaket_card_nilai2<>'' && $jpaket_card_nilai2<>0){
												$result_bayar2 = $this->m_public_function->cara_bayar_card_insert($jpaket_card_nama2
																							  ,$jpaket_card_edc2
																							  ,$jpaket_card_no2
																							  ,$jpaket_card_nilai2
																							  ,$jpaket_nobukti
																							  ,$bayar_date_create
																							  ,$jenis_transaksi
																							  ,$cetak);
											}elseif($jpaket_cek_nilai2<>'' && $jpaket_cek_nilai2<>0){
												$result_bayar2 = $this->m_public_function->cara_bayar_cek_insert($jpaket_cek_nama2
																							 ,$jpaket_cek_no2
																							 ,$jpaket_cek_valid2
																							 ,$jpaket_cek_bank2
																							 ,$jpaket_cek_nilai2
																							 ,$jpaket_nobukti
																							 ,$bayar_date_create
																							 ,$jenis_transaksi
																							 ,$cetak);
											}elseif($jpaket_transfer_nilai2<>'' && $jpaket_transfer_nilai2<>0){
												$result_bayar2 = $this->m_public_function->cara_bayar_transfer_insert($jpaket_transfer_bank2
																								  ,$jpaket_transfer_nama2
																								  ,$jpaket_transfer_nilai2
																								  ,$jpaket_nobukti
																								  ,$bayar_date_create
																								  ,$jenis_transaksi
																								  ,$cetak);
											}elseif($jpaket_tunai_nilai2<>'' && $jpaket_tunai_nilai2<>0){
												$result_bayar2 = $this->m_public_function->cara_bayar_tunai_insert($jpaket_tunai_nilai2
																							   ,$jpaket_nobukti
																							   ,$bayar_date_create
																							   ,$jenis_transaksi
																							   ,$cetak);
											}elseif($jpaket_voucher_cashback2<>'' && $jpaket_voucher_cashback2<>0){
												$result_bayar2 = $this->m_public_function->cara_bayar_voucher_insert($jpaket_voucher_no2
																								 ,$jpaket_nobukti
																								 ,$jpaket_voucher_cashback2
																								 ,$bayar_date_create
																								 ,$jenis_transaksi
																								 ,$cetak);
											}
										}
										if($jpaket_cara3!=null || $jpaket_cara3!=''){
											if($jpaket_kwitansi_nilai3<>'' && $jpaket_kwitansi_nilai3<>0){
												$result_bayar3 = $this->m_public_function->cara_bayar_kwitansi_insert($jpaket_kwitansi_no3
																								  ,$jpaket_kwitansi_nilai3
																								  ,$jpaket_nobukti
																								  ,$bayar_date_create
																								  ,$jenis_transaksi
																								  ,$cetak);
												
											}elseif($jpaket_card_nilai3<>'' && $jpaket_card_nilai3<>0){
												$result_bayar3 = $this->m_public_function->cara_bayar_card_insert($jpaket_card_nama3
																							  ,$jpaket_card_edc3
																							  ,$jpaket_card_no3
																							  ,$jpaket_card_nilai3
																							  ,$jpaket_nobukti
																							  ,$bayar_date_create
																							  ,$jenis_transaksi
																							  ,$cetak);
											}elseif($jpaket_cek_nilai3<>'' && $jpaket_cek_nilai3<>0){
												$result_bayar3 = $this->m_public_function->cara_bayar_cek_insert($jpaket_cek_nama3
																							 ,$jpaket_cek_no3
																							 ,$jpaket_cek_valid3
																							 ,$jpaket_cek_bank3
																							 ,$jpaket_cek_nilai3
																							 ,$jpaket_nobukti
																							 ,$bayar_date_create
																							 ,$jenis_transaksi
																							 ,$cetak);
											}elseif($jpaket_transfer_nilai3<>'' && $jpaket_transfer_nilai3<>0){
												$result_bayar3 = $this->m_public_function->cara_bayar_transfer_insert($jpaket_transfer_bank3
																								  ,$jpaket_transfer_nama3
																								  ,$jpaket_transfer_nilai3
																								  ,$jpaket_nobukti
																								  ,$bayar_date_create
																								  ,$jenis_transaksi
																								  ,$cetak);
											}elseif($jpaket_tunai_nilai3<>'' && $jpaket_tunai_nilai3<>0){
												$result_bayar3 = $this->m_public_function->cara_bayar_tunai_insert($jpaket_tunai_nilai3
																							   ,$jpaket_nobukti
																							   ,$bayar_date_create
																							   ,$jenis_transaksi
																							   ,$cetak);
											}elseif($jpaket_voucher_cashback3<>'' && $jpaket_voucher_cashback3<>0){
												$result_bayar3 = $this->m_public_function->cara_bayar_voucher_insert($jpaket_voucher_no3
																								 ,$jpaket_nobukti
																								 ,$jpaket_voucher_cashback3
																								 ,$bayar_date_create
																								 ,$jenis_transaksi
																								 ,$cetak);
											}
										}
									}
								}
							}
						}
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
		
		//Delete detail_jual_paket
        function detail_jual_paket_delete($dpaket_id){
            $date_now = date('Y-m-d');
			$datetime_now = date('Y-m-d H:i:s');
			$sql = "SELECT dapaket_id FROM detail_ambil_paket WHERE dapaket_dpaket='$dpaket_id'";
			$rs = $this->db->query($sql);
			if($rs->num_rows()){
				//* artinya: Customer sudah pernah mengambil perawatan di paket ini. Sehingga tidak boleh di-Batal-kan. /
				return '0';
			}else{
				//* artinya: Customer belum pernah ambil perawatan di paket ini. Sehingga masih boleh di-delete /
				$query = "DELETE FROM detail_jual_paket WHERE dpaket_id = ".$dpaket_id;
				$this->db->query($query);
				if($this->db->affected_rows()>0)
					return '1';
				else
					return '-1';
			}
			
		}
		
		function master_jual_paket_batal($jpaket_id, $jpaket_tanggal){
			$date = date('Y-m-d');
			$date_1 = '01';
			$date_2 = '02';
			$date_3 = '03';
			$month = substr($jpaket_tanggal,5,2);
			$year = substr($jpaket_tanggal,0,4);
			$begin=mktime(0,0,0,$month,1,$year);
			$nextmonth=strtotime("+1month",$begin);
			
			$month_next = substr(date("Y-m-d",$nextmonth),5,2);
			$year_next = substr(date("Y-m-d",$nextmonth),0,4);
			
			$tanggal_1 = $year_next.'-'.$month_next.'-'.$date_1;
			$tanggal_2 = $year_next.'-'.$month_next.'-'.$date_2;
			$tanggal_3 = $year_next.'-'.$month_next.'-'.$date_3;
			
			
			//$date_now = date('Y-m-d');
			$datetime_now = date('Y-m-d H:i:s');
			//$sql = "SELECT dapaket_id FROM detail_ambil_paket WHERE dapaket_jpaket='$jpaket_id'";
			$sql = "SELECT dapaket_id FROM detail_ambil_paket WHERE dapaket_jpaket='$jpaket_id' AND dapaket_stat_dok<>'Batal'";
			$rs = $this->db->query($sql);
			if($rs->num_rows()){
				//* artinya: Customer sudah pernah mengambil paket pada Faktur ini. Sehingga tidak boleh di-Batal-kan. /
				return '0';
			}else{
				//* artinya: Customer belum pernah ambil paket pada Faktur ini. Sehingga masih boleh di-Batal-kan /
				$sql = "UPDATE master_jual_paket
					SET jpaket_stat_dok='Batal'
						,jpaket_update='".@$_SESSION[SESSION_USERID]."'
						,jpaket_date_update='".$datetime_now."'
						,jpaket_revised=jpaket_revised+1
					WHERE jpaket_id='".$jpaket_id."' " ;
						
						 //AND ('".$date."'<='".$tanggal_3."' OR  jpaket_tanggal='".$date."')";
						
				$this->db->query($sql);
				if($this->db->affected_rows()>0){
					//* udpating db.customer.cust_point ==> proses mengurangi jumlah poin (dikurangi dengan db.master_jual_paket.jpaket_point yg sudah dimasukkan ketika cetak faktur), karena dilakukan pembatalan /
					$result_point_batal = $this->member_point_batal($jpaket_id);
					if($result_point_batal==1){
						$result_membership = $this->membership_insert($jpaket_id);
						if($result_membership==1){
							$result_piutang = $this->catatan_piutang_batal($jpaket_id);
							if($result_piutang==1){
								$result_cara_bayar = $this->cara_bayar_batal($jpaket_id);
								if($result_cara_bayar==1){
									return '1';
								}
							}
						}
					}
				}else
					return '-1';
			}
			
		}
		
		//function for advanced search record
		function master_jual_paket_search($jpaket_id ,$jpaket_nobukti ,$jpaket_cust ,$jpaket_tanggal, $jpaket_tanggal_akhir, $jpaket_diskon ,$jpaket_cashback ,$jpaket_voucher ,$jpaket_cara ,$jpaket_bayar , $jpaket_keterangan, $jpaket_stat_dok, $start, $end){
			//full query
			/*$query="SELECT * FROM master_jual_paket,customer,member
					WHERE jpaket_cust=cust_id and member_id = cust_member";*/
					
			$query = "SELECT jpaket_id
					,jpaket_nobukti
					,cust_nama
					,cust_no
					,member_no
					,jpaket_cust
					,jpaket_tanggal
					,jpaket_diskon
					,jpaket_cashback
					,jpaket_cara
					,jpaket_cara2
					,jpaket_cara3
					,jpaket_bayar
					,IF(vu_jpaket.jpaket_totalbiaya!=0,vu_jpaket.jpaket_totalbiaya,vu_jpaket_totalbiaya.jpaket_totalbiaya) AS jpaket_totalbiaya
					,jpaket_keterangan
					,jpaket_stat_dok
					,jpaket_creator
					,jpaket_date_create
					,jpaket_update
					,jpaket_date_update
					,jpaket_revised
				FROM vu_jpaket
				LEFT JOIN vu_jpaket_totalbiaya ON(vu_jpaket_totalbiaya.dpaket_master=vu_jpaket.jpaket_id)";
			
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
				$query.= " jpaket_cust = '".$jpaket_cust."'";
			};
			if($jpaket_tanggal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpaket_tanggal>= '".$jpaket_tanggal."'";
			};
			if($jpaket_tanggal_akhir!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpaket_tanggal<= '".$jpaket_tanggal_akhir."'";
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
			if($jpaket_stat_dok!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpaket_stat_dok LIKE '%".$jpaket_stat_dok."%'";
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
		
		function master_jual_paket_status_update($jpaket_id){
			$date_now = date('Y-m-d');
			$datetime_now=date('Y-m-d H:i:s');
			//* status dokumen menjadi tertutup setelah Faktur selesai di-cetak /
			$sql = "SELECT jpaket_tanggal FROM master_jual_paket WHERE jpaket_id='".$jpaket_id."'";
			$rs = $this->db->query($sql);
			if($rs->num_rows()){
				$record = $rs->row_array();
				$jpaket_tanggal = $record['jpaket_tanggal'];
				if($jpaket_tanggal<>$date_now){
					$jpaket_date_update = $jpaket_tanggal;
				}else{
					$jpaket_date_update = $datetime_now;
				}
				
				$sql="UPDATE master_jual_paket
					SET jpaket_stat_dok='Tertutup'
						,jpaket_update='".@$_SESSION[SESSION_USERID]."'
						,jpaket_date_update='".$jpaket_date_update."'
						,jpaket_revised=jpaket_revised+1
					WHERE jpaket_id='$jpaket_id'";
				$this->db->query($sql);
			}
		}
		
		function print_paper($jpaket_id){
			//$this->master_jual_paket_status_update($jpaket_id);
			$sql="SELECT jpaket_tanggal, cust_no, cust_nama, cust_alamat, jpaket_nobukti, paket_nama, dpaket_jumlah, dpaket_harga, dpaket_diskon, (dpaket_harga*((100-dpaket_diskon)/100)) AS jumlah_subtotal, jpaket_creator, jpaket_diskon, jpaket_cashback FROM detail_jual_paket LEFT JOIN master_jual_paket ON(dpaket_master=jpaket_id) LEFT JOIN customer ON(jpaket_cust=cust_id) LEFT JOIN paket ON(dpaket_paket=paket_id) WHERE jpaket_id='$jpaket_id'";
			$result = $this->db->query($sql);
			return $result;
		}
		
		function get_cara_bayar($jpaket_id){
			$sql="SELECT jpaket_nobukti, jpaket_cara FROM master_jual_paket WHERE jpaket_id='$jpaket_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$record=$rs->row_array();
				$sql = "SELECT cek ,card ,kuitansi ,transfer ,tunai FROM vu_trans_paket WHERE no_bukti='".$record['jpaket_nobukti']."'";
				$rs = $this->db->query($sql);
				if($rs->num_rows()){
					return $rs->result();
				}else{
					return '';
				}
			}else{
				return '';
			}
			
		}
		
		function cara_bayar($jpaket_id){
			$sql="SELECT jpaket_nobukti, jpaket_cara FROM master_jual_paket WHERE jpaket_id='$jpaket_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$record=$rs->row();
				$jpaket_nobukti = $record->jpaket_nobukti;
				if(($record->jpaket_cara !== NULL || $record->jpaket_cara !== '')){
					if($record->jpaket_cara == 'tunai'){
						$sql = "SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='".$jpaket_nobukti."'";
						$rs = $this->db->query($sql);
						if($rs->num_rows()==1){
							$sql="SELECT jpaket_nobukti, jpaket_cara, jtunai_nilai AS bayar_nilai FROM master_jual_paket LEFT JOIN jual_tunai ON(jtunai_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}else if($rs->num_rows()==2){
							$sql="SELECT jpaket_nobukti, jpaket_cara, jtunai_nilai AS bayar_nilai FROM master_jual_paket LEFT JOIN jual_tunai ON(jtunai_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id' LIMIT 0,1";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}
					}elseif($record->jpaket_cara == 'kwitansi'){
						$sql = "SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='".$jpaket_nobukti."'";
						$rs = $this->db->query($sql);
						if($rs->num_rows()==1){
							$sql="SELECT jpaket_nobukti, jpaket_cara, jkwitansi_nilai AS bayar_nilai FROM master_jual_paket LEFT JOIN jual_kwitansi ON(jkwitansi_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}else if($rs->num_rows()==2){
							$sql="SELECT jpaket_nobukti, jpaket_cara, jkwitansi_nilai AS bayar_nilai FROM master_jual_paket LEFT JOIN jual_kwitansi ON(jkwitansi_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id' LIMIT 0,1";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}
					}elseif($record->jpaket_cara == 'card'){
						$sql = "SELECT jcard_id FROM jual_card WHERE jcard_ref='".$jpaket_nobukti."'";
						$rs = $this->db->query($sql);
						if($rs->num_rows()==1){
							$sql="SELECT jpaket_nobukti, jpaket_cara, jcard_nilai AS bayar_nilai FROM master_jual_paket LEFT JOIN jual_card ON(jcard_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}else if($rs->num_rows()==2){
							$sql="SELECT jpaket_nobukti, jpaket_cara, jcard_nilai AS bayar_nilai FROM master_jual_paket LEFT JOIN jual_card ON(jcard_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id' LIMIT 0,1";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}
					}elseif($record->jpaket_cara == 'cek/giro'){
						$sql = "SELECT jcek_id FROM jual_cek WHERE jcek_ref='".$jpaket_nobukti."'";
						$rs = $this->db->query($sql);
						if($rs->num_rows()==1){
							$sql="SELECT jpaket_nobukti, jpaket_cara, jcek_nilai AS bayar_nilai FROM master_jual_paket LEFT JOIN jual_cek ON(jcek_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}else if($rs->num_rows()==2){
							$sql="SELECT jpaket_nobukti, jpaket_cara, jcek_nilai AS bayar_nilai FROM master_jual_paket LEFT JOIN jual_cek ON(jcek_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id' LIMIT 0,1";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}
					}elseif($record->jpaket_cara == 'transfer'){
						$sql = "SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='".$jpaket_nobukti."'";
						$rs = $this->db->query($sql);
						if($rs->num_rows()==1){
							$sql="SELECT jpaket_nobukti, jpaket_cara, jtransfer_nilai AS bayar_nilai FROM master_jual_paket LEFT JOIN jual_transfer ON(jtransfer_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}else if($rs->num_rows()==2){
							$sql="SELECT jpaket_nobukti, jpaket_cara, jtransfer_nilai AS bayar_nilai FROM master_jual_paket LEFT JOIN jual_transfer ON(jtransfer_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id' LIMIT 0,1";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}
					}elseif($record->jpaket_cara == 'voucher'){
						$sql = "SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='".$jpaket_nobukti."'";
						$rs = $this->db->query($sql);
						if($rs->num_rows()==1){
							$sql="SELECT jpaket_nobukti, jpaket_cara, tvoucher_nilai AS bayar_nilai FROM master_jual_paket LEFT JOIN voucher_terima ON(tvoucher_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}else if($rs->num_rows()==2){
							$sql="SELECT jpaket_nobukti, jpaket_cara, tvoucher_nilai AS bayar_nilai FROM master_jual_paket LEFT JOIN voucher_terima ON(tvoucher_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id' LIMIT 0,1";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}
					}
				}else{
					return NULL;
				}
			}else{
				return NULL;
			}
			
		}
		
		function cara_bayar2($jpaket_id){
			$sql="SELECT jpaket_nobukti, jpaket_cara2 FROM master_jual_paket WHERE jpaket_id='$jpaket_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$record=$rs->row();
				$jpaket_nobukti = $record->jpaket_nobukti;
				if(($record->jpaket_cara2 !== NULL || $record->jpaket_cara2 !== '')){
					if($record->jpaket_cara2 == 'tunai'){
						$sql = "SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='".$jpaket_nobukti."'";
						$rs = $this->db->query($sql);
						if($rs->num_rows()==1){
							$sql="SELECT jpaket_nobukti, jpaket_cara2, jtunai_nilai AS bayar2_nilai FROM master_jual_paket LEFT JOIN jual_tunai ON(jtunai_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}else if($rs->num_rows()==2){
							$sql="SELECT jpaket_nobukti, jpaket_cara2, jtunai_nilai AS bayar2_nilai FROM master_jual_paket LEFT JOIN jual_tunai ON(jtunai_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id' LIMIT ,1";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}
					}elseif($record->jpaket_cara2 == 'kwitansi'){
						$sql = "SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='".$jpaket_nobukti."'";
						$rs = $this->db->query($sql);
						if($rs->num_rows()==1){
							$sql="SELECT jpaket_nobukti, jpaket_cara2, jkwitansi_nilai AS bayar2_nilai FROM master_jual_paket LEFT JOIN jual_kwitansi ON(jkwitansi_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}else if($rs->num_rows()==2){
							$sql="SELECT jpaket_nobukti, jpaket_cara2, jkwitansi_nilai AS bayar2_nilai FROM master_jual_paket LEFT JOIN jual_kwitansi ON(jkwitansi_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id' LIMIT 1,1";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}
					}elseif($record->jpaket_cara2 == 'card'){
						$sql = "SELECT jcard_id FROM jual_card WHERE jcard_ref='".$jpaket_nobukti."'";
						$rs = $this->db->query($sql);
						if($rs->num_rows()==1){
							$sql="SELECT jpaket_nobukti, jpaket_cara2, jcard_nilai AS bayar2_nilai FROM master_jual_paket LEFT JOIN jual_card ON(jcard_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}else if($rs->num_rows()==2){
							$sql="SELECT jpaket_nobukti, jpaket_cara2, jcard_nilai AS bayar2_nilai FROM master_jual_paket LEFT JOIN jual_card ON(jcard_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id' LIMIT 1,1";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}
					}elseif($record->jpaket_cara2 == 'cek/giro'){
						$sql = "SELECT jcek_id FROM jual_cek WHERE jcek_ref='".$jpaket_nobukti."'";
						$rs = $this->db->query($sql);
						if($rs->num_rows()==1){
							$sql="SELECT jpaket_nobukti, jpaket_cara2, jcek_nilai AS bayar2_nilai FROM master_jual_paket LEFT JOIN jual_cek ON(jcek_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}else if($rs->num_rows()==2){
							$sql="SELECT jpaket_nobukti, jpaket_cara2, jcek_nilai AS bayar2_nilai FROM master_jual_paket LEFT JOIN jual_cek ON(jcek_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id' LIMIT 1,1";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}
					}elseif($record->jpaket_cara2 == 'transfer'){
						$sql = "SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='".$jpaket_nobukti."'";
						$rs = $this->db->query($sql);
						if($rs->num_rows()==1){
							$sql="SELECT jpaket_nobukti, jpaket_cara2, jtransfer_nilai AS bayar2_nilai FROM master_jual_paket LEFT JOIN jual_transfer ON(jtransfer_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}else if($rs->num_rows()==2){
							$sql="SELECT jpaket_nobukti, jpaket_cara2, jtransfer_nilai AS bayar2_nilai FROM master_jual_paket LEFT JOIN jual_transfer ON(jtransfer_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id' LIMIT 1,1";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}
					}elseif($record->jpaket_cara2 == 'voucher'){
						$sql = "SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='".$jpaket_nobukti."'";
						$rs = $this->db->query($sql);
						if($rs->num_rows()==1){
							$sql="SELECT jpaket_nobukti, jpaket_cara2, tvoucher_nilai AS bayar2_nilai FROM master_jual_paket LEFT JOIN voucher_terima ON(tvoucher_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}else if($rs->num_rows()==2){
							$sql="SELECT jpaket_nobukti, jpaket_cara2, tvoucher_nilai AS bayar2_nilai FROM master_jual_paket LEFT JOIN voucher_terima ON(tvoucher_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id' LIMIT 1,1";
							$rs=$this->db->query($sql);
							if($rs->num_rows()){
								return $rs->row();
							}else{
								return NULL;
							}
						}
					}
				}else{
					return NULL;
				}
			}else{
				return NULL;
			}
			
		}
		
		function cara_bayar3($jpaket_id){
			$sql="SELECT jpaket_nobukti, jpaket_cara3 FROM master_jual_paket WHERE jpaket_id='$jpaket_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$record=$rs->row();
				if(($record->jpaket_cara3 !== NULL || $record->jpaket_cara3 !== '')){
					if($record->jpaket_cara3 == 'tunai'){
						$sql="SELECT jpaket_nobukti, jpaket_cara3, jtunai_nilai AS bayar3_nilai FROM master_jual_paket LEFT JOIN jual_tunai ON(jtunai_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}elseif($record->jpaket_cara3 == 'kwitansi'){
						$sql="SELECT jpaket_nobukti, jpaket_cara3, jkwitansi_nilai AS bayar3_nilai FROM master_jual_paket LEFT JOIN jual_kwitansi ON(jkwitansi_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}elseif($record->jpaket_cara3 == 'card'){
						$sql="SELECT jpaket_nobukti, jpaket_cara3, jcard_nilai AS bayar3_nilai FROM master_jual_paket LEFT JOIN jual_card ON(jcard_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}elseif($record->jpaket_cara3 == 'cek/giro'){
						$sql="SELECT jpaket_nobukti, jpaket_cara3, jcek_nilai AS bayar3_nilai FROM master_jual_paket LEFT JOIN jual_cek ON(jcek_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}elseif($record->jpaket_cara3 == 'transfer'){
						$sql="SELECT jpaket_nobukti, jpaket_cara3, jtransfer_nilai AS bayar3_nilai FROM master_jual_paket LEFT JOIN jual_transfer ON(jtransfer_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}elseif($record->jpaket_cara3 == 'voucher'){
						$sql="SELECT jpaket_nobukti, jpaket_cara3, tvoucher_nilai AS bayar3_nilai FROM master_jual_paket LEFT JOIN voucher_terima ON(tvoucher_ref=jpaket_nobukti) WHERE jpaket_id='$jpaket_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}
				}else{
					return NULL;
				}
			}else{
				return NULL;
			}
		}
		
			function iklan(){
			$sql="SELECT * from iklan_today";
			$result = $this->db->query($sql);
			return $result;
		}
		
		
		
}
?>