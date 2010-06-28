<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: kartu_stok Model
	+ Description	: For record model process back-end
	+ Filename 		: c_kartu_stok.php
 	+ creator 		: 
 	+ Created on 09/Apr/2010 10:47:15
*/

class M_kartu_stok extends Model{
		
		//constructor
		function M_kartu_stok() {
			parent::Model();
		}
		
		var $stok_awal=0;
		var $stok_masuk=0;
		var $stok_keluar=0;
		var $stok_koreksi=0;
		var $stok_akhir=0;
		
		function get_produk_list($filter,$start,$end){
			$sql="select * from vu_produk_satuan_terkecil WHERE produk_aktif='Aktif'";
			if($filter<>""){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="( produk_kode LIKE '%".addslashes($filter)."%' OR 
						 produk_nama LIKE '%".addslashes($filter)."%' OR 
						 satuan_kode LIKE '%".addslashes($filter)."%' OR 
						 satuan_nama LIKE '%".addslashes($filter)."%')";
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
		
		function kartu_stok_awal($gudang, $produk_id, $opsi_satuan, $tanggal_start,$tanggal_end,$filter,$start,$end){
			if($opsi_satuan=='terkecil')
				$sql="SELECT * FROM vu_produk_satuan_terkecil WHERE produk_aktif='Aktif'";
			else
				$sql="SELECT * FROM vu_produk_satuan_default WHERE produk_aktif='Aktif'";
			
			$this->stok_awal=0;
			
			if($produk_id!==""&&$produk_id!==0){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_id='".$produk_id."' ";
			}
			
			if($filter!==""&&$filter!==NULL){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_kode LIKE '%".addslashes($filter)."%' OR
						produk_nama LIKE '%".addslashes($filter)."%' ";
			}
			
			
			$result=$this->db->query($sql);
			$nbrows=$result->num_rows();
			//$this->firephp->log('sql : '.$sql);
			//echo $sql;
			$data[0]["stok_awal"]=0;
			
			if($nbrows>0){
				$row=$result->row();
				if($opsi_satuan=='terkecil')
					$konversi=1;
				else
					$konversi=1/$row->konversi_nilai;
				
				$i=0;
				
				$sql_stok_awal="SELECT 	sum(jml_terima_barang*konversi_nilai)
										+sum(jml_terima_bonus*konversi_nilai)
										-sum(jml_retur_beli*konversi_nilai)
										-sum(jml_mutasi_keluar*konversi_nilai)
										+sum(jml_mutasi_masuk*konversi_nilai)
										+sum(jml_koreksi_stok*konversi_nilai)
										-sum(jml_jual_produk*konversi_nilai)
										-sum(jml_jual_grooming*konversi_nilai)
										+sum(jml_retur_produk*konversi_nilai)
										+sum(jml_retur_paket*konversi_nilai)
										-sum(jml_pakai_cabin*konversi_nilai)
										as jumlah_awal
								FROM	vu_stok_new_produk
								WHERE   date_format(tanggal,'%Y-%m-%d')<'".$tanggal_start."'
										AND produk_id='".$row->produk_id."'
										AND gudang='".$gudang."'
										AND status<>'Batal'
								GROUP BY produk_id";
				//$this->firephp->log('sql : '.$sql_stok_awal);
				//echo $sql_stok_awal;
				
				$q_stokawal=$this->db->query($sql_stok_awal);
				if($q_stokawal->num_rows())
				{
					$ds_stokawal=$q_stokawal->row();
					$data[0]["stok_awal"]=round(($ds_stokawal->jumlah_awal==NULL?0:$ds_stokawal->jumlah_awal)*$konversi,3);
				}else{
					$data[0]["stok_awal"]=0;
				}
				
				/*if($gudang==1)
				{
					//stok awal
				
					$sql_stokawal="SELECT sum(jumlah_terima)-sum(jumlah_retur_beli)+sum(jumlah_masuk)-sum(jumlah_keluar)+sum(jumlah_koreksi) jumlah_awal 									FROM vu_stok_gudang_besar_tanggal
							WHERE produk_id='".$produk_id."' 
							AND date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
							GROUP BY produk_id";
					$q_stokawal=$this->db->query($sql_stokawal);
					if($q_stokawal->num_rows())
					{
						$ds_stokawal=$q_stokawal->row();
						$this->stok_awal=round(($ds_stokawal->jumlah_awal==NULL?0:$ds_stokawal->jumlah_awal)*$konversi,3);
					}
				}else if($gudang==2){
					
					
					//stok awal
					$sql_stokawal="SELECT sum(jumlah_masuk)+sum(jumlah_retur_produk)+sum(jumlah_retur_paket)-sum(jumlah_jual)-sum(jumlah_keluar)+sum(jumlah_koreksi) as jumlah_awal
									FROM vu_stok_gudang_produk_tanggal
									WHERE produk_id='".$produk_id."' 
									AND date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
									GROUP BY produk_id";
					$q_stokawal=$this->db->query($sql_stokawal);
					if($q_stokawal->num_rows())
					{
						$ds_stokawal=$q_stokawal->row();
						$this->stok_awal=round(($ds_stokawal->jumlah_awal==NULL?0:$ds_stokawal->jumlah_awal)*$konversi,3);
					}
				}else{
					
					//stok awal
					$sql_stokawal="SELECT sum(jumlah_masuk)-sum(jumlah_keluar)+sum(jumlah_koreksi)-sum(jumlah_pakai) as jumlah_awal
									FROM vu_stok_mutasi_all
									WHERE produk_id='".$produk_id."' 
									AND date_format(mutasi_tanggal,'%Y-%m-%d')<'".$tanggal_start."'
									AND gudang_id='".$gudang."' 
									GROUP BY produk_id";
					$q_stokawal=$this->db->query($sql_stokawal);
					if($q_stokawal->num_rows())
					{
						$ds_stokawal=$q_stokawal->row();
						$this->stok_awal=round(($ds_stokawal->jumlah_awal==NULL?0:$ds_stokawal->jumlah_awal)*$konversi,3);
					}
				}*/
			}
			
			//$data[0]["stok_awal"]=$this->stok_awal;
			
			if($nbrows>0){
				$jsonresult = json_encode($data);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
			
		}
		
		function kartu_stok_list($gudang, $produk_id, $opsi_satuan, $tanggal_start,$tanggal_end,$filter,$start,$end){
			if($opsi_satuan=='terkecil')
				$sql="SELECT * FROM vu_produk_satuan_terkecil WHERE produk_aktif='Aktif'";
			else
				$sql="SELECT * FROM vu_produk_satuan_default WHERE produk_aktif='Aktif'";
			

			if($produk_id!==""&&$produk_id!==0){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_id='".$produk_id."' ";
			}
			
			if($filter!==""&&$filter!==NULL){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_kode LIKE '%".addslashes($filter)."%' OR
						produk_nama LIKE '%".addslashes($filter)."%' ";
			}
			
			$i=0;
			
			$result=$this->db->query($sql);
			$nbrows=$result->num_rows();
			if($result->num_rows()){
				$rowproduk=$result->row();
				if($opsi_satuan=='terkecil')
					$konversi=1;
				else
					$konversi=1/$rowproduk->konversi_nilai;
				
								
				//Pembelian -> Masuk
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Beli dari ', supplier_nama) as keterangan, 
								jml_terima_barang*konversi_nilai+jml_terima_bonus*konversi_nilai as masuk,
								0 as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,supplier
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND supplier_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='PB'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowbeli){
					$data[$i]['tanggal']=$rowbeli->tanggal;
					$data[$i]['no_bukti']=$rowbeli->no_bukti;
					$data[$i]['keterangan']=$rowbeli->keterangan;
					$data[$i]['masuk']=$rowbeli->masuk*$konversi;
					$data[$i]['keluar']=$rowbeli->keluar*$konversi;
					$data[$i]['koreksi']=$rowbeli->koreksi*$konversi;					
					$i++;
				}
				
				//Retur Beli ->keluar
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Retur Beli dari ', supplier_nama) as keterangan, 
								0 as masuk,
								jml_retur_beli*konversi_nilai as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,supplier
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND supplier_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='RB'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowrbeli){
					$data[$i]['tanggal']=$rowrbeli->tanggal;
					$data[$i]['no_bukti']=$rowrbeli->no_bukti;
					$data[$i]['keterangan']=$rowrbeli->keterangan;
					$data[$i]['masuk']=$rowrbeli->masuk*$konversi;
					$data[$i]['keluar']=$rowrbeli->keluar*$konversi;
					$data[$i]['koreksi']=$rowrbeli->koreksi*$konversi;					
					$i++;
				}
				
				//Mutasi Keluar ->keluar
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Mutasi ke gudang ', gudang_nama) as keterangan, 
								0 as masuk,
								jml_mutasi_keluar*konversi_nilai as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,gudang
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND gudang_id=tujuan
								AND status<>'Batal'
								AND jenis_transaksi='mutasi'
								AND keterangan='mutasi keluar'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowkmutasi){
					$data[$i]['tanggal']=$rowkmutasi->tanggal;
					$data[$i]['no_bukti']=$rowkmutasi->no_bukti;
					$data[$i]['keterangan']=$rowkmutasi->keterangan;
					$data[$i]['masuk']=$rowkmutasi->masuk*$konversi;
					$data[$i]['keluar']=$rowkmutasi->keluar*$konversi;
					$data[$i]['koreksi']=$rowkmutasi->koreksi*$konversi;					
					$i++;
				}
				//$this->firephp->log($sql);
				
				//Mutasi Masuk ->masuk
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Mutasi dari gudang ', gudang_nama) as keterangan, 
								jml_mutasi_masuk*konversi_nilai as masuk,
								0 as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,gudang
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND gudang_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='mutasi'
								AND keterangan='mutasi masuk'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowmmutasi){
					$data[$i]['tanggal']=$rowmmutasi->tanggal;
					$data[$i]['no_bukti']=$rowmmutasi->no_bukti;
					$data[$i]['keterangan']=$rowmmutasi->keterangan;
					$data[$i]['masuk']=$rowmmutasi->masuk*$konversi;
					$data[$i]['keluar']=$rowmmutasi->keluar*$konversi;
					$data[$i]['koreksi']=$rowmmutasi->koreksi*$konversi;					
					$i++;
				}
				
				//Koreksi ->koreksi
				$sql="SELECT 	tanggal,
								no_bukti, 
								'Koreksi stok' as keterangan, 
								0 as masuk,
								0 as keluar,
								jml_koreksi_stok*konversi_nilai as koreksi
						FROM	vu_stok_new_produk
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND status<>'Batal'
								AND jenis_transaksi='koreksi'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowmmutasi){
					$data[$i]['tanggal']=$rowmmutasi->tanggal;
					$data[$i]['no_bukti']=$rowmmutasi->no_bukti;
					$data[$i]['keterangan']=$rowmmutasi->keterangan;
					$data[$i]['masuk']=$rowmmutasi->masuk*$konversi;
					$data[$i]['keluar']=$rowmmutasi->keluar*$konversi;
					$data[$i]['koreksi']=$rowmmutasi->koreksi*$konversi;					
					$i++;
				}
				
				//Penjualan produk -> keluar
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Jual Produk oleh ', cust_nama) as keterangan, 
								0 as masuk,
								jml_jual_produk*konversi_nilai as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,customer
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND cust_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='jual produk'
								AND keterangan='customer'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowpjual){
					$data[$i]['tanggal']=$rowpjual->tanggal;
					$data[$i]['no_bukti']=$rowpjual->no_bukti;
					$data[$i]['keterangan']=$rowpjual->keterangan;
					$data[$i]['masuk']=$rowpjual->masuk*$konversi;
					$data[$i]['keluar']=$rowpjual->keluar*$konversi;
					$data[$i]['koreksi']=$rowpjual->koreksi*$konversi;					
					$i++;
				}
				
				//Penjualan grooming -> keluar
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Jual Grooming oleh ', karyawan_nama) as keterangan, 
								0 as masuk,
								jml_jual_grooming*konversi_nilai as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,karyawan
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND karyawan_id=tujuan
								AND status<>'Batal'
								AND jenis_transaksi='jual produk'
								AND keterangan='grooming'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowgjual){
					$data[$i]['tanggal']=$rowgjual->tanggal;
					$data[$i]['no_bukti']=$rowgjual->no_bukti;
					$data[$i]['keterangan']=$rowgjual->keterangan;
					$data[$i]['masuk']=$rowgjual->masuk*$konversi;
					$data[$i]['keluar']=$rowgjual->keluar*$konversi;
					$data[$i]['koreksi']=$rowgjual->koreksi*$konversi;					
					$i++;
				}
				
				
				//Retur Penjualan Produk -> masuk
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Retur Produk oleh ', cust_nama) as keterangan, 
								jml_retur_produk*konversi_nilai as masuk,
								0 as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,customer
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND cust_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='retur jual'
								AND keterangan='produk retur'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowrjual){
					$data[$i]['tanggal']=$rowrjual->tanggal;
					$data[$i]['no_bukti']=$rowrjual->no_bukti;
					$data[$i]['keterangan']=$rowrjual->keterangan;
					$data[$i]['masuk']=$rowrjual->masuk*$konversi;
					$data[$i]['keluar']=$rowrjual->keluar*$konversi;
					$data[$i]['koreksi']=$rowrjual->koreksi*$konversi;					
					$i++;
				}
				
				//Retur Penjualan Paket -> masuk
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Retur Produk oleh ', cust_nama) as keterangan, 
								jml_retur_paket*konversi_nilai as masuk,
								0 as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,customer
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND cust_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='retur jual'
								AND keterangan='paket retur'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowrjual){
					$data[$i]['tanggal']=$rowrjual->tanggal;
					$data[$i]['no_bukti']=$rowrjual->no_bukti;
					$data[$i]['keterangan']=$rowrjual->keterangan;
					$data[$i]['masuk']=$rowrjual->masuk*$konversi;
					$data[$i]['keluar']=$rowrjual->keluar*$konversi;
					$data[$i]['koreksi']=$rowrjual->koreksi*$konversi;					
					$i++;
				}
				
				//Pakai cabin -> keluar
				$sql="SELECT 	tanggal,
								no_bukti, 
								concat('Retur Produk oleh ', cust_nama) as keterangan, 
								0 as masuk,
								jml_pakai_cabin*konversi_nilai as keluar,
								0 as koreksi
						FROM	vu_stok_new_produk,customer
						WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								AND produk_id='".$rowproduk->produk_id."'
								AND gudang='".$gudang."'
								AND cust_id=asal
								AND status<>'Batal'
								AND jenis_transaksi='pakai cabin'";
								
				$result=$this->db->query($sql);
				foreach($result->result() as $rowcabin){
					$data[$i]['tanggal']=$rowcabin->tanggal;
					$data[$i]['no_bukti']=$rowcabin->no_bukti;
					$data[$i]['keterangan']=$rowcabin->keterangan;
					$data[$i]['masuk']=$rowcabin->masuk*$konversi;
					$data[$i]['keluar']=$rowcabin->keluar*$konversi;
					$data[$i]['koreksi']=$rowcabin->koreksi*$konversi;					
					$i++;
				}
				
				/*if($gudang==1)
				{
					//pembelian
					$sql="SELECT tanggal,no_bukti, concat('Pembelian dari ', supplier_nama) as keterangan, jumlah*konversi_nilai*".$konversi." as masuk, 0 as keluar, 0 as koreksi 
							FROM vu_detail_terima_all,satuan_konversi 
						 	WHERE vu_detail_terima_all.satuan_id=satuan_konversi.konversi_satuan AND produk_id=konversi_produk
							AND produk_id='".$produk_id."' 
							AND date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."' AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'";
					$result=$this->db->query($sql);
					foreach($result->result() as $rowbeli){
						$data[$i]['tanggal']=$rowbeli->tanggal;
						$data[$i]['no_bukti']=$rowbeli->no_bukti;
						$data[$i]['keterangan']=$rowbeli->keterangan;
						$data[$i]['masuk']=$rowbeli->masuk;
						$data[$i]['keluar']=$rowbeli->keluar;
						$data[$i]['koreksi']=$rowbeli->koreksi;					
						$i++;
					}
					
					$sql="SELECT tanggal,rbeli_nobukti as no_bukti, concat('Retur ke ',supplier_nama) as keterangan, jumlah_barang*konversi_nilai*".$konversi." as keluar, 0 as masuk, 0 as koreksi 
							FROM vu_detail_retur_beli,satuan_konversi 
						 	WHERE vu_detail_retur_beli.satuan_id=satuan_konversi.konversi_satuan AND produk_id=konversi_produk
							AND konversi_produk='".$produk_id."' 
							AND date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."' AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'";
							
					$result=$this->db->query($sql);
					foreach($result->result() as $rowbeli){
						$data[$i]['tanggal']=$rowbeli->tanggal;
						$data[$i]['no_bukti']=$rowbeli->no_bukti;
						$data[$i]['keterangan']=$rowbeli->keterangan;
						$data[$i]['masuk']=$rowbeli->masuk;
						$data[$i]['keluar']=$rowbeli->keluar;
						$data[$i]['koreksi']=$rowbeli->koreksi;
					}
					
					
				}else if($gudang==2){
					
										
					$sql="SELECT tanggal,no_bukti,concat('Penjualan produk ke ', cust_nama) as keterangan, jumlah_barang*konversi_nilai*".$konversi." as keluar, 0 as masuk, 0 as koreksi 
							FROM vu_detail_jual_produk,satuan_konversi 
						 	WHERE vu_detail_jual_produk.dproduk_satuan=satuan_konversi.konversi_satuan AND dproduk_produk=konversi_produk
							AND dproduk_produk='".$produk_id."' 
							AND date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."' AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'";
							
					$result=$this->db->query($sql);
					foreach($result->result() as $rowjual){
						$data[$i]['tanggal']=$rowjual->tanggal;
						$data[$i]['no_bukti']=$rowjual->no_bukti;
						$data[$i]['keterangan']=$rowjual->keterangan;
						$data[$i]['masuk']=$rowjual->masuk;
						$data[$i]['keluar']=$rowjual->keluar;
						$data[$i]['koreksi']=$rowjual->koreksi;
						$i++;
					}
					
					$sql="SELECT rproduk_tanggal as tanggal,rproduk_nobukti as no_bukti, concat('Retur produk dari ', cust_nama) as keterangan, drproduk_jumlah*konversi_nilai*".$konversi."
							as masuk, 0 as keluar, 0 as koreksi 
							FROM vu_detail_retur_jual_produk,satuan_konversi 
						 	WHERE vu_detail_retur_jual_produk.drproduk_satuan=satuan_konversi.konversi_satuan AND drproduk_produk=konversi_produk
							AND konversi_produk='".$produk_id."' 
							AND date_format(rproduk_tanggal,'%Y-%m-%d')>='".$tanggal_start."' AND date_format(rproduk_tanggal,'%Y-%m-%d')<='".$tanggal_end."'";
							
					$result=$this->db->query($sql);
					foreach($result->result() as $rowjual){
						$data[$i]['tanggal']=$rowjual->tanggal;
						$data[$i]['no_bukti']=$rowjual->no_bukti;
						$data[$i]['keterangan']=$rowjual->keterangan;
						$data[$i]['masuk']=$rowjual->masuk;
						$data[$i]['keluar']=$rowjual->keluar;
						$data[$i]['koreksi']=$rowjual->koreksi;
					}
					
				}else{
					
					$sql="SELECT date_format(cabin_date_create,'%Y-%m-%d') as tanggal, cabin_bukti as no_bukti, concat('Pemakaian cabin dalam perawatan oleh ', cust_nama) as keterangan, cabin_jumlah*konversi_nilai*".$konversi." as keluar, 0 as masuk, 0 as koreksi
							FROM vu_pakai_cabin,satuan_konversi
							WHERE vu_pakai_cabin.cabin_satuan=satuan_konversi.konversi_satuan AND cabin_produk=konversi_produk
							AND cabin_produk='".$produk_id."' AND cabin_gudang='".$gudang."' 
							AND date_format(cabin_date_create,'%Y-%m-%d')>='".$tanggal_start."' AND date_format(cabin_date_create,'%Y-%m-%d')<='".$tanggal_end."'";
					
					//echo $sql;
					$result=$this->db->query($sql);
					foreach($result->result() as $rowcabin){
						$data[$i]['tanggal']=$rowcabin->tanggal;
						$data[$i]['no_bukti']=$rowcabin->no_bukti;
						$data[$i]['keterangan']=$rowcabin->keterangan;
						$data[$i]['masuk']=$rowcabin->masuk;
						$data[$i]['keluar']=$rowcabin->keluar;
						$data[$i]['koreksi']=$rowcabin->koreksi;
						$i++;
					}
				}
				
				
				//mutasi keluar
				$sql="SELECT mutasi_tanggal as tanggal, 'mutasi keluar' as no_bukti, concat('Mutasi ke ',gudang_tujuan_nama) as keterangan, dmutasi_jumlah*satuan_konversi.konversi_nilai*".$konversi."
						as keluar, 0 as masuk, 0 as koreksi
					FROM vu_detail_mutasi,satuan_konversi
					WHERE mutasi_asal='".$gudang."' AND dmutasi_produk='".$produk_id."' AND
					dmutasi_produk=satuan_konversi.konversi_produk AND dmutasi_satuan=satuan_konversi.konversi_satuan 
					AND date_format(mutasi_tanggal,'%Y-%m-%d')>='".$tanggal_start."' AND date_format(mutasi_tanggal,'%Y-%m-%d')<='".$tanggal_end."'";
				$result=$this->db->query($sql);	
				foreach($result->result() as $rowmutasi){
					$data[$i]['tanggal']=$rowmutasi->tanggal;
					$data[$i]['no_bukti']=$rowmutasi->no_bukti;
					$data[$i]['keterangan']=$rowmutasi->keterangan;
					$data[$i]['masuk']=$rowmutasi->masuk;
					$data[$i]['keluar']=$rowmutasi->keluar;
					$data[$i]['koreksi']=$rowmutasi->koreksi;
					$i++;
				}
				
				//mutasi masuk
				$sql="SELECT mutasi_tanggal as tanggal, 'mutasi masuk' as no_bukti, concat('Mutasi dari ',gudang_asal_nama) as keterangan, dmutasi_jumlah*satuan_konversi.konversi_nilai*".$konversi."
						as masuk, 0 as keluar, 0 as koreksi
					FROM vu_detail_mutasi,satuan_konversi 
					WHERE mutasi_tujuan='".$gudang."' AND dmutasi_produk='".$produk_id."' AND
					dmutasi_produk=satuan_konversi.konversi_produk AND dmutasi_satuan=satuan_konversi.konversi_satuan 
					AND date_format(mutasi_tanggal,'%Y-%m-%d')>='".$tanggal_start."' AND date_format(mutasi_tanggal,'%Y-%m-%d')<='".$tanggal_end."'";
				$result=$this->db->query($sql);	
				foreach($result->result() as $rowmutasi){
					$data[$i]['tanggal']=$rowmutasi->tanggal;
					$data[$i]['no_bukti']=$rowmutasi->no_bukti;
					$data[$i]['keterangan']=$rowmutasi->keterangan;
					$data[$i]['masuk']=$rowmutasi->masuk;
					$data[$i]['keluar']=$rowmutasi->keluar;
					$data[$i]['koreksi']=$rowmutasi->koreksi;
					$i++;
				}
				
				//koreksi
				$sql="SELECT koreksi_tanggal as tanggal, '-' as no_bukti, 'Koreksi stok' as keterangan,  0 as masuk, 0 as keluar, dkoreksi_jmlkoreksi*konversi_nilai*".$konversi."
						as koreksi
						FROM vu_detail_koreksi,satuan_konversi
						WHERE koreksi_gudang='".$gudang."' AND dkoreksi_produk='".$produk_id."'
						AND dkoreksi_produk=konversi_produk AND dkoreksi_satuan=konversi_satuan 
						AND date_format(koreksi_tanggal,'%Y-%m-%d')>='".$tanggal_start."' AND date_format(koreksi_tanggal,'%Y-%m-%d')<='".$tanggal_end."'";
				$result=$this->db->query($sql);
				foreach($result->result() as $rowkoreksi){
					$data[$i]['tanggal']=$rowkoreksi->tanggal;
					$data[$i]['no_bukti']=$rowkoreksi->no_bukti;
					$data[$i]['keterangan']=$rowkoreksi->keterangan;
					$data[$i]['masuk']=$rowkoreksi->masuk;
					$data[$i]['keluar']=$rowkoreksi->keluar;
					$data[$i]['koreksi']=$rowkoreksi->koreksi;
					$i++;
				}*/
			
			} 
			
			if($nbrows>0 && $i>0){
				
				$jsonresult = json_encode($data);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
			
		}
		
		
		
		//function for print record
		function kartu_stok_print($produk_id ,$produk_nama ,$satuan_id ,$satuan_nama ,$stok_saldo ,$option,$filter){
			//full query
			$sql="select * from kartu_stok";
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
		function kartu_stok_export_excel($produk_id ,$produk_nama ,$satuan_id ,$satuan_nama ,$stok_saldo ,$option,$filter){
			//full query
			$sql="select * from kartu_stok";
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