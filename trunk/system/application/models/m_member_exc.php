<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: member Model
	+ Description	: For record model process back-end
	+ Filename 		: c_member.php
 	+ Author  		: 
 	+ Created on 01/Sep/2009 10:36:44
	
*/

class M_member_exc extends Model{
		
		//constructor
		function M_member_exc() {
			parent::Model();
		}
		
		//Adding Member Tanpa-Transaksi
		function member_add($member_cust ){
			$date_now=date('Y-m-d');
			
			$sql="SELECT member_id FROM member WHERE member_cust='$member_cust'";
			$rs=$this->db->query($sql);
			if(!$rs->num_rows()){
				$sql="SELECT setmember_transhari, setmember_periodeaktif, setmember_periodetenggang, setmember_transtenggang FROM member_setup LIMIT 1";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$rs_record=$rs->row_array();
					$min_trans_member_baru=$rs_record['setmember_transhari'];
					$periode_tenggang=$rs_record['setmember_periodetenggang'];
					$min_trans_tenggang=$rs_record['setmember_transtenggang'];
					$periode_aktif=$rs_record['setmember_periodeaktif'];
				}
				
				$sql = "SELECT cust_no FROM customer WHERE cust_id='$member_cust'";
				$rs=$this->db->query($sql);
				if($rs->num_rows()){
					$rs_record=$rs->row_array();
					$pattern=date("ymd").substr($rs_record['cust_no'],2);
					$member_no=$this->m_public_function->get_nomor_member('member','member_no',$pattern,16);
				}
				
				$member_valid = date('Y-m-d', strtotime("$date_now +$periode_aktif days"));
				$data = array(
					"member_cust"=>$member_cust, 
					"member_no"=>$member_no, 
					"member_register"=>$date_now, 
					"member_valid"=>$member_valid, 
					"member_jenis"=>'baru', 
					"member_status"=>'Daftar', 
					"member_tglserahterima"=>NULL,
					"member_creator"=>@$_SESSION[SESSION_USERID]
				);
				$this->db->insert('member', $data); 
				if($this->db->affected_rows())
					return '1';
				else
					return '0';
			}else{
				return '0';
			}
		}
		
		
}
?>