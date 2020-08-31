<?php
namespace \IntelliDust\VarioNGClient

/**
 * VarioNG VOLVO REST Client
 * https://github.com/IntelliDust/VarioNG.git
 * (c) 2020 Slavoj SANTA Hruska <vyvoj@santa3d.sk>
 */

class VarioNGClientException extends Exception {}

class VarioNGClient implements Iterator, ArrayAccess {
    
    
    public function __construct($options=[]){
        $default_options = [
            'user_agent' => "PHP VarioNGClient/0.1.7", 
            'base_url' => NULL, 
            'password' => NULL
        ];
        
        $this->options = array_merge($default_options, $options);
    }
    
}


