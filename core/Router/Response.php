<?php

namespace Core\Router;

use Core\Rendering\Engine as Engine;

class Response{
    
    function __construct($request)
    {
        $this->location = $request->uri;
        $this->status = 200;
        
    }
    private $response;
    private $location;
    private $type;
    private $status;

    private $header_types = array(
        'text/plain' => 'Content-Type: text/plain',
        'text/html' => 'Content-Type: text/html',
        'application/json'=> 'Content-Type: application/json',
        'application/pdf' => 'Content-Type: application/pdf'
    );
    
    public function status($status)
    {
        $this->status = $status;
        return $this;
    }

    public function type($type){
        if ( isset($this->header_types[$type]) ){
            $this->type = $this->header_types[$type];
        }
        return $this;
    }    
        
    public function json($json)
    {
        $this->type('application/json');
        $this->response = $json;
        return $this;
    }

    public function write($txt){
        $this->response = $txt;
        return $this;
    }

    public function render($template, $data){
        $this->type('text/html');
        $this->response = Engine::render($template, $data);
        return $this;
    }

    public function send()
    {
        if($_SERVER['REQUEST_URI'] != $this->location){
            header('Location:' . $this->location);
            exit();
        }
        header( $this->type, true, $this->status);
        echo $this->response;
        exit();
    }
    // TODO response messages Found, redirects, not found etc...
}