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
		
		function get_laporan($tgl_awal,$tgl_akhir,$periode,$opsi,$group){
			
			switch($group){
				case "Tanggal": $order_by=" ORDER BY tanggal";break;
				case "Customer": $order_by=" ORDER BY cust_id";break;
				case "No Faktur": $order_by=" ORDER BY no_bukti";break;
				case "Perawatan": $order_by=" ORDER BY produk_kode";break;
				case "Sales": $order_by=" ORDER BY sales";break;
				case "Jenis Diskon": $order_by=" ORDER BY diskon_jenis";break;
				default: $order_by=" ORDER BY no_bukti";break;
			}
			
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT * FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal'  ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal, '%Y-%m') like  '".$tgl_awal."%' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."' ".$order_by;
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT * FROM vu_detail_jual_rawat WHERE jrawat_stat_dok<>'Batal' ".$order_by;
				else if($periode=='bulan')
					$sql="SELECT * FROM vu_detail_jual_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal, '%Y-%m') like  '".$tgl_awal."%' ".$order_by;
				else if($periode=='tanggal')
					$sql="SELECT * FROM vu_detail_jual_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."' ".$order_by;
			}
			
			$query=$this->db->query($sql);
			return $query->result();
		}
		
		function get_total_item($tgl_awal,$tgl_akhir,$periode,$opsi){
			$sql="";
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' ";
				else if($periode=='bulan')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal'  AND date_format(tanggal, '%Y-%m') like  '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal'  AND date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_detail_jual_rawat WHERE jrawat_stat_dok<>'Batal'";
				else if($periode=='bulan')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_detail_jual_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal, '%Y-%m') like  '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(jumlah_barang) as total_item FROM vu_detail_jual_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(cashback) as total_diskon FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' ";
				else if($periode=='bulan')
					$sql="SELECT SUM(cashback) as total_diskon FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal, '%Y-%m') like  '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(cashback) as total_diskon FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal'  AND date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT SUM(diskon_nilai) as total_diskon FROM vu_detail_jual_rawat WHERE jrawat_stat_dok<>'Batal'";
				else if($periode=='bulan')
					$sql="SELECT SUM(diskon_nilai) as total_diskon FROM vu_detail_jual_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal, '%Y-%m') like  '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(diskon_nilai) as total_diskon FROM vu_detail_jual_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(total_nilai) as total_nilai FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal'  ";
				else if($periode=='bulan')
					$sql="SELECT SUM(total_nilai) as total_nilai FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal'  AND date_format(tanggal, '%Y-%m') like  '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(total_nilai) as total_nilai FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal'  AND date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
			}else if($opsi=='detail'){
				if($periode=='all')
					$sql="SELECT SUM(subtotal) as total_nilai FROM vu_detail_jual_rawat WHERE jrawat_stat_dok<>'Batal'";
				else if($periode=='bulan')
					$sql="SELECT SUM(subtotal) as total_nilai FROM vu_detail_jual_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal, '%Y-%m') like  '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(subtotal) as total_nilai FROM vu_detail_jual_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(cek) as total_cek FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal'  ";
				else if($periode=='bulan')
					$sql="SELECT SUM(cek) as total_cek FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal'  AND date_format(tanggal, '%Y-%m') like  '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(cek) as total_cek FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal'  AND date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(tunai) as total_tunai FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' ";
				else if($periode=='bulan')
					$sql="SELECT SUM(tunai) as total_tunai FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal'  AND date_format(tanggal, '%Y-%m') like  '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(tunai) as total_tunai FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal'  AND date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(transfer) as total_transfer FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' ";
				else if($periode=='bulan')
					$sql="SELECT SUM(transfer) as total_transfer FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal, '%Y-%m') like  '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(transfer) as total_transfer FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(card) as total_card FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' ";
				else if($periode=='bulan')
					$sql="SELECT SUM(card) as total_card FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal, '%Y-%m') like  '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(card) as total_card FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
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
					$sql="SELECT SUM(kredit) as total_kredit FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' ";
				else if($periode=='bulan')
					$sql="SELECT SUM(kredit) as total_kredit FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal, '%Y-%m') like  '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(kredit) as total_kredit FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_kredit;
			}else
				return "";
		}
		
		function get_total_kuitansi($tgl_awal,$tgl_akhir,$periode,$opsi){
			if($opsi=='rekap'){
				if($periode=='all')
					$sql="SELECT SUM(kuitansi) as total_kuitansi FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' ";
				else if($periode=='bulan')
					$sql="SELECT SUM(kuitansi) as total_kuitansi FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal, '%Y-%m') like  '".$tgl_awal."%'";
				else if($periode=='tanggal')
					$sql="SELECT SUM(kuitansi) as total_kuitansi FROM vu_trans_rawat WHERE jrawat_stat_dok<>'Batal' AND date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."' AND date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
			}
			$query=$this->db->query($sql);
			if($query->num_rows()){
				$data=$query->row();
				return $data->total_kuitansi;
			}else
				return "";
		}
		
		//fungsi untuk pengambilan paket
		//get record list
		function detail_ambil_paket_list($dpaket_id,$tanggal,$dapaket_cust,$query,$dapaket_stat_dok,$start,$end) {
			$date_now=date('Y-m-d');
			/* ambil history pengambilan paket dari $master_id===customer_id untuk transaksi hari ini */
			//2010-05-06 ==> $query = "SELECT jpaket_nobukti, paket_nama, rawat_nama, dapaket_jumlah, cust_nama FROM detail_ambil_paket LEFT JOIN master_jual_paket ON(dapaket_jpaket=jpaket_id) LEFT JOIN paket ON(dapaket_paket=paket_id) LEFT JOIN customer ON(dapaket_cust=cust_id) LEFT JOIN perawatan ON(dapaket_item=rawat_id) WHERE dapaket_cust='$master_id' AND date_format(dapaket_date_create,'%Y-%m-%d')='$tanggal'";
			/*2010-06-23 ==> if($dpaket_id=="" || $dpaket_id==0){
				//* Transaksi Perawatan satuan sekaligus pengambilan paket per customer/
				$query = "SELECT dapaket_id, jpaket_nobukti, paket_nama, rawat_nama, dapaket_jumlah, cust_nama FROM detail_ambil_paket LEFT JOIN master_jual_paket ON(dapaket_jpaket=jpaket_id) LEFT JOIN paket ON(dapaket_paket=paket_id) LEFT JOIN customer ON(dapaket_cust=cust_id) LEFT JOIN perawatan ON(dapaket_item=rawat_id) WHERE date_format(dapaket_date_create,'%Y-%m-%d')='$tanggal' AND dapaket_cust='$dapaket_cust' AND dapaket_stat_dok='Terbuka'";
			}else if($dpaket_id>0){
				//* Transaksi Perawatan hanya pengambilan paket per customer /
				//$query = "SELECT dapaket_id, jpaket_nobukti, paket_nama, rawat_nama, dapaket_jumlah, cust_nama FROM detail_ambil_paket LEFT JOIN master_jual_paket ON(dapaket_jpaket=jpaket_id) LEFT JOIN paket ON(dapaket_paket=paket_id) LEFT JOIN customer ON(dapaket_cust=cust_id) LEFT JOIN perawatan ON(dapaket_item=rawat_id) WHERE dapaket_dpaket='$dpaket_id' AND date_format(dapaket_date_create,'%Y-%m-%d')='$tanggal' AND dapaket_stat_dok='Terbuka' AND dapaket_cust='$dapaket_cust'";
                $query = "SELECT dapaket_id, jpaket_nobukti, paket_nama, rawat_nama, dapaket_jumlah, cust_nama FROM detail_ambil_paket LEFT JOIN master_jual_paket ON(dapaket_jpaket=jpaket_id) LEFT JOIN paket ON(dapaket_paket=paket_id) LEFT JOIN customer ON(dapaket_cust=cust_id) LEFT JOIN perawatan ON(dapaket_item=rawat_id) WHERE date_format(dapaket_date_create,'%Y-%m-%d')='$tanggal' AND dapaket_cust='$dapaket_cust' AND dapaket_stat_dok='Terbuka' AND dapaket_cust='$dapaket_cust'";
			}*/
			$query = "SELECT dapaket_id
					,jpaket_nobukti
					,paket_nama
					,rawat_nama
					,dapaket_jumlah
					,cust_nama
				FROM detail_ambil_paket
				LEFT JOIN master_jual_paket ON(dapaket_jpaket=jpaket_id)
				LEFT JOIN paket ON(dapaket_paket=paket_id)
				LEFT JOIN customer ON(dapaket_cust=cust_id)
				LEFT JOIN perawatan ON(dapaket_item=rawat_id)
				WHERE date_format(dapaket_date_create,'%Y-%m-%d')='$tanggal'
					AND dapaket_cust='$dapaket_cust'
					AND dapaket_stat_dok='$dapaket_stat_dok'";
			
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
			$query = "SELECT
                    drawat_id
                    ,drawat_master
                    ,drawat_rawat
                    ,drawat_jumlah
                    ,perawatan.rawat_harga as drawat_harga
                    ,drawat_diskon
                    ,drawat_sales
                    ,drawat_diskon_jenis
                    ,perawatan.rawat_harga*drawat_jumlah as drawat_subtotal
                    ,drawat_harga*drawat_jumlah*(100-drawat_diskon)/100 as drawat_subtotal_net
                    ,dtrawat_keterangan
                    ,IF((dtrawat_petugas1=0),IF((dtrawat_petugas2=0),NULL,terapis.karyawan_username),dokter.karyawan_username) AS referal
                    ,drawat_dtrawat
                FROM detail_jual_rawat
                LEFT JOIN perawatan ON(rawat_id=drawat_rawat)
                LEFT JOIN tindakan_detail ON(drawat_dtrawat=dtrawat_id)
                LEFT JOIN karyawan AS dokter ON(dtrawat_petugas1=dokter.karyawan_id)
                LEFT JOIN karyawan AS terapis ON(dtrawat_petugas2=terapis.karyawan_id)
                WHERE drawat_master='".$master_id."'";
			
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
			//2010-07-04 ==> $query = "SELECT max(jrawat_id) AS master_id FROM master_jual_rawat WHERE jrawat_update='".$_SESSION[SESSION_USERID]."'";
			$query = "SELECT max(jrawat_id) AS master_id FROM master_jual_rawat WHERE jrawat_creator='".$_SESSION[SESSION_USERID]."'";
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
		
		function member_point_update($jrawat_id){
			$date_now=date('Y-m-d');
			$sql="SELECT jrawat_cust FROM master_jual_rawat WHERE jrawat_id='$jrawat_id'";
			$rs=$this->db->query($sql);
			$record=$rs->row_array();
			$jrawat_cust=$record['jrawat_cust'];
			
			$sql="SELECT member_id FROM member WHERE member_cust='$jrawat_cust' AND (member_valid >= '$date_now')";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$sql="SELECT drawat_jumlah
						,drawat_harga
						,rawat_point
						,drawat_diskon
						,jrawat_diskon
						,jrawat_cashback
					FROM detail_jual_rawat
					LEFT JOIN master_jual_rawat ON(drawat_master=jrawat_id)
					LEFT JOIN perawatan ON(drawat_rawat=rawat_id)
					WHERE drawat_master='$jrawat_id'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$one_record = $rs->row();
					$jrawat_cashback = $one_record->jrawat_cashback;
					$jrawat_diskon = $one_record->jrawat_diskon;
					$jumlah_rupiah_detail = 0;
					$jumlah_rupiah_total = 0;
					$jumlah_point = 0;
					foreach($rs->result() as $row){
						$drawat_jumlah = $row->drawat_jumlah;
						$drawat_harga = $row->drawat_harga;
						$drawat_diskon = $row->drawat_diskon;
						$rawat_point = $row->rawat_point;
						$jumlah_rupiah_detail += (($drawat_jumlah * $drawat_harga) * ((100 - $drawat_diskon)/100)) * $rawat_point;
					}
					if($jrawat_diskon>0){
						//memprioritaskan diskon_total_persen daripada diskon_total_cashback
						$jumlah_rupiah_total =  $jumlah_rupiah_detail * ((100 - $jrawat_diskon)/100);
					}else if($jrawat_diskon<=0 && $jrawat_cashback>0){
						$jumlah_rupiah_total = $jumlah_rupiah_detail - $jrawat_cashback;
					}else{
						$jumlah_rupiah_total = $jumlah_rupiah_detail;
					}
					
					//ambil dari db.member_setup
					$setmember_point_perrp = $this->get_point_per_rupiah();
					
					if($setmember_point_perrp>0){
						$jumlah_point = floor($jumlah_rupiah_total/$setmember_point_perrp);
					}
					$sql="UPDATE customer SET cust_point = (cust_point + $jumlah_point) WHERE cust_id='$jrawat_cust'";
					$this->db->query($sql);
					
					$dtu_jrawat=array(
					"jrawat_point"=>$jumlah_point
					);
					$this->db->where('jrawat_id', $jrawat_id);
					$this->db->update('master_jual_rawat', $dtu_jrawat);
				}
			}
		}
		
		function member_point_delete($drawat_master){
			$date_now=date('Y-m-d');
			
			$sql="SELECT jrawat_cust FROM master_jual_rawat WHERE jrawat_id='$drawat_master'";
			$rs=$this->db->query($sql);
			$record=$rs->row_array();
			$jrawat_cust=$record['jrawat_cust'];
			
			$sql="SELECT member_id FROM member WHERE member_cust='$jrawat_cust' AND (member_valid >= '$date_now')";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$sql="SELECT setmember_point_perrp FROM member_setup LIMIT 1";
				$rs=$this->db->query($sql);
				$record=$rs->row_array();
				$setmember_point_perrp=$record['setmember_point_perrp'];
				
				$sql="SELECT drawat_jumlah, drawat_harga, rawat_point, drawat_diskon, jrawat_diskon, jrawat_cashback FROM detail_jual_rawat LEFT JOIN master_jual_rawat ON(drawat_master=jrawat_id) LEFT JOIN rawat ON(drawat_rawat=rawat_id) WHERE drawat_master='$drawat_master'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$one_record = $rs->row();
					$jrawat_cashback = $one_record->jrawat_cashback;
					$jrawat_diskon = $one_record->jrawat_diskon;
					$jumlah_rupiah = 0;
					$jumlah_point = 0;
					foreach($rs->result() as $row){
						//$jumlah_point += ($row->drawat_jumlah) * ($row->rawat_point) * (floor(($row->drawat_harga)/$setmember_point_perrp));
						$jumlah_rupiah += ($row->drawat_jumlah) * ($row->rawat_point) * ($row->drawat_harga) * ((100 - $row->drawat_diskon)/100);
					}
					$jumlah_rupiah -= $jrawat_cashback;
					if($setmember_point_perrp<>0){
						$jumlah_point = floor($jumlah_rupiah/$setmember_point_perrp);
					}
					$sql="UPDATE customer SET cust_point = (cust_point - $jumlah_point) WHERE cust_id='$jrawat_cust'";
					$this->db->query($sql);
					return 1;
				}else{
					return 1;
				}
			}else{
				return 1;
			}
		}
		
		function member_point_batal($jrawat_id){
			$sql = "SELECT jrawat_point, jrawat_cust FROM master_jual_rawat WHERE jrawat_id='$jrawat_id'";
			$rs = $this->db->query($sql);
			if($rs->num_rows()){
				$record = $rs->row_array();
				$jrawat_point = $record['jrawat_point'];
				$jrawat_cust = $record['jrawat_cust'];
				$sql="UPDATE customer SET cust_point = (cust_point - $jrawat_point) WHERE cust_id='$jrawat_cust'";
				$this->db->query($sql);
			}
		}
		
		function cara_bayar_batal($jrawat_id){
			//updating db.jual_card ==> pembatalan
			$sqlu_jcard = "UPDATE jual_card JOIN master_jual_rawat ON(jual_card.jcard_ref=master_jual_rawat.jrawat_nobukti)
				SET jual_card.jcard_stat_dok = master_jual_rawat.jrawat_stat_dok
				WHERE master_jual_rawat.jrawat_id='$jrawat_id'";
			$this->db->query($sqlu_jcard);
			
			//updating db.jual_cek ==> pembatalan
			$sqlu_jcek = "UPDATE jual_cek JOIN master_jual_rawat ON(jual_cek.jcek_ref=master_jual_rawat.jrawat_nobukti)
				SET jual_cek.jcek_stat_dok = master_jual_rawat.jrawat_stat_dok
				WHERE master_jual_rawat.jrawat_id='$jrawat_id'";
			$this->db->query($sqlu_jcek);
			
			//updating db.jual_kwitansi ==> pembatalan
			$sqlu_jkwitansi = "UPDATE jual_kwitansi JOIN master_jual_rawat ON(jual_kwitansi.jkwitansi_ref=master_jual_rawat.jrawat_nobukti)
				SET jual_kwitansi.jkwitansi_stat_dok = master_jual_rawat.jrawat_stat_dok
				WHERE master_jual_rawat.jrawat_id='$jrawat_id'";
			$this->db->query($sqlu_jkwitansi);
			
			//updating db.jual_transfer ==> pembatalan
			$sqlu_jtransfer = "UPDATE jual_transfer JOIN master_jual_rawat ON(jual_transfer.jtransfer_ref=master_jual_rawat.jrawat_nobukti)
				SET jual_transfer.jtransfer_stat_dok = master_jual_rawat.jrawat_stat_dok
				WHERE master_jual_rawat.jrawat_id='$jrawat_id'";
			$this->db->query($sqlu_jtransfer);
			
			//updating db.jual_tunai ==> pembatalan
			$sqlu_jtunai = "UPDATE jual_tunai JOIN master_jual_rawat ON(jual_tunai.jtunai_ref=master_jual_rawat.jrawat_nobukti)
				SET jual_tunai.jtunai_stat_dok = master_jual_rawat.jrawat_stat_dok
				WHERE master_jual_rawat.jrawat_id='$jrawat_id'";
			$this->db->query($sqlu_jtunai);
		}
		
		function catatan_piutang_update($jrawat_id){
			if($jrawat_id=="" || $jrawat_id==NULL || $jrawat_id==0){
				$jrawat_id=$this->get_master_id();
			}
			
			$sql="SELECT * FROM vu_piutang_jrawat WHERE jrawat_id='$jrawat_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$lpiutang_faktur=$rs_record["jrawat_nobukti"];
				$lpiutang_cust=$rs_record["jrawat_cust"];
				$lpiutang_faktur_tanggal=$rs_record["jrawat_tanggal"];
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
		
		function membership_insert($jrawat_id){
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
			
			$sql="SELECT jrawat_cust FROM master_jual_rawat WHERE jrawat_id='$jrawat_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$rs_record=$rs->row_array();
				$cust_id = $rs_record['jrawat_cust'];
				
				$jproduk_total_trans=0;
				$jpaket_total_trans=0;
				$jrawat_total_trans=0;
				$cust_total_trans_now=0;
				
				$trans_jproduk = "SELECT sum(jproduk_totalbiaya) AS jproduk_total_trans FROM master_jual_produk WHERE jproduk_cust='$cust_id' AND jproduk_tanggal='$date_now' GROUP BY jproduk_cust";
				$rs_trans_jproduk=$this->db->query($trans_jproduk);
				if($rs_trans_jproduk->num_rows()){
					$rs_trans_jproduk_record=$rs_trans_jproduk->row_array();
					$jproduk_total_trans=$rs_trans_jproduk_record['jproduk_total_trans'];
				}
				
				$trans_jpaket = "SELECT sum(jpaket_totalbiaya) AS jpaket_total_trans FROM master_jual_paket WHERE jpaket_cust='$cust_id' AND jpaket_tanggal='$date_now' GROUP BY jpaket_cust";
				$rs_trans_jpaket=$this->db->query($trans_jpaket);
				if($rs_trans_jpaket->num_rows()){
					$rs_trans_jpaket_record=$rs_trans_jpaket->row_array();
					$jpaket_total_trans=$rs_trans_jpaket_record['jpaket_total_trans'];
				}
				
				$trans_jrawat = "SELECT sum(jrawat_totalbiaya) AS jrawat_total_trans FROM master_jual_rawat WHERE jrawat_cust='$cust_id' AND jrawat_tanggal='$date_now' GROUP BY jrawat_cust";
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
							}
						}else{
							//* message: kartu member customer ini sementara tidak bisa digunakan, karena sudah masuk masa tenggang /
							//* deleting customer pada db.member_temp (yang mungkin sebelumnya dimasukkan), dikarenakan ada pembatalan transaksi sehingga $cust_total_trans_now tidak memenuhi syarat /
							$this->db->where('membert_cust', $cust_id);
							$this->db->delete('member_temp');
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
						}
					}else{
						//* Syarat menjadi MEMBER belum terpenuhi /
						//* deleting di db.member_temp (jika sebelumnya sudah diinsert), karena melakukan pembatalan transaksi sehingga total transaksi hari ini tidak memenuhi syarat menjadi member /
						$this->db->where('membert_cust', $cust_id);
						$this->db->delete('member_temp');
					}
				}
			}
		}
		
		//purge all detail from master
		function detail_detail_jual_rawat_purge($master_id){
			$result_point_delete = $this->member_point_delete($master_id);
			if($result_point_delete==1){
				$sql="DELETE from detail_jual_rawat where drawat_master='".$master_id."'";
				$result=$this->db->query($sql);
			}
		}
		//*eof
		
		//insert detail record
		function detail_detail_jual_rawat_insert($array_drawat_id
												 ,$drawat_master
												 ,$array_drawat_rawat
												 ,$array_drawat_jumlah
												 ,$array_drawat_harga
												 ,$array_drawat_diskon
												 ,$array_drawat_diskon_jenis
												 ,$array_drawat_sales
												 ,$jrawat_id){
			
			//if master id not capture from view then capture it from max pk from master table
			if($drawat_master=="" || $drawat_master==NULL || $drawat_master==0){
				$drawat_master=$this->get_master_id();
			}else{
				$drawat_master=$jrawat_id;
			}
			
			$size_array = sizeof($array_drawat_rawat) - 1;
			
			for($i = 0; $i < sizeof($array_drawat_rawat); $i++){
				$drawat_id = $array_drawat_id[$i];
				$drawat_rawat = $array_drawat_rawat[$i];
				$drawat_jumlah = $array_drawat_jumlah[$i];
				$drawat_harga = $array_drawat_harga[$i];
				$drawat_diskon = $array_drawat_diskon[$i];
				$drawat_diskon_jenis = $array_drawat_diskon_jenis[$i];
				$drawat_sales = $array_drawat_sales[$i];
				
				if(is_numeric($drawat_id)){
					//data detail sudah masuk database ==> mode Edit
					$dtu_drawat = array(
						//"drawat_master"=>$drawat_master, 
						"drawat_rawat"=>$drawat_rawat, 
						"drawat_jumlah"=>$drawat_jumlah, 
						"drawat_harga"=>$drawat_harga, 
						"drawat_diskon"=>$drawat_diskon,
						"drawat_diskon_jenis"=>$drawat_diskon_jenis,
						"drawat_sales"=>$drawat_sales 
					);
					$this->db->where('drawat_id', $drawat_id);
					$this->db->update('detail_jual_rawat', $dtu_drawat);
				}else{
					//data detail baru ==> mode Add
					$dti_drawat = array(
						"drawat_master"=>$drawat_master, 
						"drawat_rawat"=>$drawat_rawat, 
						"drawat_jumlah"=>$drawat_jumlah, 
						"drawat_harga"=>$drawat_harga, 
						"drawat_diskon"=>$drawat_diskon,
						"drawat_diskon_jenis"=>$drawat_diskon_jenis,
						"drawat_sales"=>$drawat_sales 
					);
					$this->db->insert('detail_jual_rawat', $dti_drawat);
				}
				
				if($i==$size_array){
					return "{success:true}";
				}
				
				/*$sql="SELECT drawat_id FROM detail_jual_rawat WHERE drawat_id='$drawat_id'";
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
				if($this->db->affected_rows()){
					return '1';
				}else
					return '0';*/
				
			}
		}
		//end of function
		
		function detail_jual_rawat_update($array_drawat_id
										  ,$drawat_master
										  ,$array_drawat_dtrawat
										  ,$array_drawat_rawat
										  ,$array_drawat_jumlah
										  ,$array_drawat_harga
										  ,$array_drawat_diskon
										  ,$array_drawat_diskon_jenis){
			
			$size_array = sizeof($array_drawat_rawat) - 1;
			
			for($i = 0; $i < sizeof($array_drawat_rawat); $i++){
				$drawat_id = $array_drawat_id[$i];
				$drawat_dtrawat = $array_drawat_dtrawat[$i];
				$drawat_rawat = $array_drawat_rawat[$i];
				$drawat_jumlah = $array_drawat_jumlah[$i];
				$drawat_harga = $array_drawat_harga[$i];
				$drawat_diskon = $array_drawat_diskon[$i];
				$drawat_diskon_jenis = $array_drawat_diskon_jenis[$i];
				
				if($drawat_id==''){
					//* Insert to db.detail_jual_rawat WHERE detail yang ditambahkan adalah data baru /
					$dti_drawat=array(
					"drawat_master"=>$drawat_master,
					"drawat_rawat"=>$drawat_rawat,
					"drawat_jumlah"=>$drawat_jumlah,
					"drawat_harga"=>$drawat_harga,
					"drawat_diskon"=>$drawat_diskon,
					"drawat_diskon_jenis"=>$drawat_diskon_jenis
					);
					$this->db->insert('detail_jual_rawat', $dti_drawat);
				}elseif(is_numeric($drawat_id) && $drawat_dtrawat==''){
					//* Update to db.detail_jual_rawat WHERE detail yang ditambahkan dari Kasir Perawatan bukan dari Tindakan /
					$dtu_drawat=array(
					"drawat_rawat"=>$drawat_rawat,
					"drawat_jumlah"=>$drawat_jumlah,
					"drawat_harga"=>$drawat_harga,
					"drawat_diskon"=>$drawat_diskon,
					"drawat_diskon_jenis"=>$drawat_diskon_jenis
					);
					$this->db->where('drawat_id', $drawat_id);
					$this->db->update('detail_jual_rawat', $dtu_drawat);
				}elseif(is_numeric($drawat_id) && $drawat_dtrawat>0){
					//* Update to db.detail_jual_rawat WHERE data detail adalah dari Tindakan /
					$dtu_drawat=array(
					"drawat_diskon"=>$drawat_diskon,
					"drawat_diskon_jenis"=>$drawat_diskon_jenis
					);
					$this->db->where('drawat_id', $drawat_id);
					$this->db->update('detail_jual_rawat', $dtu_drawat);
				}
				
				if($i==$size_array){
					return "{success:true}";
				}
				
				/*if($this->db->affected_rows() && ($i==$size_array)){
					return "{success:true}";
				}elseif(!($this->db->affected_rows()) && ($i==$size_array)){
					return "{failure:true}";
				}*/
			}
			
		}
        
        function detail_jual_rawat_delete($drawat_id){
            // You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the master_jual_rawats at the same time :
			if(sizeof($drawat_id)<1){
				return '0';
			} else if (sizeof($drawat_id) == 1){
				$query = "DELETE FROM detail_jual_rawat WHERE drawat_id = ".$drawat_id[0];
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
        
        function detail_ambil_paket_update($dapaket_id ){
            /*$dtu_dapaket=array(
			"dapaket_stat_dok"=>'Batal'
			);
			
			$this->db->where('dapaket_id', $dapaket_id);
			$this->db->update('detail_ambil_paket', $dtu_dapaket);*/
            //* Pengambilan Paket di-Batalkan /
            $dpaket_id = 0;
            $sql="SELECT dapaket_paket, dapaket_dpaket, paket_jmlisi, sum(dapaket_jumlah) AS total_pakai_paket FROM detail_ambil_paket LEFT JOIN paket ON(dapaket_paket=paket_id) WHERE dapaket_id='$dapaket_id' GROUP BY dapaket_dpaket";
            $rs=$this->db->query($sql);
            if($rs->num_rows()){
                $record = $rs->row_array();
                $dpaket_id = $record['dapaket_dpaket'];
                $paket_id = $record['dapaket_paket'];
                $paket_jmlisi = $record['paket_jmlisi'];
            }
            
            //backup_20100607 ==> $sql="DELETE FROM detail_ambil_paket WHERE dapaket_id='$dapaket_id'";
            $sql="UPDATE detail_ambil_paket SET dapaket_stat_dok='Batal' WHERE dapaket_id='$dapaket_id'";
            $this->db->query($sql);
			if($this->db->affected_rows()){
                $sisa_paket = 0;
                $sql="SELECT
                        sum(dapaket_jumlah) AS total_pakai_paket
                    FROM detail_ambil_paket
                    WHERE dapaket_dpaket='$dpaket_id' AND dapaket_stat_dok<>'Batal'
                    GROUP BY dapaket_dpaket";
                $rs = $this->db->query($sql);
                if($rs->num_rows()){
                    $record = $rs->row_array();
                    $sisa_paket = $paket_jmlisi - $record['total_pakai_paket'];
                }else{
                    $sisa_paket = $paket_jmlisi;
                }
                $sql="UPDATE detail_jual_paket SET dpaket_sisa_paket = $sisa_paket WHERE dpaket_id='$dpaket_id'";
                $this->db->query($sql);
				return '1';
			}else
				return '0';

		}
		
		//function for get list record
		function master_jual_rawat_list($filter,$start,$end){
			$date_now=date('Y-m-d');
			$query = "SELECT
                    jrawat_id,
                    jrawat_nobukti,
                    vu_jrawat_pr.cust_nama,
                    jrawat_cust,
                    vu_jrawat_pr.cust_no,
                    vu_jrawat_pr.cust_member,
					/*vu_jrawat_pr.member_no,
					vu_jrawat_pr.member_valid,*/
                    jrawat_tanggal,
                    jrawat_diskon,
                    jrawat_cashback,
                    jrawat_cara,
                    jrawat_cara2,
                    jrawat_cara3,
                    IF(vu_jrawat_pr.jrawat_totalbiaya!=0, vu_jrawat_pr.jrawat_totalbiaya, vu_jrawat_totalbiaya.jrawat_totalbiaya) AS jrawat_totalbiaya,
                    jrawat_bayar,
                    jrawat_keterangan,
                    jrawat_stat_dok,
                    jrawat_creator,
                    jrawat_date_create,
                    jrawat_update,
                    jrawat_date_update,
                    jrawat_revised,
                    keterangan_paket,
                    dpaket_id
                FROM vu_jrawat_pr
                LEFT JOIN vu_jrawat_totalbiaya ON(vu_jrawat_totalbiaya.drawat_master=vu_jrawat_pr.jrawat_id)
                WHERE vu_jrawat_pr.jrawat_stat_dok='Terbuka' AND date_format(vu_jrawat_pr.jrawat_date_create,'%Y-%m-%d')='$date_now'";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jrawat_nobukti LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR cust_member LIKE '%".addslashes($filter)."%')";
			}
			//normal LIST by Hendri
			else{
				//$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				//$query.=" date_format(jrawat_date_create,'%Y-%m-%d')='$date_now' AND (jrawat_bayar is null OR jrawat_bayar = 0)";
				//$query.=" date_format(jrawat_date_create,'%Y-%m-%d')='$date_now' ";
			}
			
			$query .= " ORDER BY jrawat_date_create DESC";
			
			$query2 = "SELECT
                    jrawat_id,
                    jrawat_nobukti,
                    vu_jrawat_pk.cust_nama,
                    jrawat_cust,
                    vu_jrawat_pk.cust_no,
                    vu_jrawat_pk.cust_member,
                    jrawat_tanggal,
                    jrawat_diskon,
                    jrawat_cashback,
                    jrawat_cara,
                    jrawat_cara2,
                    jrawat_cara3,
                    jrawat_totalbiaya,
                    jrawat_bayar,
                    jrawat_keterangan,
                    jrawat_creator,
                    jrawat_date_create,
                    jrawat_update,
                    jrawat_date_update,
                    jrawat_revised,
                    keterangan_paket,
                    dpaket_id,
                    dapaket_stat_dok AS jrawat_stat_dok
                FROM vu_jrawat_pk
                WHERE date_format(vu_jrawat_pk.jrawat_date_create,'%Y-%m-%d')='$date_now'
                    AND vu_jrawat_pk.jrawat_cust NOT IN(
                        SELECT vu_jrawat_pr.jrawat_cust
                        FROM vu_jrawat_pr
                        WHERE date_format(vu_jrawat_pr.jrawat_date_create,'%Y-%m-%d')='$date_now'
							AND vu_jrawat_pr.jrawat_stat_dok='Terbuka')
                    AND vu_jrawat_pk.dapaket_stat_dok='Terbuka'";
			
			// For simple search
			if ($filter<>""){
				$query2 .=eregi("WHERE",$query2)? " AND ":" WHERE ";
				$query2 .= " (jrawat_nobukti LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR cust_member LIKE '%".addslashes($filter)."%')";
			}
			$query2 .= " ORDER BY vu_jrawat_pk.dapaket_stat_dok DESC";
			
			$nbrows=0;
			$nbrows2=0;
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();

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
				$nbrows=$nbrows+$nbrows2;
                $jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
		//function for update record
		function master_jual_rawat_update($jrawat_id ,$jrawat_nobukti ,$jrawat_cust ,$jrawat_tanggal ,$jrawat_stat_dok, $jrawat_diskon ,$jrawat_cara ,$jrawat_cara2 ,$jrawat_cara3 ,$jrawat_keterangan , $jrawat_cashback, $jrawat_tunai_nilai, $jrawat_tunai_nilai2, $jrawat_tunai_nilai3, $jrawat_voucher_no, $jrawat_voucher_cashback, $jrawat_voucher_no2, $jrawat_voucher_cashback2, $jrawat_voucher_no3, $jrawat_voucher_cashback3, $jrawat_total, $jrawat_bayar, $jrawat_subtotal, $jrawat_hutang, $jrawat_kwitansi_no, $jrawat_kwitansi_nama, $jrawat_kwitansi_nilai, $jrawat_kwitansi_no2, $jrawat_kwitansi_nama2, $jrawat_kwitansi_nilai2, $jrawat_kwitansi_no3, $jrawat_kwitansi_nama3, $jrawat_kwitansi_nilai3, $jrawat_card_nama, $jrawat_card_edc, $jrawat_card_no, $jrawat_card_nilai, $jrawat_card_nama2, $jrawat_card_edc2, $jrawat_card_no2, $jrawat_card_nilai2, $jrawat_card_nama3, $jrawat_card_edc3, $jrawat_card_no3, $jrawat_card_nilai3, $jrawat_cek_nama, $jrawat_cek_no, $jrawat_cek_valid, $jrawat_cek_bank, $jrawat_cek_nilai, $jrawat_cek_nama2, $jrawat_cek_no2, $jrawat_cek_valid2, $jrawat_cek_bank2, $jrawat_cek_nilai2, $jrawat_cek_nama3, $jrawat_cek_no3, $jrawat_cek_valid3, $jrawat_cek_bank3, $jrawat_cek_nilai3, $jrawat_transfer_bank, $jrawat_transfer_nama, $jrawat_transfer_nilai, $jrawat_transfer_bank2, $jrawat_transfer_nama2, $jrawat_transfer_nilai2, $jrawat_transfer_bank3, $jrawat_transfer_nama3, $jrawat_transfer_nilai3 ,$cetak_jrawat){
			$datetime_now = date('Y-m-d H:i:s');
			if ($jrawat_stat_dok=="")
				$jrawat_stat_dok = "Terbuka";
			$jrawat_revised=0;
			
			if(substr($jrawat_nobukti,0,2)=='PR'){
                $sql="SELECT jrawat_cara, jrawat_cara2, jrawat_cara3, jrawat_date_create, jrawat_revised FROM master_jual_rawat WHERE jrawat_id='$jrawat_id'";
                $rs=$this->db->query($sql);
                if($rs->num_rows()){
                    $rs_record=$rs->row_array();
                    $jrawat_cara_awal=$rs_record["jrawat_cara"];
                    $jrawat_cara2_awal=$rs_record["jrawat_cara2"];
                    $jrawat_cara3_awal=$rs_record["jrawat_cara3"];
					$jrawat_date_create=$rs_record["jrawat_date_create"];
					
					$sql="delete from jual_tunai where jtunai_ref='".$jrawat_nobukti."'";
					$this->db->query($sql);
					
					$sql="delete from jual_kwitansi where jkwitansi_ref='".$jrawat_nobukti."'";
					$this->db->query($sql);
					
					$sql="delete from jual_card where jcard_ref='".$jrawat_nobukti."'";
					$this->db->query($sql);
							
					$sql="delete from jual_cek where jcek_ref='".$jrawat_nobukti."'";
					$this->db->query($sql);
					
					$sql="delete from jual_transfer where jtransfer_ref='".$jrawat_nobukti."'";
					$this->db->query($sql);
					
					$sql="delete from voucher_terima where tvoucher_ref='".$jrawat_nobukti."'";
					$this->db->query($sql);
					
                    /*if($jrawat_cara_awal<>$jrawat_cara){
                        if($jrawat_cara_awal=="tunai"){
                            $sql="delete from jual_tunai where jtunai_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                        if($jrawat_cara_awal=="kwitansi"){
                            $sql="delete from jual_kwitansi where jkwitansi_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                        if($jrawat_cara_awal=="card"){
                            $sql="delete from jual_card where jcard_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                        if($jrawat_cara_awal=="cek/giro"){
                            $sql="delete from jual_cek where jcek_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                        if($jrawat_cara_awal=="transfer"){
                            $sql="delete from jual_transfer where jtransfer_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                        if($jrawat_cara_awal=="voucher"){
                            $sql="delete from voucher_terima where tvoucher_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                    }
                    
                    if($jrawat_cara2_awal<>$jrawat_cara2){
                        if($jrawat_cara2_awal=="tunai"){
                            $sql="delete from jual_tunai where jtunai_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                        if($jrawat_cara2_awal=="kwitansi"){
                            $sql="delete from jual_kwitansi where jkwitansi_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                        if($jrawat_cara2_awal=="card"){
                            $sql="delete from jual_card where jcard_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                        if($jrawat_cara2_awal=="cek/giro"){
                            $sql="delete from jual_cek where jcek_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                        if($jrawat_cara2_awal=="transfer"){
                            $sql="delete from jual_transfer where jtransfer_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                        if($jrawat_cara2_awal=="voucher"){
                            $sql="delete from voucher_terima where tvoucher_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                    }
                    
                    if($jrawat_cara3_awal<>$jrawat_cara3){
                        if($jrawat_cara3_awal=="tunai"){
                            $sql="delete from jual_tunai where jtunai_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                        if($jrawat_cara3_awal=="kwitansi"){
                            $sql="delete from jual_kwitansi where jkwitansi_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                        if($jrawat_cara3_awal=="card"){
                            $sql="delete from jual_card where jcard_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                        if($jrawat_cara3_awal=="cek/giro"){
                            $sql="delete from jual_cek where jcek_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                        if($jrawat_cara3_awal=="transfer"){
                            $sql="delete from jual_transfer where jtransfer_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                        if($jrawat_cara3_awal=="voucher"){
                            $sql="delete from voucher_terima where tvoucher_ref='".$jrawat_nobukti."'";
                            $this->db->query($sql);
                        }
                    }*/
                }
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
                    "jrawat_keterangan"=>$jrawat_keterangan,
                    "jrawat_stat_dok"=>$jrawat_stat_dok,
                    "jrawat_update"=>$_SESSION[SESSION_USERID],
					"jrawat_date_update"=>$datetime_now,
					"jrawat_revised"=>$jrawat_revised+1
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
                
                //if($cetak_jrawat==1){
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
                                        $jrawat_kwitansi_nama=$jpaket_cust;
                                }
                            }
                            
                            $sql="SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='$jrawat_nobukti'";
                            $rs=$this->db->query($sql);
                            if($rs->num_rows()){
                                $data=array(
                                    "jkwitansi_master"=>$jrawat_kwitansi_no,
                                    "jkwitansi_nilai"=>$jrawat_kwitansi_nilai
                                );
                                $this->db->where('jkwitansi_ref', $jrawat_nobukti);
                                $this->db->update('jual_kwitansi', $data);
                            }else{
                                $data=array(
                                    "jkwitansi_ref"=>$jrawat_nobukti,
                                    "jkwitansi_master"=>$jrawat_kwitansi_no,
                                    "jkwitansi_nilai"=>$jrawat_kwitansi_nilai,
                                    "jkwitansi_transaksi"=>"jual_rawat",
									"jkwitansi_date_create"=>$jrawat_date_create
                                );
                                $this->db->insert('jual_kwitansi', $data);
                            }*/
							$data=array(
								"jkwitansi_ref"=>$jrawat_nobukti,
								"jkwitansi_master"=>$jrawat_kwitansi_no,
								"jkwitansi_nilai"=>$jrawat_kwitansi_nilai,
								"jkwitansi_transaksi"=>"jual_rawat",
								"jkwitansi_date_create"=>$jrawat_date_create,
								"jkwitansi_stat_dok"=>'Terbuka'
							);
							$this->db->insert('jual_kwitansi', $data);
                        
                        }else if($jrawat_cara=='card'){
                            /*$sql="SELECT jcard_id FROM jual_card WHERE jcard_ref='$jrawat_nobukti'";
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
                                    "jcard_nilai"=>$jrawat_card_nilai,
                                    "jcard_transaksi"=>"jual_rawat",
									"jcard_date_create"=>$jrawat_date_create
                                    );
                                $this->db->insert('jual_card', $data);
                            }*/
							$data=array(
								"jcard_ref"=>$jrawat_nobukti,
								"jcard_nama"=>$jrawat_card_nama,
								"jcard_edc"=>$jrawat_card_edc,
								"jcard_no"=>$jrawat_card_no,
								"jcard_nilai"=>$jrawat_card_nilai,
								"jcard_transaksi"=>"jual_rawat",
								"jcard_date_create"=>$jrawat_date_create,
								"jcard_stat_dok"=>'Terbuka'
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
                            
                            /*$sql="SELECT jcek_id FROM jual_cek WHERE jcek_ref='$jrawat_nobukti'";
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
                                    "jcek_nilai"=>$jrawat_cek_nilai,
                                    "jcek_transaksi"=>"jual_rawat",
									"jcek_date_create"=>$jrawat_date_create
                                    );
                                $this->db->insert('jual_cek', $data);
                            }*/
							$data=array(
								"jcek_ref"=>$jrawat_nobukti,
								"jcek_nama"=>$jrawat_cek_nama,
								"jcek_no"=>$jrawat_cek_no,
								"jcek_valid"=>$jrawat_cek_valid,
								"jcek_bank"=>$jrawat_cek_bank,
								"jcek_nilai"=>$jrawat_cek_nilai,
								"jcek_transaksi"=>"jual_rawat",
								"jcek_date_create"=>$jrawat_date_create,
								"jcek_stat_dok"=>'Terbuka'
								);
							$this->db->insert('jual_cek', $data);
                            
                        }else if($jrawat_cara=='transfer'){
                            /*$sql="SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='$jrawat_nobukti'";
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
                                    "jtransfer_nilai"=>$jrawat_transfer_nilai,
                                    "jtransfer_transaksi"=>"jual_rawat",
									"jtransfer_date_create"=>$jrawat_date_create
                                    );
                                $this->db->insert('jual_transfer', $data);
                            }*/
							$data=array(
								"jtransfer_ref"=>$jrawat_nobukti,
								"jtransfer_bank"=>$jrawat_transfer_bank,
								"jtransfer_nama"=>$jrawat_transfer_nama,
								"jtransfer_nilai"=>$jrawat_transfer_nilai,
								"jtransfer_transaksi"=>"jual_rawat",
								"jtransfer_date_create"=>$jrawat_date_create,
								"jtransfer_stat_dok"=>'Terbuka'
								);
							$this->db->insert('jual_transfer', $data);
                            
                        }else if($jrawat_cara=='tunai'){
                            /*$sql="SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='$jrawat_nobukti'";
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
                                    "jtunai_ref"=>$jrawat_nobukti,
                                    "jtunai_transaksi"=>"jual_rawat",
									"jtunai_date_create"=>$jrawat_date_create
                                    );
                                $this->db->insert('jual_tunai', $data);
                            }*/
							$data=array(
								"jtunai_nilai"=>$jrawat_tunai_nilai,
								"jtunai_ref"=>$jrawat_nobukti,
								"jtunai_transaksi"=>"jual_rawat",
								"jtunai_date_create"=>$jrawat_date_create,
								"jtunai_stat_dok"=>'Terbuka'
								);
							$this->db->insert('jual_tunai', $data);
                            
                        }else if($jrawat_cara=='voucher'){
                            /*$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jrawat_nobukti'";
                            $rs=$this->db->query($sql);
                            if($rs->num_rows()){
                                /*$get_voucher_cashback=0;
                                $sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jrawat_voucher_no'";
                                $rs=$this->db->query($sql);
                                if($rs->num_rows()){
                                    $rs_record=$rs->row_array();
                                    $get_voucher_cashback=$rs_record["voucher_cashback"];
                                }*/
                                /*$data=array(
                                    "tvoucher_novoucher"=>$jrawat_voucher_no,
                                    "tvoucher_nilai"=>$jrawat_voucher_cashback
                                    );
                                $this->db->where('tvoucher_ref', $jrawat_nobukti);
                                $this->db->update('voucher_terima', $data);
                            }else{
                                /*$get_voucher_cashback=0;
                                $sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jrawat_voucher_no'";
                                $rs=$this->db->query($sql);
                                if($rs->num_rows()){
                                    $rs_record=$rs->row_array();
                                    $get_voucher_cashback=$rs_record["voucher_cashback"];
                                }*/
                                /*$data=array(
                                    "tvoucher_novoucher"=>$jrawat_voucher_no,
                                    "tvoucher_ref"=>$jrawat_nobukti,
                                    "tvoucher_nilai"=>$jrawat_voucher_cashback,
                                    "tvoucher_transaksi"=>"jual_rawat",
									"tvoucher_date_create"=>$jrawat_date_create
                                    );
                                $this->db->insert('voucher_terima', $data);
                            }*/
							$data=array(
								"tvoucher_novoucher"=>$jrawat_voucher_no,
								"tvoucher_ref"=>$jrawat_nobukti,
								"tvoucher_nilai"=>$jrawat_voucher_cashback,
								"tvoucher_transaksi"=>"jual_rawat",
								"tvoucher_date_create"=>$jrawat_date_create,
								"tvoucher_stat_dok"=>'Terbuka'
								);
							$this->db->insert('voucher_terima', $data);
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
                                        $jrawat_kwitansi_nama2=$jpaket_cust;
                                }
                            }
                            
                            $sql="SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='$jrawat_nobukti'";
                            $rs=$this->db->query($sql);
                            if($rs->num_rows()){
                                $data=array(
                                    "jkwitansi_master"=>$jrawat_kwitansi_no2,
                                    "jkwitansi_nilai"=>$jrawat_kwitansi_nilai2
                                );
                                $this->db->where('jkwitansi_ref', $jrawat_nobukti);
                                $this->db->update('jual_kwitansi', $data);
                            }else{
                                $data=array(
                                    "jkwitansi_ref"=>$jrawat_nobukti,
                                    "jkwitansi_master"=>$jrawat_kwitansi_no2,
                                    "jkwitansi_nilai"=>$jrawat_kwitansi_nilai2,
                                    "jkwitansi_transaksi"=>"jual_rawat",
									"jkwitansi_date_create"=>$jrawat_date_create
                                );
                                $this->db->insert('jual_kwitansi', $data);
                            }*/
							$data=array(
								"jkwitansi_ref"=>$jrawat_nobukti,
								"jkwitansi_master"=>$jrawat_kwitansi_no2,
								"jkwitansi_nilai"=>$jrawat_kwitansi_nilai2,
								"jkwitansi_transaksi"=>"jual_rawat",
								"jkwitansi_date_create"=>$jrawat_date_create,
								"jkwitansi_stat_dok"=>'Terbuka'
							);
							$this->db->insert('jual_kwitansi', $data);
                        
                        }else if($jrawat_cara2=='card'){
                            /*$sql="SELECT jcard_id FROM jual_card WHERE jcard_ref='$jrawat_nobukti'";
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
                                    "jcard_nilai"=>$jrawat_card_nilai2,
                                    "jcard_transaksi"=>"jual_rawat",
									"jcard_date_create"=>$jrawat_date_create
                                    );
                                $this->db->insert('jual_card', $data);
                            }*/
							$data=array(
								"jcard_ref"=>$jrawat_nobukti,
								"jcard_nama"=>$jrawat_card_nama2,
								"jcard_edc"=>$jrawat_card_edc2,
								"jcard_no"=>$jrawat_card_no2,
								"jcard_nilai"=>$jrawat_card_nilai2,
								"jcard_transaksi"=>"jual_rawat",
								"jcard_date_create"=>$jrawat_date_create,
								"jcard_stat_dok"=>'Terbuka'
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
                            
                            /*$sql="SELECT jcek_id FROM jual_cek WHERE jcek_ref='$jrawat_nobukti'";
                            $rs=$this->db->query($sql);
                            if($rs->num_rows()){
                                $data=array(
                                    "jcek_nama"=>$jrawat_cek_nama2,
                                    "jcek_no"=>$jrawat_cek_no2,
                                    "jcek_valid"=>$jrawat_cek_valid2,
                                    "jcek_bank"=>$jrawat_cek_bank2,
                                    "jcek_nilai"=>$jrawat_cek_nilai2
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
                                    "jcek_nilai"=>$jrawat_cek_nilai2,
                                    "jcek_transaksi"=>"jual_rawat",
									"jcek_date_create"=>$jrawat_date_create
                                    );
                                $this->db->insert('jual_cek', $data);
                            }*/
							$data=array(
								"jcek_ref"=>$jrawat_nobukti,
								"jcek_nama"=>$jrawat_cek_nama2,
								"jcek_no"=>$jrawat_cek_no2,
								"jcek_valid"=>$jrawat_cek_valid2,
								"jcek_bank"=>$jrawat_cek_bank2,
								"jcek_nilai"=>$jrawat_cek_nilai2,
								"jcek_transaksi"=>"jual_rawat",
								"jcek_date_create"=>$jrawat_date_create,
								"jcek_stat_dok"=>'Terbuka'
								);
							$this->db->insert('jual_cek', $data);
                            
                        }else if($jrawat_cara2=='transfer'){
                            /*$sql="SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='$jrawat_nobukti'";
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
                                    "jtransfer_nilai"=>$jrawat_transfer_nilai2,
                                    "jtransfer_transaksi"=>"jual_rawat",
									"jtransfer_date_create"=>$jrawat_date_create
                                    );
                                $this->db->insert('jual_transfer', $data);
                            }*/
							$data=array(
								"jtransfer_ref"=>$jrawat_nobukti,
								"jtransfer_bank"=>$jrawat_transfer_bank2,
								"jtransfer_nama"=>$jrawat_transfer_nama2,
								"jtransfer_nilai"=>$jrawat_transfer_nilai2,
								"jtransfer_transaksi"=>"jual_rawat",
								"jtransfer_date_create"=>$jrawat_date_create,
								"jtransfer_stat_dok"=>'Terbuka'
								);
							$this->db->insert('jual_transfer', $data);
                            
                        }else if($jrawat_cara2=='tunai'){
                            /*$sql="SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='$jrawat_nobukti'";
                            $rs=$this->db->query($sql);
                            if($rs->num_rows()){
                                $data=array(
                                    "jtunai_nilai"=>$jrawat_tunai_nilai2
                                    );
                                $this->db->where('jtunai_ref', $jrawat_nobukti);
                                $this->db->update('jual_tunai', $data);
                            }else{
                                $data=array(
                                    "jtunai_nilai"=>$jrawat_tunai_nilai2,
                                    "jtunai_ref"=>$jrawat_nobukti,
                                    "jtunai_transaksi"=>"jual_rawat",
									"jtunai_date_create"=>$jrawat_date_create
                                    );
                                $this->db->insert('jual_tunai', $data);
                            }*/
							$data=array(
								"jtunai_nilai"=>$jrawat_tunai_nilai2,
								"jtunai_ref"=>$jrawat_nobukti,
								"jtunai_transaksi"=>"jual_rawat",
								"jtunai_date_create"=>$jrawat_date_create,
								"jtunai_stat_dok"=>'Terbuka'
								);
							$this->db->insert('jual_tunai', $data);
                            
                        }else if($jrawat_cara2=='voucher'){
                            /*$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jrawat_nobukti'";
                            $rs=$this->db->query($sql);
                            if($rs->num_rows()){
                                /*$get_voucher_cashback=0;
                                $sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jrawat_voucher_no'";
                                $rs=$this->db->query($sql);
                                if($rs->num_rows()){
                                    $rs_record=$rs->row_array();
                                    $get_voucher_cashback=$rs_record["voucher_cashback"];
                                }*/
                                /*$data=array(
                                    "tvoucher_novoucher"=>$jrawat_voucher_no2,
                                    "tvoucher_nilai"=>$jrawat_voucher_cashback2
                                    );
                                $this->db->where('tvoucher_ref', $jrawat_nobukti);
                                $this->db->update('voucher_terima', $data);
                            }else{
                                /*$get_voucher_cashback=0;
                                $sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jrawat_voucher_no'";
                                $rs=$this->db->query($sql);
                                if($rs->num_rows()){
                                    $rs_record=$rs->row_array();
                                    $get_voucher_cashback=$rs_record["voucher_cashback"];
                                }*/
                                /*$data=array(
                                    "tvoucher_novoucher"=>$jrawat_voucher_no2,
                                    "tvoucher_ref"=>$jrawat_nobukti,
                                    "tvoucher_nilai"=>$jrawat_voucher_cashback2,
                                    "tvoucher_transaksi"=>"jual_rawat",
									"tvoucher_date_create"=>$jrawat_date_create
                                    );
                                $this->db->insert('voucher_terima', $data);
                            }*/
							$data=array(
								"tvoucher_novoucher"=>$jrawat_voucher_no2,
								"tvoucher_ref"=>$jrawat_nobukti,
								"tvoucher_nilai"=>$jrawat_voucher_cashback2,
								"tvoucher_transaksi"=>"jual_rawat",
								"tvoucher_date_create"=>$jrawat_date_create,
								"tvoucher_stat_dok"=>'Terbuka'
								);
							$this->db->insert('voucher_terima', $data);
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
                                        $jrawat_kwitansi_nama3=$jpaket_cust;
                                }
                            }
                            
                            $sql="SELECT jkwitansi_id FROM jual_kwitansi WHERE jkwitansi_ref='$jrawat_nobukti'";
                            $rs=$this->db->query($sql);
                            if($rs->num_rows()){
                                $data=array(
                                    "jkwitansi_master"=>$jrawat_kwitansi_no3,
                                    "jkwitansi_nilai"=>$jrawat_kwitansi_nilai3
                                );
                                $this->db->where('jkwitansi_ref', $jrawat_nobukti);
                                $this->db->update('jual_kwitansi', $data);
                            }else{
                                $data=array(
                                    "jkwitansi_ref"=>$jrawat_nobukti,
                                    "jkwitansi_master"=>$jrawat_kwitansi_no3,
                                    "jkwitansi_nilai"=>$jrawat_kwitansi_nilai3,
                                    "jkwitansi_transaksi"=>"jual_rawat",
									"jkwitansi_date_create"=>$jrawat_date_create
                                );
                                $this->db->insert('jual_kwitansi', $data);
                            }*/
							$data=array(
								"jkwitansi_ref"=>$jrawat_nobukti,
								"jkwitansi_master"=>$jrawat_kwitansi_no3,
								"jkwitansi_nilai"=>$jrawat_kwitansi_nilai3,
								"jkwitansi_transaksi"=>"jual_rawat",
								"jkwitansi_date_create"=>$jrawat_date_create,
								"jkwitansi_stat_dok"=>'Terbuka'
							);
							$this->db->insert('jual_kwitansi', $data);
                        
                        }else if($jrawat_cara3=='card'){
                            /*$sql="SELECT jcard_id FROM jual_card WHERE jcard_ref='$jrawat_nobukti'";
                            $rs=$this->db->query($sql);
                            if($rs->num_rows()){
                                $data=array(
                                    "jcard_nama"=>$jrawat_card_nama3,
                                    "jcard_edc"=>$jrawat_card_edc3,
                                    "jcard_no"=>$jrawat_card_no3,
                                    "jcard_nilai"=>$jrawat_card_nilai3
                                    );
                                $this->db->where('jcard_ref', $jrawat_nobukti);
                                $this->db->update('jual_card', $data);
                            }else{
                                $data=array(
                                    "jcard_ref"=>$jrawat_nobukti,
                                    "jcard_nama"=>$jrawat_card_nama3,
                                    "jcard_edc"=>$jrawat_card_edc3,
                                    "jcard_no"=>$jrawat_card_no3,
                                    "jcard_nilai"=>$jrawat_card_nilai3,
                                    "jcard_transaksi"=>"jual_rawat",
									"jcard_date_create"=>$jrawat_date_create
                                    );
                                $this->db->insert('jual_card', $data);
                            }*/
							$data=array(
								"jcard_ref"=>$jrawat_nobukti,
								"jcard_nama"=>$jrawat_card_nama3,
								"jcard_edc"=>$jrawat_card_edc3,
								"jcard_no"=>$jrawat_card_no3,
								"jcard_nilai"=>$jrawat_card_nilai3,
								"jcard_transaksi"=>"jual_rawat",
								"jcard_date_create"=>$jrawat_date_create,
								"jcard_stat_dok"=>'Terbuka'
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
                            
                            /*$sql="SELECT jcek_id FROM jual_cek WHERE jcek_ref='$jrawat_nobukti'";
                            $rs=$this->db->query($sql);
                            if($rs->num_rows()){
                                $data=array(
                                    "jcek_nama"=>$jrawat_cek_nama3,
                                    "jcek_no"=>$jrawat_cek_no3,
                                    "jcek_valid"=>$jrawat_cek_valid3,
                                    "jcek_bank"=>$jrawat_cek_bank3,
                                    "jcek_nilai"=>$jrawat_cek_nilai3
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
                                    "jcek_nilai"=>$jrawat_cek_nilai3,
                                    "jcek_transaksi"=>"jual_rawat",
									"jcek_date_create"=>$jrawat_date_create
                                    );
                                $this->db->insert('jual_cek', $data);
                            }*/
							$data=array(
								"jcek_ref"=>$jrawat_nobukti,
								"jcek_nama"=>$jrawat_cek_nama3,
								"jcek_no"=>$jrawat_cek_no3,
								"jcek_valid"=>$jrawat_cek_valid3,
								"jcek_bank"=>$jrawat_cek_bank3,
								"jcek_nilai"=>$jrawat_cek_nilai3,
								"jcek_transaksi"=>"jual_rawat",
								"jcek_date_create"=>$jrawat_date_create,
								"jcek_stat_dok"=>'Terbuka'
								);
							$this->db->insert('jual_cek', $data);
                            
                        }else if($jrawat_cara3=='transfer'){
                            /*$sql="SELECT jtransfer_id FROM jual_transfer WHERE jtransfer_ref='$jrawat_nobukti'";
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
                                    "jtransfer_nilai"=>$jrawat_transfer_nilai3,
                                    "jtransfer_transaksi"=>"jual_rawat",
									"jtransfer_date_create"=>$jrawat_date_create
                                    );
                                $this->db->insert('jual_transfer', $data);
                            }*/
							$data=array(
								"jtransfer_ref"=>$jrawat_nobukti,
								"jtransfer_bank"=>$jrawat_transfer_bank3,
								"jtransfer_nama"=>$jrawat_transfer_nama3,
								"jtransfer_nilai"=>$jrawat_transfer_nilai3,
								"jtransfer_transaksi"=>"jual_rawat",
								"jtransfer_date_create"=>$jrawat_date_create,
								"jtransfer_stat_dok"=>'Terbuka'
								);
							$this->db->insert('jual_transfer', $data);
                            
                        }else if($jrawat_cara3=='tunai'){
                            /*$sql="SELECT jtunai_id FROM jual_tunai WHERE jtunai_ref='$jrawat_nobukti'";
                            $rs=$this->db->query($sql);
                            if($rs->num_rows()){
                                $data=array(
                                    "jtunai_nilai"=>$jrawat_tunai_nilai3
                                    );
                                $this->db->where('jtunai_ref', $jrawat_nobukti);
                                $this->db->update('jual_tunai', $data);
                            }else{
                                $data=array(
                                    "jtunai_nilai"=>$jrawat_tunai_nilai3,
                                    "jtunai_ref"=>$jrawat_nobukti,
                                    "jtunai_transaksi"=>"jual_rawat",
									"jtunai_date_create"=>$jrawat_date_create
                                    );
                                $this->db->insert('jual_tunai', $data);
                            }*/
							$data=array(
								"jtunai_nilai"=>$jrawat_tunai_nilai3,
								"jtunai_ref"=>$jrawat_nobukti,
								"jtunai_transaksi"=>"jual_rawat",
								"jtunai_date_create"=>$jrawat_date_create,
								"jtunai_stat_dok"=>'Terbuka'
								);
							$this->db->insert('jual_tunai', $data);
                            
                        }else if($jrawat_cara3=='voucher'){
                            /*$sql="SELECT tvoucher_id FROM voucher_terima WHERE tvoucher_ref='$jrawat_nobukti'";
                            $rs=$this->db->query($sql);
                            if($rs->num_rows()){
                                /*$get_voucher_cashback=0;
                                $sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jrawat_voucher_no'";
                                $rs=$this->db->query($sql);
                                if($rs->num_rows()){
                                    $rs_record=$rs->row_array();
                                    $get_voucher_cashback=$rs_record["voucher_cashback"];
                                }*/
                                /*$data=array(
                                    "tvoucher_novoucher"=>$jrawat_voucher_no3,
                                    "tvoucher_nilai"=>$jrawat_voucher_cashback3
                                    );
                                $this->db->where('tvoucher_ref', $jrawat_nobukti);
                                $this->db->update('voucher_terima', $data);
                            }else{
                                /*$get_voucher_cashback=0;
                                $sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jrawat_voucher_no'";
                                $rs=$this->db->query($sql);
                                if($rs->num_rows()){
                                    $rs_record=$rs->row_array();
                                    $get_voucher_cashback=$rs_record["voucher_cashback"];
                                }*/
                                /*$data=array(
                                    "tvoucher_novoucher"=>$jrawat_voucher_no3,
                                    "tvoucher_ref"=>$jrawat_nobukti,
                                    "tvoucher_nilai"=>$jrawat_voucher_cashback3,
                                    "tvoucher_transaksi"=>"jual_rawat",
									"tvoucher_date_create"=>$jrawat_date_create
                                    );
                                $this->db->insert('voucher_terima', $data);
                            }*/
							$data=array(
								"tvoucher_novoucher"=>$jrawat_voucher_no3,
								"tvoucher_ref"=>$jrawat_nobukti,
								"tvoucher_nilai"=>$jrawat_voucher_cashback3,
								"tvoucher_transaksi"=>"jual_rawat",
								"tvoucher_date_create"=>$jrawat_date_create,
								"tvoucher_stat_dok"=>'Terbuka'
								);
							$this->db->insert('voucher_terima', $data);
                        }
                    }
                    /*if($cetak_jrawat==1){
                        return $jrawat_id;
                    }else{
                        return '1';
                    }*/
                    //return '1';
                    if($this->db->affected_rows() || $this->db->affected_rows()==0){
						if($cetak_jrawat==1){
							$this->master_jual_rawat_status_update($jrawat_id);
                            $this->member_point_update($jrawat_id);
							$this->membership_insert($jrawat_id);
                            return $jrawat_id;
                        }else{
                            return '0';
                        }
                        /*if($cetak_jrawat==1 && $jrawat_bayar>0){
                            $this->member_point_update($jrawat_id);
                            return $jrawat_id;
                        }else{
                            return '0';
                        }*/
                    }else{
                        return '-1';
                    }
                }
                else{
                    return '-1';
                }
			}elseif((substr($jrawat_nobukti,0,2)=='') && $cetak_jrawat==1){
				return '-3';
			}elseif((substr($jrawat_nobukti,0,2)=='PK') && $cetak_jrawat<>1 && $jrawat_stat_dok=='Batal'){
				return '-4';
			}
		}
		
		//function for create new record
		function master_jual_rawat_create($jrawat_cust ,$jrawat_tanggal ,$jrawat_diskon ,$jrawat_cara ,$jrawat_stat_dok, $jrawat_cara2 ,$jrawat_cara3 ,$jrawat_keterangan , $jrawat_cashback, $jrawat_tunai_nilai, $jrawat_tunai_nilai2, $jrawat_tunai_nilai3, $jrawat_voucher_no, $jrawat_voucher_cashback, $jrawat_voucher_no2, $jrawat_voucher_cashback2, $jrawat_voucher_no3, $jrawat_voucher_cashback3, $jrawat_bayar, $jrawat_subtotal, $jrawat_hutang, $jrawat_kwitansi_no, $jrawat_kwitansi_nama, $jrawat_kwitansi_nilai, $jrawat_kwitansi_no2, $jrawat_kwitansi_nama2, $jrawat_kwitansi_nilai2, $jrawat_kwitansi_no3, $jrawat_kwitansi_nama3, $jrawat_kwitansi_nilai3, $jrawat_card_nama, $jrawat_card_edc, $jrawat_card_no, $jrawat_card_nilai, $jrawat_card_nama2, $jrawat_card_edc2, $jrawat_card_no2, $jrawat_card_nilai2, $jrawat_card_nama3, $jrawat_card_edc3, $jrawat_card_no3, $jrawat_card_nilai3, $jrawat_cek_nama, $jrawat_cek_no, $jrawat_cek_valid, $jrawat_cek_bank, $jrawat_cek_nilai, $jrawat_cek_nama2, $jrawat_cek_no2, $jrawat_cek_valid2, $jrawat_cek_bank2, $jrawat_cek_nilai2, $jrawat_cek_nama3, $jrawat_cek_no3, $jrawat_cek_valid3, $jrawat_cek_bank3, $jrawat_cek_nilai3, $jrawat_transfer_bank, $jrawat_transfer_nama, $jrawat_transfer_nilai, $jrawat_transfer_bank2, $jrawat_transfer_nama2, $jrawat_transfer_nilai2, $jrawat_transfer_bank3, $jrawat_transfer_nama3, $jrawat_transfer_nilai3, $cetak_jrawat){
			$pattern="PR/".date("ym")."-";
			$jrawat_nobukti=$this->m_public_function->get_kode_1('master_jual_rawat','jrawat_nobukti',$pattern,12);
			
			if ($jrawat_stat_dok=="")
				$jrawat_stat_dok = "Terbuka";
			
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
				"jrawat_keterangan"=>$jrawat_keterangan,
				"jrawat_stat_dok"=>$jrawat_stat_dok,
				"jrawat_creator"=>$_SESSION[SESSION_USERID]
			);
			if($jrawat_cara2!=null)
				$data["jrawat_cara2"]=$jrawat_cara2;
			if($jrawat_cara3!=null)
				$data["jrawat_cara3"]=$jrawat_cara3;
			$this->db->insert('master_jual_rawat', $data); 
			if($this->db->affected_rows()){
				//Ambil db.master_jual_paket.jpaket_date_create untuk dimasukkan ke Cara Bayar
				$sql = "SELECT jrawat_date_create FROM master_jual_rawat WHERE jrawat_nobukti='$jrawat_nobukti'";
				$rs = $this->db->query($sql);
				if($this->db->affected_rows()){
					$record = $rs->row_array();
					$jrawat_date_create = $record['jrawat_date_create'];
				}
				
				//delete all transaksi
				$sql="delete from jual_kwitansi where jkwitansi_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_card where jcard_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_cek where jcek_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_transfer where jtransfer_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from jual_tunai where jtunai_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				$sql="delete from voucher_terima where tvoucher_ref='".$jrawat_nobukti."'";
				$this->db->query($sql);
				
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
							"jkwitansi_master"=>$jrawat_kwitansi_no,
							"jkwitansi_nilai"=>$jrawat_kwitansi_nilai,
							"jkwitansi_ref"=>$jrawat_nobukti,
							"jkwitansi_transaksi"=>"jual_rawat",
							"jkwitansi_date_create"=>$jrawat_date_create,
							"jkwitansi_stat_dok"=>'Terbuka'
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jrawat_cara=='card'){
						
						$data=array(
							"jcard_nama"=>$jrawat_card_nama,
							"jcard_edc"=>$jrawat_card_edc,
							"jcard_no"=>$jrawat_card_no,
							"jcard_nilai"=>$jrawat_card_nilai,
							"jcard_ref"=>$jrawat_nobukti,
							"jcard_transaksi"=>"jual_rawat",
							"jcard_date_create"=>$jrawat_date_create,
							"jcard_stat_dok"=>'Terbuka'
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
							"jcek_ref"=>$jrawat_nobukti,
							"jcek_transaksi"=>"jual_rawat",
							"jcek_date_create"=>$jrawat_date_create,
							"jcek_stat_dok"=>'Terbuka'
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jrawat_cara=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jrawat_transfer_bank,
							"jtransfer_nama"=>$jrawat_transfer_nama,
							"jtransfer_nilai"=>$jrawat_transfer_nilai,
							"jtransfer_ref"=>$jrawat_nobukti,
							"jtransfer_transaksi"=>"jual_rawat",
							"jtransfer_date_create"=>$jrawat_date_create,
							"jtransfer_stat_dok"=>'Terbuka'
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jrawat_cara=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jrawat_tunai_nilai,
							"jtunai_ref"=>$jrawat_nobukti,
							"jtunai_transaksi"=>"jual_rawat",
							"jtunai_date_create"=>$jrawat_date_create,
							"jtunai_stat_dok"=>'Terbuka'
							);
						$this->db->insert('jual_tunai', $data); 
					}else if($jrawat_cara=='voucher'){
						/*$get_voucher_cashback=0;
						$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jrawat_voucher_no'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$rs_record=$rs->row_array();
							$get_voucher_cashback=$rs_record["voucher_cashback"];
						}*/
						$data=array(
							"tvoucher_novoucher"=>$jrawat_voucher_no,
							"tvoucher_ref"=>$jrawat_nobukti,
							"tvoucher_nilai"=>$jrawat_voucher_cashback,
							"tvoucher_transaksi"=>"jual_rawat",
							"tvoucher_date_create"=>$jrawat_date_create,
							"tvoucher_stat_dok"=>'Terbuka'
							);
						$this->db->insert('voucher_terima', $data); 
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
							"jkwitansi_master"=>$jrawat_kwitansi_no2,
							"jkwitansi_nilai"=>$jrawat_hutang,
							"jkwitansi_ref"=>$jrawat_nobukti,
							"jkwitansi_transaksi"=>"jual_rawat",
							"jkwitansi_date_create"=>$jrawat_date_create,
							"jkwitansi_stat_dok"=>'Terbuka'
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jrawat_cara2=='card'){
						$data=array(
							"jcard_nama"=>$jrawat_card_nama2,
							"jcard_edc"=>$jrawat_card_edc2,
							"jcard_no"=>$jrawat_card_no2,
							"jcard_nilai"=>$jrawat_card_nilai2,
							"jcard_ref"=>$jrawat_nobukti,
							"jcard_transaksi"=>"jual_rawat",
							"jcard_date_create"=>$jrawat_date_create,
							"jcard_stat_dok"=>'Terbuka'
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
							"jcek_ref"=>$jrawat_nobukti,
							"jcek_transaksi"=>"jual_rawat",
							"jcek_date_create"=>$jrawat_date_create,
							"jcek_stat_dok"=>'Terbuka'
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jrawat_cara2=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jrawat_transfer_bank2,
							"jtransfer_nama"=>$jrawat_transfer_nama2,
							"jtransfer_nilai"=>$jrawat_transfer_nilai2,
							"jtransfer_ref"=>$jrawat_nobukti,
							"jtransfer_transaksi"=>"jual_rawat",
							"jtransfer_date_create"=>$jrawat_date_create,
							"jtransfer_stat_dok"=>'Terbuka'
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jrawat_cara2=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jrawat_tunai_nilai2,
							"jtunai_ref"=>$jrawat_nobukti,
							"jtunai_transaksi"=>"jual_rawat",
							"jtunai_date_create"=>$jrawat_date_create,
							"jtunai_stat_dok"=>'Terbuka'
							);
						$this->db->insert('jual_tunai', $data); 
					}else if($jrawat_cara=='voucher'){
						/*$get_voucher_cashback=0;
						$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jrawat_voucher_no'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$rs_record=$rs->row_array();
							$get_voucher_cashback=$rs_record["voucher_cashback"];
						}*/
						$data=array(
							"tvoucher_novoucher"=>$jrawat_voucher_no2,
							"tvoucher_ref"=>$jrawat_nobukti,
							"tvoucher_nilai"=>$jrawat_voucher_cashback2,
							"tvoucher_transaksi"=>"jual_rawat",
							"tvoucher_date_create"=>$jrawat_date_create,
							"tvoucher_stat_dok"=>'Terbuka'
							);
						$this->db->insert('voucher_terima', $data); 
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
							"jkwitansi_master"=>$jrawat_kwitansi_no3,
							"jkwitansi_nilai"=>$jrawat_hutang,
							"jkwitansi_ref"=>$jrawat_nobukti,
							"jkwitansi_transaksi"=>"jual_rawat",
							"jkwitansi_date_create"=>$jrawat_date_create,
							"jkwitansi_stat_dok"=>'Terbuka'
						);
						$this->db->insert('jual_kwitansi', $data); 
					
					}else if($jrawat_cara3=='card'){
						
						$data=array(
							"jcard_nama"=>$jrawat_card_nama3,
							"jcard_edc"=>$jrawat_card_edc3,
							"jcard_no"=>$jrawat_card_no3,
							"jcard_nilai"=>$jrawat_hutang,
							"jcard_ref"=>$jrawat_nobukti,
							"jcard_transaksi"=>"jual_rawat",
							"jcard_date_create"=>$jrawat_date_create,
							"jcard_stat_dok"=>'Terbuka'
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
							"jcek_ref"=>$jrawat_nobukti,
							"jcek_transaksi"=>"jual_rawat",
							"jcek_date_create"=>$jrawat_date_create,
							"jcek_stat_dok"=>'Terbuka'
							);
						$this->db->insert('jual_cek', $data); 
					}else if($jrawat_cara3=='transfer'){
						
						$data=array(
							"jtransfer_bank"=>$jrawat_transfer_bank3,
							"jtransfer_nama"=>$jrawat_transfer_nama3,
							"jtransfer_nilai"=>$jrawat_transfer_nilai3,
							"jtransfer_ref"=>$jrawat_nobukti,
							"jtransfer_transaksi"=>"jual_rawat",
							"jtransfer_date_create"=>$jrawat_date_create,
							"jtransfer_stat_dok"=>'Terbuka'
							);
						$this->db->insert('jual_transfer', $data); 
					}else if($jrawat_cara3=='tunai'){
						
						$data=array(
							"jtunai_nilai"=>$jrawat_tunai_nilai3,
							"jtunai_ref"=>$jrawat_nobukti,
							"jtunai_transaksi"=>"jual_rawat",
							"jtunai_date_create"=>$jrawat_date_create,
							"jtunai_stat_dok"=>'Terbuka'
							);
						$this->db->insert('jual_tunai', $data); 
					}else if($jrawat_cara=='voucher'){
						/*$get_voucher_cashback=0;
						$sql="SELECT voucher_cashback FROM voucher_kupon LEFT JOIN voucher ON(kvoucher_master=voucher_id) WHERE kvoucher_nomor='$jrawat_voucher_no'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							$rs_record=$rs->row_array();
							$get_voucher_cashback=$rs_record["voucher_cashback"];
						}*/
						$data=array(
							"tvoucher_novoucher"=>$jrawat_voucher_no,
							"tvoucher_ref"=>$jrawat_nobukti,
							"tvoucher_nilai"=>$jrawat_voucher_cashback3,
							"tvoucher_transaksi"=>"jual_rawat",
							"tvoucher_date_create"=>$jrawat_date_create,
							"tvoucher_stat_dok"=>'Terbuka'
							);
						$this->db->insert('voucher_terima', $data); 
					}
				}
				
				if($this->db->affected_rows() || $this->db->affected_rows()==0){
					if($cetak_jrawat==1 && $jrawat_bayar>0){
						$this->master_jual_rawat_status_update($jrawat_id);
						$this->member_point_update($jrawat_id);
						$this->membership_insert($jrawat_id);
						return $jrawat_id;
					}else{
						return '0';
					}
				}else{
					return '-1';
				}
			}
			else
				return '-1';
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
		
		function master_jual_rawat_batal($jrawat_nobukti){
			$date_now = date('Y-m-d');
			$datetime_now = date('Y-m-d H:i:s');
			$jrawat_id = 0;
			
			$sql = "SELECT jrawat_id, jrawat_revised FROM master_jual_rawat WHERE jrawat_nobukti='$jrawat_nobukti'";
			$rs = $this->db->query($sql);
			if($rs->num_rows()){
				$record = $rs->row_array();
				$jrawat_id = $record['jrawat_id'];
			}
			
            $sql = "UPDATE master_jual_rawat
                SET jrawat_stat_dok='Batal'
                    ,jrawat_update='".@$_SESSION[SESSION_USERID]."'
                    ,jrawat_date_update='".$datetime_now."'
                    ,jrawat_revised=jrawat_revised+1
                WHERE jrawat_id=".$jrawat_id."
                    AND jrawat_tanggal='".$date_now."' ";
            $this->db->query($sql);
			if($this->db->affected_rows()){
				//* udpating db.customer.cust_point ==> proses mengurangi jumlah poin (dikurangi dengan db.master_jual_produk.jproduk_point yg sudah dimasukkan ketika cetak faktur), karena dilakukan pembatalan /
				$this->member_point_batal($jrawat_id);
				$this->membership_insert($jrawat_id);
				$this->cara_bayar_batal($jrawat_id);
				return '1';
			}else{
				return '0';
			}
		}
		
		//function for advanced search record
		function master_jual_rawat_search($jrawat_id ,$jrawat_nobukti ,$jrawat_cust ,$jrawat_diskon , $jrawat_stat_dok, $jrawat_cashback ,$jrawat_voucher ,$jrawat_cara ,$jrawat_bayar ,$jrawat_keterangan ,$jrawat_tgl_start ,$jrawat_tgl_end ,$start,$end){
			//pencarian perawatan satuan di db.detail_jual_rawat
			$query = "SELECT
                    jrawat_id,
                    jrawat_nobukti,
                    vu_jrawat_pr.cust_nama,
                    jrawat_cust,
                    vu_jrawat_pr.cust_no,
                    vu_jrawat_pr.cust_member,
					/*vu_jrawat_pr.member_no,
					vu_jrawat_pr.member_valid,*/
                    jrawat_tanggal,
                    jrawat_diskon,
                    jrawat_cashback,
                    jrawat_cara,
                    jrawat_cara2,
                    jrawat_cara3,
                    IF(vu_jrawat_pr.jrawat_totalbiaya!=0, vu_jrawat_pr.jrawat_totalbiaya, vu_jrawat_totalbiaya.jrawat_totalbiaya) AS jrawat_totalbiaya,
                    jrawat_bayar,
                    jrawat_keterangan,
                    jrawat_stat_dok,
                    jrawat_creator,
                    jrawat_date_create,
                    jrawat_update,
                    jrawat_date_update,
                    jrawat_revised,
                    keterangan_paket,
                    dpaket_id
                FROM vu_jrawat_pr
                LEFT JOIN vu_jrawat_totalbiaya ON(vu_jrawat_totalbiaya.drawat_master=vu_jrawat_pr.jrawat_id)";
				
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
			if($jrawat_cara!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jrawat_cara LIKE '%".$jrawat_cara."%'";
			};
			if($jrawat_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jrawat_keterangan LIKE '%".$jrawat_keterangan."%'";
			};
			if($jrawat_stat_dok!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jrawat_stat_dok = '".$jrawat_stat_dok."'";
			};
			
			$query .= " ORDER BY jrawat_date_create DESC";
			
			
			//pencarian pengambilan paket di db.detail_ambil_paket
			$query2 = "SELECT
                    jrawat_id,
                    jrawat_nobukti,
                    vu_jrawat_pk.cust_nama,
                    jrawat_cust,
                    vu_jrawat_pk.cust_no,
                    vu_jrawat_pk.cust_member,
                    jrawat_tanggal,
                    jrawat_diskon,
                    jrawat_cashback,
                    jrawat_cara,
                    jrawat_cara2,
                    jrawat_cara3,
                    jrawat_totalbiaya,
                    jrawat_bayar,
                    jrawat_keterangan,
                    jrawat_creator,
                    jrawat_date_create,
                    jrawat_update,
                    jrawat_date_update,
                    jrawat_revised,
                    keterangan_paket,
                    dpaket_id,
                    dapaket_stat_dok AS jrawat_stat_dok
                FROM vu_jrawat_pk ";
			
			if($jrawat_id!=''){
				$query2.=eregi("WHERE",$query2)?" AND ":" WHERE ";
				$query2.= " jrawat_id LIKE '%".$jrawat_id."%'";
			};
			if($jrawat_nobukti!=''){
				$query2.=eregi("WHERE",$query2)?" AND ":" WHERE ";
				$query2.= " jrawat_nobukti LIKE '%".$jrawat_nobukti."%'";
			};
			if($jrawat_cust!=''){
				$query2.=eregi("WHERE",$query2)?" AND ":" WHERE ";
				$query2.= " jrawat_cust = '".$jrawat_cust."'";
			};
			
			if($jrawat_tgl_start!='' && $jrawat_tgl_end!=''){
				$query2.=eregi("WHERE",$query2)?" AND ":" WHERE ";
				//$query2.= " jrawat_tanggal BETWEEN '".$jrawat_tgl_start."' AND '".$jrawat_tgl_end."'";
				$query2.= " date_format(vu_jrawat_pk.jrawat_date_create,'%Y-%m-%d') BETWEEN '".$jrawat_tgl_start."' AND '".$jrawat_tgl_end."'
					AND vu_jrawat_pk.jrawat_cust NOT IN(
                        SELECT vu_jrawat_pr.jrawat_cust
                        FROM vu_jrawat_pr
                        WHERE date_format(vu_jrawat_pr.jrawat_date_create,'%Y-%m-%d') BETWEEN '".$jrawat_tgl_start."' AND '".$jrawat_tgl_end."')";
			}else if($jrawat_tgl_start!='' && $jrawat_tgl_end==''){
				$query2.=eregi("WHERE",$query2)?" AND ":" WHERE ";
				//$query2.= " jrawat_tanggal='".$jrawat_tgl_start."'";
				$query2.= " date_format(vu_jrawat_pk.jrawat_date_create,'%Y-%m-%d') = '".$jrawat_tgl_start."' 
					AND vu_jrawat_pk.jrawat_cust NOT IN(
                        SELECT vu_jrawat_pr.jrawat_cust
                        FROM vu_jrawat_pr
                        WHERE date_format(vu_jrawat_pr.jrawat_date_create,'%Y-%m-%d') = '".$jrawat_tgl_start."' )";
			}
			
			if($jrawat_cara!=''){
				$query2.=eregi("WHERE",$query2)?" AND ":" WHERE ";
				$query2.= " jrawat_cara LIKE '%".$jrawat_cara."%'";
			};
			if($jrawat_keterangan!=''){
				$query2.=eregi("WHERE",$query2)?" AND ":" WHERE ";
				$query2.= " jrawat_keterangan LIKE '%".$jrawat_keterangan."%'";
			};
			if($jrawat_stat_dok!=''){
				$query2.=eregi("WHERE",$query2)?" AND ":" WHERE ";
				$query2.= " vu_jrawat_pk.dapaket_stat_dok = '".$jrawat_stat_dok."'";
			};
			
			$query2 .= " ORDER BY vu_jrawat_pk.dapaket_stat_dok DESC";
			
			$nbrows=0;
			$nbrows2=0;
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			
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
				$nbrows=$nbrows+$nbrows2;
                $jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
			
			
			/*$result = $this->db->query($query);
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
			}*/
		}
		
		//function for print record
		function master_jual_rawat_print($jrawat_id ,$jrawat_nobukti ,$jrawat_cust ,$jrawat_tanggal ,$jrawat_diskon ,$jrawat_cashback ,$jrawat_voucher ,$jrawat_cara ,$jrawat_bayar ,$jrawat_keterangan ,$option,$filter){
			//full query
			$query="select * from master_jual_rawat";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (jrawat_nobukti LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR cust_member LIKE '%".addslashes($filter)."%')";
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
					$query.= " jrawat_tanggal = '".$jrawat_tanggal."'";
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
				$query .= " (jrawat_nobukti LIKE '%".addslashes($filter)."%' OR cust_no LIKE '%".addslashes($filter)."%' OR cust_nama LIKE '%".addslashes($filter)."%' OR cust_member LIKE '%".addslashes($filter)."%')";
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
					$query.= " jrawat_tanggal = '".$jrawat_tanggal."'";
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
		
		function master_jual_rawat_status_update($jrawat_id){
			$datetime_now = date('Y-m-d H:i:s');
			$sql="UPDATE master_jual_rawat
                SET jrawat_stat_dok='Tertutup'
                    ,jrawat_update='".@$_SESSION[SESSION_USERID]."'
                    ,jrawat_date_update='".$datetime_now."'
                    ,jrawat_revised=jrawat_revised+1
                WHERE jrawat_id='$jrawat_id'";
			$this->db->query($sql);
			
			/*$dtu_jrawat=array(
			"jrawat_stat_dok"=>'Tertutup'
			);
			$this->db->where('jrawat_id', $jrawat_id);
			$this->db->update('master_jual_rawat', $dtu_jrawat);*/
		}
		
		function detail_ambil_paket_status_update($dapaket_id){
			$dtu_dapaket=array(
			"dapaket_stat_dok"=>'Tertutup'
			);
			$this->db->where('dapaket_id', $dapaket_id);
			$this->db->update('detail_ambil_paket', $dtu_dapaket);
		}
		
		function print_paper($jrawat_id){
			$sql="SELECT jrawat_tanggal
					,cust_no
					,cust_nama
					,cust_alamat
					,jrawat_nobukti
					,rawat_nama
					,drawat_jumlah
					,drawat_harga
					,drawat_diskon
					,(drawat_harga*((100-drawat_diskon)/100)) AS jumlah_subtotal
					,jrawat_creator
					,jrawat_diskon
					,jrawat_cashback
					,jrawat_bayar
				FROM detail_jual_rawat
				LEFT JOIN master_jual_rawat ON(drawat_master=jrawat_id)
				LEFT JOIN customer ON(jrawat_cust=cust_id)
				LEFT JOIN perawatan ON(drawat_rawat=rawat_id)
				WHERE jrawat_id='$jrawat_id'";
			$result = $this->db->query($sql);
			//$this->master_jual_rawat_status_update($jrawat_id);
			return $result;
		}
		
		function print_paper_apaket($dapaket_cust ,$dapaket_date_create){
			/*$sql = "SELECT dapaket_id
					,jpaket_nobukti
					,paket_nama
					,rawat_nama
					,dapaket_jumlah
					,jpaket_customer.cust_nama AS jpaket_cust_nama
					,jpaket_customer.cust_no AS jpaket_cust_no
					,jpaket_customer.cust_alamat AS jpaket_cust_alamat
					,dapaket_customer.cust_no AS dapaket_cust_no
					,dapaket_customer.cust_nama AS dapaket_cust_nama
					,dapaket_customer.cust_alamat AS dapaket_cust_alamat
					,dapaket_date_create
				FROM detail_ambil_paket
				LEFT JOIN master_jual_paket ON(dapaket_jpaket=jpaket_id)
				LEFT JOIN paket ON(dapaket_paket=paket_id)
				LEFT JOIN customer AS dapaket_customer ON(dapaket_cust=dapaket_customer.cust_id)
				LEFT JOIN perawatan ON(dapaket_item=rawat_id)
				LEFT JOIN customer AS jpaket_customer ON(jpaket_cust=jpaket_customer.cust_id)
				WHERE dapaket_jpaket='$dapaket_jpaket'
					AND dapaket_dpaket='$dapaket_dpaket'
					AND date_format(dapaket_date_create,'%Y-%m-%d')='$dapaket_date_create'";*/
			
			$sql = "SELECT dapaket_id
					,jpaket_nobukti
					,paket_nama
					,rawat_nama
					,dapaket_jumlah
					,jpaket_customer.cust_nama AS jpaket_cust_nama
					,jpaket_customer.cust_no AS jpaket_cust_no
					,jpaket_customer.cust_alamat AS jpaket_cust_alamat
					,dapaket_customer.cust_no AS dapaket_cust_no
					,dapaket_customer.cust_nama AS dapaket_cust_nama
					,dapaket_customer.cust_alamat AS dapaket_cust_alamat
					,dapaket_date_create
				FROM detail_ambil_paket
				LEFT JOIN master_jual_paket ON(dapaket_jpaket=jpaket_id)
				LEFT JOIN paket ON(dapaket_paket=paket_id)
				LEFT JOIN customer AS dapaket_customer ON(dapaket_cust=dapaket_customer.cust_id)
				LEFT JOIN perawatan ON(dapaket_item=rawat_id)
				LEFT JOIN customer AS jpaket_customer ON(jpaket_cust=jpaket_customer.cust_id)
				WHERE dapaket_cust='$dapaket_cust'
					AND date_format(dapaket_date_create,'%Y-%m-%d')='$dapaket_date_create'"; //mencetak semua pengambilan paket dari customer dalam tanggal yang dipilih
			
			$result = $this->db->query($sql);
			foreach($result->result() as $row){
				$this->detail_ambil_paket_status_update($row->dapaket_id);
			}
			return $result;
		}
		
		function print_paper_apaket_bycust($dapaket_cust, $dapaket_date_create){
			$sql = "SELECT dapaket_id, jpaket_nobukti, paket_nama, rawat_nama, dapaket_jumlah, cust_no, cust_nama, cust_alamat, dapaket_date_create FROM detail_ambil_paket LEFT JOIN master_jual_paket ON(dapaket_jpaket=jpaket_id) LEFT JOIN paket ON(dapaket_paket=paket_id) LEFT JOIN customer ON(dapaket_cust=cust_id) LEFT JOIN perawatan ON(dapaket_item=rawat_id) WHERE dapaket_cust='$dapaket_cust' AND date_format(dapaket_date_create,'%Y-%m-%d')='$dapaket_date_create' AND dapaket_stat_dok='Terbuka'";
			
			$result = $this->db->query($sql);
			foreach($result->result() as $row){
				$this->detail_ambil_paket_status_update($row->dapaket_id);
			}
			return $result;
		}
		
		function cara_bayar($jrawat_id){
			$sql="SELECT jrawat_nobukti, jrawat_cara FROM master_jual_rawat WHERE jrawat_id='$jrawat_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$record=$rs->row();
				if(($record->jrawat_cara !== NULL || $record->jrawat_cara !== '')){
					if($record->jrawat_cara == 'tunai'){
						$sql="SELECT jrawat_nobukti, jrawat_cara, jtunai_nilai AS bayar_nilai FROM master_jual_rawat LEFT JOIN jual_tunai ON(jtunai_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jrawat_cara == 'kwitansi'){
						$sql="SELECT jrawat_nobukti, jrawat_cara, jkwitansi_nilai AS bayar_nilai FROM master_jual_rawat LEFT JOIN jual_kwitansi ON(jkwitansi_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jrawat_cara == 'card'){
						$sql="SELECT jrawat_nobukti, jrawat_cara, jcard_nilai AS bayar_nilai FROM master_jual_rawat LEFT JOIN jual_card ON(jcard_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jrawat_cara == 'cek/giro'){
						$sql="SELECT jrawat_nobukti, jrawat_cara, jcek_nilai AS bayar_nilai FROM master_jual_rawat LEFT JOIN jual_cek ON(jcek_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jrawat_cara == 'kwitansi'){
						$sql="SELECT jrawat_nobukti, jrawat_cara, jkwitansi_nilai AS bayar_nilai FROM master_jual_rawat LEFT JOIN jual_kwitansi ON(jkwitansi_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jrawat_cara == 'transfer'){
						$sql="SELECT jrawat_nobukti, jrawat_cara, jtransfer_nilai AS bayar_nilai FROM master_jual_rawat LEFT JOIN jual_transfer ON(jtransfer_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jrawat_cara == 'voucher'){
						$sql="SELECT jrawat_nobukti, jrawat_cara, tvoucher_nilai AS bayar_nilai FROM master_jual_rawat LEFT JOIN voucher_terima ON(tvoucher_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}
				}else{
					return '';
				}
			}else{
				return '';
			}
		}
		
		function cara_bayar2($jrawat_id){
			$sql="SELECT jrawat_nobukti, jrawat_cara2 FROM master_jual_rawat WHERE jrawat_id='$jrawat_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$record=$rs->row();
				if(($record->jrawat_cara2 !== NULL || $record->jrawat_cara2 !== '')){
					if($record->jrawat_cara2 == 'tunai'){
						$sql="SELECT jrawat_nobukti, jrawat_cara2, jtunai_nilai AS bayar2_nilai FROM master_jual_rawat LEFT JOIN jual_tunai ON(jtunai_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}elseif($record->jrawat_cara2 == 'kwitansi'){
						$sql="SELECT jrawat_nobukti, jrawat_cara2, jkwitansi_nilai AS bayar2_nilai FROM master_jual_rawat LEFT JOIN jual_kwitansi ON(jkwitansi_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}elseif($record->jrawat_cara2 == 'card'){
						$sql="SELECT jrawat_nobukti, jrawat_cara2, jcard_nilai AS bayar2_nilai FROM master_jual_rawat LEFT JOIN jual_card ON(jcard_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}elseif($record->jrawat_cara2 == 'cek/giro'){
						$sql="SELECT jrawat_nobukti, jrawat_cara2, jcek_nilai AS bayar2_nilai FROM master_jual_rawat LEFT JOIN jual_cek ON(jcek_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}elseif($record->jrawat_cara2 == 'kwitansi'){
						$sql="SELECT jrawat_nobukti, jrawat_cara2, jkwitansi_nilai AS bayar2_nilai FROM master_jual_rawat LEFT JOIN jual_kwitansi ON(jkwitansi_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}elseif($record->jrawat_cara2 == 'transfer'){
						$sql="SELECT jrawat_nobukti, jrawat_cara2, jtransfer_nilai AS bayar2_nilai FROM master_jual_rawat LEFT JOIN jual_transfer ON(jtransfer_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return NULL;
						}
					}elseif($record->jrawat_cara2 == 'voucher'){
						$sql="SELECT jrawat_nobukti, jrawat_cara2, tvoucher_nilai AS bayar2_nilai FROM master_jual_rawat LEFT JOIN voucher_terima ON(tvoucher_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
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
		
		function cara_bayar3($jrawat_id){
			$sql="SELECT jrawat_nobukti, jrawat_cara3 FROM master_jual_rawat WHERE jrawat_id='$jrawat_id'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$record=$rs->row();
				if(($record->jrawat_cara3 !== NULL || $record->jrawat_cara3 !== '')){
					if($record->jrawat_cara3 == 'tunai'){
						$sql="SELECT jrawat_nobukti, jrawat_cara3, jtunai_nilai AS bayar3_nilai FROM master_jual_rawat LEFT JOIN jual_tunai ON(jtunai_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jrawat_cara3 == 'kwitansi'){
						$sql="SELECT jrawat_nobukti, jrawat_cara3, jkwitansi_nilai AS bayar3_nilai FROM master_jual_rawat LEFT JOIN jual_kwitansi ON(jkwitansi_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jrawat_cara3 == 'card'){
						$sql="SELECT jrawat_nobukti, jrawat_cara3, jcard_nilai AS bayar3_nilai FROM master_jual_rawat LEFT JOIN jual_card ON(jcard_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jrawat_cara3 == 'cek/giro'){
						$sql="SELECT jrawat_nobukti, jrawat_cara3, jcek_nilai AS bayar3_nilai FROM master_jual_rawat LEFT JOIN jual_cek ON(jcek_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jrawat_cara3 == 'kwitansi'){
						$sql="SELECT jrawat_nobukti, jrawat_cara3, jkwitansi_nilai AS bayar3_nilai FROM master_jual_rawat LEFT JOIN jual_kwitansi ON(jkwitansi_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jrawat_cara3 == 'transfer'){
						$sql="SELECT jrawat_nobukti, jrawat_cara3, jtransfer_nilai AS bayar3_nilai FROM master_jual_rawat LEFT JOIN jual_transfer ON(jtransfer_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}elseif($record->jrawat_cara3 == 'voucher'){
						$sql="SELECT jrawat_nobukti, jrawat_cara3, tvoucher_nilai AS bayar3_nilai FROM master_jual_rawat LEFT JOIN voucher_terima ON(tvoucher_ref=jrawat_nobukti) WHERE jrawat_id='$jrawat_id'";
						$rs=$this->db->query($sql);
						if($rs->num_rows()){
							return $rs->row();
						}else{
							return '';
						}
					}
				}else{
					return '';
				}
			}else{
				return '';
			}
		}
		
		function iklan(){
			$sql="SELECT * from iklan_today";
			$result = $this->db->query($sql);
			return $result;
		}
		
}
?>