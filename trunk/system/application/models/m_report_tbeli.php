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

class M_report_tbeli extends Model{
		
		//constructor
		function M_report_tbeli() {
			parent::Model();
		}
		
		function get_order_beli_list(){
			$sql="SELECT * FROM master_order_beli";
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
		
		function printreport_tbeli($terima_supplier,$terima_order,$terima_tglstart,$terima_tglend){
			//full query
			$query = "SELECT * FROM `master_terima_beli`,`master_order_beli`,`supplier` WHERE terima_supplier=supplier_id AND terima_order=order_id";
//			
//			if($_SESSION[SESSION_GROUPID]==3){
//				$query .=" and agenda_sales='".$_SESSION[SESSION_USERID]."'";
//			}else if($_SESSION[SESSION_GROUPID]==2){
//				$query .=" and agenda_sales in (select user_id from tbl_users where user_manager='".$_SESSION[SESSION_USERID]."')";
//			}
			
			if($terima_supplier!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " terima_supplier = '".$terima_supplier."'";
			};
			if($terima_order!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " terima_order = '".$terima_order."'";
			};
			
			if($terima_tglstart!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " (terima_tanggal between '".$terima_tglstart."' and '".$terima_tglend."')";
			};
			
			$result = $this->db->query($query);
			
			//$this->output->set_output($query);
			return $result;
		}

}
?>