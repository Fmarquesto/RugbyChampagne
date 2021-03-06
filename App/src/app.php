<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 8/7/2017
 * Time: 14:00
 */
session_start();
require __DIR__ . '/../../vendor/autoload.php';
$config = [
    'settings' => [
        'addContentLengthHeader' => false,
        'displayErrorDetails' => true,
        'db' => [
            'driver'=>'mysql',
            'host'=>'localhost',
            'database'=>'rugby_champagne',
            'username'=>'root',
            'password'=>'',
            'charset'=>'utf8',
            'collation'=>'utf8_unicode_ci',
            'prefix'=>''
        ]
    ],
];

$app = new \Slim\App($config);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule){
    return $capsule;
};
$container['validator'] = function ($container) {
    return new \App\Validation\Validator;
};
$container['csrf'] = function ($container) {
    return new \Slim\Csrf\Guard;
};
$container['auth'] = function ($container) {
    return new App\Auth\Auth($container);
};
$container['flash'] = function ($container) {
    return new \Slim\Flash\Messages();
};

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../templates/', [
        //'cache' => '../src/templates/cache'
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->getEnvironment()->addGlobal('auth',[
        'check' => $container->auth->check(),
        'user' => $container->auth->user(),
    ]);
    $view->getEnvironment()-> addGlobal('flash', $container->flash);
    return $view;
};

//Add Controllers
/*$container['HomeController'] = function($container){
    return new \App\Controllers\HomeController($container);
};*/

//Add Middleware
/*$app->add(new \App\Middleware\ValiationErrorsMiddleware($container));*/

$container['HomeController'] = function($container){
    return new \App\Controller\HomeController($container);
};
$container['AuthController'] = function($container){
    return new \App\Controller\Auth\AuthController($container);
};
$container['ChampionshipController'] = function($container){
    return new \App\Controller\ChampionshipController($container);
};

$container['CategoryController'] = function($container){
    return new \App\Controller\CategoryController($container);
};

$container['TeamController'] = function($container){
    return new \App\Controller\TeamController($container);
};

$container['PlayerController'] = function($container){
    return new \App\Controller\PlayerController($container);
};

$app->add(new \App\Middleware\CsrfViewMiddleware($container));

$app->add($container->csrf);

require_once __DIR__ . '/routes.php';