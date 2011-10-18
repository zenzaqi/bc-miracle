<? /* 
	
*/

class M_welcome_msg extends Model{
		
	//constructor
	function M_welcome_msg() {
		parent::Model();
	}
	
	function get_welcome_message($task){
		$tgl_now	= date('Y-m-d');
		$query 		=  "SELECT 
							welcome_id, welcome_msg 
						FROM welcome_msg 
						WHERE 
							welcome_group = '".$_SESSION[SESSION_GROUPID]."'
							and '".$tgl_now."' between welcome_tglawal and welcome_tglakhir";
		$welcome_msg ='';
		/*
			$result = $this->db->query($query);
			foreach($result->result() as $row){
				$welcome_msg=$welcome_msg.' '.'\n'.$row->welcome_msg;
			}
			return $welcome_msg;
		*/
		
		
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
		
						
}
?>