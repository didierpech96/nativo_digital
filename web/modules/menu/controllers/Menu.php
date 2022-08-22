<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Menu extends MX_Controller {

	public $data;
	public $user;
	public $limit_notificaciones = 10;
	
	public function __construct()
	{
		parent::__construct();				
		$this->load->helper(array('url', 'tools_helper'));
		$this->load->model(array('Mgeneral'));
	}
	
	public function index()
	{
		$data['seccion'] = $this->uri->segment(1);
		$id_usuario = $this->session->userdata[$this->config->item('log_key')]['id_usuario'];
		$data['user'] = $this->Mgeneral->select_default("agente","*",array("id_agente" => $id_usuario));
		
		
		
		$this->load->view('menu/menu_view',$data);
	}
	
}
?>