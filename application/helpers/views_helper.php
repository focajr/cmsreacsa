<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('loadView')){
    function loadView($view_path="",$view_js="",$view_data=false,$view_title=""){
        $CI =& get_instance();
        
        $view_data['view_title']=$view_title;
        //Sidebar config
        $view['sidebar']['sidebar_img']=base_url('assets/dist/img/AdminLTELogo.png');
        $view['sidebar']['sidebar_title']="Titulo sidebar";
        $view['sidebar']['sidebar_user_img']=base_url('assets/dist/img/user2-160x160.jpg');
        $view['sidebar']['sidebar_user_name']=$CI->session->nombre;

        $view['content']= $CI->load->view($view_path,$view_data,true);
        if($view_js==false){
            $view['js']= $CI->load->view("assets/",$view_data,true);
        }else{
            $view['js']= $CI->load->view($view_js,$view_data,true);
        }
        $CI->load->view('content/index',$view);
	}
}
?>