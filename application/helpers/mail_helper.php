<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('sendMail')){
    function sendMail($to,$subject,$message,$pathFile=false,$bcc=false,$cc=false){
    	$CI =& get_instance();

		/*$config = Array(
			'protocol'  => 'smtp',
		    'smtp_host' => 'localhost',
		    'smtp_port' => 25,
		    'smtp_user' => 'gym@sositi.com',
		    'smtp_pass' => 'Tha+5kuCAGAt_',
		    'mailtype' => 'html',
		    'charset' => 'iso-8859-1',
		    'newline' => '\r\n',
		    'charset'=> 'utf-8'
	    );
		$CI->load->library('email',$config);
        $CI->email->set_newline("\r\n");
	    $CI->email->from('gym@sositi.com');
	    $CI->email->to($to);
		if($cc)$CI->email->cc($cc);
		if($bcc)$CI->email->bcc($bcc);
	    $CI->email->subject($subject);
	    $CI->email->message($message);
		($pathFile)?$CI->email->attach($pathFile):"";*/
		/*if($CI->email->send())
			return 1;
		else
			return -1;*/
			
			
		$config = Array(
			'protocol'  => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'gym.sositi@gmail.com',
		    'smtp_pass' => 'Tha+5kuCAGAt',
		    'mailtype' => 'html',
		    'charset' => 'iso-8859-1',
		    'newline' => '\r\n',
		    'charset'=> 'utf-8'
	    );
		$CI->load->library('email',$config);
		// $CI->email->initialize($config);
	    //$CI->email->initialize($config);
        $CI->email->set_newline("\r\n");
		$CI->email->from('no-reply@sositi.com');
	    //$CI->email->from('no-reply@gym.sositi.com');
	    $CI->email->to($to);
		if($cc)$CI->email->cc($cc);
		if($bcc)$CI->email->bcc($bcc);
	    $CI->email->subject($subject);
	    $CI->email->message($message);
		($pathFile)?$CI->email->attach($pathFile):"";
		if($CI->email->send()){
			
			$CI->load->model('clientes_model');
			$CI->clientes_model->setData('sendMails',array(
				'to'		=>$to,
				'cc'		=>(is_array($cc))?implode(",", $cc):$cc,
				'bcc'		=>(is_array($bcc))?implode(",", $bcc):$bcc,
				'subject'	=>$subject,
				'message'	=>$message,
				'pathFile'	=>$pathFile
			));
			return 1;
		}else
			return -1;
		
	    /*if($CI->email->send()){
	    	echo 'Email sent.';
	    	//return 1;
			$CI->email->print_debugger();
	    }else{
	    	//return -1;
	    	var_dump($CI->email);
			
	    	show_error($CI->email->print_debugger());
	    }*/
	}
}
if(!function_exists('emailAgregarMembrecia')){//EN ESPERA DE PAGO
	function emailAgregarMembrecia($membreciaCliente,$idMembresia,$idCliente){
		$CI = get_instance();
		$CI->load->model('clientes_model');
		$CI->load->model('membresias_model');
		
		$datos['membresiaCliente']=$membreciaCliente;
		$datos['membresia']=$CI->membresias_model->getMembresia($idMembresia);
		$datos['cliente']=$CI->clientes_model->getCliente($idCliente);
    	$html=$CI->load->view('emailTemplates/agregarMembrecia',$datos,TRUE);
		//Obtenemos email
		return sendMail($datos['cliente']->correo,'ACTUALIZACIÓN DE MEMBRESÍA!',$html);
	}
}
if(!function_exists('emailNuevoCliente')){//EN ESPERA DE PAGO
	function emailNuevoCliente($idCliente){
		$CI = get_instance();
		$CI->load->model('clientes_model');
		
		$datos['cliente']=$CI->clientes_model->getCliente($idCliente);
    	$html=$CI->load->view('emailTemplates/nuevoCliente',$datos,TRUE);
		//Obtenemos email
		sendMail($datos['cliente']->correo,'BIENVENID@!',$html);
	}
}
if(!function_exists('emailCorteDeCaja')){//EN ESPERA DE PAGO
	function emailCorteDeCaja($idCorteDeCaja){

		$CI = get_instance();
		$CI->load->model('corte_de_caja_model');
		
		$data['corteDeCaja']=$CI->corte_de_caja_model->getCorteDeCajaFinalizado($idCorteDeCaja);
		$data['movimientos']=$CI->corte_de_caja_model->getMovimientos($idCorteDeCaja);
		
		$html=$CI->load->view('emailTemplates/corteDeCaja',$data,TRUE);
		//Obtenemos email de administradores
		$emailsNotificacion=$CI->corte_de_caja_model->getEmailsNotificacionesAccion('corteDeCaja');
		$emailsNotificaciones=[];
		if($emailsNotificacion)foreach($emailsNotificacion as $emailNotificacion){
			$emailsNotificaciones[]=$emailNotificacion->email;
		}

		sendMail('gym.sositi@gmail.com','CORTE DE CAJA',$html,false,$emailsNotificaciones);
	}
}
?>