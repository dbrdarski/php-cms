<?php 

namespace Core\Router;

class Request{
    
    function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $r = explode('?', $_SERVER['REQUEST_URI']);
        $this->path = '/' . trim($r[0], '/');        
        $params_str = $_SERVER['QUERY_STRING'];
        $this->uri = $params_str ? $this->path . "?" . $_SERVER['QUERY_STRING'] : $this->path;
        $params = $this->method === 'POST' ? $_POST : $_GET;        
        $this->params = $params;
    }
}