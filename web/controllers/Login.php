<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends MX_Controller {
    public $data,$mainView;
    public function __construct(){
        parent::__construct();
        $this->data['title'] = "Login";
        $this->data['js'] = array();
        $this->data['css'] = array();
        $this->mainView = ""; //folder of view
        $this->load->model(array('Mlogin'));
        $this->load->helper();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;   
    }

    public function index(){
        $this->load->view('templates/login_admin',$this->data);
    }
    public function ingresar(){
        $response = array("estatus" => 0,"mensaje" => "","redirect" => "");
        $usuario = $_POST["usuario"];
        $password = sha1( $_POST["password"]);
        $usuario = $this->Mlogin->ingresar($usuario,$password);
        if(empty($usuario)){
            $response["mensaje"] = "<p>Usuario o contraseña incorrectas</p>";
            echo json_encode($response); exit();
        }
        $session_data = array('usuario' => $usuario->email, 'id_usuario'=> $usuario->id_agente);
        $this->session->set_userdata($this->config->item('log_key'),$session_data);
        $response["estatus"] = 1;
        $response["mensaje"] = "<p>Datos correctos</p><p>Será redirigido en unos instantes</p>";
        if(isset($_COOKIE["prev_path"])){
            $response["redirect"] = $_COOKIE["prev_path"];
        }
        echo json_encode($response);
    }
    public function logout(){
        $this->session_data = array('user'=>'', 'id_usuario'=>'');
        $this->session->unset_userdata($this->config->item('log_key'), $this->session_data);
        redirect('login','refresh');
    }
}
?>