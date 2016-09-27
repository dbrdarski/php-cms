<?php 

namespace Core;

class App{

    private static $modules = [];
    
    public static function register($name, $module){
        self::$modules[$name] = $module;
    }
    
    public function __get($module)
    {
        return $modules[$module];
    }
}