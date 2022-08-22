<?php
    if(!function_exists('formatDate')){
        function formatDate($date,$format = "d/m/Y"){
            $date = ($date != "" || $date != NULL) ? date($format, strtotime($date)) : "N/A"; 
            return $date;
        }
    }
    if(!function_exists('recorta_txt')){
        function recorta_txt($string,$max_length){
            if(strlen($string) > $max_length){
                $string = substr($string,0, $max_length)."...";
            }
            return $string;
        }
    }
    if(!function_exists('empty_post')){
    	function empty_post($data){
    		if(empty($data)){
    			$ci =& get_instance();
    			redirect($ci->router->class);
    		}
    	}
    } 
    if(!function_exists('breadcum')){
        function breadcum($Nombre = "",$N_Controlador = "",$Icono = ""){            
            
            // $contenido = '<div class="col-md-9 col-sm-9 col-xs-12">'.$contenido.'</div>';
            // $contenido .= 
            //         '<div class="col-md-3 col-sm-3 col-xs-12">
            //             <form class="x_panel breadcum" style="padding: 11px 1px 10px 1px; display: table">
            //             <div>
            //                 <input type="text" class="form-control" placeholder="Buscar contenido">
            //             </div>
            //             <button type="submit"><i class="fa fa-search"></i></button>
            //             </form>   
            //         </div>                            
            //         ';
            // return '<div class="row" id="breadcum">'.$contenido.'</div>';
            return "";
        }
    }
    if(!function_exists('v_botones')){
        function v_botones($parametro){
            $ci =& get_instance();
            $ci->config->load('');
            $ci->session->userdata['logged_in']['id'];
            $ci->load->model(array('Mgeneral'));
            $per = $ci->Mgeneral->v_acciones_rol($ci->session->userdata['logged_in']['id'],$parametro);
            if(is_numeric($per)){
                $per2 = $ci->Mgeneral->v_acciones_user($ci->session->userdata['logged_in']['id'],$parametro);
                if(is_numeric($per2)){
                    return FALSE;
                }
                return TRUE;
            }
            return TRUE;
        }
    }
?>