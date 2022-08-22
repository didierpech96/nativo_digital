<?php
   
require APPPATH . 'libraries/REST_Controller.php';
     
class Api extends REST_Controller {
    
	  /**
     * Get All Data from this method.
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       // $this->load->database();
       $this->load->model(["Mlogin","Mpoliza"]);
    }
       
    
    public function index_post()
    {
        $response = ['estatus' => '0', 'mensaje' => 'Error'];
        $accion = $this->input->post("accion");
        $post = $this->input->post();
        // if(is_null($accion) || @$accion == ""){
            switch ($accion) {
                case 'login':
                    $response = $this->login($post);
                    break;
                case 'add_poliza':
                    $response = $this->add_poliza($post);
                    break;
                case 'get_polizas':
                    $response = $this->get_polizas($post);
                    break;
                
                default:
                    $response["mensaje"] = "No existe el metodo al que deseas acceder";
                    break;
            }
        // }
            // print_r($response);
        echo json_encode($response,JSON_UNESCAPED_SLASHES);
        // $this->response((string)$response, REST_Controller::HTTP_OK);
    } 
    private function login($post){
        $usuario = $post["usuario"];
        $password = sha1( $post["password"]);
        $usuario = $this->Mlogin->login_rest($usuario,$password);
        if($usuario === false){
            $response["mensaje"] = "<p>Usuario o contraseña incorrectas</p>";
            return $response;
        }
        $response["estatus"] = 1;
        $response["mensaje"] = "<p>Token: ".$usuario."</p>";
        return $response;
    }
    private function add_poliza(){
        $this->load->library(array('form_validation'));
        $this->form_validation->CI =& $this;    
        // Si tratan de entrar a la funcion por la URL
        // if (!$this->input->is_ajax_request()) {redirect ($this->router->class); }     
        // $data : Arreglo que almacena mensajes de error como de exito
        $response = array('estatus' => 0, "mensaje" => "" );
        $this->form_validation->set_rules('numero_poliza','numero_poliza','required|trim|max_length[10]');
        $this->form_validation->set_rules('id_cliente','id_cliente','trim|required');
        $this->form_validation->set_rules('aseguradora','aseguradora','trim|max_length[150]|required');
        $this->form_validation->set_rules('id_tipo_poliza','id_tipo_poliza','trim|required');
        $this->form_validation->set_rules('precio','precio','trim|required|numeric|greater_than[0]');
        $this->form_validation->set_rules('token','token','trim|required|callback_valid_token');
        $this->form_validation->set_rules('id_agente','id_agente','trim|required');
        $this->form_validation->set_rules('fecha_inicio','fecha_inicio','trim|required');
        $this->form_validation->set_rules('fecha_vigencia','fecha_vigencia','trim|required');
        $this->form_validation->set_rules('status','status','trim|required');
        // $this->form_validation->set_rules('id_aplicacion','Aplicación','required|trim');
        if ($this->form_validation->run('form') == TRUE){
            // $datosArticulo : Datos del formulario (Articulo)
            $data["numero_poliza"] = $_POST["numero_poliza"];
            $data["id_agente"] = $_POST["id_agente"];
            $data["fecha_inicio"] = $_POST["fecha_inicio"];
            $data["fecha_vigencia"] = $_POST["fecha_vigencia"];
            $data["id_cliente"] = $_POST["id_cliente"];
            $data["aseguradora"] = $_POST["aseguradora"];
            $data["tipo_poliza"] = $_POST["id_tipo_poliza"];
            $data["precio"] = $_POST["precio"];
            $data["status"] = $_POST["status"];

            $asegurados = [];
            if(!isset($_POST["nombre_asegurado"])){
                 $response["mensaje"] = Array("<p>Debes añadir al menos un asegurado (field: nombre_asegurado[])</p>");
                 echo json_encode($response); exit();
            }
            if(!isset($_POST["edad_asegurado"])){
                 $response["mensaje"] = Array("<p>Debes añadir al menos un asegurado (field: edad_asegurado[])</p>");
                 return $response;
            }
            foreach ($_POST["nombre_asegurado"] as $key => $a) {
                if(!isset($_POST["edad_asegurado"][$key])){
                    $response["mensaje"] = Array("<p>Debes añadir la edad del asegurado ".$a." en el campo edad_asegurado[".$key."])</p>");
                    return $response; break;
                }
                $asegurados[] = [
                    "nombre_completo" => $a
                    ,"edad" => $_POST["edad_asegurado"][$key]
                ];
            }
            if($this->Mpoliza->nuevo($data,$asegurados)){
                $response["estatus"] = 1;
                $response["mensaje"] = "<p>Datos agregados con éxito</p>";
            }else{
                $response["mensaje"] = Array("<p>Ocurrió un error al intentar agregar los datos</p>");
            }
        }else{
            $response['mensaje'] = validation_errors();
        }
        return $response;
    }
    public function valid_token($str){
        $token = $this->Mlogin->select_default("token_rest","*",["token" => $str]);
        if (empty($token)){
                $this->form_validation->set_message('valid_token', 'El token de acceso es invalido');
                return FALSE;
        }
        else
        {
                return TRUE;
        }
    }
    public function get_polizas(){
        $this->load->library(array('form_validation'));
        $this->form_validation->CI =& $this;    
        $response = array('estatus' => 0, "mensaje" => "" );
        $this->form_validation->set_rules('tipo_poliza','tipo_poliza','required|trim');
        $this->form_validation->set_rules('fecha_vigencia','fecha_vigencia','required|trim');
        $this->form_validation->set_rules('token','token','trim|required|callback_valid_token');
        if ($this->form_validation->run('form') == TRUE){
            $polizas = $this->Mpoliza->select_default("poliza","*",["tipo_poliza" => $_POST["tipo_poliza"], "fecha_vigencia <= '".$_POST["fecha_vigencia"]."'" => null]);
            return $polizas;
        }else{
            $response['mensaje'] = validation_errors();
        }
        return $response;
    }
}