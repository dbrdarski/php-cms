<?php 

namespace Core\Database\Schema;

use Core\App as App;
use Core\Database\Schema\Table as Table;

class Blueprint {

    function __construct($settings)
    {
        $this->connection = null;
    }

    static private $tables = [];

    static function table($name, $callback)
    {
    	$t = new Table($name, $callback);
        self::$tables[$name] = $t;
        return $t;
    }
}

// $asd = Schema::table('name', function($t){
//     $t->stirng('dane', 11);
// });