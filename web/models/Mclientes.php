<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mclientes extends MY_Model {
	public function __construct()
	{
		parent::__construct();
		
	}
	function paginacion($limit,$offset){
		$data = array("filas" => 0, "resultados" => []);
        $select = "*"; #select verdadero
        $this->db->select("1 as columna",FALSE);
        #validaciones
        	#code
        $data["filas"] = $this->db->get('cliente')->num_rows();
        #los filtros son iguales siempre, solo cambia el select, para sacar el numero de columnas obtenemos solo un campo columna con valor 1, posteriormente se reemplazará con el select verdadero a la query hecha anteriormente
        $query = str_replace("1 as columna", $select , $this->db->last_query());
        #ya con el select verdadero adjunto a la query se le concatena un limit y un offset
        $resultados = $this->db->query($query." limit ".$limit." offset ".$offset);
        if($data["filas"] > 0){
            foreach($resultados->result() as $fila){
                $data["resultados"][] = $fila;
            }
        }
        return $data;
	}
}
