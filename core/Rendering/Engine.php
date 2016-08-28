<?php 
namespace Core\Rendering;

class Engine{

    private static $r;

    public function inject($renderer)
    {
        self::$r = $renderer;
    }

    public static function render($tpl, $data){
        return self::$r->render($tpl, $data);
    }
}