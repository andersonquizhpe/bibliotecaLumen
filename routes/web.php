<?php

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
    return $router->app->version();
});
//Usuarios
$router->group(['prefix'=>'usuarios'], function($router){
    $router->post('/login', 'UserController@login');
});
//Genero
$router->group(['prefix'=>'generos'], function($router){
    $router->get('','GeneroController@getGeneros');
    $router->get('/get/{id}','GeneroController@getOneGenero');
    $router->post('/create','GeneroController@createGenero');
    $router->post('/edit/{id}','GeneroController@updateGenero');
    $router->get('/delete/{id}','GeneroController@deleteGenero');
});