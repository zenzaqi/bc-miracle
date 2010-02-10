<?php
class C_login extends Controller {

	function C_login()
	{
		parent::Controller();
		$this->load->model('m_login', '', TRUE);
		session_start();
		if(isset($_SESSION[SESSION_USERID])){
			if($_SESSION[SESSION_USERID]!=="")
				header("location: ?c=main");
		}
	}
	
	function index()
	{
		$this->load->helper('asset');
		$this->load->view('v_login');
	}
	
	
	function verify() 
	{
		if( isset($_POST['username']) && isset($_POST['password'])) 
		{
			$u	= $_POST['username'];
			$pw	= md5($_POST['password']);
			
			$auth = $this->m_login->verifyUser($u, $pw);
			if($auth){
            	echo "{success:true}";
			} else{
				echo "{success:false,msg:'Username or Password incorrect'}";
			}
        } else {		
            echo "{success:false,msg:'Please fill the Requirement Field!'}";
        }
	}
	
	
	function logout(){
		unset($_SESSION[SESSION_USERID]);
		$this->session->set_flashdata('error',"You've been logged out!");
		redirect('','location',302);
	 }
	
	
}
?>