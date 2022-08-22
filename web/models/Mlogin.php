<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mlogin extends MY_Model {
	public function __construct()
	{
		parent::__construct();
		
	}
	function ingresar($usuario,$password){
		$this->db->select("a.id_agente,a.email");
		$this->db->where("a.email",$usuario);
		$this->db->where("a.password",$password);
		$this->db->where("a.status",1); 
		$query = $this->db->get("agente as a");
		// print_r($this->db->last_query()); exit();
		return ($query->num_rows() > 0) ? $query->row() : [];
	}
	function login_rest($usuario,$password){
		$this->db->select("a.id_agente,a.email");
		$this->db->where("a.email",$usuario);
		$this->db->where("a.password",$password);
		$this->db->where("a.status",1); 
		$query = $this->db->get("agente as a");
		// return ($query->num_rows() > 0) ? $query->row() : [];
		if($query->num_rows() > 0){
			$id_agente = $query->row()->id_agente;
			$data = [
				"id_agente" => $id_agente,
				"token" => sha1(date("Y-m-d h:i:s"))
			];
			$this->db->insert("token_rest",$data);
			return $data["token"];
		}else{
			return false;
		}
	}
}
