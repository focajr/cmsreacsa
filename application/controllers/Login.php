<? defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		if (isset($this->session->idUsuario)) {
			return redirect(base_url('dashboard'));
		} else {
			$this->load->view('login');
		}
	}
	function webLogin()
	{
		//Buscamos el hash por el usuario
		$usr = $this->input->post("usr");
        $pwd = $this->input->post("pwd");
        $usr = postrest("GET","cms_usuarios?usr=eq.".$usr);
         if($usr['data']){
            $usr=$usr['data'][0];
            if (password_verify($pwd, $usr->pwd)) {
                $login = $usr;
                if ($login) {
                    $data = array(
                        'idUsuario'=>$login->id,
                        'email'=>$login->email,
                        'nombre'=>$login->name,
                        'usuario'=>$login->usr,
                        'tipoUsuario'=>$login->idUserType,
                        'logueado'=>true,
                        'menu'			=> 'sidebar-mini'
                    );
                    $this->session->set_userdata($data);
                    $data['data'] = $login->id;
                } else {
                    $data['msg'] = "Usuario o contraseña incorrectos verifique sus credenciales.";
                }
            } else {
                $data['msg'] = "Usuario o contraseña incorrectos verifique sus credenciales.";
            }
            echo json_encode($data);
        }
 
	}
	function logout()
	{
        echo "hola";
		$this->session->sess_destroy();
		return redirect(base_url());
    }
    function ajax_prueba(){
        /*$pwd="admin";
        $usr = postrest("GET","cms_usuarios?usr=eq.admin");
        if($usr){
            $usr=$usr[0];
            echo $pwd."============".$usr['pwd'];
            if(password_verify($pwd, $usr['pwd'])){
                echo "si";
            }else{
                echo "no";
            }
        }*/
        //$upd=postrest("PATCH","clientes?uuid_cliente=eq.8e96af95-4575-47e9-a2aa-b56aba2f035f",array('status'=>1));
        $usr="admin";
        $usr=postrest("GET","cms_usuarios?usr=eq.".$usr);
     
        var_dump($usr);
    }
	function klo()
	{
        echo password_hash("admin",PASSWORD_DEFAULT);
		//echo $hash = password_hash("RrSi4nyPmS-qpRY[Km^w",PASSWORD_DEFAULT);
		//echo $hash = password_hash("entrenaduro",PASSWORD_DEFAULT);
		//die();
	}
	function ajax_setUser()
	{
		/*//$hash=$this->login_model->getHash('123456');
		$hash = '$2y$10$QH9t9MXr73RKsetM0CVdsuU0cOyTs1ryJPNprrG9EzqAh76nNIZsO';

		if (password_verify('123456', $hash)) {
		    echo '¡La contraseña es válida!';
		} else {
		    echo 'La contraseña no es válida.';
		}
		//$hash = password_hash("admin",PASSWORD_DEFAULT);
		$this->login_model->update_tablas('admon_usuarios',array('pwd'=>$hash),array('id'=>1));*/
		//echo password_verify('pipiconpopo', $hash);
	}
}
