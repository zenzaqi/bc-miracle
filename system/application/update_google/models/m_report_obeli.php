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

class M_report_obeli extends Model{
		
		//constructor
		function M_report_obeli() {
			parent::Model();
		}
		
		function printreport_obeli($order_supplier,$order_carabayar,$order_tglstart ,$order_tglend){
			//full query
			$query = "SELECT * FROM `master_order_beli`,`supplier` WHERE order_supplier=supplier_id";
//			
//			if($_SESSION["usergroup"]==3){
//				$query .=" and agenda_sales='".$_SESSION["userid"]."'";
//			}else if($_SESSION["usergroup"]==2){
//				$query .=" and agenda_sales in (select user_id from tbl_users where user_manager='".$_SESSION["userid"]."')";
//			}
			
			if($order_supplier!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " order_supplier = '".$order_supplier."'";
			};
			if($order_carabayar!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " order_carabayar = '".$order_carabayar."'";
			};
			
			if($order_tglstart!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " (order_tanggal between '".$order_tglstart."' and '".$order_tglend."')";
			};
			
			$result = $this->db->query($query);
			
			//$this->output->set_output($query);
			return $result;
		}

}
?>