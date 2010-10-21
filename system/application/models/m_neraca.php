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
			
			//AKUN LEVEL 1
			$sql="SELECT A.akun_id,A.akun_saldo,A.akun_kode,A.akun_jenis,A.akun_nama,A.akun_level,B.akun_id as akun_parent_id, B.akun_nama as akun_parent 
					FROM akun A, akun B
					WHERE A.akun_level=2  
					AND A.akun_parent_kode=B.akun_kode
					AND A.akun_jenis='Neraca'
					AND B.akun_level=1
					ORDER by A.akun_kode ASC";
					
			$master=$this->db->query($sql);
			$nbrows=$master->num_rows();

			$saldo=0;
			$i=0;
			foreach($master->result() as $row){
										
					//s/d bulan ini
				$sql="SELECT A.akun_kode,sum(B.buku_debet) as debet,sum(B.buku_kredit) as kredit
						FROM	buku_besar B, akun A
						WHERE B.buku_akun=A.akun_id
						AND replace(A.akun_kode,'.','') like  '".str_replace(".","",$row->akun_kode)."%' ";
				if($buku_periode=="bulan"){
					$sql.="	AND date_format(buku_tanggal,'%Y-%m')<='".$buku_tahun."-".$buku_bulan."'";
				}
				//$sql.="GROUP BY A.akun_kode";
				$sql.="	ORDER BY A.akun_kode ASC";
				
				//GET SALDO BEFORE
				$data[$i]["neraca_saldo"]=0;
				
				$sqlsaldo="SELECT 	A.akun_kode,sum(A.akun_debet) as debet,sum(A.akun_debet) as kredit, A.akun_saldo
						FROM	akun A
						WHERE   replace(A.akun_kode,'.','') like  '".str_replace(".","",$row->akun_kode)."%'";
				
				$rssaldo=$this->db->query($sqlsaldo);
				if($rssaldo->num_rows()){
					$rowsaldo=$rssaldo->row();
					if($rowsaldo->akun_saldo=='Debet'){
						$data[$i]["neraca_saldo"]= ($rowsaldo->debet-$rowsaldo->kredit);
					}else{
						$data[$i]["neraca_saldo"]= ($rowsaldo->debet-$rowsaldo->kredit);
					}
				}
				//----->
				
				$isi=$this->db->query($sql);
				if($isi->num_rows()){
					$rowisi=$isi->row();
					$data[$i]["neraca_akun"]=$row->akun_id;
					$data[$i]["neraca_level"]=$row->akun_level;
					$data[$i]["neraca_jenis"]=$row->akun_parent;
					$data[$i]["neraca_jenis_id"]=$row->akun_parent_id;
					$data[$i]["neraca_akun_kode"]=$row->akun_kode;
					$data[$i]["neraca_akun_nama"]=$row->akun_nama;
					
					if($row->akun_saldo=='Debet'){
						$data[$i]["neraca_saldo"]= ($rowisi->debet-$rowisi->kredit);
					}else{
						$data[$i]["neraca_saldo"]= ($rowisi->kredit-$rowisi->debet);	
					}
				}else{
					$data[$i]["neraca_akun"]=$row->akun_id;
					$data[$i]["neraca_level"]=$row->akun_level;
					$data[$i]["neraca_jenis"]=$row->akun_parent;
					$data[$i]["neraca_jenis_id"]=$row->akun_parent_id;
					$data[$i]["neraca_akun_kode"]=$row->akun_kode;
					$data[$i]["neraca_akun_nama"]=$row->akun_nama;
					$data[$i]["neraca_saldo"]=0;
				}
				
				//bulan ini
				$sql="SELECT A.akun_kode,sum(B.buku_debet) as debet,sum(B.buku_kredit) as kredit
						FROM	buku_besar B, akun A
						WHERE B.buku_akun=A.akun_id
						AND replace(A.akun_kode,'.','') like  '".str_replace(".","",$row->akun_kode)."%' ";
				if($buku_periode=="bulan"){
					$sql.="	AND date_format(buku_tanggal,'%Y-%m')='".$buku_tahun."-".$buku_bulan."'";
				}
				//$sql.="GROUP BY A.akun_kode";
				$sql.="	ORDER BY A.akun_kode ASC";
						
				$isi=$this->db->query($sql);
				if($isi->num_rows()){
					$rowisi=$isi->row();
					if($row->akun_saldo=='Debet')
						$data[$i]["neraca_saldo_periode"]= ($rowisi->debet-$rowisi->kredit);
					else
						$data[$i]["neraca_saldo_periode"]= ($rowisi->kredit-$rowisi->debet);	
				}else{
					$data[$i]["neraca_saldo_periode"]=0;
				}
				
					
				$i++;
			}
			
			//LAPORAN LABA RUGI

			$data[$i]["neraca_akun"]=999999999;
			$data[$i]["neraca_jenis"]='RUGI/LABA ';
			$data[$i]["neraca_level"]=1;
			$data[$i]["neraca_jenis_id"]=99999999;
			$data[$i]["neraca_akun_kode"]="999.99999";
			$data[$i]["neraca_akun_nama"]="LABA/RUGI ";
				
			$sql="SELECT A.akun_kode,sum(B.buku_debet) as debet,sum(B.buku_kredit) as kredit
					FROM	buku_besar B, akun A
					WHERE B.buku_akun=A.akun_id
					AND A.akun_jenis='R/L'
					GROUP BY A.akun_kode";
			$rlisi=$this->db->query($sql);
			if($rlisi->num_rows()){
				foreach($rlisi->result() as $rowisi){
					if($row->akun_saldo=='Debet'){
						$saldo+= ($rowisi->debet-$rowisi->kredit);
					}else{
						$saldo+= ($rowisi->kredit-$rowisi->debet);	
					}
				}
			}else{
				$saldo=0;
			}
			
			$data[$i]["neraca_saldo"]=$saldo;
			
			//bulan ini
			$saldo=0;
			$sql="SELECT A.akun_kode,sum(B.buku_debet) as debet,sum(B.buku_kredit) as kredit
					FROM	buku_besar B, akun A
					WHERE B.buku_akun=A.akun_id
					AND A.akun_jenis='R/L'";
			if($buku_periode=="bulan"){
				$sql.="	AND date_format(B.buku_tanggal,'%Y-%m')='".$buku_tahun."-".$buku_bulan."'";
			}
			$sql.=" GROUP BY A.akun_kode";
			if($rlisi->num_rows()){
				foreach($rlisi->result() as $rowisi){
					if($row->akun_saldo=='Debet'){
						$saldo+= ($rowisi->debet-$rowisi->kredit);
					}else{
						$saldo+= ($rowisi->kredit-$rowisi->debet);	
					}
				}
			}else{
				$saldo=0;
			}
			$data[$i]["neraca_saldo_periode"]=$saldo;
			
			if($nbrows>0){
				$jsonresult = json_encode($data);
				return '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
			} else {
				return '({"total":"0", "results":""})';
			}
		}
		
		//function for print record
		function neraca_print($buku_periode, $buku_tglawal, $buku_tglakhir, $buku_bulan, $buku_tahun, $buku_akun, $start,$end){
			
			//AKUN LEVEL 1
			$sql="SELECT A.akun_id,A.akun_saldo,A.akun_kode,A.akun_jenis,A.akun_nama,A.akun_level,B.akun_id as akun_parent_id, B.akun_nama as akun_parent 
					FROM akun A, akun B
					WHERE A.akun_level<=2  
					AND A.akun_parent_kode=B.akun_kode
					AND A.akun_jenis='Neraca'
					AND B.akun_level<=1
					ORDER by A.akun_kode ASC";
					
			$master=$this->db->query($sql);
			$nbrows=$master->num_rows();

			$saldo=0;
			$i=0;
			foreach($master->result() as $row){
										
					//s/d bulan ini
				$sql="SELECT A.akun_kode,sum(B.buku_debet) as debet,sum(B.buku_kredit) as kredit
						FROM	buku_besar B, akun A
						WHERE B.buku_akun=A.akun_id
						AND replace(A.akun_kode,'.','') like  '".str_replace(".","",$row->akun_kode)."%' ";
				if($buku_periode=="bulan"){
					$sql.="	AND date_format(buku_tanggal,'%Y-%m')<='".$buku_tahun."-".$buku_bulan."'";
				}
				//$sql.="GROUP BY A.akun_kode";
				$sql.="	ORDER BY A.akun_kode ASC";
				
				//GET SALDO BEFORE
				$data[$i]["neraca_saldo"]=0;
				
				$sqlsaldo="SELECT 	A.akun_kode,sum(A.akun_debet) as debet,sum(A.akun_debet) as kredit, A.akun_saldo
						FROM	akun A
						WHERE   replace(A.akun_kode,'.','') like  '".str_replace(".","",$row->akun_kode)."%'";
				
				$rssaldo=$this->db->query($sqlsaldo);
				if($rssaldo->num_rows()){
					$rowsaldo=$rssaldo->row();
					if($rowsaldo->akun_saldo=='Debet'){
						$data[$i]["neraca_saldo"]= ($rowsaldo->debet-$rowsaldo->kredit);
					}else{
						$data[$i]["neraca_saldo"]= ($rowsaldo->debet-$rowsaldo->kredit);
					}
				}
				//----->
				
				$isi=$this->db->query($sql);
				if($isi->num_rows()){
					$rowisi=$isi->row();
					$data[$i]["neraca_akun"]=$row->akun_id;
					$data[$i]["neraca_jenis"]=$row->akun_parent;
					$data[$i]["neraca_level"]=$row->akun_level;
					$data[$i]["neraca_jenis_id"]=$row->akun_parent_id;
					$data[$i]["neraca_akun_kode"]=$row->akun_kode;
					$data[$i]["neraca_akun_nama"]=$row->akun_nama;
					
					if($row->akun_saldo=='Debet'){
						$data[$i]["neraca_saldo"]= ($rowisi->debet-$rowisi->kredit);
					}else{
						$data[$i]["neraca_saldo"]= ($rowisi->kredit-$rowisi->debet);	
					}
				}else{
					$data[$i]["neraca_akun"]=$row->akun_id;
					$data[$i]["neraca_jenis"]=$row->akun_parent;
					$data[$i]["neraca_level"]=$row->akun_level;
					$data[$i]["neraca_jenis_id"]=$row->akun_parent_id;
					$data[$i]["neraca_akun_kode"]=$row->akun_kode;
					$data[$i]["neraca_akun_nama"]=$row->akun_nama;
					$data[$i]["neraca_saldo"]=0;
				}
				
				//bulan ini
				$sql="SELECT A.akun_kode,sum(B.buku_debet) as debet,sum(B.buku_kredit) as kredit
						FROM	buku_besar B, akun A
						WHERE B.buku_akun=A.akun_id
						AND replace(A.akun_kode,'.','') like  '".str_replace(".","",$row->akun_kode)."%' ";
				if($buku_periode=="bulan"){
					$sql.="	AND date_format(buku_tanggal,'%Y-%m')='".$buku_tahun."-".$buku_bulan."'";
				}
				//$sql.="GROUP BY A.akun_kode";
				$sql.="	ORDER BY A.akun_kode ASC";
						
				$isi=$this->db->query($sql);
				if($isi->num_rows()){
					$rowisi=$isi->row();
					if($row->akun_saldo=='Debet')
						$data[$i]["neraca_saldo_periode"]= ($rowisi->debet-$rowisi->kredit);
					else
						$data[$i]["neraca_saldo_periode"]= ($rowisi->kredit-$rowisi->debet);	
				}else{
					$data[$i]["neraca_saldo_periode"]=0;
				}
				
					
				$i++;
			}
			
			//LAPORAN LABA RUGI

			$data[$i]["neraca_akun"]=999999999;
			$data[$i]["neraca_jenis"]='RUGI/LABA ';
			$data[$i]["neraca_level"]=2;
			$data[$i]["neraca_jenis_id"]=99999999;
			$data[$i]["neraca_akun_kode"]="999.99999";
			$data[$i]["neraca_akun_nama"]="LABA/RUGI ";
				
			$sql="SELECT A.akun_kode,sum(B.buku_debet) as debet,sum(B.buku_kredit) as kredit
					FROM	buku_besar B, akun A
					WHERE B.buku_akun=A.akun_id
					AND A.akun_jenis='R/L'
					GROUP BY A.akun_kode";
			$rlisi=$this->db->query($sql);
			if($rlisi->num_rows()){
				foreach($rlisi->result() as $rowisi){
					if($row->akun_saldo=='Debet'){
						$saldo+= ($rowisi->debet-$rowisi->kredit);
					}else{
						$saldo+= ($rowisi->kredit-$rowisi->debet);	
					}
				}
			}else{
				$saldo=0;
			}
			
			$data[$i]["neraca_saldo"]=$saldo;
			
			//bulan ini
			$saldo=0;
			$sql="SELECT A.akun_kode,sum(B.buku_debet) as debet,sum(B.buku_kredit) as kredit
					FROM	buku_besar B, akun A
					WHERE B.buku_akun=A.akun_id
					AND A.akun_jenis='R/L'";
			if($buku_periode=="bulan"){
				$sql.="	AND date_format(B.buku_tanggal,'%Y-%m')='".$buku_tahun."-".$buku_bulan."'";
			}
			$sql.=" GROUP BY A.akun_kode";
			if($rlisi->num_rows()){
				foreach($rlisi->result() as $rowisi){
					if($row->akun_saldo=='Debet'){
						$saldo+= ($rowisi->debet-$rowisi->kredit);
					}else{
						$saldo+= ($rowisi->kredit-$rowisi->debet);	
					}
				}
			}else{
				$saldo=0;
			}
			$data[$i]["neraca_saldo_periode"]=$saldo;
			
			if($master->num_rows()>0){
				return $data;
			}else{
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