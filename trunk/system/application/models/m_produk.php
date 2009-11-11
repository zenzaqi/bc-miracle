<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: produk Model
	+ Description	: For record model process back-end
	+ Filename 		: c_produk.php
 	+ Author  		: zainal, mukhlison
 	+ Created on 20/Aug/2009 10:29:05
	
*/

class M_produk extends Model{
		
		//constructor
		function M_produk() {
			parent::Model();
		}
		
		//function for detail
		//get record list
		function detail_satuan_konversi_list($master_id,$query,$start,$end) {
			$query = "SELECT * FROM satuan_konversi where konversi_produk='".$master_id."'";
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
		
		function get_kontribusi_produk_list(){
		$sql="SELECT kategori2_id,kategori2_nama FROM kategori2 where kategori2_jenis='produk' and kategori2_aktif='Aktif'";
		$query = $this->db->query($sql);
		$nbrows = $query->num_rows();
			if($nbrows>0){
				foreach($query->result() as $row){
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
			$query = "SELECT max(produk_id) as master_id from produk";
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
		function detail_satuan_konversi_purge($master_id){
			$sql="DELETE from satuan_konversi where konversi_produk='".$master_id."'";
			$result=$this->db->query($sql);
			return '1';
		}
		//*eof
		
		//insert detail record
		function detail_satuan_konversi_insert($konversi_id ,$konversi_produk ,$konversi_satuan ,$konversi_nilai ,$konversi_default){
			//if master id not capture from view then capture it from max pk from master table
			if($konversi_produk=="" || $konversi_produk==NULL){
				$konversi_produk=$this->get_master_id();
			}
			
			$data = array(
				"konversi_produk"=>$konversi_produk, 
				"konversi_satuan"=>$konversi_satuan, 
				"konversi_nilai"=>$konversi_nilai,
				"konversi_default"=>$konversi_default
			);
			$this->db->insert('satuan_konversi', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		//end of function
		
		/*function get_kode($pattern_g,$pattern_j){
			$result=$this->m_public_function->get_kode_2("produk","produk_kode",$pattern_g,$pattern_j,6);
			return $result;
		}*/
		
		function get_kode($pattern){
			$result=$this->m_public_function->get_kode_1("produk","produk_kode",$pattern,6);
			return $result;
		}
		//function for get list record
		function produk_list($filter,$start,$end){
			//$query = "SELECT * FROM produk,produk_group,kategori,satuan,jenis,kategori2 WHERE produk_group=group_id AND produk_kategori=kategori_id AND produk_satuan=satuan_id AND produk_jenis=jenis_id AND produk_kontribusi=kategori2_id";
			$query="SELECT `produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_kodelama` AS `produk_kodelama`,`produk`.`produk_group` AS `produk_group`,`produk_group`.`group_nama` AS `group_nama`,
`produk`.`produk_kategori` AS `produk_kategori`,`kategori`.`kategori_nama` AS `kategori_nama`,`kategori`.`kategori_jenis` AS `kategori_jenis`,`kategori`.`kategori_akun` AS `kategori_akun`,`produk`.`produk_nama` AS `produk_nama`,
`produk`.`produk_satuan` AS `produk_satuan`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`produk`.`produk_du` AS `produk_du`,
`produk`.`produk_dm` AS `produk_dm`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_aktif` AS `produk_aktif`,`produk`.`produk_jenis` AS `produk_jenis`,
`jenis`.`jenis_kode` AS `jenis_kode`,`jenis`.`jenis_nama` AS `jenis_nama`,`jenis`.`jenis_kelompok` AS `jenis_kelompok`,`produk`.`produk_kontribusi` AS `produk_kontribusi`,`kategori2`.`kategori2_nama` AS `kategori2_nama`,
`kategori2`.`kategori2_jenis` AS `kategori2_jenis` FROM (((((`produk` left join `produk_group` on((`produk`.`produk_group` = `produk_group`.`group_id`))) left join `kategori` on((`produk_group`.`group_kelompok` = `kategori`.`kategori_id`))) 
left join `satuan` on((`produk`.`produk_satuan` = `satuan`.`satuan_id`))) left join `jenis` on((`produk`.`produk_jenis` = `jenis`.`jenis_id`))) left join `kategori2` on((`produk`.`produk_kontribusi` = `kategori2`.`kategori2_id`)))";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (produk_id LIKE '%".addslashes($filter)."%' OR produk_kode LIKE '%".addslashes($filter)."%' OR produk_group LIKE '%".addslashes($filter)."%' OR produk_kategori LIKE '%".addslashes($filter)."%' OR produk_jenis LIKE '%".addslashes($filter)."%' OR produk_nama LIKE '%".addslashes($filter)."%' OR produk_satuan LIKE '%".addslashes($filter)."%' OR produk_du LIKE '%".addslashes($filter)."%' OR produk_dm LIKE '%".addslashes($filter)."%' OR produk_point LIKE '%".addslashes($filter)."%' OR produk_harga LIKE '%".addslashes($filter)."%' OR produk_aktif LIKE '%".addslashes($filter)."%' )";
			}
			
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
		function produk_update($produk_id ,$produk_kode ,$produk_kodelama ,$produk_group ,$produk_kategori ,$produk_kontribusi, $produk_jenis ,$produk_nama ,$produk_satuan ,$produk_du ,$produk_dm ,$produk_point ,$produk_volume ,$produk_harga ,$produk_keterangan ,$produk_aktif ){
		if ($produk_aktif=="")
			$produk_aktif = "Aktif";
			$data = array(
//				"produk_id"=>$produk_id, 
//				"produk_kode"=>$produk_kode, 
				"produk_kodelama"=>$produk_kodelama, 
//				"produk_group"=>$produk_group, 
//				"produk_kategori"=>$produk_kategori, 
				"produk_nama"=>$produk_nama, 
//				"produk_satuan"=>$produk_satuan, 
//				"produk_du"=>$produk_du, 
//				"produk_dm"=>$produk_dm, 
				"produk_point"=>$produk_point, 
				"produk_volume"=>$produk_volume, 
				"produk_harga"=>$produk_harga, 
				"produk_keterangan"=>$produk_keterangan, 
				"produk_aktif"=>$produk_aktif 
			);
			
			$sql="SELECT group_id,group_duproduk,group_dmproduk FROM produk_group WHERE group_id='".$produk_group."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$data["produk_group"]=$produk_group;
				$rs_sql=$rs->row();
				$data["produk_du"]=$rs_sql->group_duproduk;
				$data["produk_dm"]=$rs_sql->group_dmproduk;
			}
			
//			$sql="SELECT kategori_id FROM kategori WHERE kategori_id='".$produk_kategori."'";
//			$rs=$this->db->query($sql);
//			if($rs->num_rows())
//				$data["produk_kategori"]=$produk_kategori;
			
			$sql="SELECT kategori2_id FROM kategori2 WHERE kategori2_id='".$produk_kontribusi."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["produk_kontribusi"]=$produk_kontribusi;
				
			$sql="SELECT jenis_id FROM jenis WHERE jenis_id='".$produk_jenis."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["produk_jenis"]=$produk_jenis;
				
			$sql="SELECT satuan_id FROM satuan WHERE satuan_id='".$produk_satuan."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["produk_satuan"]=$produk_satuan;
			
			/*$sql="SELECT * FROM produk WHERE produk_id='".$produk_id."' AND produk_group='".$produk_group."' AND produk_jenis='".$produk_jenis."'";
			$rs=$this->db->query($sql);
			if(!($rs->num_rows())){
				$sql_g="SELECT group_id,group_kode FROM produk_group WHERE group_id='".$produk_group."'";
				$rs_g=$this->db->query($sql_g);
				if($rs_g->num_rows()){
					$rs_sql_g=$rs_g->row();
					$group_kode=$rs_sql_g->group_kode;
					$data["produk_group"]=$produk_group;
				}else{
					$sql_g="SELECT group_kode FROM produk,produk_group WHERE produk_group=group_id AND produk_id='".$produk_id."'";
					$rs_g=$this->db->query($sql_g);
					if($rs_g->num_rows()){
						$rs_sql_g=$rs_g->row();
						$group_kode=$rs_sql_g->group_kode;
					}
				}
				
				$sql_j="SELECT jenis_id,jenis_kode FROM jenis WHERE jenis_id='".$produk_jenis."'";
				$rs_j=$this->db->query($sql_j);
				if($rs_j->num_rows()){
					$rs_sql_j=$rs_j->row();
					$jenis_kode=$rs_sql_j->jenis_kode;
					$data["produk_jenis"]=$produk_jenis;
				}else{
					$sql_j="SELECT jenis_kode FROM produk,jenis WHERE produk_jenis=jenis_id AND produk_id='".$produk_id."'";
					$rs_j=$this->db->query($sql_j);
					if($rs_j->num_rows()){
						$rs_sql_j=$rs_j->row();
						$jenis_kode=$rs_sql_j->jenis_kode;
					}
				}
				$data["produk_kode"]=$this->get_kode($group_kode,$jenis_kode);
			}*/
			
			//generate produk kode
			//get group kode
			$group_kode="";
			$jenis_kode="";
			$sql_g="SELECT group_id,group_kode FROM produk_group WHERE group_id='".$produk_group."'";
			$rs_g=$this->db->query($sql_g);
			if($rs_g->num_rows()){
				$rs_sql_g=$rs_g->row();
				$group_kode=$rs_sql_g->group_kode;
				$data["produk_group"]=$produk_group;
			}else{
				$sql_g="select SUBSTRING(produk_kode,1,2) as group_kode from produk where produk_id='".$produk_id."'";
				$rs_g=$this->db->query($sql_g);
				if($rs_g->num_rows()){
					$rs_sql_g=$rs_g->row();
					$group_kode=$rs_sql_g->group_kode;
				}
			}
			//get jenis kode
			$sql_j="SELECT jenis_id,jenis_kode FROM jenis WHERE jenis_id='".$produk_jenis."'";
			$rs_j=$this->db->query($sql_j);
			if($rs_j->num_rows()){
				$rs_sql_j=$rs_j->row();
				$jenis_kode=$rs_sql_j->jenis_kode;
				$data["produk_jenis"]=$produk_jenis;
			}else{
				$sql_j="select SUBSTRING(produk_kode,3,2) as jenis_kode from produk where produk_id='".$produk_id."'";
				$rs_j=$this->db->query($sql_j);
				if($rs_j->num_rows()){
					$rs_sql_j=$rs_j->row();
					$jenis_kode=$rs_sql_j->jenis_kode;
				}
			}
			$pattern=$group_kode.$jenis_kode;
			//echo $jenis_kode;
			$produk_kode=$this->get_kode($pattern);
			if($produk_kode!=="" && strlen($produk_kode)==6)
				$data["produk_kode"]=$produk_kode;
				
			$sql="SELECT produk_du FROM produk WHERE produk_du!='".$produk_du."' AND produk_id='".$produk_id."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["produk_du"]=$produk_du;
			
			$sql="SELECT produk_dm FROM produk WHERE produk_dm!='".$produk_dm."' AND produk_id='".$produk_id."'";
			$rs=$this->db->query($sql);
			if($rs->num_rows())
				$data["produk_dm"]=$produk_dm;
			
			$this->db->where('produk_id', $produk_id);
			$this->db->update('produk', $data);
			
			return '1';
		}
		
		//function for create new record
		function produk_create($produk_kode ,$produk_kodelama ,$produk_group ,$produk_kategori ,$produk_kontribusi ,$produk_jenis ,$produk_nama ,$produk_satuan ,$produk_du ,$produk_dm ,$produk_point ,$produk_volume ,$produk_harga ,$produk_keterangan ,$produk_aktif ){
		if ($produk_aktif=="")
			$produk_aktif = "Aktif";
			if($produk_harga=="")
				$produk_harga=0;
			$data = array(
				"produk_kodelama"=>$produk_kodelama, 
				//"produk_kategori"=>$produk_kategori, 
				"produk_kontribusi"=>$produk_kontribusi,
				"produk_jenis"=>$produk_jenis, 
				"produk_group"=>$produk_group,
				"produk_nama"=>$produk_nama, 
				"produk_satuan"=>$produk_satuan, 
				"produk_du"=>$produk_du, 
				"produk_dm"=>$produk_dm, 
				"produk_point"=>$produk_point, 
				"produk_volume"=>$produk_volume, 
				"produk_harga"=>$produk_harga, 
				"produk_jenis"=>$produk_jenis,
				"produk_keterangan"=>$produk_keterangan, 
				"produk_aktif"=>$produk_aktif 
			);
			/*$sql="SELECT group_id, group_kode FROM produk_group WHERE group_id='".$produk_group."' ";
			$rs=$this->db->query($sql);
			if($rs->num_rows()){
				$row=$rs->row();
				
				$sql_2="SELECT jenis_id, jenis_kode FROM jenis WHERE jenis_id='".$produk_jenis."' ";
				$rs_2=$this->db->query($sql_2);
				if($rs_2->num_rows()){
					$row_2=$rs_2->row();
					$data["produk_kode"]=$this->get_kode($row->group_kode,$row_2->jenis_kode);
				}
				
				
			}*/
			
			//generate produk kode
			//get group kode
			$sql_g="SELECT group_id,group_kode FROM produk_group WHERE group_id='".$produk_group."'";
			$rs_g=$this->db->query($sql_g);
			if($rs_g->num_rows()){
				$rs_sql_g=$rs_g->row();
				$group_kode=$rs_sql_g->group_kode;
				$data["produk_group"]=$produk_group;
			}
			//get group2 kode
			$sql_g="SELECT jenis_id,jenis_kode FROM jenis WHERE jenis_id='".$produk_jenis."'";
			$rs_g=$this->db->query($sql_g);
			if($rs_g->num_rows()){
				$rs_sql_g=$rs_g->row();
				$jenis_kode=$rs_sql_g->jenis_kode;
				$data["produk_jenis"]=$produk_jenis;
			}
			$pattern=$group_kode.$jenis_kode;
			$produk_kode=$this->get_kode($pattern);
			if($produk_kode!=="" && strlen($produk_kode)==6)
				$data["produk_kode"]=$produk_kode;
				
			$this->db->insert('produk', $data); 
			if($this->db->affected_rows())
				return '1';
			else
				return '0';
		}
		
		//fcuntion for delete record
		function produk_delete($pkid){
			// You could do some checkups here and return '0' or other error consts.
			// Make a single query to delete all of the produks at the same time :
			if(sizeof($pkid)<1){
				return '0';
			} else if (sizeof($pkid) == 1){
				$query = "DELETE FROM produk WHERE produk_id = ".$pkid[0];
				$this->db->query($query);
			} else {
				$query = "DELETE FROM produk WHERE ";
				for($i = 0; $i < sizeof($pkid); $i++){
					$query = $query . "produk_id= ".$pkid[$i];
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
		function produk_search($produk_id ,$produk_kode ,$produk_kodelama ,$produk_group ,$produk_kategori ,$produk_jenis ,$produk_nama ,$produk_satuan ,$produk_du ,$produk_dm ,$produk_point ,$produk_kontribusi ,$produk_volume ,$produk_harga ,$produk_keterangan ,$produk_aktif ,$start,$end){
			//full query
			//$query="select * from vu_produk";
			$query="SELECT `produk`.`produk_id` AS `produk_id`,`produk`.`produk_kode` AS `produk_kode`,`produk`.`produk_kodelama` AS `produk_kodelama`,`produk`.`produk_group` AS `produk_group`,`produk_group`.`group_nama` AS `group_nama`,
`produk`.`produk_kategori` AS `produk_kategori`,`kategori`.`kategori_nama` AS `kategori_nama`,`kategori`.`kategori_jenis` AS `kategori_jenis`,`kategori`.`kategori_akun` AS `kategori_akun`,`produk`.`produk_nama` AS `produk_nama`,
`produk`.`produk_satuan` AS `produk_satuan`,`satuan`.`satuan_nama` AS `satuan_nama`,`satuan`.`satuan_id` AS `satuan_id`,`satuan`.`satuan_kode` AS `satuan_kode`,`produk`.`produk_du` AS `produk_du`,
`produk`.`produk_dm` AS `produk_dm`,`produk`.`produk_point` AS `produk_point`,`produk`.`produk_harga` AS `produk_harga`,`produk`.`produk_aktif` AS `produk_aktif`,`produk`.`produk_jenis` AS `produk_jenis`,
`jenis`.`jenis_kode` AS `jenis_kode`,`jenis`.`jenis_nama` AS `jenis_nama`,`jenis`.`jenis_kelompok` AS `jenis_kelompok`,`produk`.`produk_kontribusi` AS `produk_kontribusi`,`kategori2`.`kategori2_nama` AS `kategori2_nama`,
`kategori2`.`kategori2_jenis` AS `kategori2_jenis` FROM (((((`produk` left join `produk_group` on((`produk`.`produk_group` = `produk_group`.`group_id`))) left join `kategori` on((`produk_group`.`group_kelompok` = `kategori`.`kategori_id`))) 
left join `satuan` on((`produk`.`produk_satuan` = `satuan`.`satuan_id`))) left join `jenis` on((`produk`.`produk_jenis` = `jenis`.`jenis_id`))) left join `kategori2` on((`produk`.`produk_kontribusi` = `kategori2`.`kategori2_id`)))";
			
			if($produk_id!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_id LIKE '%".$produk_id."%'";
			};
			if($produk_kode!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_kode LIKE '%".$produk_kode."%'";
			};
			if($produk_kodelama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_kodelama LIKE '%".$produk_kodelama."%'";
			};
			if($produk_group!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_group LIKE '%".$produk_group."%'";
			};
			if($produk_kategori!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_kategori LIKE '%".$produk_kategori."%'";
			};
			if($produk_jenis!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_jenis LIKE '%".$produk_jenis."%'";
			};
			if($produk_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_nama LIKE '%".$produk_nama."%'";
			};
			if($produk_satuan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_satuan LIKE '%".$produk_satuan."%'";
			};
			if($produk_du!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_du LIKE '%".$produk_du."%'";
			};
			if($produk_dm!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_dm LIKE '%".$produk_dm."%'";
			};
			if($produk_point!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_point LIKE '%".$produk_point."%'";
			};
			if($produk_kontribusi!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_kontribusi='".$produk_kontribusi."'";
			};
			if($produk_volume!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_volume LIKE '%".$produk_volume."%'";
			};
			if($produk_harga!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_harga LIKE '%".$produk_harga."%'";
			};
			if($produk_keterangan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_keterangan LIKE '%".$produk_keterangan."%'";
			};
			if($produk_aktif!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " produk_aktif LIKE '%".$produk_aktif."%'";
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
		function produk_print($produk_id ,$produk_kode ,$produk_kodelama ,$produk_group ,$produk_kategori ,$produk_jenis ,$produk_nama ,$produk_satuan ,$produk_du ,$produk_dm ,$produk_point ,$produk_volume ,$produk_harga ,$produk_keterangan ,$produk_aktif ,$option,$filter){
			//full query
			$query="select * from produk";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (produk_id LIKE '%".addslashes($filter)."%' OR produk_kode LIKE '%".addslashes($filter)."%' OR produk_kodelama LIKE '%".addslashes($filter)."%' OR produk_group LIKE '%".addslashes($filter)."%' OR produk_kategori LIKE '%".addslashes($filter)."%' OR produk_jenis LIKE '%".addslashes($filter)."%' OR produk_nama LIKE '%".addslashes($filter)."%' OR produk_satuan LIKE '%".addslashes($filter)."%' OR produk_du LIKE '%".addslashes($filter)."%' OR produk_dm LIKE '%".addslashes($filter)."%' OR produk_point LIKE '%".addslashes($filter)."%' OR produk_volume LIKE '%".addslashes($filter)."%' OR produk_harga LIKE '%".addslashes($filter)."%' OR produk_keterangan LIKE '%".addslashes($filter)."%' OR produk_aktif LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($produk_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_id LIKE '%".$produk_id."%'";
				};
				if($produk_kode!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_kode LIKE '%".$produk_kode."%'";
				};
				if($produk_kodelama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_kodelama LIKE '%".$produk_kodelama."%'";
				};
				if($produk_group!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_group LIKE '%".$produk_group."%'";
				};
				if($produk_kategori!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_kategori LIKE '%".$produk_kategori."%'";
				};
				if($produk_jenis!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_jenis LIKE '%".$produk_jenis."%'";
				};
				if($produk_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_nama LIKE '%".$produk_nama."%'";
				};
				if($produk_satuan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_satuan LIKE '%".$produk_satuan."%'";
				};
				if($produk_du!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_du LIKE '%".$produk_du."%'";
				};
				if($produk_dm!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_dm LIKE '%".$produk_dm."%'";
				};
				if($produk_point!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_point LIKE '%".$produk_point."%'";
				};
				if($produk_volume!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_volume LIKE '%".$produk_volume."%'";
				};
				if($produk_harga!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_harga LIKE '%".$produk_harga."%'";
				};
				if($produk_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_keterangan LIKE '%".$produk_keterangan."%'";
				};
				if($produk_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_aktif LIKE '%".$produk_aktif."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function produk_export_excel($produk_id ,$produk_kode ,$produk_kodelama ,$produk_group ,$produk_kategori ,$produk_jenis ,$produk_nama ,$produk_satuan ,$produk_du ,$produk_dm ,$produk_point ,$produk_volume ,$produk_harga ,$produk_keterangan ,$produk_aktif ,$option,$filter){
			//full query
			$query="select * from produk";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (produk_id LIKE '%".addslashes($filter)."%' OR produk_kode LIKE '%".addslashes($filter)."%' OR produk_kodelama LIKE '%".addslashes($filter)."%' OR produk_group LIKE '%".addslashes($filter)."%' OR produk_kategori LIKE '%".addslashes($filter)."%' OR produk_jenis LIKE '%".addslashes($filter)."%' OR produk_nama LIKE '%".addslashes($filter)."%' OR produk_satuan LIKE '%".addslashes($filter)."%' OR produk_du LIKE '%".addslashes($filter)."%' OR produk_dm LIKE '%".addslashes($filter)."%' OR produk_point LIKE '%".addslashes($filter)."%' OR produk_volume LIKE '%".addslashes($filter)."%' OR produk_harga LIKE '%".addslashes($filter)."%' OR produk_keterangan LIKE '%".addslashes($filter)."%' OR produk_aktif LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($produk_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_id LIKE '%".$produk_id."%'";
				};
				if($produk_kode!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_kode LIKE '%".$produk_kode."%'";
				};
				if($produk_kodelama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_kodelama LIKE '%".$produk_kodelama."%'";
				};
				if($produk_group!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_group LIKE '%".$produk_group."%'";
				};
				if($produk_kategori!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_kategori LIKE '%".$produk_kategori."%'";
				};
				if($produk_jenis!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_jenis LIKE '%".$produk_jenis."%'";
				};
				if($produk_nama!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_nama LIKE '%".$produk_nama."%'";
				};
				if($produk_satuan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_satuan LIKE '%".$produk_satuan."%'";
				};
				if($produk_du!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_du LIKE '%".$produk_du."%'";
				};
				if($produk_dm!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_dm LIKE '%".$produk_dm."%'";
				};
				if($produk_point!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_point LIKE '%".$produk_point."%'";
				};
				if($produk_volume!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_volume LIKE '%".$produk_volume."%'";
				};
				if($produk_harga!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_harga LIKE '%".$produk_harga."%'";
				};
				if($produk_keterangan!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_keterangan LIKE '%".$produk_keterangan."%'";
				};
				if($produk_aktif!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " produk_aktif LIKE '%".$produk_aktif."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
}
?>