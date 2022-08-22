<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__).'/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright	Copyright (c) 2015 Wiredesignz
 * @version 	5.5
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Controller 
{
	public $autoload = array();
	
	public function __construct() 
	{
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;	
        date_default_timezone_set('america/merida');
		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);	
		$this->load->model(array("Mgeneral"));
		
		/* autoload module items */
		$this->load->_autoloader($this->autoload);
	}
	
	public function __get($class) 
	{
		return CI::$APP->$class;
	}
	public function sin_permiso(){
		$this->data["title"] = "Sin permiso";
		$data = array();
		$this->data['contenido'] = $this->load->view('templates/sin_permiso',$data,true);
        $this->load->view('templates/masterPage',$this->data);
	}
	public function paginacion($pages,$links,$segment,$filas,$ruta){
		$config = array();
        $config['next_link'] = 'Siguiente';//siguiente link
        $config['prev_link'] = 'Anterior';//anterior link
        $config['first_link'] = 'Primera';//primer link
        $config['last_link'] = 'Última';//último link
        $config['per_page'] = $pages; //Número de registros mostrados por páginas
        $config['num_links'] = $links; //Número de links mostrados en la paginación
        $config["uri_segment"] = $segment;//el segmento de la paginación
        $config['total_rows'] = $filas;//calcula el número de filas  
        $config['base_url'] = base_url().$ruta; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        return $config;
	}
	public function jquery_paginacion($pages,$links,$segment,$filas,$ruta){
		$config = array();
        $config['per_page'] = $pages; //Número de registros mostrados por páginas
        $config['num_links'] = $links; //Número de links mostrados en la paginación
        $config["uri_segment"] = $segment;//el segmento de la paginación
        $config['total_rows'] = $filas;//calcula el número de filas  
        $config['base_url'] = $this->router->class.$ruta; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['show_count'] = true;//en true queremos ver Viendo 1 a 10 de 52
        $config['next_link'] = 'Siguiente';//siguiente link
        $config['prev_link'] = 'Anterior';//anterior link
        $config['first_link'] = 'Primera';//primer link
        $config['last_link'] = 'Última';//último link
        $config['full_tag_open'] = '<ul class="pagination pagination-md">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '<span></span></span></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = '«';
        $config['prev_link'] = '‹';
        $config['last_link'] = '»';
        $config['next_link'] = '›';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        return $config;
	}
	protected function v_acciones($parametro){
		// $per = $this->Mgeneral->v_acciones_user($this->session->userdata['logged_in']['id'],$parametro);
		// if(is_numeric($per)){
  //           $per2 = $this->Mgeneral->v_acciones_rol($this->session->userdata['logged_in']['id'],$parametro);
  //           if(is_numeric($per2))
  //           echo json_encode(array('error' => array('<p>No tienes permisos para realizar esta acción</p>'))); exit();
  //       }

	}
    protected function array_to_string($array){
        $string = "";
        foreach ($array as $key => $value) {
            $string .= $value.",";
        }
        return (!empty($string)) ? substr($string, 0, -1) : $string;
    }
}