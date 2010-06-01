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
				//post transaksi jurnal kas
				/*$sql_post_kas="UPDATE jurnal_kasbank SET kasbank_post='Y',kasbank_date_post='".$tanggal."' 
						WHERE date_format(kasbank_tanggal,'%Y-%m-%d')>='".$tgl_awal."' 
						AND date_format(kasbank_tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
				$this->db->query($sql_post_kas);*/
				
				//post transaksi jurnal umum
				$sql_post_umum="UPDATE jurnal_umum SET jurnal_post='Y',jurnal_date_post='".$tanggal."' 
						WHERE date_format(jurnal_tanggal,'%Y-%m-%d')>='".$tgl_awal."' 
						AND date_format(jurnal_tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
				$this->db->query($sql_post_umum);
				
				$sql_delete="DELETE from buku_besar WHERE date_format(buku_tanggal,'%Y-%m-%d')>='".$tgl_awal."' 
						AND date_format(buku_tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
				$this->db->query($sql_delete);
				
				$sql_insert="INSERT INTO buku_besar(buku_tanggal,buku_akun,buku_debet,buku_kredit,buku_date_create)
							  	SELECT jurnal_tanggal, djurnal_akun, djurnal_debet, djurnal_kredit, NOW()
								FROM vu_jurnal_umum
							 	WHERE jurnal_post='Y' AND date_format(jurnal_tanggal,'%Y-%m-%d')>='".$tgl_awal."' 
							 	AND date_format(jurnal_tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
				$this->db->query($sql_insert);
				
				/*//post transaksi penerimaan
				$sql_post_terima="UPDATE jurnal_pembelian SET terima_post='Y',terima_date_post='".$tanggal."' 
						WHERE date_format(terima_tanggal,'%Y-%m-%d')>='".$tgl_awal."' 
						AND date_format(terima_tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
				$this->db->query($sql_post_terima);
				
				//post transaksi penerimaan
				$sql_post_terima="UPDATE jurnal_penjualan SET terima_post='Y',terima_date_post='".$tanggal."' 
						WHERE date_format(terima_tanggal,'%Y-%m-%d')>='".$tgl_awal."' 
						AND date_format(terima_tanggal,'%Y-%m-%d')<='".$tgl_akhir."'";
				$this->db->query($sql_post_terima);*/
				
			}else if($periode=='bulan'){
				//post transaksi jurnal kas
				/*$sql_post_kas="UPDATE jurnal_kasbank SET kasbank_post='Y',kasbank_date_post='".$tanggal."' 
						WHERE date_format(kasbank_tanggal,'%Y-%m')='".$tahun."-".$bulan."'";
				$this->db->query($sql_post_kas);*/
				
				//post transaksi jurnal umum
				$sql_post_umum="UPDATE jurnal_umum SET jurnal_post='Y',jurnal_date_post='".$tanggal."' 
						WHERE date_format(jurnal_tanggal,'%Y-%m')='".$tahun."-".$bulan."'";
				$this->db->query($sql_post_umum);
				
				$sql_delete="DELETE from buku_besar WHERE date_format(buku_tanggal,'%Y-%m')='".$tahun."-".$bulan."'";
				$this->db->query($sql_delete);
				
				$sql_insert="INSERT INTO buku_besar(buku_tanggal,buku_akun,buku_debet,buku_kredit,buku_date_create)
							  	SELECT jurnal_tanggal, djurnal_akun, djurnal_debet, djurnal_kredit, NOW()
								FROM vu_jurnal_umum
							 	WHERE jurnal_post='Y' AND date_format(jurnal_tanggal,'%Y-%m')='".$tahun."-".$bulan."'";
				$this->db->query($sql_insert);
				
				
				/*//post transaksi penerimaan
				$sql_post_terima="UPDATE jurnal_pembelian SET terima_post='Y',terima_date_post='".$tanggal."' 
						WHERE date_format(terima_tanggal,'%Y-%m')='".$tahun."-".$bulan."'";
				$this->db->query($sql_post_terima);
				
				//post transaksi penerimaan
				$sql_post_terima="UPDATE jurnal_penjualan SET terima_post='Y',terima_date_post='".$tanggal."' 
						WHERE date_format(terima_tanggal,'%Y-%m')='".$tahun."-".$bulan."'";
				$this->db->query($sql_post_terima);*/

			}
			
			return '1';
		}
}
?>