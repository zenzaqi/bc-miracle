<? /* 	These code was generated using phpCIGen v 0.1.a (21/04/2009)
	#zaqi 		zaqi.smart@gmail.com,http://zenzaqi.blogspot.com, 
    #songbee	mukhlisona@gmail.com
	#CV. Trust Solution, jl. Saronojiwo 19 Surabaya, http://www.ts.co.id
	
	+ Module  		: tbl_customer Model
	+ Description	: For record model process back-end
	+ Filename 		: M_report_customer.php
 	+ Author  		: 
 	+ Created on 01/May/2009 06:35:27
	
*/

class M_report_retur_jpaket extends Model{
		
		//constructor
		function M_report_retur_jpaket() {
			parent::Model();
		}
		
		function get_master_rpaket_list(){
			$sql="SELECT rpaket_id,rpaket_nobukti FROM master_retur_jual_paket";
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			
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
		
		function get_master_jpaket_list(){
			$sql="SELECT jpaket_id,jpaket_nobukti FROM master_jual_paket";
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			
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
		
		function printreport_rpaket($rpaket_cust,$rpaket_nobukti,$rpaket_nobuktijual,$rpaket_tglstart,$rpaket_tglend){
			//full query
			$query = "SELECT * FROM `master_retur_jual_paket`,`master_jual_paket`,`customer` WHERE rpaket_nobuktijual=jpaket_id AND rpaket_cust=cust_id";
//			
//			if($_SESSION[SESSION_GROUPID]==3){
//				$query .=" and agenda_sales='".$_SESSION[SESSION_USERID]."'";
//			}else if($_SESSION[SESSION_GROUPID]==2){
//				$query .=" and agenda_sales in (select user_id from tbl_users where user_manager='".$_SESSION[SESSION_USERID]."')";
//			}
			
			if($rpaket_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rpaket_cust = '".$rpaket_cust."'";
			};
			if($rpaket_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rpaket_id = '".$rpaket_nobukti."'";
			};
			if($rpaket_nobuktijual!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rpaket_nobuktijual = '".$rpaket_nobuktijual."'";
			};
			if($rpaket_tglstart!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " (rpaket_tanggal between '".$rpaket_tglstart."' and '".$rpaket_tglend."')";
			};
			
			$result = $this->db->query($query);
			
			//$this->output->set_output($query);
			return $result;
		}

}
?>