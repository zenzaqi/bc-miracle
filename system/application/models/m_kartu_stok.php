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
			
			
			$result=$this->db->query($sql);
			$nbrows=$result->num_rows();
			if($result->num_rows()){
				$row=$result->row();
				if($opsi_satuan=='terkecil')
					$konversi=1;
				else
					$konversi=1/$row->konversi_nilai;
				
				$i=0;
				
				if($gudang==1)
				{
				
					$sql="SELECT tanggal,no_bukti,jumlah*konversi_nilai*".$konversi." as masuk, 0 as keluar, 0 as koreksi 
							FROM vu_detail_terima_all,satuan_konversi 
						 	WHERE vu_detail_terima_all.satuan_id=satuan_konversi.konversi_satuan AND produk_id=konversi_produk
							AND produk_id='".$produk_id."'";
					$result=$this->db->query($sql);
					foreach($result->result() as $rowbeli){
						$data[$i]['tanggal']=$rowbeli->tanggal;
						$data[$i]['no_bukti']=$rowbeli->no_bukti;
						$data[$i]['masuk']=$rowbeli->masuk;
						$data[$i]['keluar']=$rowbeli->keluar;
						$data[$i]['koreksi']=$rowbeli->koreksi;
						$i++;
					}
					
					$sql="SELECT tanggal,rbeli_nobukti as no_bukti,jumlah_barang*konversi_nilai*".$konversi." as keluar, 0 as masuk, 0 as koreksi 
							FROM vu_detail_retur_beli,satuan_konversi 
						 	WHERE vu_detail_retur_beli.satuan_id=satuan_konversi.konversi_satuan AND produk_id=konversi_produk
							AND produk_id='".$produk_id."'";
					$result=$this->db->query($sql);
					foreach($result->result() as $rowbeli){
						$data[$i]['tanggal']=$rowbeli->tanggal;
						$data[$i]['no_bukti']=$rowbeli->no_bukti;
						$data[$i]['masuk']=$rowbeli->masuk;
						$data[$i]['keluar']=$rowbeli->keluar;
						$data[$i]['koreksi']=$rowbeli->koreksi;
						$i++;
					}
					
					
				}else if($gudang==2){
					$sql="SELECT tanggal,no_bukti,jumlah_barang*konversi_nilai*".$konversi." as keluar, 0 as masuk, 0 as koreksi 
							FROM vu_detail_jual_produk,satuan_konversi 
						 	WHERE vu_detail_jual_produk.dproduk_satuan=satuan_konversi.konversi_satuan AND dproduk_produk=konversi_produk
							AND dproduk_produk='".$produk_id."'";
					foreach($result->result() as $rowjual){
						$data[$i]['tanggal']=$rowjual->tanggal;
						$data[$i]['no_bukti']=$rowjual->no_bukti;
						$data[$i]['masuk']=$rowjual->masuk;
						$data[$i]['keluar']=$rowjual->keluar;
						$data[$i]['koreksi']=$rowjual->koreksi;
						$i++;
					}
					
					$sql="SELECT rproduk_tanggal as tanggal,rproduk_nobukti as no_bukti,drproduk_jumlah*konversi_nilai*".$konversi."
							as masuk, 0 as keluar, 0 as koreksi 
							FROM vu_detail_retur_jual_produk,satuan_konversi 
						 	WHERE vu_detail_retur_jual_produk.drproduk_satuan=satuan_konversi.konversi_satuan AND drproduk_produk=konversi_produk
							AND produk_id='".$produk_id."'";
					$result=$this->db->query($sql);
					foreach($result->result() as $rowjual){
						$data[$i]['tanggal']=$rowjual->tanggal;
						$data[$i]['no_bukti']=$rowjual->no_bukti;
						$data[$i]['masuk']=$rowjual->masuk;
						$data[$i]['keluar']=$rowjual->keluar;
						$data[$i]['koreksi']=$rowjual->koreksi;
						$i++;
					}
					
				}else{
					$sql="SELECT cabin_date_create as tanggal, cabin_bukti as no_bukti, cabin_jumlah*konversi_nilai*".$konversi." as keluar, 0 as masuk, 0 as koreksi
							FROM vu_pakai_cabin,satuan_konversi
							WHERE vu_pakai_cabin.cabin_satuan=satuan_konversi.konversi_satuan AND cabin_produk=konversi_produk
							AND cabin_produk='".$produk_id."' AND cabin_gudang='".$gudang."'";
					
					foreach($result->result() as $rowcabin){
						$data[$i]['tanggal']=$rowcabin->tanggal;
						$data[$i]['no_bukti']=$rowcabin->no_bukti;
						$data[$i]['masuk']=$rowcabin->masuk;
						$data[$i]['keluar']=$rowcabin->keluar;
						$data[$i]['koreksi']=$rowcabin->koreksi;
						$i++;
					}
				}
				
				
				//mutasi keluar
				$sql="SELECT mutasi_tanggal as tanggal, 'mutasi' as no_bukti, dmutasi_jumlah*satuan_konversi.konversi_nilai*".$konversi."
						as keluar, 0 as masuk, 0 as koreksi
					FROM vu_detail_mutasi,satuan_konversi
					WHERE mutasi_asal='".$gudang."' AND dmutasi_produk='".$produk_id."'
					dmutasi_produk=satuan_konversi.konversi_produk AND dmutasi_satuan=satuan_konversi.konversi_satuan";
					
				foreach($result->result() as $rowmutasi){
					$data[$i]['tanggal']=$rowmutasi->tanggal;
					$data[$i]['no_bukti']=$rowmutasi->no_bukti;
					$data[$i]['masuk']=$rowmutasi->masuk;
					$data[$i]['keluar']=$rowmutasi->keluar;
					$data[$i]['koreksi']=$rowmutasi->koreksi;
					$i++;
				}
				
				//mutasi masuk
				$sql="SELECT mutasi_tanggal as tanggal, 'mutasi' as no_bukti, dmutasi_jumlah*satuan_konversi.konversi_nilai*".$konversi."
						as masuk, 0 as keluar, 0 as koreksi
					FROM vu_detail_mutasi,satuan_konversi
					WHERE mutasi_tujuan='".$gudang."' AND dmutasi_produk='".$produk_id."'
					dmutasi_produk=satuan_konversi.konversi_produk AND dmutasi_satuan=satuan_konversi.konversi_satuan";
					
				foreach($result->result() as $rowmutasi){
					$data[$i]['tanggal']=$rowmutasi->tanggal;
					$data[$i]['no_bukti']=$rowmutasi->no_bukti;
					$data[$i]['masuk']=$rowmutasi->masuk;
					$data[$i]['keluar']=$rowmutasi->keluar;
					$data[$i]['koreksi']=$rowmutasi->koreksi;
					$i++;
				}
				
				//koreksi
				$sql="SELECT koreksi_tanggal as tanggal, 'koreksi' as no_bukti, 0 as masuk, 0 as keluar, dkoreksi_jmlkoreksi*konversi_nilai*".$konversi."
						as koreksi
						FROM vu_detail_koreksi,satuan_konversi
						WHERE koreksi_gudang='".$gudang."' AND dkoreksi_produk='".$produk_id."'
						AND dkoreksi_produk=konversi_produk AND dkoreksi_satuan=konversi_satuan";
				
				foreach($result->result() as $rowkoreksi){
					$data[$i]['tanggal']=$rowkoreksi->tanggal;
					$data[$i]['no_bukti']=$rowkoreksi->no_bukti;
					$data[$i]['masuk']=$rowkoreksi->masuk;
					$data[$i]['keluar']=$rowkoreksi->keluar;
					$data[$i]['koreksi']=$rowkoreksi->koreksi;
					$i++;
				}
			
			} 
			if($nbrows>0 && sizeof($data)>0){
				
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