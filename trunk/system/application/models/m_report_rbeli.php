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

class M_report_rbeli extends Model{
		
		//constructor
		function M_report_rbeli() {
			parent::Model();
		}
		
		function get_terima_beli_list(){
			$sql="SELECT * FROM master_terima_beli";
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
		
		function printreport_rbeli($rbeli_supplier,$rbeli_terima,$rbeli_tglstart,$rbeli_tglend){
			//full query
			$query = "SELECT * FROM `master_retur_beli`,`master_terima_beli`,`supplier` WHERE rbeli_supplier=supplier_id AND rbeli_terima=terima_id";
//			
//			if($_SESSION["usergroup"]==3){
//				$query .=" and agenda_sales='".$_SESSION["userid"]."'";
//			}else if($_SESSION["usergroup"]==2){
//				$query .=" and agenda_sales in (select user_id from tbl_users where user_manager='".$_SESSION["userid"]."')";
//			}
			
			if($rbeli_supplier!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rbeli_supplier = '".$rbeli_supplier."'";
			};
			if($rbeli_terima!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rbeli_terima = '".$rbeli_terima."'";
			};
			
			if($rbeli_tglstart!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " (terima_tanggal between '".$rbeli_tglstart."' and '".$rbeli_tglend."')";
			};
			
			$result = $this->db->query($query);
			
			//$this->output->set_output($query);
			return $result;
		}

}
?>