<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class imagenes_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
#################
#FUNCTION INSERT#
#################

	function setData($tabla_mysql,$formulario){
		$this->db->insert($tabla_mysql,$formulario);
		return $this->db->insert_id();
	}
#################
#FUNCTION UPDATE#
#################

	function update($tabla_mysql,$data_form,$where){
		$this->db->where($where);
		$this->db->update($tabla_mysql,$data_form);	
		$this->db->trans_complete();
		
		return ($this->db->trans_status() === FALSE)?false:true;
	}
	
##################
#FUNCTION SELECT#
#################
	function getRow($query){
		$query = $this->db->query($query);
    	return $query->row();
    }
    function getResult($query){
		$query = $this->db->query($query);
    	return $query->result();
	}
	/*************************************BEGIN FUNCIONES LOGIN*************************************/
	function getGallery(){
        $this->db->select("
            gallery.*,
	        CONCAT('Subida por ',users.name,' el ',DATE_FORMAT(gallery.created,'%d/%m/%Y %H:%i')) AS titulo
        ");
        $this->db->from('gallery');
        $this->db->join('users','users.id=gallery.idUser');
		$this->db->where('gallery.status',1);  
		$query = $this->db->get();
		
		return($query->num_rows() > 0)?$query->result():NULL;
	}
	/*************************************END FUNCIONES LOGIN*************************************/
#####################
#	FUNCTION DELETE	#
#####################

	function delete_data($table, $where){
		$this->db->delete($table, $where);
	}
	

}
?>