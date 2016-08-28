<?php

class Module {

    function __construct($name, $label = null)
    {
        $this->name = $name;
        $this->label = $label !== null ? $label : $name;
        self::$modules[$name] = $this;
    }

    public $name;
    private static $modules = array();
    private static $methods = array();

    private static $installScripts;
    
    public function exposeMethod($method)
    {
        self::$methods[$method]=$this;
    }

    public function __call($method, $args)
    {
        return call_user_func_array(array(self::$methods[$method], $method), $args);
    }

    // function install($script){
    //     self::$installScripts = $script;
    //     return $this;
    // }

    // public function register($name){
    //     $m = new Module($name);
    //     self::$modules[$name] = $m;        
    //     return $m;
    // }

    function run()
    {
        $s = self::$parent[$this->name];
        $s();
    }

    function isInstalled()
    {
        return false;
    }
}