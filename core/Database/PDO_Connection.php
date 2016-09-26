<?php 

namespace Core\Database;

use \PDO;

class PDO_Connection {    

    function __construct($settings, $opt = [])
    {
        extract($settings);
        $dsn = "$driver:host=$host;dbname=$database;charset=$charset";
        $this->connection = new PDO($dsn, $username, $password, $opt);
    }
    public function getConnection()
    {
        return $this->connection;
    }
}