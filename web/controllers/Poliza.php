<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Poliza extends MX_Controller {
    public $data,$mainView;
    /**--------------------------------------------*
     * Metodo constructor
     * Contiene los enlaces a los recursos del modulo
     *---------------------------------------------*
    */          
    public function __construct(){
        parent::__construct();
        $this->data['title'] = "Poliza";
        $this->data['js'] = array('js/poliza.js');
        $this->data['css'] = array();
        $this->mainView = "poliza/";
        $this->load->model(array('Mpoliza'));
        $this->load->helper();
        $this->load->library(array('form_validation'));
        $this->form_validation->CI =& $this;    
    }     
    /**--------------------------------------------*
     * Metodo Index
     * Se encarga de construir la vista y enviarle datos segun se requiera
     *---------------------------------------------*
     * $offset : Crea un offset en la consulta SQL su valor inicial es 0
     *---------------------------------------------*
    */       
    public function index(){
        ob_start();
            // Llama  a la funcion f_paginacion_ajax
            $this->f_paginacion_ajax();
            $initial_content = ob_get_contents();
        ob_end_clean();     
         // Tabla con los datos de la consulta
        $data['table'] = "<div id='paginacion'>" . $initial_content . "</div>" ;
        // $data["acciones"] = verifica_acciones();
        // Envia los datos a la vista (index)
        $this->data['contenido'] = $this->load->view($this->mainView.'index',$data,true);
        $this->load->view('templates/masterPage',$this->data);        
    }
    /**--------------------------------------------*
     * Metodo Paginacion
     * Se encarga de obtener y paginar los resultados de la consulta
     *---------------------------------------------*
     * $offset : Crea un offset en la consulta SQL su valor inicial es 0
     *---------------------------------------------*
    */      
    public function f_paginacion_ajax($offset = 0){
        // Validaciones
        // $nombre_usuario = trim($this->input->post('nombre_usuario')); 
        // $id_aplicacion = trim($this->input->post('id_aplicacion')); 
        // $id_usuario = trim($this->input->post('id_usuario')); 
        //Libreria
        $this->load->library('Jquery_pagination');
        $data = array();   
        // Datos por pagina    
        $per_page = 10;
        // Datos a paginar
        $id_agente = $this->session->userdata[$this->config->item('log_key')]['id_usuario'];
        $paginacion = $this->Mpoliza->paginacion($per_page,$offset,$id_agente);
        $filas = $paginacion["filas"];
        $config = $this->jquery_paginacion($per_page,4,3,$filas,"/f_paginacion_ajax");
        $config['div'] = '#paginacion';
        $config['additional_param'] = array();
        $this->jquery_pagination->initialize($config);
        $data['resultados'] = $paginacion["resultados"];
        // $data["acciones"] = verifica_acciones();
        // Vista a paginar (Tabla)
        $html = $this->load->view($this->mainView.'table',$data,true);
        echo $html;        
    }
    public function add(){
        $data = [];
        $id_agente = $this->session->userdata[$this->config->item('log_key')]['id_usuario'];
        $data["cliente"] = $this->Mpoliza->select_default("cliente","*",["id_agente" => $id_agente]);
        $data["tipo_poliza"] = $this->Mpoliza->select_default("tipo_poliza","*");
        $this->data['contenido'] = $this->load->view($this->mainView.'add',$data,true);
        $this->load->view('templates/masterPage',$this->data);        
    }
    public function action_add(){
        // Si tratan de entrar a la funcion por la URL
        if (!$this->input->is_ajax_request()) {redirect ($this->router->class); }     
        // $data : Arreglo que almacena mensajes de error como de exito
        $response = array('estatus' => 0, "mensaje" => "" );
        $this->form_validation->set_rules('numero_poliza','Número poliza','required|trim|max_length[10]');
        $this->form_validation->set_rules('cliente','Cliente','trim|required');
        $this->form_validation->set_rules('aseguradora','Aseguradora','trim|max_length[150]|required');
        $this->form_validation->set_rules('tipo_poliza','Tipo poliza','trim|required');
        $this->form_validation->set_rules('precio','Precio','trim|required|numeric|greater_than[0]');
        // $this->form_validation->set_rules('id_aplicacion','Aplicación','required|trim');
        if ($this->form_validation->run('form') == TRUE){
            // $datosArticulo : Datos del formulario (Articulo)
            $data["numero_poliza"] = $_POST["numero_poliza"];
            $data["id_agente"] = $this->session->userdata[$this->config->item('log_key')]['id_usuario'];
            $data["fecha_inicio"] = $_POST["fecha_inicio"];
            $data["fecha_vigencia"] = $_POST["fecha_vigencia"];
            $data["id_cliente"] = $_POST["cliente"];
            $data["aseguradora"] = $_POST["aseguradora"];
            $data["tipo_poliza"] = $_POST["tipo_poliza"];
            $data["precio"] = $_POST["precio"];
            $data["status"] = $_POST["status"];

            $asegurados = [];
            if(!isset($_POST["nombre_asegurado"])){
                 $response["mensaje"] = Array("<p>Debes añadir al menos un asegurado</p>");
                 echo json_encode($response); exit();
            }
            foreach ($_POST["nombre_asegurado"] as $key => $a) {
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
        echo json_encode($response);
    }
}
?>