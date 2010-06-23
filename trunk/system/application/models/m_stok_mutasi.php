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
										AND status='Tertutup'
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
										-sum(jml_retur_beli*konversi_nilai)
										-sum(jml_mutasi_keluar*konversi_nilai)
										-sum(jml_jual_produk*konversi_nilai)
										-sum(jml_jual_grooming*konversi_nilai)
										-sum(jml_pakai_cabin*konversi_nilai) as jumlah_keluar
								FROM	vu_stok_new_produk
								WHERE   date_format(tanggal,'%Y-%m-%d')<'".$tanggal_start."'
										AND produk_id='".$rowproduk->produk_id."'
										AND gudang='".$gudang."'
										AND status='Tertutup'
								GROUP BY produk_id";
							
				$rs_mutasi=$this->db->query($sql_stok_mutasi);
					if($rs_mutasi->num_rows())
					{
						$ds_mutasi=$rs_mutasi->row();
						$data[$i]["jumlah_masuk"]=round($ds_mutasi->jumlah_masuk*$data[$i]["konversi_nilai"],3);
						$data[$i]["jumlah_keluar"]=round($ds_mutasi->jumlah_keluar*$data[$i]["konversi_nilai"],0);
						$data[$i]["jumlah_koreksi"]=round($ds_mutasi->jumlah_koreksi*$data[$i]["konversi_nilai"],3);
						$data[$i]["jumlah_stok"]=round(($data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]+$data[$i]["jumlah_koreksi"]),3);
						
					}else{
						$data[$i]["jumlah_masuk"]=0;
						$data[$i]["jumlah_keluar"]=0;
						$data[$i]["jumlah_koreksi"]=0;
						$data[$i]["jumlah_stok"]=round(($data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]+$data[$i]["jumlah_koreksi"]),3);
					}
				$i++;
			}
				/*//untuk gudang besar
				if($gudang==1)
				{
					
					//saldo awal
					$sql_stokawal="SELECT sum(jumlah_terima)-sum(jumlah_retur_beli)+sum(jumlah_masuk)-sum(jumlah_keluar)+sum(jumlah_koreksi) jumlah_awal 									FROM vu_stok_gudang_besar_tanggal
							WHERE produk_id='".$rowproduk->produk_id."' 
							AND date_format(tanggal,'%Y-%m-%d')<'".$tanggal_start."'
							GROUP BY produk_id";
					$q_stokawal=$this->db->query($sql_stokawal);
					if($q_stokawal->num_rows())
					{
						$ds_stokawal=$q_stokawal->row();
						$data[$i]["jumlah_awal"]=round(($ds_stokawal->jumlah_awal==NULL?0:$ds_stokawal->jumlah_awal)*$data[$i]["konversi_nilai"],3);
					}else{
						$data[$i]["jumlah_awal"]=0;
					}
					
					//echo  $sql_stokawal;
					//mutasi
					$sql_mutasi="SELECT sum(jumlah_terima) as jumlah_terima, 
										sum(jumlah_retur_beli) as jumlah_retur_beli, 
										sum(jumlah_masuk) as jumlah_masuk,
										sum(jumlah_keluar) as jumlah_keluar,
										sum(jumlah_koreksi) as jumlah_koreksi
								FROM vu_stok_gudang_besar_tanggal
								WHERE produk_id='".$rowproduk->produk_id."' 
								AND date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								GROUP BY produk_id";
					//echo $sql_mutasi;
					
					$rs_mutasi=$this->db->query($sql_mutasi);
					if($rs_mutasi->num_rows())
					{
						$ds_mutasi=$rs_mutasi->row();
						$data[$i]["jumlah_masuk"]=round(($ds_mutasi->jumlah_terima+$ds_mutasi->jumlah_masuk)*$data[$i]["konversi_nilai"],3);
						$data[$i]["jumlah_keluar"]=round(($ds_mutasi->jumlah_keluar+$ds_mutasi->jumlah_retur_beli)*$data[$i]["konversi_nilai"],0);
						$data[$i]["jumlah_koreksi"]=round(($ds_mutasi->jumlah_koreksi)*$data[$i]["konversi_nilai"],3);
						$data[$i]["jumlah_stok"]=round(($data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]+$data[$i]["jumlah_koreksi"]),3);
						
					}else{
						$data[$i]["jumlah_masuk"]=0;
						$data[$i]["jumlah_keluar"]=0;
						$data[$i]["jumlah_koreksi"]=0;
						$data[$i]["jumlah_stok"]=round(($data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]+$data[$i]["jumlah_koreksi"]),3);
					}
				
				}elseif($gudang==2)
				{
					//gudang kasir/produk
					
					//stok awal
					$sql_stokawal="SELECT sum(jumlah_masuk)+sum(jumlah_retur_produk)+sum(jumlah_retur_paket)-sum(jumlah_jual)-sum(jumlah_keluar)+sum(jumlah_koreksi) as jumlah_awal
									FROM vu_stok_gudang_produk_tanggal
									WHERE produk_id='".$rowproduk->produk_id."' 
									AND date_format(tanggal,'%Y-%m-%d')<'".$tanggal_start."'
									GROUP BY produk_id";
					$q_stokawal=$this->db->query($sql_stokawal);
					if($q_stokawal->num_rows())
					{
						$ds_stokawal=$q_stokawal->row();
						$data[$i]["jumlah_awal"]=$ds_stokawal->jumlah_awal*$data[$i]["konversi_nilai"];
					}else{
						$data[$i]["jumlah_awal"]=0;
					}
					
					//mutasi
					$sql_mutasi="SELECT sum(jumlah_jual) as jumlah_jual, 
										sum(jumlah_retur_produk) as jumlah_retur_produk, 
										sum(jumlah_retur_paket) as jumlah_retur_paket, 
										sum(jumlah_masuk) as jumlah_masuk,
										sum(jumlah_keluar) as jumlah_keluar,
										sum(jumlah_koreksi) as jumlah_koreksi
								FROM vu_stok_gudang_produk_tanggal
								WHERE produk_id='".$rowproduk->produk_id."' 
								AND date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								GROUP BY produk_id";
					$rs_mutasi=$this->db->query($sql_mutasi);
					if($rs_mutasi->num_rows())
					{
						$ds_mutasi=$rs_mutasi->row();
						$data[$i]["jumlah_masuk"]=($ds_mutasi->jumlah_retur_produk+$ds_mutasi->jumlah_retur_paket+$ds_mutasi->jumlah_masuk)*$data[$i]["konversi_nilai"];
						$data[$i]["jumlah_keluar"]=($ds_mutasi->jumlah_keluar+$ds_mutasi->jumlah_jual)*$data[$i]["konversi_nilai"];
						$data[$i]["jumlah_koreksi"]=($ds_mutasi->jumlah_koreksi)*$data[$i]["konversi_nilai"];
						$data[$i]["jumlah_stok"]=($data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]+$data[$i]["jumlah_koreksi"]);
						
					}else{
						$data[$i]["jumlah_masuk"]=0;
						$data[$i]["jumlah_keluar"]=0;
						$data[$i]["jumlah_koreksi"]=0;
						$data[$i]["jumlah_stok"]=$data[$i]["jumlah_awal"]*$data[$i]["konversi_nilai"];
					}
					
				}else{
					//gudang lainnya

					//stok awal
					$sql_stokawal="SELECT sum(jumlah_masuk)-sum(jumlah_keluar)+sum(jumlah_koreksi)-sum(jumlah_pakai) as jumlah_awal
									FROM vu_stok_mutasi_all
									WHERE produk_id='".$rowproduk->produk_id."' 
									AND date_format(mutasi_tanggal,'%Y-%m-%d')<'".$tanggal_start."'
									AND gudang_id='".$gudang."' 
									GROUP BY produk_id";
					$q_stokawal=$this->db->query($sql_stokawal);
					if($q_stokawal->num_rows())
					{
						$ds_stokawal=$q_stokawal->row();
						$data[$i]["jumlah_awal"]=$ds_stokawal->jumlah_awal*$data[$i]["konversi_nilai"];
					}else{
						$data[$i]["jumlah_awal"]=0;
					}
					
					//pake cabin
					$sql_cabin="SELECT sum(jumlah_konversi) as jumlah_cabin
								FROM vu_stok_pakai_cabin
								WHERE produk_id='".$rowproduk->produk_id."' 
								AND date_format(cabin_date_create,'%Y-%m-%d')<'".$tanggal_start."'
								GROUP BY produk_id";
					$q_cabin=$this->db->query($sql_cabin);
					if($q_cabin->num_rows())
					{
						$ds_cabin=$q_cabin->row();
						$data[$i]["jumlah_awal"]=($data[$i]["jumlah_awal"]-$ds_cabin->jumlah_cabin)*$data[$i]["konversi_nilai"];
					}
					
					
					//mutasi
					$sql_mutasi="SELECT 	sum(jumlah_masuk) as jumlah_masuk,
											sum(jumlah_keluar) as jumlah_keluar,
											sum(jumlah_koreksi) as jumlah_koreksi,
											sum(jumlah_pakai) as jumlah_cabin
									FROM vu_stok_mutasi_all
									WHERE produk_id='".$rowproduk->produk_id."' 
									AND date_format(mutasi_tanggal,'%Y-%m-%d')>='".$tanggal_start."'
									AND date_format(mutasi_tanggal,'%Y-%m-%d')<='".$tanggal_end."'
									AND gudang_id='".$gudang."' 
									GROUP BY produk_id";
									
					$rs_mutasi=$this->db->query($sql_mutasi);
					if($rs_mutasi->num_rows())
					{
						$ds_mutasi=$rs_mutasi->row();
						$data[$i]["jumlah_masuk"]=$ds_mutasi->jumlah_masuk*$data[$i]["konversi_nilai"];
						$data[$i]["jumlah_keluar"]=($ds_mutasi->jumlah_keluar+$ds_mutasi->jumlah_cabin)*$data[$i]["konversi_nilai"];
						$data[$i]["jumlah_koreksi"]=$ds_mutasi->jumlah_koreksi*$data[$i]["konversi_nilai"];
						$data[$i]["jumlah_stok"]=($data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]+$data[$i]["jumlah_koreksi"])*$data[$i]["konversi_nilai"];
						
					}else{
						$data[$i]["jumlah_masuk"]=0;
						$data[$i]["jumlah_keluar"]=0;
						$data[$i]["jumlah_koreksi"]=0;
						$data[$i]["jumlah_stok"]=$data[$i]["jumlah_awal"]*$data[$i]["konversi_nilai"];
					}
					
					//pake cabin
					$sql_cabin="SELECT sum(jumlah_konversi) as jumlah_cabin
								FROM vu_stok_pakai_cabin
								WHERE produk_id='".$rowproduk->produk_id."' 
								AND date_format(cabin_date_create,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(cabin_date_create,'%Y-%m-%d')<='".$tanggal_end."'
								GROUP BY produk_id";
					$q_cabin=$this->db->query($sql_cabin);
					if($q_cabin->num_rows())
					{
						$ds_cabin=$q_cabin->row();
						$data[$i]["jumlah_stok"]=($data[$i]["jumlah_stok"]-$ds_cabin->jumlah_cabin)*$data[$i]["konversi_nilai"];
						$data[$i]["jumlah_keluar"]=($data[$i]["jumlah_keluar"]+$ds_cabin->jumlah_cabin)*$data[$i]["konversi_nilai"];
					}
					
				}*/
				
			
			if($nbrows>0){
				
				$jsonresult = json_encode($data);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
			
		}
		
		
		
		//function for print record
		function stok_mutasi_print($produk_id ,$produk_nama ,$satuan_id ,$satuan_nama ,$stok_saldo ,$option,$filter){
			//full query
			$sql="select * from stok_mutasi";
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