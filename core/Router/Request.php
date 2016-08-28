<?php 

namespace Core\Router;

class Request{
    
    function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $r = explode('?', $_SERVER['REQUEST_URI']);
        $this->path = '/' . trim($r[0], '/');        
        $params_str = $_SERVER['QUERY_STRING'];
        $this->uri = $params_str == null ? $this->path : $this->path . $_SERVER['QUERY_STRING'];
        $params = $params_str != null && $params_str !='' ? array() : null; 
        
        if (is_array($params)) {
            $ps = explode("&", $params_str); 
            for ($i=0; $i < count($ps); $i++) {
                $p = explode("=", $ps[$i]);
                $params[array_shift($p)] = array_shift($p);
            }
        }
        $this->params = $params;
    }
}