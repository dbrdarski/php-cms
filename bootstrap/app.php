<?php 

$arr = [];
$arr['bsd'] = '1';
$arr['asd'] = 2;
echo '<pre>';
print_r($arr);
echo '</pre>';

$host = 'localhost';
$db   = 'php-cms';
$user = 'root';
$pass = 'root';
$charset = 'utf8';

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/config.php';

$db = new \Core\Database\PDO_Connection($config['db']);
$pdo = $db->getConnection();
$columns =
    "ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
    Prename VARCHAR( 50 ) NOT NULL, 
    Name VARCHAR( 250 ) NOT NULL,
    StreetA VARCHAR( 150 ) NOT NULL,
    StreetB VARCHAR( 150 ) NOT NULL, 
    StreetC VARCHAR( 150 ) NOT NULL, 
    StreetE VARCHAR( 150 ) NOT NULL, 
    County VARCHAR( 100 ) NOT NULL, 
    Postcode VARCHAR( 50 ) NOT NULL, 
    Country VARCHAR( 50 ) NOT NULL"
;

var $test = Schema::table('test', function($table){
    $table->increments('ID', 11),
    $table->string('Prename', 50);
    $table->string('Name', 250);
    $table->string('StreetC', 250);
    $table->string('StreetA', 250);
    $table->string('StreetA', 250);
    $table->string('StreetA', 250);
});

$test->create();

$table = 'test';
$createTable = $pdo->prepare("CREATE TABLE IF NOT EXISTS $table ($columns)");
$createTable->execute();
// $createTable->fetchAll();
die();

$router = new \Core\Router;

$mustacheOptions = array('extension' => '.html');
$render = new \Core\Rendering\Engine;
$render->inject( new Mustache_Engine(
    array(
        'loader'          => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/../resources/views/mustache', $mustacheOptions),
        'partials_loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/../resources/views/mustache/partials', $mustacheOptions)
        // TODO: 'cache' => dirname(__FILE__) . '../resources/cache/mustache/'
    ))
);

$db = new \Core\Database\Connection($config['db']);

// $db->capsule;

// $db->capsule->schema()->create('orders', function($table){
//     $table->increments('id');
//     $table->string('title');
// });
use \Core\Models\User;
$user = new User;

$router
    ->get('/', function($req, $res) use ($user){
        $res->json(json_encode($user::find(1)));
        return $res;
    })
    ->get('/user', function($req, $res) use ($user){
        $res->render('user', array(
                'name' => $user::find(1)->name, 
                'email' => $user::find(1)->email
            )
        );
        return $res;
    })
    ->get('/user/signup', 'UserController:getSignUp')
    ->post('/user/signup', function($req, $res) use ($user){
        var_dump($req->params);
        return $res;
    });
    $router->get('/user/signup/2', function($req, $res) use ($user){
        var_dump($req->params);
        return $res;
    })
    ->get('/user/add', function($req, $res) use ($user){
        $user::create([
            'name' => 'Dane Brdarski',
            'email' => 'fallboy17@yahoo.com',
            'password' => '123'
        ]);
        return $res
            ->type('text/html')
            ->write('User created')
        ;
    })
    ->get('/contact', function($req, $res){
        $res->write('te mrazam');
        return $res;
    })
    ->get('/404', function($req, $res){
        return $res
            ->status(404)
            ->type('text/html')
            ->write('Not Found.')
        ;
    });

$router->resolve();