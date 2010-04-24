<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: hpp Model
	+ Description	: For record model process back-end
	+ Filename 		: c_hpp.php
 	+ creator 		: 
 	+ Created on 09/Apr/2010 10:47:15
	
*/

class M_hpp extends Model{
		
		//constructor
		function M_hpp() {
			parent::Model();
		}
		
		
		function get_produk_list($filter,$start,$end){
			$sql="select * from vu_produk_satuan_terkecil";
			if($filter<>""){
				$sql.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$sql.="( produk_kode '%".addslashes($filter)."%' OR 
						 produk_nama '%".addslashes($filter)."%' OR 
						 satuan_kode '%".addslashes($filter)."%' OR 
						 satuan_nama '%".addslashes($filter)."%')";
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
		
		function get_periode(){
			$sql="SELECT distinct substr(min(tanggal),1,7) as min_date, substr(max(tanggal),1,7) as max_date from vu_hpp_tanggal";
			$query=$this->db->query($sql);
			if($query->num_rows()>0){
				$ds=$query->row();
				$min_date=$ds->min_date;
				$max_date=$ds->max_date;
				$min_year=substr($min_date,0,4);
				$max_year=substr($max_date,0,4);
				$range_year=$max_year-$min_year;
				
				$min_month=substr($min_date,5,2);
				$max_month=substr($max_date,5,2);
				
				//echo $min_year." s/d ".$max_year;
				//echo $min_month."-".$max_month;
				//min year
				$j=0;
				for($i=12;$i>=(int)$min_month;$i--){
					$data[$j]["periode_tanggal"]=$min_year."-".(strlen($i)==1?"0".$i:$i);
					$j++;
				}
				//range year
				for($i=(int)$min_year;$i<(int)$max_year;$i++){
					for($k=1;$k<=12;$k++){
						$data[$j]["periode_tanggal"]=$i."-".(strlen($k)==1?"0".$k:$k);
						$j++;
					}
				}
				
				//max year
				for($i=1;$i<=$max_month;$i++){
					$data[$j]["periode_tanggal"]=$max_year."-".(strlen($i)==1?"0".$i:$i);
					$j++;
				}
				
				return $data;
			}
			else
				return "";
				
		}
		
		function get_jumlah_beli($periode_start, $periode_end,$produk_id){
			$sql="SELECT sum(jumlah_konversi) as jumlah_beli from vu_hpp_beli 
					where DATE_FORMAT(tanggal,'%Y-%m-%d') >= '".$periode_start."' 
					AND DATE_FORMAT(tanggal,'%Y-%m-%d') <= '".$periode_end."' 
					AND produk_id='".$produk_id."'";
			$query=$this->db->query($sql);
			if($query->num_rows()>0){
				$row=$query->row();
				return $row->jumlah_beli;
			}else
				return 0;
		}
		
		function get_harga_beli($periode_start, $periode_end, $produk_id){
			$sql="SELECT avg(harga_beli) as harga_beli from vu_hpp_beli 
					where DATE_FORMAT(tanggal,'%Y-%m-%d') >= '".$periode_start."' 
					AND DATE_FORMAT(tanggal,'%Y-%m-%d') <= '".$periode_end."' 
					AND produk_id='".$produk_id."'";
			$query=$this->db->query($sql);
			if($query->num_rows()>0){
				$row=$query->row();
				return $row->harga_beli;
			}else
				return 0;
			
		}
		
		function get_nilai_persediaan($periode_start,$periode_end,$produk_id){
			$persediaan=$this->get_harga_beli($periode_start, $periode_end, $produk_id)*$this->get_stok_saldo($periode_end, $produk_id);
			return $persediaan;
		}
		
		function get_stok_saldo($periode, $produk_id){
			$sql="SELECT sum(jumlah_saldo) as stok_saldo from vu_stok_all_saldo_tanggal 
					where DATE_FORMAT(tanggal,'%Y-%m-%d') <= '".$periode."'
					AND produk_id='".$produk_id."'";
			$query=$this->db->query($sql);
			//echo $sql;
			if($query->num_rows()>0){
				$row=$query->row();
				return $row->stok_saldo;
			}else
				return 0;
		}
		
		//add periode bulan
		function add_periode($periode,$nilai){
			$tahun=substr($periode,1,4);
			$bulan=substr($periode,5,7);
			if($bulan+$nilai>12){
				$bulan=($bulan+$nilai) % 12;
				$tahun+=round(($bulan+$nilai)/12);
			}elseif($bulan+$nilai<1){
				$bulan=12+($bulan+$nilai)%12;
				$tahun+=round(($bulan+$nilai)/12);
			}
			$periode=$tahun."-".$bulan;
		}
		
		function hpp_list($produk_id, $tanggal_start, $tanggal_end, $filter,$start,$end){
			$i=0;$j=0;
			$sql="select * from vu_produk_satuan_terkecil ";
			if($produk_id<>""){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.=" produk_id='".$produk_id."'";
			}
			
			if($tanggal_start=="" || $tanggal_start==""){
				$nbrows=0;
			}else{
				$query=$this->db->query($sql);
				$nbrows=$query->num_rows();
				
				$limit=$sql." LIMIT ".$start.",".$end;
				$query=$this->db->query($limit);
				
				//cari awal tanggal
				$trans_first="";
				$sql_tgl="SELECT distinct min(tanggal) as min_date from vu_hpp_tanggal";
				$query_tgl=$this->db->query($sql_tgl);
				if($query_tgl->num_rows()){
					$row_tgl=$query_tgl->row();
					$trans_first=$row_tgl->min_date;
				}else
					$trans_first="";
				
				foreach($query->result() as $row){

					$persediaan_sebelum=$this->get_nilai_persediaan($trans_first,$tanggal_start,$row->produk_id);
					$stok_sebelum=$this->get_stok_saldo($tanggal_start,$row->produk_id);
					$harga_beli_sebelum=$this->get_harga_beli($trans_first, $tanggal_start, $row->produk_id);
					
					$stok_sekarang=$this->get_stok_saldo($tanggal_start, $tanggal_end, $row->produk_id);
					$harga_beli_sekarang=($this->get_harga_beli($tanggal_start, $tanggal_end, $row->produk_id)+$harga_beli_sebelum)/2;
					$persediaan_sekarang=$harga_beli_sekarang*$stok_sekarang;
					
					$jumlah_beli=$this->get_jumlah_beli($tanggal_start, $tanggal_end,$row->produk_id);

					$data[$i]["produk_id"]=$row->produk_id;
					$data[$i]["produk_kode"]=$row->produk_kode;
					$data[$i]["produk_nama"]=$row->produk_nama;
					$data[$i]["satuan_id"]=$row->satuan_id;
					$data[$i]["satuan_kode"]=$row->satuan_kode;
					$data[$i]["satuan_nama"]=$row->satuan_nama;
					$data[$i]["stok_awal"]=$stok_sebelum;
					$data[$i]["persediaan_awal"]=$persediaan_sebelum;
					$data[$i]["stok_saldo"]=$stok_sekarang;
					$data[$i]["persediaan_akhir"]=$persediaan_sekarang;
					$data[$i]["jumlah_beli"]=$jumlah_beli;
					$data[$i]["pembelian"]=$jumlah_beli*$harga_beli_sekarang;
					$data[$i]["barang_jual"]=$persediaan_sebelum+$data[$i]["pembelian"];
					$data[$i]["hpp"]=$data[$i]["barang_jual"]-$data[$i]["persediaan_akhir"];
					$data[$i]["harga_satuan"]=$harga_beli_sekarang;
					$i++;
				}
			}
			
			if($nbrows>0){
				$jsonresult = json_encode($data);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
/*		function for get list record
		function hpp_list($produk_id, $filter,$start,$end){
			$i=0;$j=0;
			$sql="select * from vu_produk_satuan_terkecil where produk_id='".$produk_id."'";
			$query=$this->db->query($sql);
			$jumlah_periode=count($this->get_periode());
			$nbrows=$query->num_rows()*$jumlah_periode;
			$periode_tgl=$this->get_periode();
			
				$limit_pro=($jumlah_periode>$end?1:ceil($end/$jumlah_periode));
				$limit=$sql." LIMIT ".$start.",1";
				$query=$this->db->query($limit);
			$nbrows=count($periode_tgl);
			foreach($query->result() as $row){
				foreach($periode_tgl as $periode){
					
					if($j>=$start) {
						$periode_tanggal=$periode["periode_tanggal"];
						$periode_sebelum=$this->add_periode($periode_tanggal,-1);
						$persediaan_sebelum=$this->get_nilai_persediaan($periode_sebelum,$row->produk_id);
						$stok_sebelum=$this->get_stok_saldo($periode_sebelum,$row->produk_id);
						$harga_beli_sebelum=$this->get_harga_beli($periode_sebelum,$row->produk_id);
						
						$stok_sekarang=$this->get_stok_saldo($periode_tanggal,$row->produk_id);
						$harga_beli_sekarang=($this->get_harga_beli($periode_tanggal,$row->produk_id)+$harga_beli_sebelum)/2;
						$persediaan_sekarang=$harga_beli_sekarang*$stok_sekarang;
						
						$jumlah_beli=$this->get_jumlah_beli($periode_tanggal,$row->produk_id);
						
						$data[$i]["bulan"]=$periode_tanggal;
						$data[$i]["produk_id"]=$row->produk_id;
						$data[$i]["produk_kode"]=$row->produk_kode;
						$data[$i]["produk_nama"]=$row->produk_nama;
						$data[$i]["satuan_id"]=$row->satuan_id;
						$data[$i]["satuan_kode"]=$row->satuan_kode;
						$data[$i]["satuan_nama"]=$row->satuan_nama;
						$data[$i]["stok_awal"]=$stok_sekarang;
						$data[$i]["persediaan_awal"]=$persediaan_sebelum;
						$data[$i]["stok_saldo"]=$stok_sekarang;
						$data[$i]["persediaan_akhir"]=$persediaan_sekarang;
						$data[$i]["jumlah_beli"]=$jumlah_beli;
						$data[$i]["pembelian"]=$jumlah_beli*$harga_beli_sekarang;
						$data[$i]["barang_jual"]=$persediaan_sebelum+$data[$i]["pembelian"];
						$data[$i]["hpp"]=$data[$i]["barang_jual"]-$data[$i]["persediaan_akhir"];
						$data[$i]["harga_satuan"]=$harga_beli_sekarang;
						$i++;
					}
					$j++;
					if($j>=($end+$start)) break;
				}
			}
			
			if($nbrows>0){
				$jsonresult = json_encode($data);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}*/
		
		
		//function for advanced search record
		function hpp_search($produk_id ,$produk_nama ,$satuan_id ,$satuan_nama ,$stok_saldo ,$start,$end){
			//full query
			$query="select * from hpp";
			
			if($produk_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_id LIKE '%".$produk_id."%'";
			};
			if($produk_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_nama LIKE '%".$produk_nama."%'";
			};
			if($satuan_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " satuan_id LIKE '%".$satuan_id."%'";
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
		function hpp_print($produk_id ,$produk_nama ,$satuan_id ,$satuan_nama ,$stok_saldo ,$option,$filter){
			//full query
			$sql="select * from hpp";
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
		function hpp_export_excel($produk_id ,$produk_nama ,$satuan_id ,$satuan_nama ,$stok_saldo ,$option,$filter){
			//full query
			$sql="select * from hpp";
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