<? defined('BASEPATH') or exit('No direct script access allowed');

class Sucursales extends CI_Controller
{

	public function __construct()
	{
        parent::__construct();
        validarLogin();
        
	}

	function index()
	{
		$this->load->view('sucursales/index');
    }
    function ajax_agregarSucursal(){
        $vista=$this->load->view('sucursales/ajax/agregar',false,true);
        $reply=array('status'=>1,'vista'=>$vista,'msg'=>'');
        echo json_encode($reply);
    }
    function ajax_getDetallesSucursal(){
        $data=$this->input->get();
        if($data['uuid']){
            $data=postrest('GET','sucursales?id_sucursal=eq.'.$data['uuid']);
            if($data['statusCode']==200 && count($data['data'])>0){
                $detalles['sucursal']=$data['data'][0];
                $vista=$this->load->view('sucursales/ajax/detalles',$detalles,true);
                $reply=array('status'=>1,'vista'=>$vista,'msg'=>'');
            }else{
                $reply=array('status'=>0,'msg'=>"No fue posible obtener la información de la sucursal, intentelo mas tarde.");
            }
        }else{
            $reply=array('status'=>0,'msg'=>"No se a enviado un id de sucursal valido.");
        }
        echo json_encode($reply);
    }

}