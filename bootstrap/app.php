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

echo '<pre>';
var_dump($user::find(1)->email);
echo '</pre>';

die();

$router
    ->add('/', function($req, $res){
        $res->json(json_encode([['dane', 'is_king'],['your', 'kiss_is', 'dream']]));
        return $res;
    })
    ->add('/about', function($req, $res){
        $res->render('template', 
            array(
                'title' => 'Hello, World!', 
                'text' => 'This is a <strong>text.</strong>'
            )
        );
        return $res;
    })
    ->add('/contact', function($req, $res){
        $res->write('te mrazam');
        return $res;
    })
    ->add('/404', function($req, $res){
        return
        $res->status(404)
            ->type('text/html')
            ->write('Not Found.')
        ;
    });

$router->resolve();

