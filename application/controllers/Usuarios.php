<? defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{

	public function __construct()
	{
        parent::__construct();
        validarLogin();
        
	}

	function index()
	{
		$this->load->view('usuarios/index');
    }
    function ajax_agregarUsuario(){
        $vista=$this->load->view('usuarios/ajax/agregar',false,true);
        $reply=array('status'=>1,'vista'=>$vista,'msg'=>'');
        echo json_encode($reply);
    }
    function ajax_setUsuario(){
        $data=$this->input->post();
        $data['pwd']=password_hash($data['pwd'],PASSWORD_DEFAULT);
        $post=postrest('POST','cms_usuarios',$data);
        $reply=['status'=>0,'msg'=>"Ocurrio un problema al agregar el usuario, intentelo mas tarde."];
        if($post['statusCode']==201){
            $reply=['status'=>1,'msg'=>"Se agrego correctamente el usuario."];
        }
        echo json_encode($reply);
    }
    function ajax_getEditarPwd(){
        $data=$this->input->get();
        if($data['uuid'] && $data['nombre']){
            $vista=$this->load->view('usuarios/ajax/cambiopwd',$data,true);
            $reply=array('status'=>1,'vista'=>$vista,'msg'=>'');
        }else{
            $reply=array('status'=>0,'msg'=>"No se a enviado un id de cliente valido.");
        }
        echo json_encode($reply);
    }
    function ajax_setPwd(){
        $data=$this->input->post();
        $uuid=$data['uuid'];
        if($uuid){
            unset($data['uuid']);
            $data['pwd']=password_hash($data['pwd'],PASSWORD_DEFAULT);
            $post=postrest('PATCH','cms_usuarios?id=eq.'.$uuid,$data);
            $reply=['status'=>0,'msg'=>"Ocurrio un problema al actualizar la contraseña del usuario, intentelo mas tarde."];
            if($post['statusCode']==204){
                $reply=['status'=>1,'msg'=>"Se actualizo correctamente la contraseña del usuario."];
            }
        }else $reply=array('status'=>0,'msg'=>"No se a enviado un id de usuario valido.");
        echo json_encode($reply);
    }
    function ajax_getDetallesUsuario(){
        $data=$this->input->get();
        if($data['uuid']){
            $data=postrest('GET','cms_usuarios?id=eq.'.$data['uuid']);
            if($data['statusCode']==200 && count($data['data'])>0){
                $detalles['usuario']=$data['data'][0];
                $vista=$this->load->view('usuarios/ajax/detalles',$detalles,true);
                $reply=array('status'=>1,'vista'=>$vista,'msg'=>'');
            }else{
                $reply=array('status'=>0,'msg'=>"No fue posible obtener la información del usuario, intentelo mas tarde.");
            }
        }else{
            $reply=array('status'=>0,'msg'=>"No se a enviado un id de usuario valido.");
        }
        echo json_encode($reply);
    }

}