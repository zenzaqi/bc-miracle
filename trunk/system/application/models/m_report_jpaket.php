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

class M_report_jpaket extends Model{
		
		//constructor
		function M_report_jpaket() {
			parent::Model();
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
		
		function printreport_jpaket($jpaket_cust,$jpaket_nobukti,$jpaket_tglstart,$jpaket_tglend){
			//full query
			$query = "SELECT * FROM `master_jual_paket`,`customer` WHERE jpaket_cust=cust_id";
//			
//			if($_SESSION["usergroup"]==3){
//				$query .=" and agenda_sales='".$_SESSION["userid"]."'";
//			}else if($_SESSION["usergroup"]==2){
//				$query .=" and agenda_sales in (select user_id from tbl_users where user_manager='".$_SESSION["userid"]."')";
//			}
			
			if($jpaket_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpaket_cust = '".$jpaket_cust."'";
			};
			if($jpaket_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " jpaket_id = '".$jpaket_nobukti."'";
			};
			
			if($jpaket_tglstart!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " (jpaket_tanggal between '".$jpaket_tglstart."' and '".$jpaket_tglend."')";
			};
			
			$result = $this->db->query($query);
			
			//$this->output->set_output($query);
			return $result;
		}

}
?>