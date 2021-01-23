<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('validarLogin')){
    function validarLogin(){
    	$CI =& get_instance();
        
        
        if(!isset($CI->session->idUsuario)){
			if(explode("_", $funcion)[0]!="ajax"){
				if(!in_array($funcion,$saltarFunnciones)){
					$CI->session->sess_destroy();
					redirect(base_url());
				}
			}
        }
        

        
		
	}
}
?>