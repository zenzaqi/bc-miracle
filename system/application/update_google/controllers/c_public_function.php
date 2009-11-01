<?

class C_public_function extends Controller {

	//constructor
	function C_public_function(){
		parent::Controller();
		$this->load->model('m_public_function', '', TRUE);
		$data["agama"]=$this->m_public_function->get_agama_list();
		$this->load->vars($data);
	}
	
	//set index
	function index(){
		$this->load->helper('asset');
	}
	
}
?>