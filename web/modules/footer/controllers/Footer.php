<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Footer extends MX_Controller {

	public $data;
	public $user;
	
	public function __construct()
	{
		parent::__construct();				
		$this->load->helper(array('url', 'tools_helper'));
	}
	
	public function index()
	{
		$data['seccion'] = $this->uri->segment(1);
		$this->load->view('footer/footer_view',$data);
	}

	
	
}
?>