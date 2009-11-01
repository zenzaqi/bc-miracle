<?php 

class M_security extends Model{

	function M_security(){
		parent::Model();
	}

	function get_user_group(){
		return $_SESSION["usergroup"];
	}

	function get_access_group($group_id,$form_id){
		
		if($_SESSION["userid"]=='Super Admin'){
			return 'RCUD';
		}else{
			
		$sql="select perm_priv from permissions where perm_group='".$group_id."' and  perm_menu='".$form_id."'";
		$query=$this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row();
			return $row->perm_priv;
		}else
			return "";
		
		}
	}
}
?>