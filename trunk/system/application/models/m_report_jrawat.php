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

class M_report_jrawat extends Model{
		
		//constructor
		function M_report_jrawat() {
			parent::Model();
		}
		
		function get_master_jrawat_list(){
			$sql="SELECT jrawat_id,jrawat_nobukti FROM master_jual_rawat";
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
		
		function printreport_jrawat($jrawat_cust,$jrawat_nobukti,$jrawat_tglstart,$jrawat_tglend){
			//full query
			$query = "SELECT * FROM `master_jual_rawat`,`customer` WHERE jrawat_cust=cust_id";
//			
//			if($_SESSION[SESSION_GROUPID]==3){
//				$query .=" and agenda_sales='".$_SESSION[SESSION_USERID]."'";
//			}else if($_SESSION[SESSION_GROUPID]==2){
//				$query .=" and agenda_sales in (select user_id from tbl_users where user_manager='".$_SESSION[SESSION_USERID]."')";
//			}
			
			if($jrawat_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jrawat_cust = '".$jrawat_cust."'";
			};
			if($jrawat_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jrawat_id = '".$jrawat_nobukti."'";
			};
			
			if($jrawat_tglstart!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " (jrawat_tanggal between '".$jrawat_tglstart."' and '".$jrawat_tglend."')";
			};
			
			$result = $this->db->query($query);
			
			//$this->output->set_output($query);
			return $result;
		}

}
?>