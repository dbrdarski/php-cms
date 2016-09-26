<?php 

namespace Core\Database\Schema;

class Table {

    function __construct($name, $schema)
    {
    	$this->name = $name;
        $this->schema = $schema;
    }
    public function create(){

    }
    public function createIfNotExists(){

    }
    public function drop(){

    }
}