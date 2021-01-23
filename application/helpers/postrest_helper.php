<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//https://postgrest.org/
if ( ! function_exists('postrest')){
    function postrest($method=false,$table="",$data=false){
        
        if(in_array($method,array("POST","GET","PATCH"))){
            /*$srv = 'http://178.128.14.243:3000/';
            $url = $srv.$table;
            //$data=($method=="GET")?$data:false;
            //$method = ($method==1)?'POST':'GET';
            $data=($data==false)?false:json_encode($data);

            $authToken = 'OAuth 2.0 token here';
            $context = stream_context_create(array(
                'http' => array(
                    'method' => $method,
                    'header' => "Content-Type: application/json",
                    //'header' => "Authorization: {$authToken}\r\n".
                        //"Content-Type: application/json\r\n",
                    'content' => $data
                )
            ));

            // Send the request
            $response = file_get_contents($url, FALSE, $context);
            // Check for errors
            if($response === FALSE){
                return false;
            }
            return json_decode($response, TRUE);*/

            $srv = 'http://178.128.14.243:3000/';
            $url = $srv.$table;


            $ch = curl_init();
            $headers  = [
                //'x-api-key: XXXXXX',
                'Content-Type: application/json'
            ];
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		    curl_setopt($ch, CURLOPT_TIMEOUT_MS, 100000);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		    curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            ///////////////////////////////
            
            if($method!="GET"){
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
            }  
            ///////////////////////        
            $result     = curl_exec ($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if($statusCode>=200 && $statusCode<300){
                return array('statusCode'=>$statusCode,'data'=>json_decode($result));
            }else{
            	return array('statusCode'=>$statusCode,'data'=>json_decode($result),'curl_error'=>curl_error($ch));
            }

        }else{ return false; }
    }
}
?>