<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MX_Controller {
	public $data,$mainView;
    public function __construct(){
        parent::__construct();
        $this->data['title'] = "Dashboard";
        $this->data['js'] = array();
        $this->data['css'] = array();
        $this->mainView = "dashboard/"; //folder of view
        //$this->load->model(array('Mslider'));
    }

	public function index(){
        $data = array();
        //$data['msg'] = '';
        //$data['usuario'] = $this->Mmodel->function_name($parameters);
        //$data['direccion'] = $this->Mmodel->function_name($parameters);
        $this->data['contenido'] = $this->load->view($this->mainView.'index_view',$data,true);
        $this->load->view('templates/masterPage',$this->data);
	}
}
?>