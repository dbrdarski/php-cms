<?php 

namespace Core;

use Core\Router\Request as Request;
use Core\Router\Response as Response;

class Router{

    public static $routes = array(
        'GET'    => array(),
        'POST'   => array(),
        'PUT'    => array(),
        'DELETE' => array()
    );
    
    public function add($uri, $handle)
    {
        self::$routes[$uri] = $handle;
        return $this;
    }

    public function get($uri, $handle)
    {
        self::$routes['GET'][$uri] = $handle;
        return $this;
    }

    public function post($uri, $handle)
    {
        self::$routes['POST'][$uri] = $handle;
        return $this;
    }
    private function fire($h, $req, $res)
    {
        if(is_array($h)){
            return call_user_func_array([$h[0], $h[1]], [$req, $res]);
        } else{
            return $h($req, $res);
        }
    }
    public function resolve()
    {
        $req = new Request;
        $res = new Response($req);
        $partial_matches = array();

        foreach (self::$routes[$req->method] as $path => $handle) {
            $match = preg_filter("#^$path#", "", $req->path);
            if( $match === ""){
                return $this->fire($handle, $req, $res)->send();
            } else if ( strlen($match) > 0 ){
                $partial_matches[strlen($req->path)] = $handle;
            }
        }
        $partial_match = $partial_matches ? end($partial_matches) : null;
        return $partial_match ? $this->fire($partial_match, $req, $res)->send() : $req;
    }    
}