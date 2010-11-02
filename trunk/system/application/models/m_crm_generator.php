<? /* 
	+ Module  		: Crm Generator Model
	+ Description	: For record model process back-end
	+ Filename 		: c_crm_generator.php
 	+ creator 		: Fred
	
*/

class M_crm_generator extends Model{
		
		//constructor
		function M_crm_generator() {
			parent::Model();
		}
		
		
	function get_customer_list2($query,$start,$end){
		$sql="SELECT cust_id,cust_no,cust_nama,cust_tgllahir,cust_alamat,cust_telprumah,cust_point FROM customer WHERE cust_aktif='Aktif'";
		if($query<>""){
			$sql=$sql." and (cust_id = '".$query."' or cust_no like '%".$query."%' or cust_alamat like '%".$query."%' or cust_nama like '%".$query."%' or cust_telprumah like '%".$query."%' or cust_telprumah2 like '%".$query."%' or cust_telpkantor like '%".$query."%' or cust_hp like '%".$query."%' or cust_hp2 like '%".$query."%' or cust_hp3 like '%".$query."%') ";
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
		
	
		//function for get list record
		function crm_generator_list($filter,$start,$end){
		
			$query = 
			   "SELECT 
					crmvalue_id, crmvalue_date, c1.cust_nama as crmvalue_cust, c1.cust_no as crmvalue_cust_no ,crmvalue_frequency, crmvalue_recency, 
					crmvalue_spending, crmvalue_highmargin, crmvalue_referal, crmvalue_kerewelan, crmvalue_disiplin, crmvalue_treatment,
					(crmvalue_frequency + crmvalue_recency + crmvalue_spending + crmvalue_highmargin + crmvalue_referal + crmvalue_kerewelan +
					crmvalue_disiplin + crmvalue_treatment) as crmvalue_total,
					crmvalue_priority
				FROM crm_value
				left join customer c1 on (c1.cust_id = crm_value.crmvalue_cust)";
			
			// For simple search
			if ($filter<>""){
				$query .=eregi("WHERE",$query)? " AND ":" WHERE ";
				$query .= " (crmvalue_id LIKE '%".addslashes($filter)."%' OR crmvalue_date LIKE '%".addslashes($filter)."%' OR crmvalue_cust LIKE '%".addslashes($filter)."%' OR crmvalue_frequency LIKE '%".addslashes($filter)."%' )";
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
		
		
		//function for generate value CRM
		function crm_generator_create($query, $crmvalue_id, $crmvalue_cust, $crmvalue_date, $crmvalue_frequency, $crmvalue_recency, $crmvalue_spending, $crmvalue_highmargin, $crmvalue_referal, $crmvalue_kerewelan, $crmvalue_disiplin, $crmvalue_treatment, $crmvalue_author){
			$datetime_now=date('Y-m-d H:i:s');
			
			//untuk mendapatkan parameter di crm_setup
			$sql_parameter = 
			   "select max(setcrm_id) as setcrm_id, 
					c.setcrm_frequency_count, c.setcrm_frequency_days, 
					c.setcrm_frequency_value_morethan, c.setcrm_frequency_value_equal, c.setcrm_frequency_value_lessthan,
					c.setcrm_recency_days, c.setcrm_recency_value_morethan, c.setcrm_recency_value_lessthan, 
					c.setcrm_spending_days, c.setcrm_spending_value_lessthan, c.setcrm_spending_value_equal, c.setcrm_spending_value_morethan,
					c.setcrm_referal_person, c.setcrm_referal_days, c.setcrm_referal_morethan, c.setcrm_referal_equal, c.setcrm_referal_lessthan
				from crm_setup c";
			
			$query_parameter				= $this->db->query($sql_parameter);
			$data_parameter 				= $query_parameter->row();
			
			$setcrm_frequency_count			= $data_parameter->setcrm_frequency_count;
			$setcrm_frequency_days 			= $data_parameter->setcrm_frequency_days;
			$setcrm_frequency_value_lessthan= $data_parameter->setcrm_frequency_value_lessthan;
			$setcrm_frequency_value_equal 	= $data_parameter->setcrm_frequency_value_equal;
			$setcrm_frequency_value_morethan= $data_parameter->setcrm_frequency_value_morethan;
			
			$setcrm_recency_days 			= $data_parameter->setcrm_recency_days;
			$setcrm_recency_value_lessthan 	= $data_parameter->setcrm_recency_value_lessthan;
			$setcrm_recency_value_morethan 	= $data_parameter->setcrm_recency_value_morethan;
			
			$setcrm_spending_days			= $data_parameter->setcrm_spending_days;
			$setcrm_spending_value_lessthan	= $data_parameter->setcrm_spending_value_lessthan;
			$setcrm_spending_value_equal 	= $data_parameter->setcrm_spending_value_equal;
			$setcrm_spending_value_morethan	= $data_parameter->setcrm_spending_value_morethan;
			
			$setcrm_referal_person			= $data_parameter->setcrm_referal_person;
			$setcrm_referal_days			= $data_parameter->setcrm_referal_days;
			$setcrm_referal_morethan		= $data_parameter->setcrm_referal_morethan;
			$setcrm_referal_equal			= $data_parameter->setcrm_referal_equal;
			$setcrm_referal_lessthan		= $data_parameter->setcrm_referal_lessthan;
			
	
			//UNTUK MENGHITUNG FREQUENCY:
			//selalu sesuaikan query dengan query di m_lap_kunjungan.php
			
			$sql_value_frequency =
			   "select 
				sum(cust) as jum_total
				from
					(
					select 
						count(m.jrawat_cust) as cust
					from detail_jual_rawat
					left join master_jual_rawat m on (detail_jual_rawat.drawat_master = m.jrawat_id)
					left join perawatan p on (detail_jual_rawat.drawat_rawat=p.rawat_id)
					where 
						m.jrawat_stat_dok <> 'Batal' and 
						m.jrawat_bayar <> 0 and 
						(p.rawat_kategori = 2 or p.rawat_kategori = 3 or p.rawat_kategori = 4 or p.rawat_kategori = 16) and 
						date_add(m.jrawat_tanggal, interval '$setcrm_frequency_days' day) >= now() and m.jrawat_cust = '$crmvalue_cust'
					group by m.jrawat_tanggal
					
					union
					
					select 
						count(m.jproduk_cust) as cust
					from master_jual_produk m
					where 
						m.jproduk_stat_dok <> 'Batal' and m.jproduk_bayar <> 0 and
						date_add(m.jproduk_tanggal, interval '$setcrm_frequency_days' day) >= now() and m.jproduk_cust = '$crmvalue_cust'
					group by m.jproduk_tanggal
					
					union
			
					select 
						count(d.dapaket_cust) as cust
					from detail_ambil_paket d
					left join perawatan p on (d.dapaket_item = p.rawat_id)
					where 
						(p.rawat_kategori = 2 or p.rawat_kategori = 3 or p.rawat_kategori = 4 or p.rawat_kategori = 16) and	d.dapaket_stat_dok <> 'Batal' and
						date_add(d.dapaket_tgl_ambil, interval '$setcrm_frequency_days' day) >= now() and d.dapaket_cust = '$crmvalue_cust'
					group by d.dapaket_tgl_ambil
					)
					as table_union2
			   ";
			   
			$query_frequency	= $this->db->query($sql_value_frequency);
			$data_frequency		= $query_frequency->row();
			$jum_total			= $data_frequency->jum_total;
			
			if ($jum_total <= $setcrm_frequency_count){
				$crmvalue_frequency = $setcrm_frequency_value_lessthan;
			}
			else if ($jum_total == $setcrm_frequency_count){
				$crmvalue_frequency = $setcrm_frequency_value_equal;
			}
			else if ($jum_total >= $setcrm_frequency_count){
				$crmvalue_frequency = $setcrm_frequency_value_morethan;
			}
			
			
			//UNTUK MENGHITUNG RECENCY:
			
			$sql_value_recency = 
			   "select dapaket_id as id
				from detail_ambil_paket d
				where date_add(d.dapaket_tgl_ambil, interval '$setcrm_recency_days' day) >= now() and dapaket_cust = '$crmvalue_cust'
				
				union
				
				select d2.drawat_id as id
				from detail_jual_rawat d2
				left join master_jual_rawat m2 on m2.jrawat_id = d2.drawat_master
				where date_add(m2.jrawat_tanggal, interval '$setcrm_recency_days' day) >= now() and m2.jrawat_cust = '$crmvalue_cust'

				union
				
				select d3.dproduk_id as id
				from detail_jual_produk d3
				left join master_jual_produk m3 on m3.jproduk_id = d3.dproduk_master
				where date_add(m3.jproduk_tanggal, interval '$setcrm_recency_days' day) >= now() and m3.jproduk_cust = '$crmvalue_cust'
				";
			$query_recency	= $this->db->query($sql_value_recency);
			$recency_row 	= $query_recency->num_rows();
			
			if($recency_row==0){
				$crmvalue_recency = $setcrm_recency_value_lessthan;
			}
			else if($recency_row>=1){
				$crmvalue_recency = $setcrm_recency_value_morethan;
			}
			
			
			//UNTUK MENGHITUNG SPENDING:
			
			//menghitung Total Spending Rata2 / All(selalu sesuaikan dg m_report_rekap_penjualan)
			//Spending Produk:
			$sql_spending_produk_all = 
			   "SELECT 
					(SUM((d.dproduk_jumlah * d.dproduk_harga)-((d.dproduk_jumlah * d.dproduk_harga)*d.dproduk_diskon/100)) - 
					SUM((m.jproduk_diskon *((d.dproduk_jumlah * d.dproduk_harga)-((d.dproduk_jumlah * d.dproduk_harga)*d.dproduk_diskon/100))) /100)) -
					IFNULL 
					  ((SELECT SUM(dr.drproduk_jumlah*dr.drproduk_harga) 
						FROM detail_retur_jual_produk dr
						LEFT JOIN master_retur_jual_produk mr ON dr.drproduk_master = mr.rproduk_id
						WHERE 
							date_add(mr.rproduk_tanggal, interval '$setcrm_spending_days' day) >= now() AND mr.rproduk_stat_dok <> 'Batal' ),0) 
					AS tot_net
				FROM detail_jual_produk d
				LEFT JOIN master_jual_produk m ON d.dproduk_master = m.jproduk_id
				WHERE
					date_add(m.jproduk_tanggal, interval '$setcrm_spending_days' day) >= now() AND m.jproduk_stat_dok <> 'Batal'";
			
			$query_spending_produk_all	= $this->db->query($sql_spending_produk_all);
			$data_spending_produk_all	= $query_spending_produk_all->row();
			$jum_spending_produk_all	= $data_spending_produk_all->tot_net;
			
			//Spending Perawatan:
			$sql_spending_perawatan_all = 
			   "SELECT 
					(SUM((d.drawat_jumlah * d.drawat_harga)-((d.drawat_jumlah * d.drawat_harga)*d.drawat_diskon/100)) - 
						SUM((M.jrawat_diskon *((d.drawat_jumlah * d.drawat_harga)-((d.drawat_jumlah * d.drawat_harga)*d.drawat_diskon/100))) /100)) AS grand_total
				FROM detail_jual_rawat d
				LEFT JOIN master_jual_rawat M ON d.drawat_master = M.jrawat_id
				LEFT JOIN perawatan ON d.drawat_rawat = perawatan.rawat_id
				LEFT JOIN kategori ON perawatan.rawat_kategori = kategori.kategori_id
				WHERE
					date_add(m.jrawat_tanggal, interval '$setcrm_spending_days' day) >= now() AND m.jrawat_stat_dok <> 'Batal'";
			
			$query_spending_perawatan_all	= $this->db->query($sql_spending_perawatan_all);
			$data_spending_perawatan_all	= $query_spending_perawatan_all->row();
			$jum_spending_perawatan_all		= $data_spending_perawatan_all->tot_net;
			
			//Spending Pengambilan Paket:
			 $sql_spending_apaket_all =
			   "select 
					SUM(d.dapaket_jumlah * 
						(((((dj.dpaket_harga * (100 - dj.dpaket_diskon) / 100) * dj.dpaket_jumlah) - 
						(((m.jpaket_diskon * (dj.dpaket_harga * (100 - dj.dpaket_diskon) / 100)) * dj.dpaket_jumlah) / 100)) / dj.dpaket_jumlah) / v.isi_paket) -
						(((((m.jpaket_diskon * (dj.dpaket_harga * (100 - dj.dpaket_diskon) / 100)) * dj.dpaket_jumlah) / 100)) / dj.dpaket_jumlah) / v.isi_paket) AS tot_net
				from detail_ambil_paket d
				join master_jual_paket m on m.jpaket_id = d.dapaket_jpaket 
				left join vu_jumlah_isi_paket v on d.dapaket_paket = v.paket_id
				left join detail_jual_paket dj on d.dapaket_dpaket = dj.dpaket_id
				WHERE
					date_add(m.jpaket_tanggal, interval '$setcrm_spending_days' day) >= now() AND m.jpaket_stat_dok <> 'Batal'";
			
			$query_spending_apaket_all	= $this->db->query($sql_spending_apaket_all);
			$data_spending_apaket_all	= $query_spending_apaket_all->row();
			$jum_spending_apaket_all	= $data_spending_apaket_all->tot_net;
			
			//Total Spending (Produk + Perawatan + Pengambilan Paket):
			$tot_spending_all	= $jum_spending_produk_all + $jum_spending_perawatan_all + $jum_spending_apaket_all;
			
			//menghitung Total Kunjungan
			//selalu sesuaikan query dengan query di m_lap_kunjungan.php
			$sql_value_frequency_all =
			   "select 
				sum(cust) as jum_total
				from
					(
					select 
						count(m.jrawat_cust) as cust
					from detail_jual_rawat
					left join master_jual_rawat m on (detail_jual_rawat.drawat_master = m.jrawat_id)
					left join perawatan p on (detail_jual_rawat.drawat_rawat=p.rawat_id)
					where 
						m.jrawat_stat_dok <> 'Batal' and 
						m.jrawat_bayar <> 0 and 
						(p.rawat_kategori = 2 or p.rawat_kategori = 3 or p.rawat_kategori = 4 or p.rawat_kategori = 16) and 
						date_add(m.jrawat_tanggal, interval '$setcrm_frequency_days' day) >= now()
					group by m.jrawat_tanggal
					
					union
					
					select 
						count(m.jproduk_cust) as cust
					from master_jual_produk m
					where 
						m.jproduk_stat_dok <> 'Batal' and m.jproduk_bayar <> 0 and
						date_add(m.jproduk_tanggal, interval '$setcrm_frequency_days' day) >= now()
					group by m.jproduk_tanggal
					
					union
			
					select 
						count(d.dapaket_cust) as cust
					from detail_ambil_paket d
					left join perawatan p on (d.dapaket_item = p.rawat_id)
					where 
						(p.rawat_kategori = 2 or p.rawat_kategori = 3 or p.rawat_kategori = 4 or p.rawat_kategori = 16) and	d.dapaket_stat_dok <> 'Batal' and
						date_add(d.dapaket_tgl_ambil, interval '$setcrm_frequency_days' day) >= now()
					group by d.dapaket_tgl_ambil
					)
					as table_union2
			   ";
			   
			$query_frequency_all	= $this->db->query($sql_value_frequency_all);
			$data_frequency_all		= $query_frequency_all->row();
			$jum_total_all			= $data_frequency_all->jum_total;
			


			//UNTUK MENGHITUNG REFERAL RATE:
			
			$sql_value_referal = 
			   "select count(c.cust_id) as jum_referal
			    from customer c
				where date_add(c.cust_terdaftar, interval $setcrm_referal_days day) >= now() and c.cust_referensi = '$crmvalue_cust'
				";
			$query_referal	= $this->db->query($sql_value_referal);
			$data_referal	= $query_referal->row();
			$jum_referal	= $data_referal->jum_referal;
			
			
			if ($jum_referal > $setcrm_referal_person) {
				$crmvalue_referal = $setcrm_referal_morethan;
			}
			else if ($jum_referal == $setcrm_referal_person) {
				$crmvalue_referal = $setcrm_referal_equal;
			}
			else if ($jum_referal < $setcrm_referal_person) {
				$crmvalue_referal = $setcrm_referal_lessthan;
			}
			
				
			$data=array(
				"crmvalue_frequency"=> $crmvalue_frequency,
				"crmvalue_recency"	=> $crmvalue_recency,
				"crmvalue_referal"	=> $crmvalue_referal,
				"crmvalue_cust"		=> $crmvalue_cust,	
				"crmvalue_date"		=> $crmvalue_date,
				"crmvalue_author"	=> $_SESSION[SESSION_USERID]
			);
			$this->db->insert('crm_value',$data);
			
			if($this->db->affected_rows())
				return '1';
			else
				return '0';

		}
		
		
}
?>