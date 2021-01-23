<? defined('BASEPATH') or exit('No direct script access allowed');

class Restapi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		
	}

    function enviarCorreoRegistroCliente($uuid_cliente){
        if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
            $usr = postrest("GET","clientes?uuid_cliente=eq.".$uuid_cliente);
            if($usr['data']){
                $usr=$usr['data'][0];
                postrest("PATCH","clientes?uuid_cliente=eq.".$uuid_cliente,array('status'=>0));
                echo true;
            }else{
                echo false;
            }
        }else{
            echo false;
        }
    }
}
