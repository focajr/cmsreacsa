<? defined('BASEPATH') or exit('No direct script access allowed');

class Productos extends CI_Controller
{

	public function __construct()
	{
        parent::__construct();
        validarLogin();
        
	}

	function index()
	{
		$this->load->view('productos/index');
    }
    function ajax_agregarProducto(){
        $vista=$this->load->view('productos/ajax/agregar',false,true);
        $reply=array('status'=>1,'vista'=>$vista,'msg'=>'');
        echo json_encode($reply);
    }
    function ajax_getDetallesProducto(){
        $data=$this->input->get();
        if($data['uuid']){
            $producto=postrest('GET','productos?uuid_producto=eq.'.$data['uuid']);
            if($producto['statusCode']==200 && count($producto['data'])>0){
                $detalles['producto']=$producto['data'][0];
                $vista=$this->load->view('productos/ajax/detalles',$detalles,true);
                $reply=array('status'=>1,'vista'=>$vista,'msg'=>'');
            }else{
                $reply=array('status'=>0,'msg'=>"No fue posible obtener la información del producto, intentelo mas tarde.");
            }
        }else{
            $reply=array('status'=>0,'msg'=>"No se a enviado un id de producto valido.");
        }
        echo json_encode($reply);
    }
}