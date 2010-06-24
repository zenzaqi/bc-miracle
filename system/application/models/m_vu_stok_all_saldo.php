<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: vu_stok_all_saldo Model
	+ Description	: For record model process back-end
	+ Filename 		: c_vu_stok_all_saldo.php
 	+ creator 		: 
 	+ Created on 09/Apr/2010 10:47:15
	
*/

class M_vu_stok_all_saldo extends Model{
		
		//constructor
		function M_vu_stok_all_saldo() {
			parent::Model();
		}
		
		function get_stok_awal($produk_id,$tanggal_start){
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
										AND produk_id='".$produk_id."'
										AND status<>'Batal'
								GROUP BY produk_id";
						
				$q_stokawal=$this->db->query($sql_stok_awal);
				if($q_stokawal->num_rows())
				{
					$ds_stokawal=$q_stokawal->row();
					return $ds_stokawal->jumlah_awal;
				}else{
					return 0;
				}
		}
		
		function get_detail_stok($opsi_satuan,$tanggal_start,$tanggal_end,$produk_id,$query,$start,$end){
			$sql="select * from gudang";
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			
			$limit = $sql." LIMIT ".$start.",".$end;		
			$result = $this->db->query($limit);  
			$i=0;
			
			if($opsi_satuan=='terkecil')
				$sql_produk="SELECT * FROM vu_produk_satuan_terkecil WHERE produk_aktif='Aktif'";
			else
				$sql_produk="SELECT * FROM vu_produk_satuan_default WHERE produk_aktif='Aktif'";
					
			foreach($result->result() as $row){
				
				$data[$i]["gudang_id"]=$row->gudang_id;
				$data[$i]["gudang_nama"]=$row->gudang_nama;
				$data[$i]["jumlah_masuk"]=0;
				$data[$i]["jumlah_keluar"]=0;
				$data[$i]["jumlah_koreksi"]=0;
				$data[$i]["jumlah_stok"]=0;
				
				$result_produk=$this->db->query($sql_produk);
				if($result_produk->num_rows()){
					$rowproduk=$result_produk->row();
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
											AND gudang='".$row->gudang_id."'
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
					$sql_stok_mutasi="SELECT 	ifnull(sum(jml_terima_barang*konversi_nilai)
										+sum(jml_terima_bonus*konversi_nilai)
										+sum(jml_mutasi_masuk*konversi_nilai)
										+sum(jml_retur_produk*konversi_nilai)
										+sum(jml_retur_paket*konversi_nilai),0) as jumlah_masuk,
										ifnull(sum(jml_koreksi_stok*konversi_nilai),0) as jumlah_koreksi,
										ifnull(sum(jml_retur_beli*konversi_nilai)
										+sum(jml_mutasi_keluar*konversi_nilai)
										+sum(jml_jual_produk*konversi_nilai)
										+sum(jml_jual_grooming*konversi_nilai)
										+sum(jml_pakai_cabin*konversi_nilai),0) as jumlah_keluar
								FROM	vu_stok_new_produk
								WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
										AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
										AND produk_id='".$rowproduk->produk_id."'
										AND gudang='".$row->gudang_id."'
										AND status<>'Batal'
								GROUP BY produk_id";
					//echo $sql_stok_mutasi;
					
					$rs_mutasi=$this->db->query($sql_stok_mutasi);
					if($rs_mutasi->num_rows())
					{
						$ds_mutasi=$rs_mutasi->row();
						$data[$i]["jumlah_masuk"]==round($ds_mutasi->jumlah_masuk*$data[$i]["konversi_nilai"],3);;
						$data[$i]["jumlah_keluar"]=round($ds_mutasi->jumlah_keluar*$data[$i]["konversi_nilai"],3);;
						$data[$i]["jumlah_koreksi"]=round($ds_mutasi->jumlah_koreksi*$data[$i]["konversi_nilai"],3);
						$data[$i]["jumlah_stok"]=round(($data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]+$data[$i]["jumlah_koreksi"]-$data[$i]["jumlah_keluar"]),3);
					}else{
						$data[$i]["jumlah_masuk"]=0;
						$data[$i]["jumlah_keluar"]=0;
						$data[$i]["jumlah_koreksi"]=0;
						$data[$i]["jumlah_stok"]=round(($data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]+$data[$i]["jumlah_koreksi"]-$data[$i]["jumlah_keluar"]),3);
					}

				}
			
				$i++;
			}
				
				//stok mutasi
				
				//untuk gudang besar
				/*if($row->gudang_id==1)
				{
					
					//saldo awal
					$sql_stokawal="SELECT sum(jumlah_terima)-sum(jumlah_retur_beli)+sum(jumlah_masuk)-sum(jumlah_keluar)+sum(jumlah_koreksi) jumlah_awal 									FROM vu_stok_gudang_besar_tanggal
							WHERE produk_id='".$produk_id."' 
							AND date_format(tanggal,'%Y-%m-%d')<'".$tanggal_start."'
							GROUP BY produk_id";
					$q_stokawal=$this->db->query($sql_stokawal);
					if($q_stokawal->num_rows())
					{
						$ds_stokawal=$q_stokawal->row();
						$data[$i]["jumlah_awal"]=$ds_stokawal->jumlah_awal;
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
								WHERE produk_id='".$produk_id."' 
								AND date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								GROUP BY produk_id";
					$rs_mutasi=$this->db->query($sql_mutasi);
					if($rs_mutasi->num_rows())
					{
						$ds_mutasi=$rs_mutasi->row();
						$data[$i]["jumlah_masuk"]=$ds_mutasi->jumlah_terima+$ds_mutasi->jumlah_masuk;
						$data[$i]["jumlah_keluar"]=$ds_mutasi->jumlah_keluar+$ds_mutasi->jumlah_retur_beli;
						$data[$i]["jumlah_koreksi"]=$ds_mutasi->jumlah_koreksi;
						$data[$i]["jumlah_stok"]=$data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]+$data[$i]["jumlah_koreksi"];
						
					}else{
						$data[$i]["jumlah_masuk"]=0;
						$data[$i]["jumlah_keluar"]=0;
						$data[$i]["jumlah_koreksi"]=0;
						$data[$i]["jumlah_stok"]=$data[$i]["jumlah_awal"];
					}
				
				}elseif($row->gudang_id==2)
				{
					//gudang kasir/produk
					
					//stok awal
					$sql_stokawal="SELECT sum(jumlah_masuk)+sum(jumlah_retur_produk)+sum(jumlah_retur_paket)-sum(jumlah_jual)-sum(jumlah_keluar)+sum(jumlah_koreksi) as jumlah_awal
									FROM vu_stok_gudang_produk_tanggal
									WHERE produk_id='".$produk_id."' 
									AND date_format(tanggal,'%Y-%m-%d')<'".$tanggal_start."'
									GROUP BY produk_id";
					$q_stokawal=$this->db->query($sql_stokawal);
					if($q_stokawal->num_rows())
					{
						$ds_stokawal=$q_stokawal->row();
						$data[$i]["jumlah_awal"]=$ds_stokawal->jumlah_awal;
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
								WHERE produk_id='".$produk_id."' 
								AND date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
								GROUP BY produk_id";
					$rs_mutasi=$this->db->query($sql_mutasi);
					if($rs_mutasi->num_rows())
					{
						$ds_mutasi=$rs_mutasi->row();
						$data[$i]["jumlah_masuk"]=$ds_mutasi->jumlah_retur_produk+$ds_mutasi->jumlah_retur_paket+$ds_mutasi->jumlah_masuk;
						$data[$i]["jumlah_keluar"]=$ds_mutasi->jumlah_keluar;
						$data[$i]["jumlah_koreksi"]=$ds_mutasi->jumlah_koreksi;
						$data[$i]["jumlah_stok"]=$data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]+$data[$i]["jumlah_koreksi"];
						
					}else{
						$data[$i]["jumlah_masuk"]=0;
						$data[$i]["jumlah_keluar"]=0;
						$data[$i]["jumlah_koreksi"]=0;
						$data[$i]["jumlah_stok"]=$data[$i]["jumlah_awal"];
					}
					
				}else{
					//gudang lainnya

					//stok awal
					$sql_stokawal="SELECT sum(jumlah_masuk)-sum(jumlah_keluar)+sum(jumlah_koreksi) as jumlah_awal
									FROM vu_stok_mutasi_all
									WHERE produk_id='".$produk_id."' 
									AND date_format(mutasi_tanggal,'%Y-%m-%d')<'".$tanggal_start."'
									GROUP BY produk_id";
					$q_stokawal=$this->db->query($sql_stokawal);
					if($q_stokawal->num_rows())
					{
						$ds_stokawal=$q_stokawal->row();
						$data[$i]["jumlah_awal"]=$ds_stokawal->jumlah_awal;
					}else{
						$data[$i]["jumlah_awal"]=0;
					}
					
					//pake cabin
					$sql_cabin="SELECT sum(jumlah_konversi) as jumlah_cabin
								FROM vu_stok_pakai_cabin
								WHERE produk_id='".$produk_id."' 
								AND date_format(cabin_date_create,'%Y-%m-%d')<'".$tanggal_start."'
								GROUP BY produk_id";
					$q_cabin=$this->db->query($sql_cabin);
					if($q_cabin->num_rows())
					{
						$ds_cabin=$q_cabin->row();
						$data[$i]["jumlah_awal"]=$data[$i]["jumlah_awal"]-$ds_cabin->jumlah_cabin;
					}
					
					
					//mutasi
					$sql_mutasi="SELECT 	sum(jumlah_masuk) as jumlah_masuk,
											sum(jumlah_keluar) as jumlah_keluar,
											sum(jumlah_koreksi) as jumlah_koreksi
									FROM vu_stok_mutasi_all
									WHERE produk_id='".$produk_id."' 
									AND date_format(mutasi_tanggal,'%Y-%m-%d')>='".$tanggal_start."'
									AND date_format(mutasi_tanggal,'%Y-%m-%d')<='".$tanggal_end."'
									GROUP BY produk_id";
									
					$rs_mutasi=$this->db->query($sql_mutasi);
					if($rs_mutasi->num_rows())
					{
						$ds_mutasi=$rs_mutasi->row();
						$data[$i]["jumlah_masuk"]=$ds_mutasi->jumlah_masuk;
						$data[$i]["jumlah_keluar"]=$ds_mutasi->jumlah_keluar;
						$data[$i]["jumlah_koreksi"]=$ds_mutasi->jumlah_koreksi;
						$data[$i]["jumlah_stok"]=$data[$i]["jumlah_awal"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]+$data[$i]["jumlah_koreksi"];
						
					}else{
						$data[$i]["jumlah_masuk"]=0;
						$data[$i]["jumlah_keluar"]=0;
						$data[$i]["jumlah_koreksi"]=0;
						$data[$i]["jumlah_stok"]=$data[$i]["jumlah_awal"];
					}
					
					//pake cabin
					$sql_cabin="SELECT sum(jumlah_konversi) as jumlah_cabin
								FROM vu_stok_pakai_cabin
								WHERE produk_id='".$produk_id."' 
								AND date_format(cabin_date_create,'%Y-%m-%d')>='".$tanggal_start."'
								AND date_format(cabin_date_create,'%Y-%m-%d')<='".$tanggal_end."'
								GROUP BY produk_id";
					$q_cabin=$this->db->query($sql_cabin);
					if($q_cabin->num_rows())
					{
						$ds_cabin=$q_cabin->row();
						$data[$i]["jumlah_stok"]=$data[$i]["jumlah_stok"]-$ds_cabin->jumlah_cabin;
						$data[$i]["jumlah_keluar"]=$data[$i]["jumlah_keluar"]+$ds_cabin->jumlah_cabin;
					}
					
				}*/
			/*	$i++;
			}*/
			
			if($nbrows>0){
				
				$jsonresult = json_encode($data);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
			
		}
		
		//function for get list record
		function vu_stok_all_saldo_list($produk_id, $opsi_satuan, $tanggal_start,$tanggal_end,$filter,$start,$end){
			
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
			
			$query_first=$this->db->query($sql);
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			
			if($produk_id=="")
				$sql = $sql." LIMIT ".$start.",".$end;		
			
			//echo $sql;
			
			$result = $this->db->query($sql); 
			$i=0;
			
			foreach($result->result() as $rowproduk){
				
				
				$data[$i]["produk_id"]=$rowproduk->produk_id;
				$data[$i]["produk_kode"]=$rowproduk->produk_kode;
				$data[$i]["tanggal_start"]=$tanggal_start;
				$data[$i]["tanggal_end"]=$tanggal_end;
				$data[$i]["produk_nama"]=$rowproduk->produk_nama;
				$data[$i]["satuan_id"]=$rowproduk->satuan_id;
				$data[$i]["satuan_kode"]=$rowproduk->satuan_kode;
				$data[$i]["satuan_nama"]=$rowproduk->satuan_nama;	
				if($opsi_satuan=='terkecil')
					$data[$i]["konversi_nilai"]=1;
				else
					$data[$i]["konversi_nilai"]=1/$rowproduk->konversi_nilai;
				
				$sql_stok="SELECT   sum(jml_terima_barang*konversi_nilai)+ 
									sum(jml_terima_bonus*konversi_nilai) as jumlah_terima,
									sum(jml_mutasi_masuk*konversi_nilai) as jumlah_masuk,
									sum(jml_retur_produk*konversi_nilai) as jumlah_retur_produk,
									sum(jml_retur_paket*konversi_nilai) as jumlah_retur_paket,
									sum(jml_koreksi_stok*konversi_nilai) as jumlah_koreksi,
									sum(jml_retur_beli*konversi_nilai) as jumlah_retur_beli,
									sum(jml_mutasi_keluar*konversi_nilai) as jumlah_keluar,
									sum(jml_jual_produk*konversi_nilai)+sum(jml_jual_grooming*konversi_nilai) as jumlah_jual,
									sum(jml_pakai_cabin*konversi_nilai) as jumlah_pakai_cabin
							FROM	vu_stok_new_produk
							WHERE   date_format(tanggal,'%Y-%m-%d')>='".$tanggal_start."'
									AND date_format(tanggal,'%Y-%m-%d')<='".$tanggal_end."'
									AND produk_id='".$rowproduk->produk_id."' 
									AND status<>'Batal'
							GROUP BY produk_id";
				$rsdata=$this->db->query($sql_stok);
				if($rsdata->num_rows()){
					$row=$rsdata->row();
					$data[$i]["stok_awal"]=$this->get_stok_awal($rowproduk->produk_id,$tanggal_start)*$data[$i]["konversi_nilai"];
					$data[$i]["jumlah_terima"]=$row->jumlah_terima*$data[$i]["konversi_nilai"];
					$data[$i]["jumlah_masuk"]=$row->jumlah_masuk*$data[$i]["konversi_nilai"];
					$data[$i]["jumlah_keluar"]=$row->jumlah_keluar*$data[$i]["konversi_nilai"];
					$data[$i]["jumlah_retur_beli"]=$row->jumlah_retur_beli*$data[$i]["konversi_nilai"];
					$data[$i]["jumlah_jual"]=$row->jumlah_jual*$data[$i]["konversi_nilai"];
					$data[$i]["jumlah_retur_produk"]=$row->jumlah_retur_produk*$data[$i]["konversi_nilai"];
					$data[$i]["jumlah_retur_paket"]=$row->jumlah_retur_paket*$data[$i]["konversi_nilai"];
					$data[$i]["jumlah_koreksi"]=$row->jumlah_koreksi*$data[$i]["konversi_nilai"];
					$data[$i]["jumlah_pakai_cabin"]=$row->jumlah_pakai_cabin*$data[$i]["konversi_nilai"];
					$data[$i]["stok_saldo"]=round($data[$i]["stok_awal"]+$data[$i]["jumlah_terima"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]-$data[$i]["jumlah_retur_beli"]-$data[$i]["jumlah_jual"]+$data[$i]["jumlah_retur_produk"]+$data[$i]["jumlah_retur_paket"]+$data[$i]["jumlah_koreksi"]-$data[$i]["jumlah_pakai_cabin"],3);	
				}else{
					$data[$i]["stok_awal"]=$this->get_stok_awal($rowproduk->produk_id,$tanggal_start)*$data[$i]["konversi_nilai"];
					$data[$i]["jumlah_terima"]=0;
					$data[$i]["jumlah_masuk"]=0;
					$data[$i]["jumlah_keluar"]=0;
					$data[$i]["jumlah_retur_beli"]=0;
					$data[$i]["jumlah_jual"]=0;
					$data[$i]["jumlah_retur_produk"]=0;
					$data[$i]["jumlah_retur_paket"]=0;
					$data[$i]["jumlah_koreksi"]=0;
					$data[$i]["jumlah_pakai_cabin"]=0;
					$data[$i]["stok_saldo"]=round($data[$i]["stok_awal"]+$data[$i]["jumlah_terima"]+$data[$i]["jumlah_masuk"]-$data[$i]["jumlah_keluar"]-$data[$i]["jumlah_retur_beli"]-$data[$i]["jumlah_jual"]+$data[$i]["jumlah_retur_produk"]+$data[$i]["jumlah_retur_paket"]+$data[$i]["jumlah_koreksi"]-$data[$i]["jumlah_pakai_cabin"],3);
				}
				$i++;
		
				
				/*//stok awal
				$sql_stokawal = "SELECT
					sum(`A`.`jumlah_terima`) as jumlah_terima,
					sum(`A`.`jumlah_retur_beli`) as jumlah_retur_beli,
					sum(`A`.`jumlah_jual`) as jumlah_jual,
					sum(`A`.`jumlah_retur_produk`) as jumlah_retur_produk,
					sum(`A`.`jumlah_retur_paket`) as jumlah_retur_paket,
					sum(`A`.`jumlah_cabin`) as jumlah_cabin,
					sum(`A`.`jumlah_koreksi`) as jumlah_koreksi,
					sum(`A`.`jumlah_saldo`) as jumlah_saldo
					FROM
					`vu_stok_all_saldo_tanggal` AS `A`
					WHERE
					date_format(A.tanggal,'%Y-%m-%d')<'".$tanggal_start."' 
					AND A.produk_id='".$rowproduk->produk_id."'
					GROUP BY 
					`A`.`produk_kode`,
					`A`.`produk_id`,
					`A`.`produk_nama`,
					`A`.`satuan_kode`,
					`A`.`satuan_id`,
					`A`.`satuan_nama`
					";
				$q_stokawal=$this->db->query($sql_stokawal);
				if($q_stokawal->num_rows()){
					$rs_stokawal=$q_stokawal->row();
					$data[$i]["stok_awal"]=$rs_stokawal->jumlah_saldo*$data[$i]["konversi_nilai"];
				}else{
					$data[$i]["stok_awal"]=0;
				}
				
				//stok mutasi dan saldo
				$sql_stokmutasi = "SELECT
					sum(`A`.`jumlah_terima`) as jumlah_terima,
					sum(`A`.`jumlah_retur_beli`) as jumlah_retur_beli,
					sum(`A`.`jumlah_jual`) as jumlah_jual,
					sum(`A`.`jumlah_retur_produk`) as jumlah_retur_produk,
					sum(`A`.`jumlah_retur_paket`) as jumlah_retur_paket,
					sum(`A`.`jumlah_cabin`) as jumlah_cabin,
					sum(`A`.`jumlah_koreksi`) as jumlah_koreksi,
					sum(`A`.`jumlah_saldo`) as jumlah_saldo
					FROM
					`vu_stok_all_saldo_tanggal` AS `A`
					WHERE
					date_format(A.tanggal,'%Y-%m-%d')>='".$tanggal_start."' 
					AND date_format(A.tanggal,'%Y-%m-%d')<='".$tanggal_end."' 
					AND A.produk_id='".$rowproduk->produk_id."' 
					GROUP BY 
					`A`.`produk_kode`,
					`A`.`produk_id`,
					`A`.`produk_nama`,
					`A`.`satuan_kode`,
					`A`.`satuan_id`,
					`A`.`satuan_nama`
					";
					//echo $sql_stokmutasi;
					
				$q_stokmutasi=$this->db->query($sql_stokmutasi);
				if($q_stokmutasi->num_rows()){
					$rs_stokmutasi=$q_stokmutasi->row();
					$data[$i]["jumlah_terima"]=$rs_stokmutasi->jumlah_terima*$data[$i]["konversi_nilai"];
					$data[$i]["jumlah_retur_beli"]=$rs_stokmutasi->jumlah_retur_beli*$data[$i]["konversi_nilai"];
					$data[$i]["jumlah_jual"]=$rs_stokmutasi->jumlah_jual*$data[$i]["konversi_nilai"];
					$data[$i]["jumlah_retur_produk"]=$rs_stokmutasi->jumlah_retur_produk*$data[$i]["konversi_nilai"];
					$data[$i]["jumlah_retur_paket"]=$rs_stokmutasi->jumlah_retur_paket*$data[$i]["konversi_nilai"];
					$data[$i]["jumlah_cabin"]=$rs_stokmutasi->jumlah_cabin*$data[$i]["konversi_nilai"];
					$data[$i]["jumlah_koreksi"]=$rs_stokmutasi->jumlah_koreksi*$data[$i]["konversi_nilai"];
					$data[$i]["stok_saldo"]=($data[$i]["stok_awal"]+$rs_stokmutasi->jumlah_saldo)*$data[$i]["konversi_nilai"];	
				}else{
					$data[$i]["jumlah_terima"]=0;
					$data[$i]["jumlah_retur_beli"]=0;
					$data[$i]["jumlah_jual"]=0;
					$data[$i]["jumlah_retur_produk"]=0;
					$data[$i]["jumlah_retur_paket"]=0;
					$data[$i]["jumlah_cabin"]=0;
					$data[$i]["jumlah_koreksi"]=0;
					$data[$i]["stok_saldo"]=$data[$i]["stok_awal"]*$data[$i]["konversi_nilai"];
				}*/

			}
			
			if($nbrows>0){
				
				$jsonresult = json_encode($data);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
		
	
		//function for advanced search record
		function vu_stok_all_saldo_search($produk_kode ,$produk_nama,$satuan_nama ,$stok_saldo ,$start,$end){
			//full query
			$query="select * from vu_stok_all_saldo";
			
			if($produk_kode!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_id LIKE '%".$produk_kode."%'";
			};
			if($produk_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_nama LIKE '%".$produk_nama."%'";
			};
			if($satuan_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " satuan_nama LIKE '%".$satuan_nama."%'";
			};
			if($stok_saldo!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " stok_saldo LIKE '%".$stok_saldo."%'";
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
		function vu_stok_all_saldo_print($produk_id ,$produk_nama ,$satuan_id ,$satuan_nama ,$stok_saldo ,$option,$filter){
			//full query
			$sql="select * from vu_stok_all_saldo";
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
		function vu_stok_all_saldo_export_excel($produk_id ,$produk_nama ,$satuan_id ,$satuan_nama ,$stok_saldo ,$option,$filter){
			//full query
			$sql="select * from vu_stok_all_saldo";
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