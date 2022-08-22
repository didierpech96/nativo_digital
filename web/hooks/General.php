<?php
if (!defined( 'BASEPATH')) exit('No direct script access allowed'); 
class General {

    private $ci;
    public function __construct(){
        date_default_timezone_set('america/merida');
        $this->ci =& get_instance();
        !$this->ci->load->library('session') ? $this->ci->load->library('session') : false;
        !$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;
        // !$this->ci->load->model('Mgeneral') ? $this->ci->load->model('Mgeneral') : false;
        $this->controller = strtolower($this->ci->router->class);
        $this->metodo = strtolower($this->ci->router->fetch_method());
    }   
 
    public function check_login(){
        if($this->ci->input->is_ajax_request() && !$this->ci->session->userdata($this->ci->config->item('log_key')) && $this->controller != "login"){
            echo '  
            <div class="row caducidad">
            <div class="col-md-12">
              <div class="notify errorbox">
                <h1>¡Lo sentimos!</h1>
                <span class="alerticon"><img src="images/error.png" alt="error" /></span>
                <p>Su sesión ha caducado :(</p>
              </div>      
            </div>
            </div>';
            exit();
        }
        if($this->ci->session->userdata($this->ci->config->item('log_key')) == TRUE && $this->controller == "login" && $this->controller."/".$this->metodo != "login/logout"){ 
                redirect("dashboard"); 
        }
        if($this->controller != 'login'){
            setcookie("prev_path",$this->ci->uri->uri_string(),time()+(3600 * 2),str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']));
        }
        if($this->ci->session->userdata($this->ci->config->item('log_key')) == FALSE && $this->controller != 'login' && $this->controller != "api"){
            redirect('login');
        }
    }
}
?>
