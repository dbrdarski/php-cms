<?php 

namespace Core\Database;

use Core\Database\Schema\Table as Table;

class Schema {

    function __construct($settings)
    {
        $this->connection = null;
    }

    private $tables = [];

    static function table($name, $callback){
        self::$tables[$name] = new Table($name, $callback);
    }
}

$asd = Schema::table('name', function($t){
    $t->stirng('dane', 11);
});