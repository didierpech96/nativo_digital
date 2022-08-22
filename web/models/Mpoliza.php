<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mpoliza extends MY_Model {
	public function __construct()
	{
		parent::__construct();
		
	}
	function paginacion($limit,$offset,$id_agente){
		$data = array("filas" => 0, "resultados" => []);
        $select = "p.*, c.nombre_completo as cliente, tp.tipo_poliza as tipo_poliza"; #select verdadero
        $this->db->select("1 as columna",FALSE);
        #validaciones
        	$this->db->join("agente as a","a.id_agente = p.id_agente");
            $this->db->join("cliente as c","c.id_cliente = p.id_cliente");
            $this->db->join("tipo_poliza as tp","tp.id = p.tipo_poliza");
            $this->db->where("p.id_agente",$id_agente);
        $data["filas"] = $this->db->get('poliza as p')->num_rows();
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
    function nuevo($poliza,$asegurados){
        $this->db->trans_start();
        /***********TRANSACTION START*****************/
            $this->db->insert("poliza",$poliza);
            $id_poliza = $this->db->insert_id();
            foreach ($asegurados as $key => $a) {
                $asegurados[$key]["id_poliza"] = $id_poliza;
            }
            $this->db->insert_batch("asegurado",$asegurados);
        /***********TRANSACTION END*****************/
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        }else{
            $this->db->trans_commit();
        }
        return TRUE;
    }
}
