<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: neraca Model
	+ Description	: For record model process back-end
	+ Filename 		: c_neraca.php
 	+ Author  		: Zainal, Anam
 	+ Created on 12/Mar/2010 10:45:40
	
*/

class M_neraca extends Model{
		
		//constructor
		function M_neraca() {
			parent::Model();
		}
	
		//function for get list record
		function neraca_list($filter,$start,$end){
			$query = "SELECT * FROM neraca";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (buku_id LIKE '%".addslashes($filter)."%' OR buku_tanggal LIKE '%".addslashes($filter)."%' OR buku_akun LIKE '%".addslashes($filter)."%' OR buku_debet LIKE '%".addslashes($filter)."%' OR buku_kredit LIKE '%".addslashes($filter)."%' OR buku_saldo_debet LIKE '%".addslashes($filter)."%' OR buku_saldo_kredit LIKE '%".addslashes($filter)."%' )";
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
		
		
	
		
		//function for advanced search record
		function neraca_search($buku_periode, $buku_tglawal, $buku_tglakhir, $buku_bulan, $buku_tahun, $buku_akun, $start,$end){
			
			if($buku_periode=="all"){
				$sql="SELECT buku_akun,akun_kode,akun_nama,sum(buku_debet) as debet,sum(buku_kredit) as kredit
					FROM	buku_besar,akun
					WHERE  	buku_akun=akun_id AND
							buku_akun like '".$buku_akun."%' 
					GROUP BY buku_akun,akun_kode,akun_nama
					ORDER BY buku_akun ASC";
			}else if($buku_periode=="tanggal"){
				
				$sql="SELECT buku_tanggal,buku_akun,akun_kode,akun_nama,sum(buku_debet) as debet,sum(buku_kredit) as kredit
					FROM	buku_besar,akun
					WHERE  	buku_akun=akun_id AND
							date_format(buku_tanggal,'%Y-%m-%d')>='".$buku_tglawal."' AND
							date_format(buku_tanggal,'%Y-%m-%d')<='".$buku_tglakhir."' AND
							buku_akun like '".$buku_akun."%' 					
					GROUP BY buku_akun,akun_kode,akun_nama
					ORDER BY buku_akun ASC";
					
			}else if($buku_periode=="bulan"){
				
					
					$sql="SELECT buku_tanggal,buku_akun,akun_kode,akun_nama,sum(buku_debet) as debet,sum(buku_kredit) as kredit
					FROM	buku_besar,akun
					WHERE  	buku_akun=akun_id AND
							date_format(buku_tanggal,'%Y-%m')>='".$buku_tahun."-".$buku_bulan."' AND
							buku_akun like '".$buku_akun."%' AND
							(akun_jenis='Pendapatan' OR akun_jenis='Beban')
					GROUP BY buku_akun,akun_kode,akun_nama
					ORDER BY buku_akun ASC";
			}
			
			
			
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			$limit = $sql." LIMIT ".$start.",".$end;		
			$result = $this->db->query($limit);  
			$saldo=0;
			$i=0;
			foreach($result->result() as $row){
				$sql_sebelum="";
				if($buku_periode=="tanggal"){
					$sql_sebelum="SELECT sum(buku_debet) as debet,sum(buku_kredit) as kredit
					FROM	buku_besar,akun
					WHERE  	buku_akun=akun_id AND
							date_format(buku_tanggal,'%Y-%m-%d')<='".$buku_tglawal."' 
							buku_akun like '".$buku_akun."%' AND
							(akun_jenis='Pendapatan' OR akun_jenis='Beban') AND
							buku_akun='".$row->buku_akun."' 
					ORDER BY buku_akun ASC";
				}else if($buku_periode=="bulan"){
					$sql_sebelum="SELECT sum(buku_debet) as debet,sum(buku_kredit) as kredit
					FROM	buku_besar,akun
					WHERE  	buku_akun=akun_id AND
							date_format(buku_tanggal,'%Y-%m')<='".$buku_tahun."-".$buku_bulan."'
							buku_akun like '".$buku_akun."%' AND
							(akun_jenis='Pendapatan' OR akun_jenis='Beban') AND
							buku_akun='".$row->buku_akun."' 
					ORDER BY buku_akun ASC";
				}
				if($sql_sebelum!==""){			
					$query_sebelum=$this->db->query($sql_sebelum);
					if($query_sebelum->num_rows()){
						$data_sebelum=$query_sebelum->row();
						$data[$i]["neraca_debet_sebelum"]=$row->debet;
						$data[$i]["neraca_kredit_sebelum"]=$row->kredit;
					}else{
						$data[$i]["neraca_debet_sebelum"]=0;
						$data[$i]["neraca_kredit_sebelum"]=0;
					}
				}else{
						$data[$i]["neraca_debet_sebelum"]=0;
						$data[$i]["neraca_kredit_sebelum"]=0;
				}
					
				$data[$i]["neraca_akun"]=$row->buku_akun;
				$data[$i]["neraca_akun_kode"]=$row->akun_kode;
				$data[$i]["neraca_akun_nama"]=$row->akun_nama;
				$data[$i]["neraca_debet"]=$row->debet;
				$data[$i]["neraca_kredit"]=$row->kredit;
				
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
		function neraca_print($buku_id ,$buku_tanggal ,$buku_akun ,$buku_debet ,$buku_kredit ,$buku_saldo_debet ,$buku_saldo_kredit ,$option,$filter){
			//full query
			$query="select * from neraca";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (buku_id LIKE '%".addslashes($filter)."%' OR buku_tanggal LIKE '%".addslashes($filter)."%' OR buku_akun LIKE '%".addslashes($filter)."%' OR buku_debet LIKE '%".addslashes($filter)."%' OR buku_kredit LIKE '%".addslashes($filter)."%' OR buku_saldo_debet LIKE '%".addslashes($filter)."%' OR buku_saldo_kredit LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($buku_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_id LIKE '%".$buku_id."%'";
				};
				if($buku_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_tanggal LIKE '%".$buku_tanggal."%'";
				};
				if($buku_akun!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_akun LIKE '%".$buku_akun."%'";
				};
				if($buku_debet!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_debet LIKE '%".$buku_debet."%'";
				};
				if($buku_kredit!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_kredit LIKE '%".$buku_kredit."%'";
				};
				if($buku_saldo_debet!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_saldo_debet LIKE '%".$buku_saldo_debet."%'";
				};
				if($buku_saldo_kredit!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_saldo_kredit LIKE '%".$buku_saldo_kredit."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
		
		//function  for export to excel
		function neraca_export_excel($buku_id ,$buku_tanggal ,$buku_akun ,$buku_debet ,$buku_kredit ,$buku_saldo_debet ,$buku_saldo_kredit ,$option,$filter){
			//full query
			$query="select * from neraca";
			if($option=='LIST'){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (buku_id LIKE '%".addslashes($filter)."%' OR buku_tanggal LIKE '%".addslashes($filter)."%' OR buku_akun LIKE '%".addslashes($filter)."%' OR buku_debet LIKE '%".addslashes($filter)."%' OR buku_kredit LIKE '%".addslashes($filter)."%' OR buku_saldo_debet LIKE '%".addslashes($filter)."%' OR buku_saldo_kredit LIKE '%".addslashes($filter)."%' )";
				$result = $this->db->query($query);
			} else if($option=='SEARCH'){
				if($buku_id!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_id LIKE '%".$buku_id."%'";
				};
				if($buku_tanggal!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_tanggal LIKE '%".$buku_tanggal."%'";
				};
				if($buku_akun!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_akun LIKE '%".$buku_akun."%'";
				};
				if($buku_debet!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_debet LIKE '%".$buku_debet."%'";
				};
				if($buku_kredit!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_kredit LIKE '%".$buku_kredit."%'";
				};
				if($buku_saldo_debet!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_saldo_debet LIKE '%".$buku_saldo_debet."%'";
				};
				if($buku_saldo_kredit!=''){
					$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
					$query.= " buku_saldo_kredit LIKE '%".$buku_saldo_kredit."%'";
				};
				$result = $this->db->query($query);
			}
			return $result;
		}
}
?>