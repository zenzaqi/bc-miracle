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

class M_report_mutasi extends Model{
		
		//constructor
		function M_report_mutasi() {
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
		
		function printreport_mutasi($mutasi_asal,$mutasi_tujuan,$mutasi_tglstart,$mutasi_tglend){
			//full query
			$query = "SELECT master_mutasi.*,asal.gudang_nama as gudang_nama_asal,tujuan.gudang_nama as gudang_nama_tujuan FROM `master_mutasi`,`gudang` as asal,`gudang` as tujuan WHERE mutasi_asal=asal.gudang_id AND mutasi_tujuan=tujuan.gudang_id";
//			
//			if($_SESSION["usergroup"]==3){
//				$query .=" and agenda_sales='".$_SESSION["userid"]."'";
//			}else if($_SESSION["usergroup"]==2){
//				$query .=" and agenda_sales in (select user_id from tbl_users where user_manager='".$_SESSION["userid"]."')";
//			}
			
			if($mutasi_asal!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " mutasi_asal = '".$mutasi_asal."'";
			};
			if($mutasi_tujuan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " mutasi_tujuan = '".$mutasi_tujuan."'";
			};
			
			if($mutasi_tglstart!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " (mutasi_tanggal between '".$mutasi_tglstart."' and '".$mutasi_tglend."')";
			};
			
			$result = $this->db->query($query);
			
			//$this->output->set_output($query);
			return $result;
		}

}
?>