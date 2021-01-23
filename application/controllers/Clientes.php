<? defined('BASEPATH') or exit('No direct script access allowed');

class Clientes extends CI_Controller
{

	public function __construct()
	{
        parent::__construct();
        validarLogin();
        
	}

	function index()
	{
		$this->load->view('clientes/index');
    }
    function ajax_agregarCliente(){
        $vista=$this->load->view('clientes/ajax/agregar',false,true);
        $reply=array('status'=>1,'vista'=>$vista,'msg'=>'');
        echo json_encode($reply);
    }
    function ajax_getEditarPwd(){
        $data=$this->input->get();
        if($data['uuid'] && $data['nombre']){
            $vista=$this->load->view('clientes/ajax/cambiopwd',$data,true);
            $reply=array('status'=>1,'vista'=>$vista,'msg'=>'');
        }else{
            $reply=array('status'=>0,'msg'=>"No se a enviado un id de cliente valido.");
        }
        echo json_encode($reply);
    }
    function ajax_getDetallesCliente(){
        $data=$this->input->get();
        if($data['uuid']){
            $data=postrest('GET','clientes?uuid_cliente=eq.'.$data['uuid']);
            if($data['statusCode']==200 && count($data['data'])>0){
                $detalles['cliente']=$data['data'][0];
                $vista=$this->load->view('clientes/ajax/detalles',$detalles,true);
                $reply=array('status'=>1,'vista'=>$vista,'msg'=>'');
            }else{
                $reply=array('status'=>0,'msg'=>"No fue posible obtener la información del cliente, intentelo mas tarde.");
            }
        }else{
            $reply=array('status'=>0,'msg'=>"No se a enviado un id de cliente valido.");
        }
        echo json_encode($reply);
    }
    
}