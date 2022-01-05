<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$router->get('/', function () use ($router) {
    return "AADK JIM Integrasi Demonstration";
});

$router->post('/login', 'AuthController@login');
$router->get('/refresh-token', 'AuthController@check');

$router->group([
    'prefix' => '/pesalah',
], function () use ($router) {
    $router->post('/nombor-ic', 'Aadk\PesalahController@getNoByIc');
    $router->post('/semua', 'Aadk\PesalahController@getAllPesalah');
});

$router->group([
    'prefix' => '/maklumat',
], function() use ($router) {
    $router->post('/hadir-program','');
    $router->post('/orang-kena-pengawasan','');
    $router->post('/sejarah-lampau','Aadk\Maklumat\SejarahLampauController@getSejarahLampau');
    $router->post('/prestasi','');
    $router->post('/dadah','');
});
