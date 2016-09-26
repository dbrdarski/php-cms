<?php 

$config = [
	'db' => [
	    'driver' => 'mysql',
	    'host' => 'localhost',
	    'database' => 'php-cms',
	    'username' => 'root',
	    'password' => 'root',
	    'charset' => 'utf8',
	    'collation' => 'utf8_unicode_ci',
	    'prefix' => '',
	    'opt' => [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
	]
];