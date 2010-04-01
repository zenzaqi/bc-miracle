<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: paket Model
	+ Description	: For record model process back-end
	+ Filename 		: c_paket.php
 	+ Author  		: masongbee
 	+ Created on 28/Jan/2010 10:41:22
	
*/

class M_master_ambil_paket extends Model{
		
		//constructor
		function M_master_ambil_paket() {
			parent::Model();
		}
		
		function get_paket_list($query,$start,$end){
			/*$rs_rows=0;
			if(is_numeric($query)==true){
				$sql_paket="SELECT distinct(dpaket_paket) FROM detail_jual_paket WHERE dpaket_master='$query'";
				$rs=$this->db->query($sql_paket);
				$rs_rows=$rs->num_rows();
			}*/
			
			$sql="SELECT paket_id, paket_kode, group_nama, paket_nama FROM paket INNER JOIN produk_group ON paket.paket_group=produk_group.group_id INNER JOIN kategori ON produk_group.group_kelompok=kategori.kategori_id WHERE kategori.kategori_jenis='paket' AND paket_aktif='Aktif'";
			if($query<>"" && is_numeric($query)==false){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.=" (paket_kode LIKE '%".addslashes($query)."%' OR paket_nama LIKE '%".addslashes($query)."%' ) ";
			}/*else{
				if($rs_rows){
					$filter="";
					$sql.=eregi("AND",$query)? " OR ":" AND ";
					foreach($rs->result() as $row_paket){
						
						$filter.="OR paket_id='".$row_paket->dpaket_paket."' ";
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
		
		function get_customer_list($query,$start,$end){
			$sql="SELECT cust_id,cust_no,cust_nama,cust_tgllahir,cust_alamat,cust_telprumah FROM customer WHERE cust_aktif='Aktif'";
			if($query<>"" && is_numeric($query)==false){
				$sql.=eregi("WHERE",$sql)?" AND ":" WHERE ";
				$sql.=" (cust_nama like '%".$query."%' ) ";
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
		
		function get_pengguna_paket_list($jpaket_id){
			//$query = "SELECT cust_id, cust_nama, cust_no, cust_tgllahir, cust_alamat, cust_telprumah FROM pengguna_paket LEFT JOIN customer ON(ppaket_cust=cust_id) WHERE ppaket_master='$jpaket_id'";
			$query = "SELECT cust_id, cust_nama, cust_no, cust_tgllahir, cust_alamat, cust_telprumah FROM pengguna_paket LEFT JOIN customer ON(ppaket_cust=cust_id) LEFT JOIN master_jual_paket ON(ppaket_master=jpaket_id AND ppaket_cust=jpaket_cust) WHERE ppaket_master='$jpaket_id'";
			
			//$query2 = "SELECT cust_id, cust_nama, cust_no, cust_tgllahir, cust_alamat, cust_telprumah FROM pengguna_paket LEFT JOIN customer ON(ppaket_cust=cust_id) LEFT JOIN master_jual_paket ON(ppaket_master=jpaket_id AND ppaket_cust<>jpaket_cust) WHERE ppaket_master='$jpaket_id'";
			//echo $query."<br />";
			//echo $query2;
			
			
			$result = $this->db->query($query);
			$nbrows = $result->num_rows();
			
			//$result2 = $this->db->query($query2);
			//$nbrows2 = $result2->num_rows();
			
			//$nbrows=0;
			//$nbrows2=0;
			
			if($nbrows>0 || $nbrows2>0){
				foreach($result->result() as $row){
					$arr[] = $row;
				}
				/*if($nbrows>0){
					foreach($result->result() as $row){
						$arr[] = $row;
					}
				}
				if($nbrows2>0){
					foreach($result2->result() as $row2){
						$arr[] = $row2;
					}
				}
				$nbrows=$nbrows+$nbrows2;*/
				$jsonresult = json_encode($arr);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
		function get_history_ambil_paket($apaket_id,$start,$end){
			/* Ambil dari db.detail_ambil_paket */
			$query =   "SELECT 
							/*m.apaket_faktur, 
							pk.paket_nama, */
							pr.rawat_nama, 
							d.dapaket_jumlah, 
							c.cust_nama,
							/*date_format(d.dapaket_date_create, '%Y-%m-%d') as tgl_ambil*/
							date_format(d.tgl_ambil, '%Y-%m-%d') as tgl_ambil
						FROM detail_ambil_paket d
						/*LEFT JOIN master_ambil_paket m ON ( d.dapaket_master = m.apaket_id ) */
						LEFT JOIN submaster_apaket_item s ON ( d.dapaket_sapaket= s.sapaket_id ) 
						LEFT JOIN perawatan pr ON ( s.sapaket_item = pr.rawat_id ) 
						/*LEFT JOIN paket pk ON ( m.apaket_paket = pk.paket_id ) */
						LEFT JOIN customer c ON ( d.dapaket_cust = c.cust_id )
						WHERE dapaket_master='$apaket_id'
						ORDER BY tgl_ambil"; //by hendri
			


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
		
		//Ambil Perawatan berdasarkan db.paket_isi_perawatan.rpaket_perawatan yang dihasilkan dari (db.paket_isi_perawatan.rpaket_master = paket.paket_id)
		function get_isi_rawat_list($apaket_id,$start,$end){
			$rs_rows=0;
			if(is_numeric($apaket_id)==true){
				/*$sql_rpaket="SELECT distinct(rpaket_perawatan) FROM paket_isi_perawatan WHERE rpaket_master='$paket_id'";
				$rs=$this->db->query($sql_rpaket);
				$rs_rows=$rs->num_rows();*/
				
				$sql = "SELECT sapaket_id, rawat_id,rawat_kode,rawat_nama,sapaket_sisa_item FROM submaster_apaket_item LEFT JOIN perawatan ON(sapaket_item=rawat_id) WHERE sapaket_jenis_item='perawatan' AND sapaket_master='$apaket_id' AND (rawat_aktif='Aktif' OR rawat_aktif='Tidak Aktif')";
				
				/*if($rs_rows){
					$filter="";
					$sql.=eregi("AND",$paket_id)? " OR ":" AND ";
					foreach($rs->result() as $row_rpaket){
						
						$filter.="OR rpaket_perawatan='".$row_rpaket->rpaket_perawatan."' ";
					}
					$sql=$sql."(".substr($filter,2,strlen($filter)).")";
				}*/
				
				//$sql="SELECT rawat_id,rawat_nama,rawat_kode FROM paket_isi_perawatan INNER JOIN perawatan ON(rpaket_perawatan=rawat_id) WHERE rpaket_master='$paket_id'";
				$result = $this->db->query($sql);
				$nbrows = $result->num_rows();
				$limit = $sql." LIMIT ".$start.",".$end;			
				//echo $limit;
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
		}
		
		//function for detail
		//get record list
		function detail_ambil_paket_isi_perawatan_list($master_id,$query,$start,$end) {
			$query = "SELECT rpaket_id,rpaket_perawatan,rpaket_jumlah FROM paket_isi_perawatan WHERE rpaket_master='".$master_id."'";
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
			$query = "SELECT max(paket_id) as master_id from paket";
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
		function detail_ambil_paket_isi_perawatan_purge($master_id){
			$sql="DELETE from paket_isi_perawatan where rpaket_master='".$master_id."'";
			$result=$this->db->query($sql);
		}
		//*eof
		
		//insert detail record
		function detail_ambil_paket_isi_perawatan_insert($dapaket_master ,$dapaket_sapaket ,$dapaket_jumlah ,$dapaket_cust, $tgl_ambil){
			/* INSERT ke db.detail_ambil_paket sebagai History Pengambilan Paket */
			$dti_dapaket=array(
			"dapaket_master"=>$dapaket_master,
			"dapaket_sapaket"=>$dapaket_sapaket,
			"dapaket_jumlah"=>$dapaket_jumlah,
			"dapaket_cust"=>$dapaket_cust,
			"tgl_ambil"		=>$tgl_ambil
			);
			$this->db->insert('detail_ambil_paket', $dti_dapaket);
			
			if($this->db->affected_rows()){
				$sql_sisa_item="SELECT sapaket_id, IF((sapaket_sisa_item-(sum(dapaket_jumlah)))!='null', (sapaket_sisa_item-(sum(dapaket_jumlah))), 0) as total_sisa_item FROM submaster_apaket_item LEFT JOIN detail_ambil_paket ON(dapaket_sapaket=sapaket_id) WHERE sapaket_id='$dapaket_sapaket' GROUP BY sapaket_id";
				$rs_sisa_item=$this->db->query($sql_sisa_item);
				if($rs_sisa_item->num_rows()){
					/* UPDATE db.submaster_apaket_item.sapaket_sisa_item */
					$rs_sisa_item_record=$rs_sisa_item->row_array();
					$total_sisa_item=$rs_sisa_item_record["total_sisa_item"];
					$dtu_sapaket=array(
					"sapaket_sisa_item"=>$total_sisa_item
					);
					$this->db->where('sapaket_id', $dapaket_sapaket);
					$this->db->update('submaster_apaket_item', $dtu_sapaket);
				}
				
				$sql_sisa_paket="SELECT apaket_id, IF((apaket_sisa_paket-(sum(dapaket_jumlah)))!='null', (apaket_sisa_paket-(sum(dapaket_jumlah))), 0) as total_sisa_paket FROM master_ambil_paket LEFT JOIN detail_ambil_paket ON(dapaket_master=apaket_id) WHERE apaket_id='$dapaket_master' GROUP BY apaket_id";
				$rs_sisa_paket=$this->db->query($sql_sisa_paket);
				if($rs_sisa_paket->num_rows()){
					/* UPDATE db.master_ambil_paket.apaket_sisa_paket */
					$rs_sisa_paket_record=$rs_sisa_paket->row_array();
					$total_sisa_paket=$rs_sisa_paket_record["total_sisa_paket"];
					$dtu_apaket=array(
					"apaket_sisa_paket"=>$total_sisa_paket
					);
					$this->db->where('apaket_id', $dapaket_master);
					$this->db->update('master_ambil_paket', $dtu_apaket);
				}
				
				return '1';
			}else
				return '0';

		}
		//end of function
		
		//function for get list record
		function ambil_paket_list($filter,$start,$end){
			/* Untuk menampilkan ke View.LIST = {Customer, No.Faktur Penjualan Paket, Tanggal Pembelian, Tanggal Expired Paket, Nama Paket } */
			//$query = "SELECT customer.cust_id, customer.cust_nama, customer.cust_no, master_jual_paket.jpaket_id, master_jual_paket.jpaket_nobukti, master_jual_paket.jpaket_tanggal, detail_jual_paket.dpaket_id, detail_jual_paket.dpaket_kadaluarsa, paket.paket_id, paket.paket_nama, paket.paket_kode, master_ambil_paket.apaket_sisa_paket, master_ambil_paket.apaket_id FROM master_ambil_paket INNER JOIN detail_jual_paket ON(dpaket_id=apaket_dpaket) LEFT JOIN master_jual_paket ON(jpaket_id=dpaket_master) LEFT JOIN customer ON(cust_id=jpaket_cust) LEFT JOIN paket ON(paket_id=dpaket_paket)";
			//$query = "SELECT * FROM vu_kasir_ambil_paket_list";
			$query =   "SELECT
							apaket_id, apaket_jpaket, apaket_faktur, apaket_faktur_tanggal, apaket_kadaluarsa, apaket_cust, 
							/*apaket_cust_no, apaket_cust_nama, */
							apaket_paket, 
							/*apaket_paket_kode, apaket_paket_nama, */
							apaket_paket_jumlah, apaket_sisa_paket ,
							c.cust_no, c.cust_nama, p.paket_kode, p.paket_nama
						FROM master_ambil_paket m
						LEFT OUTER JOIN customer c on c.cust_id = m.apaket_cust
						LEFT OUTER JOIN paket p on p.paket_id = m.apaket_paket
						WHERE apaket_sisa_paket >= 0 AND apaket_faktur_tanggal >= '2007-01-01'"; //by hendri

			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (c.cust_nama LIKE '%".addslashes($filter)."%' OR c.cust_no LIKE '%".addslashes($filter)."%' OR p.paket_kode LIKE '%".addslashes($filter)."%' OR p.paket_nama LIKE '%".addslashes($filter)."%')";
			}

			$query .= " ORDER BY apaket_faktur DESC";
			
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
		function ambil_paket_update($paket_id ,$paket_kode ,$paket_nama ,$paket_expired ){
			/* Check di db.master_ambil_paket apakah No.Faktur Penjualan Paket && Paket_ID telah ada di db.master_ambil_paket ? */
			/*$data = array(
				"paket_id"=>$paket_id, 
				"paket_kode"=>$paket_kode, 
				"paket_nama"=>$paket_nama, 
				"paket_expired"=>$paket_expired
			);
			$this->db->where('paket_id', $paket_id);
			$this->db->update('paket', $data);*/
			
			return '1';
		}
		
		//function for create new record
		function ambil_paket_create($paket_kode ,$paket_nama ,$paket_expired ){
			$data = array(
				"paket_kode"=>$paket_kode, 
				"paket_nama"=>$paket_nama, 
				"paket_expired"=>$paket_expired
			);
			$this->db->insert('paket', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function ambil_paket_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the pakets at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM paket WHERE paket_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM paket WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "paket_id= ".$pkid[$i];
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
		function ambil_paket_search($apaket_faktur ,$apaket_cust ,$apaket_paket ,$apaket_kadaluarsa ,$start,$end){
			//full query
			//$query="select * from paket";
			//$query = "SELECT apaket_id, apaket_jpaket, apaket_faktur, apaket_faktur_tanggal, apaket_kadaluarsa, apaket_cust, apaket_cust_no, apaket_cust_nama, apaket_paket, apaket_paket_kode, apaket_paket_nama, apaket_paket_jumlah, apaket_sisa_paket FROM master_ambil_paket";
			$query =   "SELECT apaket_id, apaket_jpaket, apaket_faktur, apaket_faktur_tanggal, apaket_kadaluarsa, apaket_cust, /*apaket_cust_no, apaket_cust_nama, */ apaket_paket, /*apaket_paket_kode, apaket_paket_nama, */ apaket_paket_jumlah, apaket_sisa_paket , c.cust_no, c.cust_nama, p.paket_kode, p.paket_nama FROM master_ambil_paket m LEFT OUTER JOIN customer c on c.cust_id = m.apaket_cust LEFT OUTER JOIN paket p on p.paket_id = m.apaket_paket WHERE apaket_sisa_paket > 0";
			
			if($apaket_faktur!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " apaket_faktur LIKE '%".$apaket_faktur."%'";
			};
			if($apaket_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " apaket_cust LIKE '%".$apaket_cust."%'";
			};
			if($apaket_paket!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " apaket_paket LIKE '%".$apaket_paket."%'";
			};
			if($apaket_kadaluarsa!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " date_format(apaket_kadaluarsa,'%Y-%m-%d')='$apaket_kadaluarsa'";
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
		function ambil_paket_print($paket_id ,$paket_kode ,$paket_nama ,$paket_expired ,$option,$filter){
			//full query
			$query="select * from paket";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (paket_id LIKE '%".addslashes($filter)."%' OR paket_kode LIKE '%".addslashes($filter)."%' OR paket_nama LIKE '%".addslashes($filter)."%' OR paket_expired LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($paket_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_id LIKE '%".$paket_id."%'";
				};
				if($paket_kode!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_kode LIKE '%".$paket_kode."%'";
				};
				if($paket_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_nama LIKE '%".$paket_nama."%'";
				};
				if($paket_expired!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_expired LIKE '%".$paket_expired."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function ambil_paket_export_excel($paket_id ,$paket_kode ,$paket_nama ,$paket_expired ,$option,$filter){
			//full query
			$query="select * from paket";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (paket_id LIKE '%".addslashes($filter)."%' OR paket_kode LIKE '%".addslashes($filter)."%' OR paket_nama LIKE '%".addslashes($filter)."%' OR paket_expired LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($paket_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_id LIKE '%".$paket_id."%'";
				};
				if($paket_kode!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_kode LIKE '%".$paket_kode."%'";
				};
				if($paket_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_nama LIKE '%".$paket_nama."%'";
				};
				if($paket_expired!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " paket_expired LIKE '%".$paket_expired."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>