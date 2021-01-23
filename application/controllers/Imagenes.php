<? defined('BASEPATH') or exit('No direct script access allowed');

class Imagenes extends CI_Controller
{

	public function __construct()
	{
        parent::__construct();
        validarLogin();
        $this->load->model('imagenes_model');
	}

	function index()
	{
		redirect('imagenes/cargar');
    }
    function cargar(){
        $data['imgs']=$this->imagenes_model->getGallery();
        $this->load->view('imagenes/cargar',$data);
    }
    function cargar_img(){
        $ds          = DIRECTORY_SEPARATOR;
        $storeFolder = 'assets\cargar_imagenes';
        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];         
            $targetPath =  $storeFolder . $ds;  
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $targetFile =  $targetPath.md5(time().rand()).".".$ext;
            if(move_uploaded_file($tempFile,$targetFile)){
                $this->imagenes_model->setData('gallery',array(
                    'idUser'=>$this->session->idUsuario,
                    'url'=>base_url($targetFile)
                ));
            }           
        }
        $imagesGallery['imgs']=$this->imagenes_model->getGallery();
        $reply['gallery']=$this->load->view('imagenes/ajax/images_gallery',$imagesGallery,TRUE);
        echo json_encode($reply);
    }
}