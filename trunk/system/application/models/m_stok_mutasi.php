<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: stok_mutasi Model
	+ Description	: For record model process back-end
	+ Filename 		: c_stok_mutasi.php
 	+ creator 		: 
 	+ Created on 09/Apr/2010 10:47:15
	
*/

class M_stok_mutasi extends Model{
		
		//constructor
		function M_stok_mutasi() {
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
		
		function stok_mutasi_list($gudang, $produk_id, $group1_id, $opsi_produk, $opsi_satuan, $tanggal_start,$tanggal_end,$filter,$start,$end){
			if($opsi_satuan=='terkecil')
				$sql="SELECT * FROM vu_produk_satuan_terkecil WHERE produk_aktif='Aktif'";
			else
				$sql="SELECT * FROM vu_produk_satuan_default WHERE produk_aktif='Aktif'";
			
			if($opsi_produk=='group1' & $group1_id!=="" & $group1_id!==0){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_group='".$group1_id."' ";
			}elseif($opsi_produk=='produk' & $produk_id!=="" & $produk_id!==0){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_id='".$produk_id."' ";
			}
			
			if($filter!==""&&$filter!==NULL){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.="	produk_kode LIKE '%".addslashes($filter)."%' OR
						produk_nama LIKE '%".addslashes($filter)."%' ";
			}
			
			//echo $sql;
			
			
			
			//$query_first=$this->db->query($sql);
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			
			if($produk_id=="")
				$sql = $sql." LIMIT ".$start.",".$end;		
			
			//echo "gudang=".$gudang;
			
			$result = $this->db->query($sql); 
			$i=0;
			
			foreach($result->result() as $rowproduk){
				$data[$i]["produk_id"]=$rowproduk->produk_id;
				$data[$i]["produk_kode"]=$rowproduk->produk_kode;
				$data[$i]["produk_nama"]=$rowproduk->produk_nama;
				$data[$i]["satuan_id"]=$rowproduk->satuan_id;
				$data[$i]["satuan_kode"]=$rowproduk->satuan_kode;
				$data[$i]["satuan_nama"]=$rowproduk->satuan_nama;	
				if($opsi_satuan=='terkecil')
					$data[$i]["konversi_nilai"]=1;
				else
					$data[$i]["konversi_nilai"]=1/$rowproduk->konversi_nilai;
				
				$data[$i]["jumlah_masuk"]=0;
				$data[$i]["jumlah_keluar"]=0;
				$data[$i]["jumlah_koreksi"]=0;
				$data[$i]["jumlah_stok"]=0;
				
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
										AND produk_id='".$rowproduk->produk_id."'
										AND gudang='".$gudang."'
										AND status<>'Batal'
								GROUP BY produk_id";
							
				$q_stokawal=$this->db->query($sql_stok_awal);
				if($q_stokawal->num_rows())
				{
					$ds_stokawal=$q_stokawal->row();
					$data[$i]["jumlah_awal"]=round(($ds_stokawal->jumlah_awal==NULL?0:$ds_stokawal->jumlah_awal)*$data[$i]["konversi_nilai"],3);
				}else{
					$data[$i]["jumlah_awal"]=0;
				}
						
				//stok mutasi
				$sql_stok_mutasi="SELECT 	sum(jml_terima_barang*konversi_nilai)
										+sum(jml_terima_bonus*konversi_nilai)
										+sum(jml_mutasi_masuk*konversi_nilai)
										+sum(jml_retur_produk*konversi_nilai)
										+sum(jml_retur_paket*konversi_nilai) as jumlah_masuk,
										sum(jml_koreksi_stok*konversi_nilai) as jumlah_koreksi,
										sum(jml_retur_beli*konversi_nilai)
										+sum(jml_mutasi_keluar*konversi_nilai)
										+sum(jml_jual_produk*konversi_nilai)
										+sum(jml_jual_grooming*konversi_nilai)
										+sum(jml_pakai_cabin*konversi_nilai) as jumlah_keluar
								FROM	vu_stok_new_produk
								WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
										AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
										AND produk_id='".$rowproduk->produk_id."'
										AND gudang='".$gudang."'
										AND status<>'Batal'
								GROUP BY produk_id";
							
				$rs_mutasi=$this->db->query($sql_stok_mutasi);
					if($rs_mutasi->num_rows())
					{
						$ds_mutasi=$rs_mutasi->row();
						$data[$i]["jumlah_masuk"]=round($ds_mutasi->jumlah_masuk*$data[$i]["konversi_nilai"],3);
						$data[$i]["jumlah_keluar"]=round($ds_mutasi->jumlah_keluar*$data[$i]["konversi_nilai"],3);
						$data[$i]["jumlah_koreksi"]=round($ds_mutasi->jumlah_koreksi*$data[$i]["konversi_nilai"],3);
						if($data[$i]["jumlah_koreksi"]<0)
							$data[$i]["jumlah_keluar"]=round($data[$i]["jumlah_keluar"]+abs($data[$i]["jumlah_koreksi"]*$data[$i]["konversi_nilai"]),3);
						else
							$data[$i]["jumlah_masuk"]=round($data[$i]["jumlah_masuk"]+abs($data[$i]["jumlah_koreksi"]*$data[$i]["konversi_nilai"]),3);
							
						
						$data[$i]["jumlah_stok"]=round(($data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]),3);
						
					}else{
						$data[$i]["jumlah_masuk"]=0;
						$data[$i]["jumlah_keluar"]=0;
						$data[$i]["jumlah_koreksi"]=0;
						$data[$i]["jumlah_stok"]=round(($data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]),3);
					}
				$i++;
			}
				
				
			
			if($nbrows>0){
				
				$jsonresult = json_encode($data);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
			
		}
		
		
		
		//function for print record
		function stok_mutasi_print($gudang, $produk_id, $group1_id, $opsi_produk, $opsi_satuan, $tanggal_start,$tanggal_end,$option, $filter){
			
			if($opsi_satuan=='terkecil')
				$sql="SELECT * FROM vu_produk_satuan_terkecil WHERE produk_aktif='Aktif'";
			else
				$sql="SELECT * FROM vu_produk_satuan_default WHERE produk_aktif='Aktif'";
			
			if($option=='LIST'){
				if($filter!==""&&$filter!==NULL){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.="	produk_kode LIKE '%".addslashes($filter)."%' OR
							produk_nama LIKE '%".addslashes($filter)."%' ";
				}
			} else if($option=='SEARCH'){
				
				if($opsi_produk=='group1' & $group1_id!=="" & $group1_id!==0){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.="	produk_group='".$group1_id."' ";
				}elseif($opsi_produk=='produk' & $produk_id!=="" & $produk_id!==0){
					$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
					$sql.="	produk_id='".$produk_id."' ";
				}
				
			}
			
			$this->firephp->log($sql);
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();

			$i=0;
			
			foreach($result->result() as $rowproduk){
				$data[$i]["produk_id"]=$rowproduk->produk_id;
				$data[$i]["produk_kode"]=$rowproduk->produk_kode;
				$data[$i]["produk_nama"]=$rowproduk->produk_nama;
				$data[$i]["satuan_id"]=$rowproduk->satuan_id;
				$data[$i]["satuan_kode"]=$rowproduk->satuan_kode;
				$data[$i]["satuan_nama"]=$rowproduk->satuan_nama;	
				if($opsi_satuan=='terkecil')
					$data[$i]["konversi_nilai"]=1;
				else
					$data[$i]["konversi_nilai"]=1/$rowproduk->konversi_nilai;
				
				$data[$i]["jumlah_awal"]=0;
				$data[$i]["jumlah_masuk"]=0;
				$data[$i]["jumlah_keluar"]=0;
				$data[$i]["jumlah_koreksi"]=0;
				$data[$i]["jumlah_saldo"]=0;
				
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
										AND produk_id='".$rowproduk->produk_id."'
										AND gudang='".$gudang."'
										AND status<>'Batal'
								GROUP BY produk_id";
							
				$q_stokawal=$this->db->query($sql_stok_awal);
				if($q_stokawal->num_rows())
				{
					$ds_stokawal=$q_stokawal->row();
					$data[$i]["jumlah_awal"]=round(($ds_stokawal->jumlah_awal==NULL?0:$ds_stokawal->jumlah_awal)*$data[$i]["konversi_nilai"],3);
				}else{
					$data[$i]["jumlah_awal"]=0;
				}
						
				//stok mutasi
				$sql_stok_mutasi="SELECT 	sum(jml_terima_barang*konversi_nilai)
										+sum(jml_terima_bonus*konversi_nilai)
										+sum(jml_mutasi_masuk*konversi_nilai)
										+sum(jml_retur_produk*konversi_nilai)
										+sum(jml_retur_paket*konversi_nilai) as jumlah_masuk,
										sum(jml_koreksi_stok*konversi_nilai) as jumlah_koreksi,
										sum(jml_retur_beli*konversi_nilai)
										+sum(jml_mutasi_keluar*konversi_nilai)
										+sum(jml_jual_produk*konversi_nilai)
										+sum(jml_jual_grooming*konversi_nilai)
										+sum(jml_pakai_cabin*konversi_nilai) as jumlah_keluar
								FROM	vu_stok_new_produk
								WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
										AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
										AND produk_id='".$rowproduk->produk_id."'
										AND gudang='".$gudang."'
										AND status<>'Batal'
								GROUP BY produk_id";
							
				$rs_mutasi=$this->db->query($sql_stok_mutasi);
					if($rs_mutasi->num_rows())
					{
						$ds_mutasi=$rs_mutasi->row();
						$data[$i]["jumlah_masuk"]=round($ds_mutasi->jumlah_masuk*$data[$i]["konversi_nilai"],3);
						$data[$i]["jumlah_keluar"]=round($ds_mutasi->jumlah_keluar*$data[$i]["konversi_nilai"],3);
						$data[$i]["jumlah_koreksi"]=round($ds_mutasi->jumlah_koreksi*$data[$i]["konversi_nilai"],3);
						if($data[$i]["jumlah_koreksi"]<0)
							$data[$i]["jumlah_keluar"]=round($data[$i]["jumlah_keluar"]+abs($data[$i]["jumlah_koreksi"]*$data[$i]["konversi_nilai"]),3);
						else
							$data[$i]["jumlah_masuk"]=round($data[$i]["jumlah_masuk"]+abs($data[$i]["jumlah_koreksi"]*$data[$i]["konversi_nilai"]),3);
							
						
						$data[$i]["jumlah_saldo"]=round(($data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]),3);
						
					}else{
						$data[$i]["jumlah_masuk"]=0;
						$data[$i]["jumlah_keluar"]=0;
						$data[$i]["jumlah_koreksi"]=0;
						$data[$i]["jumlah_saldo"]=round(($data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]),3);
					}
				$i++;
			}
			
			if($nbrows>0){
				return $data;
			} else {
				return 0;
			}
			
		}
		
		//function  for export to excel
		function stok_mutasi_export_excel($produk_id ,$produk_nama ,$satuan_id ,$satuan_nama ,$stok_saldo ,$option,$filter){
			//full query
			$sql="select * from stok_mutasi";
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