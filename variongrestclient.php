<?php
//namespace \IntelliDust\VarioNGClient

/**
 * VarioNG VOLVO REST Client
 * https://github.com/IntelliDust/VarioNG.git
 * (c) 2020 Slavoj SANTA Hruska <vyvoj@santa3d.sk>
 */

// class VarioNGClientException extends Exception {}

class VarioNGClient {
    

    protected $token=NULL;
    protected $api=NULL;
    protected $options=NULL;
    
    public function __construct($options=[]){
        $default_options = [
            'user_agent' => "PHP IntelliDust-VarioNGClient/0.1.9", 
            'base_url' => 'https://www.vario-ng.com/vci/vciws/postVNG/', 
	    'userName' => NULL,
            'password' => NULL
        ];
        
        $this->options = array_merge($default_options, $options);

	$this->api = new RestClient([
	    'user_agent' => $this->options['user_agent'],
	    'base_url' => $this->options['base_url']
	]);
	
    }


    public function logIn(){

	$r = $this->api->post("getLogin",
	    json_encode(['userName' => $this->options['userName'], 'password' =>$this->options['password']]),
	    array('Content-Type' => 'application/json')
	);
	$r=json_decode($r->response);
	if (@$r->rc==-1){
	    throw new Exception("VarioNGClient: Login failed ['".$r->message."']");
	}
	$this->token=$r->token;
	return "OK";

    }


    public function postJobCard($jobCard){
	$jr = $this->api->post("postJobCard",
	    json_encode($jobCard),
	    array('Content-Type' => 'application/json','Authorization'=>$this->token)
	);
	$r=json_decode($jr->response);
	if (!@$r->details[0]->rc){
	    print_r($jr->response);
	    print_r($r);
	    throw new Exception("VarioNGClient: JobCard fatal fail !!!");
	}
	if (@$r->details[0]->rc!=1){
	    throw new Exception("VarioNGClient: JobCard failed [".$r->details[0]->rc."]['".$r->details[0]->message."']");
	}
	return $r;
    }


}


