<? defined('BASEPATH') or exit('No direct script access allowed');

class Banners extends CI_Controller
{

	public function __construct()
	{
        parent::__construct();
        validarLogin();
        
	}

	function index()
	{
		$this->load->view('banners/index');
    }
    function ajax_agregarBanner(){
        $vista=$this->load->view('banners/ajax/agregar',false,true);
        $reply=array('status'=>1,'vista'=>$vista,'msg'=>'');
        echo json_encode($reply);
    }
    function ajax_getDetallesSucursal(){
        $data=$this->input->get();
        if($data['uuid']){
            $data=postrest('GET','banners?uuid_banner=eq.'.$data['uuid']);
            if($data['statusCode']==200 && count($data['data'])>0){
                $detalles['sucursal']=$data['data'][0];
                $vista=$this->load->view('banners/ajax/detalles',$detalles,true);
                $reply=array('status'=>1,'vista'=>$vista,'msg'=>'');
            }else{
                $reply=array('status'=>0,'msg'=>"No fue posible obtener la información del banner, intentelo mas tarde.");
            }
        }else{
            $reply=array('status'=>0,'msg'=>"No se a enviado un uuid de banner valido.");
        }
        echo json_encode($reply);
    }

}