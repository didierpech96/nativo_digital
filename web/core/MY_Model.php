<?php
 
class MY_Model extends CI_Model{
    function insert_default($table,$data){
    	return $this->db->insert($table,$data);
    }
    function update_default($table,$data,$where){
    	return $this->db->update($table,$data,$where);
    }
    function delete_default($table,$where){
        return $this->db->delete($table,$where);
    }
    function insert_batch_default($table,$data){
        return $this->db->insert_batch($table,$data); 
    }        
    function update_batch_default($table,$data,$id){
        return $this->db->update_batch($table,$data,$id); 
    } 
    function select_default($table,$select = "*",$where = array()){
        $this->db->select($select);
        $this->db->where($where);
        $query = $this->db->get($table);
        return ($query->num_rows() > 0) ? $query->result() : [];
    }          
}
?>