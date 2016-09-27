<?php 

namespace Core\Database\Schema;

class Table {

    function __construct($name, $schema)
    {
    	$this->name = $name;
        $this->schema = $schema;
    }
    private function exec($command, $table, $cols = null){
        return $cols ? $App->db->execute("$command $table ($cols)" : $App->db->execute("$command $table");
    }
    public function create(){
        $createTable = exec('CREATE TABLE', $this->name, $this->schema));
    }
    public function createIfNotExists(){
        $createTable = exec('CREATE TABLE IF NOT EXISTS', $this->name, $this->schema));
    }
    public function drop(){
        $createTable = exec('DROP', $this->name, $this->schema));
    }
}