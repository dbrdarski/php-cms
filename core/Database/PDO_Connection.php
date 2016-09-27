<?php 

namespace Core\Database;

use \PDO;
use Core\App as App;

class PDO_Connection {

    function __construct($settings, $opt = [])
    {
        extract($settings);
        $dsn = "$driver:host=$host;dbname=$database;charset=$charset";
        $connection = new PDO($dsn, $username, $password, $opt);
        $this->connection = $connection;
        App::register('connection', $connection);

    }
    public function getConnection()
    {
        return $this->connection;
    }
}