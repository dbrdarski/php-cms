<?php 

namespace Core;

use Core\Router\Request as Request;
use Core\Router\Response as Response;

class Router{

    public static $routes = array();
    
    public function add($uri, $handle)
    {
        self::$routes[$uri] = $handle;
        return $this;
    }

    public function resolve()
    {
        $req = new Request;
        $res = new Response($req);
        $partial_match = null;

        foreach (self::$routes as $path => $handle) {
            if( preg_match("#^$path$#", $req->path)){
                return $handle($req, $res)->send();
            }
            if( preg_match("#^$path/#", $req->path)){
                $partial_match  = $handle($req, $res)->send();
            }
        }        
        return $partial_match ? $partial_match : $req;
    }
}