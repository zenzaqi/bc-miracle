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

class M_report_customer extends Model{
		
		//constructor
		function M_report_customer() {
			parent::Model();
		}
		
		function get_profesi_list(){
			$sql="select distinct(cust_profesi) from customer";
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			$result = $this->db->query($sql);  
			
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
		
		function get_hobi_list(){
			$sql="select distinct(cust_hobi) from customer";
			$result = $this->db->query($sql);
			$nbrows = $result->num_rows();
			$result = $this->db->query($sql);  
			
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
		
		function printreport_customer($cust_nama, $cust_kelamin, $cust_agama, $cust_statusnikah, $cust_hobi, $cust_kota, $cust_propinsi, $cust_pendidikan, $cust_profesi, $cust_cabang, $cust_terdaftarstart, $cust_terdaftarend){
			//full query
			$query = "SELECT * FROM `customer`,`cabang` WHERE cust_unit=cabang_id";
			
//			if($_SESSION["usergroup"]==3){
//				$query .=" and agenda_sales='".$_SESSION["userid"]."'";
//			}else if($_SESSION["usergroup"]==2){
//				$query .=" and agenda_sales in (select user_id from tbl_users where user_manager='".$_SESSION["userid"]."')";
//			}
			
			if($cust_nama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_nama LIKE '%".$cust_nama."%'";
			};
			if($cust_kelamin!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_kelamin = '".$cust_kelamin."'";
			};
			if($cust_agama!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_agama = '".$cust_agama."'";
			};
			if($cust_statusnikah!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_statusnikah = '".$cust_statusnikah."'";
			};
			if($cust_hobi!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_hobi = '".$cust_hobi."'";
			};
			if($cust_kota!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_kota LIKE '%".$cust_kota."%'";
			};
			if($cust_propinsi!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_propinsi LIKE '%".$cust_propinsi."%'";
			};
			if($cust_pendidikan!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_pendidikan = '".$cust_pendidikan."'";
			};
			if($cust_profesi!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_profesi = '".$cust_profesi."'";
			};
			if($cust_cabang!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " cust_unit = '".$cust_cabang."'";
			};
			if($cust_terdaftarstart!=''){
				$query.=eregi("WHERE",$query)?" AND ":" WHERE ";
				$query.= " (cust_terdaftar between '".$cust_terdaftarstart."' and '".$cust_terdaftarend."')";
			};
			
			$result = $this->db->query($query);
			
			//$this->output->set_output($query);
			return $result;
		}

}
?>