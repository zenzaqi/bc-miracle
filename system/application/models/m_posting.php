<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: posting Model
	+ Description	: For record model process back-end
	+ Filename 		: c_posting.php
 	+ creator 		: 
 	+ Created on 12/Mar/2010 10:42:59
	
*/

class M_posting extends Model{
		
		//constructor
		function M_posting() {
			parent::Model();
		}
		
		function post_transaksi($tgl_awal,$tgl_akhir,$bulan,$tahun,$periode){
			
			$tanggal=date('Y-m-d H:i:s');
			if($periode=='tanggal'){
				//POSTING KE BUKU BESAR
				$sql="INSERT INTO buku_besar(buku_tanggal,
                             buku_ref,
                             buku_akun,
                             buku_akun_kode,
                             buku_debet,
                             buku_kredit,
							 buku_author)
					   SELECT tanggal,
							  no_jurnal,
							  akun,
							  akun_kode,
							  debet,
							  kredit,
							  '".@$_SESSION[SESSION_USERID]."'
						 FROM vu_jurnal_harian
						WHERE post <> 'Y' AND 
							  date_format(tanggal,'%Y-%m-%d')>='".$tgl_awal."'  AND
						      date_format(tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
				
				$result=$this->db->query($sql);
				
				//UPDATE STATUS POSTING
				$sql_post_umum="UPDATE 	jurnal 
								SET 	jurnal_post='Y',
										jurnal_date_post='".$tanggal."'
								WHERE 	date_format(jurnal_tanggal,'%Y-%m-%d')>='".$tgl_awal."' 
										AND date_format(jurnal_tanggal,'%Y-%m-%d')<='".$tgl_akhir."'
										AND jurnal_post<>'Y'";
				$this->db->query($sql_post_umum);
				
				$sql_post_bank="UPDATE 	kasbank 
								SET 	kasbank_post='Y',
										kasbank_date_post='".$tanggal."' 
								WHERE 	date_format(kasbank_tanggal,'%Y-%m-%d')>='".$tgl_awal."' 
										AND date_format(kasbank_tanggal,'%Y-%m-%d')<='".$tgl_akhir."'
										AND kasbank_post<>'Y'";
				$this->db->query($sql_post_bank);
						
				
			}else if($periode=='bulan'){
			
				
				//POSTING KE BUKU BESAR
				$sql="INSERT INTO buku_besar(buku_tanggal,
                             buku_ref,
                             buku_akun,
                             buku_akun_kode,
                             buku_debet,
                             buku_kredit)
					   SELECT tanggal,
							  no_jurnal,
							  akun,
							  akun_kode,
							  debet,
							  kredit
						 FROM vu_jurnal_harian
						WHERE post <> 'Y' AND 
							  date_format(tanggal,'%Y-%m')='".$tahun."-".$bulan."'";
				
				$result=$this->db->query($sql);
				//$this->firephp->log($sql);
				
				//UPDATE STATUS POSTING
				$sql_post_umum="UPDATE 	jurnal 
								SET 	jurnal_post='Y',
										jurnal_date_post='".$tanggal."' 
								WHERE 	date_format(jurnal_tanggal,'%Y-%m')='".$tahun."-".$bulan."'
										AND jurnal_post<>'Y'";
				$this->db->query($sql_post_umum);
				//$this->firephp->log($sql);
				
				$sql_post_bank="UPDATE 	kasbank 
								SET 	kasbank_post='Y',
										kasbank_date_post='".$tanggal."' 
								WHERE 	date_format(kasbank_tanggal,'%Y-%m')='".$tahun."-".$bulan."'
										AND kasbank_post<>'Y'";
				$this->db->query($sql_post_bank);
				
			}
			
			return '1';
		}
}
?>