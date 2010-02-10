<?php 

class M_main extends Model{

	function M_main(){
		parent::Model();
	}

	function get_menus(){
		if($_SESSION[SESSION_USERID]==='Super Admin')
			$sql="select * from menus where menu_parent=0 order by menu_position asc";
		else
			$sql="select * from vu_menus where group_id='".$_SESSION[SESSION_GROUPID]."' and menu_parent=0 order by menu_position asc ";
		$query=$this->db->query($sql);
		$rs=$query->result_array();
		return $rs;
	}
	
	function get_background(){
		$sql="select info_background from info";
		$query=$this->db->query($sql);
		$rs=$query->result_array();
		return $rs;
	}	
	
	
	function get_sub_menus(){
		if($_SESSION[SESSION_USERID]==='Super Admin')
			$sql="select * from menus where menu_parent<>0 order by menu_parent,menu_position asc";
		else
			$sql="select * from vu_menus where group_id='".$_SESSION[SESSION_GROUPID]."' and menu_parent<>0 order by menu_parent,menu_position asc ";
		$query=$this->db->query($sql);
		$rs=$query->result_array();
		return $rs;
	}
	
	function get_shortcuts(){
		if($_SESSION[SESSION_USERID]==='Super Admin')
			$sql="select * from menus where menu_parent<>0 and menu_leftpanel='Y' order by menu_parent,menu_position asc";
		else
			$sql="select * from vu_menus where menu_parent<>0 and group_id='".$_SESSION[SESSION_GROUPID]."' and menu_leftpanel='Y' order by menu_parent,menu_position asc ";
		$query=$this->db->query($sql);
		$rs=$query->result_array();
		return $rs;
	}
	
	
}
?>