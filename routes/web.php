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
    'prefix' => '/cfx'
], function () use ($router){
    $router->group([
        'prefix' => '/aadkclientcheck'
    ], function () use ($router){
        $router->get('/getAadkClientCheck', 'Aadk\AadkClientCheckController@getAddkClientCheck');
    });
    
});

$router->group([
    'prefix' => '/pesalah'
], function () use ($router) {
    $router->post('/nombor-ic', 'Aadk\PesalahController@getNoByIc');
    $router->post('/semua', 'Aadk\PesalahController@getAllPesalah');
});

$router->group([
    'prefix' => '/imigresen',
], function () use ($router){
    $router->group([
        'prefix' => '/pesalah'
    ], function () use ($router) {
        $router->post('/carian', 'Imigresen\PesalahController@getPesalah');
    });
});

$router->group([
    'prefix' => '/mygdx'
], function () use ($router){
    $router->post('/client-check', 'Mygdx\ClientController@checkClient');
    $router->post('/aadk-client-check', 'Mygdx\ClientController@aadkClientCheck');
});

$router->group([
    'prefix' => '/aadk',
], function () use ($router){
    $router->post('/search', 'Aadk\PesalahController@getNoByIc');
    $router->post('/hadir-program','Aadk\Maklumat\HadirProgramController@getHadirProgram');
    $router->post('/orang-kena-pengawasan','Aadk\Maklumat\OrangKenaPengawasanController@getOrangKenaPengawasan');
    $router->post('/sejarah-lampau','Aadk\Maklumat\SejarahLampauController@getSejarahLampau');
    $router->post('/prestasi','Aadk\Maklumat\PrestasiController@getPrestasi');
    $router->post('/dadah','Aadk\Maklumat\DadahController@getDadah');
});

$router->group([
    'prefix' => '/request',
], function() use ($router) {
    $router->group([
        'prefix' => '/client',  
    ],function () use ($router){
        $router->post('/search', 'Aadk\PesalahController@getNoByIc');
        $router->post('/hadir-program','Aadk\Maklumat\HadirProgramController@getHadirProgram');
        $router->post('/orang-kena-pengawasan','Aadk\Maklumat\OrangKenaPengawasanController@getOrangKenaPengawasan');
        $router->post('/sejarah-lampau','Aadk\Maklumat\SejarahLampauController@getSejarahLampau');
        $router->post('/prestasi','Aadk\Maklumat\PrestasiController@getPrestasi');
        $router->post('/dadah','Aadk\Maklumat\DadahController@getDadah');
    });
});