<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class login_model extends CI_Model {
	
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
	function selectData($query){
		$query = $this->db->query($query);
    	return $query->row();
	}
	/*************************************BEGIN FUNCIONES LOGIN*************************************/
	function getHash($usr){
		$this->db->select('pwd');
		$this->db->from('users');
		$this->db->where('usr',$usr);  
		$query = $this->db->get();
		
		return($query->num_rows() > 0)?$query->row()->pwd:NULL;
	}
	function webLogin($email){
		$this->db->select("
			*
		");
		$this->db->from('users');
		$this->db->where('LOWER(usr)', strtolower($email));
		$this->db->where('status', 1);
		$query = $this->db->get();
	

		return($query->num_rows() > 0)?$query->row():NULL;
	}
	function olvidePwd($email,$uuid,$extra){
		$query=$this->db->query('SELECT olvidePwd("'.$email.'","'.$uuid.'","'.$extra.'") as data');
		
		return($query->num_rows() > 0)?$query->row()->data:NULL;
	}
	function getIdUsuarioByEmail($email){
		$this->db->select("id");
		$this->db->from('admon_usuarios');
		
		$this->db->where('email',$email);
		$query = $this->db->get();

		return($query->num_rows() > 0)?$query->row()->id:NULL;
	}
	function getEmailByIdUsuario($idUsuario){
		$this->db->select("email");
		$this->db->from('admon_usuarios');
		
		$this->db->where('id',$idUsuario);
		$query = $this->db->get();

		return($query->num_rows() > 0)?$query->row()->email:NULL;
	}
	function getUsuarioById($idUsuario){
		$this->db->select("*");
		$this->db->from('admon_usuarios');
		
		$this->db->where('id',$idUsuario);
		$query = $this->db->get();

		return($query->num_rows() > 0)?$query->row():NULL;
	}
	function getCambioUsr($token){
		$this->db->select("*");
		$this->db->from('usuariocambiopwd');
		
		$this->db->where('token',$token);
		$this->db->where('status',0);
		$query = $this->db->get();

		return($query->num_rows() > 0)?$query->row():NULL;
	}
	
	function getCambioUsrByTookem($token){
		$this->db->select("*");
		$this->db->from('admon_usuarioscambio');
		
		$this->db->where('token',$token);
		$this->db->where('status',0);
		$query = $this->db->get();

		return($query->num_rows() > 0)?$query->row():NULL;
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