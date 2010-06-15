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
	
		
		//function for advanced search record
		function neraca_search($buku_periode, $buku_tglawal, $buku_tglakhir, $buku_bulan, $buku_tahun, $buku_akun, $start,$end){
			
			if($buku_periode=="all"){
				
				$sql="SELECT A.akun_id,A.akun_kode,A.akun_jenis,A.akun_nama,A.akun_level,B.akun_id as akun_parent_id, B.akun_nama as akun_parent 
						FROM akun A, akun B 
						WHERE A.akun_level=3  AND A.akun_parent=B.akun_kode  AND B.akun_level=2 ORDER by B.akun_kode,A.akun_kode ASC";
				$master=$this->db->query($sql);
				$nbrows=$master->num_rows();

				$i=0;
				foreach($master->result() as $row){
										
					$sql="SELECT substr(A.akun_kode,1,3) as akun,sum(buku_debet) as debet,sum(buku_kredit) as kredit
							FROM	buku_besar, akun A
							WHERE  buku_akun=A.akun_id AND
							substr(A.akun_kode,1,4) = substr('".$row->akun_kode."',1,4) 
							GROUP BY substr(A.akun_kode,1,2)";
					
					$isi=$this->db->query($sql);
					if($isi->num_rows()){
						$rowisi=$isi->row();
						$data[$i]['akun_parent_id']=$row->akun_parent_id;
						$data[$i]['akun_parent']=$row->akun_parent;
						$data[$i]['akun_id']=$row->akun_id;
						$data[$i]['akun_kode']=$row->akun_kode;
						$data[$i]['akun_nama']=$row->akun_nama;
						/*$data[$i]['debet']=$rowisi->debet;
						$data[$i]['kredit']=$rowisi->kredit;*/
						switch($row->akun_jenis){
							case 'Aset' : 
									$data[$i]['debet']=$rowisi->debet-$rowisi->kredit;
									$data[$i]['kredit']=0;
									break;
							case 'Kewajiban' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Ekuitas' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Pendapatan' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Beban' : 
									$data[$i]['debet']=$rowisi->debet-$rowisi->kredit;
									$data[$i]['kredit']=0;
									break;
							default : 
									$data[$i]['debet']=$rowisi->debet;
									$data[$i]['kredit']=$rowisi->kredit;
									break;
						}
					}else{
						$data[$i]['akun_parent_id']=$row->akun_parent_id;
						$data[$i]['akun_parent']=$row->akun_parent;
						$data[$i]['akun_id']=$row->akun_id;
						$data[$i]['akun_kode']=$row->akun_kode;
						$data[$i]['akun_nama']=$row->akun_nama;
						$data[$i]['debet']=0;
						$data[$i]['kredit']=0;
					}
					$i++;
				}
				
			}else if($buku_periode=="tanggal"){
				
				
				$sql="SELECT A.akun_id,A.akun_kode,A.akun_jenis,A.akun_nama,A.akun_level,B.akun_id as akun_parent_id, B.akun_nama as akun_parent 
						FROM akun A, akun B 
						WHERE A.akun_level=3  AND A.akun_parent=B.akun_kode  AND B.akun_level=2 ORDER by B.akun_kode,A.akun_kode ASC";
				$master=$this->db->query($sql);
				$nbrows=$master->num_rows();

				$i=0;
				foreach($master->result() as $row){
										
					$sql="SELECT substr(A.akun_kode,1,3) as akun,sum(buku_debet) as debet,sum(buku_kredit) as kredit
							FROM	buku_besar, akun A
							WHERE  buku_akun=A.akun_id AND
							substr(A.akun_kode,1,5) = substr('".$row->akun_kode."',1,5) 
							AND date_format(buku_tanggal,'%Y-%m-%d')<='".$buku_tglakhir."'
							GROUP BY substr(A.akun_kode,1,3)";
					
					$isi=$this->db->query($sql);
					if($isi->num_rows()){
						$rowisi=$isi->row();
						$data[$i]['akun_parent_id']=$row->akun_parent_id;
						$data[$i]['akun_parent']=$row->akun_parent;
						$data[$i]['akun_id']=$row->akun_id;
						$data[$i]['akun_kode']=$row->akun_kode;
						$data[$i]['akun_nama']=$row->akun_nama;
						/*$data[$i]['debet']=$rowisi->debet;
						$data[$i]['kredit']=$rowisi->kredit;*/
						switch($row->akun_jenis){
							case 'Aset' : 
									$data[$i]['debet']=$rowisi->debet-$rowisi->kredit;
									$data[$i]['kredit']=0;
									break;
							case 'Kewajiban' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Ekuitas' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Pendapatan' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Beban' : 
									$data[$i]['debet']=$rowisi->debet-$rowisi->kredit;
									$data[$i]['kredit']=0;
									break;
							default : 
									$data[$i]['debet']=$rowisi->debet;
									$data[$i]['kredit']=$rowisi->kredit;
									break;
						}
					}else{
						$data[$i]['akun_parent_id']=$row->akun_parent_id;
						$data[$i]['akun_parent']=$row->akun_parent;
						$data[$i]['akun_id']=$row->akun_id;
						$data[$i]['akun_kode']=$row->akun_kode;
						$data[$i]['akun_nama']=$row->akun_nama;
						$data[$i]['debet']=0;
						$data[$i]['kredit']=0;
					}
					$i++;
				}
				
			}else if($buku_periode=="bulan"){
				
					
				$sql="SELECT A.akun_id,A.akun_kode,A.akun_jenis,A.akun_nama,A.akun_level,B.akun_id as akun_parent_id, B.akun_nama as akun_parent 
					FROM akun A, akun B 
					WHERE A.akun_level=2  AND A.akun_parent=B.akun_id  AND B.akun_level=1 ORDER by B.akun_kode,A.akun_kode ASC";
				$master=$this->db->query($sql);
				$nbrows=$master->num_rows();

				$i=0;
				foreach($master->result() as $row){
										
					$sql="SELECT substr(A.akun_kode,1,3) as akun,sum(buku_debet) as debet,sum(buku_kredit) as kredit
							FROM	buku_besar, akun A
							WHERE  buku_akun=A.akun_id AND
							substr(A.akun_kode,1,5) = substr('".$row->akun_kode."',1,5) 
							AND date_format(buku_tanggal,'%Y-%m')<='".$buku_tahun."-".$buku_bulan."' 
							GROUP BY substr(A.akun_kode,1,3)";
					
					$isi=$this->db->query($sql);
					if($isi->num_rows()){
						$rowisi=$isi->row();
						$data[$i]['akun_parent_id']=$row->akun_parent_id;
						$data[$i]['akun_parent']=$row->akun_parent;
						$data[$i]['akun_id']=$row->akun_id;
						$data[$i]['akun_kode']=$row->akun_kode;
						$data[$i]['akun_nama']=$row->akun_nama;
						/*$data[$i]['debet']=$rowisi->debet;
						$data[$i]['kredit']=$rowisi->kredit;*/
						switch($row->akun_jenis){
							case 'Aset' : 
									$data[$i]['debet']=$rowisi->debet-$rowisi->kredit;
									$data[$i]['kredit']=0;
									break;
							case 'Kewajiban' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Ekuitas' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Pendapatan' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Beban' : 
									$data[$i]['debet']=$rowisi->debet-$rowisi->kredit;
									$data[$i]['kredit']=0;
									break;
							default : 
									$data[$i]['debet']=$rowisi->debet;
									$data[$i]['kredit']=$rowisi->kredit;
									break;
						}
					}else{
						$data[$i]['akun_parent_id']=$row->akun_parent_id;
						$data[$i]['akun_parent']=$row->akun_parent;
						$data[$i]['akun_id']=$row->akun_id;
						$data[$i]['akun_kode']=$row->akun_kode;
						$data[$i]['akun_nama']=$row->akun_nama;
						$data[$i]['debet']=0;
						$data[$i]['kredit']=0;
					}
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
		
		//function for print record
		function neraca_print($buku_periode, $buku_tglawal, $buku_tglakhir, $buku_bulan, $buku_tahun, $buku_akun, $start,$end){
			
			if($buku_periode=="all"){
				
				$sql="SELECT A.akun_id,A.akun_kode,A.akun_jenis,A.akun_nama,A.akun_level,B.akun_id as akun_parent_id, B.akun_nama as akun_parent 
						FROM akun A, akun B 
						WHERE A.akun_level=2  AND A.akun_parent=B.akun_id  AND B.akun_level=1 ORDER by B.akun_kode,A.akun_kode ASC";
				$master=$this->db->query($sql);
				$nbrows=$master->num_rows();

				$i=0;
				foreach($master->result() as $row){
										
					$sql="SELECT substr(A.akun_kode,1,3) as akun,sum(buku_debet) as debet,sum(buku_kredit) as kredit
							FROM	buku_besar, akun A
							WHERE  buku_akun=A.akun_id AND
							substr(A.akun_kode,1,5) = substr('".$row->akun_kode."',1,5) 
							GROUP BY substr(A.akun_kode,1,3)";
					
					$isi=$this->db->query($sql);
					if($isi->num_rows()){
						$rowisi=$isi->row();
						$data[$i]['akun_parent_id']=$row->akun_parent_id;
						$data[$i]['akun_parent']=$row->akun_parent;
						$data[$i]['akun_id']=$row->akun_id;
						$data[$i]['akun_kode']=$row->akun_kode;
						$data[$i]['akun_jenis']=$row->akun_jenis;
						$data[$i]['akun_nama']=$row->akun_nama;
						$data[$i]['akun_level']=$row->akun_level;
						/*$data[$i]['debet']=$rowisi->debet;
						$data[$i]['kredit']=$rowisi->kredit;*/
						switch($row->akun_jenis){
							case 'Aset' : 
									$data[$i]['debet']=$rowisi->debet-$rowisi->kredit;
									$data[$i]['kredit']=0;
									break;
							case 'Kewajiban' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Ekuitas' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Pendapatan' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Beban' : 
									$data[$i]['debet']=$rowisi->debet-$rowisi->kredit;
									$data[$i]['kredit']=0;
									break;
							default : 
									$data[$i]['debet']=$rowisi->debet;
									$data[$i]['kredit']=$rowisi->kredit;
									break;
						}
					}else{
						$data[$i]['akun_parent_id']=$row->akun_parent_id;
						$data[$i]['akun_parent']=$row->akun_parent;
						$data[$i]['akun_jenis']=$row->akun_jenis;
						$data[$i]['akun_id']=$row->akun_id;
						$data[$i]['akun_kode']=$row->akun_kode;
						$data[$i]['akun_nama']=$row->akun_nama;
						$data[$i]['akun_level']=$row->akun_level;
						$data[$i]['debet']=0;
						$data[$i]['kredit']=0;
					}
					$i++;
				}
				
			}else if($buku_periode=="tanggal"){
				
				
				$sql="SELECT A.akun_id,A.akun_kode,A.akun_jenis,A.akun_nama,A.akun_level,B.akun_id as akun_parent_id, B.akun_nama as akun_parent 
						FROM akun A, akun B 
						WHERE A.akun_level=2  AND A.akun_parent=B.akun_id  AND B.akun_level=1 ORDER by B.akun_kode,A.akun_kode ASC";
				$master=$this->db->query($sql);
				$nbrows=$master->num_rows();

				$i=0;
				foreach($master->result() as $row){
										
					$sql="SELECT substr(A.akun_kode,1,3) as akun,sum(buku_debet) as debet,sum(buku_kredit) as kredit
							FROM	buku_besar, akun A
							WHERE  buku_akun=A.akun_id AND
							substr(A.akun_kode,1,5) = substr('".$row->akun_kode."',1,5) 
							AND date_format(buku_tanggal,'%Y-%m-%d')<='".$buku_tglakhir."'
							GROUP BY substr(A.akun_kode,1,3)";
					
					$isi=$this->db->query($sql);
					if($isi->num_rows()){
						$rowisi=$isi->row();
						$data[$i]['akun_parent_id']=$row->akun_parent_id;
						$data[$i]['akun_parent']=$row->akun_parent;
						$data[$i]['akun_jenis']=$row->akun_jenis;
						$data[$i]['akun_id']=$row->akun_id;
						$data[$i]['akun_kode']=$row->akun_kode;
						$data[$i]['akun_nama']=$row->akun_nama;
						$data[$i]['akun_level']=$row->akun_level;
						/*$data[$i]['debet']=$rowisi->debet;
						$data[$i]['kredit']=$rowisi->kredit;*/
						switch($row->akun_jenis){
							case 'Aset' : 
									$data[$i]['debet']=$rowisi->debet-$rowisi->kredit;
									$data[$i]['kredit']=0;
									break;
							case 'Kewajiban' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Ekuitas' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Pendapatan' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Beban' : 
									$data[$i]['debet']=$rowisi->debet-$rowisi->kredit;
									$data[$i]['kredit']=0;
									break;
							default : 
									$data[$i]['debet']=$rowisi->debet;
									$data[$i]['kredit']=$rowisi->kredit;
									break;
						}
					}else{
						$data[$i]['akun_parent_id']=$row->akun_parent_id;
						$data[$i]['akun_parent']=$row->akun_parent;
						$data[$i]['akun_jenis']=$row->akun_jenis;
						$data[$i]['akun_id']=$row->akun_id;
						$data[$i]['akun_kode']=$row->akun_kode;
						$data[$i]['akun_nama']=$row->akun_nama;
						$data[$i]['akun_level']=$row->akun_level;
						$data[$i]['debet']=0;
						$data[$i]['kredit']=0;
					}
					$i++;
				}
				
			}else if($buku_periode=="bulan"){
				
					
				$sql="SELECT A.akun_id,A.akun_kode,A.akun_jenis,A.akun_nama,A.akun_level,B.akun_id as akun_parent_id, B.akun_nama as akun_parent 
					FROM akun A, akun B 
					WHERE A.akun_level=2  AND A.akun_parent=B.akun_id  AND B.akun_level=1 ORDER by B.akun_kode,A.akun_kode ASC";
				$master=$this->db->query($sql);
				$nbrows=$master->num_rows();

				$i=0;
				foreach($master->result() as $row){
										
					$sql="SELECT substr(A.akun_kode,1,3) as akun,sum(buku_debet) as debet,sum(buku_kredit) as kredit
							FROM	buku_besar, akun A
							WHERE  buku_akun=A.akun_id AND
							substr(A.akun_kode,1,5) = substr('".$row->akun_kode."',1,5) 
							AND date_format(buku_tanggal,'%Y-%m')<='".$buku_tahun."-".$buku_bulan."' 
							GROUP BY substr(A.akun_kode,1,3)";
					
					$isi=$this->db->query($sql);
					if($isi->num_rows()){
						$rowisi=$isi->row();
						$data[$i]['akun_parent_id']=$row->akun_parent_id;
						$data[$i]['akun_parent']=$row->akun_parent;
						$data[$i]['akun_jenis']=$row->akun_jenis;
						$data[$i]['akun_id']=$row->akun_id;
						$data[$i]['akun_kode']=$row->akun_kode;
						$data[$i]['akun_nama']=$row->akun_nama;
						$data[$i]['akun_level']=$row->akun_level;
						/*$data[$i]['debet']=$rowisi->debet;
						$data[$i]['kredit']=$rowisi->kredit;*/
						switch($row->akun_jenis){
							case 'Aset' : 
									$data[$i]['debet']=$rowisi->debet-$rowisi->kredit;
									$data[$i]['kredit']=0;
									break;
							case 'Kewajiban' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Ekuitas' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Pendapatan' : 
									$data[$i]['kredit']=$rowisi->kredit-$rowisi->debet;
									$data[$i]['debet']=0;
									break;
							case 'Beban' : 
									$data[$i]['debet']=$rowisi->debet-$rowisi->kredit;
									$data[$i]['kredit']=0;
									break;
							default : 
									$data[$i]['debet']=$rowisi->debet;
									$data[$i]['kredit']=$rowisi->kredit;
									break;
						}
					}else{
						$data[$i]['akun_parent_id']=$row->akun_parent_id;
						$data[$i]['akun_parent']=$row->akun_parent;
						$data[$i]['akun_jenis']=$row->akun_jenis;
						$data[$i]['akun_id']=$row->akun_id;
						$data[$i]['akun_kode']=$row->akun_kode;
						$data[$i]['akun_nama']=$row->akun_nama;
						$data[$i]['akun_level']=$row->akun_level;
						$data[$i]['debet']=0;
						$data[$i]['kredit']=0;
					}
					$i++;
				}
				
					
			}
			
		
			if($nbrows>0){
				return $data;
			} else {
				return 0;
			}
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