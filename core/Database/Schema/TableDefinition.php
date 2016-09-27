<?php 

namespace Core\Database\Schema;

use Core\Database\Schema\Table\Column as Column;
class TableDefinition {

    // function __construct($name, $schema)
    // {
    // 	$this->name = $name;
    //     $this->schema = $schema;
    // }

    private $columns = [];


    public function boolean(){
        
    }
    public function integer(){
        return new Column()
    }
    public function decimal(){

    }
    public function float(){

    }
    public function string($name, $limit){

    }
    public function text(){

    }
    public function drop(){

    }
    public function increments(){

    }
    public function binary(){

    }
    public function date(){

    }
    public function dateTime(){

    }
    public function timestamp(){

    }
    public function timestamps(){

    }
    public function char(){

    }
    public function enum(){

    }
}