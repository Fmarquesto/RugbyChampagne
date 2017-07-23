<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 8/7/2017
 * Time: 14:02
 */


$app->group('', function()use($app){
    $app->get('/auth/signup','AuthController:getSignUp')->setName('auth.signup');
    $app->post('/auth/signup','AuthController:postSignUp');

    $app->get('/auth/signin','AuthController:getSignIn')->setName('auth.signin');
    $app->post('/auth/signin','AuthController:postSignIn');

})->add(new \App\Middleware\GuestMiddleware($container));

$app->group('',function() use ($app){
    $app->get('/','HomeController:index')->setName('home');

    $app->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

    $app->get('/championships','ChampionshipController:getChampionships')->setName('championships');
    $app->get('/championship/create','ChampionshipController:getChampionshipCreate')->setName('championship.create');
    $app->post('/championship/create','ChampionshipController:postChampionshipCreate');

    $app->get('/categories', 'CategoryController:getCategories')->setName('categories');

})->add(new \App\Middleware\AuthMiddleware($container));









$app->get('/datatables/languaje', function($request, $response) use($container){
    $data = [
        'sEmptyTable' => 'No hay datos',
        'sInfo' => '_START_ a _END_. Total: _TOTAL_ Resultados',
        'sInfoEmpty' => 'Sin resultados',
        'sInfoFiltered' => '(Filtrado de _MAX_ Resultados)',
        'sInfoPostFix' => '',
        'sInfoThousands' => '.',
        'sLengthMenu' => '_MENU_ Resultados Mostrados',
        'sLoadingRecords' => 'Cargando...',
        'sProcessing' => 'Buscando...',
        'sSearch' => 'Buscar',
        'sZeroRecords' => 'No se encontraron resultados.',
        'oPaginate' =>
            [
                'sFirst' => 'Primero',
                'sPrevious' => 'Anterior',
                'sNext' => 'Siguiente',
                'sLast' => 'Ultimo',
            ],

        'oAria' =>
            [
                'sSortAscending' => ': Orden ascendente',
                'sSortDescending' => ': Orden descendente',
            ],
    ];
    /**
     * @var \Slim\Http\Response $response
     */
    return $response->withJson($data);
})->setname('datatable.languaje');