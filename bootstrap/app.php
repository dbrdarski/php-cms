<?php 

require __DIR__ . '/../vendor/autoload.php';

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

$db = new \Core\Database\Connection(
  array(
    'driver'   => 'mysql',
    'host' => 'localhost',
    'database' => 'php-cms',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'   => ''
  )
);

// $db->capsule;

// $db->capsule->schema()->create('orders', function($table){
//     $table->increments('id');
//     $table->string('title');
// });
use \Core\Models\User;
$user = new User;;

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
    ->get('/user/signup', new \Core\Controllers\UserController)
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
            'name' => 'Panche Brdarski',
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

