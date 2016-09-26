<?php 

namespace Core\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

class Connection {

    function __construct($settings)
    {
        $this->capsule = new Capsule;

        // Same as database configuration file of Laravel.
        $this->capsule->addConnection( $settings );
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();

        // Hold a reference to established connection just in case.
        $this->connection = $this->capsule->getConnection();
    }
}