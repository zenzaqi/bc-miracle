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

class M_report_retur_jproduk extends Model{
		
		//constructor
		function M_report_retur_jproduk() {
			parent::Model();
		}
		
		function get_master_rproduk_list(){
			$sql="SELECT rproduk_id,rproduk_nobukti FROM master_retur_jual_produk";
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
		
		function get_master_jproduk_list(){
			$sql="SELECT jproduk_id,jproduk_nobukti FROM master_jual_produk";
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
		
		function printreport_rproduk($rproduk_cust,$rproduk_nobukti,$rproduk_nobuktijual,$rproduk_tglstart,$rproduk_tglend){
			//full query
			$query = "SELECT * FROM `master_retur_jual_produk`,`master_jual_produk`,`customer` WHERE rproduk_nobuktijual=jproduk_id AND rproduk_cust=cust_id";
//			
//			if($_SESSION["usergroup"]==3){
//				$query .=" and agenda_sales='".$_SESSION["userid"]."'";
//			}else if($_SESSION["usergroup"]==2){
//				$query .=" and agenda_sales in (select user_id from tbl_users where user_manager='".$_SESSION["userid"]."')";
//			}
			
			if($rproduk_cust!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rproduk_cust = '".$rproduk_cust."'";
			};
			if($rproduk_nobukti!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rproduk_id = '".$rproduk_nobukti."'";
			};
			if($rproduk_nobuktijual!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " rproduk_nobuktijual = '".$rproduk_nobuktijual."'";
			};
			if($rproduk_tglstart!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " (rproduk_tanggal between '".$rproduk_tglstart."' and '".$rproduk_tglend."')";
			};
			
			$result = $this->db->query($query);
			
			//$this->output->set_output($query);
			return $result;
		}

}
?>