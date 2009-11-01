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

class M_report_voucher extends Model{
		
		//constructor
		function M_report_voucher() {
			parent::Model();
		}
		
		function get_promo_list(){
			$query = "SELECT * from promo";
			$result = $this->db->query($query);
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
		
		function printreport_voucher($voucher_nama,$voucher_jenis,$voucher_promo,$voucher_tglstart,$voucher_tglend){
			//full query
			$query = "SELECT * FROM `voucher`,`promo` WHERE voucher_promo=promo_id";
//			
//			if($_SESSION["usergroup"]==3){
//				$query .=" and agenda_sales='".$_SESSION["userid"]."'";
//			}else if($_SESSION["usergroup"]==2){
//				$query .=" and agenda_sales in (select user_id from tbl_users where user_manager='".$_SESSION["userid"]."')";
//			}
			
			if($voucher_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_nama LIKE '%".$voucher_nama."%'";
			};
			if($voucher_jenis!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_jenis = '".$voucher_jenis."'";
			};
			if($voucher_promo!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " voucher_promo = '".$voucher_promo."'";
			};
			if($voucher_tglstart!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " (voucher_kadaluarsa between '".$voucher_tglstart."' and '".$voucher_tglend."')";
			};
			
			$result = $this->db->query($query);
			
			//$this->output->set_output($query);
			return $result;
		}

}
?>